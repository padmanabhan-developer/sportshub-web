<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Promotion extends MY_Controller {

    /* Set Sportslover as home page temproraly to check Google Adsense Jul 04 */    
 	public function index()
    {
	   $this->load->model('Promotion_model');
	   $this->load->helper('form');
	   $caller=$this->input->post('caller'); 
	   $values=array(); 
	   $this->data['here_about_us']="";
	   if($caller == "Send")
	   {
		    $values['name']=trim($this->input->post('name'));
		    $values['email']=trim($this->input->post('email'));
		  
		    $values['address']=trim($this->input->post('address'));
			$values['password']=trim($this->input->post('password'));
			
		    $this->load->library('form_validation'); 

			$this->form_validation->set_message('valid_email','Please enter a valid email id');
		    $this->form_validation->set_rules('name','name','trim|callback_value_required[name]');
		    $this->form_validation->set_rules('email','email','trim|callback_value_required[email]|valid_email');
		    $this->form_validation->set_rules('address','address', 'trim|callback_value_required[address]');
			$this->form_validation->set_rules('password','password', 'trim|callback_value_required[password]');

		    if($this->form_validation->run() == TRUE )// || $this->form_validation->run() == FALSE)
		    {  
			 
			 
				$arrData= array(
					   
					   'name' => $values['name'],
					   'email' => $values['email'],
					   'address' =>$values['address'],
					   'password' =>myencrypt( $values['password'] )
					   
				 );
			     
			     	$this->Promotion_model->RegisterSubscription($arrData);

			     	redirect('promotion/success');

					 $this->data['name']=$values['name'];
					 $this->data['email']=$values['email'];
					 $this->data['address']=$values['address'];
					 $this->data['password']=$values['password'];

				// redirect('promotion/success');
			 //exit;
			}
		}
		$this->data['attribute']=$this->Promotion_model->SignupFormAttribute($values);
		$this->load->view('promotion/sportslover',$this->data);
	 }
	 
	 /* Default Home page */
  	public function index_ORIGIINAL()
    {
	   $this->load->model('Promotion_model');
	   $this->load->helper('form');
	   $caller=$this->input->post('caller'); 
	   $values=array(); 
	   $this->data['here_about_us']="";
	   if($caller == "Send")
	   {
		    $values['name']=trim($this->input->post('name'));
		    $values['email']=trim($this->input->post('email'));
		  
		    $values['address']=trim($this->input->post('address'));
			$values['password']=trim($this->input->post('password'));
			
		    $this->load->library('form_validation'); 

			$this->form_validation->set_message('valid_email','Please enter a valid email id');
		    $this->form_validation->set_rules('name','name','trim|callback_value_required[name]');
		    $this->form_validation->set_rules('email','email','trim|callback_value_required[email]|valid_email');
		    $this->form_validation->set_rules('address','address', 'trim|callback_value_required[address]');
			$this->form_validation->set_rules('password','password', 'trim|callback_value_required[password]');

		    if($this->form_validation->run() == TRUE )// || $this->form_validation->run() == FALSE)
		    {  
			 
			 
				$arrData= array(
					   
					   'name' => $values['name'],
					   'email' => $values['email'],
					   'address' =>$values['address'],
					   'password' =>myencrypt( $values['password'] )
					   
				 );
			     
			     	$this->Promotion_model->RegisterSubscription($arrData);

			     	redirect('promotion/success');

					 $this->data['name']=$values['name'];
					 $this->data['email']=$values['email'];
					 $this->data['address']=$values['address'];
					 $this->data['password']=$values['password'];


				// redirect('promotion/success');
				 
			 //exit;
			}
		
		   }
		   
		  
		   $this->data['attribute']=$this->Promotion_model->SignupFormAttribute($values);
		   $this->load->view('promotion/home',$this->data);
	 }
	
	public function venue()
    {
	   $this->load->model('Promotion_model');
	   $this->load->helper('form');
	   $caller=$this->input->post('caller'); 
	   $values=array(); 
	   $this->data['here_about_us']="";
	   if($caller == "Send")
	   {
		    $values['name']=trim($this->input->post('name'));
		    $values['email']=trim($this->input->post('email'));
		  
		    $values['address']=trim($this->input->post('address'));
			$values['password']=trim($this->input->post('password'));
			
		    $this->load->library('form_validation'); 

			$this->form_validation->set_message('valid_email','Please enter a valid email id');
		    $this->form_validation->set_rules('name','name','trim|callback_value_required[name]');
		    $this->form_validation->set_rules('email','email','trim|callback_value_required[email]|valid_email');
		    $this->form_validation->set_rules('address','address', 'trim|callback_value_required[address]');
			$this->form_validation->set_rules('password','password', 'trim|callback_value_required[password]');

		    if($this->form_validation->run() == TRUE )// || $this->form_validation->run() == FALSE)
		    {  
			 
			 
				$arrData= array(
					   
					   'name' => $values['name'],
					   'email' => $values['email'],
					   'address' =>$values['address'],
					   'password' =>myencrypt( $values['password'] )
					   
				 );
			     
			     	$this->Promotion_model->RegisterSubscription($arrData);

			     	redirect('promotion/success');

					 $this->data['name']=$values['name'];
					 $this->data['email']=$values['email'];
					 $this->data['address']=$values['address'];
					 $this->data['password']=$values['password'];


				// redirect('promotion/success');
				 
			 //exit;
			}
		
		   }
		   
		  
		   $this->data['attribute']=$this->Promotion_model->SignupFormAttribute($values);
		   $this->load->view('promotion/venue',$this->data);
	 }
	 
  	public function home()
    {
	   $this->load->model('Promotion_model');
	   $this->load->helper('form');
	   $caller=$this->input->post('caller'); 
	   $values=array(); 
	   $this->data['here_about_us']="";
	   if($caller == "Send")
	   {
		    $values['name']=trim($this->input->post('name'));
		    $values['email']=trim($this->input->post('email'));
		  
		    $values['address']=trim($this->input->post('address'));
			$values['password']=trim($this->input->post('password'));
			
		    $this->load->library('form_validation'); 

			$this->form_validation->set_message('valid_email','Please enter a valid email id');
		    $this->form_validation->set_rules('name','name','trim|callback_value_required[name]');
		    $this->form_validation->set_rules('email','email','trim|callback_value_required[email]|valid_email');
		    $this->form_validation->set_rules('address','address', 'trim|callback_value_required[address]');
			$this->form_validation->set_rules('password','password', 'trim|callback_value_required[password]');

		    if($this->form_validation->run() == TRUE )// || $this->form_validation->run() == FALSE)
		    {  
			 
			 
				$arrData= array(
					   
					   'name' => $values['name'],
					   'email' => $values['email'],
					   'address' =>$values['address'],
					   'password' =>myencrypt( $values['password'] )
					   
				 );
			     	$this->Promotion_model->RegisterSubscription($arrData);

			     	redirect('promotion/success');

					 $this->data['name']=$values['name'];
					 $this->data['email']=$values['email'];
					 $this->data['address']=$values['address'];
					 $this->data['password']=$values['password'];

				// redirect('promotion/success');
				 
			 //exit;
			}
		   }
		  
		   $this->data['attribute']=$this->Promotion_model->SignupFormAttribute($values);
		   $this->load->view('promotion/home',$this->data);
	 }
  	public function download()
    {
	   $this->load->model('Promotion_model');
	   $this->load->helper('form');
	   $caller=$this->input->post('caller'); 
	   $values=array(); 
	   $this->data['here_about_us']="";
	   if($caller == "Send")
	   {
		    $values['name']=trim($this->input->post('name'));
		    $values['email']=trim($this->input->post('email'));
		  
		    $values['address']=trim($this->input->post('address'));
			$values['password']=trim($this->input->post('password'));
			
		    $this->load->library('form_validation'); 

			$this->form_validation->set_message('valid_email','Please enter a valid email id');
		    $this->form_validation->set_rules('name','name','trim|callback_value_required[name]');
		    $this->form_validation->set_rules('email','email','trim|callback_value_required[email]|valid_email');
		    $this->form_validation->set_rules('address','address', 'trim|callback_value_required[address]');
			$this->form_validation->set_rules('password','password', 'trim|callback_value_required[password]');

		    if($this->form_validation->run() == TRUE )// || $this->form_validation->run() == FALSE)
		    {  
			 
			 
				$arrData= array(
					   
					   'name' => $values['name'],
					   'email' => $values['email'],
					   'address' =>$values['address'],
					   'password' =>myencrypt( $values['password'] )
					   
				 );
			     
			     	$this->Promotion_model->RegisterSubscription($arrData);

			     	redirect('promotion/success');

					 $this->data['name']=$values['name'];
					 $this->data['email']=$values['email'];
					 $this->data['address']=$values['address'];
					 $this->data['password']=$values['password'];


				// redirect('promotion/success');
				 
			 //exit;
			}
		
		   }
		   
		  
		   $this->data['attribute']=$this->Promotion_model->SignupFormAttribute($values);
		   $this->load->view('promotion/download',$this->data);
	 }
	 
	public function personalplanner()
    {
	   $this->load->model('Promotion_model');
	   $this->load->helper('form');
	   $caller=$this->input->post('caller'); 
	   $values=array(); 
	   $this->data['here_about_us']="";
	   if($caller == "Send")
	   {
		    $values['name']=trim($this->input->post('name'));
		    $values['email']=trim($this->input->post('email'));
		  
		    $values['address']=trim($this->input->post('address'));
			$values['password']=trim($this->input->post('password'));
			
		    $this->load->library('form_validation'); 

			$this->form_validation->set_message('valid_email','Please enter a valid email id');
		    $this->form_validation->set_rules('name','name','trim|callback_value_required[name]');
		    $this->form_validation->set_rules('email','email','trim|callback_value_required[email]|valid_email');
		    $this->form_validation->set_rules('address','address', 'trim|callback_value_required[address]');
			$this->form_validation->set_rules('password','password', 'trim|callback_value_required[password]');

		    if($this->form_validation->run() == TRUE )// || $this->form_validation->run() == FALSE)
		    {  
			 
			 
				$arrData= array(
					   
					   'name' => $values['name'],
					   'email' => $values['email'],
					   'address' =>$values['address'],
					   'password' =>myencrypt( $values['password'] )
					   
				 );
			     
			     	$this->Promotion_model->RegisterSubscription($arrData);

			     	redirect('promotion/success');

					 $this->data['name']=$values['name'];
					 $this->data['email']=$values['email'];
					 $this->data['address']=$values['address'];
					 $this->data['password']=$values['password'];

				// redirect('promotion/success');
			 //exit;
			}
		}
		$this->data['attribute']=$this->Promotion_model->SignupFormAttribute($values);
		$this->load->view('promotion/personalplanner',$this->data);
	 }
	
	Public function recommendbar()
    {
	   $this->load->model('Promotion_model');
	   $this->load->helper('form');
	   $caller=$this->input->post('caller'); 
	   $values=array(); 
	   $this->data['here_about_us']="";
	   if($caller == "Send")
	   {
		    $values['name']=trim($this->input->post('name'));
		    $values['email']=trim($this->input->post('email'));
		  
		    $values['address']=trim($this->input->post('address'));
			$values['password']=trim($this->input->post('password'));
			
		    $this->load->library('form_validation'); 

			$this->form_validation->set_message('valid_email','Please enter a valid email id');
		    $this->form_validation->set_rules('name','name','trim|callback_value_required[name]');
		    $this->form_validation->set_rules('email','email','trim|callback_value_required[email]|valid_email');
		    $this->form_validation->set_rules('address','address', 'trim|callback_value_required[address]');
			$this->form_validation->set_rules('password','password', 'trim|callback_value_required[password]');

		    if($this->form_validation->run() == TRUE )// || $this->form_validation->run() == FALSE)
		    {  
				$arrData= array(
					   
					   'name' => $values['name'],
					   'email' => $values['email'],
					   'address' =>$values['address'],
					   'password' =>myencrypt( $values['password'] )
					   
				 );
			     	$this->Promotion_model->RegisterSubscription($arrData);
			     	redirect('promotion/success');

					 $this->data['name']=$values['name'];
					 $this->data['email']=$values['email'];
					 $this->data['address']=$values['address'];
					 $this->data['password']=$values['password'];

				// redirect('promotion/success');
			 //exit;
			}
		}
		$this->data['attribute']=$this->Promotion_model->RecBarFormAttribute($values);
		$this->load->view('promotion/recommendbar',$this->data);
	 }
	
	Public function addrecommend()
    {
		$this->load->model('Promotion_model');
		//print_r($_POST);
		$data = $_POST;
		
		$res = $this->Promotion_model->addrecommnedbar($data);
		echo $res; 
		
	}
	public function sportslover()
    {
	   $this->load->model('Promotion_model');
	   $this->load->helper('form');
	   $caller=$this->input->post('caller'); 
	   $values=array(); 
	   $this->data['here_about_us']="";
	   if($caller == "Send")
	   {
		    $values['name']=trim($this->input->post('name'));
		    $values['email']=trim($this->input->post('email'));
		  
		    $values['address']=trim($this->input->post('address'));
			$values['password']=trim($this->input->post('password'));
			
		    $this->load->library('form_validation'); 

			$this->form_validation->set_message('valid_email','Please enter a valid email id');
		    $this->form_validation->set_rules('name','name','trim|callback_value_required[name]');
		    $this->form_validation->set_rules('email','email','trim|callback_value_required[email]|valid_email');
		    $this->form_validation->set_rules('address','address', 'trim|callback_value_required[address]');
			$this->form_validation->set_rules('password','password', 'trim|callback_value_required[password]');

		    if($this->form_validation->run() == TRUE )// || $this->form_validation->run() == FALSE)
		    {  
			 
			 
				$arrData= array(
					   
					   'name' => $values['name'],
					   'email' => $values['email'],
					   'address' =>$values['address'],
					   'password' =>myencrypt( $values['password'] )
					   
				 );
			     
			     	$this->Promotion_model->RegisterSubscription($arrData);

			     	redirect('promotion/success');

					 $this->data['name']=$values['name'];
					 $this->data['email']=$values['email'];
					 $this->data['address']=$values['address'];
					 $this->data['password']=$values['password'];

				// redirect('promotion/success');
			 //exit;
			}
		}
		$this->data['attribute']=$this->Promotion_model->SignupFormAttribute($values);
		$this->load->view('promotion/sportslover',$this->data);
	 }
	
	public function promotions()
    {
		$this->load->view('promotion/promotions');	
	}
	public function promotion_new(){
		
	   $this->load->model('Promotion_model');
	   $this->load->helper('form');
	   $caller=$this->input->post('caller'); 
	   $values=array(); 
	   $this->data['here_about_us']="";
	   if($caller == "Send")
	   {
		    $values['name']=trim($this->input->post('name'));
		    $values['email']=trim($this->input->post('email'));
		  
		    $values['address']=trim($this->input->post('address'));
			$values['password']=trim($this->input->post('password'));
			
		    $this->load->library('form_validation'); 

			$this->form_validation->set_message('valid_email','Please enter a valid email id');
		    $this->form_validation->set_rules('name','name','trim|callback_value_required[name]');
		    $this->form_validation->set_rules('email','email','trim|callback_value_required[email]|valid_email');
		    $this->form_validation->set_rules('address','address', 'trim|callback_value_required[address]');
			$this->form_validation->set_rules('password','password', 'trim|callback_value_required[password]');

		    if($this->form_validation->run() == TRUE )// || $this->form_validation->run() == FALSE)
		    {  
			 
			 
				$arrData= array(
					   
					   'name' => $values['name'],
					   'email' => $values['email'],
					   'address' =>$values['address'],
					   'password' =>myencrypt( $values['password'] )
					   
				 );
			     
			     	$this->Promotion_model->RegisterSubscription($arrData);

			     	redirect('promotion/success');

					 $this->data['name']=$values['name'];
					 $this->data['email']=$values['email'];
					 $this->data['address']=$values['address'];
					 $this->data['password']=$values['password'];


				// redirect('promotion/success');
				 
			 //exit;
			}
		
		   }
		   
		  
		   $this->data['attribute']=$this->Promotion_model->SignupFormAttribute($values);
		   $this->load->view('promotion/promotion',$this->data);
	 
	}


	public function authenticate()
  	{
	   if ($this->session->userdata('pro_email'))
	   {
	    redirect('promotion/subscription');
	   }
	   else
	   {
	   $this->load->model('Promotion_model');
	   $this->load->helper('form');
	   $caller=$this->input->post('caller'); 
	   $values=array(); 
	   $this->data['here_about_us']="";
	   $this->data['errormsg']="";

	   if($caller == "Send")
	   {
		   
		    $values['pro_email']=trim($this->input->post('pro_email'));
		  
			$values['password']=trim($this->input->post('password'));
			
		    $this->load->library('form_validation'); 

			//$this->form_validation->set_message('valid_email','Please enter a valid email id');
		    
		    $this->form_validation->set_rules('pro_email','email','trim|callback_value_required[pro_email]');
		   
			$this->form_validation->set_rules('password','password', 'trim|callback_value_required[password]');

		    if($this->form_validation->run() == TRUE )// || $this->form_validation->run() == FALSE)
		    {  
			 $msg=$this->Promotion_model->CheckUser($values['pro_email'],myencrypt($values['password']));

			 if($msg=='success')
			 {
			 	$newdata=array('pro_email'=>$values['pro_email'],
			 		'pro_password'=>myencrypt($values['password']));
			 	$this->session->set_userdata($newdata);
		     	redirect('promotion/subscription');



			  }
			  else $this->data['errormsg']=$msg;
					 
					 $this->data['pro_email']=$values['pro_email'];
					 $this->data['password']=$values['password'];


				// redirect('establishment/home');
				 
			 //exit;
			}
		
		   }
		   
		  // for facebook
		  // Automatically picks appId and secret from config



			$this->data['attribute']=$this->Promotion_model->LoginFormAttribute($values);
			        // OR
        // You can pass different one like this
        //$this->load->library('facebook', array(
        //    'appId' => 'APP_ID',
        //    'secret' => 'SECRET',
        //    ));

		}

		   
		   $this->load->view('promotion/authenticate',$this->data);
	 }

	/*public function venue()
	{
	   $this->load->model('Promotion_model');
	   $this->load->view('promotion/venue');

	}*/
	 public function value_required($value,$field)
	 {

		$haserror=false;
	 	switch ($field) {
	 		    case 'name':
	 			if($value=="" || $value=="Establishment name")
	 			{
	 				$this->form_validation->set_message('value_required', "Please enter name");
	 				$haserror=true;

	 			}
	 			break;

	 			case 'address':
	 			if($value=="" || $value=="Address of the Establishment")
	 			{
	 				$this->form_validation->set_message('value_required', "Please enter address");
	 				$haserror=true;

	 			}
	 			break;
	 			case 'pro_email':
	 			if($value=="" || $value=="Username")
	 			{
	 				$this->form_validation->set_message('value_required', "Please enter email");
	 				$haserror=true;

	 			}
	 			break;
	 			case 'email':
	 			if($value=="" || $value=="Your e-mail")
	 			{
	 				$this->form_validation->set_message('value_required', "Please enter email");
	 				$haserror=true;

	 			}
	 			else if( $this->Promotion_model->isExist($value) == TRUE ){
	 				$this->form_validation->set_message('value_required', "Email is already registered");
	 				$haserror=true;
	 			}
	 			break;

	 			case 'password':
	 			if($value=="" || $value=="Password")
	 			{
	 				$this->form_validation->set_message('value_required', "Please enter password");
	 				$haserror=true;

	 			}
	 			else if(strlen($value)<6)
	 			{
	 				$this->form_validation->set_message('value_required', "Password length should be atleast 6");
	 				$haserror=true;
	 			}
	 			break;
	 		
	 		default:
	 			break;
	 	}

		return !$haserror;

	 }

	 public function success()
	{
		 $this->load->view('promotion/success');

	}
 


	public function subscription()
	{
		if ($this->session->userdata('pro_email'))
	   {
	   	$this->load->model('Promotion_model');
		 $this->data['subscription_list']=$this->Promotion_model->GetSubscription();

		 $this->load->view('promotion/subscription',$this->data);

	   
	   }
	   else  redirect('promotion/authenticate');

		 
	}

	public function download_csv() {
			$this->load->model('Promotion_model');

			
			$list_records= $this->Promotion_model->GetSubscription();
			$XML = "Index, Name, Email, Address \t   \n";
			$sr=0;
				foreach($list_records as $lr) {
					$sr++;
					$XML.= $lr['no']. ",".$lr['name']. ", ".$lr['email'].", ".$lr['address']."\t \n";


				}
				$file='subscription.csv';
			header('Content-type: text/csv');
			header('Content-Disposition: attachment; filename='.$file);
			echo $XML;
	  }

	public function downloadpdf()
	{

		$this->load->model('Promotion_model');
		$this->data['subscription_list']=$this->Promotion_model->GetSubscription();
		$this->data['isPDF'] = true;

		$html = $this->load->view('promotion/subscription', $this->data, true);

		//this the the PDF filename that user will get to download
		$pdfFilePath = "subscription.pdf";
		 
		//load mPDF library
		$this->load->library('M_pdf');
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

		redirect("promotion/subscription");
	}

   public function privacy() { 
   		$this->load->view('promotion/privacy');
   }
   
   public function terms() { 
   		$this->load->view('promotion/terms');
   }
       
	/*********  Sports Fan Find Bars and Matches) pages edited by Bagyaraj Sekar May 18, 2017      */
	
	public function bar()
    {
	   
	   $this->load->model('Promotion_model');
	   $this->load->helper('form');
	   $bar_id =$this->uri->segment(3); 
	   $fixture_id =$this->uri->segment(4); 
	   $check_bar = 	$this->Promotion_model->CheckBarExists($bar_id);
	   $check_game = 	$this->Promotion_model->GetGameDetails($fixture_id);
	   $this->data['gamedetails'] ='';
	   if((count($check_game) > 0) && ($check_game['fixture_id'])){
		   $this->data['gamedetails'] = $check_game;
	   }
	   if($check_bar){
		  
		   $this->data['profiledetails']=$this->Promotion_model->GetBarDetail($bar_id);
		   $this->data['facilities']=$this->Promotion_model->GetBarFacilities($bar_id);
		   $this->data['openinghours']=$this->Promotion_model->GetBarOpeningHours($bar_id);
		   $this->data['happyhours']=$this->Promotion_model->GetBarHappyHours($bar_id);
		   $this->data['events']=$this->Promotion_model->getBarEvents($bar_id);
		   $this->data['offers']=$this->Promotion_model->GetBarOffer($bar_id);
		   $this->data['schedules']=$this->Promotion_model->GetBarSchedules($bar_id);
		   $this->load->view('promotion/bar',$this->data);
	   }
	   else{
		   $this->data['heading'] ='No bar found';
		   $this->data['message'] ='No bar found';
		   $this->load->view('errors/html/error_404',$this->data);
	   }
	 }
	
	public function bars()
    {
	   
	   $this->load->model('Promotion_model');
	   $this->load->helper('form');
	   $fixture_id =$this->uri->segment(3); 
	   $check_game = 	$this->Promotion_model->GetGameDetails($fixture_id);
	   //print_r($check_game);
		   $user_key='';$rel_sport_id='';$league_id='';$latitude='';$longitude='';$distance='';$sync_date='';$sortby='';$offset=0;$limit=200;
	    
		
		$filter = $this->input->get('filteropt[]');
		$filteraddress=  $this->input->get('address');
		$latitude=  $this->input->get('lat');
		$longitude=  $this->input->get('lon');
		$this->data['filteraddress']=$filteraddress;
		$this->data['latitude']=$latitude;
		$this->data['longitude']=$longitude;
	   if((count($check_game) > 0) && ($check_game['fixture_id'])){
		   $this->data['gamedetails'] = $check_game;
		   if(count($filter) > 0)
		   {
			   	$sortby = $filter;
		   		
				$this->data['sortby'] = $sortby;
		   }
		  $this->data['profiles']=$this->Promotion_model->GetBars( $fixture_id,$latitude,$longitude,$distance,$sync_date,$sortby,$offset,$limit);
		  
		   $this->data['allfacilities']=$this->Promotion_model->GetFacilityConstants();
		  /* $this->data['openinghours']=$this->Promotion_model->GetBarOpeningHours($bar_id);
		   $this->data['happyhours']=$this->Promotion_model->GetBarHappyHours($bar_id);
		   $this->data['events']=$this->Promotion_model->getBarEvents($bar_id);
		   $this->data['offers']=$this->Promotion_model->GetBarOffer($bar_id);
		   $this->data['schedules']=$this->Promotion_model->GetBarSchedules($bar_id);*/
		   //print_r($this->data['facilities']);
		   //print_r($this->data['profiles']);
		   $this->load->view('promotion/bars',$this->data);
	   }
	   else{
		   $this->data['heading'] ='No game found';
		   $this->data['message'] ='No game found';
		   $this->load->view('errors/html/error_404',$this->data);
	   }
	 }
	
	public function findmatch()
    {
	   
	   $this->load->model('Promotion_model');
	   $this->load->helper('form');
	   $val =$this->input->get('findval');
	   $type =$this->input->get('findtype');
	   $typeid =$this->input->get('findid');
	   $float = $this->input->get('float');
	   $searchapi = $this->input->get('searchapi');
	  $banner_search =$this->input->get('banner_search');
	   $header_search =$this->input->get('header_search');
	   $this->data['profiledetails']['title']='Find Match';
	   $this->data['findval'] = $val;
	   $this->data['type'] = $type;
	   $this->data['typeid'] = $typeid;
	   $this->data['banner_search'] = $banner_search;
	   if($float==1){
		   $this->data['banner_search'] = $header_search;
		   $banner_search= $header_search;
	   }
	   
	   if($type && $type == 'Team' && $searchapi==1){
		  $this->data['schedules']=$this->Promotion_model->GetMatchesDetailsByTeam($typeid);
	   }
	   else if($type && $type == 'Sport' && $searchapi==1){
		    $this->data['schedules']=$this->Promotion_model->GetMatchesDetailsBySport($typeid);
		}
	   else if($type && $type == 'League'&& $searchapi==1){
		    $this->data['schedules']=$this->Promotion_model->GetMatchesDetailsByCompetition($typeid);
		}
	   else if($type &&  $type == 'Search' && $searchapi==0){
		    $this->data['schedules']=$this->Promotion_model->GetMatchesDetailsBySearch($banner_search);
	   }
	   else{
			$this->data['schedules']=$this->Promotion_model->GetAllMatches();
	   }
	   
		  // print_r($this->data['schedules']);
		   $this->load->view('promotion/findmatch',$this->data);
	 }
	 public function availablelists(){
		$this->load->model('Promotion_model');
		$term=$this->input->get('term'); 
		$availablelist = 	$this->Promotion_model->GetAvailableLists($term);
		 echo $availablelist;
	 }
	
}