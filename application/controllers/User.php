<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//require APPPATH.'/libraries/REST_Controller.php';


class User extends CI_Controller 
 {

	// function __construct()
 //    {
 //        // Construct our parent class
 //        parent::__construct();
	// 	//$this->load->model('User_model');
	// }

	public function index()
	{

		echo "hello";
	}

	public function user()//$username='',$password='')
	{
		echo "dfs";

$this->load->model('User_model');
			// $this->user_model->CheckUser($username,$password);
			// // Input validations
			
			
			// // If invalid inputs "Bad Request" status message and reason
			// $error = array('status' => "Failed", "msg" => "Invalid Email address or Password");
			// $this->response($this->json($error), 400);

	}
}

?>