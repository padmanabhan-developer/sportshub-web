<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Establishment_home extends MY_Controller {

      public $user = "";
	public function __construct() {
	 parent::__construct();
     $this->load->model('Establishment_model');
	 $this->load->library('Facebook'); 
	 $this->load->helper('url');
	 $this->load->model('Establishment_tv_model');
		$e=$this->session->userdata('email');
	    $user_id=$this->Establishment_tv_model->GetUserId($e);

        $est_ref_id=$user_id[0]->id;
        $this->data['est_ref_id']= $est_ref_id;
	}  
  	 public function index()
	{
		if ($this->session->userdata('email')) {
		$ar= $this->session->all_userdata();
	//	print_r($ar);
		$est_info = $this->Establishment_tv_model->GetProfileInfo($this->data['est_ref_id']);
		$est_info_id = $est_info['id'];
		 

		 $check_subscription = $this->Establishment_model->GetSubscriptionDetails($est_info_id); 
		   //print_r($check_subscription);
		   $this->data['free_status'] = $check_subscription['free_status'];
		   $this->data['subscription'] = $check_subscription['subscription'];
		   $this->data['free_days'] = $check_subscription['free_days'];
		   $this->data['free_days_left'] = $check_subscription['free_days_left'];
		   $this->data['subscription_expire'] = date("d-m-Y", strtotime($check_subscription['subscription_end']));;
		   $this->data['subscription_status'] = $check_subscription['subscription_status'];

		 $this->load->view('establishment/home',$this->data);
		}
		else
			redirect('establishment/login');

	}
}