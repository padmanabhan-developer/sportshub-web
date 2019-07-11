<?php
class Matches_model extends CI_Model
{
	

	public function GetMatches($rel_competition_id,$sync_date,$offset,$limit)
    {

	    
	    $cond = "where f.deleted_on=''";
	    if(!empty($rel_competition_id)) $cond.="and f.fixture_id='$rel_competition_id' ";
		 
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

	    		$rs[] = array('id' => $row['id'],
	    		'competition_id' => $row['competition_id'],
	    		'team1' => $row['team1'],
	    		'team2' => $row['team2'],
	    		'date_time' => date("Y-m-d H:i:s", strtotime($row['date_time'].' + 1 hour')) );

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

	
}

?>