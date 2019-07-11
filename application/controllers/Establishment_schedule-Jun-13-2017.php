<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Establishment_schedule extends MY_Controller {
	
	function __construct()
	{
		parent ::__construct(); 
		$this->load->model('Establishment_model');
		$this->data['channel_id']=$this->session->userdata('channel_id');
		$this->data['sport_id']=$this->session->userdata('sport_id');
		$this->data['date_from']=$this->session->userdata('date_from'); 
		$this->data['date_end']=$this->session->userdata('date_end');
		$this->data['search_text']=$this->session->userdata('search_text');
		$this->data['channel_search_text']=$this->session->userdata('channel_search_text');
		$this->data['cp']=$this->session->userdata('cp');
		$this->data['ppr']=$this->session->userdata('ppr');


		$e=$this->session->userdata('email');
	    $user_id=$this->Establishment_model->GetUserId($e);

        $est_ref_id=$user_id[0]->id;
        $this->data['est_ref_id']= $est_ref_id;
		
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
		redirect('establishment/schedule');
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
		redirect('establishment/schedule');
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
		
		redirect('establishment/schedule');
	}  
  	public function index()
	{
		$this->load->model('Establishment_tv_model');
		if ($this->session->userdata('email')) {
		$ar= $this->session->all_userdata();
		
	//	print_r($ar);
		$est_info = $this->Establishment_tv_model->GetProfileInfo($this->data['est_ref_id']);
		$est_info_id=$est_info['id'];
		
		/*$selected_channel_list = $this->Establishment_model->SelectedChannels($est_info_id); 
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
		  $this->data['channel_list']=$this->Establishment_model->ChannelSearchResult($this->data['channel_search_text']);
		  $this->data['selected_channel_list'] = $this->Establishment_model->SelectedChannels($est_info_id);
		}
		else  { 
		
		$this->data['channel_list']=$this->Establishment_model->AllChannels(); 
		$this->data['selected_channel_list'] = $this->Establishment_model->SelectedChannels($est_info_id); 
		$selected_channel_list = $this->data['selected_channel_list'];
			if(count($selected_channel_list)>0) {
				$channel_id = '';
				foreach($selected_channel_list as $sckey => $scval) {
					$channel_id.=$scval['id'].'~';			
				}
				$this->session->set_userdata('channel_id',trim($channel_id));
			}
		}
		
		
		$this->data['sport_list']=$this->Establishment_model->AllSport();
		//$this->data['fixture_list']=$this->Establishment_model->TotalFixtureCount($this->data['est_ref_id'],$this->data['sport_id'],$this->data['channel_id'],$this->data['date_from'],$this->data['date_end'],$this->data['search_text']);
		$this->load->helper('form');
		$caller=$this->input->post('caller'); 
		$this->data['caller']= $caller;
		$values=array(); 
		//$this->data['channel_search_text']="Search";
	
		$this->data['attribute_search']=$this->Establishment_model->SearchFormAttribute($values);
		$this->data['channel_id']=$this->session->userdata('channel_id');
		
		$this->data['total_records']=$this->Establishment_model->TotalFixtureCount($this->data['est_ref_id'],$this->data['sport_id'],$this->data['channel_id'],$this->data['date_from'],$this->data['date_end'],$this->data['search_text']);
		
		$this->data['total_schedule']=$this->Establishment_model->TotalScheduleCount($est_info_id);
		//echo $this->data['total_records'].'---'.$this->data['total_schedule']; die;
		$this->data['ppr']=20;
		$cp=1;
    	if(!empty($cp)){$this->data['cp']=$cp;}else{$this->data['cp']=1;}
    	$this->data['pagination']=$this->Pagenation($this->data['cp'], $this->data['ppr'],$this->data['total_records']);
		$this->data['fixture_list']=$this->Establishment_model->AllFixture($this->data['est_ref_id'],$this->data['sport_id'],$this->data['channel_id'],$this->data['date_from'],$this->data['date_end'],$this->data['search_text'],"limit ".$this->data['pagination']['start_limit'].",".
		   $this->data['pagination']['end_limit']);
		//$this->data['fixture_list']=array();

		// $this->load->library('pagination');

		// $config['base_url'] = 'http://localhost/sportshub_server/establishment/schedule';
		// //echo  count($this->data['fixture_list']);
		// $config['total_rows'] = count($this->data['fixture_list']);
		// $config['per_page'] = 20;

		// $this->pagination->initialize($config);

		//  $this->data['page_link']=$this->pagination->create_links();


		$this->load->view('establishment/schedule',$this->data);

	}
		else
		redirect('establishment/login');

	}
	public function display_search_channel()
	{
		$this->session->unset_userdata('channel_id');
		$this->session->unset_userdata('sport_id');
		$this->load->model('Establishment_tv_model');
		$this->data['sport_list']=$this->Establishment_model->AllSport();
		//$this->data['fixture_list']=$this->Establishment_model->TotalFixtureCount($this->data['est_ref_id'],$this->data['sport_id'],$this->data['channel_id'],$this->data['date_from'],$this->data['date_end'],$this->data['search_text']);
		$this->load->helper('form');
		$caller=$this->input->post('caller'); 
		$this->data['caller']= $caller;
		$values=array(); 
		$this->data['channel_search_text']="Search";
		$est_info = $this->Establishment_tv_model->GetProfileInfo($this->data['est_ref_id']);
		$est_info_id=$est_info['id'];
		
		$this->data['attribute_search']=$this->Establishment_model->SearchFormAttribute($values);
		$this->data['channel_search_text']=trim($this->input->get('channel_search_text'));
		
		$this->session->set_userdata('channel_search_text',$this->data['channel_search_text']);
		if($this->data['channel_search_text']=='Search') $this->data['channel_search_text']="";
		if($this->data['channel_search_text'] == ""){
		$this->data['selected_channel_list'] = $this->Establishment_model->SelectedChannelsSearchResult($est_info_id,$this->data['channel_search_text']); 
		$selected_channel_list = $this->data['selected_channel_list'];
			if(count($selected_channel_list)>0) {
				$channel_id = '';
				foreach($selected_channel_list as $sckey => $scval) {
					$channel_id.=$scval['id'].'~';			
				}
				$this->session->set_userdata('channel_id',trim($channel_id));
			}
			
		/*$search_channel_list = $this->Establishment_model->ChannelSearchResult($this->data['channel_search_text']);
			if(count($search_channel_list)>0) {
				$channel_id = '';
				foreach($search_channel_list as $sclkey => $sclval) {
					$channel_id.=$sclval['id'].'~';			
				}
				$this->session->set_userdata('channel_id',trim($channel_id));
			}	*/
			
		$this->data['channel_id']=$this->session->userdata('channel_id');
		}
		$this->data['channel_list']=$this->Establishment_model->ChannelSearchResult($this->data['channel_search_text']);
		//print_r($this->data['channel_list']);
		$this->data['selected_channel_list'] = $this->Establishment_model->SelectedChannelsSearchResult($est_info_id,$this->data['channel_search_text']);
		
		$this->data['total_records']=$this->Establishment_model->TotalFixtureCount($this->data['est_ref_id'],$this->data['sport_id'],$this->data['channel_id'],$this->data['date_from'],$this->data['date_end'],$this->data['search_text']);
		
		$this->data['ppr']=20;
		$cp=1;
    	if(!empty($cp)){$this->data['cp']=$cp;}else{$this->data['cp']=1;}
    	$this->data['pagination']=$this->Pagenation($this->data['cp'], $this->data['ppr'],$this->data['total_records']);
		$this->data['fixture_list']=$this->Establishment_model->AllFixture($this->data['est_ref_id'],$this->data['sport_id'],$this->data['channel_id'],$this->data['date_from'],$this->data['date_end'],$this->data['search_text'],"limit ".$this->data['pagination']['start_limit'].",".   $this->data['pagination']['end_limit']
);
		
		$this->load->view('establishment/channel-schedule',$this->data);

	}
  


	public function display_schedule($cp=1)
	{
		if ($this->session->userdata('email')) {
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

		$this->data['channel_list']=$this->Establishment_model->AllChannels();
		$this->data['sport_list']=$this->Establishment_model->AllSport();
		//$this->data['fixture_list']=$this->Establishment_model->AllFixture($this->data['est_ref_id'],'',$this->data['channel_id'],'','','');
		$this->data['total_records']=$this->Establishment_model->TotalFixtureCount($this->data['est_ref_id'],'',$this->data['channel_id'],'','','');
		$this->data['ppr']=20;
		$cp=$cp;
    	if(!empty($cp)){$this->data['cp']=$cp;}else{$this->data['cp']=1;}
    	$this->data['pagination']=$this->Pagenation($this->data['cp'], $this->data['ppr'],$this->data['total_records']);
		$this->data['fixture_list']=$this->Establishment_model->AllFixture($this->data['est_ref_id'],'',$this->data['channel_id'],'','','',"limit ".$this->data['pagination']['start_limit'].",".   $this->data['pagination']['end_limit']
);
		$this->load->view('establishment/display-schedule',$this->data);	
	}
		else
		redirect('establishment/login');

	}



public function make_fixture_schedule()
	{
		if ($this->session->userdata('email')) {
			 
		$this->data['active_schedule']='on';

	 	$e=$this->session->userdata('email');
	    $user_id=$this->Establishment_model->GetUserId($e);
        $est_ref_id=$user_id[0]->id;
		$est_info=$this->Establishment_model->GetProfileInfo($est_ref_id);
       // echo $est_ref_id;print_r($est_info);
		$est_info_id=$est_info['id'];

		$fixturedetial = $this->Establishment_model->getFixtureInfo($this->input->get('fixture_id'));
		//print_r($fixturedetial);exit;
		$fixture_rel_id = $fixturedetial->rel_competition_id;
		//for pegination


		$e=$this->session->userdata('email');
	    $user_id=$this->Establishment_model->GetUserId($e);

        $est_ref_id=$user_id[0]->id;
		$action = "add";
		if(!empty($this->input->get('action'))) $action = $this->input->get('action');
		$fixturesportsid = $this->Establishment_model->getfixtureSportid($this->input->get('fixture_id'));
		$this->Establishment_model->MakeEstablishmentSchedule($this->input->get('fixture_id'),$est_info_id,$fixturesportsid,$fixture_rel_id, $action);
		
		$this->data['channel_id']=$this->session->userdata('channel_id');
		$total_records = $this->Establishment_model->TotalFixtureCount($est_info_id,$this->data['sport_id'],$this->data['channel_id'],$this->data['date_from'],$this->data['date_end'],$this->data['search_text']);
		
		$total_schedule = $this->Establishment_model->TotalScheduleCount($est_info_id);
		
		echo json_encode(array('total_records' => $total_records, 'total_schedule' => $total_schedule));
		//$this->load->view('establishment/display-fixture',$this->data);
		//redirect('establishment/schedule');
	}
		else
		redirect('establishment/login');

	}
	public function display_search_fixture()
	{
		if ($this->session->userdata('email')) {
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
		
		

		$this->data['date_from']=trim($this->input->get('date_from'));
		//if($this->data['date_from'] !=null)
		//$this->session->set_userdata('date_from',$this->data['date_from']);
		
		$this->data['date_end']=trim($this->input->get('date_end'));
		//if($this->data['date_end'] !=null)
		//$this->session->set_userdata('date_end',$this->data['date_end']);
		
		$this->data['search_text']=trim($this->input->get('search_text'));
		//if($this->data['search_text'] !=null)
		//$this->session->set_userdata('search_text',$this->data['search_text']);

		//$this->data['fixture_list']=$this->Establishment_model->TotalFixtureCount($this->data['est_ref_id'],$this->data['sport_id'],
		//	$this->data['channel_id'],$this->data['date_from'],$this->data['date_end'],$this->data['search_text']);

		//for pegination
		$this->data['total_records']=$this->Establishment_model->TotalFixtureCount($this->data['est_ref_id'],$this->data['sport_id'],
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
		$this->data['fixture_list']=$this->Establishment_model->AllFixture($this->data['est_ref_id'],$this->data['sport_id'],$this->data['channel_id'],$this->data['date_from'],$this->data['date_end'],$this->data['search_text'],"limit ".$this->data['pagination']['start_limit'].",".   $this->data['pagination']['end_limit']
);
		

		$this->load->view('establishment/display-fixture',$this->data);
	}
		else
		redirect('establishment/login');

	}
	

	public function my_tv_schedule()
	{
		if ($this->session->userdata('email')) {
		$ar= $this->session->all_userdata();
	//	print_r($ar);
		$this->data['active_schedule']='on';
		 $this->load->view('establishment/my-tv-schedule');
		}
		else
			redirect('establishment/login');

	}
	
	public function add_schedule() {
		
		$e=$this->session->userdata('email');
	    $user_id=$this->Establishment_model->GetUserId($e);
        $est_ref_id=$user_id[0]->id;
		$est_info=$this->Establishment_model->GetProfileInfo($est_ref_id);
       // echo $est_ref_id;print_r($est_info);
		$est_info_id=$est_info['id'];
		
		$channel_ids = $this->input->post('channel_id');
		$check = $this->input->post('check');
		
		$this->Establishment_model->AddEstablishmentAllSchedule($channel_ids, $check, $est_info_id);
	}
}