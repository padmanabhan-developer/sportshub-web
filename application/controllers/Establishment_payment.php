<?php
defined('BASEPATH') OR exit('No direct script access allowed');

	use Omnipay\Omnipay;

class Establishment_payment extends MY_Controller {
	public $user = "";

	public function __construct() {
	 parent::__construct();
     $this->load->model('Establishment_model');
	 $this->load->helper('url');
	 require 'vendor/autoload.php';
	}

	public function payment()
	{

		 $card_detail= $this->session->all_userdata();
		// echo $premium_due_date=$this->Establishment_model->GetPremiumDueDate($card_detail['establishment_ref']);
//exit;

		$gateway = Omnipay::create('Stripe');
		$gateway->setApiKey('sk_test_D4GrArrWBu4d1d9mnEpxpGA7');



		$formData = ['first_name' =>$card_detail['first_name'] ,'last_name' =>$card_detail['last_name'] ,'number' => $card_detail['card_number'], 'expiryMonth' => $card_detail['exp_month'], 'expiryYear' => $card_detail['exp_year'], 'cvv' => $card_detail['code']];
		
		$response = $gateway->purchase(['amount' => '10.00', 'currency' => 'USD', 'card' => $formData])->send();


		if ($response->isSuccessful()) {
		    // payment was successful: update database

		 $data = $response->getData();
// echo "<pre>";print_r($data['source']['id']); echo "</pre>";

// echo "<pre>";print_r($data); echo "</pre>";
// 		    echo $response->getTransactionReference();

		 $payment_record=array();
		 $payment_record['transaction_ref']=$data['source']['id'];
		 $payment_record['amount']=$data['amount']/100;
		 $payment_record['currency']=$data['currency'];
		 $payment_record['mode']='Credit Card';
		 $payment_record['is_verified']=True;
		 $last_payment_insert_id = $this->Establishment_model->InsertIntoPayment($payment_record);
		 

		 $premium_due_date=$this->Establishment_model->GetPremiumDueDate($card_detail['establishment_ref']);




		 $account_record=array();
		 $account_record['establishment_ref']=$card_detail['establishment_ref'];
		 $account_record['payment_ref']=$last_payment_insert_id;
		 $account_record['product']="premium";

		 if(!empty($premium_due_date))
		 	$account_record['valid_from']=$premium_due_date;
		 else 
		 	$account_record['valid_from']=date('Y-m-d H:i:s');


		 $account_record['valid_to']= date('Y-m-d H:i:s', strtotime("+1 month", strtotime($account_record['valid_from']))); 

		 $this->Establishment_model->InsertIntoAccountHistory($account_record);


		 $this->session->unset_userdata('card_number');
		 $this->session->unset_userdata('exp_month');
		 $this->session->unset_userdata('exp_year');
		 $this->session->unset_userdata('code');
		 $this->session->unset_userdata('establishment_ref');
		 $this->session->unset_userdata('est_user_ref');

		 redirect('establishment/profile_settings');
		} elseif ($response->isRedirect()) {
		    // redirect to offsite payment gateway
		    $response->redirect();
		} else {
		    // payment failed: display message to customer
		    

		    // echo $response->getMessage();
		}
	}




	

	


	


       
}