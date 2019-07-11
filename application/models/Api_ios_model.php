<?php
class Api_ios_model extends CI_Model
{
	

	public function CheckIfUserExists($email)
    {	
   		$query = $this->db->query("SELECT user_id FROM user WHERE  email_id = '".$email."' ", $this->db);

   		//if the email id is exist return false
   		if($query->num_rows() > 0){
   			return false;	  
   		}
   		else   		//if the email id does not exist return true
	    	return true;

	}
	public function CheckIfIdExists($table,$field,$id)
    {	
   		$query = $this->db->query("SELECT $field FROM $table WHERE  $field = '".$id."' ", $this->db);

   		//if the email id is exist return false
   		if($query->num_rows() > 0){
   			return false;	  
   		}
   		else   		//if the email id does not exist return true
	    	return true;

	}
	public function GetFavorite($user_id)
	{
		$fav_comp_arr=array();
		$fav_sport_arr=array();
		$fav_team_arr=array();
		
		$fav_comp=$this->db_query->FetchInformation('favourite_competition','rel_competiton_id',"rel_user_id='$user_id'");
		foreach($fav_comp as $fav){ $fav_comp_arr[]=$fav['rel_competiton_id'];}

		$fav_sport=$this->db_query->FetchInformation('favourite_sports','rel_sport_id',"rel_user_id='$user_id'");
		foreach($fav_sport as $fav){ $fav_sport_arr[]=$fav['rel_sport_id'];}

		$fav_team=$this->db_query->FetchInformation('favourite_team','rel_team_id',"rel_user_id='$user_id'");
		foreach($fav_team as $fav){ $fav_team_arr[]=$fav['rel_team_id'];}

		return array('status'=>'success','Favorite Competition'=>$fav_comp_arr,
			'Favorite Sport'=>$fav_sport_arr,'Favorite Team'=>$fav_team_arr);

	}
    public function MakeFavoriteTeam($user_id,$team_keys)
    {
      	$this->db->where('rel_user_id',$user_id);
		$this->db->delete('favourite_team');
			
		if(count($team_keys)>0)
    	{
	    	$records=array();

			//$team_ids=explode(",",$team_key);
			for($i=0;$i<count($team_keys);$i++)
			{
			 $records['created_on'] = date('Y-m-d H:i:s');
			 $records['modified_on'] = date('Y-m-d H:i:s');
			 $records['rel_user_id']= $user_id;
			 $records['rel_team_id']=$team_keys[$i];
			 
			 $this->db->insert('favourite_team',$records) or die(mysql_error());
			}
			
		 	return	array('status'=>'success');
		 }
		 else return array('status'=>'failed');

	}

	public function MakeFavoriteSport($user_id,$sport_keys)
    {
    	
      	$this->db->where('rel_user_id',$user_id);
		$this->db->delete('favourite_sports');
			
		if(count($sport_keys)>0)
    	{
	    	$records=array();
			//$team_ids=explode(",",$team_key);
			for($i=0;$i<count($sport_keys);$i++)
			{
			 $records['created_on'] = date('Y-m-d H:i:s');
			 $records['modified_on'] = date('Y-m-d H:i:s');
			 $records['rel_user_id']= $user_id;
			 $records['rel_sport_id']=$sport_keys[$i];
			 
			 $this->db->insert('favourite_sports',$records) ;
			}
			
			return	array('status'=>'success');
		}
		else return array('status'=>'failed');

	

    }
    public function MakeFavoriteCompetition($user_id,$league_keys)
    {
      	$this->db->where('rel_user_id',$user_id);
		$this->db->delete('favourite_competition');
			
		if(count($league_keys)>0)
    	{
	    	$records=array();
			//$team_ids=explode(",",$team_key);
			for($i=0;$i<count($league_keys);$i++)
			{
			 $records['created_on'] = date('Y-m-d H:i:s');
			 $records['modified_on'] = date('Y-m-d H:i:s');
			 $records['rel_user_id'] = $user_id;
			 $records['rel_competiton_id'] = $league_keys[$i];
			 
			 $this->db->insert('favourite_competition',$records) ;
			}
			return	array('status'=>'success');
		}
		else return array('status'=>'failed');

			

    }
    public function GetSport()
    {

	    $sql="select * from sport";
	    $query=$this->db->query($sql);
	    $rs=$query->result();
	   
	    return $rs;
     }
    public function GetCompetition($sport_id)
    {

	    $sql="select * from competition where rel_sport_id='".$sport_id."' ORDER BY `competition_id` DESC";
	    $query=$this->db->query($sql);
	    $rs=$query->result();
	   
	    return $rs;
     }

    public function GetMatches($competition_id,$sync_date)
    {

	    $sql="select * from fixture where rel_competition_id='".$competition_id."' and gmt_date_time > '$sync_date' ORDER BY `fixture_id` DESC";
	    $query=$this->db->query($sql);
	    $rs=$query->result();
	   
	    return $rs;
     }
   
    public function GetTeam()
    {

	    $sql="select * from team";
	    $query=$this->db->query($sql);
	    $rs=$query->result();
	   
	    return $rs;
     }
     public function GetUserDetails($user_id)
     {
     	return $this->db_query->FetchSingleInformation('user','user_id~email_id~firstname~lastname~gender~phone~country',"user_id='$user_id'");
     }














    public function GetFavouriteSport($user_id)
    {

	    $sql="select * from user where email_id='".$email."' and password = '$password'";
	    $query=$this->db->query($sql);
	    $rs=$query->result();
	   
	    return $rs;
    }
    public function GetFavouritePlayers($user_id)
    {

	    $sql="select * from user where email_id='".$email."' and password = '$password'";
	    $query=$this->db->query($sql);
	    $rs=$query->result();
	   
	    return $rs;
    }
    public function GetFavouriteTeam($user_id)
    {

	    $sql="select * from user where email_id='".$email."' and password = '$password'";
	    $query=$this->db->query($sql);
	    $rs=$query->result();
	   
	    return $rs;
    }

    public function GetFavoriteCompetition($user_ref_key)
    {

    	return $this->db_query->FetchInformation('favourite_competition','',"rel_user_id='$user_ref_key'");
    }
    public function GetFavoriteTeam($user_ref_key)
    {

    	return $this->db_query->FetchInformation('favourite_team','',"rel_user_id='$user_ref_key'");
    }

	public function GetFavoriteSport($user_ref_key)
    {

    	return $this->db_query->FetchInformation('favourite_sports','',"rel_user_id='$user_ref_key'");
    }


	public function get_request_method(){
			return $_SERVER['REQUEST_METHOD'];
	}
}

?>