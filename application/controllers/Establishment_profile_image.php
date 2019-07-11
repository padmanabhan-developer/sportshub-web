<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Establishment_profile_image extends MY_Controller {

        
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
	   $est_info_id = $this->Establishment_model->GetEstInfoId($est_ref_id);
		//print_r($this->data['card_info']);
	   // checking for user email is subscribed or not

	   $facilities = array();
		
	   	$this->data['facilities'] = $facilities;

		//exit;
		//code for card details
		if($caller == "ProfileGallery")
		{
			$defaultim=trim($this->input->post('defaultimage'));

			$updateGallery= $this->Establishment_model->upgateGallery($est_info_id, $defaultim);
			redirect('establishment/profile_settings');
					
	  	}
			//$profileGallery = array();
			$profileGallery = $this->Establishment_model->getProfileGallery($est_info_id);
			
	   		$this->data['profileGallery'] = $profileGallery;

			 $this->load->view('establishment/profile-image',$this->data);
		}

		else
			redirect('establishment/login');

	}
	public function remove_gallery_image()
	{
	   $this->load->model('Establishment_model');
	   if ($this->session->userdata('email')) {
		   $ar= $this->session->all_userdata();
		   $this->load->helper('form');
		   $caller=$this->input->post('caller'); 
		   $e=$this->session->userdata('email');
		   $user_id=$this->Establishment_model->GetUserId($e);
	
		   $est_ref_id=$user_id[0]->id;
		   $this->data['establishment_id']= $est_ref_id;
		   $values_profile=$this->Establishment_model->GetProfileDetail($est_ref_id);
		   $est_info_id = $this->Establishment_model->GetEstInfoId($est_ref_id);
		   //echo $caller;exit;
			if($caller == "delete"){
				$proImageId = $this->input->post('imageId');
				if($proImageId){
					$removeres = $this->Establishment_model->removeGalleryImage($proImageId, $est_info_id);	
					echo $removeres;
				}
			}
			else echo 0;
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