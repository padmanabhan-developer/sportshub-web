<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class App_profile_setting extends MY_Controller {

        
   public function index() {
	   
	   $this->load->model('App_model');
	   $this->load->helper('form');
	   $caller=$this->input->post('caller'); 
	   $values=array(); 
	   $this->data['msg']="";
	   $user_ref = $this->session->userdata('user_ref_id');
	 
		if ($user_ref!='') 
   			{ 
				$this->data['user'] = $this->App_model->GetUserDetail($user_ref);
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
									   
					$this->App_model->UpdateUserInfo($arrData, $user_ref);		
					
					redirect('app/profile_setting/');
				}
				$this->data['attribute_user']=$this->App_model->UserFormAttribute($values,$values_profile);
				
				if($caller == "Send")
				{
					$values['password']=trim($this->input->post('password'));
					$values['re_password']=trim($this->input->post('re_password'));
					$this->load->library('form_validation'); 
					$this->form_validation->set_rules('password','password', 'trim|callback_value_required[password]');	
					$this->form_validation->set_rules('re_password','re_password', 'trim|callback_value_required[re_password]');
					if($this->form_validation->run() == TRUE )
					{  
					 if($values['password']==$values['re_password'])
					 {
						$arrData= array('password' =>myencrypt( $values['password'] ));
						$this->App_model->UpdateUserPassword($arrData,$user_ref);
						
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
					  else { $this->data['msg']="Password and retype password must be same."; }
					}
				}
				$this->data['attribute']=$this->App_model->ChangePasswordFormAttribute($values);
				
				$this->load->view('app/profile_setting', $this->data );
			}
		else { 
			redirect('app/login');
		}	
	}
	
	public function value_required($value,$field)
	 {

		$haserror=false;
	 	switch ($field) {
	 		   

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
	 			if($value=="" || $value=="Mail")
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
	 		default:
	 			break;
	 	}

		return !$haserror;

	 }

}