<?php
class Matches_ios_model_cet extends CI_Model
{
	

	public function GetMatchesCET($rel_competition_id,$sync_date,$search_text,$offset,$limit)
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
	    $query=$this->db->query($sql);
	    if($query->num_rows() > 0) {

	    	$result = $query->result_array();

			$rs = array( );
	    	foreach( $result as $row ){
				$CetTime = $this->ConvertOneTimezoneToAnotherTimezone($row['date_time'],'Europe/London','Europe/Berlin');
	    		$rs[] = array('id' => $row['id'],
	    		'competition_id' => $row['competition_id'],
	    		'team1' => $row['team1'],
	    		'team2' => $row['team2'],
	    		'date_time' => $CetTime);
	    	}
	    	

	    }
	    else  $rs= array();
	     
	    return $rs;
     }

     public function GetDeletedMatcheListCET()
     {
     	 $sport_arr=array();
	     $sportlist= $this->db_query->FetchInformation('fixture','fixture_id',"deleted_on != ''");
	     foreach($sportlist as $list)
	     {

	      $sport_arr[]=$list['fixture_id'];
	     }

		return $sport_arr;
     }

public function ConvertOneTimezoneToAnotherTimezone($time,$currentTimezone,$timezoneRequired)
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
    $timestamp = $date->format("m-d-Y H:i:s");
    return $timestamp;
}
	
}

?>