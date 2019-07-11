<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH . 'libraries/Stripe/lib/Stripe.php');

class LiveBar extends MY_Controller {


	public function index(){

        if($this->session->userdata('email'))
          {
        $this->load->model('Promotion_model');
        $this->load->model('Establishment_model');
        $id=$this->session->userdata('email');
        $user_id=$this->Establishment_model->GetUserId($id);
        $est_ref_id=$user_id[0]->id;
        //echo json_encode($est_ref_id);
        $est_info_id = $this->Promotion_model->GetEstId($est_ref_id);
        //echo json_encode($est_info_id[0]);
        //redirect('promotion/bar/'.$est_info_

       //$this->load->model('Promotion_model');
	   $this->load->helper('form');
	   //echo json_encode($est_info_id[0]);exit;
	   $bar_id=$est_info_id[0]->id;
	   //$bar_id =$this->''
	   $fixture_id =$this->uri->segment(4); 
	   $check_bar = 	$this->Promotion_model->CheckBarExists($bar_id);
	   $check_game = 	$this->Promotion_model->GetGameDetails($fixture_id);
	   $this->data['gamedetails'] ='';


	 	//$this->load->model('Establishment_model');
	   $ar= $this->session->all_userdata();
	   $this->load->helper('form');
	   $caller=$this->input->post('caller'); 
	   $values=array(); 
	   $this->data['msg']="";
	   $this->data['facility_check']=array();
	   $e=$this->session->userdata('email');
	   $user_id=$this->Establishment_model->GetUserId($e);

       $est_ref_id=$user_id[0]->id;
       $this->data['establishment_id']= $est_ref_id;
	   $values_profile=$this->Establishment_model->GetProfileDetail($est_ref_id);
	   $this->data['profile_detail'] = $values_profile;
	    $est_info_id = $this->Establishment_model->GetEstInfoId($est_ref_id);

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

	    	$facility_[] = $facility;
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
				redirect('LiveBar');
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
				redirect('LiveBar');
			}
		}
	




	   

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
		
		redirect('LiveBar');

	}
   

	  
		$this->data['msg_email'] = '';
	  
	
	   	if($caller == "ProfileAddress")
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
			   
			    $this->Establishment_model->UpdateProfileInfoAddress($arrData,$this->session->userdata('email'));
				redirect('establishment/profile_settings');		     

		}}else{
			redirect('establishment/login');
		}

		





	   if((count($check_game) > 0) && ($check_game['fixture_id'])){
		   $this->data['gamedetails'] = $check_game;
	   }
	   if($check_bar){

	   	$this->data['facility_schedule'] = $facility_;
		$this->data['attribute_profile']=$this->Establishment_model->ProfileFormAttribute($values,$values_profile);
	   	$this->data['attribute_profile_about']=$this->Establishment_model->ProfileFormAttribute_About($values,$values_profile);
	    $this->data['attribute_profile_contact']=$this->Establishment_model->ProfileFormAttribute_Contact($values,$values_profile);

	     	$this->data['opening_hours']=$this->Establishment_model->WeekConstantList($est_info_id);
	        $this->data['happy_hours']= $this->Establishment_model->WeekConstantHappyHours($est_info_id);
		   
		    
		   $this->data['profiledetails']=$this->Promotion_model->GetBarDetail($bar_id);
		   //echo json_encode($this->Promotion_model->GetBarDetail($bar_id));
		   $this->data['facilities']=$this->Promotion_model->GetBarFacilities($bar_id);
		   $this->data['openinghours']=$this->Promotion_model->GetBarOpeningHours($bar_id);
		   $this->data['happyhours']=$this->Promotion_model->GetBarHappyHours($bar_id);
		   $this->data['events']=$this->Promotion_model->getBarEvents($bar_id);
		   $this->data['offers']=$this->Promotion_model->GetBarOffer($bar_id);
		   $this->data['schedules1']=$this->Promotion_model->GetBarSchedules($bar_id);


// echo json_encode($this->session->flashdata('success')); 
	   $val =$this->input->get('findval');
	   //echo json_encode($val);
	   $displayval =$this->input->get('displayval');
	   //echo json_encode($displayval);
	   $type =$this->input->get('findtype');
	   //echo json_encode($type);
	   $typeid =$this->input->get('findid');
	   //echo json_encode($typeid);
	   $float = $this->input->get('float');
	   //echo json_encode($float);
	   $searchapi = $this->input->get('searchapi');
	   //echo json_encode($searchapi);
	   $banner_search =$this->input->get('banner_search');
	   //echo json_encode($banner_search);
	   $header_search =$this->input->get('header_search');
	   //echo json_encode($header_search);
	   $this->data['findval'] = $val;
	   $this->data['displayval'] = $displayval;
	   $this->data['type'] = $type;
	   $this->data['typeid'] = $typeid;
	   $this->data['banner_search'] = $banner_search;
	   // $this->data['searchapi'] = $searchapi;
	   if($float==1){
		   $this->data['banner_search'] = $header_search;
		   $banner_search= $header_search;
		   $val =$this->input->get('findval');
	   }
	   
	   if($type && $type == 'Team' && $searchapi==1){
		  $this->data['schedules']=$this->Promotion_model->GetMatchesDetailsByTeamLivebar($typeid);
	   }
	   else if($type && $type == 'Sport' && $searchapi==1){
		    $this->data['schedules']=$this->Promotion_model->GetMatchesDetailsBySportLivebar($typeid);
		}
	   else if($type && $type == 'League'&& $searchapi==1){
		    $this->data['schedules']=$this->Promotion_model->GetMatchesDetailsByCompetitionLivebar($typeid);
		}
	   else if($type &&  $type == 'Search' && $searchapi==0){
		    $this->data['schedules']=$this->Promotion_model->GetMatchesDetailsBySearchLivebar($val);
	   }
	   else{

			$this->data['schedules'] = $this->Promotion_model->GetAllMatchesLivebar();
	   }  

       
		   $this->data['profiledetails']=$this->Promotion_model->GetBarDetail($bar_id);
		    $this->data['rav_'] = ''; 


		   $this->load->view('promotion/bar_establishment',$this->data);
	   }
	   else{
		   $this->data['heading'] ='No bar found';
		   $this->data['message'] ='No bar found';
		   $this->load->view('errors/html/error_404',$this->data);
	   }

	}





	   public function opening()
	{
        $this->load->model('Establishment_model');
        $this->load->model('Promotion_model');
        $id=$this->session->userdata('email');
        $user_id=$this->Establishment_model->GetUserId($id);
        $est_ref_id=$user_id[0]->id;
        //echo json_encode($est_ref_id);
        $est_info_id = $this->Promotion_model->GetEstId($est_ref_id);
        $bar_id=$est_info_id[0]->id;
        //redirect('promotion/bar/'.$est_info_
       $this->data['openinghours']=$this->Promotion_model->GetBarOpeningHours($bar_id);
	   $this->load->view('promotion/loadopening',$this->data);	   	     

		}

	public function happyhour()
	{
        $this->load->model('Establishment_model');
        $this->load->model('Promotion_model');
        $id=$this->session->userdata('email');
        $user_id=$this->Establishment_model->GetUserId($id);
        $est_ref_id=$user_id[0]->id;
        //echo json_encode($est_ref_id);
        $est_info_id = $this->Promotion_model->GetEstId($est_ref_id);
        $bar_id=$est_info_id[0]->id;
        //redirect('promotion/bar/'.$est_info_
       $this->data['happyhours']=$this->Promotion_model->GetBarHappyHours($bar_id);
	   $this->load->view('promotion/loadhappyhour',$this->data);	   	     

		}


    public function goto_add_ckbox_data()
	{
		$this->load->model('Promotion_model');
		$this->load->model('Establishment_model');
		$id=$this->session->userdata('email');
        $user_id=$this->Establishment_model->GetUserId($id);
        $est_ref_id=$user_id[0]->id;
        echo json_encode($est_ref_id);
        $est_info_id = $this->Establishment_model->GetEstId($est_ref_id);
        $est_ref_id=$est_info_id[0]->id;
		

           	$arrData1= array(
				
				'fixture_ref' => $this->input->post('fixture_id'),
				'establishment_ref' => $this->input->post('est_ref_id'),
				'sport_id' => $this->input->post('sport_id'),
				'competition_ref' => $this->input->post('competition_id')
				);
          	$fixture_id=$this->input->post('fixture_id');
           	$this->Establishment_model->insertScheduleSearch($arrData1,$est_ref_id,$fixture_id); 
		  	echo json_encode($arrData1);
           } 



	 public function loadoffer()
	{
        $this->load->model('Establishment_model');
        $this->load->model('Promotion_model');
        $id=$this->session->userdata('email');
        $user_id=$this->Establishment_model->GetUserId($id);
        $est_ref_id=$user_id[0]->id;
        //echo json_encode($est_ref_id);
        $est_info_id = $this->Promotion_model->GetEstId($est_ref_id);
        $bar_id=$est_info_id[0]->id;
        //redirect('promotion/bar/'.$est_info_
        $this->data['offers']=$this->Promotion_model->GetBarOffer($bar_id);
	   $this->load->view('promotion/loadoffer',$this->data);	   	     

		}

		 public function loadevent()
	{
        $this->load->model('Establishment_model');
        $this->load->model('Promotion_model');
        $id=$this->session->userdata('email');
        $user_id=$this->Establishment_model->GetUserId($id);
        $est_ref_id=$user_id[0]->id;
        //echo json_encode($est_ref_id);
        $est_info_id = $this->Promotion_model->GetEstId($est_ref_id);
        $bar_id=$est_info_id[0]->id;
        //redirect('promotion/bar/'.$est_info_
       $this->data['events']=$this->Promotion_model->getBarEvents($bar_id);
	   $this->load->view('promotion/loadevent',$this->data);	   	     

		}

     public function loadaddress()
	{
        $this->load->model('Establishment_model');
        $this->load->model('Promotion_model');
        $id=$this->session->userdata('email');
        $user_id=$this->Establishment_model->GetUserId($id);
        $est_ref_id=$user_id[0]->id;
        //echo json_encode($est_ref_id);
        $est_info_id = $this->Promotion_model->GetEstId($est_ref_id);
        $bar_id=$est_info_id[0]->id;
        //redirect('promotion/bar/'.$est_info_
       $this->data['profiledetails']=$this->Promotion_model->GetBarDetail($bar_id);
	   $this->load->view('promotion/loadaddress',$this->data);	   	     

		}

		
     public function loadmapdata()
	{
        $this->load->model('Establishment_model');
        $this->load->model('Promotion_model');
        $id=$this->session->userdata('email');
        $user_id=$this->Establishment_model->GetUserId($id);
        $est_ref_id=$user_id[0]->id;
        //echo json_encode($est_ref_id);
        $est_info_id = $this->Promotion_model->GetEstId($est_ref_id);
        $bar_id=$est_info_id[0]->id;
        //redirect('promotion/bar/'.$est_info_
       $this->data['profiledetails']=$this->Promotion_model->GetBarDetail($bar_id);
	   $this->load->view('promotion/loadmapdata',$this->data);	   	     

		}




	 public function loadabout()
	{
        $this->load->model('Establishment_model');
        $this->load->model('Promotion_model');
        $id=$this->session->userdata('email');
        $user_id=$this->Establishment_model->GetUserId($id);
        $est_ref_id=$user_id[0]->id;
        //echo json_encode($est_ref_id);
        $est_info_id = $this->Promotion_model->GetEstId($est_ref_id);
        $bar_id=$est_info_id[0]->id;
        //redirect('promotion/bar/'.$est_info_
       $this->data['profiledetails']=$this->Promotion_model->GetBarDetail($bar_id);
	   $this->load->view('promotion/loadabout',$this->data);
	   //$this->load->view('promotion/conformation');

		}

		 public function conformation()
	{
       
	    $this->load->view('promotion/conformation');
	   	   	     
		}

	public function loadcondetails()
	{
        $this->load->model('Establishment_model');
        $this->load->model('Promotion_model');
        $id=$this->session->userdata('email');
        $user_id=$this->Establishment_model->GetUserId($id);
        $est_ref_id=$user_id[0]->id;
        //echo json_encode($est_ref_id);
        $est_info_id = $this->Promotion_model->GetEstId($est_ref_id);
        $bar_id=$est_info_id[0]->id;
        //redirect('promotion/bar/'.$est_info_
       $this->data['profiledetails']=$this->Promotion_model->GetBarDetail($bar_id);
	   $this->load->view('promotion/loadcontact',$this->data);	   	     

		}




	   public function updateAddress()
	{
		// print_R($this->session->all_userdata());
	   $this->load->model('Establishment_model');

			$arrData= array(
				
				'address' => $this->input->post('address'),
				'city' => $this->input->post('city'),
				'zip' => $this->input->post('zip'),
				'country' => $this->input->post('country'),
				'geo_lat' =>$this->input->post('geo_lat'),
				'geo_lang' => $this->input->post('geo_lang'));

			echo json_encode($arrData);
			   
			    $this->Establishment_model->UpdateProfileInfoAddr($arrData,$this->session->userdata('email'));
				//redirect('establishment/profile_settings');		     

		}

	public function updateAbout()
	{
		// print_R($this->session->all_userdata());
	        $this->load->model('Establishment_model');
	         $cpbody = trim($this->input->post('short_description'));

			  $cpbody = preg_replace("/\<p\>\&nbsp\;\<\/p\>/", "", $cpbody);
			  $cpbody = preg_replace("/\&nbsp\;+/", " ", $cpbody);
			  $cpbody = preg_replace("/\s+/", " ", $cpbody);

			  if($cpbody){

			$arrData= array(
			
				'short_description' =>$cpbody);
				

			echo json_encode($arrData);
			   
			    $this->Establishment_model->UpdateProfileInfoAddr($arrData,$this->session->userdata('email'));
				//redirect('establishment/profile_settings');		     
			}
		}

public function updateContact()
	{
		// print_R($this->session->all_userdata());
	   $this->load->model('Establishment_model');

			$arrData= array(
				
				'phone' => $this->input->post('phone'),
				'contact_email' => $this->input->post('contact_email'),
				'website' =>$this->input->post('website'));

			echo json_encode($arrData);
			   
			    $this->Establishment_model->UpdateProfileInfoAddr($arrData,$this->session->userdata('email'));
				//redirect('establishment/profile_settings');		     

		}


public function updateFacility()
	{
		// print_R($this->session->all_userdata());
	   $this->load->model('Establishment_model');
		echo json_encode($rec);exit;
			   // $this->Establishment_model->UpdateProfileInfoAddr($arrData,$this->session->userdata('email'));
			   //redirect('establishment/profile_settings');		     
	}
		


public function updateOffer()
	{
		
  $this->load->model('Establishment_model');
    //$this->load->model('Establishment_model');
    
    $id=$this->session->userdata('email');
        $user_id=$this->Establishment_model->GetUserId($id);
        $est_ref_id=$user_id[0]->id;
        //echo json_encode($est_ref_id);
        $est_info_id = $this->Establishment_model->GetEstId($est_ref_id);
        $est_ref_id=$est_info_id[0]->id;
    


if(( $this->input->post('title')) && ($this->input->post('price_discount'))!='')
{
    $arrData1= array(
				
				'est_ref' => $est_ref_id,
				'title' => $this->input->post('title'),
				'description' => $this->input->post('description'),
				'price_or_discount' =>$this->input->post('price_discount'),
   				'promo_code' =>$this->input->post('promo_code'),
                'isactive' =>$this->input->post('check')
               
                );

   $this->Establishment_model->AddOffer_Est($arrData1);
    echo json_encode($arrData1);

  
}else{
  echo "All Field is Required;";
	}		
  
   	
   }


   public function signup_success()
	{
        //$this->load->view('promotion/success_signup');

  if($this->session->userdata('email'))
          {
        $this->load->model('Promotion_model');
        $this->load->model('Establishment_model');
        $id=$this->session->userdata('email');
        $user_id=$this->Establishment_model->GetUserId($id);
        $est_ref_id=$user_id[0]->id;
        //echo json_encode($est_ref_id);
        $est_info_id = $this->Promotion_model->GetEstId($est_ref_id);
        //echo json_encode($est_info_id[0]);
        //redirect('promotion/bar/'.$est_info_

       //$this->load->model('Promotion_model');
	   $this->load->helper('form');
	   //echo json_encode($est_info_id[0]);exit;
	   $bar_id=$est_info_id[0]->id;
	   //$bar_id =$this->''
	   $fixture_id =$this->uri->segment(4); 
	   $check_bar = 	$this->Promotion_model->CheckBarExists($bar_id);
	   $check_game = 	$this->Promotion_model->GetGameDetails($fixture_id);
	   $this->data['gamedetails'] ='';


	 	//$this->load->model('Establishment_model');
	   $ar= $this->session->all_userdata();
	   $this->load->helper('form');
	   $caller=$this->input->post('caller'); 
	   $values=array(); 
	   $this->data['msg']="";
	   $this->data['facility_check']=array();
	   $e=$this->session->userdata('email');
	   $user_id=$this->Establishment_model->GetUserId($e);

       $est_ref_id=$user_id[0]->id;
       $this->data['establishment_id']= $est_ref_id;
	   $values_profile=$this->Establishment_model->GetProfileDetail($est_ref_id);
	   $this->data['profile_detail'] = $values_profile;
	    $est_info_id = $this->Establishment_model->GetEstInfoId($est_ref_id);

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

	    	$facility_[] = $facility;
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
				redirect('LiveBar');
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
				redirect('LiveBar');
			}
		}
	




	   

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
		
		redirect('LiveBar');

	}
   

	  
		$this->data['msg_email'] = '';
	  
	
	   	if($caller == "ProfileAddress")
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
			   
			    $this->Establishment_model->UpdateProfileInfoAddress($arrData,$this->session->userdata('email'));
				redirect('establishment/profile_settings');		     

		}}else{
			redirect('establishment/login');
		}

		





	   if((count($check_game) > 0) && ($check_game['fixture_id'])){
		   $this->data['gamedetails'] = $check_game;
	   }
	   if($check_bar){

	   	$this->data['facility_schedule'] = $facility_;
		$this->data['attribute_profile']=$this->Establishment_model->ProfileFormAttribute($values,$values_profile);
	   	$this->data['attribute_profile_about']=$this->Establishment_model->ProfileFormAttribute_About($values,$values_profile);
	    $this->data['attribute_profile_contact']=$this->Establishment_model->ProfileFormAttribute_Contact($values,$values_profile);

	     	$this->data['opening_hours']=$this->Establishment_model->WeekConstantList($est_info_id);
	        $this->data['happy_hours']= $this->Establishment_model->WeekConstantHappyHours($est_info_id);
		   
		    
		   $this->data['profiledetails']=$this->Promotion_model->GetBarDetail($bar_id);
		   //echo json_encode($this->Promotion_model->GetBarDetail($bar_id));
		   $this->data['facilities']=$this->Promotion_model->GetBarFacilities($bar_id);
		   $this->data['openinghours']=$this->Promotion_model->GetBarOpeningHours($bar_id);
		   $this->data['happyhours']=$this->Promotion_model->GetBarHappyHours($bar_id);
		   $this->data['events']=$this->Promotion_model->getBarEvents($bar_id);
		   $this->data['offers']=$this->Promotion_model->GetBarOffer($bar_id);
		   $this->data['schedules1']=$this->Promotion_model->GetBarSchedules($bar_id);


// echo json_encode($this->session->flashdata('success')); 
	   $val =$this->input->get('findval');
	   //echo json_encode($val);
	   $displayval =$this->input->get('displayval');
	   //echo json_encode($displayval);
	   $type =$this->input->get('findtype');
	   //echo json_encode($type);
	   $typeid =$this->input->get('findid');
	   //echo json_encode($typeid);
	   $float = $this->input->get('float');
	   //echo json_encode($float);
	   $searchapi = $this->input->get('searchapi');
	   //echo json_encode($searchapi);
	   $banner_search =$this->input->get('banner_search');
	   //echo json_encode($banner_search);
	   $header_search =$this->input->get('header_search');
	   //echo json_encode($header_search);
	   $this->data['findval'] = $val;
	   $this->data['displayval'] = $displayval;
	   $this->data['type'] = $type;
	   $this->data['typeid'] = $typeid;
	   $this->data['banner_search'] = $banner_search;
	   // $this->data['searchapi'] = $searchapi;
	   if($float==1){
		   $this->data['banner_search'] = $header_search;
		   $banner_search= $header_search;
		   $val =$this->input->get('findval');
	   }
	   
	   if($type && $type == 'Team' && $searchapi==1){
		  $this->data['schedules']=$this->Promotion_model->GetMatchesDetailsByTeamLivebar($typeid);
	   }
	   else if($type && $type == 'Sport' && $searchapi==1){
		    $this->data['schedules']=$this->Promotion_model->GetMatchesDetailsBySportLivebar($typeid);
		}
	   else if($type && $type == 'League'&& $searchapi==1){
		    $this->data['schedules']=$this->Promotion_model->GetMatchesDetailsByCompetitionLivebar($typeid);
		}
	   else if($type &&  $type == 'Search' && $searchapi==0){
		    $this->data['schedules']=$this->Promotion_model->GetMatchesDetailsBySearchLivebar($val);
	   }
	   else{

			$this->data['schedules'] = $this->Promotion_model->GetAllMatchesLivebar();
	   }  


       
		   $this->data['profiledetails']=$this->Promotion_model->GetBarDetail($bar_id);

		  $this->data['rav_'] = "24"; 
		  

		   $this->load->view('promotion/bar_establishment',$this->data);
	   }
	   else{
		   $this->data['heading'] ='No bar found';
		   $this->data['message'] ='No bar found';
		   $this->load->view('errors/html/error_404',$this->data);
	   }

	}








public function updateEvent()
{

    $this->load->model('Establishment_model');
    //$this->load->model('Establishment_model');
    
    $id=$this->session->userdata('email');
        $user_id=$this->Establishment_model->GetUserId($id);
        $est_ref_id=$user_id[0]->id;
        //echo json_encode($est_ref_id);
        $est_info_id = $this->Establishment_model->GetEstId($est_ref_id);
        $est_ref_id=$est_info_id[0]->id;
        

if(( $this->input->post('title')) && ($this->input->post('date')) && ($this->input->post('time')) && ($this->input->post('duration'))!='')
{

    $arrData1= array(

    			'est_ref' =>$est_ref_id,
    			'title' => $this->input->post('title'),
    			'gmt_date' => gmdate('Y-m-d',strtotime($this->input->post('date'))),
				'gmt_time' => gmdate('H:i:s',strtotime($this->input->post('time'))),
				'date' =>date('Y-m-d',strtotime($this->input->post('date'))),
                'time' =>$this->input->post('time'),
   				'duration' =>$this->input->post('duration') );
                
   
    $this->Establishment_model->AddEvent_Est($arrData1);
    echo json_encode($arrData1);

    }else{
  echo "All Field is Required;";
	}  

}



public function upgrade_payment()
{

		$this->load->model('Establishment_model');
        //$this->load->model('Establishment_model');
    
        $id=$this->session->userdata('email');
        $user_id=$this->Establishment_model->GetUserId($id);
        $est_ref_id=$user_id[0]->id;
        //echo json_encode($est_ref_id);
        $est_info_id = $this->Establishment_model->GetEstId($est_ref_id);
        $est_ref_id=$est_info_id[0]->id;
	 /*  $values_upgrade_card=$this->Establishment_model->GetCardDetailForUpgrade($est_ref_id);
	 		   
		    $values_upgrade_card['first_name']=trim($this->input->post('first_name'));
			$values_upgrade_card['last_name']=trim($this->input->post('last_name'));
			$values_upgrade_card['card_number']=trim($this->input->post('card_number'));
			$values_upgrade_card['exp_month']=trim($this->input->post('exp_month'));
			$values_upgrade_card['exp_year']=trim($this->input->post('exp_year'));
			$values_upgrade_card['code']=trim($this->input->post('code'));

			
		    $this->load->library('form_validation'); 
*/

			//print_r($values_upgrade_card);
				/*$arrData= array(
				   'establishment_ref' => $est_ref_id,
				   'first_name' => $values_upgrade_card['first_name'],
				   'last_name' => $values_upgrade_card['last_name'] ,
				   'card_number' => $values_upgrade_card['card_number'] ,
				   'exp_month' =>$values_upgrade_card['exp_month'] ,
				   'exp_year' =>$values_upgrade_card['exp_year'] ,
				   'code' => $values_upgrade_card['code'] ,
				   'est_user_ref' => $est_ref_id
					   
				 );	
*/


				$arrData1= array(

    			'est_ref' =>$est_ref_id,
    			'card_number' => $this->input->post('card_number'),
    			'exp_month' => $this->input->post('exp_month'),
    			'exp_year' => $this->input->post('exp_year'),
    			'code' => $this->input->post('code') );
                
   
				$this->session->set_userdata($arrData1);
				//redirect('establishment/redirect_to_payment');	
				redirect('payment/process');		 
		
		   }











 public function loadschedulemore()
	{
		$all=0;
        $this->load->model('Establishment_model');
        $this->load->model('Promotion_model');
        $max1=$this->input->post('offset_');
       // print_r($max1);
        $date1=$this->input->post('date_');
         $_today=$this->input->post('today_');
        $date_end=$this->input->post('date_end');
        $all=$this->input->post('all_');

        //print_r(gmdate("Y-m-d H:i:s", time()));
        	//print_r(gmdate(date("Y-m-d H:i:s")));exit;

        //$this->input->post('count');
        //echo json_encode($max1);
        //echo json_encode($this->input->post('offset_'));


        $id=$this->session->userdata('email');
        $user_id=$this->Establishment_model->GetUserId($id);
        $est_ref_id=$user_id[0]->id;
        //echo json_encode($est_ref_id);
        $est_info_id = $this->Promotion_model->GetEstId($est_ref_id);
        //echo json_encode($est_info_id[0]);
        //redirect('promotion/bar/'.$est_info_
        $count =1;
        $i=$max1;
        $this->data['count'] = $count;
        $this->data['i'] = $i;

       //$this->load->model('Promotion_model');
	   $this->load->helper('form');
	   //echo json_encode($est_info_id[0]);exit;
	   $bar_id=$est_info_id[0]->id;
	    $this->data['bar_id'] = $bar_id;
        $val =$this->input->post('findval');

	   //echo json_encode($val);
	   $displayval =$this->input->post('displayval');
	   //echo json_encode($displayval);
	   $type =$this->input->post('findtype');
	   //echo json_encode($type);
	   $typeid =$this->input->post('findid');
	   //echo json_encode($typeid);
	   $float = $this->input->post('float');
	   //echo json_encode($float);
	   $searchapi = $this->input->post('searchapi1');
	   $searchapi2 = $this->input->post('searchapi2');
	   //echo json_encode($searchapi);
	   $banner_search =$this->input->get('banner_search');
	   //echo json_encode($banner_search);
	   $header_search =$this->input->get('header_search');
	   //echo json_encode($header_search);

	   $this->data['findval'] = $val;
	   $this->data['displayval'] = $displayval;
	   $this->data['type'] = $type;
	   $this->data['typeid'] = $typeid;
	   $this->data['date1'] = $date1;

	   
	   //$this->data['searchapi'] = $searchapi;
	   $this->data['banner_search'] = $banner_search;
	   if($float==1){
		   $this->data['banner_search'] = $header_search;
		   $banner_search= $header_search;
		   $val =$this->input->get('findval');
	   }
	   
	   if($type && $type == 'Team' && $searchapi==1){
		  $this->data['schedules']=$this->Promotion_model->GetMatchesDetailsByTeam12($typeid, $max1, $date1,  $_today, $all);
	   }
	   else if($type && $type == 'Sport' && $searchapi==1){
		    $this->data['schedules']=$this->Promotion_model->GetMatchesDetailsBySport12($typeid, $max1, $date1,  $_today, $all);
		}
	   else if($type && $type == 'League'&& $searchapi==1){
		    $this->data['schedules']=$this->Promotion_model->GetMatchesDetailsByCompetition1($typeid, $max1, $date1,  $_today, $all);
		}
	   else if($type &&  $type == 'Search' && $searchapi2==0){
		    $this->data['schedules']=$this->Promotion_model->GetMatchesDetailsBySearch1($val, $max1, $date1,  $_today, $all);
	   }
	   else{

			$this->data['schedules'] = $this->Promotion_model->GetAllMatches1($max1, $date1, $date_end,  $_today, $all);
			//print_r($this->data['schedules'] = $this->Promotion_model->GetAllMatches1());
	   }  

       
		   $this->data['profiledetails']=$this->Promotion_model->GetBarDetail($bar_id);
//		   $this->data['rav_']
		   $val=$this->input->post('tbl_');

            $this->data['rav_'] = $val; 
            $this->data['all_'] = $all; 
		 
		   $this->load->view('promotion/loadsearchschedule',$this->data);
		      }
	   	   	     


 public function tab1loadschedulemore()
	{
        $this->load->model('Establishment_model');
        $this->load->model('Promotion_model');
        $max1=$this->input->post('offset_');
        $date1=$this->input->post('date_');

        //print_r(gmdate("Y-m-d H:i:s", time()));
        	//print_r(gmdate(date("Y-m-d H:i:s")));exit;

        //$this->input->post('count');
        //echo json_encode($max1);
        //echo json_encode($this->input->post('offset_'));


        $id=$this->session->userdata('email');
        $user_id=$this->Establishment_model->GetUserId($id);
        $est_ref_id=$user_id[0]->id;
        //echo json_encode($est_ref_id);
        $est_info_id = $this->Promotion_model->GetEstId($est_ref_id);
        //echo json_encode($est_info_id[0]);
        //redirect('promotion/bar/'.$est_info_
        $count =1;
        $i=$max1;
        $this->data['count'] = $count;
        $this->data['i'] = $i;

       //$this->load->model('Promotion_model');
	   $this->load->helper('form');
	   //echo json_encode($est_info_id[0]);exit;
	   $bar_id=$est_info_id[0]->id;
	    $this->data['bar_id'] = $bar_id;
        $val =$this->input->post('findval');

	   //echo json_encode($val);
	   $displayval =$this->input->post('displayval');
	   //echo json_encode($displayval);
	   $type =$this->input->post('findtype');
	   //echo json_encode($type);
	   $typeid =$this->input->post('findid');
	   //echo json_encode($typeid);
	   $float = $this->input->post('float');
	   //echo json_encode($float);
	   $searchapi = $this->input->post('searchapi1');
	   $searchapi2 = $this->input->post('searchapi2');
	   //echo json_encode($searchapi);
	   $banner_search =$this->input->get('banner_search');
	   //echo json_encode($banner_search);
	   $header_search =$this->input->get('header_search');
	   //echo json_encode($header_search);

	   $this->data['findval'] = $val;
	   $this->data['displayval'] = $displayval;
	   $this->data['type'] = $type;
	   $this->data['typeid'] = $typeid;
	   
	   //$this->data['searchapi'] = $searchapi;
	   $this->data['banner_search'] = $banner_search;
	   if($float==1){
		   $this->data['banner_search'] = $header_search;
		   $banner_search= $header_search;
		   $val =$this->input->get('findval');
	   }
	   
	   if($type && $type == 'Team' && $searchapi==1){
		  $this->data['schedules']=$this->Promotion_model->GetMatchesDetailsByTeam12($typeid, $max1, $date1);
	   }
	   else if($type && $type == 'Sport' && $searchapi==1){
		    $this->data['schedules']=$this->Promotion_model->GetMatchesDetailsBySport12($typeid, $max1, $date1);
		}
	   else if($type && $type == 'League'&& $searchapi==1){
		    $this->data['schedules']=$this->Promotion_model->GetMatchesDetailsByCompetition1($typeid, $max1, $date1);
		}
	   else if($type &&  $type == 'Search' && $searchapi2==0){
		    $this->data['schedules']=$this->Promotion_model->GetMatchesDetailsBySearch1($val, $max1, $date1);
	   }
	   else{

			$this->data['schedules'] = $this->Promotion_model->GetAllMatches1($max1, $date1);
			//print_r($this->data['schedules'] = $this->Promotion_model->GetAllMatches1());
	   }  

       
		   $this->data['profiledetails']=$this->Promotion_model->GetBarDetail($bar_id);
//		   $this->data['rav_']
		   $val=$this->input->post('tbl_');

            $this->data['rav_'] = 1; 
		 
		   $this->load->view('promotion/tab1loadsearchschedule',$this->data);
		      }
	   	   	     




public function pay_process(){
    $this->load->model('Establishment_model');
    $this->load->model('Admin_model');
 	if ($this->session->userdata('email')) {
 		//$ar= $this->session->all_userdata();
        $useremail = $this->session->userdata('email');
		$est_ref_id = $this->session->userdata('est_ref_id');
		$profile = $this->Establishment_model->GetProfileDetail($est_ref_id);
       
		print_r($profile);
			$amount =  $this->input->post('data-amount');
			 print_r($amount);
			$plan =  $this->input->post('plan');
			print_r($plan);exit;
			if($plan==1){
				$desc = "Sportshub365.com Monthly Subscription";
			}
			else
				$desc = "Sportshub365.com Yearly Subscription";
			
            //Stripe::setApiKey('sk_live_7pYubIHXP3L4WiCWAtqbnf7r');
			Stripe::setApiKey('sk_test_Be07JhmXOqf4dSffGjvIbkDJ');
            /*$charge = Stripe_Charge::create(array(
                        "amount" => $amount,
                        "currency" => "EUR",
                        "card" => $this->input->post('access_token'),
                        "description" => $desc
            ));*/
            $customer_stripe = Stripe_Customer::create(array(
                        'email' => $useremail,
                        'source'  => $this->input->post('access_token'),
                        'plan' => $plan
                        )
                    );

           // print_r($customer_stripe); 
            // this line will be reached if no error was thrown above
            //print_r($customer_stripe->id);
            //print_r($customer_stripe->created);
          
	}}
	



public function printschedulemore()
{

    $this->load->model('Establishment_model');
    $this->load->model('Promotion_model');
   // echo "hiiii";exit;
     $est_ref_ids=$this->input->post('est_ref_ids_');
     $sync_date=$this->input->post('sync_date_');
     $print_message=$this->Promotion_model->printschedule($est_ref_ids, $sync_date);
     //return $print_message;
     echo json_encode($print_message);
    

}









 public function do_upload_banner()
	{
		// print_R($this->session->all_userdata());

 if($this->input->post('userSubmit')){
            
            //Check whether user upload picture


 		$this->load->model('Establishment_model');
        $id=$this->session->userdata('email');
        $user_id=$this->Establishment_model->GetUserId($id);
        $est_user_ref_id=$user_id[0]->id;
        $establishmentuser_id=$this->Establishment_model->GetUseresiinfoId($est_user_ref_id);
        $est_user_image_ref_id=$establishmentuser_id[0]->id;
        $establishment_banner_id=$this->Establishment_model->GetUseresbanneriinfoId($est_user_image_ref_id);
        //$est_profile_id=$establishment_banner_id[0]->id;

        //print_R($est_user_image_ref_id);
        //print_R($est_profile_id);

           $i=0;
        	foreach ($establishment_banner_id as $key => $value) {
        		$i++;
        	}

        if($i != 5){
        if(!$establishment_banner_id){

            if(!empty($_FILES['picture']['name'])){
                $config['upload_path'] = 'images/profile/';
                $config['allowed_types'] = 'jpg|jpeg|png|gif';
                $config['file_name'] = $_FILES['picture']['name'];
                $config['encrypt_name'] = TRUE;
                
                //Load upload library and initialize configuration
                $this->load->library('upload',$config);
                $this->upload->initialize($config);
                
                if($this->upload->do_upload('picture')){
                    $uploadData = $this->upload->data();
                    $picture = $uploadData['file_name'];
                    //echo $picture;
                }else{
                    $picture = '';
                }
            }
            
            //Prepare array of user data
            $userData = array(
            	'est_ref' => $est_user_image_ref_id,
                'picture' => $picture,
                'default_image' => "1"
                
            );
            //echo json_encode( $userData);
            
            //Pass user data to model

            $insertUserData = $this->Establishment_model->insert_user($userData);
            
            //Storing insertion status message.
            if($insertUserData){
                $this->session->set_flashdata('success_msg', 'User data have been added successfully.');
                redirect('LiveBar');
            }else{
                $this->session->set_flashdata('error_msg', 'Some problems occured, please try again.');
                redirect('LiveBar');
            }
        }else{
        	//$est_profile_id=$establishment_banner_id[0]->id;
        	foreach ($establishment_banner_id as $key => $value) {

        		echo $value->default_image;
        		if($value->default_image==1){

        			$profile_image_id=$value->id;
        		/*	if(file_exists('images/profile/'.$value->picture)) {
                     unlink('images/profile/'.$value->picture);
                    }*/
        		    if(!empty($_FILES['picture']['name'])){
	                $config['upload_path'] = 'images/profile/';
	                $config['allowed_types'] = 'jpg|jpeg|png|gif';

	                $digits = 3;
 	                $new_img = 'sh365-'.rand(pow(10, $digits-1), pow(10, $digits)-1).time().rand(pow(10, $digits-1), pow(10, $digits)-1).$_FILES['picture']['name'];
	                $config['file_name'] = $new_img;
	                //$config['encrypt_name'] = TRUE;
                
	                //Load upload library and initialize configuration
	                $this->load->library('upload',$config);
	                $this->upload->initialize($config);
	                
	                if($this->upload->do_upload('picture')){
	                    $uploadData = $this->upload->data();
	                    $picture = $uploadData['file_name'];
	                    //echo $picture;
	                }else{
	                    $picture = '';
	                }
	            }
            
             //Prepare array of user data
	        if($picture){
            $userData = array(
               'default_image' => "0"
            );
             $userData1 = array(
               'est_ref' => $est_user_image_ref_id,
                'picture' => $picture,
                'default_image' => "1"
            );
            }else{
            	$userData = array(
                 'default_image' => "0"
            );
            	$userData1 = array(
                'est_ref' => $est_user_image_ref_id,
                'picture' => 'default.jpg',
                'default_image' => "1"
            );

            }
            //echo json_encode( $userData);
            
            //Pass user data to model

            $updateUserData = $this->Establishment_model->update_user($userData, $profile_image_id);
             $insertUserData = $this->Establishment_model->insert_user($userData1);
            
            //Storing insertion status message.
            if($updateUserData){
                $this->session->set_flashdata('success_msg', 'User data have been added successfully.');
                redirect('LiveBar');
            }else{
                $this->session->set_flashdata('error_msg', 'Some problems occured, please try again.');
                redirect('LiveBar');
            }
            }
        	}
        	}
        	//print_R($establishment_banner_id); 
        	 }else{
        	  $this->session->set_flashdata('success_msg', 'you can upload maximum 5 images.');
                redirect('LiveBar');
        }

}
}
}