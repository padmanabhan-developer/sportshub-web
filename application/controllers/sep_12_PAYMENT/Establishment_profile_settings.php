<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH . 'libraries/Stripe/lib/Stripe.php');

class Establishment_profile_settings extends MY_Controller {

        
   public function index()
	{
		// print_R($this->session->all_userdata());
	   $this->load->model('Establishment_model');
	   if ($this->session->userdata('email')) {
	   $ar= $this->session->all_userdata();
	   $this->load->helper('form');
	   $caller=$this->input->post('caller'); 
	   $values=array(); 
	   $values_upgrade_card=array();
	   $values_card=array();
	   $this->data['msg']="";
	   $this->data['facility_check']=array();
	   $e=$this->session->userdata('email');
	   $user_id=$this->Establishment_model->GetUserId($e);

       $est_ref_id=$user_id[0]->id;
       $this->data['establishment_id']= $est_ref_id;
	   $values_profile=$this->Establishment_model->GetProfileDetail($est_ref_id);
	   $this->data['profile_detail'] = $values_profile;
	    $est_info_id = $this->Establishment_model->GetEstInfoId($est_ref_id);
	   $this->data['card_info']=$this->Establishment_model->GetEstablishmentCardDetail($est_ref_id);
		//print_r($this->data['card_info']);
	   // checking for user email is subscribed or not
	   $this->data['is_subscribe']=$this->Establishment_model->CheckSubscription($e);
	   $this->data['premium_date']=$this->Establishment_model->CheckPremium($est_ref_id);
	   $facility_constants=$this->Establishment_model->GetFacilityConstants();
	   $establishment_facilities=$this->Establishment_model->GetEstablishmentFacilities($est_info_id);
	   $this->data['opening_hours']=$this->Establishment_model->WeekConstantList($est_info_id);
	   $this->data['happy_hours']= $this->Establishment_model->WeekConstantHappyHours($est_info_id);
	  // print_r($values_profile);
	   $facilities = array();
	    foreach( $facility_constants as $facility){

	    	$fac_id = $facility['id'];
			$fac_type = $facility['type'];
	    	if( in_array( $fac_id , $establishment_facilities ) ){
				
	    		if($fac_type =='check')
				$facility['is_checked'] = 'true';
				if($fac_type =='text'){
					
				$textval =$this->Establishment_model->GetEstablishmentFacilitydetail($est_info_id, $fac_id);
				$facility['is_checked'] = $textval;
				}
	    	}else{
	    		$facility['is_checked'] = 'false';
				if($fac_type =='text'){
				$facility['is_checked'] = '';
				}
	    	}

	    	$facilities[] = $facility;
	    }
		
	   	$this->data['facilities'] = $facilities;

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
					
						$insertRec['est_ref']=$est_info_id;
						$insertRec['week_ref']=$list['id'];
						if(!empty($opening[strtolower($list['name']).'_from']))
						{
							$insertRec['from_time']=date('H:i',strtotime($opening[strtolower($list['name']).'_from']));
						}
						else $insertRec['from_time']='';
						if(!empty($opening[strtolower($list['name']).'_to'])) $insertRec['to_time']= date('H:i',strtotime($opening[strtolower($list['name']).'_to']));
					
					else $insertRec['to_time']='';// 	 echo "<pre>";
					// print_r($insertRec);
					// echo "</pre>";
						$this->Establishment_model->InsertOpeningHours($insertRec);
				}
				$checkopening = $this->Establishment_model->CheckOpeningHours($est_info_id);
				if($checkopening >0)
				{
					$this->session->set_userdata('profile_step3',1);
				}
				else{
					$this->session->set_userdata('profile_step3',0);
				}
				redirect('establishment/profile_settings');
			}
		}
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
						
						$this->Establishment_model->InsertHappyHours($insertRecHappy);
				}
				$checkhappy = $this->Establishment_model->CheckHappyHours($est_info_id);
				if($checkhappy >0)
				{
					$this->session->set_userdata('profile_step4',1);
				}
				else{
					$this->session->set_userdata('profile_step4',0);
				}
				redirect('establishment/profile_settings');
			}
		}
		$this->data['msg_email'] = '';
	   	if($caller == "Send")
	   	{
		    $email = $this->session->userdata('email');
			$values['email']=trim($this->input->post('email'));
			$values['password']=trim($this->input->post('password'));
			$values['re_password']=trim($this->input->post('re_password'));
		    $this->load->library('form_validation'); 
			$this->form_validation->set_rules('email','email', 'trim|callback_value_required[email]');	
		    //$this->form_validation->set_rules('password','password', 'trim|callback_value_required[password]');	
			//$this->form_validation->set_rules('re_password','re password', 'trim|callback_value_required[re_password]');
		    if($this->form_validation->run() == TRUE )
		    {  
			 
			 if($values['email']!=$email) {
				$EmailData = array('email' => $values['email']); 
				$this->data['msg_email'] = $this->Establishment_model->UpdateEmail($EmailData,$this->session->userdata('est_ref_id'));
				$this->session->set_userdata($EmailData);
				$this->session->set_userdata('email',$values['email']);
			 }
			 
			 if($values['password']==$values['re_password'])
			 {
				if($values['password']!='') {
					$arrData= array('password' =>myencrypt( $values['password'] ));
					$this->Establishment_model->UpdateSubscription($arrData,$this->session->userdata('email'));
					$this->session->set_userdata($arrData);
					$this->session->set_userdata('password',myencrypt($values['password']));
					$this->data['msg']="Password changed sucessfully";
				}
			  }
			  else { $this->data['msg']="Password and retype password must be same."; }
			  
			  $this->data['email']=$values['email'];
			  $this->data['password']=$values['password'];
			  $this->data['re_password']=$values['re_password'];
			 }
			 
		}
		$this->data['attribute']=$this->Establishment_model->ChangePasswordFormAttribute($values,$this->session->userdata('email'));

		if($caller == "facility")
		{
		$this->data['facility']=$this->input->post('facility');
		$screens = $this->input->post('Screens');
		$capacity = $this->input->post('Capacity');
		$est_info_id = $this->Establishment_model->GetEstInfoId($est_ref_id);
		
		//print_r($this->data['facility']);
		$i=0;
		foreach($this->data['facility'] as $selected)
		{
			//$rec[$i]['est_ref_id']= $est_ref_id;
			//$rec[$i]['est_facility_ref']=$selected;
			$rec[] = array(
							'est_ref'=> $est_info_id,
							'est_facility_ref'=>$selected,
							'value' => ''
							);
			
			$i++;
		}
		//echo $screens."--".$capacity;exit;
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
		$this->Establishment_model->InsertFacility($rec,$est_info_id);
		//print_r($rec);
		$checkfacility = $this->Establishment_model->GetEstablishmentFacilities($est_info_id);
		if(count($checkfacility) >= 1){
			$this->session->set_userdata('profile_step5',1);
		}
		else{
			$this->session->set_userdata('profile_step5',0);
		}
		redirect('establishment/profile_settings');

	}
	   	if($caller == "Profile")
	   	{
		  
			$values['title']=trim($this->input->post('title'));
			$fullAdd = trim($this->input->post('address'));
			$adressval = explode(',',$fullAdd);
			$values['address']= $fullAdd;
			
			$values['city']=trim($this->input->post('city'));
			$values['zip']=trim($this->input->post('zip'));
			$values['phone']=trim($this->input->post('phone'));
			$values['contact_email']=trim($this->input->post('contact_email'));
			$values['website']=trim($this->input->post('website'));
			$values['country']=trim($this->input->post('country'));
			$lat=trim($this->input->post('geo_lat'));
			$long=trim($this->input->post('geo_lang'));
			$values['short_description']=trim($this->input->post('short_description'));
		    $this->load->library('form_validation'); 
		   
		    $address = $values['address'];
		   	$address = str_replace(" ", "+", $address);


			$arrData= array('title' => $values['title'] ,'address' => $values['address'],
				'city' => $values['city'],
				'zip' => $values['zip'],
				'country' => $values['country'],
				'phone' => $values['phone'],
				'contact_email' => $values['contact_email'],
				'website' => $values['website'],
				'short_description' => $values['short_description'],
				'geo_lat' => $lat,
				'geo_lang' => $long);
			   
			    $this->Establishment_model->UpdateProfileInfo($arrData,$this->session->userdata('email'));
				redirect('establishment/profile_settings');		     

		}
		$this->data['attribute_profile']=$this->Establishment_model->ProfileFormAttribute($values,$values_profile);
		

		//code for card details
		$values_card=$this->Establishment_model->GetCardDetail($est_ref_id);
		$values_upload=array();
		$values_upload['current_picture']=$this->Establishment_model->GetProDefaultPic($est_info_id);
		//print_r($values_upload['current_picture']);
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
			//		echo "sari".$est_ref_id;exit;
			$arrData=array();
						if(!empty($_FILES['picture']['name']) or !empty($values_upload['current_picture']))
						{
						 // delete previous image
						 unlink($path_to_upload.$values_upload['current_picture']);
							$arrData['picture']=$this->uploading_image_info['picture']['file_name'];
						}
						$this->Establishment_model->UpdateProfilePicture($arrData,$est_ref_id);
			
								 redirect('establishment/profile_settings');		     
		
				}
	  	}
	
	   $this->data['attribute_upload']=$this->Establishment_model->UploadFormAttribute($values_upload);

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
			    $this->Establishment_model->UpdateCardDetail($arrData,$est_ref_id);

			 }
		
		   }
		   
		$this->data['attribute_update_card']=$this->Establishment_model->UpdateCardFormAttribute($values_card);
  		// code for upgrade card
		//code for card details
	   $values_upgrade_card=$this->Establishment_model->GetCardDetailForUpgrade($est_ref_id);
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
			    //$this->Establishment_model->UpdateCardDetail($arrData,$est_ref_id);

			 }
		
		   }

		   /*
		   Get Stripe customer details


		   		   */

		   Stripe::setApiKey('sk_test_Be07JhmXOqf4dSffGjvIbkDJ');
		   $check_subscription = $this->Establishment_model->GetSubscriptionDetails($est_info_id); 
		   //print_r($check_subscription);
		   $this->data['free_status'] = $check_subscription['free_status'];
		   $this->data['free_days'] = $check_subscription['free_days'];
		   $this->data['free_days_left'] = $check_subscription['free_days_left'];
		   
		   
		   $this->data['subscription'] = $check_subscription['subscription'];
		   $this->data['subscription_expire'] = date("d-m-Y", strtotime($check_subscription['subscription_end']));;
		   $this->data['subscription_status'] = $check_subscription['subscription_status'];
		   $customer_stripe = Stripe_Customer::retrieve("cus_BIkhnkNQxtEIt9");
		  // print_r($customer_stripe);
		   //print_r($customer_stripe['id']);
		   //print_r($customer_stripe['subscriptions']['data'][0]['id']);
		   $subscription_id = $customer_stripe['subscriptions']['data'][0]['id'];
		   $subscription_starts = date('Y-m-d',$customer_stripe['subscriptions']['data'][0]['current_period_start']);
		   $subscription_ends = date('Y-m-d',$customer_stripe['subscriptions']['data'][0]['current_period_end']);
		   $subscription_plan = $customer_stripe['subscriptions']['data'][0]['plan']['id'];
		   $subscription_plan_amount = $customer_stripe['subscriptions']['data'][0]['plan']['amount'];
		   $subscription_plan_currency = $customer_stripe['subscriptions']['data'][0]['plan']['currency'];
		   $subscription_plan_status = $customer_stripe['subscriptions']['data'][0]['status'];
		   $subscription_details = 	array(  "customer_id"=>$customer_stripe['id'],
		   									"subscription_id"=>$customer_stripe['subscriptions']['data'][0]['id'],
		   									"substarts"=>$subscription_starts,
		   									"subends" =>$subscription_ends,
		   									"plan" =>$subscription_plan,
		   									"amount"=>$subscription_plan_amount,
		   									"currency"=>$subscription_plan_currency,
		   									"status"=>$subscription_plan_status
		   							);

       $this->data['attribute_upgrade_card']=$this->Establishment_model->UpgradeCardFormAttribute($values_upgrade_card);
       // end of upgrade card code
       $this->data['current_page']='profile-settings';
	   $this->load->view('establishment/profile-settings',$this->data);
		}

		else
			redirect('establishment/login');

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
				case 'email':
	 			if($value=="")
	 			{
	 				$this->form_validation->set_message('value_required', "Please enter email");
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

	public function account_history()
	{
	   if ($this->session->userdata('email'))
	   {	
		  
		   $this->load->model('Establishment_model');

		   $ar= $this->session->all_userdata();
		   
		 

		   $e=$this->session->userdata('email');
		   $user_id=$this->Establishment_model->GetUserId($e);
		   $est_ref_id=$user_id[0]->id;
 		   $this->data['account_history']=$this->Establishment_model->AccountHistory($est_ref_id);
 		  // print_r($this->data['account_history']);
 		   //$values_card=$this->Establishment_model->GetOfferDetails($offer_id);
	       
		       
			  
		         $this->load->view('establishment/account-history',$this->data);

		  }
		 else
			redirect('establishment/login');

	}


}