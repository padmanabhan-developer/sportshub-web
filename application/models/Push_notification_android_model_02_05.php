<?php 
class Push_notification_android_model extends CI_Model
{

public function GetMatchNotifications($device) {
	 
	 if(count($device)>0) {
			
			$user_key = $device['user_key'];
			$fev_team = $this->GetFavoriteTeam($user_key);
			
			if(count($fev_team)>0) {
				foreach($fev_team as $key => $value) {
					$team[] = $value['rel_team_id'];
				}
			
				$team_id = implode(',', $team);
				$team_id = trim($team_id, ',');
				//print_r($team_id); die;
				$match_details = $this->GetMatchesDetails($team_id,$device);
			}
			//print_r($match_details);
	 }
  }
  
  public function GetEstablishmentNotifications($devices) {
	 		
			date_default_timezone_set('Europe/London');
			
			$current_date = date("Y-m-d H:i:s");
			$sync_date = date("Y-m-d H:i:s", strtotime('-1 minutes', strtotime($current_date)) );
			
			$sql = "SELECT ee.*, ei.title as establishment, ei.geo_lat, ei.	geo_lang, eu.id as user_key FROM `establishment_event` as ee join `establishment_info` as ei on `ee`.est_ref =`ei`.id join `establishment_user` as eu on `ei`.est_user_ref=`eu`.id where ee.created_on >= '$sync_date'";
			//echo $sql;  
			$query=$this->db->query($sql);
			if($query->num_rows() > 0){
			$est_event = $query->result_array();
			//echo "<pre>";
			//print_r($est_event); die;
				foreach($est_event as $event) {
					foreach($devices as $device) {
						
						if($device['user_key'] == $event['user_key'] ) continue;
							
							$est_lat  = $event['geo_lat'];
							$est_lan  = $event['geo_lang'];
							$user_lat = $device['latitude'];
							$user_lan = $device['longitude'];
							if($user_lat!='' && $user_lan!='') {
								$theta = $est_lan - $user_lan;
								$dist = sin(deg2rad($est_lat)) * sin(deg2rad($user_lat)) +  cos(deg2rad($est_lat)) * cos(deg2rad($user_lat)) 
										* cos(deg2rad($theta));
								$dist = acos($dist);
								$dist = rad2deg($dist);
								$distance = $dist * 60 * 1.1515 * 1.609344;
								//echo $distance; die;
							if($distance <= 200) {	
								$message = $event['establishment']." has announced a new event. Click here to see what's on.";  			  
								$notify_arr = array();
								$notify_arr['message'] = $message;
								$notify_arr['user_key'] = $device['user_key'];
								$notify_arr['token'] = $device['token'];
								$notify_arr['platform'] = $device['platform'];	
								
								$this->StoreNotification($notify_arr);
								$array = array();
								$array['name'] = "Event";
								$array['id'] = $event['est_ref'];
								echo $this->push_gcm($device['token'], $message, $array);	
								echo "<br>";	
							}
						}
					}		
				}
			}
  }
  
  public function GetMatchesDetails($team_id,$device)
    {
	   
		$time = date("Y-m-d H:i:s");
		$date = new DateTime($time);
		$date->setTimezone(new DateTimeZone('Europe/London'));
		$sync_date = $date->format('Y-m-d H:i:s'); 
		$start_date1 = date("Y-m-d H:i", strtotime('+120 minutes', strtotime($sync_date)) );
		$end_date1 = date("Y-m-d H:i", strtotime('+140 minutes', strtotime($sync_date)) );
		
		$start_date2 = date("Y-m-d H", strtotime('+24 hours', strtotime($sync_date)) );
		$end_date2 = date("Y-m-d H", strtotime('+25 hours', strtotime($sync_date)) );
		
		/*echo $sync_date.'____'.$start_date1.'__'.$end_date1; 
		echo "<br>";
		echo $sync_date.'____'.$start_date2.'__'.$end_date2; 
		echo "<br>";
		echo "<br>";*/
		//echo 'Current Time :'. $sync_date.'____Change Time :'.$start_date1.'__2 Hours'; 
		//echo "<br>";
		//echo 'Current Time :'.$sync_date.'____Change Time :'.$start_date2.'__24 Hours'; 
		//echo "<br>";
		//echo "<br>";
	    $cond = "where (f.deleted_on='' or f.deleted_on is NULL)";
	    //if(!empty($rel_competition_id)) $cond.="and f.rel_competition_id IN ($rel_competition_id) ";
		if(!empty($team_id)) $cond.="and (t1.team_id = '$team_id' or t2.team_id = '$team_id') ";
		//if(!empty($team_id)) $cond.="and (f.gmt_date_time = NOW() - INTERVAL 2 HOUR) ";
		
	    if(!empty($sync_date) && $sync_date != '' ) $cond.= " and ( (f.gmt_date_time >= '$start_date1' and f.gmt_date_time <= '$end_date1') or (f.gmt_date_time >= '$start_date2' and f.gmt_date_time <= '$end_date2' )) ";
	    
	    $cond .= " order by date_time ";

	    /*if($offset >0 && $limit >0 ){
	    	$cond.= " Limit  $limit  OFFSET $offset";
	    } */

	    $sql="select 
	    f.fixture_id as id,
	    f.gmt_date_time as date_time,
	    f.rel_competition_id as competition_id,
	    t1.team_name as team1,
	    t2.team_name as team2
	    from fixture f 
	    inner join team t1 on 
	    t1.team_id = f.rel_team_id_1 
	    inner join team t2 on 
	    t2.team_id = f.rel_team_id_2 
	    $cond";
		//echo $sql; 
		//echo "<br>";
		//die; 
		//echo "<pre>";
		//print_r($device); die;
	    $query=$this->db->query($sql);
	    if($query->num_rows() > 0) {

	    	$result = $query->result_array();
			//echo "<pre>";
			//print_r($result); 
			$rs = array( );
	    	foreach( $result as $row ){
				
				$date = new DateTime($sync_date, new DateTimeZone('Europe/London'));
				$date->setTimezone(new DateTimeZone($device['timezone']));

				$diff_hours_2  = date("Y-m-d H:i", strtotime('+120 minutes', strtotime($date->format('Y-m-d H:i:s'))) );
				$diff_hours_24 = date("Y-m-d H:i", strtotime('+24 hours', strtotime($date->format('Y-m-d H:i:s'))) );
				
				
				$matchdate = new DateTime($row['date_time'], new DateTimeZone('Europe/London'));
				$matchdate->setTimezone(new DateTimeZone($device['timezone']));
				$matchhour = $matchdate->format('Y-m-d H:i');
				
				//echo $row['date_time'].'______'.$matchdate->format('Y-m-d H:i:s').'____'.$diff_hours_2; die;
				/*echo $diff_hours_2.'______'.$matchhour;
				echo "<br>";
				echo $diff_hours_24.'______'.$matchhour;
				echo "<br>";
				echo strtotime($diff_hours_2).'______'.strtotime($matchhour);
				echo "<br>";*/
				
				// 24 hours before notification
				if( strtotime($diff_hours_24) == strtotime($matchhour) ) { //echo 'test';
					//$a = 'test';
					/*$rs[] = array('matchid' => $row['id'],
								  //'competition_id' => $row['competition_id'],
								  'team1' => $row['team1'],
								  'team2' => $row['team2'],
								  'date_time' => date("d-m-Y H:i:s", strtotime($row['date_time'].' + 2 hour')) );	*/
								  
					
					$message = $row['team1'].' vs '.$row['team2'].' 24hrs to kick off! Click here to find nearest venue.';  			  
					$notify_arr = array();
					$notify_arr['message'] = $message;
					$notify_arr['user_key'] = $device['user_key'];
					$notify_arr['token'] = $device['token'];
					$notify_arr['platform'] = $device['platform'];
					
					$this->StoreNotification($notify_arr);
					$array = array();
					$array['name'] = "Team";
					$array['id'] = $row['id'];
					$array['matchtime'] = $matchhour;
					
					echo $this->push_gcm($device['token'], $message, $array);
					echo "<br>";
					continue;		  
				}
				// 2 hours before notification
				else if( strtotime($diff_hours_2) == strtotime($matchhour) ) { 
					/*$rs[] = array('matchid' => $row['id'],
								  //'competition_id' => $row['competition_id'],
								  'team1' => $row['team1'],
								  'team2' => $row['team2'],
								  'date_time' => date("d-m-Y H:i:s", strtotime($row['date_time'].' + 2 hour')) );*/
					
					$message = $row['team1'].' vs '.$row['team2'].' 2hrs to kick off! Click here to find nearest venue.';  		
						  
					$notify_arr = array();
					$notify_arr['message'] = $message;
					$notify_arr['user_key'] = $device['user_key'];
					$notify_arr['token'] = $device['token'];
					$notify_arr['platform'] = $device['platform'];
					
					$this->StoreNotification($notify_arr);	
					
					$array = array();
					$array['name'] = "Team";
					$array['id'] = $row['id'];
					$array['matchtime'] = $matchhour;
					
					echo $this->push_gcm($device['token'], $message, $array);
					echo "<br>";
					
					continue;
				}
	    	}
	    }
	    else  $rs = array();
	   // print_r($rs);
	    //return $rs;
     }
	 
	 public function StoreNotification($records) {
		 
    	$this->db->insert('push_gcm_messages',$records ); 
		
	 }
	 
	 public function push_gcm($token, $message, $array){
		
		$regid = $token;
		
    	//define("GOOGLE_API_KEY", "AIzaSyCMbf00R3AHbKuWKWq2ucozsMaQyXuSpl0");
		$url = 'https://android.googleapis.com/gcm/send';
	
		/* $fields = array('registration_ids' => array($regid),
		  'data' => array('message' => 'Testing Message')); */
		//$notification_message = $array['message'];
		$notification_message = $message;
		
		$data = array("message" => $notification_message,/*"link" => $link,*/"notification_type" => "common", "count" => 1, "id" => $array['id'], 'notify_type' => $array['name']);
		if($array['name'] == 'Team') { 
			$data['matchtime'] = $array['matchtime'];
		}
		
		$fields = array(
			'contentTitle' => "", //The title you must send a string
			'tickerText' => "",
			'contentTex' => "",
			'registration_ids' => $regid, //Token ID
			'data' => $data);
	
		//echo "<pre>";
		//print_r($fields); die;
		$headers = array(
			'Authorization: key=' . GOOGLE_API_KEY,
			'Content-Type: application/json'
		);
		//print_r($headers);
		// Open connection
		$ch = curl_init();
	
		// Set the url, number of POST vars, POST data
		curl_setopt($ch, CURLOPT_URL, $url);
	
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	
		// Disabling SSL Certificate support temporarly
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
	
		// Execute post
		$result = curl_exec($ch);
		
		//print_r($result); 
		// Close connection
		curl_close($ch);
		$platform = 1;
		ob_flush();
	}
	
	 public function GetDeviceInfo()
    	{
    		return $this->db_query->FetchInformation('devices_android','token~user_key~platform~timezone~latitude~longitude','');
    	}
	
	 public function GetFavoriteTeam($user_ref_key)
    	{
    	return $this->db_query->FetchInformation('favourite_team','',"rel_user_id='$user_ref_key'");
    	}
	
	public function SetSyncDate($dat)
	{
	  $data['sync_date']=$dat;
	  $data['sync_name']='android';
	  $this->db->insert('sync_time_push',$data);
	}
	
	public function ConvertTimezone($time,$currentTimezone,$timezoneRequired)
	{
		$system_timezone = date_default_timezone_get();
		$local_timezone = $currentTimezone;
		date_default_timezone_set($local_timezone);
		$local = date("Y-m-d h:i:s A");
	 
		date_default_timezone_set("GMT");
		$gmt = date("Y-m-d h:i:s A");
	 
		$require_timezone = $timezoneRequired;
		date_default_timezone_set($require_timezone);
		$required = date("Y-m-d h:i:s A");
	 
		date_default_timezone_set($system_timezone);
	
		$diff1 = (strtotime($gmt) - strtotime($local));
		$diff2 = (strtotime($required) - strtotime($gmt));
	
		$date = new DateTime($time);
		$date->modify("+$diff1 seconds");
		$date->modify("+$diff2 seconds");
		$timestamp = $date->format("d-m-Y H:i:s");
		return $timestamp;
}	
}
?>