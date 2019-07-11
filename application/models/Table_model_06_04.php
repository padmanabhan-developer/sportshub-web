<?php
class Table_model extends CI_Model
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
    /*public function GetNews()
    {

        $sql="select * from news";
        $query=$this->db->query($sql);
        $rs=$query->result();
       
        return $rs;
    }*/
	
	public function GetNews($sync_date)
    {
		$cond = "where deleted_on IS NULL";
		if(!empty($sync_date) && $sync_date != '' ) $cond.= " and pub_date >= '$sync_date'";
		
        $sql="select * from news_feed $cond order by pub_date DESC";
        $query=$this->db->query($sql);
        $result=$query->result();
		$rs = array();
		if($query->num_rows() > 0) {
			foreach( $result as $row ){
				$rs[] = array('id' => $row->id,
				'title' => $row->title,
				'description' => $row->description,
				'link' => $row->link,
				'pub_date' => date("Y-m-d H:i:s", strtotime($row->pub_date)), 
				'provider_ref' => $row->provider_ref, 
				'is_active' => $row->is_active, 
				'created_on' => date("Y-m-d H:i:s", strtotime($row->created_on)));
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

    
    
    
    
    
    
    
    
    
    
    
    
    
     
}

?>