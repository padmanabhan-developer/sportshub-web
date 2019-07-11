<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class Push extends MY_Controller {

	function __construct()
	{
   		parent :: __construct();

   		$this->load->library('GCM'); 

   	}
       
    public function index()
    {
    	echo "<h1>Index</h1>";
    }

	public function hello()
    {
    	   		$this->load->library('gcm'); 


	    $regId = "fbICuml7dg4:APA91bFYc1E1XqBt7h5Cv-fKt5rucE7hsTLQPr9CyqTLWLwS_wEP_P_GRGVOQaRc9lWGITnxaQMybR6SU1ZzMVmhpiLtzR-gR7jyM__tm39fN9hBsjgBktOUQhFZFJQ4tjJAv1zruMef";
	    $message = "hello";
	     
	    //include_once './GCM.php';
	     
	    // $gcm = new GCM();
	 
	    $registatoin_ids = array($regId);
	    $message = array("message" => $message);
	 
	    $result = $this->gcm->send_notification($registatoin_ids, $message);
	 
	    echo $result;
	}
}
?>