<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class Push_notification extends MY_Controller {

	public function send()
	{
		$this->load->model('Push_notification_model');
		$this->load->model('Establishment_model');
		
		$devices = $this->Push_notification_model->GetDeviceInfo();
		//echo "<pre>";
		//print_r($devices); die;
		
		foreach($devices as $device) {
			$this->Push_notification_model->GetMatchNotifications($device);
		}
		
		$this->Push_notification_model->GetEstablishmentNotifications($devices);
		
		$date = new DateTime();
		$date->setTimezone(new DateTimeZone('Europe/London'));
		$datestr = $date->format('Y-m-d H:i:s');
				
		$this->Push_notification_model->SetSyncDate($datestr);
	}
	
	public function send_android()
	{
		$this->load->model('Push_notification_android_model');
		$this->load->model('Establishment_model');
		
		$devices = $this->Push_notification_android_model->GetDeviceInfo();
		//echo "<pre>";
		//print_r($devices); die;
		
		foreach($devices as $device) {
			$this->Push_notification_android_model->GetMatchNotifications($device);
		}
		
		$this->Push_notification_android_model->GetEstablishmentNotifications($devices);
		
		$date = new DateTime();
		$date->setTimezone(new DateTimeZone('Europe/London'));
		$datestr = $date->format('Y-m-d H:i:s');
				
		$this->Push_notification_android_model->SetSyncDate($datestr);
	}
	
	public function push_apns1($token, $message){
		// Put your device token here (without spaces):
		//$deviceToken = '2df1af87876df690110e983ddaeb9893f81211800dd8eefa17250fe98bdcc6e8';
		$deviceToken = 'f17843b066353443df79194ae5b8d922af9da3023c6fb3d442657c13b8b597ff';
		
		
		// Put your private key's passphrase here:
		$passphrase = 'pushchat';
		
		// Put your alert message here:
		$message = 'Sportshub push notification!';
		
		////////////////////////////////////////////////////////////////////////////////
		
		$ctx = stream_context_create();
		stream_context_set_option($ctx, 'ssl', 'local_cert', 'ck.pem');
		stream_context_set_option($ctx, 'ssl', 'passphrase', $passphrase);
		
		// Open a connection to the APNS server
		$fp = stream_socket_client(
			'ssl://gateway.sandbox.push.apple.com:2195', $err,
			$errstr, 60, STREAM_CLIENT_CONNECT|STREAM_CLIENT_PERSISTENT, $ctx);
		
		if (!$fp)
			exit("Failed to connect: $err $errstr" . PHP_EOL);
		
		echo 'Connected to APNS' . PHP_EOL;
		
		// Create the payload body
		$body['aps'] = array(
			'alert' => $message,
			'sound' => 'default'
			);
		
		// Encode the payload as JSON
		$payload = json_encode($body);
		
		// Build the binary notification
		$msg = chr(0) . pack('n', 32) . pack('H*', $deviceToken) . pack('n', strlen($payload)) . $payload;
		
		// Send it to the server
		$result = fwrite($fp, $msg, strlen($msg));
		
		if (!$result)
			echo 'Message not delivered' . PHP_EOL;
		else
			echo 'Message successfully delivered' . PHP_EOL;
		
		// Close the connection to the server
		fclose($fp);
	
	}
}
?>