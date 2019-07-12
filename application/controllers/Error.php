<?php 

if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class ErrorCustome extends MY_Controller
 {
 
  public function index()
  {
 
   
   $this->load->view('establishment/error');
  }
 }
