<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class App_schedule extends MY_Controller {
	
	function __construct()
	{
		parent ::__construct(); 
		$this->load->model('App_model');
		$this->data['channel_id']=$this->session->userdata('channel_id');
		$this->data['sport_id']=$this->session->userdata('sport_id');
		$this->data['date_from']=$this->session->userdata('date_from'); 
		$this->data['date_end']=$this->session->userdata('date_end');
		$this->data['search_text']=$this->session->userdata('search_text');
		$this->data['channel_search_text']=$this->session->userdata('channel_search_text');
		$this->data['cp']=$this->session->userdata('cp');
		$this->data['ppr']=$this->session->userdata('ppr');

		$e=$this->session->userdata('app_email');
	    $user_ref = $this->session->userdata('user_ref_id');
        $this->data['user_ref']= $user_ref;
	}
    
    public function gotoschedule()
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
		redirect('app/schedule');
	} 
    public function schedule()
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
		redirect('app/schedule');
	} 
	 public function gotoschedule_my_tv_schedule()
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
		
		redirect('app/schedule');
	}  
  	public function index()
	{
		$this->load->model('');
		if ($this->session->userdata('app_email')) {
			$ar= $this->session->all_userdata();
			$user_ref = $this->session->userdata('user_ref_id');
		//	print_r($ar);
			/*$est_info = $this->->GetProfileInfo($this->data['est_ref_id']);
			$est_info_id=$est_info['id'];*/
			
			/*$selected_channel_list = $this->App_model->SelectedChannels($est_info_id); 
				if(count($selected_channel_list)>0) {
					$channel_id = '';
					foreach($selected_channel_list as $sckey => $scval) {
						$channel_id.=$scval['id'].'~';			
					}
					$this->session->set_userdata('channel_id',trim($channel_id));
				}*/
			
			$this->data['active_schedule']='on';
			if(!empty($this->data['channel_search_text']) && $this->data['channel_search_text']!='Search')
			{
			  $this->data['channel_list']=$this->App_model->ChannelSearchResult($this->data['channel_search_text']);
			  $this->data['selected_channel_list'] = $this->App_model->SelectedChannels($user_ref);
			}
			else  { 
			
			$this->data['channel_list']=$this->App_model->AllChannels(); 
			$this->data['selected_channel_list'] = $this->App_model->SelectedChannels($user_ref); 
			$selected_channel_list = $this->data['selected_channel_list'];
				if(count($selected_channel_list)>0) {
					$channel_id = '';
					foreach($selected_channel_list as $sckey => $scval) {
						$channel_id.=$scval['id'].'~';			
					}
					$this->session->set_userdata('channel_id',trim($channel_id));
				}
			}
			
			
			$this->data['sport_list']=$this->App_model->AllSport();
			//$this->data['fixture_list']=$this->App_model->TotalFixtureCount($this->data['est_ref_id'],$this->data['sport_id'],$this->data['channel_id'],$this->data['date_from'],$this->data['date_end'],$this->data['search_text']);
			$this->load->helper('form');
			$caller=$this->input->post('caller'); 
			$this->data['caller']= $caller;
			$values=array(); 
			//$this->data['channel_search_text']="Search";
		
			$this->data['attribute_search']=$this->App_model->SearchFormAttribute($values);
			$this->data['channel_id']=$this->session->userdata('channel_id');
			
			$this->data['total_records']=$this->App_model->TotalFixtureCount($user_ref,$this->data['sport_id'],$this->data['channel_id'],$this->data['date_from'],$this->data['date_end'],$this->data['search_text']);
			
			$this->data['ppr']=20;
			$cp=1;
			if(!empty($cp)){$this->data['cp']=$cp;}else{$this->data['cp']=1;}
			$this->data['pagination']=$this->Pagenation($this->data['cp'], $this->data['ppr'],$this->data['total_records']);
			$this->data['fixture_list']=$this->App_model->AllFixture($user_ref,$this->data['sport_id'],$this->data['channel_id'],$this->data['date_from'],$this->data['date_end'],$this->data['search_text'],"limit ".$this->data['pagination']['start_limit'].",".
			   $this->data['pagination']['end_limit']);
			//$this->data['fixture_list']=array();
	
			// $this->load->library('pagination');
	
			// $config['base_url'] = 'http://localhost/sportshub_server/establishment/schedule';
			// //echo  count($this->data['fixture_list']);
			// $config['total_rows'] = count($this->data['fixture_list']);
			// $config['per_page'] = 20;
	
			// $this->pagination->initialize($config);
	
			//  $this->data['page_link']=$this->pagination->create_links();
	
	
			$this->load->view('app/schedule',$this->data);
		}
		else
		redirect('app/login');

	}
	public function display_search_channel()
	{  
		$this->session->unset_userdata('channel_id');
		$this->session->unset_userdata('sport_id');
		$this->load->model('');
		$this->data['sport_list']=$this->App_model->AllSport();
		//$this->data['fixture_list']=$this->App_model->TotalFixtureCount($this->data['est_ref_id'],$this->data['sport_id'],$this->data['channel_id'],$this->data['date_from'],$this->data['date_end'],$this->data['search_text']);
		$this->load->helper('form');
		$caller=$this->input->post('caller'); 
		$this->data['caller']= $caller;
		$values=array(); 
		$this->data['channel_search_text']="Search";
		
		$user_ref = $this->session->userdata('user_ref_id');
		
		$this->data['attribute_search']=$this->App_model->SearchFormAttribute($values);
		$this->data['channel_search_text']=trim($this->input->get('channel_search_text'));
		
		$this->session->set_userdata('channel_search_text',$this->data['channel_search_text']);
		if($this->data['channel_search_text']=='Search') $this->data['channel_search_text']="";
		if($this->data['channel_search_text'] == ""){
		$this->data['selected_channel_list'] = $this->App_model->SelectedChannelsSearchResult($user_ref,$this->data['channel_search_text']); 
		$selected_channel_list = $this->data['selected_channel_list'];
			if(count($selected_channel_list)>0) {
				$channel_id = '';
				foreach($selected_channel_list as $sckey => $scval) {
					$channel_id.=$scval['id'].'~';			
				}
				$this->session->set_userdata('channel_id',trim($channel_id));
			}
			
		/*$search_channel_list = $this->App_model->ChannelSearchResult($this->data['channel_search_text']);
			if(count($search_channel_list)>0) {
				$channel_id = '';
				foreach($search_channel_list as $sclkey => $sclval) {
					$channel_id.=$sclval['id'].'~';			
				}
				$this->session->set_userdata('channel_id',trim($channel_id));
			}	*/
			
		$this->data['channel_id']=$this->session->userdata('channel_id');
		}
		$this->data['channel_list']=$this->App_model->ChannelSearchResult($this->data['channel_search_text']);
		//print_r($this->data['channel_list']);
		$this->data['selected_channel_list'] = $this->App_model->SelectedChannelsSearchResult($user_ref,$this->data['channel_search_text']);
		
		$this->data['total_records']=$this->App_model->TotalFixtureCount($this->data['user_ref'],$this->data['sport_id'],$this->data['channel_id'],$this->data['date_from'],$this->data['date_end'],$this->data['search_text']);
		
		$this->data['ppr']=20;
		$cp=1;
    	if(!empty($cp)){$this->data['cp']=$cp;}else{$this->data['cp']=1;}
    	$this->data['pagination']=$this->Pagenation($this->data['cp'], $this->data['ppr'],$this->data['total_records']);
		$this->data['fixture_list']=$this->App_model->AllFixture($this->data['user_ref'],$this->data['sport_id'],$this->data['channel_id'],$this->data['date_from'],$this->data['date_end'],$this->data['search_text'],"limit ".$this->data['pagination']['start_limit'].",".   $this->data['pagination']['end_limit']
);
		
		$this->load->view('app/channel-schedule',$this->data);

	}
  


	public function display_schedule($cp=1)
	{
		if ($this->session->userdata('app_email')) {
		$ar= $this->session->all_userdata();
	//	print_r($ar);
		$chd_id=$this->input->get('channel_id');
		if($chd_id !=null)
		$this->session->set_userdata('channel_id',$chd_id);
		$this->data['channel_id']=$chd_id;
		
		if($this->session->userdata('date_from')!=null) 
		$this->session->unset_userdata('date_from');

		if($this->session->userdata('date_end')!=null) 
		$this->session->unset_userdata('date_end');

		if($this->session->userdata('search_text')!=null) 
		$this->session->unset_userdata('search_text');
		if($this->session->userdata('sport_id')!=null) 
		$this->session->unset_userdata('sport_id');
		

		$this->data['active_schedule']='on';

		$this->data['channel_list']=$this->App_model->AllChannels();
		$this->data['sport_list']=$this->App_model->AllSport();
		//$this->data['fixture_list']=$this->App_model->AllFixture($this->data['est_ref_id'],'',$this->data['channel_id'],'','','');
		$this->data['total_records']=$this->App_model->TotalFixtureCount($this->data['user_ref'],'',$this->data['channel_id'],'','','');
		$this->data['ppr']=20;
		$cp=$cp;
    	if(!empty($cp)){$this->data['cp']=$cp;}else{$this->data['cp']=1;}
    	$this->data['pagination']=$this->Pagenation($this->data['cp'], $this->data['ppr'],$this->data['total_records']);
		$this->data['fixture_list']=$this->App_model->AllFixture($this->data['user_ref'],'',$this->data['channel_id'],'','','',"limit ".$this->data['pagination']['start_limit'].",".   $this->data['pagination']['end_limit']
);
		$this->load->view('app/display-schedule',$this->data);	
	}
		else
		redirect('app/login');

	}



public function make_fixture_schedule()
	{
		if ($this->session->userdata('app_email')) {
			 
		$this->data['active_schedule']='on';

	 	$e=$this->session->userdata('app_email');
	    $user_ref = $this->session->userdata('user_ref_id');
		 
		$fixturedetial = $this->App_model->getFixtureInfo($this->input->get('fixture_id'));
		//print_r($fixturedetial);exit;
		$fixture_rel_id = $fixturedetial->rel_competition_id;
		//for pegination

		$action = "add";
		if(!empty($this->input->get('action'))) $action = $this->input->get('action');
		$fixturesportsid = $this->App_model->getfixtureSportid($this->input->get('fixture_id'));
		$this->App_model->MakeEstablishmentSchedule($this->input->get('fixture_id'),$user_ref,$fixturesportsid,$fixture_rel_id, $action);

		//$this->load->view('establishment/display-fixture',$this->data);
		//redirect('establishment/schedule');
	}
		else
		redirect('app/login');

	}
	public function display_search_fixture()
	{
		if ($this->session->userdata('app_email')) {
		$this->data['active_schedule']='on';
		$chd_id=$this->input->get('channel_id');
		if($chd_id !=null)
		$this->session->set_userdata('channel_id',$chd_id);
		 $this->data['channel_id'] = $this->input->get('channel_id');
		
		$spt_id=$this->input->get('sport_id');
		if($spt_id !=null)
		$this->session->set_userdata('sport_id',$spt_id);
		//$sport_id=$this->session->flashdata('sport_id');
		$this->data['sport_id']=$this->input->get('sport_id');
		
		$user_ref = $this->session->userdata('user_ref_id');

		$this->data['date_from']=trim($this->input->get('date_from'));
		//if($this->data['date_from'] !=null)
		//$this->session->set_userdata('date_from',$this->data['date_from']);
		
		$this->data['date_end']=trim($this->input->get('date_end'));
		//if($this->data['date_end'] !=null)
		//$this->session->set_userdata('date_end',$this->data['date_end']);
		
		$this->data['search_text']=trim($this->input->get('search_text'));
		//if($this->data['search_text'] !=null)
		//$this->session->set_userdata('search_text',$this->data['search_text']);

		//$this->data['fixture_list']=$this->App_model->TotalFixtureCount($this->data['est_ref_id'],$this->data['sport_id'],
		//	$this->data['channel_id'],$this->data['date_from'],$this->data['date_end'],$this->data['search_text']);

		//for pegination
		$this->data['total_records']=$this->App_model->TotalFixtureCount($user_ref, $this->data['sport_id'],
			$this->data['channel_id'],$this->data['date_from'],$this->data['date_end'],$this->data['search_text']);
		$this->data['ppr']=20;
		if($this->data['ppr'] !=null)
		$this->session->set_userdata('ppr',$this->data['ppr']);
		$cp=trim($this->input->get('cp'));
    	if(!empty($cp)){
    		$this->data['cp']=$cp;
			if($this->data['cp'] !=null)
    		$this->session->set_userdata('cp',$cp);
    	}else{$this->data['cp']=1;}
    	$this->data['pagination']=$this->Pagenation($this->data['cp'], $this->data['ppr'],$this->data['total_records']);
		$this->data['fixture_list']=$this->App_model->AllFixture($user_ref,$this->data['sport_id'],$this->data['channel_id'],$this->data['date_from'],$this->data['date_end'],$this->data['search_text'],"limit ".$this->data['pagination']['start_limit'].",".   $this->data['pagination']['end_limit']
);
		

		$this->load->view('app/display-fixture',$this->data);
	}
		else
		redirect('app/login');

	}
	

	public function my_tv_schedule()
	{
		if ($this->session->userdata('app_email')) {
		$ar= $this->session->all_userdata();
	//	print_r($ar);
		$this->data['active_schedule']='on';
		 $this->load->view('establishment/my-tv-schedule');
		}
		else
			redirect('establishment/login');

	}
}