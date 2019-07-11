<?php
class Matches_android_model extends CI_Model
{
	

	public function GetMatches($rel_competition_id,$sync_date,$offset,$limit)
    {
	    $cond = "where (deleted_on='' or deleted_on is NULL)";
	     if(!empty($rel_competition_id)) $cond.="and rel_competition_id='$rel_competition_id' ";
	     if(!empty($sync_date) && $sync_date != '' ) $cond.= " and gmt_date_time >= '$sync_date'";
	    
	    $cond .= " order by date_time ";

	    if($offset >0 && $limit >0 ){
	    	$cond.= " Limit  $limit  OFFSET $offset";
	    } 

	    $sql="select 
	    	fixture_id as id,
	    	gmt_date_time as date_time,
	    	rel_competition_id as competition_id,
	    	rel_team_id_1 as team1,
	    	rel_team_id_2 as team2
	    from fixture
	    $cond";
	    $query=$this->db->query($sql);
	    if($query->num_rows() > 0) {

	    	$result = $query->result_array();
			$current_timezone = $this->gettimezone(); 
			$rs = array( );
	    	foreach( $result as $row ){
				//$current_timezone = date_default_timezone_get(); 
				//$current_timezone = 'Europe/Berlin';
				$CetTime = $this->ConvertOneTimezoneToAnotherTimezone($row['date_time'], 'Africa/Accra', $current_timezone);
				/*if($current_timezone == 'Europe/Madrid' ) {
					$CetTime = date("Y-m-d H:i:s", strtotime('-1 hour', strtotime($CetTime)));
				}*/
	    		$rs[] = array('id' => $row['id'],
	    		'competition_id' => $row['competition_id'],
	    		'team1' => $row['team1'],
	    		'team2' => $row['team2'],
	    		'date_time' => $CetTime );
	    	}
	    }
	    else  $rs= array();
	     
	    return $rs;
     }
	
	public function GetUpdatedMatcheList($rel_competition_id,$sync_date,$offset,$limit)
    {
	    $cond = "where (f.deleted_on='' or f.deleted_on is NULL)";
	     if(!empty($rel_competition_id)) $cond.="and f.rel_competition_id='$rel_competition_id' ";
	     //if(!empty($sync_date) && $sync_date != '' ) $cond.= " and modified_on >= '$sync_date'";
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
			//$current_timezone = $this->gettimezone(); 
			$rs = array( );
	    	foreach( $result as $row ){
				//$current_timezone = date_default_timezone_get(); 
				//$current_timezone = 'Europe/Berlin';
				/*$CetTime = $this->ConvertOneTimezoneToAnotherTimezone($row['date_time'], 'Africa/Accra', $current_timezone);
				if($current_timezone == 'Europe/Madrid' ) {
					$CetTime = date("Y-m-d H:i:s", strtotime('-1 hour', strtotime($CetTime)));
				}*/
	    		$rs[] = array('id' => $row['id'],
	    		'competition_id' => $row['competition_id'],
	    		'team1' => $row['team1'],
	    		'team2' => $row['team2'],
	    		'date_time' => $row['date_time'], 
				//'modified_on' => $row['modified_on'], 
				);
	    	}
	    }
	    else  $rs= array();
	     
	    return $rs;
     }
	 
     public function GetDeletedMatcheList()
     {
     	 $sport_arr=array();
	     $sportlist= $this->db_query->FetchInformation('fixture','fixture_id',"deleted_on != '0000-00-00 00:00:00'");
	     foreach($sportlist as $list)
	     {

	      $sport_arr[]=$list['fixture_id'];
	     }

		return $sport_arr;
     }
	
	public function gettimezone() {
	  
		//$ip = '79.145.239.22';
		$ip  = !empty($_SERVER['HTTP_X_FORWARDED_FOR']) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR'];
		$apiUrl = "http://pro.ip-api.com/json/$ip?key=55J1wP2dW3GhyLx";
		$url = file_get_contents($apiUrl);
		$ipData = json_decode($url, true);
		if ($ipData['status']== "success") {
			$timezone = $ipData['timezone'];
		}
		else{
			$timezone = 'Europe/London';
		}
		return $timezone;
  }
  
	/* Converting GMT time zone in to CET Edited on Oct26 2015 Bagayraj*/

	public function ConvertOneTimezoneToAnotherTimezone($time,$currentTimezone,$timezoneRequired)
	{
		$system_timezone = date_default_timezone_get();
		$local_timezone = $currentTimezone;
		date_default_timezone_set($local_timezone);
		$local = date("Y-m-d h:i:s A");
	 
		date_default_timezone_set("CET");
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
		$timestamp = $date->format("Y-m-d H:i:s");
		return $timestamp;
	}
}

?>