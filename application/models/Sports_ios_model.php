<?php
class Sports_ios_model extends CI_Model
{
	

	public function GetSportsList($sports_id, $sync_date,$offset,$limit)
    {

	    
	    $cond = "where deleted_on IS NULL and so.order>0";
		if(!empty($sports_id)) $cond.=" and  s.sport_id IN ($sports_id) ";
		
	    if(!empty($sync_date) && $sync_date != '' ) $cond.= " and created_on >= '$sync_date'";
	    
	    if($offset >0 && $limit >0 ){
	    	$cond.= " Limit  $limit  OFFSET $offset";
	    }
		 
		$sql1 = "select sport_id,sport_name,image  from sportprimary";
		$query = $this->db->query($sql1);
		$ps = $query->result();
		
	    $sql="select s.sport_id,s.sport_name,si.icon  from sport as s join sports_icon as si on s.sport_id=si.sport_id join sportsorder as so on so.sport_id=s.sport_id $cond order by so.order";
		
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
				if($status !== '') {
						  $primarytsports[$i]['sport_id'] = $value->sport_id;
						  $primarytsports[$i]['sport_name'] = $value->sport_name;
						  $primarytsports[$i]['image_45x45'] = base_url().'images/sports/45x45/'.$value->icon;
						  $primarytsports[$i]['image_64x64'] = base_url().'images/sports/64x64/'.$value->icon;
						  $i++; 
				}
				else {
						  $allsports[$j]['sport_id'] = $value->sport_id;
						  $allsports[$j]['sport_name'] = $value->sport_name;
						  $allsports[$j]['image_45x45'] = base_url().'images/sports/45x45/'.$value->icon;				
						  $allsports[$j]['image_64x64'] = base_url().'images/sports/64x64/'.$value->icon;				
						  $j++;
					}
			}
			
			$sports = array('primary' => $primarytsports, 'others' => $allsports);
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