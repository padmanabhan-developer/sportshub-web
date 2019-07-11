<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH . 'libraries/Stripe/lib/Stripe.php');

class Payment extends MY_Controller {
	
	public function __construct() {
        parent::__construct();
        //$this->load->model('Paymentmodel', 'payment');
		//$this->load->model('Establishment_model', 'establishment');
    }
	
	public function index(){
		$this->load->view('stripe/index');
	}
	
	public function process(){
    $this->load->model('Establishment_model');
    $this->load->model('Admin_model');
 	if ($this->session->userdata('email')) {
 		//$ar= $this->session->all_userdata();
        $useremail = $this->session->userdata('email');
		$est_ref_id = $this->session->userdata('est_ref_id');
		$profile = $this->Establishment_model->GetProfileDetail($est_ref_id);
        //print_r($profile);
		try {
			$amount =  $this->input->post('amount');
			$plan =  $this->input->post('plan');
			if($plan==1){
				$desc = "Sportshub365.com Monthly Subscription";
			}
			else
				$desc = "Sportshub365.com Yearly Subscription";
			
            Stripe::setApiKey('sk_live_7pYubIHXP3L4WiCWAtqbnf7r');
            /*$charge = Stripe_Charge::create(array(
                        "amount" => $amount,
                        "currency" => "EUR",
                        "card" => $this->input->post('access_token'),
                        "description" => $desc
            ));*/
            $customer_stripe = Stripe_Customer::create(array(
                        'email' => $useremail,
                        'source'  => $this->input->post('access_token'),
                        'plan' => $plan
                        )
                    );

           // print_r($customer_stripe); 
            // this line will be reached if no error was thrown above
            //print_r($customer_stripe->id);
            //print_r($customer_stripe->created);
            if($customer_stripe['id']){
              
               $subscription_id = $customer_stripe['subscriptions']['data'][0]['id'];
               $subscription_starts = date('Y-m-d',$customer_stripe['subscriptions']['data'][0]['current_period_start']);
               $subscription_ends = date('Y-m-d',$customer_stripe['subscriptions']['data'][0]['current_period_end']);
               $subscription_plan = $customer_stripe['subscriptions']['data'][0]['plan']['id'];
               $subscription_plan_amount = $customer_stripe['subscriptions']['data'][0]['plan']['amount'];
               $subscription_plan_currency = $customer_stripe['subscriptions']['data'][0]['plan']['currency'];
               $subscription_plan_status = $customer_stripe['subscriptions']['data'][0]['status'];
               
                $card_details = $customer_stripe['sources']['data'][0];
               // print_r($card_details);
                $card_id = $card_details['id'];
                $card_object = $card_details['object'];
                $card_number = "XXXX-XXXX-XXXX-".$card_details['last4'];
                $card_brand = $card_details['brand'];
                $card_funding = $card_details['funding'];
                $card_country = $card_details['country'];
               $subscription_details =  array(  "customer_id"=>$customer_stripe['id'],
                                                "est_ref"=> $profile['id'],
                                                "subscription_id"=>$customer_stripe['subscriptions']['data'][0]['id'],
                                                "substarts"=>$subscription_starts,
                                                "subends" =>$subscription_ends,
                                                "plan" =>$subscription_plan,
                                                "amount"=>$subscription_plan_amount,
                                                "currency"=>$subscription_plan_currency,
                                                "status"=>$subscription_plan_status,
                                                "zip" => $profile['zip'],
                                                "city" => $profile['city'],
                                                "created_on" => date('Y-m-d H:i:s'),
                                                "updated_on" => date('Y-m-d H:i:s'),
                                                "card_id"=>$card_id,
                                                "card_object"=>$card_object,
                                                "card_number"=>$card_number,
                                                "card_brand"=>$card_brand,
                                                "card_funding"=>$card_funding,
                                                "card_country"=>$card_country
                                        );
               //print_r($subscription_details);

                /*$data = array(
    				'est_ref'=> $profile['id'],
                    'payment_id' => $charge->id,
                    'payment_status' => 'success',
                    'total' => 6000,
                    'description' => $desc,
                    'first_name' => $profile['title'],
                    'last_name' => '',
                    'address' => $profile['address'],
                    
                );*/
                //print_r($subscription_details);
                $response = $this->Establishment_model->InsertPayment($subscription_details);

                /****  Create Invoice and send it to customer email address ***/    

                
                $esid = $profile['id']; 
                $subsid = $customer_stripe['subscriptions']['data'][0]['id'];
                //$esid = "902";
                //$subsid ="12";

                //echo "pro".$profile['id']."--".$subscription_id;
                $row = $this->Admin_model->GetInvoiceDetails($profile['id'],$subscription_id);
                //print_r($result);
                
                    $this->data['id'] =  $row->id;
                    $this->data['title'] =  $row->title;
                    $this->data['address'] =  $row->address;
                    $this->data['subscription_plan'] =  $row->subscription_plan;
                    $this->data['subscription_amount'] =  $row->subscription_amount;
                    $this->data['subscription_id'] =  $row->subscription_id;
                    $this->data['invoiceid'] =  $row->sub_incr_id;
                    $this->data['estbemail'] =  $row->email;
                    $this->data['invoicedate'] =  $row->created_on;
                    $this->data['title'] =  $row->title;
                
                
              //die;
                ob_start();

                $html = $this->load->view('admin/invoice',$this->data,true);
                $ino = $this->data['invoiceid'] + 1000;

                $pdfFilePath = "Inv". $ino.".pdf";

                //load mPDF library
                $this->load->library('m_pdf');
                //actually, you can pass mPDF parameter on this load() function
                $pdf = $this->m_pdf->load();

                $stylesheet1 = file_get_contents('css/bootstrap.min.css'); // external css
                $stylesheet2 = file_get_contents('css/bootstrap-theme.min.css'); // external css
                $stylesheet3 = file_get_contents('css/admin/style.css'); // external css

                $pdf->WriteHTML($stylesheet1,1);
                $pdf->WriteHTML($stylesheet2,1);
                $pdf->WriteHTML($stylesheet3,1);
                //generate the PDF!
                $pdf->WriteHTML($html,2);
                //offer it to user via browser download! (The PDF won't be saved on your server HDD)
                $pdf->Output(FILE_PATH ."/Invoice/".$ino. ".pdf",'F');
                //$pdf->Output($pdfFilePath, "I");

                if( $row->subscription_plan == 'standard_monthly_plan') {
                    $plan= 'Sportshub365.com: Monthly Subscription Invoice'; $sub = "Monthly";
                }elseif ($row->subscription_plan == 'standard_yearly_plan') {
                    $plan= 'Sportshub365.com: Yearly Premium Subscription Invoice'; $sub = "Yearly";
                }
                    
                $baseurl = base_url();
                $randpwd = "123123";
                $to = $row->email;

                //$to = "bagyaraj@likepoles.com";
                $content = "";
                $content .= '<div style="float:left; width:100%;">';
                $content .= '<div style="width:600px; margin:auto">';
                $content .= '<div style="float:left; width:100%; text-align:center; margin:30px 0 33px 0;"><img src="http://sportshub365.com/images/logo_email.png"></div>';
                $content .= '<div style="background:#fff; width:100%; text-align:center; box-sizing:border-box; padding:0; float:left;">';
                $content .= '<br><br>';
                $content .= '<h2 style="color:#131e37; font-size:28px; font-family:Arial, Helvetica, sans-serif; text-transform:uppercase; margin:0; padding:40px 0;">Payment Sucessful</h2>';
                $content .= '<br><br>';
                $content .= '<h3 style="color:#c8a50a; font-size:18px; font-family:Arial, Helvetica, sans-serif; margin:0; padding:0 0 30px 0;">Sportshub &nbsp;'.$sub.' Subscription Payment is Sucessful.Please Check the invoice attached herewith</h3>';
                $content .= '<br><br>';
                $content .= '<a href="http://sportshub365.com/establishment/login" target="_blank" style="text-decoration:none; color:#fff; display:inline-block; font-family:Arial, Helvetica, sans-serif; font-size:13px; text-transform:uppercase; width:308px; height:42px; line-height:42px; text-align:center; padding:0; margin:0 0 34px 0; background:#1c6cd9;-webkit-border-radius: 10px;
                -moz-border-radius: 10px;
                border-radius: 10px;">LOGIN TO MY ACCOUNT</a>';
                // $content .= '<p style="color:#6f6f6f; font-family:Arial, Helvetica, sans-serif; font-size:11px; line-height:14px; margin:0; padding:0 0 75px 0;">After you have login to your account you can change the password to your personal password or keep this. Please remember to make a unique password that includes both letters and numbers.</p>';
                $content .= '</div>';
                $content .= '<div style="width:100%; float:left; background:#131e38; height:58px; text-align:center; line-height:58px; color:#fff; font-family:Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold;">Visit us online <a href="http://www.sportshub365.com" target="_blank"  style="text-decoration:none; color:#dab503;">www.sportshub365.com</a> or send a mail to <a href="mailto:info@sportshub365.com" style="text-decoration:none; color:#dab503;">info@sportshub365.com</a></div>';
                $content .= '</div> </div>';
                $content .= '</body></html>';
                // $to = $email;
                $subject = $plan;

                $this->load->library('email');
                $this->email->set_newline("\r\n");
                $this->email->from('info@sportshub365.com', 'Sportshub365.com');
                $this->email->set_mailtype("html");
                $this->email->to($to);
                $this->email->subject($plan);
                $this->email->message($content);
                $this->email->attach( $baseurl."/Invoice/".$ino. ".pdf");

                $result =$this->email->send(); 
                ob_end_clean();
                $pdfname = $ino.".pdf";
                $responseADmin = $this->Admin_model->updateinvoicestatus($profile['id'],$subscription_id,$pdfname);

                





                //print_r($response);
    			if ($responseADmin) {
                    
                    echo json_encode(array('status' => 200, 'success' => 'Payment successfully completed.'));
                    exit();
                } else {
                    echo json_encode(array('status' => 500, 'error' => 'Something went wrong. Try after some time.'));
                    exit();
                } 
            }
        } catch (Stripe_CardError $e) {
            echo json_encode(array('status' => 500, 'error' => STRIPE_FAILED));
            exit();
        } catch (Stripe_InvalidRequestError $e) {
            // Invalid parameters were supplied to Stripe's API
            echo json_encode(array('status' => 500, 'error' => $e->getMessage()));
            exit();
        } catch (Stripe_AuthenticationError $e) {
            // Authentication with Stripe's API failed
            echo json_encode(array('status' => 500, 'error' => AUTHENTICATION_STRIPE_FAILED));
            exit();
        } catch (Stripe_ApiConnectionError $e) {
            // Network communication with Stripe failed
            echo json_encode(array('status' => 500, 'error' => NETWORK_STRIPE_FAILED));
            exit();
        } catch (Stripe_Error $e) {
            // Display a very generic error to the user, and maybe send
            echo json_encode(array('status' => 500, 'error' => STRIPE_FAILED));
            exit();
        } catch (Exception $e) {
            // Something else happened, completely unrelated to Stripe
            echo json_encode(array('status' => 500, 'error' => STRIPE_FAILED));
            exit();
        }

	}
	else{
		redirect('establishment/home');
	}
	}
	public function success(){
		$this->load->view('stripe/success');
	}
}
