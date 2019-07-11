<?php
class Table_ios_model extends CI_Model
{
	
    public function GetLeagueCountry()
    {

        $sql="select * from competition_country";
        $query=$this->db->query($sql);
        $rs=$query->result();
       
        return $rs;
    }
    public function GetCompetitionGeographic()
    {

        $sql="select * from competition_geographic";
        $query=$this->db->query($sql);
        $rs=$query->result();
       
        return $rs;
    }

    public function GetCompetitionTeam()
    {

        $sql="select * from competition_team";
        $query=$this->db->query($sql);
        $rs=$query->result();
       
        return $rs;
    }

    public function GetCountry()
    {

        $sql="SELECT * FROM `country` order by european_country desc, country_name asc";
        $query=$this->db->query($sql);
        $rs=$query->result();
       
        return $rs;
    }
    public function GetDevices()
    {

        $sql="select * from devices";
        $query=$this->db->query($sql);
        $rs=$query->result();
       
        return $rs;
    }

    public function GetEstablishment_facility_constant()
    {

        $sql="select * from establishment_facility_constant";
        $query=$this->db->query($sql);
        $rs=$query->result();
       
        return $rs;
    }
    public function EstablishmentSubscriptionFree()
    {

        $sql="select * from establishment_subscription_free";
        $query=$this->db->query($sql);
        $rs=$query->result();
       
        return $rs;
    }

    public function GetGeographic()
    {

        $sql="select * from geographic";
        $query=$this->db->query($sql);
        $rs=$query->result();
       
        return $rs;
    }

    public function GetGrouping()
    {

        $sql="select * from grouping";
        $query=$this->db->query($sql);
        $rs=$query->result();
       
        return $rs;
    }
    public function GetLeagueGroup()
    {

        $sql="select * from league_group";
        $query=$this->db->query($sql);
        $rs=$query->result();
       
        return $rs;
    }
    public function GetNews($sync_date)
    {
		$cond = "where deleted_on IS NULL";
		if(!empty($sync_date) && $sync_date != '' ) $cond.= " and pub_date >= '$sync_date'";
		
        $sql="select DISTINCT(title), id, description,link,pub_date,provider_ref,is_active,created_on from news_feed $cond GROUP BY title order by pub_date DESC";
		//echo $sql; die; 
        $query=$this->db->query($sql);
        
		$rs = array();
		if($query->num_rows() > 0) {
            $result=$query->result();
			foreach( $result as $row ){
				$rs[] = array('id' => $row->id,
				'title' => $row->title,
				'description' => $row->description,
				'link' => $row->link,
				'pub_date' => date("d-m-Y H:i:s", strtotime($row->pub_date)), 
				'provider_ref' => $row->provider_ref, 
				'is_active' => $row->is_active, 
				'created_on' => date("d-m-Y H:i:s", strtotime($row->created_on)));
			}
		}
		else {
			$rs = array();	
		}
       
        return $rs;
    }
    public function GetTeamGrouping()
    {

        $sql="select * from team_grouping";
        $query=$this->db->query($sql);
        $rs=$query->result();
       
        return $rs;
    }
    public function GetTimezone()
    {

        $sql="select * from timezone";
        $query=$this->db->query($sql);
        $rs=$query->result();
       
        return $rs;
    }
    public function GetUserList()
    {

        $sql="select * from user";
        $query=$this->db->query($sql);
        $rs=$query->result();
       
        return $rs;
    }

    public function GetWeekConstantList()
    {

        $sql="select * from week_constant";
        $query=$this->db->query($sql);
        $rs=$query->result();
       
        return $rs;
    }

    public function InsertOrUpdateDevice($array) {
		
		$user_key = $array['user_key'];
		
		$sql="select * from user where user_id='$user_key' ";
        $query=$this->db->query($sql);
        $result=$query->result();
		$rs = array();
		if($query->num_rows() > 0) { 
			$sql1 = "select * from devices where user_key='$user_key' ";
	        $query1 = $this->db->query($sql1);
    	    $result1= $query1->result();	
			if($query1->num_rows() > 0) { 
				$arraydata = array();
				$arraydata['token'] = $array['token'];
				$arraydata['platform'] = $array['platform'];
				$arraydata['timezone'] = $array['timezone'];
				$arraydata['latitude'] = $array['latitude'];
				$arraydata['longitude'] = $array['longitude'];
				
				$this->db->where('user_key', $user_key);
				$this->db->update('devices', $arraydata);
				$id = $result1[0]->id;	
			}
			else {
				//echo "<pre>";
				//print_r($array); die;
				$this->db->insert( 'devices', $array );
				$id = $this->db->insert_id();	
			}
			$sql2 = "select * from devices where id='$id' ";
	        $query2=$this->db->query($sql2);
			$result2 = $query2->result();
			
			$rs['id'] = $result2[0]->id;
			$rs['token'] = $result2[0]->token;
			$rs['user_key'] = $result2[0]->user_key;
			$rs['platform'] = $result2[0]->platform;
			$rs['timezone'] = $result2[0]->timezone;
			$rs['latitude'] = $result2[0]->latitude;
			$rs['longitude'] = $result2[0]->longitude;
			$rs['created_on'] = $result2[0]->created_on;
			$rs['modified_on'] = $result2[0]->modified_on;
			$rs['deleted_on'] = $result2[0]->deleted_on;
			
			return array('status'=>'success','device'=> $rs );
		}
		else {
			return array('status'=>'failed','error'=>'Userid is not valid');
		}
		
	}  
    
    
    
    
    
    
    
    
    
    
    
    
     
}

?>