<?php
class Sports_model extends CI_Model
{
	

	/*public function GetSportsList($sync_date,$offset,$limit)
    {

	    
	    $cond = "where deleted_on IS NULL";
	    if(!empty($sync_date) && $sync_date != '' ) $cond.= " and created_on >= '$sync_date'";
	    
	    if($offset >0 && $limit >0 ){
	    	$cond.= " Limit  $limit  OFFSET $offset";
	    } 

	    $sql="select sport_id,sport_name,image  from sport $cond";
	    $query=$this->db->query($sql);
	    if($query->num_rows() > 0)  $rs=$query->result();
	    else  $rs= array();
	   
	   
	    return $rs;
     }*/
	 
	 public function GetSportsList($sync_date,$offset,$limit)
    {

	    
	    $cond = "where deleted_on IS NULL";
		if(!empty($sports_id)) $cond.=" and  s.sport_id IN ($sports_id) ";
		
	    if(!empty($sync_date) && $sync_date != '' ) $cond.= " and s.modified_on >= '$sync_date'";
	    
	    if($offset >0 && $limit >0 ){
	    	$cond.= " Limit  $limit  OFFSET $offset";
	    }
		 
		$sql1 = "select sport_id,sport_name,image  from sportprimary";
		$query = $this->db->query($sql1);
		$ps = $query->result();
		
	    $sql="select s.sport_id,s.sport_name,si.icon  from sport as s join sports_icon as si on s.sport_id=si.sport_id  $cond";
		//echo $sql; die; 
	    $query=$this->db->query($sql);
	    if($query->num_rows() > 0)  { 
		
			$rs = $query->result(); 
			$i = 0; $j = 0; $primarytsports = array(); $allsports= array();
			foreach($rs as $key => $value) {
				$status = '';
				foreach($ps as $key1 => $value1) { 
					if($value->sport_name == $value1->sport_name) {
						$status =  $value->sport_name;
						continue;
					}
				}
				  $sports[$i]['sport_id'] = $value->sport_id;
				  $sports[$i]['sport_name'] = $value->sport_name;
				  $sports[$i]['image'] = $value->icon;
				   
				if($status !== '') {
					 $sports[$i]['primary'] = 1;
				}
				else {
					 $sports[$i]['primary'] = 0;
				}
				$i++;
			}
			
			//$sports = array('primary' => $primarytsports, 'others' => $allsports);
		}
	    else  { $sports= array(); }
	   
	   
	    return $sports;
     }
	 
     public function GetDeletedSportsList()
     {
     	$sport_arr=array();
     $sportlist= $this->db_query->FetchInformation('sport','sport_id',"deleted_on != ''");
     foreach($sportlist as $list)
     {

      $sport_arr[]=$list['sport_id'];
     }

		return $sport_arr;
     }

	
}

?>