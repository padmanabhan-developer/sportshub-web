<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Establishment_events extends MY_Controller {

        
  	public function events($event_id='')
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
		   $this->data['facility_check']=array();
		   $e=$this->session->userdata('email');
		   $user_id=$this->Establishment_model->GetUserId($e);
		   $est_ref_id=$user_id[0]->id;
			$est_info_id = $this->Establishment_model->GetEstInfoId($est_ref_id);
 		   $this->data['all_events']=$this->Establishment_model->AllEvents($est_info_id);
 		   $event_id=$this->input->post('event_id');
 		   $values_card=$this->Establishment_model->GetEventDetails($event_id);
	       $est_ref_id=$user_id[0]->id;
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
						$time = $values_card['event_date'].' '.$values_card['event_time'];
						$timezone = $this->Establishment_model->gettimezone();
						$gmt = $this->Establishment_model->convertTime($timezone, $time);
						
							$arrData= array(
							   'est_ref' => $est_info_id,
							   'title' => $values_card['title'],
							   'gmt_date' => $gmt['date'],
							   'gmt_time' => $gmt['time'],
							   'date' => $eventdate,
							   'time' => $values_card['event_time'] ,
							   'duration' =>$values_card['duration'] 
								   
							 );			     
						    $this->Establishment_model->AddEvent($arrData,'');
						    redirect('establishment/events');

						 }
			
			    }
			   if($caller == "Search")
			   {
				   
				    $values['date_from']=trim($this->input->post('date_from'));
					$values['date_end']=trim($this->input->post('date_end'));
					$values['search_text']=trim($this->input->post('search_text'));
						
				   $this->data['all_events']=$this->Establishment_model->SearchResult($values['date_from'],$values['date_end'],$values['search_text']);


							   			
				}
			   
			  
		   $this->data['attribute_search']=$this->Establishment_model->SearchFormAttribute($values);
			  
			   $this->data['attribute_event']=$this->Establishment_model->AddEventFormAttribute($values_card);
			  


            $this->load->view('establishment/events',$this->data);

		  }
		 else
			redirect('establishment/login');

	}
	public function display_open()
	{
	   if ($this->session->userdata('email'))
	   {	

		  
		   $this->load->model('Establishment_model');
		   $this->data['form_action']="update";

		   $ar= $this->session->all_userdata();
		   $event_id=$this->input->get('event_id');
			if(empty($event_id))$event_id=$this->input->post('event_id');
			if(!empty($event_id)){
				   $this->data['event_id']=$event_id;
		
				   $this->load->helper('form');
				   $caller=$this->input->post('caller'); 
				   $this->data['caller']= $caller;
				   $values=array(); 
				   $values_card=array();
				   $this->data['msg']="";
				   $this->data['facility_check']=array();
				  $e=$this->session->userdata('email');
				   $user_id=$this->Establishment_model->GetUserId($e);
		
				   $est_ref_id=$user_id[0]->id;
					$est_info_id = $this->Establishment_model->GetEstInfoId($est_ref_id);
				   $this->data['all_events']=$this->Establishment_model->AllEvents($est_info_id);
				  
				   $values_card=$this->Establishment_model->GetEventDetails($event_id);
				  // print_r($values_card);
				   $est_ref_id=$user_id[0]->id;
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
									$time = $values_card['event_date'].' '.$values_card['event_time'];
									$timezone = $this->Establishment_model->gettimezone();
									$gmt = $this->Establishment_model->convertTime($timezone, $time);
									
									$arrData= array(
									   'est_ref' => $est_info_id,
									   'title' => $values_card['title'],
									   'gmt_date' => $gmt['date'],
									   'gmt_time' => $gmt['time'],
									   'date' => $eventdate,
									   'time' => $values_card['event_time'] ,
									   'duration' =>$values_card['duration'] ,
									   'deleted_on'=>NULL
										   
									 );	
									 $event_id=$this->input->post('event_id');		     
									$this->Establishment_model->AddEvent($arrData,$event_id);
									redirect('establishment/events');
		
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
				  $e=$this->session->userdata('email');
				   $user_id=$this->Establishment_model->GetUserId($e);
		
				   $est_ref_id=$user_id[0]->id;
					$est_info_id = $this->Establishment_model->GetEstInfoId($est_ref_id);
				   $this->data['all_events']=$this->Establishment_model->AllEvents($est_info_id);
				  
				   $values_card=$this->Establishment_model->GetEventDetails($event_id);
				  // print_r($values_card);
				   $est_ref_id=$user_id[0]->id;
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
									$time = $values_card['event_date'].' '.$values_card['event_time'];
									$timezone = $this->Establishment_model->gettimezone();
									$gmt = $this->Establishment_model->convertTime($timezone, $time);
						
									$arrData= array(
									   'est_ref' => $est_info_id,
									   'title' => $values_card['title'],
									   'gmt_date' => $gmt['date'],
									   'gmt_time' => $gmt['time'],
									   'date' => $eventdate,
									   'time' => $values_card['event_time'] ,
									   'duration' =>$values_card['duration'] ,
									   'deleted_on'=>NULL
										   
									 );	
									 $event_id=$this->input->post('event_id');		     
									$this->Establishment_model->AddEvent($arrData,$event_id);
									redirect('establishment/events');
		
								 }
					
						}
						
			}
			  
		 
			  
			   $this->data['attribute_event']=$this->Establishment_model->AddEventFormAttribute($values_card);
			  


            $this->load->view('establishment/add-event',$this->data);

		  }
		 else
			redirect('establishment/login');

	}
	public function search()
	{
		if ($this->session->userdata('email'))
	   {	
		  
		   $this->load->model('Establishment_model');

		   $ar= $this->session->all_userdata();
		   $this->load->helper('form');
		   $caller=$this->input->post('caller'); 
		   
		   $values_card=array();
		   $this->data['msg']="";
		   
		   $e=$this->session->userdata('email');
		   $user_id=$this->Establishment_model->GetUserId($e);

	       $est_ref_id=$user_id[0]->id;
		  
		   $this->data['all_events']=$this->Establishment_model->AllEvents($est_ref_id);


            $this->load->view('establishment/events',$this->data);

		  }
		 else
			redirect('establishment/login');

	}

	public function filter_events(){
	if ($this->session->userdata('email'))
	   {
		$this->load->model('Establishment_model');
		   $ar= $this->session->all_userdata();
		   $e=$this->session->userdata('email');
		   $user_id=$this->Establishment_model->GetUserId($e);
		   $est_ref_id=$user_id[0]->id;

			$est_info_id = $this->Establishment_model->GetEstInfoId($est_ref_id);

		    $values['fromdate']=trim($this->input->post('fromdate'));
			$values['todate']=trim($this->input->post('todate'));
			$values['searchtext']=trim($this->input->post('searchtext'));
		$this->data['all_events']=$this->Establishment_model->SearchResult($values['fromdate'],$values['todate'],$values['searchtext'], $est_info_id);
	   }
	$this->load->view('establishment/display-events',$this->data);
	}
	 public function delete($id)
	 {
	 	  $this->load->model('Establishment_model');
	   $this->Establishment_model->DeleteEvent($id);
	   redirect('establishment/events');
      
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
	 			case 'card_number':
	 			if($value=="" || $value=="Card Number:")
	 			{
	 				$this->form_validation->set_message('value_required', "Please enter card number");
	 				$haserror=true;

	 			}

	 			break;
	 			case 'exp_month':
	 			if($value=="" || $value=="Expiries Month:")
	 			{
	 				$this->form_validation->set_message('value_required', "Please enter expiry month");
	 				$haserror=true;

	 			}
	 			break;

				case 'exp_year':
	 			if($value=="" || $value=="Expiries Year:")
	 			{
	 				$this->form_validation->set_message('value_required', "Please enter expiry year");
	 				$haserror=true;

	 			}
	 			break;

	 			case 'code':
	 			if($value=="" || $value=="Code:")
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