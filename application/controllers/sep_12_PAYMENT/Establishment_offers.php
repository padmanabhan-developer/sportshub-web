<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Establishment_offers extends MY_Controller {

        
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
		   $est_info_id = $this->Establishment_model->GetEstInfoId($est_ref_id);
 		   $this->data['all_offers']=$this->Establishment_model->AllOffer($est_info_id);
 		   $offer_id=$this->input->post('offer_id');
 		   //$values_card=$this->Establishment_model->GetOfferDetails($offer_id);
 		   $check_subscription = $this->Establishment_model->GetSubscriptionDetails($est_info_id); 
		   //print_r($check_subscription);
		   $this->data['free_status'] = $check_subscription['free_status'];
		   $this->data['subscription'] = $check_subscription['subscription'];
		   $this->data['free_days'] = $check_subscription['free_days'];
		   $this->data['free_days_left'] = $check_subscription['free_days_left'];
		   $this->data['subscription_expire'] = date("d-m-Y", strtotime($check_subscription['subscription_end']));;
		   $this->data['subscription_status'] = $check_subscription['subscription_status'];
	       $est_ref_id=$user_id[0]->id;
			$countoffer = $this->Establishment_model->countoffer($est_info_id);
			$this->data['maxcount']		 = $countoffer;
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
						    redirect('establishment/offers');

						 }
			
			    }
			  
			  
			   $this->data['attribute_offer']=$this->Establishment_model->AddOfferFormAttribute($values_card);
			  


            $this->load->view('establishment/offers',$this->data);

		  }
		 else
			redirect('establishment/login');

	}

	public function display_offer()
	{
	   if ($this->session->userdata('email'))
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
			   $e=$this->session->userdata('email');
			   $user_id=$this->Establishment_model->GetUserId($e);
			   $values_card=$this->Establishment_model->GetOfferDetails($offer_id);
			   $this->data['isactive']=$values_card['isactive'];
			   //print_r($values_card);
				 $est_ref_id=$user_id[0]->id;
				 $est_info_id = $this->Establishment_model->GetEstInfoId($est_ref_id);
		   if($offer_id > 0){
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
								redirect('establishment/offers');
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
			   $e=$this->session->userdata('email');
			   $user_id=$this->Establishment_model->GetUserId($e);
			   //$values_card=$this->Establishment_model->GetOfferDetails($offer_id);
			   //print_r($values_card);
				 $est_ref_id=$user_id[0]->id;
				 $est_info_id = $this->Establishment_model->GetEstInfoId($est_ref_id);
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
									redirect('establishment/offers');
		
								 }
					}
			   
			   
		   }

			$this->data['attribute_offer']=$this->Establishment_model->AddOfferFormAttribute($values_card);
            $this->load->view('establishment/add-offer',$this->data);

		  }
		 else
			redirect('establishment/login');

	}
 	
	public function add_new_offer()
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
		    $est_info_id = $this->Establishment_model->GetEstInfoId($est_ref_id);
 		   $offer_id=$this->input->post('offer_id');
 		   //$values_card=$this->Establishment_model->GetOfferDetails($offer_id);
	       $est_ref_id=$user_id[0]->id;
		       if($caller == "Offer")
			   {
				   
				    $values_card['title']=trim($this->input->post('title'));
					$values_card['description']=trim($this->input->post('description'));
					$values_card['price_or_discount']=trim($this->input->post('price_or_discount'));
					$values_card['promo_code'] = trim($this->input->post('promo_code'));
					$values_card['isactive'] = trim($this->input->post('isactive',TRUE));
					
					
					
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
						    redirect('establishment/offers');

						 }
			
			    }
			  
			   $this->data['attribute_offer']=$this->Establishment_model->AddOfferFormAttribute($values_card);
            $this->load->view('establishment/add-offer',$this->data);

		  }
		 else
			redirect('establishment/login');

	}
	
	public function delete($id)
	 {
	 	  $this->load->model('Establishment_model');
	   $this->Establishment_model->DeleteOffer($id);
	   redirect('establishment/offers');
      
	}

 	public function value_required($value,$field)
	 {

		$haserror=false;
	 	switch ($field)
	 	{
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

	 			
	 		default:
	 			break;
	 	}

		return !$haserror;

	  }

}