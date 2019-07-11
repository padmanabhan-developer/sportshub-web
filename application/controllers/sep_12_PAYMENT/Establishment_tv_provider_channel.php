<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Establishment_tv_provider_channel extends MY_Controller {
	
	function __construct()
	{
		parent ::__construct(); 
		$this->load->model('Establishment_tv_model');
		$this->load->model('Establishment_model');
		$this->data['sport_id']=$this->session->userdata('sport_id');
		$this->data['date_from']=$this->session->userdata('date_from'); 
		$this->data['date_end']=$this->session->userdata('date_end');
		$this->data['search_text']=$this->session->userdata('search_text');
	
		$this->data['cp']=$this->session->userdata('cp');
		$this->data['ppr']=$this->session->userdata('ppr');
		
		$e=$this->session->userdata('email');
	    $user_id=$this->Establishment_tv_model->GetUserId($e);
		//print_r($user_id);die;
        $est_ref_id=$user_id[0]->id;
        $this->data['est_ref_id']= $est_ref_id;
	}
	
      
	public function goto_my_tv_schedule()
	{

		
		if($this->session->userdata('channel_id')!=null) 
		$this->session->unset_userdata('channel_id');
		if($this->session->userdata('sport_id')!=null) 
		$this->session->unset_userdata('sport_id');
		if($this->session->userdata('date_from')!=null) 
		$this->session->unset_userdata('date_from');
		if($this->session->userdata('date_end')!=null) 
		$this->session->unset_userdata('date_end');
		if($this->session->userdata('search_text')!=null) 
		$this->session->unset_userdata('search_text');
		if($this->session->userdata('channel_search_text')!=null) 
		$this->session->unset_userdata('channel_search_text');
		if($this->session->userdata('cp')!=null) 
		$this->session->unset_userdata('cp');
		redirect('establishment/tv-provider-channel');
	} 
	
	public function my_tv_schedule()
	{
		if ($this->session->userdata('email')) 
		{
		$ar= $this->session->all_userdata();
		$this->load->helper('form');
		//echo $this->data['est_ref_id'];
		 $est_info = $this->Establishment_tv_model->GetProfileInfo($this->data['est_ref_id']);
		 $est_info_id=$est_info['id'];
		$this->data['active_schedule']='on';
		//$this->data['sport_list']=$this->Establishment_tv_model->AllSport();
		//$this->data['fixture_list_count']=$this->Establishment_tv_model->AllFixture($est_info_id,$this->data['sport_id'],$this->data['date_from'],$this->data['date_end'],$this->data['search_text']);
		$check_subscription = $this->Establishment_model->GetSubscriptionDetails($est_info_id); 
		   //print_r($check_subscription);
		   $this->data['free_status'] = $check_subscription['free_status'];
		   $this->data['subscription'] = $check_subscription['subscription'];
		   $this->data['free_days'] = $check_subscription['free_days'];
		   $this->data['free_days_left'] = $check_subscription['free_days_left'];
		   $this->data['subscription_expire'] = date("d-m-Y", strtotime($check_subscription['subscription_end']));;
		   $this->data['subscription_status'] = $check_subscription['subscription_status'];
		$this->data['provider_list'] = $this->Establishment_tv_model->AllProvider();
		
		$this->data['provider_selected_list'] = $this->Establishment_tv_model->SelectedProvider($est_info_id);
		$this->data['provider_selected_ids'] = $this->Establishment_tv_model->SelectedProviderIds($est_info_id);
		$this->data['deleted_temp_channel'] = $this->Establishment_tv_model->DeletedTempChannel($est_info_id);
		$this->data['provider_all_channel'] = $this->Establishment_tv_model->ProviderChannel($this->data['provider_selected_ids']);
		//print_r($this->data['provider_all_channel']);
		$this->data['provide_channel'] = $this->Establishment_tv_model->SelectedChannels($est_info_id);
		$this->data['selected_channel_ids'] = $this->Establishment_tv_model->SelectedChannelsIds($est_info_id);
		//print_r($this->data['selected_channel_ids']);
		$caller=$this->input->post('caller'); 
		$this->data['caller']= $caller;
		$values=array(); 
		//$this->data['channel_search_text']="Search";
	
		//$this->data['attribute_search']=$this->Establishment_tv_model->SearchFormAttribute($values);
		
		
		/*$this->data['total_records']=count($this->data['fixture_list_count']);
		$this->data['ppr']=20;
		$cp=1;
    	if(empty($this->data['cp'])){$this->data['cp']=$cp;}else{$this->data['cp']=$this->session->userdata('cp');}
    	$this->data['pagination']=$this->Pagenation($this->data['cp'], $this->data['ppr'],$this->data['total_records']);
		$this->data['fixture_list']=$this->Establishment_tv_model->AllFixture($est_info_id,$this->data['sport_id'],$this->data['date_from'],$this->data['date_end'],$this->data['search_text'],"limit ".$this->data['pagination']['start_limit'].",".$this->data['pagination']['end_limit']);
*/

		$this->load->view('establishment/tv-provider-channel', $this->data);
		}
		else
			redirect('establishment/login');

	} 
 

 public function display_search_my_tv_fixture()
	{
		if ($this->session->userdata('email')) {
		$this->data['active_schedule']='on';
		
		$spt_id=$this->input->get('sport_id');
		if($spt_id !=null)
		$this->session->set_userdata('sport_id',$spt_id);
		//$sport_id=$this->session->flashdata('sport_id');
		$this->data['sport_id']=$this->input->get('sport_id');
		
		$this->data['date_from']=trim($this->input->get('date_from'));
		if($this->input->get('date_from') !=null)
		$this->session->set_userdata('date_from',$this->data['date_from']);
		$this->data['date_end']=trim($this->input->get('date_end'));
		if($this->input->get('date_end') !=null)
		$this->session->set_userdata('date_end',$this->data['date_end']);
		$this->data['search_text']=trim($this->input->get('search_text'));
		if($this->input->get('search_text') !=null)
		$this->session->set_userdata('search_text',$this->data['search_text']);
		 $est_info = $this->Establishment_tv_model->GetProfileInfo($this->data['est_ref_id']);
		 $est_info_id=$est_info['id'];

		$this->data['fixture_list']=$this->Establishment_tv_model->AllFixture($est_info_id,$this->data['sport_id'],
			$this->data['date_from'],$this->data['date_end'],$this->data['search_text']);

		//for pegination
		$this->data['total_records']=count($this->data['fixture_list']);
		$this->data['ppr']=21;
		if($this->data['ppr'] !=null)
		$this->session->set_userdata('ppr',$this->data['ppr']);
		$cp=trim($this->input->get('cp'));
    	if(!empty($cp)){
    		$this->data['cp']=$cp;
 		if($this->data['cp'] !=null)
   		$this->session->set_userdata('cp',$cp);
    	}else{$this->data['cp']=1;}
    	$this->data['pagination']=$this->Pagenation($this->data['cp'], $this->data['ppr'],$this->data['total_records']);
		$this->data['fixture_list']=$this->Establishment_tv_model->AllFixture($est_info_id,$this->data['sport_id'],$this->data['date_from'],$this->data['date_end'],$this->data['search_text'],"limit ".$this->data['pagination']['start_limit'].",".   $this->data['pagination']['end_limit']
);
		

		$this->load->view('establishment/display-my-tv-schedule',$this->data);
	}
		else
		redirect('establishment/login');

	}
	


	


	public function make_fixture_schedule()
	{
		if ($this->session->userdata('email')) {
			 
		$this->data['active_schedule']='on';

		$this->data['sport_id']=$this->input->get('sport_id');
		$this->data['fixture_id']=$this->input->get('fixture_id');
	

		$this->data['date_from']=trim($this->input->get('date_from'));
			
		$this->data['date_end']=trim($this->input->get('date_end'));
		
		$this->data['search_text']=trim($this->input->get('search_text'));

		//print_r($this->data['fixture_list']);
		$est_info=$this->Establishment_tv_model->GetProfileInfo($this->data['est_ref_id']);
       // echo $est_ref_id;print_r($est_info);
		$est_info_id=$est_info['id'];
		$this->Establishment_tv_model->MakeFixtureSchedule($this->data['fixture_id'],$est_info_id);
		 $est_info = $this->Establishment_tv_model->GetProfileInfo($this->data['est_ref_id']);
		 $est_info_id=$est_info['id'];

		$this->data['fixture_list']=$this->Establishment_tv_model->AllFixture($est_info_id,
			$this->data['sport_id'],$this->data['date_from'],$this->data['date_end'],$this->data['search_text']);
		
		//for pegination
		$this->data['total_records']=count($this->data['fixture_list']);
		$this->data['ppr']=20;
		$cp=trim($this->input->get('cp'));
		$this->session->set_userdata('cp',$cp);
    	if(!empty($cp)){$this->data['cp']=$cp;}else{$this->data['cp']=1;}

    	$this->data['pagination']=$this->Pagenation($this->data['cp'], $this->data['ppr'],$this->data['total_records']);
		$this->data['fixture_list']=$this->Establishment_tv_model->AllFixture($est_info_id,
			$this->data['sport_id'],$this->data['date_from'],$this->data['date_end'],$this->data['search_text'],"limit ".$this->data['pagination']['start_limit'].",". $this->data['pagination']['end_limit']
);

		

		$this->load->view('establishment/display-fixture',$this->data);
		//redirect('establishment/schedule');
	}
		else
		redirect('establishment/login');

	}
	



	 public function Pagenation($cp,$ppr,$total_records)
    {
	   $total_page=(int)($total_records/$ppr);
	   $rem=($total_records % $ppr);
	   if($rem > 0)
	    $total_page=$total_page + 1;
	   if(empty($cp)) $cp=1;
	   $start_limit=($cp-1)*$ppr;
	   if(($total_page == $cp) and $rem > 0)
	    $end_limit=$rem;
	   else
	    $end_limit=$ppr;
	   if($total_page > $cp)
	    $next_page=$cp + 1;
	   else $next_page=0; 
	   if($cp > 1)
	    $previous_page=$cp-1;  
	   else $previous_page=0;   
	   $info['start_limit']=$start_limit;
	   $info['end_limit']=$end_limit;
	   $info['next_page']=$next_page;
	   $info['previous_page']=$previous_page;
	   $info['cp']=$cp;
	   $info['total_page']=$total_page;
	   return $info;
  	}
	
	public function display_channel(){
	   if ($this->session->userdata('email')) { 
	   		$this->data['active_schedule']='on';
			$this->data['provider_id'] = $this->input->post('providerid');
			
			$this->data['provide_channel'] = $this->Establishment_tv_model->ProviderChannel($this->data['provider_id']);
			
			$this->load->view('establishment/display-provider-channel',$this->data);
	   }
	   else {
		   redirect('establishment/login');
		   }
	}
	public function display_channel_provider($cp=1){
		$this->load->model('Establishment_model');
	   if ($this->session->userdata('email')) { 
	   		$this->data['active_schedule']='on';
		   $e=$this->session->userdata('email');
		   $user_id=$this->Establishment_model->GetUserId($e);
	
		    $est_ref_id=$user_id[0]->id;
		   $this->data['establishment_id']= $est_ref_id;
		   //$values_profile=$this->Establishment_model->GetProfileDetail($est_ref_id);
		   //$this->data['profile_detail'] = $values_profile;
		    $est_info_id = $this->Establishment_model->GetEstInfoId($est_ref_id);
			$this->data['provider_id'] = $this->input->post('providerid');
			$this->data['provider'] = $this->input->post('provider');
			$this->data['search_text'] = '';
			
			
			$this->data['total_records']= count($this->Establishment_tv_model->ProviderChannelSingle($est_info_id, $this->data['provider_id'], $this->data['provider'], '', $this->data['search_text']));
			$this->data['ppr']=21;
			$cp=$cp;
			if(!empty($cp)){$this->data['cp']=$cp;}else{$this->data['cp']=1;}
			$this->data['pagination']=$this->Pagenation($this->data['cp'], $this->data['ppr'],$this->data['total_records']);
			$this->data['provider_channels'] = $this->Establishment_tv_model->ProviderChannelSingle($est_info_id, $this->data['provider_id'], $this->data['provider'], "limit ".$this->data['pagination']['start_limit'].",".   $this->data['pagination']['end_limit'], $this->data['search_text']);
			$this->data['selected_channel_ids'] = $this->Establishment_tv_model->SelectedChannelsIds($est_info_id, $this->data['provider_id']);
		
			$this->load->view('establishment/display-single-provider-channel',$this->data);
	   }
	   else {
		   redirect('establishment/login');
		   }
	}
	
	public function display_search_provider_channel($cp=1){
		$this->load->model('Establishment_model');
	   if ($this->session->userdata('email')) { 
	   		$this->data['active_schedule']='on';
		    $e=$this->session->userdata('email');
		    $user_id=$this->Establishment_model->GetUserId($e);
	
		    $est_ref_id=$user_id[0]->id;
		    $this->data['establishment_id']= $est_ref_id;
		   //$values_profile=$this->Establishment_model->GetProfileDetail($est_ref_id);
		   //$this->data['profile_detail'] = $values_profile;
		    $est_info_id = $this->Establishment_model->GetEstInfoId($est_ref_id);
			$this->data['provider_id'] = $this->input->post('providerid');
			$this->data['provider'] = $this->input->post('provider');
			$this->data['search_text'] = $this->input->post('search_text');
			
			$this->data['selected_channel_ids'] = $this->Establishment_tv_model->SelectedChannelsIds($est_info_id, $this->data['provider_id']);
			$this->data['total_records']= count($this->Establishment_tv_model->ProviderChannelPagenation($est_info_id, $this->data['provider_id'], $this->data['provider'], '', $this->data['search_text']));
			
			
			$this->data['ppr']=21;
			$cp=$this->input->post('cp');
			if(!empty($cp)){$this->data['cp']=$cp;}else{$this->data['cp']=1;}
			$this->data['pagination']=$this->Pagenation($this->data['cp'], $this->data['ppr'],$this->data['total_records']);
			$this->data['provider_channels'] = $this->Establishment_tv_model->ProviderChannelPagenation($est_info_id, $this->data['provider_id'], $this->data['provider'], "limit ".$this->data['pagination']['start_limit'].",".   $this->data['pagination']['end_limit'], $this->data['search_text']);
			
			
			$this->load->view('establishment/display-single-provider-channel',$this->data);
	   }
	   else {
		   redirect('establishment/login');
		   }
	}
	
	public function display_search_other_provider_channel($cp=1){
		$this->load->model('Establishment_model');
	   if ($this->session->userdata('email')) { 
	   		$this->data['active_schedule']='on';
		    $e=$this->session->userdata('email');
		    $user_id=$this->Establishment_model->GetUserId($e);
	
		    $est_ref_id=$user_id[0]->id;
		    $this->data['establishment_id']= $est_ref_id;
		   //$values_profile=$this->Establishment_model->GetProfileDetail($est_ref_id);
		   //$this->data['profile_detail'] = $values_profile;
		    $est_info_id = $this->Establishment_model->GetEstInfoId($est_ref_id);
			$this->data['provider_id'] = $this->input->post('providerid');
			$this->data['provider'] = $this->input->post('provider');
			$this->data['search_text'] = $this->input->post('search_text');
			
			$this->data['selected_channel_ids'] = $this->Establishment_tv_model->SelectedChannelsIds($est_info_id, $this->data['provider_id']);
			$this->data['total_records']= count($this->Establishment_tv_model->ProviderChannelPagenation($est_info_id, $this->data['provider_id'], $this->data['provider'], '', $this->data['search_text']));
			
			
			$this->data['ppr']=21;
			$cp=$this->input->post('cp');
			if(!empty($cp)){$this->data['cp']=$cp;}else{$this->data['cp']=1;}
			$this->data['pagination']=$this->Pagenation($this->data['cp'], $this->data['ppr'],$this->data['total_records']);
			$this->data['provider_channels'] = $this->Establishment_tv_model->ProviderChannelPagenation($est_info_id, $this->data['provider_id'], $this->data['provider'], "limit ".$this->data['pagination']['start_limit'].",".   $this->data['pagination']['end_limit'], $this->data['search_text']);
			
			$this->load->view('establishment/display-other-provider-channel',$this->data);
	   }
	   else {
		   redirect('establishment/login');
		   }
	}
	
	public function save_provider_channel(){
		
	$this->load->model('Establishment_model');
	   if ($this->session->userdata('email')) { 
	   	   $this->data['active_schedule']='on';
		   $e=$this->session->userdata('email');
		   $user_id=$this->Establishment_model->GetUserId($e);
	
		    $est_ref_id=$user_id[0]->id;
		   $this->data['establishment_id']= $est_ref_id;
		   //$values_profile=$this->Establishment_model->GetProfileDetail($est_ref_id);
		   //$this->data['profile_detail'] = $values_profile;
		   $est_info_id = $this->Establishment_model->GetEstInfoId($est_ref_id);
		   
			$this->data['providerid'] = $this->input->post('providerid');
			$this->data['channelid'] = $this->input->post('channelid');
			$this->data['check'] = $this->input->post('check');
			$this->data['type'] = $this->input->post('type');
			
			echo $this->Establishment_tv_model->SaveProviderChannel($this->data['providerid'], $this->data['channelid'], $this->data['check'],$this->data['type'],  $est_info_id);
			
	   }
	   else {
		   redirect('establishment/login');
		   }
	}
	
	public function save_channel(){
		
	$this->load->model('Establishment_model');
	   if ($this->session->userdata('email')) { 
	   	   $this->data['active_schedule']='on';
		   $e=$this->session->userdata('email');
		   $user_id=$this->Establishment_model->GetUserId($e);
	
		    $est_ref_id=$user_id[0]->id;
		   $this->data['establishment_id']= $est_ref_id;
		   //$values_profile=$this->Establishment_model->GetProfileDetail($est_ref_id);
		   //$this->data['profile_detail'] = $values_profile;
		   $est_info_id = $this->Establishment_model->GetEstInfoId($est_ref_id);
		   
			$this->data['providerid'] = $this->input->post('providerid');
			
			$this->Establishment_tv_model->SaveFinalChannel($est_info_id);
			
			//$this->load->view('establishment/display-provider-channel',$this->data);
	   }
	   else {
		   redirect('establishment/login');
		   }
	
		
	}

}