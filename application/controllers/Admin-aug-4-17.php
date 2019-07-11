<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends MY_Controller {
	public $user = "";
	public function __construct() {
	 parent::__construct();
		$this->load->model('Admin_model');
		$this->load->model('Establishment_model');
 		$this->load->helper('form');
		$this->load->helper('url');
		$array_items=array('email'=>'','password'=>'');
		$this->session->unset_userdata($array_items);

		$this->data['sport_id']=$this->session->userdata('sport_id');
		$this->data['date_from']=$this->session->userdata('date_from'); 
		$this->data['date_end']=$this->session->userdata('date_end');
		$this->data['city']=$this->session->userdata('city'); 
		$this->data['country']=$this->session->userdata('country');
		$this->data['search_text']=$this->session->userdata('search_text');
		$this->data['cp']=$this->session->userdata('cp');
		$this->data['ppr']=$this->session->userdata('ppr');
	}
  public function index()
  {
	 if($this->session->userdata('admin_email')) {
			redirect('admin/dashboard');
		}
		else {
			redirect('admin/login');
		}
  }
    
  public function login()
  {
	  // echo 'test'; die;
	   if($this->session->userdata('admin_email')) {
	    redirect('admin/dashboard');
	   }
	   else
	   {
	   $caller=$this->input->post('caller'); 
	   $values=array(); 
	   $this->data['errormsg']="";
	   if($caller == "Send")
	   {
		    $values['email']=trim($this->input->post('email'));
		    $values['password']=trim($this->input->post('password'));			
		    $this->load->library('form_validation'); 
			$this->form_validation->set_message('valid_email','Please enter a valid email id');		    
		    $this->form_validation->set_rules('email','email','trim|callback_value_required[email]|valid_email');
		    $this->form_validation->set_rules('password','password', 'trim|callback_value_required[password]');
		    if($this->form_validation->run() == TRUE )// || $this->form_validation->run() == FALSE)
		    {  
			 $msg=$this->Admin_model->CheckUser($values['email'],myencrypt($values['password']));

			 if($msg=='success')
			 {
			 	$newdata=array('admin_email'=>$values['email'],
			 		'admin_password'=>myencrypt($values['password']));
			 	$this->session->set_userdata($newdata);
		     	redirect('admin/dashboard');
			  }
			  else $this->data['errormsg']=$msg;
				 
				 $this->data['email']=$values['email'];
				 $this->data['password']=$values['password'];
			}
		   }
		 $this->data['attribute']=$this->Admin_model->AdminLoginFormAttribute($values);
		}
		 $this->load->view('admin/login',$this->data);
	 }

 public function dashboard() {
	 if($this->session->userdata('admin_email')) {
		$ar= $this->session->all_userdata();
	//	print_r($ar);
		$values=array();
		$caller=$this->input->post('caller'); 
		$this->data['caller']= $caller;
		$this->data['dashboard'] = $this->Admin_model->DashboardDetails();
		
		$this->load->view('admin/dashboard',$this->data);
		}
		else
			redirect('admin/login');
	}
 
 public function user()
	{
		if($this->session->userdata('admin_email')) {
		$ar= $this->session->all_userdata();
		$values=array();
		$caller=$this->input->post('caller'); 
		$this->data['caller']= $caller;
		$this->data['attribute_search']=$this->Admin_model->SearchUserAttribute($values);
		$this->data['user_list']=$this->Admin_model->UserList($this->data['city'],$this->data['country'],$this->data['search_text']);
		$this->data['total_records']=count($this->data['user_list']);
		$this->data['ppr']=20;
		$cp=1;
    	if(empty($this->data['cp'])){$this->data['cp']=$cp;}else{$this->data['cp']=$this->session->userdata('cp');}
    	$this->data['pagination']=$this->Pagenation($this->data['cp'], $this->data['ppr'],$this->data['total_records']);

		$this->data['user_list']=$this->Admin_model->UserList($this->data['city'],$this->data['country'],$this->data['search_text'],"limit ".$this->data['pagination']['start_limit'].",".
		   $this->data['pagination']['end_limit']);

		$this->load->view('admin/user',$this->data);
		}
		else
			redirect('admin/login');
	}
	
	public function show_user()
	{
		if($this->session->userdata('admin_email')) {
		$ar= $this->session->all_userdata();
		$values=array();
		$caller=$this->input->post('caller'); 
		$this->data['caller']= $caller;
		$this->data['attribute_search']=$this->Admin_model->SearchUserAttribute($values);
		$this->data['date_from']=trim($this->input->get('date_from'));
		//$this->session->set_userdata('date_from',$this->data['date_from']);
		$this->data['date_end']=trim($this->input->get('date_end'));
		//$this->session->set_userdata('date_end',$this->data['date_end']);
		$this->data['search_text']=trim($this->input->get('search_text'));
		
		$this->data['user_list']=$this->Admin_model->UserList($this->data['date_from'],$this->data['date_end'],$this->data['search_text']);
		$this->data['total_records']=count($this->data['user_list']);
		$this->data['ppr']=20;
		$this->session->set_userdata('ppr',$this->data['ppr']);
		$cp=trim($this->input->get('cp'));
    	if(!empty($cp))
		{
    		$this->data['cp']=$cp;
    		$this->session->set_userdata('cp',$cp);
    	}
		else
		{
			$this->data['cp']=1;
		}
    	$this->data['pagination']=$this->Pagenation($this->data['cp'], $this->data['ppr'],$this->data['total_records']);

		$this->data['user_list']=$this->Admin_model->UserList($this->data['date_from'],$this->data['date_end'],$this->data['search_text'],"limit ".$this->data['pagination']['start_limit'].",".$this->data['pagination']['end_limit']);

		$this->load->view('admin/user_display',$this->data);
		}
		else
			redirect('admin/login');
	}
	
	public function user_edit() {
	   
	   $this->load->model('Admin_model');
	   $this->load->helper('form');
	   $caller=$this->input->post('caller'); 
	   $values=array(); 
	   $this->data['msg']="";
	   $user_ref = $this->uri->segment(3);
	   //$this->session->set_userdata('est_user_ref',$user_ref);
		if ( $user_ref ) 
   			{ 
				$this->data['user'] = $this->Admin_model->GetUserDetail($user_ref);
				$values_profile = $this->data['user'];
				
				if($caller == "User")
				{
					$values['firstname']=trim($this->input->post('firstname'));
					$values['lastname']=trim($this->input->post('lastname'));
					$values['email']=trim($this->input->post('email'));
					$values['gender']=trim($this->input->post('gender'));
					$values['country']=trim($this->input->post('country'));
					$this->load->library('form_validation'); 
				   
					$arrData= array('firstname' => $values['firstname'],
									'lastname' => $values['lastname'],
									'email_id' => $values['email'],
									'gender' => $values['gender'],
									'country' => $values['country'],
									);
									   
					$this->Admin_model->UpdateUserInfo($arrData, $user_ref);		
					
					redirect('admin/user_edit/'.$user_ref.'');
				}
				$this->data['attribute_user']=$this->Admin_model->UserFormAttribute($values,$values_profile);
				
				if($caller == "Send")
				{
					$values['password']=trim($this->input->post('password'));
					$values['re_password']=trim($this->input->post('re_password'));
					$this->load->library('form_validation'); 
					$this->form_validation->set_rules('password','password', 'trim|callback_value_required[password]');	
					$this->form_validation->set_rules('re_password','re password', 'trim|callback_value_required[re_password]');
					if($this->form_validation->run() == TRUE )
					{  
					 if($values['password']==$values['re_password'])
					 {
						$arrData= array('password' =>myencrypt( $values['password'] ));
						$this->Admin_model->UpdateUserPassword($arrData,$user_ref);
						
						$this->data['password']=$values['password'];
						$this->data['re_password']=$values['re_password'];
						$email = $values_profile['email'];
						
						$content = '';
						$content .= '<!DOCTYPE html>';
						$content .= '<html lang="en">';
						$content .= '<head>';
						$content .= '<meta charset="utf-8">';
						$content .= '</head>';
						$content .= '<body style="background:#f0f0f0; margin:0; padding:0;">';
						$content .= '<div style="float:left; width:100%;">';
						$content .= '<div style="width:650px; margin:auto">';
						$content .= '<div style="float:left; width:100%; text-align:center; margin:30px 0 33px 0;"><img src="http://sportshub365.com/images/logo_email.png"></div>';
						$content .= '<div style="background:#fff; width:100%;  box-sizing:border-box; padding:0 10px; float:left;">';
						$content .= '<p style="color:#6f6f6f; font-size:14px; font-family:Arial, Helvetica, sans-serif; margin:0; padding:0 0 30px 0;"><br/>Password successfully changed.</p>';
						$content .= '<p style="color:#6f6f6f; font-family:Arial, Helvetica, sans-serif; font-size:14px; line-height:18px; margin:0; padding:0 0 15px 0;">
		Your new Sportshub365 app password for the account '.$email.' has been set.</p>';
						$content .= '<p style="color:#6f6f6f; font-family:Arial, Helvetica, sans-serif; font-size:14px; line-height:18px; margin:0; padding:0 0 15px 0;">
		You can now access your account with below details. Don\'t forget your login detail!</p>';
						$content .= '<p style="color:#6f6f6f; font-family:Arial, Helvetica, sans-serif; font-size:14px; line-height:18px; margin:0; padding:0 0 15px 0;">
		<strong>Email :</strong> '.$email.'<br/><strong>Password :</strong> '.$values['password'].'</p>';
		
						$content .= '<div style="width:100%; float:left; background:#131e38; height:44px; text-align:center;padding: 10px 0 0;color:#fff; font-family:Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold;">If you have any questions or would like any more information please feel free to contact us at, <br /> <a href="mailto:info@sportshub365.com" style="text-decoration:none; color:#dab503;">info@sportshub365.com</a>&nbsp;&nbsp;&nbsp;Tel: +44 208 705 0525</div>';
						
						$content .= ' </p>';
						$content .= '</div></div></body></html>';
						$to = $email;
						$subject = "New Password - Sportshub365 APP";
					
						$headers = "MIME-Version: 1.0" . "\r\n";
						$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
						$headers .= 'From: Sportshub365<info@sportshub365.com>' . "\r\n";
						$mail_status = mail($to,$subject,$content,$headers);
					  }
					  else $this->data['msg']="Password and retype password must be same.";
					}
				}
				$this->data['attribute']=$this->Admin_model->ChangePasswordUserFormAttribute($values);
				
				$this->load->view('admin/user_edit', $this->data );
			}
		else { 
			redirect('admin/login');
		}	
	}
	
	public function admin_user()
	{
		if($this->session->userdata('admin_email')) {
		$ar= $this->session->all_userdata();
		$values=array();
		$caller=$this->input->post('caller'); 
		$this->data['caller']= $caller;
		$this->data['attribute_search']=$this->Admin_model->SearchUserAttribute($values);
		$this->data['admin_user_list']=$this->Admin_model->AdminUserList($this->data['city'],$this->data['country'],$this->data['search_text']);
		$this->data['total_records']=count($this->data['admin_user_list']);
		$this->data['ppr']=20;
		$cp=trim($this->input->get('cp'));
			if(!empty($cp))
			{
				$this->data['cp']=$cp;
			}
			else { $this->data['cp']=1; }
		
    	$this->data['pagination']=$this->Pagenation($this->data['cp'], $this->data['ppr'],$this->data['total_records']);

		$this->data['admin_user_list']=$this->Admin_model->AdminUserList($this->data['city'],$this->data['country'],$this->data['search_text'],"limit ".$this->data['pagination']['start_limit'].",".
		   $this->data['pagination']['end_limit']);
		$this->data['attribute_newadmin']=$this->Admin_model->AddAdminUserAttribute($values);
		$this->load->view('admin/admin_user',$this->data);
		}
		else
			redirect('admin/login');
	}
	
	public function admin_user_edit() {
	   
	   $this->load->model('Admin_model');
	   $this->load->helper('form');
	   $caller=$this->input->post('caller'); 
	   $values=array(); 
	   $this->data['msg']="";
	   $user_ref = $this->uri->segment(3);
	   //$this->session->set_userdata('est_user_ref',$user_ref);
		if ( $user_ref ) 
   			{ 
				$this->data['admin_user'] = $this->Admin_model->GetAdminUserDetail($user_ref);
				$values_profile = $this->data['admin_user'];
				
				if($caller == "User")
				{
					$values['firstname']=trim($this->input->post('firstname'));
					$values['lastname']=trim($this->input->post('lastname'));
					$values['email']=trim($this->input->post('email'));
					$this->load->library('form_validation'); 
				   
					$arrData= array('first_name' => $values['firstname'],
									'last_name' => $values['lastname'],
									'email' => $values['email'],
									);
									   
					$this->Admin_model->UpdateAdminUserInfo($arrData, $user_ref);		
					
					redirect('admin/admin_user_edit/'.$user_ref.'');
				}
				$this->data['attribute_admin_user']=$this->Admin_model->AdminUserFormAttribute($values,$values_profile);
				
				if($caller == "Send")
				{
					$values['password']=trim($this->input->post('password'));
					$values['re_password']=trim($this->input->post('re_password'));
					$this->load->library('form_validation'); 
					$this->form_validation->set_rules('password','password', 'trim|callback_value_required[password]');	
					$this->form_validation->set_rules('re_password','re password', 'trim|callback_value_required[re_password]');
					if($this->form_validation->run() == TRUE )
					{  
					 if($values['password']==$values['re_password'])
					 {
						$arrData= array('password' =>myencrypt( $values['password'] ));
						$this->Admin_model->UpdateAdminUserPassword($arrData,$user_ref);
						
						$this->data['password']=$values['password'];
						$this->data['re_password']=$values['re_password'];
						$email = $values_profile['email'];
						
						$content = '';
						$content .= '<!DOCTYPE html>';
						$content .= '<html lang="en">';
						$content .= '<head>';
						$content .= '<meta charset="utf-8">';
						$content .= '</head>';
						$content .= '<body style="background:#f0f0f0; margin:0; padding:0;">';
						$content .= '<div style="float:left; width:100%;">';
						$content .= '<div style="width:650px; margin:auto">';
						$content .= '<div style="float:left; width:100%; text-align:center; margin:30px 0 33px 0;"><img src="http://sportshub365.com/images/logo_email.png"></div>';
						$content .= '<div style="background:#fff; width:100%;  box-sizing:border-box; padding:0 10px; float:left;">';
						$content .= '<p style="color:#6f6f6f; font-size:14px; font-family:Arial, Helvetica, sans-serif; margin:0; padding:0 0 30px 0;"><br/>Password successfully changed.</p>';
						$content .= '<p style="color:#6f6f6f; font-family:Arial, Helvetica, sans-serif; font-size:14px; line-height:18px; margin:0; padding:0 0 15px 0;">
		Your new Sportshub365 admin password for the account '.$email.' has been set.</p>';
						$content .= '<p style="color:#6f6f6f; font-family:Arial, Helvetica, sans-serif; font-size:14px; line-height:18px; margin:0; padding:0 0 15px 0;">
		You can now access your account with below details. Don\'t forget your login detail!</p>';
						$content .= '<p style="color:#6f6f6f; font-family:Arial, Helvetica, sans-serif; font-size:14px; line-height:18px; margin:0; padding:0 0 15px 0;">
		<strong>Email :</strong> '.$email.'<br/><strong>Password :</strong> '.$values['password'].'</p>';
		
						$content .= '<div style="width:100%; float:left; background:#131e38; height:44px; text-align:center;padding: 10px 0 0;color:#fff; font-family:Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold;">If you have any questions or would like any more information please feel free to contact us at, <br /> <a href="mailto:info@sportshub365.com" style="text-decoration:none; color:#dab503;">info@sportshub365.com</a>&nbsp;&nbsp;&nbsp;Tel: +44 208 705 0525</div>';
						
						$content .= ' </p>';
						$content .= '</div></div></body></html>';
						$to = $email;
						$subject = "New Password - Sportshub365 APP";
					
						$headers = "MIME-Version: 1.0" . "\r\n";
						$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
						$headers .= 'From: Sportshub365<info@sportshub365.com>' . "\r\n";
						$mail_status = mail($to,$subject,$content,$headers);
					  }
					  else $this->data['msg']="Password and retype password must be same.";
					}
				}
				$this->data['attribute']=$this->Admin_model->ChangePasswordUserFormAttribute($values);
				
				$this->load->view('admin/admin_user_edit', $this->data );
			}
		else { 
			redirect('admin/login');
		}	
	}
	
	public function new_adminuser()
	{
		
	  $est_ref_id = $this->session->userdata('est_user_ref');	
	  $e = $this->session->userdata('admin_email');
	   if ($e)
	   {	
		  $this->load->model('Admin_model');
			   
		   $ar = $this->session->all_userdata();
		   $this->load->helper('form');
		   $caller=$this->input->post('caller'); 
		   $this->data['caller']= $caller;
		   $values=array(); 
		   $values_card=array();
		   $this->data['msg']="";
		   //echo $caller; die;   
		   if($caller == "new_user")
			   {
					$values_est['email']=trim($this->input->post('email'));
					$values_est['password']=trim($this->input->post('password'));
					
					//$this->load->library('form_validation'); 
					//$this->form_validation->set_message('valid_email','Please enter a valid email id');
				    $this->load->library('form_validation'); 
					$this->form_validation->set_rules('email','email', 'trim|callback_value_required[email]');
					$this->form_validation->set_rules('password','password', 'trim|callback_value_required[password]');
					
					    if($this->form_validation->run() == TRUE )// || $this->form_validation->run() == FALSE)
					    {  
						$arrData = array(
							   		'email' => $values_est['email'],
							   		'password' => $values_est['password'] ,
							 	   );		
							   
						    $this->Admin_model->AddNewAdminUser($arrData,'');
						    redirect('admin/admin_user');
						 }
			    }
			$this->data['attribute_newadmin']=$this->Admin_model->AddAdminUserAttribute($values);
			   
			$this->load->view('admin/new-user',$this->data);
		  }
		 else
			redirect('admin/admin_user/');
	}
	
	public function check_email_admin() {
		
	  $email = $this->input->post('email');
	  $res = $this->Admin_model->checkExstingAdminUser($email);  	
	  echo $res; 
	  return $res;
	  
	}
		
	public function display_search_my_tv_fixture()
	{
		if ($this->session->userdata('email'))
		{
			$this->data['active_schedule']='on';
			
			$spt_id=$this->input->get('sport_id');
			$this->session->set_userdata('sport_id',$spt_id);
			//$sport_id=$this->session->flashdata('sport_id');
			$this->data['sport_id']=$this->input->get('sport_id');
			
			$this->data['date_from']=trim($this->input->get('date_from'));
			$this->session->set_userdata('date_from',$this->data['date_from']);
			$this->data['date_end']=trim($this->input->get('date_end'));
			$this->session->set_userdata('date_end',$this->data['date_end']);
			$this->data['search_text']=trim($this->input->get('search_text'));
			$this->session->set_userdata('search_text',$this->data['search_text']);

			$this->data['fixture_list']=$this->Establishment_tv_model->AllFixture($this->data['est_ref_id'],$this->data['sport_id'],
				$this->data['date_from'],$this->data['date_end'],$this->data['search_text']);

			//for pegination
			$this->data['total_records']=count($this->data['fixture_list']);
			$this->data['ppr']=20;
			$this->session->set_userdata('ppr',$this->data['ppr']);
			$cp=trim($this->input->get('cp'));
	    	if(!empty($cp)){
	    		$this->data['cp']=$cp;
	    		$this->session->set_userdata('cp',$cp);
	    	}else{$this->data['cp']=1;}
	    	$this->data['pagination']=$this->Pagenation($this->data['cp'], $this->data['ppr'],$this->data['total_records']);
			$this->data['fixture_list']=$this->Establishment_tv_model->AllFixture($this->data['est_ref_id'],$this->data['sport_id'],$this->data['date_from'],$this->data['date_end'],$this->data['search_text'],"limit ".$this->data['pagination']['start_limit'].",".   $this->data['pagination']['end_limit']);
			$this->load->view('establishment/display-my-tv-schedule',$this->data);
		}
		else
		redirect('establishment/login');
	}

	public function establishments()
	{
		if($this->session->userdata('admin_email')) {
		$ar= $this->session->all_userdata();
		$this->data['delete']=$this->uri->segment(3);
		 $this->data['delete_id']=$this->uri->segment(4);
		if(!empty($this->data['delete']))
		{
			$this->Admin_model->DeleteEstablishmentInfo($this->data['delete_id']);
			redirect('admin/establishments');
		}
	
		$values=array();
		$caller=$this->input->post('caller'); 
		$this->data['caller']= $caller;
		//taking all data from establishment_info table and also join payment and establishment_account_history_table
		$this->data['establishment_list'] = $this->Admin_model->EstablishmentAccountList();
		//echo "<pre>";
		//print_r($this->data['establishment_list']); die;
		
		$this->data['total_records'] = count($this->data['establishment_list']);
		
		$this->data['ppr']=20;
		$cp=1;
    	if(empty($this->data['cp'])){$this->data['cp']=$cp;}else{$this->data['cp']=$this->session->userdata('cp');}
    	$this->data['pagination'] = $this->Pagenation($this->data['cp'], $this->data['ppr'],$this->data['total_records']);
		//echo "<pre>";
		//print_r($this->data['pagination']); die;
		
		$this->data['establishment_list'] = $this->Admin_model->EstablishmentAccountList($this->data['date_from'],$this->data['date_end'],$this->data['search_text'],"limit ".$this->data['pagination']['start_limit'].",".
		   $this->data['pagination']['end_limit']);
		$values = array();
		$this->data['attribute_search']=$this->Admin_model->SearchFormAttribute($values);
		$this->data['attribute_newest']=$this->Admin_model->AddEstablishmentAttribute($values);

			$this->load->view('admin/establishment',$this->data);
		}
		else
			redirect('admin/login');
	}
	
	public function new_establishment()
	{
	  $est_ref_id = $this->session->userdata('est_user_ref');	
	  $e = $this->session->userdata('admin_email');
	   if ($e)
	   {	
		  $this->load->model('Admin_model');
			   
		   $ar = $this->session->all_userdata();
		   $this->load->helper('form');
		   $caller=$this->input->post('caller'); 
		   $this->data['caller']= $caller;
		   $values=array(); 
		   $values_card=array();
		   $this->data['msg']="";
		   //echo $caller; die;   
		   if($caller == "new_est")
			   {
				    $values_est['title']=trim($this->input->post('title'));
					$values_est['email']=trim($this->input->post('email'));
					$values_est['password']=trim($this->input->post('password'));
					
					//$this->load->library('form_validation'); 
					//$this->form_validation->set_message('valid_email','Please enter a valid email id');
				    $this->load->library('form_validation'); 
				    $this->form_validation->set_rules('title','title', 'trim|callback_value_required[title]');	
					$this->form_validation->set_rules('email','email', 'trim|callback_value_required[email]');
					$this->form_validation->set_rules('password','password', 'trim|callback_value_required[password]');
					
					    if($this->form_validation->run() == TRUE )// || $this->form_validation->run() == FALSE)
					    {  
						/*if(strtolower($values_card['description'])=='Description:')$values_card['description']=='';
						if(strtolower($values_card['price_or_discount'])=='Price or discount:')$values_card['price_or_discount']=='';
						if(strtolower($values_card['promo_code'])=='Promo Code:')$values_card['promo_code']=='';*/
						
						$arrData = array(
							   		'title' => $values_est['title'],
							   		'email' => $values_est['email'],
							   		'password' => $values_est['password']);		
							   
						    $this->Admin_model->AddNewEstablishment($arrData,'');
						    redirect('admin/establishments');
						 }
			    }
			$this->data['attribute_newest']=$this->Admin_model->AddEstablishmentAttribute($values);
			   
			$this->load->view('admin/new-establishment',$this->data);
		  }
		 else
			redirect('admin/establishments_edit?id='.$est_user_ref.'');
		}
	
	public function check_email() {
		
	  $email = $this->input->post('email');
	  $res = $this->Admin_model->checkExstingUser($email);  	
	  echo $res; 
	  return $res;
	}
	
	public function establishments_edit_redirect($est_user_ref)	
	{
		 $est_user_ref = $this->uri->segment(3);
		 if($est_user_ref) {
			$this->session->set_userdata('est_user_ref',$est_user_ref); 
			redirect('admin/establishments_edit?id='.$est_user_ref.'');
		 }	
	}
		
	public function establishments_edit()	
	{
	   $this->load->model('Establishment_model');
	   $this->load->model('Admin_model');
	   $this->load->helper('form');
	   $caller=$this->input->post('caller'); 
	   $this->data['form_action']="insert";
	   $values=array(); 
	   $values_upgrade_card=array();
	   $values_card=array();
	   $this->data['msg']="";
	   $this->data['facility_check']=array();
	   $est_user_ref = $this->input->get('id');
	   //$this->session->set_userdata('est_user_ref',$est_user_ref);
	   
	   /*$est_user_ref_ses = $this->session->userdata('est_user_ref');
	   if($est_user_ref_ses == 'images') {
			//$this->session->set_userdata('est_user_ref',$est_user_ref); 
			redirect('admin/establishments_edit?id='.$est_user_ref.'');
		}*/
	  // $this->session->set_userdata('est_user_ref',$est_user_ref);
	 	
		if ( $est_user_ref && $this->session->userdata('admin_email')) 
   			{
			 // $this->data['establishment_id']= $est_ref_id;
			   $this->session->set_userdata('est_user_ref', $est_user_ref);
			   
			   $values_profile=$this->Admin_model->GetProfileDetail($est_user_ref);
			   $this->data['est_user_ref'] = $est_user_ref;
			   $this->data['profile_detail'] = $values_profile;
			   $est_info_id = $this->Admin_model->GetEstInfoId($est_user_ref);
			   
			   $this->data['card_info']=$this->Admin_model->GetEstablishmentCardDetail($est_info_id);
			   
			   $this->data['premium_date']=$this->Admin_model->CheckPremium($est_info_id);
		
			   $facility_constants=$this->Admin_model->GetFacilityConstants();
		
			   $establishment_facilities=$this->Admin_model->GetEstablishmentFacilities($est_info_id);
			   $this->data['opening_hours']=$this->Admin_model->WeekConstantList($est_info_id);
			
			   $this->data['happy_hours']= $this->Admin_model->WeekConstantHappyHours($est_info_id);
			   
			   $this->data['all_offers']=$this->Establishment_model->AllOffer($est_info_id);
			  
			   $offer_id=$this->input->post('offer_id');
			   //$values_card=$this->Establishment_model->GetOfferDetails($offer_id);
			   $est_ref_id = $est_user_ref;
	  		   $countoffer = $this->Establishment_model->countoffer($est_info_id);
			   $this->data['maxcount'] = $countoffer;
			   //events
			   $event_id=$this->input->get('event_id');
			   if(empty($event_id))$event_id=$this->input->post('event_id');
			   $this->data['all_events']=$this->Establishment_model->AllEvents($est_info_id);
			   //$values_card=$this->Establishment_model->GetEventDetails($event_id);
			 	
			   $facilities = array();
		   foreach( $facility_constants as $facility)
			  {

				$fac_id = $facility['id'];
				$fac_type = $facility['type'];
				if( in_array( $fac_id , $establishment_facilities ) )
				{
					if($fac_type =='check')
					$facility['is_checked'] = 'true';
					if($fac_type =='text')
					{
						
					$textval =$this->Admin_model->GetEstablishmentFacilitydetail($est_info_id, $fac_id);
					$facility['is_checked'] = $textval;
					}
				}
				else
				{
					$facility['is_checked'] = 'false';
					if($fac_type =='text')
					{
					$facility['is_checked'] = '';
					}
				}
				$facilities[] = $facility;
			}

		$this->data['facilities'] = $facilities;
		// Opening hours
		if($caller == "OpeningHours")
	  	    {
				$this->load->library('form_validation'); 
				if($this->form_validation->run() == FALSE )
				{  
					$insertRec=array();
				 $opening=array(); 
					foreach($this->data['opening_hours'] as $list)
					{
						$opening[strtolower($list['name']).'_from']=trim($this->input->post(strtolower($list['name']).'_from'));
						$this->data[strtolower($list['name']).'_from']=$opening[strtolower($list['name']).'_from'];
						
						$opening[strtolower($list['name']).'_to']=trim($this->input->post(strtolower($list['name']).'_to'));
						$this->data[strtolower($list['name']).'_to']=$opening[strtolower($list['name']).'_to'];
						//echo $est_info_id;
						//die;
							$insertRec['est_ref']=$est_info_id;
							$insertRec['week_ref']=$list['id'];
							if(!empty($opening[strtolower($list['name']).'_from']))
							{
								$insertRec['from_time']=date('H:i',strtotime($opening[strtolower($list['name']).'_from']));
							}
							else $insertRec['from_time']='';
							if(!empty($opening[strtolower($list['name']).'_to'])) $insertRec['to_time']= date('H:i',strtotime($opening[strtolower($list['name']).'_to']));
						else $insertRec['to_time']='';	
							$this->Admin_model->InsertOpeningHours($insertRec);
					}
					redirect('admin/establishments_edit?id='.$est_user_ref.'');
				}
			}
		// happy hours	
		  if($caller == "HappyHours")
		  	{			
				$this->load->library('form_validation'); 
				if($this->form_validation->run() == FALSE )
				{  
					$insertRecHappy=array();
					$happyHours=array();
				 
					foreach($this->data['happy_hours'] as $list)
					{
						$happyHours[strtolower($list['name']).'_frm']=trim($this->input->post(strtolower($list['name']).'_frm'));
						$happyHours[strtolower($list['name']).'_t']=trim($this->input->post(strtolower($list['name']).'_t'));
						$happyHours[strtolower($list['name']).'_is_active']=trim($this->input->post(strtolower($list['name']).'_is_active'));
						
							$insertRecHappy['est_ref']=$est_info_id;
							$insertRecHappy['week_ref']=$list['id'];
							if(!empty($happyHours[strtolower($list['name']).'_frm']))
							{
								$insertRecHappy['from_time']=date('H:i',strtotime($happyHours[strtolower($list['name']).'_frm']));
							}
							else $insertRecHappy['from_time']='';
	
							if(!empty($happyHours[strtolower($list['name']).'_t'])) $insertRecHappy['to_time']= date('H:i',strtotime($happyHours[strtolower($list['name']).'_t']));
							else $insertRecHappy['to_time']='';
	
							if(!empty($happyHours[strtolower($list['name']).'_is_active'])) $insertRecHappy['is_active']= $happyHours[strtolower($list['name']).'_is_active'];
							else $insertRecHappy['is_active']='0';
							
							$this->Admin_model->InsertHappyHours($insertRecHappy);
					}
					redirect('admin/establishments_edit?id='.$est_user_ref.'');
				}
			}
			else
			{
			}	
	//password save	
	$this->data['msg_email'] = '';
	$email=$this->Admin_model->GetUseremail($est_user_ref);
	$email_id = $email[0]->email;
	$this->data['email_id'] = $email_id;
	if($caller == "Send")
	   	{
			$values['email']=trim($this->input->post('email'));
			$values['password']=trim($this->input->post('password'));
			$values['re_password']=trim($this->input->post('re_password'));
		    $this->load->library('form_validation'); 
			$this->form_validation->set_message('valid_email','Please enter a valid email id');
			$this->form_validation->set_rules('email','email', 'trim|callback_value_required[email]|valid_email');	
		    //$this->form_validation->set_rules('password','password', 'trim|callback_value_required[password]');	
			//$this->form_validation->set_rules('re_password','re password', 'trim|callback_value_required[re_password]');
			
		    if($this->form_validation->run() == TRUE )
		    {  
			 
			 if($values['email']!=$email_id) {
				$EmailData = array('email' => $values['email']); 
				$this->data['msg_email'] = $this->Admin_model->UpdateEmail($EmailData,$est_user_ref);
				//$this->session->set_userdata($EmailData);
				//$this->session->set_userdata('email',$values['email']);
			 }
			 
			 if($values['password']==$values['re_password'])
			 {
				if($values['password']!='') {
					$arrData= array('password' =>myencrypt( $values['password'] ));
					$this->Admin_model->UpdateSubscription($arrData,$est_user_ref);
					//$this->session->set_userdata($arrData);
					//$this->session->set_userdata('password',myencrypt($values['password']));
					$this->data['msg']="Password changed sucessfully";
				}
			  }
			  else { $this->data['msg']="Password and retype password must be same."; }
			  
			  $this->data['email']=$values['email'];
			  $this->data['password']=$values['password'];
			  $this->data['re_password']=$values['re_password'];
			 }
			 $email_id = $values['email'];
			 $this->data['email_id'] = $email_id;
		}
		$this->data['attribute']=$this->Admin_model->ChangePasswordFormAttribute($values, $email_id);
		
		//facility 
		if($caller == "facility")
		{
			$this->data['facility']=$this->input->post('facility');
			$screens = $this->input->post('Screens');
			$capacity = $this->input->post('Capacity');
			$est_info_id = $this->Admin_model->GetEstInfoId($est_user_ref);
			$i=0;
			foreach($this->data['facility'] as $selected)
			{
				$rec[] = array(
								'est_ref'=> $est_info_id,
								'est_facility_ref'=>$selected,
								'value' => ''
								);
				$i++;
			}
			if($screens != '')
			{$rec[] = array(
								'est_ref'=> $est_info_id,
								'est_facility_ref'=>'13',
								'value' => $screens
								);
			}
			if($capacity != '')
			{$rec[] = array(
								'est_ref'=> $est_info_id,
								'est_facility_ref'=>'16',
								'value' => $capacity
								);
			}
			$this->Admin_model->InsertFacility($rec,$est_info_id);
		
			redirect('admin/establishments_edit?id='.$est_user_ref.'');

	 }
	 // profile update
	   	if($caller == "Profile")
	   	{
			$values['title']=trim($this->input->post('title'));
			$values['address']=trim($this->input->post('address'));
			$values['city']=trim($this->input->post('city'));
			$values['zip']=trim($this->input->post('zip'));
			$lat=trim($this->input->post('geo_lat'));
			$long=trim($this->input->post('geo_lang'));
			$values['short_description']=trim($this->input->post('short_description'));
		    $this->load->library('form_validation'); 
		   
		    $address = $values['address'];
		   	$address = str_replace(" ", "+", $address);

			$arrData= array('title' => $values['title'] ,'address' => $values['address'],
				'city' => $values['city'],
				'zip' => $values['zip'],
				'short_description' => $values['short_description'],
				'geo_lat' => $lat,
				'geo_lang' => $long);
							   
			    $this->Admin_model->UpdateProfileInfo($arrData,$est_user_ref);		
				redirect('admin/establishments_edit?id='.$est_user_ref.'');
		}
		$this->data['attribute_profile']=$this->Admin_model->ProfileFormAttribute($values,$values_profile);
		
		//code for card details
		$values_card=$this->Admin_model->GetCardDetail($est_user_ref);
		$values_upload=array();
		$values_upload['current_picture']=$this->Admin_model->GetProDefaultPic($est_info_id);
	
		//image upload	
		if($caller == "Upload")
		{
			$this->load->library('form_validation'); 
			$path_to_upload="./images/profile/";
			if(!empty($_FILES['picture']['name']))
			{
				// list of argument for image validation array
				// 1.file_name,2.path_to_upload,3.image_index,4.max_width,5.max_height,6.fixed_width,7.fixed_height,8.max_size
				$picture_info=array("picture",$path_to_upload,"picture","","","","",'');
				$picture_info_string=implode("~",$picture_info);
				$this->form_validation->set_rules('picture', 'Profile Picture', "callback_image_validation[{$picture_info_string}]");
			}
			if($this->form_validation->run() == FALSE)
			{  
				if(!empty($this->uploading_image_info['picture']['file_name']))
				{
				 unlink($path_to_upload.$this->uploading_image_info['picture']['file_name']);
				 $error=true;
				}
			}
			else
			{
				$arrData=array();
				if(!empty($_FILES['picture']['name']) or !empty($values_upload['current_picture']))
				{
				 // delete previous image
				 unlink($path_to_upload.$values_upload['current_picture']);
					$arrData['picture']=$this->uploading_image_info['picture']['file_name'];
				}
				$this->Admin_model->UpdateProfilePicture($arrData,$est_ref_id);
	
				 redirect('admin/establishments_edit?id='.$est_user_ref.'');		     
			}
	  	}
	   $this->data['attribute_upload'] = $this->Admin_model->UploadFormAttribute($values_upload);
	   
	   if($caller == "Update Card")
	   {
		    $values_card['first_name']=trim($this->input->post('first_name'));
			$values_card['last_name']=trim($this->input->post('last_name'));
			$values_card['card_number']=trim($this->input->post('card_number'));
			$values_card['exp_month']=trim($this->input->post('exp_month'));
			$values_card['exp_year']=trim($this->input->post('exp_year'));
			$values_card['code']=trim($this->input->post('code'));

		    $this->load->library('form_validation'); 
			$this->form_validation->set_message('valid_email','Please enter a valid email id');
		   
		    $this->form_validation->set_rules('first_name','first name', 'trim|callback_value_required[first_name]');	
			$this->form_validation->set_rules('card_number','rcard number', 'trim|callback_value_required[card_number]');
			$this->form_validation->set_rules('exp_month','expiry month', 'trim|callback_value_required[exp_month]');
			$this->form_validation->set_rules('exp_year','expiry year', 'trim|callback_value_required[exp_year]');
			$this->form_validation->set_rules('code','code', 'trim|callback_value_required[code]');

		    if($this->form_validation->run() == TRUE )
		    {  
				$arrData= array(
				   'establishment_ref' => $est_ref_id,
				   'first_name' => $values_card['first_name'],
				   'last_name' => $values_card['last_name'] ,
				   'card_number' => $values_card['card_number'] ,
				   'exp_month' =>$values_card['exp_month'] ,
				   'exp_year' =>$values_card['exp_year'] ,
				   'code' => $values_card['code'] ,
				   'est_user_ref' => $est_ref_id
					   
				 );			     
			    $this->Admin_model->UpdateCardDetail($arrData,$est_ref_id);
			 }
		   }
		   
		   $this->data['attribute_update_card']=$this->Admin_model->UpdateCardFormAttribute($values_card);
		   
  		// code for upgrade card
		 //code for card details
	   $values_upgrade_card = $this->Admin_model->GetCardDetailForUpgrade($est_user_ref);
	   if($caller == "Upgrade Card")
	   {		   
		    $values_upgrade_card['first_name']=trim($this->input->post('first_name'));
			$values_upgrade_card['last_name']=trim($this->input->post('last_name'));
			$values_upgrade_card['card_number']=trim($this->input->post('card_number'));
			$values_upgrade_card['exp_month']=trim($this->input->post('exp_month'));
			$values_upgrade_card['exp_year']=trim($this->input->post('exp_year'));
			$values_upgrade_card['code']=trim($this->input->post('code'));

		    $this->load->library('form_validation'); 
		   
		    $this->form_validation->set_rules('first_name','first name', 'trim|callback_value_required[first_name]');	
			$this->form_validation->set_rules('card_number','rcard number', 'trim|callback_value_required[card_number]');
			$this->form_validation->set_rules('exp_month','expiry month', 'trim|callback_value_required[exp_month]');
			$this->form_validation->set_rules('exp_year','expiry year', 'trim|callback_value_required[exp_year]');
			$this->form_validation->set_rules('code','code', 'trim|callback_value_required[code]');
			//echo validation_errors();
		    if($this->form_validation->run() == TRUE )
		    {  
			//print_r($values_upgrade_card);
				$arrData= array(
				   'establishment_ref' => $est_ref_id,
				   'first_name' => $values_upgrade_card['first_name'],
				   'last_name' => $values_upgrade_card['last_name'] ,
				   'card_number' => $values_upgrade_card['card_number'] ,
				   'exp_month' =>$values_upgrade_card['exp_month'] ,
				   'exp_year' =>$values_upgrade_card['exp_year'] ,
				   'code' => $values_upgrade_card['code'] ,
				   'est_user_ref' => $est_ref_id
				 );	

				$this->session->set_userdata($arrData);
				 redirect('establishment/redirect_to_payment');		     
			    $this->Admin_model->UpdateCardDetail($arrData,$est_ref_id);
			 }
		   }
	    $this->data['attribute_upgrade_card']=$this->Admin_model->UpgradeCardFormAttribute($values_upgrade_card);	
		
		if($caller == "Offer")
			   {
				    $values_card['title']=trim($this->input->post('title'));
					$values_card['description']=trim($this->input->post('description'));
					$values_card['price_or_discount']=trim($this->input->post('price_or_discount'));
					$values_card['promo_code']=trim($this->input->post('promo_code'));
					$values_card['isactive']=trim($this->input->post('isactive',TRUE));
					
				    $this->load->library('form_validation'); 
				    $this->form_validation->set_rules('title','title', 'trim|callback_value_required[title]');	
					//$this->form_validation->set_rules('description','description', 'trim|callback_value_required[description]');
					$this->form_validation->set_rules('price_or_discount','price or discount', 'trim|callback_value_required[price_or_discount]');
					
					    if($this->form_validation->run() == TRUE )// || $this->form_validation->run() == FALSE)
					    {  
						if($values_card['isactive']=='') $values_card['isactive']='0';
						if(strtolower($values_card['description'])=='Description:')$values_card['description']=='';
						if(strtolower($values_card['price_or_discount'])=='Price or discount:')$values_card['price_or_discount']=='';
						if(strtolower($values_card['promo_code'])=='Promo Code:')$values_card['promo_code']=='';
						$arrData= array(
							   'est_ref' => $est_info_id,
							   'title' => $values_card['title'],
							   'description' => $values_card['description'] ,
							   'price_or_discount' => $values_card['price_or_discount'] ,
							   'promo_code' => $values_card['promo_code'] ,
							   'isactive' => $values_card['isactive']
								   
							 );		
						    $this->Establishment_model->AddOffer($arrData,'');
						    redirect('establishment/offers');
						 }
			    }
			  
			   $this->data['attribute_offer']=$this->Admin_model->AddOfferFormAttribute($values_card);
			   
			 if($caller == "Event")
			   {
				   
				    $values_card['title']=trim($this->input->post('title'));
					$values_card['event_date']=trim($this->input->post('event_date'));
					$values_card['event_time']=trim($this->input->post('event_time'));
					$values_card['duration']=trim($this->input->post('duration'));
					
				    $this->load->library('form_validation'); 

					$this->form_validation->set_message('valid_email','Please enter a valid email id');
				   
				    $this->form_validation->set_rules('title','title', 'trim|callback_value_required[title]');	
					$this->form_validation->set_rules('event_date','event date', 'trim|callback_value_required[event_date]');
					$this->form_validation->set_rules('event_time','event time', 'trim|callback_value_required[event_time]');
					$this->form_validation->set_rules('duration','duration', 'trim|callback_value_required[duration]');
					
					    if($this->form_validation->run() == TRUE )// || $this->form_validation->run() == FALSE)
					    {  
						$eventdat = explode("-",$values_card['event_date']);
						$eventdate = $eventdat[2]."-".$eventdat[1]."-".$eventdat[0];
						//$st=str_replace("/","-", $values_card['event_date']);
							$arrData= array(
							   'est_ref' => $est_info_id,
							   'title' => $values_card['title'],
							   'date' => $eventdate,
							   'time' => $values_card['event_time'] ,
							   'duration' =>$values_card['duration'] 
							 );			     
						    $this->Establishment_model->AddEvent($arrData,'');
						    redirect('establishment/events');
					 }
			    } 
				$this->data['attribute_event']=$this->Establishment_model->AddEventFormAttribute($values_card); 
			
		$this->load->view('admin/establishments_edit', $this->data);
			}
		else
		{
			redirect('admin/login');
		}
}
  
  public function display_offer()
	{
	  if($this->session->userdata('admin_email')) {
	  
	  $est_ref_id = $this->session->userdata('est_user_ref');	
	   if ($est_ref_id)
	   {	
		  $this->load->model('Establishment_model');
		   $offer_id=$this->input->get('offer_id');
		   if(empty($offer_id))$offer_id=$this->input->post('offer_id');
		   //echo $offer_id; exit;
			   $ar= $this->session->all_userdata();
			   $this->load->helper('form');
			   $this->data['offer_id']=$offer_id;
			   $this->data['form_action']="update";
			   $caller=$this->input->post('caller'); 
			   $this->data['caller']= $caller;
			   $values=array(); 
			   $values_card=array();
			   $this->data['msg']="";
			  // $e=$this->session->userdata('email');
			   //$user_id=$this->Establishment_model->GetUserId($e);
			   $values_card=$this->Establishment_model->GetOfferDetails($offer_id);
			   $this->data['isactive']=$values_card['isactive'];
			   //print_r($values_card);
				 $est_ref_id=$est_ref_id;
				 $est_info_id = $this->Admin_model->GetEstInfoId($est_ref_id);
		   if(!empty($offer_id)){
				   if($caller == "Offer")
				   {
						$values_card['title']=trim($this->input->post('title'));
						$values_card['description']=trim($this->input->post('description'));
						$values_card['price_or_discount']=trim($this->input->post('price_or_discount'));
						$values_card['promo_code']=trim($this->input->post('promo_code'));
						$values_card['isactive']=trim($this->input->post('isactive'));
						
						$this->load->library('form_validation'); 
					   
						$this->form_validation->set_rules('title','title', 'trim|callback_value_required[title]');	
						//$this->form_validation->set_rules('description','description', 'trim|callback_value_required[description]');
						//$this->form_validation->set_rules('price_or_discount','price or discount', 'trim|callback_value_required[price_or_discount]');
						
							if($this->form_validation->run() == TRUE )// || $this->form_validation->run() == FALSE)
							{  
							if($values_card['isactive']=='') $values_card['isactive']='0';
								$arrData= array(
								   'est_ref' => $est_info_id,
								   'title' => $values_card['title'],
								   'description' => $values_card['description'] ,
								   'price_or_discount' => $values_card['price_or_discount'],
								   'promo_code' => $values_card['promo_code'],
								   'isactive' => $values_card['isactive'],
								   'deleted_on'=>NULL 
								 );	
								// print_r($arrData);	    
								 // $offer_id=$this->input->post('offer_id');	
								// echo "ssdsd".$offer_id;exit;
								$this->Establishment_model->AddOffer($arrData,$offer_id);
								
								redirect('admin/establishments_edit?id='.$est_ref_id.'');
							 }
					}
		   }else{
			   $ar= $this->session->all_userdata();
			   $this->load->helper('form');
			   $this->data['form_action']="insert";
			   $caller=$this->input->post('caller'); 
			   $this->data['caller']= $caller;
			   $values=array(); 
			   $values_card=array();
			   $this->data['msg']="";
			   //$e=$this->session->userdata('email');
			  // $user_id=$this->Establishment_model->GetUserId($e);
			   //$values_card=$this->Establishment_model->GetOfferDetails($offer_id);
			   //print_r($values_card);
				 $est_ref_id=$est_ref_id;
				 $est_info_id = $this->Admin_model->GetEstInfoId($est_ref_id);
				   if($caller == "Offer")
				   {
						$values_card['title']=trim($this->input->post('title'));
						$values_card['description']=trim($this->input->post('description'));
						$values_card['price_or_discount']=trim($this->input->post('price_or_discount'));
						$values_card['promo_code']=trim($this->input->post('promo_code'));
						$values_card['isactive']=trim($this->input->post('isactive'));
						
						$this->load->library('form_validation'); 
					   
						$this->form_validation->set_rules('title','title', 'trim|callback_value_required[title]');	
						//$this->form_validation->set_rules('description','description', 'trim|callback_value_required[description]');
						//$this->form_validation->set_rules('price_or_discount','price or discount', 'trim|callback_value_required[price_or_discount]');
						
							if($this->form_validation->run() == TRUE )// || $this->form_validation->run() == FALSE)
								{  
								if($values_card['isactive']=='') $values_card['isactive']='0';
								if(strtolower($values_card['description'])=='Description:')$values_card['description']=='';
								if(strtolower($values_card['price_or_discount'])=='Price or discount:')$values_card['price_or_discount']=='';
								if(strtolower($values_card['promo_code'])=='Promo Code:')$values_card['promo_code']=='';
								$arrData= array(
									   'est_ref' => $est_info_id,
									   'title' => $values_card['title'],
									   'description' => $values_card['description'] ,
									   'price_or_discount' => $values_card['price_or_discount'] ,
									   'promo_code' => $values_card['promo_code'] ,
									   'isactive' => $values_card['isactive']
										   
									 );		
									$this->Establishment_model->AddOffer($arrData,'');
									
									redirect('admin/establishments_edit?id='.$est_ref_id.'');
								 }
					}
		   }
			$this->data['attribute_offer']=$this->Admin_model->AddOfferFormAttribute($values_card);
			
            $this->load->view('admin/add-offer',$this->data);
			
		  }
		 else
			redirect('admin/establishments_edit?id='.$est_user_ref.'');
		}
		else {
			redirect('admin/login');
		}
	}
  
  public function display_event()
	{
	   if($this->session->userdata('admin_email')) {
	   $est_ref_id = $this->session->userdata('est_user_ref');
	   if ($est_ref_id)
	   {	
		   $this->load->model('Establishment_model');
		   $this->load->helper('form');
		   $this->data['form_action']="update";

		   $ar= $this->session->all_userdata();
		   $event_id=$this->input->get('event_id');
			if(empty($event_id))$event_id=$this->input->post('event_id');
			//echo $event_id; die;
			if(!empty($event_id)){
				   $this->data['event_id']=$event_id;
		
				   $this->load->helper('form');
				   $caller=$this->input->post('caller'); 
				   $this->data['caller']= $caller;
				   $values=array(); 
				   $values_card=array();
				   $this->data['msg']="";
				   $this->data['facility_check']=array();
				   //$e=$this->session->userdata('email');
				   //$user_id=$this->Establishment_model->GetUserId($e);
		
				   //$est_ref_id=$user_id[0]->id;
				  $est_info_id = $this->Admin_model->GetEstInfoId($est_ref_id);
				   //echo $est_info_id; die;
				  // $this->data['all_events']=$this->Establishment_model->AllEvents($est_info_id);
				  
				   $values_card=$this->Establishment_model->GetEventDetails($event_id);
				  // print_r($values_card);
				   //$est_ref_id=$user_id[0]->id;
					   if($caller == "Event")
					   {
							$values_card['title']=trim($this->input->post('title'));
							$values_card['event_date']=trim($this->input->post('event_date'));
							$values_card['event_time']=trim($this->input->post('event_time'));
							$values_card['duration']=trim($this->input->post('duration'));
							
							$this->load->library('form_validation'); 
		
							$this->form_validation->set_message('valid_email','Please enter a valid email id');
						   
							$this->form_validation->set_rules('title','title', 'trim|callback_value_required[title]');	
							$this->form_validation->set_rules('event_date','event date', 'trim|callback_value_required[event_date]');
							$this->form_validation->set_rules('event_time','event time', 'trim|callback_value_required[event_time]');
							$this->form_validation->set_rules('duration','duration', 'trim|callback_value_required[duration]');
							
								if($this->form_validation->run() == TRUE )
								{  
									$eventdat = explode("-",$values_card['event_date']);
									$eventdate = $eventdat[2]."-".$eventdat[1]."-".$eventdat[0];
									$arrData= array(
									   'est_ref' => $est_info_id,
									   'title' => $values_card['title'],
									   'date' => $eventdate,
									   'time' => $values_card['event_time'] ,
									   'duration' =>$values_card['duration'] ,
									   'deleted_on'=>NULL
									 );	
									 $event_id=$this->input->post('event_id');		     
									$this->Establishment_model->AddEvent($arrData,$event_id);
									redirect('admin/establishments_edit?id='.$est_ref_id.'');
		
								 }
						}
					}
			else{
				   $this->load->helper('form');
				   $caller=$this->input->post('caller'); 
				   $this->data['caller']= $caller;
				   $this->data['form_action']="insert";
				   $values=array(); 
				   $values_card=array();
				   $this->data['msg']="";
				   $this->data['facility_check']=array();
				   //$e=$this->session->userdata('email');
				   //$user_id=$this->Establishment_model->GetUserId($e);
		
				   //$est_ref_id=$user_id[0]->id;
				   $est_info_id = $this->Admin_model->GetEstInfoId($est_ref_id);
				   //$this->data['all_events']=$this->Establishment_model->AllEvents($est_info_id);
				  
				   //$values_card=$this->Establishment_model->GetEventDetails($event_id);
				  // print_r($values_card);
				  // $est_ref_id=$user_id[0]->id;
					   if($caller == "Event")
					   {
							$values_card['title']=trim($this->input->post('title'));
							$values_card['event_date']=trim($this->input->post('event_date'));
							$values_card['event_time']=trim($this->input->post('event_time'));
							$values_card['duration']=trim($this->input->post('duration'));
							
							
							$this->load->library('form_validation'); 
		
							//$this->form_validation->set_message('valid_email','Please enter a valid email id');
						   
							$this->form_validation->set_rules('title','title', 'trim|callback_value_required[title]');	
							$this->form_validation->set_rules('event_date','event date', 'trim|callback_value_required[event_date]');
							$this->form_validation->set_rules('event_time','event time', 'trim|callback_value_required[event_time]');
							$this->form_validation->set_rules('duration','duration', 'trim|callback_value_required[duration]');
							
								if($this->form_validation->run() == TRUE )
								{  
									$eventdat = explode("-",$values_card['event_date']);
									$eventdate = $eventdat[2]."-".$eventdat[1]."-".$eventdat[0];
									$arrData= array(
									   'est_ref' => $est_info_id,
									   'title' => $values_card['title'],
									   'date' => $eventdate,
									   'time' => $values_card['event_time'] ,
									   'duration' =>$values_card['duration'] ,
									   'deleted_on'=>NULL
										   
									 );	
									 $event_id=$this->input->post('event_id');		
									//echo "<pre>";     
									$this->Establishment_model->AddEvent($arrData,$event_id);
									redirect('admin/establishments_edit?id='.$est_ref_id.'');
		
								 }
					
						}
			}
			  
			$this->data['attribute_event']=$this->Admin_model->AddEventFormAttribute($values_card);
			
            $this->load->view('admin/add-event',$this->data);
		  }
		 else
			redirect('admin/establishments_edit?id='.$est_user_ref.'');
	   }
	   else {
		  	redirect('admin/login');
		  }
	}
	
   public function delete_event($id)
	 {
	   if($this->session->userdata('admin_email')) {
		   $est_ref_id = $this->session->userdata('est_user_ref');
		   $this->load->model('Establishment_model');
		   $this->Establishment_model->DeleteEvent($id);
		   redirect('admin/establishments_edit?id='.$est_ref_id.'');
	   }
	   else {
		 redirect('admin/login');
	   }
  }
	 
  public function delete_offer($id)
	{
		 if($this->session->userdata('admin_email')) { 
			 $est_ref_id = $this->session->userdata('est_user_ref');
			 
			 $this->load->model('Establishment_model');
			 $this->Establishment_model->DeleteOffer($id);
			 redirect('admin/establishments_edit?id='.$est_ref_id.'');
		 }
	   else {
		 redirect('admin/login');
	   }
   }

public function establishment_image_redirect()
{
	$est_user_ref = $this->session->userdata('est_user_ref');
	//echo $est_user_ref; die;
	if($est_user_ref=='images')
	{
		//$this->session->unset_userdata('est_user_ref');
		redirect('admin/establishments');	
	}
	else {
		redirect('admin/establishment_image?id='.$est_user_ref.'');	
	}
}

public function establishment_image()
{
	
	if($this->session->userdata('admin_email')) {
		
	$est_user_ref = $this->input->get('id');;
	 $this->data['est_user_ref'] = $est_user_ref;
	if ($est_user_ref) {
		   $this->load->model('Admin_model');
		   $this->load->helper('form');
		   $caller=$this->input->post('caller'); 
		   $values=array(); 
		   $values_upgrade_card=array();
		   $values_card=array();
		   $this->data['msg']="";
		   $this->data['facility_check']=array();
		   //$est_user_ref = $this->uri->segment(3);
		  
		 // echo $est_user_ref;
        //echo $this->session->userdata('est_info_id');
								    // die;
		//print_r($this->data['card_info']);
	   // checking for user email is subscribed or not
	   $facilities = array();
		
	   	$this->data['facilities'] = $facilities;
        $est_info_id = $this->Admin_model->GetEstInfoId($est_user_ref);
        
        $this->session->set_userdata('est_info_id',$est_info_id);
        $this->session->set_userdata('est_user_ref',$est_user_ref);
        //echo $this->session->userdata('est_info_id');
         //echo $this->session->userdata('est_user_ref'); 
        // die;
       /* if (session_status() == PHP_SESSION_NONE) {*/
 		   session_start();
		/*}*/
		$_SESSION["est_info_id"] = $est_info_id;
		//$_SESSION["est_user_ref"] = $est_user_ref;
        //print_r($_SESSION); //die;
		//exit;
		//code for card details
		if($caller == "ProfileGallery")
		{
			$defaultim=$this->input->post('defaultimage');
		//print_r($defaultim);
		//die;
			//die;	
			if($defaultim)
			{
				$updateGallery= $this->Admin_model->upgateGallery($est_info_id, $defaultim);
				echo $updateGallery;
		    }
		    else echo 0;
			redirect('admin/establishments_edit?id='.$est_user_ref.'');		  
					
	  	}
			//$profileGallery = array();
			$profileGallery = $this->Admin_model->getProfileGallery($est_info_id);
	   		$this->data['profileGallery'] = $profileGallery;
			$this->load->view('admin/establishment_image',$this->data);
		}
		else {
			redirect('admin/establishments');
		}
	}
	else {
		redirect('admin/login');
	}
}

public function remove_gallery_image()
	{
	  // $this->load->model('Admin_model');
	   $email = "hi";
	   if ($email) {
		   //$ar= $this->session->all_userdata();
		    $this->load->model('Admin_model');
	      						   $this->load->helper('form');
								   $caller=$this->input->post('caller'); 
								   $values=array(); 
								   $values_upgrade_card=array();
								   $values_card=array();
								   $this->data['msg']="";
								   $this->data['facility_check']=array();
								   $est_user_ref = $this->session->userdata('est_user_ref');
								  // echo $est_user_ref;
								   //die;
								   //$est_user_ref = $this->uri->segment(3);

		                           $values_profile=$this->Admin_model->GetProfileDetail($est_user_ref);
								   $this->data['profile_detail'] = $values_profile;
								   $est_info_id = $this->Admin_model->GetEstInfoId($est_user_ref);
		  					
		  							if($caller == "delete"){
				$proImageId = $this->input->post('imageId');
				if($proImageId){
					$removeres = $this->Admin_model->removeGalleryImage($proImageId, $est_info_id);	
					echo $removeres;
				}
			}
			else echo 0;
	   }
		else
		{
			//redirect('establishment/login');
			echo "redirected";
		}
	}

	public function update_gallery_image()
	{
	  // $this->load->model('Admin_model');
	   $email = "hi";
	   if ($caller=$this->input->post('caller')) {
		   //$ar= $this->session->all_userdata();
		    $this->load->model('Admin_model');
		   $this->load->helper('form');
		   $caller=$this->input->post('caller'); 
		   $values=array(); 
		   $values_upgrade_card=array();
		   $values_card=array();
		   $this->data['msg']="";
		   $this->data['facility_check']=array();
		   $est_user_ref = $this->session->userdata('est_user_ref');
		   echo $est_user_ref;
		   //die;
		   //$est_user_ref = $this->uri->segment(3);

		   $values_profile=$this->Admin_model->GetProfileDetail($est_user_ref);
		   $this->data['profile_detail'] = $values_profile;
		   $est_info_id = $this->Admin_model->GetEstInfoId($est_user_ref);
		// echo $caller;die;
		if($caller == "ProfileGallery")
		{
			
			$defaultim=$this->input->post('defaultimage');
		//print_r($defaultim);
		//die;
			//die;	
			if($defaultim)
			{
				$updateGallery= $this->Admin_model->upgateGallery($est_info_id, $defaultim);
				echo $updateGallery;
			}
			else
			{
			 echo 0;
			}
		}
		else
		{
		echo "redirected";
		}
		
			}
		else
			{
				//redirect('establishment/login');
				echo "redirected";
			}
}


	public function matches()
	{
		if($this->session->userdata('admin_email')) {
		$ar= $this->session->all_userdata();		
				
		$this->data['sport_list']=$this->Establishment_model->AllSport();
		$this->data['fixture_list_count']=$this->Establishment_model->TotalFixtureCount('',$this->data['sport_id'],'',$this->data['date_from'],$this->data['date_end'],$this->data['search_text']);
		
		$caller=$this->input->post('caller'); 
		$this->data['caller']= $caller;
		$values=array(); 
		//$this->data['channel_search_text']="Search";
	
		$this->data['attribute_search']=$this->Establishment_model->SearchFormAttribute($values);
		
   		$this->data['total_records']=$this->data['fixture_list_count'];
		
		$this->data['ppr']=20;
		$cp=1;
    	if(empty($this->data['cp'])){$this->data['cp']=$cp;}else{$this->data['cp']=$this->session->userdata('cp');}
    	$this->data['pagination']=$this->Pagenation($this->data['cp'], $this->data['ppr'],$this->data['total_records']);
		
		$this->data['fixture_list']=$this->Establishment_model->AllFixture('',$this->data['sport_id'],'',$this->data['date_from'],$this->data['date_end'],$this->data['search_text'],"limit ".$this->data['pagination']['start_limit'].",".
		$this->data['pagination']['end_limit']);
		$this->load->view('admin/matches',$this->data);
		}
		else
			redirect('admin/login');
	}

	public function display_search_fixture()
	{
		if ($this->session->userdata('admin_email')) {
		$this->data['active_schedule']='on';
		$spt_id=$this->input->get('sport_id');
		$this->session->set_userdata('sport_id',$spt_id);
		//$sport_id=$this->session->flashdata('sport_id');
		$this->data['sport_id']=$this->input->get('sport_id');
		$this->data['date_from']=trim($this->input->get('date_from'));
		$this->session->set_userdata('date_from',$this->data['date_from']);
		$this->data['date_end']=trim($this->input->get('date_end'));
		$this->session->set_userdata('date_end',$this->data['date_end']);
		$this->data['search_text']=trim($this->input->get('search_text'));
		$this->session->set_userdata('search_text',$this->data['search_text']);

		$this->data['fixture_list_count']=$this->Establishment_model->TotalFixtureCount('',$this->data['sport_id'],
			'',$this->data['date_from'],$this->data['date_end'],$this->data['search_text']);

		//for pegination
		$this->data['total_records']=$this->data['fixture_list_count'];
		$this->data['ppr']=20;
		$this->session->set_userdata('ppr',$this->data['ppr']);
		$cp=trim($this->input->get('cp'));
    	if(!empty($cp)){
    		$this->data['cp']=$cp;
    		$this->session->set_userdata('cp',$cp);
    	}else{$this->data['cp']=1;}
    	$this->data['pagination']=$this->Pagenation($this->data['cp'], $this->data['ppr'],$this->data['total_records']);
		$this->data['fixture_list']=$this->Establishment_model->AllFixture('',$this->data['sport_id'],'',$this->data['date_from'],$this->data['date_end'],$this->data['search_text'],"limit ".$this->data['pagination']['start_limit'].",".   $this->data['pagination']['end_limit']
);
		
		$this->load->view('admin/display-fixture',$this->data);
	}
		else
		redirect('admin/login');
	}
	
	 public function delete($id)
	 {
	   $this->Establishment_model->DeleteFixture($id);
	   redirect('admin/matches');
	 }
	 
 	public function show_admin_page()
	{
		if ($this->session->userdata('admin_email')) 
		{
			//echo "test"; die;
		$this->data['active_schedule']='on';
		//$spt_id=$this->input->get('sport_id');
		//$this->session->set_userdata('sport_id',$spt_id);
		//$sport_id=$this->session->flashdata('sport_id');
		//$this->data['sport_id']=$this->input->get('sport_id');
		$this->data['date_from']=trim($this->input->get('date_from'));
		//$this->session->set_userdata('date_from',$this->data['date_from']);
		$this->data['date_end']=trim($this->input->get('date_end'));
		//$this->session->set_userdata('date_end',$this->data['date_end']);
		$this->data['search_text']=trim($this->input->get('search_text'));
		//$this->session->set_userdata('search_text',$this->data['search_text']);

		$this->data['establishment_list']=$this->Admin_model->EstablishmentAccountList($this->data['date_from'],$this->data['date_end'],$this->data['search_text']);
		//echo "<pre>";
//		print_r($this->data['establishment_list']); die;

		//for pegination
		$this->data['total_records']=count($this->data['establishment_list']);
		$this->data['ppr']=20;
		$this->session->set_userdata('ppr',$this->data['ppr']);
		$cp=trim($this->input->get('cp'));
    	if(!empty($cp))
		{
    		$this->data['cp']=$cp;
    		$this->session->set_userdata('cp',$cp);
    	}
		else
		{
			$this->data['cp']=1;}
    	$this->data['pagination']=$this->Pagenation($this->data['cp'], $this->data['ppr'],$this->data['total_records']);
		$this->data['establishment_list']=$this->Admin_model->EstablishmentAccountList($this->data['date_from'],$this->data['date_end'],$this->data['search_text'],"limit ".$this->data['pagination']['start_limit'].",".   $this->data['pagination']['end_limit']
);
		$this->load->view('admin/establishment_display',$this->data);
	}
		else
		redirect('admin/login');
	}
	 
	 public function delete_user($id)
	 {
	   $this->load->model('Admin_model');
	   $this->Admin_model->DeleteUser($id);
	   redirect('admin/user');	
	}
	
	public function rating_comment()
	{
		if($this->session->userdata('admin_email')) {
			$ar= $this->session->all_userdata();
			$values= array();
			$this->data['date_from']=trim($this->input->get('date_from'));
			//$this->session->set_userdata('date_from',$this->data['date_from']);
			$this->data['date_end']=trim($this->input->get('date_end'));
			//$this->session->set_userdata('date_end',$this->data['date_end']);
			$this->data['search_text']=trim($this->input->get('search_text'));
			$this->data['status'] = trim($this->input->get('status'));
			
			$this->data['attribute_search']=$this->Admin_model->SearchRatingAttribute($values);
			$this->data['rating_comment'] = $this->Admin_model->RatingsComment($this->data['date_from'],$this->data['date_end'],$this->data['search_text'],$this->data['status'],'');
			
			$this->data['total_records']=count($this->data['rating_comment']);
			$this->data['ppr']=20;
			$this->session->set_userdata('ppr',$this->data['ppr']);
			$cp=trim($this->input->get('cp'));
			if(!empty($cp))
			{
				$this->data['cp']=$cp;
				$this->session->set_userdata('cp',$cp);
			}
			else
			{
			$this->data['cp']=1;}
			$this->data['pagination']=$this->Pagenation($this->data['cp'], $this->data['ppr'],$this->data['total_records']);
			$this->data['rating_comment']=$this->Admin_model->RatingsComment($this->data['date_from'],$this->data['date_end'],$this->data['search_text'],$this->data['status'],"limit ".$this->data['pagination']['start_limit'].",".   $this->data['pagination']['end_limit']
	);

			$this->load->view('admin/rating_comment',$this->data);
		}
		else
		redirect('admin/login');
	}
	
	public function rating_edit() {
	   
	   $this->load->model('Admin_model');
	   $this->load->helper('form');
	   $caller=$this->input->post('caller'); 
	   $values=array(); 
	   $this->data['msg']="";
	   $rating_ref = $this->uri->segment(3);
	   //$this->session->set_userdata('est_user_ref',$$user_ref);
	 
		if ( $rating_ref ) 
   			{ 
				$this->data['rating'] = $this->Admin_model->GetRatingDetail($rating_ref);
				$values_rating = $this->data['rating'];
				//echo "<pre>";
				//print_r($values_rating); die;
				
				if($caller == "Rating")
				{
					/*$values['title']=trim($this->input->post('title'));
					$values['user']=trim($this->input->post('user'));*/
					$values['rating']=trim($this->input->post('rating'));
					$values['comment']=trim($this->input->post('comment'));
					$this->load->library('form_validation'); 
				   
					$arrData= array('rating' => $values['rating'],
									'comment' => $values['comment']);
									   
					$this->Admin_model->UpdateRatingInfo($arrData, $rating_ref);		
					
					redirect('admin/rating_edit/'.$rating_ref.'');
				}
				$this->data['attribute_rating']=$this->Admin_model->RatingFormAttribute($values,$values_rating);
				
				$this->load->view('admin/rating_edit', $this->data );
			}
		else { 
			redirect('admin/login');
		}	
	}
	
	public function show_rating()
	{
		if($this->session->userdata('admin_email')) {
			$ar= $this->session->all_userdata();
			$values= array();
			$this->data['date_from']=trim($this->input->get('date_from'));
			//$this->session->set_userdata('date_from',$this->data['date_from']);
			$this->data['date_end']=trim($this->input->get('date_end'));
			//$this->session->set_userdata('date_end',$this->data['date_end']);
			$this->data['search_text']=trim($this->input->get('search_text'));
			$this->data['status'] = trim($this->input->get('status'));
			
			$this->data['attribute_search']=$this->Admin_model->SearchRatingAttribute($values);
			$this->data['rating_comment'] = $this->Admin_model->RatingsComment($this->data['date_from'],$this->data['date_end'],$this->data['search_text'],$this->data['status'],'');
			
			$this->data['total_records']=count($this->data['rating_comment']);
			$this->data['ppr']=20;
			$this->session->set_userdata('ppr',$this->data['ppr']);
			$cp=trim($this->input->get('cp'));
			if(!empty($cp))
			{
				$this->data['cp']=$cp;
				$this->session->set_userdata('cp',$cp);
			}
			else
			{
			$this->data['cp']=1;}
			$this->data['pagination']=$this->Pagenation($this->data['cp'], $this->data['ppr'],$this->data['total_records']);
			$this->data['rating_comment']=$this->Admin_model->RatingsComment($this->data['date_from'],$this->data['date_end'],$this->data['search_text'],$this->data['status'],"limit ".$this->data['pagination']['start_limit'].",".   $this->data['pagination']['end_limit']);

			$this->load->view('admin/rating_display',$this->data);
		}
		else
		redirect('admin/login');
	}
	
	public function slider() {
		if($this->session->userdata('admin_email')) { 
		
			$this->data = array();
			$this->data['slider'] = $this->Admin_model->GetSliderData('');
			$this->load->view('admin/slider',$this->data);
		}
		else {
			redirect('admin/login');
		}
	}
	
	public function addslider() {
		if($this->session->userdata('admin_email')) { 
		    $this->load->model('Admin_model');
		    $this->load->helper('form');
			$values = array();
			$values_slider = array();
			$this->data['attribute_slider'] = $this->Admin_model->SliderFormAttribute($values,$values_slider);
			$this->load->view('admin/addslider',$this->data);
			$caller=$this->input->post('caller'); 
			$arrData=array();
			
			if($caller == "Slider")
			{ 
				$this->load->library('form_validation'); 
				$values['slidername']=trim($this->input->post('slidername'));
				$values['url']=trim($this->input->post('url'));
				$values['desc']=trim($this->input->post('desc'));
				
				$arrData = array('slidername' => $values['slidername'],
								'url' => $values['url'],
								'desc' => $values['desc']);
								
								//print_r($_FILES); die;
				//echo $_FILES['image']['name']; die;
				$path_to_upload="./images/slider/";
				$values_upload['current_picture'] = '';
				if(!empty($_FILES['image']['name']))
				{
					// list of argument for image validation array
					// 1.file_name,2.path_to_upload,3.image_index,4.max_width,5.max_height,6.fixed_width,7.fixed_height,8.max_size
					$picture_info=array("image",$path_to_upload,"image","","","","",'');
					$picture_info_string=implode("~",$picture_info);
					$this->form_validation->set_rules('image', 'Slider Image', "callback_image_validation[{$picture_info_string}]");
				}
						
				if($this->form_validation->run() == FALSE)
				{   //echo 'test'; die;
					if(!empty($this->uploading_image_info['image']['file_name']))
					{
					 unlink($path_to_upload.$this->uploading_image_info['image']['file_name']);
					 $error=true;
					}
				}
				else
				{
					if(!empty($_FILES['image']['name']) or !empty($values_upload['current_picture']))
					 {
						 // delete previous image
						 //unlink($path_to_upload.$values_upload['current_picture']);
						 $arrData['image'] = $this->uploading_image_info['image']['file_name'];
					 }
					else {
						$arrData['image'] = '';
						 //echo 'test'; die;
					}
						//print_r($arrData) ; die;
						$this->Admin_model->AddSliderData($arrData);
					 //echo 'test'; die;
					  redirect('admin/slider');		     
				}
			}
		}
		else {
			redirect('admin/login');
		}
	}
	
	public function edit_slider() {
		if($this->session->userdata('admin_email')) { 
		    $this->load->model('Admin_model');
		    $this->load->helper('form');
			$values = array();
			$slider_ref = $this->uri->segment(3);
			$values_slider = $this->Admin_model->GetSliderData($slider_ref);
			//echo "<pre>";
			//print_r($values_slider); die;
			$this->data['attribute_slider'] = $this->Admin_model->SliderFormAttribute($values,$values_slider[0]);
			
			$caller=$this->input->post('caller'); 
			$arrData=array();
			
			if($caller == "Slider")
			{ 
				$this->load->library('form_validation'); 
				$values['slidername']=trim($this->input->post('slidername'));
				$values['url']=trim($this->input->post('url'));
				$values['desc']=trim($this->input->post('desc'));
				
				$arrData = array('slidername' => $values['slidername'],
								'url' => $values['url'],
								'desc' => $values['desc']);
								
								//print_r($_FILES); die;
				//echo $_FILES['image']['name']; die;
				$path_to_upload="./images/slider/";
				$values_upload['current_picture'] = ($values_slider[0]['image']!='')?$values_slider[0]['image']:'';
				if(!empty($_FILES['image']['name']))
				{
					// list of argument for image validation array
					// 1.file_name,2.path_to_upload,3.image_index,4.max_width,5.max_height,6.fixed_width,7.fixed_height,8.max_size
					$picture_info=array("image",$path_to_upload,"image","","","","",'');
					$picture_info_string=implode("~",$picture_info);
					$this->form_validation->set_rules('image', 'Slider Image', "callback_image_validation[{$picture_info_string}]");
				}
						
				if($this->form_validation->run() == FALSE && !empty($_FILES['image']['name']))
				{   //echo 'test'; die;
					if(!empty($this->uploading_image_info['image']['file_name']))
					{
					 unlink($path_to_upload.$this->uploading_image_info['image']['file_name']);
					 $error=true;
					}
				}
				else
				{
					if(!empty($_FILES['image']['name']))
					 {
						 // delete previous image
						 unlink($path_to_upload.$values_upload['current_picture']);
						 $arrData['image'] = $this->uploading_image_info['image']['file_name'];
					 }
					else {
						$arrData['image'] = $values_upload['current_picture'];
						 //echo 'test'; die;
					}
						//print_r($arrData) ; die;
						$this->Admin_model->UpdateSliderData($arrData,$slider_ref);
					 //echo 'test'; die;
					  redirect('admin/slider');		     
				}
			}
			$this->load->view('admin/edit_slider',$this->data);
		}
		else {
			redirect('admin/login');
		}
	}
	
	public function quiz() {
		
		if($this->session->userdata('admin_email')) { 
		 
		 	$this->load->model('Quiz_model');
		 	$this->data = array(); 
			$values = array();
			$this->data['date_from']=trim($this->input->get('date_from'));
			$this->session->set_userdata('date_from',$this->data['date_from']);
			$this->data['date_end']=trim($this->input->get('date_end'));
			$this->session->set_userdata('date_end',$this->data['date_end']);
			$this->data['search_text']=trim($this->input->get('search_text'));
			$this->session->set_userdata('search_text',$this->data['search_text']);
			
			$this->data['total_records']= $this->Quiz_model->TotalQuestion('', $this->data['date_from'],$this->data['date_end'],$this->data['search_text'],'','');
			$this->data['ppr']=20;
			$cp=1;
			if(empty($this->data['cp'])){$this->data['cp']=$cp;}else{$this->data['cp']=$this->session->userdata('cp');}
			$this->data['pagination']=$this->Pagenation($this->data['cp'], $this->data['ppr'],$this->data['total_records']);

			$this->data['question'] = $this->Quiz_model->GetQuestionData('', $this->data['date_from'],$this->data['date_end'],$this->data['search_text'],'',"limit ".$this->data['pagination']['start_limit'].",".   $this->data['pagination']['end_limit']);
			$this->data['attribute_search']=$this->Admin_model->SearchQuestionAttribute($values);
			//echo "<pre>";
			//print_r($this->data['question']); die;
		 	$this->load->view('admin/quiz',$this->data);
		 }
		 else {
			redirect('admin/login');
		}
	}
	
	public function show_quiz() {
		
		if($this->session->userdata('admin_email')) { 
		 
		 	$this->load->model('Quiz_model');
		 	$this->data = array(); 
			$values = array();
			$this->data['date_from']=trim($this->input->get('date_from'));
			$this->data['date_end']=trim($this->input->get('date_end'));
			$this->data['search_text']=trim($this->input->get('search_text'));
			$this->data['status'] = trim($this->input->get('status'));
			
			$this->data['total_records']= $this->Quiz_model->TotalQuestion('', $this->data['date_from'],$this->data['date_end'],$this->data['search_text'],$this->data['status']);
			$this->data['ppr']=20;
			$cp=trim($this->input->get('cp'));
			if(!empty($cp))
			{
				$this->data['cp']=$cp;
			}
			else { $this->data['cp']=1; }
			//if(empty($this->data['cp'])){$this->data['cp']=$cp;}else{$this->data['cp']=$this->session->userdata('cp');}
			$this->data['pagination']=$this->Pagenation($this->data['cp'], $this->data['ppr'],$this->data['total_records']);

			$this->data['question'] = $this->Quiz_model->GetQuestionData('', $this->data['date_from'],$this->data['date_end'],$this->data['search_text'],$this->data['status'], "limit ".$this->data['pagination']['start_limit'].",".   $this->data['pagination']['end_limit']);
			$this->data['attribute_search']=$this->Admin_model->SearchQuestionAttribute($values);
			//echo "<pre>";
			//print_r($this->data['question']); die;
		 	$this->load->view('admin/quiz_display',$this->data);
		 }
		 else {
			redirect('admin/login');
		}
	}
	
	public function addquestion() {
		if($this->session->userdata('admin_email')) { 
		    $this->load->model('Quiz_model');
		    $this->load->helper('form');
			$values = array();
			$values_question = array();
			$this->data['attribute_question'] = $this->Quiz_model->QuestionFormAttribute($values,$values_question);
			$this->load->view('admin/addquestion',$this->data);
			$caller=$this->input->post('caller'); 
			$arrData=array();
			
			if($caller == "Question")
			{ 
				$this->load->library('form_validation'); 
				
				$values['question']=trim($this->input->post('question'));
				$values['answer']= $this->input->post('answer');
				$values['correct_answer'] = $this->input->post('correct_answer');
				
				$arrData = array('question' => $values['question'],
								'answer' => $values['answer'],
								'correct_answer' => $values['correct_answer']);
								
				$this->form_validation->set_message('question','Please enter a question');
				$this->form_validation->set_rules('question','question','trim|callback_value_required[question]');		
				if($this->form_validation->run() == TRUE)
				{   //echo 'test'; die;
					
					$this->Quiz_model->AddQuestionData($arrData);
					redirect('admin/quiz');		     
				}
			}
		}
		else {
			redirect('admin/login');
		}
	}
	
	public function quiz_setting() {
		if($this->session->userdata('admin_email')) { 
		    $this->load->model('Quiz_model');
		    $this->load->helper('form');
			$values = array();
			$values_question = array();
			$this->data['errormsg'] = '';
			$values = $this->Quiz_model->GetSettings();
			
			$caller=$this->input->post('caller'); 
			
			$arrData=array();
			
			if($caller == "Quiz_setting")
			{ 
				$this->load->library('form_validation'); 
				
				$values['text']=trim($this->input->post('text'));
				$values['competition']=trim($this->input->post('competition'));
				$values['subtext']= $this->input->post('subtext');
				
				$arrData = array('text' => $values['text'],
								 'competition' => $values['competition'],
								'subtext' => $values['subtext']);
								
				$this->form_validation->set_rules('text','text','trim|callback_value_required[text_heading]');
				$this->form_validation->set_rules('competition','competition','trim|callback_value_required[competition]');
				$this->form_validation->set_rules('subtext','subtext','trim|callback_value_required[subtext]');				
				if($this->form_validation->run() == TRUE)
				{   
					$this->Quiz_model->UpdateSettings($arrData, $values['id']);
					$this->data['errormsg'] = 'Quiz settings updated successfully !';
					//redirect('admin/quiz_setting');		     
				}
			}
			$this->data['attribute_question'] = $this->Quiz_model->SettingsFormAttribute($values);
			$this->load->view('admin/quiz_settings',$this->data);
		}
		else {
			redirect('admin/login');
		}
	}
	
	public function edit_question() {
		if($this->session->userdata('admin_email')) { 
		    $this->load->model('Quiz_model');
		    $this->load->helper('form');
			$values = array();
			$question_ref = $this->uri->segment(3);
			$values_question = array();
			$values_question = $this->Quiz_model->GetQuestion($question_ref);
			//echo "<pre>";
			//print_r($values_question); die;
			$this->data['values_question'] = $values_question[0];
			$this->data['attribute_question'] = $this->Quiz_model->QuestionFormAttribute($values,$values_question[0]);
			$this->load->view('admin/editquestion.php',$this->data);
			$caller=$this->input->post('caller'); 
			$arrData=array();
			
			if($caller == "Question")
			{ 
				$this->load->library('form_validation'); 
				
				$values['question']=trim($this->input->post('question'));
				$values['answer']= $this->input->post('answer');
				$values['correct_answer'] = $this->input->post('correct_answer');
				
				$arrData = array('question' => $values['question'],
								'answer' => $values['answer'],
								'correct_answer' => $values['correct_answer']);
								
				$this->form_validation->set_message('question','Please enter a question');
				$this->form_validation->set_rules('question','question','trim|callback_value_required[question]');		
				if($this->form_validation->run() == TRUE)
				{   //echo 'test'; die;
					
					$this->Quiz_model->UpdateQuestionData($arrData, $question_ref);
					redirect('admin/quiz');		     
				}
			}
		}
		else {
			redirect('admin/login');
		}
	}
	
	public function delete_question_ajax()
	{
		$this->load->model('Quiz_model');
		$caller=$this->input->post('caller'); 
		if($caller == "delete"){
			$rowdeleId = $this->input->post('deleteid');
			if($rowdeleId){
				//$this->Quiz_model->DeleteQuestion($rowdeleId);	
				$rowdelete = $this->Quiz_model->DeleteQuestion($rowdeleId);
				return true;
			}
		}
	}
	
	public function block_question_ajax()
	{
		$this->load->model('Quiz_model');
		$id = $this->input->post('id');
		$type  = $this->input->post('type');
		if($id){
			$status = $this->Quiz_model->BlockQuestion($id,$type);	
			echo $status;
		}
  }
  
  public function reseller() {
		
		if($this->session->userdata('admin_email')) { 
		 
		 	$this->load->model('Reseller_model');
		 	$this->data = array(); 
			$values = array();
			$this->data['date_from']=trim($this->input->get('date_from'));
			$this->session->set_userdata('date_from',$this->data['date_from']);
			$this->data['date_end']=trim($this->input->get('date_end'));
			$this->session->set_userdata('date_end',$this->data['date_end']);
			$this->data['search_text']=trim($this->input->get('search_text'));
			$this->session->set_userdata('search_text',$this->data['search_text']);
			
			$this->data['total_records']= $this->Reseller_model->TotalReseller('', $this->data['date_from'],$this->data['date_end'],$this->data['search_text'],'','');
			$this->data['ppr']=20;
			$cp=trim($this->input->get('cp'));
			if(!empty($cp))
			{
				$this->data['cp']=$cp;
			}
			else { $this->data['cp']=1; }
			$this->data['pagination']=$this->Pagenation($this->data['cp'], $this->data['ppr'],$this->data['total_records']);

			$this->data['reseller'] = $this->Reseller_model->GetResellerData('', $this->data['date_from'],$this->data['date_end'],$this->data['search_text'],'',"limit ".$this->data['pagination']['start_limit'].",".$this->data['pagination']['end_limit']);
			$this->data['attribute_search']=$this->Reseller_model->SearchResellerAttribute($values);
			//echo "<pre>";
			//print_r($this->data['reseller']); die;
		 	$this->load->view('admin/reseller',$this->data);
		 }
		 else {
			redirect('admin/login');
		}
	}
	
	public function show_reseller() {
		
		if($this->session->userdata('admin_email')) { 
		 
		 	$this->load->model('Reseller_model');
		 	$this->data = array(); 
			$values = array();
			$this->data['date_from']=trim($this->input->get('date_from'));
			$this->data['date_end']=trim($this->input->get('date_end'));
			$this->data['search_text']=trim($this->input->get('search_text'));
			$this->data['status'] = trim($this->input->get('status'));
			
			$this->data['total_records']= $this->Reseller_model->TotalReseller('', $this->data['date_from'],$this->data['date_end'],$this->data['search_text'],$this->data['status']);
			$this->data['ppr']=20;
			$cp=trim($this->input->get('cp'));
			if(!empty($cp))
			{
				$this->data['cp']=$cp;
			}
			else { $this->data['cp']=1; }
			$this->data['pagination']=$this->Pagenation($this->data['cp'], $this->data['ppr'],$this->data['total_records']);

			$this->data['reseller'] = $this->Reseller_model->GetResellerData('', $this->data['date_from'],$this->data['date_end'],$this->data['search_text'],$this->data['status'], "limit ".$this->data['pagination']['start_limit'].",".   $this->data['pagination']['end_limit']);
			$this->data['attribute_search']=$this->Reseller_model->SearchResellerAttribute($values);
			//echo "<pre>";
			//print_r($this->data['question']); die;
		 	$this->load->view('admin/reseller_display',$this->data);
		 }
		 else {
			redirect('admin/login');
		}
	}
	
	public function addreseller() {
		if($this->session->userdata('admin_email')) { 
		    $this->load->model('Reseller_model');
		    $this->load->helper('form');
			$values = array();
			$this->data['code_msg'] = '';
			$this->data['email_msg'] = '';
			$flag = true;
			$caller=$this->input->post('caller'); 
			$arrData=array();
			
			if($caller == "Reseller")
			{ 
				$this->load->library('form_validation'); 
				
				$values['firstname']=trim($this->input->post('firstname'));
				$values['lastname']= trim($this->input->post('lastname'));
				$values['email']= trim($this->input->post('email'));
				$values['resellercode']= trim($this->input->post('resellercode'));
				
				$arrData = array('firstname' => $values['firstname'],
								'lastname' => $values['lastname'],
								'email' => $values['email'],
								'resellercode' => $values['resellercode']);
								
				$this->form_validation->set_message('valid_email','Please enter a valid email id');
				$this->form_validation->set_rules('firstname','firstname','trim|callback_value_required[first_name]');
				$this->form_validation->set_rules('email','email','trim|callback_value_required[reseller_email]|valid_email');
				$this->form_validation->set_rules('resellercode','resellercode','trim|callback_value_required[resellercode]');		
				if($this->form_validation->run() == TRUE)
				{   
					$emailcheck = $this->Reseller_model->ResellerEmailCheck($values['email']);	
					if($emailcheck == true) {
						$this->data['email_msg'] = "Already entered with this email!";
						$flag=false;
					}
					$codecheck = $this->Reseller_model->ResellerCodeCheck($values['resellercode']);	
					if($codecheck == true) {
						$this->data['code_msg'] = "Already entered with this code!";
						$flag=false;
					}
					if($flag == true) {
						$this->Reseller_model->AddResellerData($arrData);
						redirect('admin/reseller');		     
					}
				}
			}
			$this->data['attribute_reseller'] = $this->Reseller_model->ResellerFormAttribute($values);
			$this->load->view('admin/addreseller',$this->data);
		}
		else {
			redirect('admin/login');
		}
	}
	
	public function edit_reseller() {
		if($this->session->userdata('admin_email')) { 
		    $this->load->model('Reseller_model');
		    $this->load->helper('form');
			$values = array();
			$this->data['code_msg'] = '';
			$this->data['email_msg'] = '';
			$flag = true;
			$reseller_ref = $this->uri->segment(3);
			$values_question = array();
			$values_reseller = $this->Reseller_model->GetReseller($reseller_ref);
			$this->data['values_reseller'] = $values_reseller[0];
			$values = $values_reseller[0];
			$this->data['attribute_reseller'] = $this->Reseller_model->ResellerFormAttribute($values);
			
			$caller=$this->input->post('caller'); 
			$arrData=array();
			
			if($caller == "Reseller")
			{ 
				$this->load->library('form_validation'); 
				$values['firstname']=trim($this->input->post('firstname'));
				$values['lastname']= trim($this->input->post('lastname'));
				$values['email']= trim($this->input->post('email'));
				$values['resellercode']= trim($this->input->post('resellercode'));
				
				$arrData = array('firstname' => $values['firstname'],
								'lastname' => $values['lastname'],
								'email' => $values['email'],
								'resellercode' => $values['resellercode']);
								
				$this->form_validation->set_message('valid_email','Please enter a valid email id');
				$this->form_validation->set_rules('firstname','firstname','trim|callback_value_required[first_name]');
				$this->form_validation->set_rules('email','email','trim|callback_value_required[reseller_email]|valid_email');
				$this->form_validation->set_rules('resellercode','resellercode','trim|callback_value_required[resellercode]');			
				if($this->form_validation->run() == TRUE)
				{   
					$emailcheck = $this->Reseller_model->ResellerEmailCheck($values['email']);	
					if($emailcheck == true && $values_reseller[0]['email']!=$values['email']) {
						$this->data['email_msg'] = "Already entered with this email!";
						$flag=false;
					}
					$codecheck = $this->Reseller_model->ResellerCodeCheck($values['resellercode']);	
					if($codecheck == true && $values_reseller[0]['resellercode']!=$values['resellercode']) {
						$this->data['code_msg'] = "Already entered with this code!";
						$flag=false;
					}
					if($flag == true) {
						$this->Reseller_model->UpdateResellerData($arrData, $reseller_ref);
						redirect('admin/reseller');	     
					}
				}
			}
			$this->data['attribute_reseller'] = $this->Reseller_model->ResellerFormAttribute($values);
			$this->load->view('admin/editreseller', $this->data);
		}
		else {
			redirect('admin/login');
		}
	}
	
	public function view_reseller() {
		
		if($this->session->userdata('admin_email')) { 
		 
		 	$this->load->model('Reseller_model');
		 	$this->data = array(); 
			$values = array();
			$reseller_ref = $this->uri->segment(3);
			$values_reseller = $this->Reseller_model->GetReseller($reseller_ref);
			$this->data['email'] = $values_reseller[0]['email'];
			$this->data['total_records']= $this->Reseller_model->TotalResellerEst($reseller_ref);
			$this->data['ppr']=20;
			$cp=trim($this->input->get('cp'));
			if(!empty($cp))
			{
				$this->data['cp']=$cp;
			}
			else { $this->data['cp']=1; }
			$this->data['pagination']=$this->Pagenation($this->data['cp'], $this->data['ppr'],$this->data['total_records']);

			$this->data['reseller'] = $this->Reseller_model->GetResellerEst($reseller_ref, "limit ".$this->data['pagination']['start_limit'].",".$this->data['pagination']['end_limit']);
			//echo "<pre>";
			//print_r($this->data['reseller']); die;
		 	$this->load->view('admin/viewreseller_est',$this->data);
		 }
		 else {
			redirect('admin/login');
		}
	}
	
	public function show_view_reseller() {
		
		if($this->session->userdata('admin_email')) { 
		 
		 	$this->load->model('Reseller_model');
		 	$this->data = array(); 
			$values = array();
			$reseller_ref = $this->uri->segment(3);
			$values_reseller = $this->Reseller_model->GetReseller($reseller_ref);
			$this->data['email'] = $values_reseller[0]['email'];
			$this->data['total_records']= $this->Reseller_model->TotalResellerEst($reseller_ref);
			$this->data['ppr']=20;
			$cp=trim($this->input->get('cp'));
			if(!empty($cp))
			{
				$this->data['cp']=$cp;
			}
			else { $this->data['cp']=1; }
			$this->data['pagination']=$this->Pagenation($this->data['cp'], $this->data['ppr'],$this->data['total_records']);

			$this->data['reseller'] = $this->Reseller_model->GetResellerEst($reseller_ref, "limit ".$this->data['pagination']['start_limit'].",".$this->data['pagination']['end_limit']);
			//echo "<pre>";
			//print_r($this->data['reseller']); die;
		 	$this->load->view('admin/reseller_est_display',$this->data);
		 }
		 else {
			redirect('admin/login');
		}
	}
	
	public function recommendabar() {
		
		if($this->session->userdata('admin_email')) { 
		 
		 	$this->load->model('Recommend_model');
		 	$this->data = array(); 
			$values = array();
			$this->data['date_from']=trim($this->input->get('date_from'));
			$this->session->set_userdata('date_from',$this->data['date_from']);
			$this->data['date_end']=trim($this->input->get('date_end'));
			$this->session->set_userdata('date_end',$this->data['date_end']);
			$this->data['search_text']=trim($this->input->get('search_text'));
			$this->session->set_userdata('search_text',$this->data['search_text']);
			
			$this->data['total_records']= $this->Recommend_model->TotalRecbar('', $this->data['date_from'],$this->data['date_end'],$this->data['search_text'],'');
			$this->data['ppr']=20;
			$cp=trim($this->input->get('cp'));
			if(!empty($cp))
			{
				$this->data['cp']=$cp;
			}
			else { $this->data['cp']=1; }
			$this->data['pagination']=$this->Pagenation($this->data['cp'], $this->data['ppr'],$this->data['total_records']);

			$this->data['recabar'] = $this->Recommend_model->GetRecabarData('', $this->data['date_from'],$this->data['date_end'],'',"limit ".$this->data['pagination']['start_limit'].",".$this->data['pagination']['end_limit']);
			$this->data['attribute_search']=$this->Recommend_model->SearchResellerAttribute($values);
			//echo "<pre>";
			//print_r($this->data['reseller']); die;
		 	$this->load->view('admin/recommendabar',$this->data);
		 }
		 else {
			redirect('admin/login');
		}
	}
	
	public function show_recabar() {
		
		if($this->session->userdata('admin_email')) { 
		 
		 	$this->load->model('Recommend_model');
		 	$this->data = array(); 
			$values = array();
			$this->data['date_from']=trim($this->input->get('date_from'));
			$this->data['date_end']=trim($this->input->get('date_end'));
			$this->data['search_text']=trim($this->input->get('search_text'));
			
			$this->data['total_records']= $this->Recommend_model->TotalRecbar('', $this->data['date_from'],$this->data['date_end'],$this->data['search_text']);
			$this->data['ppr']=20;
			$cp=trim($this->input->get('cp'));
			if(!empty($cp))
			{
				$this->data['cp']=$cp;
			}
			else { $this->data['cp']=1; }
			$this->data['pagination']=$this->Pagenation($this->data['cp'], $this->data['ppr'],$this->data['total_records']);

			$this->data['recabar'] = $this->Recommend_model->GetRecabarData('', $this->data['date_from'],$this->data['date_end'],$this->data['search_text'], "limit ".$this->data['pagination']['start_limit'].",".   $this->data['pagination']['end_limit']);
			$this->data['attribute_search']=$this->Recommend_model->SearchResellerAttribute($values);
			//echo "<pre>";
			//print_r($this->data['question']); die;
		 	$this->load->view('admin/recommendabar_display',$this->data);
		 }
		 else {
			redirect('admin/login');
		}
	}
	
	public function download_recabar() {
		
		if($this->session->userdata('admin_email')) { 
		
			$this->load->model('Recommend_model');
		 	$this->data = array(); 
			$values = array();
			$this->data['date_from']=trim($this->input->get('date_from'));
			$this->data['date_end']=trim($this->input->get('date_end'));
			$this->data['search_text']=trim($this->input->get('search_text'));
			
			$this->data['total_records']= $this->Recommend_model->TotalRecbar('', $this->data['date_from'],$this->data['date_end'],$this->data['search_text']);
			$this->data['ppr']=20;
			$cp=trim($this->input->get('cp'));
			if(!empty($cp))
			{
				$this->data['cp']=$cp;
			}
			else { $this->data['cp']=1; }
			$this->data['pagination']=$this->Pagenation($this->data['cp'], $this->data['ppr'],$this->data['total_records']);

			$this->data['recabar'] = $this->Recommend_model->GetRecabarData('', $this->data['date_from'],$this->data['date_end'],$this->data['search_text'], "limit ".$this->data['pagination']['start_limit'].",".   $this->data['pagination']['end_limit']);
			$this->data['attribute_search']=$this->Recommend_model->SearchResellerAttribute($values);
			
			$recabar = array(); $i=1;
			$recabar[0]['id'] = 'S.No';
			$recabar[0]['barname'] = 'Bar Name';
			$recabar[0]['baraddress'] = 'Bar Address';
			$recabar[0]['baremail'] = 'Bar Email';
			$recabar[0]['barphone'] = 'Bar Phone';
			$recabar[0]['useremail'] = 'User Email';
			$recabar[0]['userphone'] = 'User Phone';
			$recabar[0]['created_on'] = 'Created date';
			
			foreach($this->data['recabar'] as $key => $value) {
				$recabar[$i]['id'] = $i;
				$recabar[$i]['barname'] = $value['barname'];
			  	$recabar[$i]['baraddress'] = $value['baraddress'];
			  	$recabar[$i]['baremail'] = $value['baremail'];
			  	$recabar[$i]['barphone'] = $value['barphone'];
			  	$recabar[$i]['useremail'] = $value['useremail'];
			  	$recabar[$i]['userphone'] = $value['userphone'];
			  	$recabar[$i]['created_on'] = $value['created_on'];
				$i++;
			}
			
			//load our new PHPExcel library			
			$this->load->library('excel');
			
			$this->excel->setActiveSheetIndex(0);
			$this->excel->getActiveSheet()->setTitle('Rec a bar list'); 
			
			$this->excel->getActiveSheet()->fromArray($recabar); 
			$filename='Rec_bar_list.xls'; //save our workbook as this file name
			
	         header('Content-Type: application/vnd.ms-excel'); //mime type
    	     header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
	         header('Cache-Control: max-age=0'); //no cache
			 
			 $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5'); 
			 $objWriter->save('php://output');

		 }
		 else {
			redirect('admin/login');
		}
	}
	
	public function delete_recabar_ajax()
	{
		$this->load->model('Recommend_model');
		$caller=$this->input->post('caller'); 
		if($caller == "delete"){
			$rowdeleId = $this->input->post('deleteid');
			if($rowdeleId){
				//$this->Quiz_model->DeleteQuestion($rowdeleId);	
				$rowdelete = $this->Recommend_model->DeleteRecabar($rowdeleId);
				return true;
			}
		}
	}
	
	public function block_reseller_ajax()
	{
		$this->load->model('Reseller_model');
		$id = $this->input->post('id');
		$type  = $this->input->post('type');
		if($id){
			$status = $this->Reseller_model->BlockReseller($id,$type);	
			echo $status;
		}
   }
	
   public function delete_ajax()
	{
		$caller=$this->input->post('caller'); 
		if($caller == "delete"){
				$rowdeleId = $this->input->post('deleteid');
				if($rowdeleId){
					$rowdelete = $this->Admin_model->DeleteEstablishmentInfo($rowdeleId);	
					return true;
					}
			}
			else echo 0;
			//redirect('admin/establishment');
	}
	
	public function delete_user_ajax()
	{
		$caller=$this->input->post('caller'); 
		if($caller == "delete"){
			$rowdeleId = $this->input->post('deleteid');
			if($rowdeleId){
				$rowdelete = $this->Admin_model->DeleteUserInfo($rowdeleId);	
				return true;
			}
		}
	}
	
	public function delete_adminuser_ajax()
	{
		$caller=$this->input->post('caller'); 
		if($caller == "delete"){
			$rowdeleId = $this->input->post('deleteid');
			if($rowdeleId){
				$rowdelete = $this->Admin_model->DeleteAdminUserInfo($rowdeleId);	
				return true;
			}
		}
	}
	
	public function delete_rating_ajax()
	{
		$caller=$this->input->post('caller'); 
		if($caller == "delete"){
			$rowdeleId = $this->input->post('deleteid');
			if($rowdeleId){
				$rowdelete = $this->Admin_model->DeleteRating($rowdeleId);	
				return true;
			}
		}
	}
	
	public function delete_slider_ajax()
	{
		$caller=$this->input->post('caller'); 
		if($caller == "delete"){
			$rowdeleId = $this->input->post('deleteid');
			if($rowdeleId){
				$rowdelete = $this->Admin_model->DeleteSlider($rowdeleId);	
				return true;
			}
		}
	}

  public function block_ajax()
	{
		$id = $this->input->post('id');
		$reason  = $this->input->post('reason');
		$type  = $this->input->post('type');
		if($id){
			$status = $this->Admin_model->BlockEstablishmentInfo($id,$type);	
			return true;
		}
  }
  
  public function block_user_ajax()
	{
		$id = $this->input->post('id');
		$reason  = $this->input->post('reason');
		if(empty($reason)) $reason = 'Conatct admin';
		$type  = $this->input->post('type');
		if($id){
			$status = $this->Admin_model->BlockUserInfo($id,$type,$reason);	
			return true;
		}
  }
  
   public function block_rating_ajax()
	{
		$id = $this->input->post('id');
		$reason  = $this->input->post('reason');
		if(empty($reason)) $reason = 'Conatct admin';
		$type  = $this->input->post('type');
		if($id){
			$status = $this->Admin_model->BlockRating($id,$type,$reason);	
			return true;
		}
  }

 public function logout(){
         // Make sure you destory website session as well.
		$this->session->sess_destroy();
        redirect('admin/login');
 }
	 

	
public function value_required($value,$field)
	 {

		$haserror=false;
	 	switch ($field) {
	 		   
				case 'title':
	 			if($value=="" || $value=="this is the event title / description")
	 			{
	 				$this->form_validation->set_message('value_required', "Please enter event title");
	 				$haserror=true;
	 			}
	 			break;

	 			case 'description':
	 			if($value=="" || $value=="Description:")
	 			{
	 				$this->form_validation->set_message('value_required', "Please enter description");
	 				$haserror=true;
	 			}
	 			break;
				
	 			case 'price_or_discount':
	 			if($value=="" || $value=="Price or discount:")
	 			{
	 				$this->form_validation->set_message('value_required', "Please enter Price or discount");
	 				$haserror=true;
	 			}
	 			break;
				
				case 'title':
	 			if($value=="" || $value=="this is the event title / description")
	 			{
	 				$this->form_validation->set_message('value_required', "Please enter event title");
	 				$haserror=true;
	 			}
	 			break;

	 			case 'event_date':
	 			if($value=="" || $value=="Date:")
	 			{
	 				$this->form_validation->set_message('value_required', "Please enter event date");
	 				$haserror=true;
	 			}
	 			break;
				
	 			case 'event_time':
	 			if($value=="" || $value=="Time:")
	 			{
	 				$this->form_validation->set_message('value_required', "Please enter event time");
	 				$haserror=true;
	 			}
	 			break;

	 			case 'duration':
	 			if($value=="" || $value=="Duration:")
	 			{
	 				$this->form_validation->set_message('value_required', "Please enter event duration");
	 				$haserror=true;
	 			}
				break;
				
	 			case 'first_name':
	 			if($value=="" || $value=="First Name:")
	 			{
	 				$this->form_validation->set_message('value_required', "Please enter first name");
	 				$haserror=true;
	 			}
	 			break;

	 			case 'card_number':
	 			if( $value=="" || $value=="Card Number:" || !is_numeric($value) )
	 			{
	 				$this->form_validation->set_message('value_required', "Please enter card number  16 digit as numeric .");
	 				$haserror=true;
	 			}
	 			break;
				
	 			case 'exp_month':
	 			if( $value=="" || $value=="Expiries Month:" || !is_numeric($value) )
	 			{
	 				$this->form_validation->set_message('value_required', "Please enter expiries month as number.");
	 				$haserror=true;
	 			}
	 			break;

				case 'exp_year':
	 			if( $value=="" || $value=="Expiries Year:" || !is_numeric($value) )
	 			{
	 				$this->form_validation->set_message('value_required', "Expiries month shuld be either cureent month or after this month.");
	 				$haserror=true;
	 			}
	 			break;

	 			case 'code':
	 			if( $value=="" || $value=="Code:" || !is_numeric($value) )
	 			{
	 				$this->form_validation->set_message('value_required', "Please enter code");
	 				$haserror=true;
	 			}
	 			break;
	 			
	 			case 'email':
	 			if($value=="" || $value=="Email:")
	 			{
	 				$this->form_validation->set_message('value_required', "Please enter email");
	 				$haserror=true;
	 			}
	 			break;

	 			case 'password':
	 			if($value=="" || $value=="Password")
	 			{
	 				$this->form_validation->set_message('value_required', "Please enter password");
	 				$haserror=true;
	 			}
	 			break;
				
	 			case 're_password':
	 			if($value=="" || $value=="Retype Pass")
	 			{
	 				$this->form_validation->set_message('value_required', "Please re-enter password");
	 				$haserror=true;
	 			}
	 			break;
				
				case 'question':
	 			if($value=="" || $value=="Question")
	 			{
	 				$this->form_validation->set_message('value_required', "Please enter question");
	 				$haserror=true;
	 			}
	 			break;
				
				case 'competition':
	 			if($value=="" || $value=="Competition")
	 			{
	 				$this->form_validation->set_message('value_required', "Please enter competition");
	 				$haserror=true;
	 			}
	 			break;
				
				case 'subtext':
	 			if($value=="" || $value=="Text")
	 			{
	 				$this->form_validation->set_message('value_required', "Please enter text");
	 				$haserror=true;
	 			}
				break;
				
				case 'text_heading':
	 			if($value=="" || $value=="Text")
	 			{
	 				$this->form_validation->set_message('value_required', "Please enter text");
	 				$haserror=true;
	 			}
	 			break;
				case 'resellercode':
	 			if($value=="" || $value=="Text")
	 			{
	 				$this->form_validation->set_message('value_required', "Please enter reseller code");
	 				$haserror=true;
	 			}
				else if(!ctype_alnum($value)) {
					$this->form_validation->set_message('value_required', "Please enter 4 digit alphanumeric value");
	 				$haserror=true;	
				}
				else if(!preg_match('([a-zA-Z][0-9]|[0-9][a-zA-Z])', $value)) {
					$this->form_validation->set_message('value_required', "Please enter 4 digit alphanumeric value");
	 				$haserror=true;	
				}
				else if(strlen($value) != 4) {
					$this->form_validation->set_message('value_required', "Please enter 4 digit alphanumeric value");
	 				$haserror=true;	
				}
				/*else {
					$codecheck = $this->Reseller_model->ResellerCodeCheck($value);	
					if($codecheck == true) {
						$this->form_validation->set_message('value_required', "Already entered with this code!");
						$haserror=true;
					}
					else { $this->form_validation->set_message('value_required', "Already entered with this code!"); }
				}*/
	 			break;
				case 'reseller_email':
	 			if($value=="" || $value=="Email")
	 			{
	 				$this->form_validation->set_message('value_required', "Please enter email");
	 				$haserror=true;
	 			}
				/*else {
					$emailcheck = $this->Reseller_model->ResellerEmailCheck($value);	
					if($emailcheck == true) {
						$this->form_validation->set_message('value_required', "Already entered with this email!");
						$haserror=true;
					}
					else { $this->form_validation->set_message('value_required', "with this email!"); }
				}*/
	 			break;
	 		default:
	 			break;
	 	}
		return !$haserror;
	 }
 }
?>