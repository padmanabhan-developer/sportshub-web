<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Establishment_home extends MY_Controller {

        
  	 public function index()
	{
		if ($this->session->userdata('email')) {
		$ar= $this->session->all_userdata();
	//	print_r($ar);
		 $this->load->view('establishment/home');
		}
		else
			redirect('establishment/login');

	}
}