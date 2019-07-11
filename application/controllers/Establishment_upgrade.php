<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Establishment_upgrade extends MY_Controller {

        
  	public function index()
	{
	   if ($this->session->userdata('email'))
	   {	
		  
		   $this->load->model('Establishment_model');

		   $ar= $this->session->all_userdata();
		   $this->load->helper('form');
		   $this->data['form_action']="insert";
		   $caller=$this->input->post('caller'); 
		   $this->data['caller']= $caller;
		   $values=array(); 
		   $values_card=array();
		   $this->data['msg']="";
		 

		   $e=$this->session->userdata('email');
		   $user_id=$this->Establishment_model->GetUserId($e);
	
		   $est_ref_id=$user_id[0]->id;
		   $this->data['establishment_id']= $est_ref_id;
		   $values_profile=$this->Establishment_model->GetProfileDetail($est_ref_id);
		   $est_info_id = $this->Establishment_model->GetEstInfoId($est_ref_id);
		   $this->data['card_info']=$this->Establishment_model->GetEstablishmentCardDetail($est_ref_id);
			//print_r($this->data['card_info']);
		   // checking for user email is subscribed or not
		   $this->data['is_subscribe']=$this->Establishment_model->CheckSubscription($e);
		   $this->data['premium_date']=$this->Establishment_model->CheckPremium($est_ref_id);


	       $est_ref_id=$user_id[0]->id;
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

         $this->data['attribute_upgrade_card']=$this->Establishment_model->UpgradeCardFormAttribute($values_upgrade_card);
         // end of upgrade card code

            $this->load->view('establishment/upgrade',$this->data);

		  }
		 else
			redirect('establishment/login');

	}


}