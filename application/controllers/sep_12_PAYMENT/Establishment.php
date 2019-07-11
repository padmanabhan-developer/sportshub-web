<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Establishment extends MY_Controller {
	public $user = "";
	public function __construct() {
	 parent::__construct();
     $this->load->model('Establishment_model');
	 $this->load->library('Facebook'); 
	 $this->load->helper('url');
	 $this->load->model('Establishment_tv_model');
		$e=$this->session->userdata('email');
	    $user_id=$this->Establishment_tv_model->GetUserId($e);

        $est_ref_id=$user_id[0]->id;
        $this->data['est_ref_id']= $est_ref_id;
	}

	
public function login_facebook(){

	 $user = $this->facebook->getUser();
        
        if ($user) {
            try {
                 $user_profile = $this->facebook->api('/me');
                
                  $face_arr=array(
                	'first_name'=>$user_profile['first_name'],
                	'last_name'=>$user_profile['last_name'],
                	'email'=>$user_profile['email'],
                	'facebook_id'=>$user_profile['id'],
                	); 
                
                if($this->Establishment_model->CheckUserForFacebook($user_profile['email'])==true)
                {
                	
				 $this->Establishment_model->RegisterSubscription($face_arr);
			    }
			    else
			    {
			     $this->Establishment_model->UpdateSubscription($face_arr,$user_profile['email']);
			    }


                $this->session->set_userdata($face_arr);
                redirect('establishment/profile_settings');
            } catch (FacebookApiException $e) {
                $user = null;
               
               
            }

        }
        else {
           $login_url = trim($this->facebook->getLoginUrl());
           redirect( $login_url );
        }

}
        
  public function login()
  {
	   
	   if ($this->session->userdata('email')) {
	    redirect('establishment/home');
	   }
	   else
	   {
	   $this->load->helper('form');
	   $caller=$this->input->post('caller'); 
	   $values=array(); 
	   $this->data['here_about_us']="";
	   $this->data['errormsg']="";

		$email = trim($this->input->post('email'));
		$pwd = trim($this->input->post('password'));
	   if(($email) && ($pwd))
	   {
		   
		    $values['email']=trim($this->input->post('email'));
		  
			$values['password']=trim($this->input->post('password'));
			
		    $this->load->library('form_validation'); 

			$this->form_validation->set_message('valid_email','Please enter a valid email id');
		    
		    $this->form_validation->set_rules('email','email','trim|callback_value_required[email]|valid_email');
		   
			$this->form_validation->set_rules('password','password', 'trim|callback_value_required[password]');

		    if($this->form_validation->run() == TRUE )// || $this->form_validation->run() == FALSE)
		    {  
			 $msg=$this->Establishment_model->CheckUser($values['email'],myencrypt($values['password']));

			 if($msg=='success')
			 {
			 	$user_id=$this->Establishment_model->GetUserId($values['email']);
		        $est_ref_id=$user_id[0]->id;
				$est_info_id = $this->Establishment_model->GetEstInfoId($est_ref_id);
				$est_subscription = $this->Establishment_model->GetSubscriptionDetails($est_info_id);
				$newdata=array('email'=>$values['email'],
			 		'password'=>myencrypt($values['password']), 'est_ref_id'=>$est_ref_id, 'est_info_id'=>$est_info_id, 'subscription'=>$est_subscription['subscription'],'subscription_status'=>$est_subscription['subscription_status'],'free_status'=>$est_subscription['free_status']);
					$_SESSION['est_info_id'] = $est_info_id;
					

					$profile = $this->Establishment_model->GetProfileDetail($est_ref_id);
					if(($profile['title'] !='') && ($profile['address'] !='') ){
						$this->session->set_userdata('profile_step1',1);
					}
					else{
						$this->session->set_userdata('profile_step1',0);
					}

					$profileImage = $this->Establishment_model->GetProDefaultPic($est_info_id);
					$newdata['profile_step2'] = ($profileImage) ? 1 : 0 ;

					$checkopening = $this->Establishment_model->CheckOpeningHours($est_info_id);
					$newdata['profile_step3'] = ($checkopening > 0) ? 1: 0;
					
					$checkhappy = $this->Establishment_model->CheckHappyHours($est_info_id);
					$newdata['profile_step4'] = ($checkhappy >0) ? 1: 0;

					$checkfacility = $this->Establishment_model->GetEstablishmentFacilities($est_info_id);
					$newdata['profile_step5'] = (count($checkfacility) >= 1)? 1: 0;

					$checkprovider = $this->Establishment_model->CheckProviderList($est_info_id);
					$newdata['schedule_step1'] = ($checkprovider >0) ? 1: 0;
					
					$checkchannel = $this->Establishment_model->CheckProviderChannel($est_info_id);
					$newdata['schedule_step2'] = ($checkchannel >0) ? 1: 0;
			 		
					if(($newdata['schedule_step1'] ==1) && ($newdata['schedule_step2']==1) ){
						$newdata['schedule_step3'] =1;
					}
					else{
						$newdata['schedule_step3'] =0;
					}
				 
				 	$this->session->set_userdata($newdata);
			     	//$check_setup_steps = $this->Establishment_model->CheckProfileScheduleSteps($est_info_id);


				redirect('establishment/profile_settings');



			  }
			  else $this->data['errormsg']=$msg;
					 
					 $this->data['email']=$values['email'];
					 $this->data['password']=$values['password'];


				// redirect('establishment/home');
				 
			 //exit;
			}
		
		   }
		   
		  // for facebook
		  // Automatically picks appId and secret from config



			$this->data['attribute']=$this->Establishment_model->LoginFormAttribute($values);
			        // OR
        // You can pass different one like this
        //$this->load->library('facebook', array(
        //    'appId' => 'APP_ID',
        //    'secret' => 'SECRET',
        //    ));

		}

		   
		   $this->load->view('establishment/login',$this->data);
	 }


 public function home()
	{
		
		if ($this->session->userdata('email')) {

		$ar= $this->session->all_userdata();
	//	print_r($ar);

		$est_info = $this->Establishment_tv_model->GetProfileInfo($this->data['est_ref_id']);
		$est_info_id = $est_info['id'];
		 

		 $check_subscription = $this->Establishment_model->GetSubscriptionDetails($est_info_id); 
		   print_r($check_subscription);
		   $this->data['free_status'] = $check_subscription['free_status'];
		   $this->data['subscription'] = $check_subscription['subscription'];
		   $this->data['subscription_expire'] = date("d-m-Y", strtotime($check_subscription['subscription_end']));;
		   $this->data['subscription_status'] = $check_subscription['subscription_status'];

		 $this->load->view('establishment/home',$this->data);
		}
		else
			redirect('establishment/login');

	}
	public function terms_conditions()
	{
		if ($this->session->userdata('email')) {
		$ar= $this->session->all_userdata();
	//	print_r($ar);
	
		$est_info = $this->Establishment_tv_model->GetProfileInfo($this->data['est_ref_id']);
		$est_info_id = $est_info['id'];
		 

		 $check_subscription = $this->Establishment_model->GetSubscriptionDetails($est_info_id); 
		   //print_r($check_subscription);
		   $this->data['free_status'] = $check_subscription['free_status'];
		   $this->data['subscription'] = $check_subscription['subscription'];
		   $this->data['free_days'] = $check_subscription['free_days'];
		   $this->data['free_days_left'] = $check_subscription['free_days_left'];
		   $this->data['subscription_expire'] = date("d-m-Y", strtotime($check_subscription['subscription_end']));;
		   $this->data['subscription_status'] = $check_subscription['subscription_status'];
		   	 $this->load->view('establishment/terms_conditions',$this->data);
		}
		else
			redirect('establishment/login');

	}
	public function privacy_terms_conditions()
	{
		if ($this->session->userdata('email')) {
		$ar= $this->session->all_userdata();
	//	print_r($ar);
		$est_info = $this->Establishment_tv_model->GetProfileInfo($this->data['est_ref_id']);
		$est_info_id = $est_info['id'];
		 

		 $check_subscription = $this->Establishment_model->GetSubscriptionDetails($est_info_id); 
		   //print_r($check_subscription);
		   $this->data['free_status'] = $check_subscription['free_status'];
		   $this->data['subscription'] = $check_subscription['subscription'];
		   $this->data['free_days'] = $check_subscription['free_days'];
		   $this->data['free_days_left'] = $check_subscription['free_days_left'];
		   $this->data['subscription_expire'] = date("d-m-Y", strtotime($check_subscription['subscription_end']));;
		   $this->data['subscription_status'] = $check_subscription['subscription_status'];

		 $this->load->view('establishment/privacy_terms_conditions',$this->data);
		}
		else
			redirect('establishment/login');

	}
	 public function redirect_to_payment()
	{
		if ($this->session->userdata('email')) {
		$ar= $this->session->all_userdata();
	//	print_r($ar);
		 $this->load->view('establishment/redirect');
		}
		else
			redirect('establishment/login');

	}
	
	public function signup()
    {
	   $this->load->helper('form');
	   $caller=$this->input->post('caller'); 
	   $values=array(); 
	   $this->data['msg']="";
	   $this->data['codemsg']="";
	   $flag = true;
	   if($caller == "Send")
	   {
		    $values['title']=trim($this->input->post('title'));
			$values['email']=trim($this->input->post('email'));
			$values['password']=trim($this->input->post('password'));
			$values['re_password']=trim($this->input->post('re_password'));
			$values['resellercode'] = trim($this->input->post('resellercode'));
			
		    $this->load->library('form_validation'); 

			$this->form_validation->set_message('valid_email','Please enter a valid email id');
		   
		    $this->form_validation->set_rules('email','email','trim|callback_value_required[email]|valid_email');
			$this->form_validation->set_rules('title','title','trim|callback_value_required[title]');
		    $this->form_validation->set_rules('password','password', 'trim|callback_value_required[password]');	
			$this->form_validation->set_rules('re_password','re password', 'trim|callback_value_required[re_password]');

		    if($this->form_validation->run() == TRUE )// || $this->form_validation->run() == FALSE)
		    {  
			 if($values['password']==$values['re_password'])
			 {
				$checkuser = $this->Establishment_model->checkExstingUser($values['email']);
				if($checkuser == FALSE){
				$arrData= array(
						  'title' => $values['title'],	
						  'email' => $values['email'],
						  'password' =>myencrypt( $values['password'] ));
					  
			    if($values['resellercode']!='' && $values['resellercode']!='Reseller Code') {
					$checkcode = $this->Establishment_model->checkResellerCode($values['resellercode']);
					//echo $checkcode; die;
					if($checkcode == TRUE){ 
						$arrData['resellercode'] = $values['resellercode'];
					}
					else {
						$this->data['codemsg'] = "Please enter valid code";
						$flag = false;
					}
				} 
				//echo "<pre>";
				//print_r($values); die;
				if($flag == true) {
					$this->Establishment_model->RegisterSubscription($arrData);
					$this->session->set_userdata($arrData);
					
					$content = '';
					/*$content .= '<!DOCTYPE html>';
					$content .= '<html lang="en">';
					$content .= '<head>';
					$content .= '<meta charset="utf-8">';
					$content .= '</head>';
					$content .= '<body style="background:#f0f0f0; margin:0; padding:0;">';*/
					$content .= '<div style="float:left; width:100%;">';
					$content .= '<div style="width:650px; margin:auto">';
					//$content .= '<div style="float:left; width:100%; text-align:center; margin:30px 0 33px 0;"><img src="http://sportshub365.com/images/logo_email.png"></div>';
					$content .= '<div style="background:#fff; width:100%;  box-sizing:border-box; padding:0 10px; float:left;">';
					$content .= '<p style="color:#6f6f6f; font-size:14px; font-family:Arial, Helvetica, sans-serif; margin:0; padding:0 0 30px 0;"><br/>Welcome to <a href="http://sportshub365.com" style="text-decoration:none; color:#dab503;" target="_blank">Sportshub365.com</a>. You\'re nearly ready to go!</p>';
					$content .= '<p style="color:#6f6f6f; font-size:14px; font-family:Arial, Helvetica, sans-serif; margin:0; padding:0 0 30px 0;">Here at Sportshub365 we love our sport, the atmosphere of a busy bar with like-minded fans is a great way to watch it. Sportshub365 is excited that you have joined their growing number of bars and with you now onboard sports fans in your area can now be directed straight to you.</p>';
					$content .= '<p style="color:#6f6f6f; font-family:Arial, Helvetica, sans-serif; font-size:14px; line-height:18px; margin:0; padding:0 0 15px 0;">
	Please fill out your profile account with all your information and take advantage of our 6 months FREE offer.
	Photos say a thousand words so add up to 5 images of your bar and don\'t forget to add those special offers to entice sport lovers into your bar.</p>';
					$content .= '<p style="color:#6f6f6f; font-family:Arial, Helvetica, sans-serif; font-size:14px; line-height:18px; margin:0; padding:0 0 15px 0;">
	Select the games that you will be showing from your generated fixtures list and this will automatically be updated onto the App along with your bar\'s profile.</p>';
					$content .= '<p style="color:#6f6f6f; font-family:Arial, Helvetica, sans-serif; font-size:14px; line-height:18px; margin:0; padding:0 0 15px 0;">
	Don\'t forget your login detail!</p>';
					$content .= '<p style="color:#6f6f6f; font-family:Arial, Helvetica, sans-serif; font-size:14px; line-height:18px; margin:0; padding:0 0 15px 0;">
	<strong>Email :</strong> '.$values['email'].'<br/><strong>Password :</strong> '.$values['password'].'</p>';
					$content .= '<div style="width:100%; float:left; background:#131e38; height: auto; padding-bottom: 10px;text-align:center; line-height:18px; color:#fff; font-family:Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold;"><br />If you have any questions or would like any more information please feel free to contact us at, <br /> <a href="mailto:info@sportshub365.com" style="text-decoration:none; color:#dab503;">info@sportshub365.com</a>&nbsp;&nbsp;&nbsp;Tel: +44 208 705 0525 <br />&nbsp; </div>';
					$content .= '</div></div>';
					//$content .= '</body></html>';
					$to = $values['email'];
					$subject = "Welcome to Sportshub365.com";
				
					/*$headers = "MIME-Version: 1.0" . "\r\n";
					$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
					$headers .= 'From: Sportshub365<info@sportshub365.com>' . "\r\n";
					mail($to,$subject,$content,$headers);*/
					
					$this->load->library('email');
					$this->email->set_newline("\r\n");
					$this->email->from('no-reply@sportshub365.com', 'Sportshub365.com');
					$this->email->set_mailtype("html");
					$this->email->to($to);
					$this->email->subject($subject);
					$this->email->message($content);
					$result =$this->email->send();

					$lastUser = $this->Establishment_model->gerLastuser($values['email']);
				   // $est_ref_id=$user_id[0]->id;
					$est_info_id = $this->Establishment_model->GetEstInfoId($lastUser);
					$_SESSION['est_info_id'] = $est_info_id;
					redirect('establishment/profile_settings');
					$this->data['email']=$values['email'];
					$this->data['password']=$values['password'];
					$this->data['re_password']=$values['re_password'];
				  }
				}
				else $this->data['msg']="The Email is already registered";
			  }
			  else $this->data['msg']="Password and retype password must be same.";
			}
		
		   }
		   
		  
		   $this->data['attribute']=$this->Establishment_model->SignupFormAttribute($values);
		   $this->load->view('establishment/signup',$this->data);
	 }
	public function forgot(){

	   if ($this->session->userdata('email')) {
	    redirect('establishment/home');
	   }
	   else
	   {
	   $this->load->helper('form');
	   $caller=$this->input->post('caller'); 
	   $values=array(); 
	   $this->data['here_about_us']="";
	   $this->data['errormsg']="";

	   if($caller == "Send")
	   {
		   
		    $values['email']=trim($this->input->post('email'));
		  
			
		    $this->load->library('form_validation'); 

			$this->form_validation->set_message('valid_email','Please enter a valid email id');
		    
		    $this->form_validation->set_rules('email','email','trim|callback_value_required[email]|valid_email');
		   

		    if($this->form_validation->run() == TRUE )// || $this->form_validation->run() == FALSE)
		    { 
			    $randompwd = $this->rand_password(8);
		  		$pwdencrypt = myencrypt($randompwd);

			 $msg=$this->Establishment_model->ResetUser($values['email'],$randompwd,$pwdencrypt );

			 if($msg=='success')
			 {
				$this->data['errormsg']='Your new password has bent sent to your email';
		     	//$this->load->view('establishment/forgot',$this->data);
			  }
			  else 
			  {$this->data['errormsg']=$msg;
			  }
			}
		   }

			$this->data['attribute']=$this->Establishment_model->ForgotFormAttribute($values);
		}
		   $this->load->view('establishment/forgot',$this->data);
	 		
	}
	 public function logout(){

        $this->load->library('facebook');

        // Logs off session from website
        $this->facebook->destroySession();
        // Make sure you destory website session as well.
		$this->session->sess_destroy();
		
        redirect('establishment/login');
    }
	 public function value_required($value,$field)
	 {

		$haserror=false;
	 	switch ($field) {
	 			case 'email':
	 			if($value=="" || $value=="Mail")
	 			{
	 				$this->form_validation->set_message('value_required', "Please enter email");
	 				$haserror=true;
	 			}
				break;
				
				case 'title':
	 			if($value=="" || $value=="Title / name at Bar")
	 			{
	 				$this->form_validation->set_message('value_required', "Please enter title");
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
	 		default:
	 			break;
	 	}

		return !$haserror;

	 }

	


	public function subscription()
	{
		
		 $this->load->model('Establishment_model');
		 $this->data['subscription_list']=$this->Establishment_model->GetSubscription();

		 $this->load->view('establishment/subscription',$this->data);

	}

	public function download_csv() {
			$this->load->model('Establishment_model');

			
			$list_records= $this->Establishment_model->GetSubscription();
			$XML = "Index, Name, Email, Address \t   \n";
			$sr=0;
				foreach($list_records as $lr) {
					$sr++;
					$XML.= $lr['no']. ",".$lr['name']. ", ".$lr['email'].", ".$lr['address']."\t \n";


				}
				$file='Leads-report.csv';
			header('Content-type: text/csv');
			header('Content-Disposition: attachment; filename='.$file);
			echo $XML;
	  }

	public function downloadpdf()
	{

		$this->load->model('Establishment_model');
		$this->data['subscription_list']=$this->Establishment_model->GetSubscription();
		$this->data['isPDF'] = true;

		$html = $this->load->view('establishment/subscription', $this->data, true);

		//this the the PDF filename that user will get to download
		$pdfFilePath = "the_pdf_output.pdf";
		 
		//load mPDF library
		$this->load->library('m_pdf');
		//actually, you can pass mPDF parameter on this load() function
		$pdf = $this->m_pdf->load();

$stylesheet1 = file_get_contents('css/bootstrap.min.css'); // external css
$stylesheet2 = file_get_contents('css/bootstrap-theme.min.css'); // external css
$stylesheet3 = file_get_contents('css/style.css'); // external css

$pdf->WriteHTML($stylesheet1,1);
$pdf->WriteHTML($stylesheet2,1);
$pdf->WriteHTML($stylesheet3,1);
		//generate the PDF!
		$pdf->WriteHTML($html,2);
		//offer it to user via browser download! (The PDF won't be saved on your server HDD)
		$pdf->Output($pdfFilePath, "D");

		redirect("establishment/subscription");

	}


    private function rand_password( $length ) {

    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    return substr(str_shuffle($chars),0,$length);

	}
 
}