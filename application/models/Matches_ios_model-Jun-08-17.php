<?php
class Matches_ios_model extends CI_Model
{
	

	public function GetMatches($rel_competition_id,$sync_date,$search_text,$offset,$limit)
    {

	    
	    $cond = "where (f.deleted_on='' or f.deleted_on is NULL)";
	    if(!empty($rel_competition_id)) $cond.="and f.rel_competition_id IN ($rel_competition_id) ";
		if(!empty($search_text)) $cond.="and (t1.team_name like '%$search_text%' or t2.team_name like '%$search_text%') ";
		
	    if(!empty($sync_date) && $sync_date != '' ) $cond.= " and f.gmt_date_time >= '$sync_date'";
	    
	    $cond .= " order by date_time ";

	    if($offset >0 && $limit >0 ){
	    	$cond.= " Limit  $limit  OFFSET $offset";
	    } 

	    $sql="select 
	    f.fixture_id as id,
		gmt_date_time as date_time,
	    f.rel_competition_id as competition_id,
	    t1.team_name as team1,
	    t2.team_name as team2
	    from fixture f 
	    inner join team t1 on 
	    t1.team_id = f.rel_team_id_1 
	    inner join team t2 on 
	    t2.team_id = f.rel_team_id_2 
	    $cond";
	    $query=$this->db->query($sql);
	    if($query->num_rows() > 0) {

	    	$result = $query->result_array();

			$rs = array( );
			$current_timezone = $this->gettimezone();
			//$current_timezone = 'Europe/Copenhagen';
			//echo $current_timezone; die; 
	    	foreach( $result as $row ){
				//$current_timezone = date_default_timezone_get();
				
				$CetTime = $this->ConvertOneTimezoneToAnotherTimezone($row['date_time'], 'Africa/Accra', $current_timezone);
				/*if($current_timezone == 'Atlantic/Canary' ) {
					$CetTime = date("d-m-Y H:i:s", strtotime('-1 hour', strtotime($CetTime)));
				}*/
	    		$rs[] = array('id' => $row['id'],
	    		'competition_id' => $row['competition_id'],
	    		'team1' => $row['team1'],
	    		'team2' => $row['team2'],
	    		/*'date_time' => date("d-m-Y H:i:s", strtotime($row['date_time'].' + 2 hour')) );*/
				'date_time' => $CetTime);
	    	}
	    	

	    }
	    else  $rs= array();
	     
	    return $rs;
     }

     public function GetDeletedMatcheList()
     {
     	 $sport_arr=array();
	     $sportlist= $this->db_query->FetchInformation('fixture','fixture_id',"deleted_on != ''");
	     foreach($sportlist as $list)
	     {

	      $sport_arr[]=$list['fixture_id'];
	     }

		return $sport_arr;
     }
	
	public function gettimezone() {
	  
		$ip  = !empty($_SERVER['HTTP_X_FORWARDED_FOR']) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR'];
		//$ip = '185.4.32.12';
		//$url = "http://freegeoip.net/json/$ip";
		$url = "http://ip-api.com/php/$ip";
		$ch  = curl_init();
		
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
		$data = curl_exec($ch);
		curl_close($ch);
			/*echo "<pre>";
			print_r($data); die;*/
		if ($data) {
			$location = unserialize($data);
			/*echo "<pre>";
			print_r($location); die;*/
			$timezone = $location['timezone'];
			/*echo $timezone; die;*/
			if($timezone=='')
			$timezone = 'Europe/London';
		}
		else {
			$timezone = 'Europe/London';
		}
		//echo $timezone; die;
		return $timezone;
  }
  
	/* Converting GMT time zone in to CET Edited on Oct26 2015 Bagayraj*/

	public function ConvertOneTimezoneToAnotherTimezone($time,$currentTimezone,$timezoneRequired)
	{
		$system_timezone = date_default_timezone_get();
		$local_timezone = $currentTimezone;
		date_default_timezone_set($local_timezone);
		$local = date("Y-m-d H:i:s");
	 
		date_default_timezone_set("GMT");
		$gmt = date("Y-m-d H:i:s");
	 
		$require_timezone = $timezoneRequired;
		date_default_timezone_set($require_timezone);
		$required = date("Y-m-d H:i:s");
	 
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