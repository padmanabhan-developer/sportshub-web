<?php
class League_model extends CI_Model
{
	

	/*public function GetCompetition($user_id,$sport_id,$sync_date,$offset,$limit)
    {

	    
	    $cond = "where c.deleted_on IS NULL";
	   
	    if(!empty($sport_id)) $cond.=" and c.rel_sport_id='$sport_id' ";
	    if(!empty($sync_date) && $sync_date != '' ) $cond.= " and c.created_on >= '$sync_date' or c.modified_on >= '$sync_date'";
	    $cond.=" order by fc.rel_competiton_id DESC ";
	    if($offset >0 && $limit >0 ){
	    	$cond.= " Limit  $limit  OFFSET $offset";
	    } 

	    $sql="
		select 
		c.competition_id as competition_id,
		c.competition_name as name , 

		c.rel_grouping_id as group_ref,
		IF( c.competition_id = fc.rel_competiton_id , 'true' , 'false' ) as isFavorite ,c.modified_on as date , c.rel_sport_id as sport_ref
		from competition c 
		left join favourite_competition fc 
		on 
		c.competition_id= fc.rel_competiton_id 
		and 
		fc.rel_user_id = '$user_id' 
		 $cond";

	    $query=$this->db->query($sql);
	    if($query->num_rows() > 0)  $rs=$query->result();


	    else  $rs= array();
	     
	    return $rs;
     }*/
	 
	 public function GetCompetition($user_id,$sport_id,$sync_date,$offset,$limit)
    {
	    $cond = "where c.deleted_on IS NULL";
	   
	    if(!empty($sport_id)) $cond.=" and c.rel_sport_id IN ($sport_id) ";
	    if(!empty($sync_date) && $sync_date != '' ) $cond.= " and c.modified_on >= '$sync_date'";
	    $cond.=" order by `co`.`order`, c.competition_name";
	    if($offset >0 && $limit >0 ){
	    	$cond.= " Limit  $limit  OFFSET $offset";
	    } 
		
	   /* $sql="
		select 
		c.competition_id as competition_id,
		c.competition_name as name , 

		c.rel_grouping_id as group_ref,
		IF( c.competition_id = fc.rel_competiton_id , 'true' , 'false' ) as isFavorite ,c.modified_on as date , c.rel_sport_id as sport_ref
		from competition c 
		left join favourite_competition fc 
		on 
		c.competition_id= fc.rel_competiton_id 
		and 
		fc.rel_user_id = '$user_id' 
		 $cond";*/
		 $sql="
		select 
		c.competition_id as competition_id,
		c.competition_name as name , c.rel_grouping_id as group_ref,	
		IF( c.competition_id = fc.rel_competiton_id , 'true' , 'false' ) as isFavorite ,c.modified_on as date , c.rel_sport_id as sport_ref
		from competition c join competitionsorder as co on c.competition_id = co.competition_id
		left join favourite_competition fc 
		on 
		c.competition_id= fc.rel_competiton_id  
		and
		fc.rel_user_id = '$user_id' 
		 $cond"; 

	    $query=$this->db->query($sql);
		$rs=$query->result();

		$sql1 = "select rel_sport_id,competition_name from competition_popular order by id";
		$query1 = $this->db->query($sql1);
		$ps = $query1->result();
		
	    if($query->num_rows() > 0) {
			$i = 0; $j = 0; $primarytleagues = array(); $allleagues = array();
			foreach($rs as $key => $value) {
				$status = '';
				foreach($ps as $key1 => $value1) { 
					if($value->name == $value1->competition_name) {
						$status =  $value1->competition_name;
						continue;
					}
				}
				  $leagues[$i]['competition_id'] = $value->competition_id;
				  $leagues[$i]['name'] = $value->name;
				  $leagues[$i]['group_ref'] = $value->group_ref;
				  $leagues[$i]['isFavorite'] = $value->isFavorite;
				  $leagues[$i]['date'] = $value->date;
				  $leagues[$i]['sport_ref'] = $value->sport_ref;
						  
				if($status !== '') {
					$leagues[$i]['primary1'] = 1;	   
				}
				else {
					$leagues[$i]['primary1'] = 0;	   
				}
				$i++;
			}
			//$leagues = array('primary' => $primarytleagues, 'others' => $allleagues);			
		}
	    else {  $leagues = array(); }
		
	    return $leagues;
     }
	 
     public function GetDeletedLeagueList()
     {
     	$sport_arr=array();
     $sportlist= $this->db_query->FetchInformation('competition','rel_sport_id',"deleted_on != ''");
     foreach($sportlist as $list)
     {

      $sport_arr[]=$list['rel_sport_id'];
     }

		return $sport_arr;
     }

	
}

?>