<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 class Client_model extends CI_Model
 {
  function __construct()
  {
   parent ::__construct();  
  // $currTime = date('Y-m-d H:i:s');
  } 

  public function GetSport()
  {
   //$rs= $this->db_query->FetchInformation(SPORT,"","1='1'");
    $sql="select * from sport";
    $query=$this->db->query($sql);
    foreach($query->result() as $row)
    {

     print_r($row);
    }
  }

 public function GetRecordList($table,$field)
  {
 
    $sql="select $field from  $table";
    $query=$this->db->query($sql);
    return $query->result();
    
   }

 public function GetFixture()
  { 
      //$rs= $this->db_query->FetchInformation(SPORT,"","1='1'");
      $sql="select * from fixture fixture_id=175530 ";
      $query=$this->db->query($sql);
      
      //$row=$query->result();
      if($query->num_rows()>0)
       {
         $i=0;
         foreach($query->result() as $row)
         {
          $sp[$i]['fixture_id']=$row->fixture_id;
          $sp[$i]['gmt_date_time']=$row->gmt_date_time;
          $sp[$i]['note']=$row->note;
          $sp[$i]['stage']=$row->stage;
          $sp[$i]['local_date']=$row->local_date;
          $sp[$i]['local_time']=$row->local_time;
          $sp[$i]['rel_timezone_id']=$row->rel_timezone_id;
          $sp[$i]['timezone_date']=$row->timezone_date;
          $sp[$i]['timezone_time']=$row->timezone_time;
          $sp[$i]['rel_competition_id']=$row->rel_competition_id;
          $sp[$i]['rel_team_id_2']=$row->rel_team_id_2;
          $sp[$i]['inclusive_of']=$row->inclusive_of;
          $sp[$i]['batchload_id']=$row->batchload_id;

          $i++;
         }

       }
      
    return $sp;

  }


public function CheckSportId($table,$field,$id)
{

  $query=$this->db->query("select $field from $table where $field='$id'");
  return ($query->num_rows()>0);
}
public function SendSportToDatabase($array_list)
{
 $i = 0;	
 foreach($array_list as $list)
 { 
 // echo "<br>".$list['action'];
 $currTime = date('Y-m-d H:i:s');
      $flag=false;
      $flag=$this->CheckSportId('sport','sport_id',$list['sport_id']);
      if ($flag==true)
      {
		// $records['sport_id']=$list['sport_id'];
		$records2['sport_name']=$list['sport_name'];
		$records2['image']=$list['image'];
		$records2['modified_on']=$currTime;
		$this->db->where('sport_id', $list['sport_id']);
		$this->db->update('sport',$records2);
      }
	  else{
		$records['sport_id']=$list['sport_id'];
		$records['sport_name']=$list['sport_name'];
		$records['image']=$list['image'];
		$records['created_on']=$currTime;
		$this->db->insert('sport',$records);
	  }
	  $i++; 
 // $sport_in_client=$this->GetRecordList('sport','sport_id');
 }
  $count = $i-1;
  $sql_update="UPDATE trigger_table SET action_id = '".$array_list[$count]['sport_id']."', updated_time=now() WHERE table_name = 'sport'";
  $query_update=$this->db->query($sql_update);
	  
}
public function SendChannelToDatabase($array_list)
{
	$currTime = date('Y-m-d H:i:s');
	//echo "<pre>";
	//print_r($array_list); 
	$i = 0; 
 foreach($array_list as $list)
 { 
  //echo "<br>".$list['action'];
    $flag=false;
    $flag=$this->CheckSportId('channel','channel_id',$list['channel_id']);
    if ($flag==true)
    {
		$records2['channel_name']=$list['channel_name'];
		$records2['modified_on']=$currTime;
		$this->db->where('channel_id', $list['channel_id']);
		$this->db->update('channel',$records2);
		
		// update the channel on channel_display table also
		
		$recdp['channel_display_name'] = $list['channel_name'];
		$recdp['modified_on']=$currTime;
		$this->db->where('channel_id', $list['channel_id']);
		$this->db->update('channel_display',$records2);
		
		// Update the channel name in prvider channel table 
		$recpc['channel_name'] = $list['channel_name'];
		$this->db->where('channelid', $list['channel_id']);
		$this->db->update('provider_channels',$records2);
		
    }
	else{
		$records['channel_id']=$list['channel_id'];
		$records['channel_name']=$list['channel_name'];
		$records['created_on']=$currTime;
		$this->db->insert('channel',$records);
		
		// create the channel on channel_display table also
 		$recdp['channel_id']=$list['channel_id'];
		$recdp['channel_display_name']=$list['channel_name'];
		$records['created_on']=$currTime;
		$this->db->insert('channel_display',$records);

    }
	$i++;
 }
  $count = $i-1;
  
  $sql_update="UPDATE trigger_table SET action_id = '".$array_list[$count]['channel_id']."', updated_time=now() WHERE table_name = 'channel'";
  $query_update=$this->db->query($sql_update);
	  
}
public function SendChannelListFixtureChannelListToDatabase($array_list)
{
 
 
 foreach($array_list as $list)
 { 
 // echo "<br>".$list['action'];
 
 if($list['action']=='delete' && $list['action']!='insert')
 {
     $records1['deleted_on']=$list['action_date'];
     $this->db->where('rel_fixture_channel_list_id', $list['action_id']);
     $this->db->update('channel_list_fixture_channel_list',$records1);
  }
  else{
     if( $list['action']=='update' )
     {

    $flag=false;
    $flag=$this->CheckSportId('channel_list_fixture_channel_list','rel_fixture_channel_list_id',$list['rel_fixture_channel_list_id']);

    if ($flag==true)
    {
     // $records['sport_id']=$list['sport_id'];
      $records2['rel_instance_id']=$list['rel_instance_id'];
      $records2['modified_on']=$list['action_date'];
      $this->db->where('rel_fixture_channel_list_id', $list['rel_fixture_channel_list_id']);
      $this->db->update('channel_list_fixture_channel_list',$records2);
    }
  }
    elseif ($list['action']=='insert')
    {
      $flag=false;
      $flag=$this->CheckSportId('channel_list_fixture_channel_list','rel_fixture_channel_list_id',$list['rel_fixture_channel_list_id']);

    if ($flag==false)
    {
      $records['rel_fixture_channel_list_id']=$list['rel_fixture_channel_list_id'];
      $records['rel_instance_id']=$list['rel_instance_id'];
      
      $records['created_on']=$list['action_date'];
      $this->db->insert('channel_list_fixture_channel_list',$records);
    }
   }

  }
 // $sport_in_client=$this->GetRecordList('sport','sport_id');

 }
}
public function SendChannelListFixtureListToDatabase($array_list)
{
 foreach($array_list as $list)
 { 
 // echo "<br>".$list['action'];
    $flag=false;
    $flag=$this->CheckSportId('fixture_channel_list','fixture_channel_list_id',$list['fixture_channel_list_id']);
    if ($flag==true)
    {
     // $records['sport_id']=$list['sport_id'];
      $records2['rel_fixture_id']=$list['rel_fixture_id'];
      $records2['gmt_date_time']=$list['gmt_date_time'];
      $records2['local_date']=$list['local_date'];
      $records2['local_time']=$list['local_time'];
      $records2['rel_timezone_id']=$list['rel_timezone_id'];
      $records2['timezone_date']=$list['timezone_date'];
      $records2['timezone_time']=$list['timezone_time'];
      $records2['rel_icon_id']=$list['rel_icon_id'];
      $records2['note']=$list['note'];
      $records2['rel_channel_id']=$list['rel_channel_id'];
      $records2['internet_stream']=$list['internet_stream'];
  	  //$records2['modified_on']=$list['action_date'];
      $this->db->where('fixture_channel_list_id', $list['fixture_channel_list_id']);
      $this->db->update('fixture_channel_list',$records2);
    }
	else{
      $records['fixture_channel_list_id']=$list['fixture_channel_list_id'];
      $records['rel_fixture_id']=$list['rel_fixture_id'];
      $records['gmt_date_time']=$list['gmt_date_time'];
      $records['local_date']=$list['local_date'];
      $records['local_time']=$list['local_time'];
      $records['rel_timezone_id']=$list['rel_timezone_id'];
      $records['timezone_date']=$list['timezone_date'];
      $records['timezone_time']=$list['timezone_time'];
      $records['rel_icon_id']=$list['rel_icon_id'];
      $records['note']=$list['note'];
      $records['rel_channel_id']=$list['rel_channel_id'];
      $records['internet_stream']=$list['internet_stream'];
      $this->db->insert('fixture_channel_list',$records);
	}
 }
}

public function SendChannelListToDatabase($array_list)
{
 
 $i = 0;
 foreach($array_list as $list)
 { 
 // echo "<br>".$list['action'];
    $currTime = date('Y-m-d H:i:s');
    $flag=false;
    $flag=$this->CheckSportId('channel_list','instance_id',$list['instance_id']);
	
    if ($flag==true)
    {
        $records2['instance_name']=$list['instance_name'];
        $records2['note']=$list['note'];
        $records2['frequency']=$list['frequency'];
        $records2['symbol']=$list['symbol'];
        $records2['sid']=$list['sid'];
        $records2['vpid']=$list['vpid'];
        $records2['apid']=$list['apid'];
        $records2['rel_format_id']=$list['rel_format_id'];
        $records2['rel_origin_id']=$list['rel_origin_id'];
        $records2['rel_orientation_id ']=$list['rel_orientation_id'] ;
        $records2['rel_language_id']=$list['rel_language_id'];
        $records2['rel_channel_id']=$list['rel_channel_id'];
        $records2['rel_satellite_id']=$list['rel_satellite_id'];
        $records2['rel_package_id']=$list['rel_package_id'];
        $records2['modified_on']=$currTime;
        
        $this->db->where('instance_id', $list['instance_id']);
        $this->db->update('channel_list',$records2);
      }
	  else{
        $records['instance_id']=$list['instance_id'];
        $records['instance_name']=$list['instance_name'];
        $records['note']=$list['note'];
        $records['frequency']=$list['frequency'];
        $records['symbol']=$list['symbol'];
        $records['sid']=$list['sid'];
        $records['vpid']=$list['vpid'];
        $records['apid']=$list['apid'];
        $records['rel_format_id']=$list['rel_format_id'];
        $records['rel_origin_id']=$list['rel_origin_id'];
        $records['rel_orientation_id ']=$list['rel_orientation_id'] ;
        $records['rel_language_id']=$list['rel_language_id'];
        $records['rel_channel_id']=$list['rel_channel_id'];
        $records['rel_satellite_id']=$list['rel_satellite_id'];
        $records['rel_package_id']=$list['rel_package_id'];
        $records['created_on']=$currTime;

        $this->db->insert('channel_list',$records);
		  
	 }
		$i++;  
	}
	
  $count = $i-1;
  $sql_update="UPDATE trigger_table SET action_id = '".$array_list[$count]['instance_id']."', updated_time=now() WHERE table_name = 'channel_list'";
  $query_update=$this->db->query($sql_update);
	  
	
}

public function SendCompetitionToDatabase($array_list)
{
 
// print_r($array_list);
$currTime = date('Y-m-d H:i:s');
$i = 0;
 foreach($array_list as $list)
 { 
      $flag=false;
      $flag=$this->CheckSportId('competition','competition_id',$list['competition_id']);
      if ($flag==true)
      {
       // $records['sport_id']=$list['sport_id'];
       $records2['competition_name']=$list['competition_name'];
       $records2['rel_sport_id']=$list['rel_sport_id'];
       $records2['rel_grouping_id']=$list['rel_grouping_id'];
       $records2['rel_competition_tz_id']=$list['rel_competition_tz_id'];
       $records2['modified_on']=$currTime;
       $this->db->where('competition_id', $list['competition_id']);
       $this->db->update('competition',$records2);
      }
	  else{
        $records['competition_id']=$list['competition_id'];
        $records['competition_name']=$list['competition_name'];
        $records['rel_sport_id']=$list['rel_sport_id'];
        $records['rel_grouping_id']=$list['rel_grouping_id'];
        $records['rel_competition_tz_id']=$list['rel_competition_tz_id'];
        $records['created_on']=$currTime;
        $this->db->insert('competition',$records);
	  }
	  $i++;
 }
 
  $count = $i-1;
  $sql_update="UPDATE trigger_table SET action_id = '".$array_list[$count]['competition_id']."', updated_time=now() WHERE table_name = 'competition'";
  $query_update=$this->db->query($sql_update);
  
}

public function SendCompetitionCountyToDatabase($array_list)
{
	$currTime = date('Y-m-d H:i:s');
   $query=$this->db->query("TRUNCATE TABLE competition_country");
// print_r($array_list);
 foreach($array_list as $list)
 { 
        $records['rel_competition_id']=$list['rel_competition_id'];
        $records['rel_country_id']=$list['rel_country_id'];
        $records['created_on']=$currTime;
        $this->db->insert('competition_country',$records);
 }

}
public function SendCompetitionGeographicToDatabase($array_list)
{
   $currTime = date('Y-m-d H:i:s');
   $query=$this->db->query("TRUNCATE TABLE competition_geographic");
	// print_r($array_list);
	foreach($array_list as $list)
	{ 
		$records['rel_competition_id']=$list['rel_competition_id'];
		$records['rel_geographic_id']=$list['rel_geographic_id'];
		$records['created_on']=$currTime;
		$this->db->insert('competition_geographic',$records);
	
	}
}

public function SendCompetitionTeamToDatabase($array_list)
{
    $query=$this->db->query("TRUNCATE TABLE competition_team");
	$currTime = date('Y-m-d H:i:s');
	// print_r($array_list);
 	foreach($array_list as $list)
 	{  
		$records['rel_competition_id']=$list['rel_competition_id'];
		$records['rel_team_id']=$list['rel_team_id'];
		$records['created_on']=$currTime;
		$this->db->insert('competition_team',$records);
	}

}
public function SendCountryToDatabase($array_list)
{
 $currTime = date('Y-m-d H:i:s');
// print_r($array_list);
 foreach($array_list as $list)
 { 
 // echo "<br>".$list['action'];
 
 if($list['action']=='delete' && $list['action']!='insert')
 {
     $records1['deleted_on']=$list['action_date'];
     $this->db->where('country_id', $list['action_id']);
     $this->db->update('country',$records1);
  }
  else{
    if($list['action']=='update'){

      $flag=false;
      $flag=$this->CheckSportId('country','country_id',$list['country_id']);

      if ($flag==true)
      {
       // $records['sport_id']=$list['sport_id'];
      
       $records2['country_name']=$list['country_name'];
       $records2['image']=$list['image'];
       $records2['rel_geographic_id']=$list['rel_geographic_id'];
       $records2['modified_on']=$currTime;
       $this->db->where('country_id', $list['country_id']);
       $this->db->update('country',$records2);
      }
    }
    elseif ($list['action']=='insert')
    {
    $flag=false;
    $flag=$this->CheckSportId('country','country_id',$list['country_id']);

      if ($flag==false)
      {
        $records['country_id']=$list['country_id'];
        $records['country_name']=$list['country_name'];
        $records['image']=$list['image'];
        $records['rel_geographic_id']=$list['rel_geographic_id'];
        $records['created_on']=$currTime;
        $this->db->insert('country',$records);
      }
    }

  }

 }

}
public function SendFixtureToDatabase($array_list)
{
 $currTime = date('Y-m-d H:i:s');
// print_r($array_list);
 foreach($array_list as $list)
 { 
 // echo "<br>".$list['action'];
      $flag=false;
      $flag=$this->CheckSportId('fixture','fixture_id',$list['fixture_id']);
      if ($flag==true)
      {
       $records2['gmt_date_time']=$list['gmt_date_time'];
       $records2['note']=$list['note'];
       $records2['stage']=$list['stage'];
       $records2['local_date']=$list['local_date'];
       $records2['local_time']=$list['local_time'];
       $records2['rel_timezone_id']=$list['rel_timezone_id'];
       $records2['timezone_date']=$list['timezone_date'];
       $records2['timezone_time']=$list['timezone_time'];
       $records2['rel_competition_id']=$list['rel_competition_id'];
       $records2['rel_team_id_1']=$list['rel_team_id_1'];
       $records2['rel_team_id_2']=$list['rel_team_id_2'];
       $records2['inclusive_of']=$list['inclusive_of'];
       $records2['batchload_id']=$list['batchload_id'];
       $records2['modified_on']=$currTime;
      
       $this->db->where('fixture_id', $list['fixture_id']);
       $this->db->update('fixture',$records2);
      }
	  else{
         $records['fixture_id']=$list['fixture_id'];
         $records['gmt_date_time']=$list['gmt_date_time'];
         $records['note']=$list['note'];
         $records['stage']=$list['stage'];
         $records['local_date']=$list['local_date'];
         $records['local_time']=$list['local_time'];
         $records['rel_timezone_id']=$list['rel_timezone_id'];
         $records['timezone_date']=$list['timezone_date'];
         $records['timezone_time']=$list['timezone_time'];
         $records['rel_competition_id']=$list['rel_competition_id'];
         $records['rel_team_id_1']=$list['rel_team_id_1'];
         $records['rel_team_id_2']=$list['rel_team_id_2'];
         $records['inclusive_of']=$list['inclusive_of'];
         $records['batchload_id']=$list['batchload_id'];
         $records['created_on']=$currTime;
         $this->db->insert('fixture',$records);
	  }
 }

}


public function SendGeographicToDatabase($array_list)
{
 $currTime = date('Y-m-d H:i:s');
// print_r($array_list);
 foreach($array_list as $list)
 { 
 // echo "<br>".$list['action'];
 
 if($list['action']=='delete' && $list['action']!='insert')
 {
     $records1['deleted_on']=$list['action_date'];
     $this->db->where('geographic_id', $list['action_id']);
     $this->db->update('geographic',$records1);
  }
  else{
    if($list['action']=='update'){
      $flag=false;
      $flag=$this->CheckSportId('geographic','geographic_id',$list['geographic_id']);

      if ($flag==true)
      {
       // $records['sport_id']=$list['sport_id'];
      
       $records2['geographic_name']=$list['geographic_name'];
       $records2['modified_on']=$currTime;
       $this->db->where('geographic_id', $list['geographic_id']);
       $this->db->update('geographic',$records2);
      }
    }
    elseif ($list['action']=='insert')
    {     
     $flag=false;
     $flag=$this->CheckSportId('geographic','geographic_id',$list['geographic_id']);

     if ($flag==false)
     {
        $records['geographic_id']=$list['geographic_id'];
        $records['geographic_name']=$list['geographic_name'];
        $records['created_on']=$currTime;
        $this->db->insert('geographic',$records);
      }
    }

  }
 // $sport_in_client=$this->GetRecordList('sport','sport_id');

 }

}
public function SendGroupingDatabase($array_list)
{
 
// print_r($array_list);
 foreach($array_list as $list)
 { 
 // echo "<br>".$list['action'];
 
 if($list['action']=='delete' && $list['action']!='insert')
 {
     $records1['deleted_on']=$list['action_date'];
     $this->db->where('grouping_id', $list['action_id']);
     $this->db->update('grouping',$records1);
  }
  else{
    if($list['action']=='update'){
      $flag=false;
      $flag=$this->CheckSportId('grouping','grouping_id',$list['grouping_id']);

      if ($flag==true)
      {
       // $records['sport_id']=$list['sport_id'];
      
       $records2['grouping_name']=$list['grouping_name'];
       $records2['modified_on']=$list['action_date'];
       $this->db->where('grouping_id', $list['grouping_id']);
       $this->db->update('grouping',$records2);
      }
    }
    elseif ($list['action']=='insert')
    {     
     $flag=false;
      $flag=$this->CheckSportId('grouping','grouping_id',$list['grouping_id']);

      if ($flag==false)
      {
        $records['grouping_id']=$list['grouping_id'];
        $records['grouping_name']=$list['grouping_name'];
        $records['created_on']=$list['action_date'];
        $this->db->insert('grouping',$records);
      }
    }

  }
 // $sport_in_client=$this->GetRecordList('sport','sport_id');

 }

}


public function SendTeamDatabase($array_list)
{
 $currTime = date('Y-m-d H:i:s');
// print_r($array_list);
$i = 0; 
 foreach($array_list as $list)
 { 
      $flag=false;
      $flag=$this->CheckSportId('team','team_id',$list['team_id']);
      if ($flag==true)
      {
       // $records['sport_id']=$list['sport_id'];
        $records2['team_name']=$list['team_name'];
        $records2['image']=$list['image'];
        $records2['rel_country_id']=$list['rel_country_id'];
        $records2['rel_sport_id']=$list['rel_sport_id'];
        $records2['modified_on']=$currTime;

        $this->db->where('team_id', $list['team_id']);
        $this->db->update('team',$records2);
      }
	  else{
        $records['team_id']=$list['team_id'];
        $records['team_name']=$list['team_name'];
        $records['image']=$list['image'];
        $records['rel_country_id']=$list['rel_country_id'];
        $records['rel_sport_id']=$list['rel_sport_id'];
        $records['created_on']=$currTime;
        $this->db->insert('team',$records);

	  }
	  $i++;
 }
  $count = $i-1;
  
  $sql_update="UPDATE trigger_table SET action_id = '".$array_list[$count]['team_id']."', updated_time=now() WHERE table_name = 'team'";
  $query_update=$this->db->query($sql_update);
	  
}


public function SendTeamGroupingToDatabase($array_list)
{
  $currTime = date('Y-m-d H:i:s');
    $query=$this->db->query("TRUNCATE TABLE competition_team");
 
	 foreach($array_list as $list)
	 {
	    $records['rel_team_id']=$list['rel_team_id'];
        $records['rel_grouping_id']=$list['rel_grouping_id'];
        $records['created_on']=$currTime;
        $this->db->insert('team_grouping',$records);
	}
}

public function SendTimezoneToDatabase($array_list)
{
 

 foreach($array_list as $list)
 { 
 // echo "<br>".$list['action'];
 
 if($list['action']=='delete' && $list['action']!='insert')
 {
     $records1['deleted_on']=$list['action_date'];
     $this->db->where('timezone_id', $list['action_id']);
     $this->db->update('timezone',$records1);
  }
  else{
    if($list['action']=='update'){
      $flag=false;
      $flag=$this->CheckSportId('timezone','timezone_id',$list['timezone_id']);

      if ($flag==true)
      {
       
        $records2['timezone_name']=$list['timezone_name'];
        $records2['offset']=$list['offset'];
        $records2['location']=$list['location'];
        $records2['timezone_code']=$list['timezone_code'];
        $records2['modified_on']=$list['action_date'];
        $this->db->where('timezone_id', $list['timezone_id']);
        $this->db->update('timezone',$records2);
      }
    }
    elseif ($list['action']=='insert')
    {  
     $flag=false;
      $flag=$this->CheckSportId('timezone','timezone_id',$list['timezone_id']);

      if ($flag==false)
      {
        
        $records['timezone_id']=$list['timezone_id'];
        $records['timezone_name']=$list['timezone_name'];
        $records['offset']=$list['offset'];
        $records['location']=$list['location'];
        $records['timezone_code']=$list['timezone_code'];
        $records['created_on']=$list['action_date'];
       
        $this->db->insert('timezone',$records);
      }
    }

  }
 // $sport_in_client=$this->GetRecordList('sport','sport_id');

 }

}


public function SetSyncDate($dat)
{
  $data['sync_date']=$dat;
  $data['sync_name']='sport';
  $this->db->insert('sync_time',$data);
}

public function GetLastSyncVal()
{
  $sql="select sync_date from sync_time order by sync_date desc limit 1";
  $query= $this->db->query($sql);
  $res = array();
  
  if($query->num_rows()>0)
  {
    $row=$query->result();

   $row=$row[0];
    //return $row->sync_date;
  }
  
  $sql1="select * from trigger_table order by id asc ";
  $query_1 = $this->db->query($sql1);
  $row_1 =$query_1->result();
  
  $res[0] = $row->sync_date;
  $i = 1;
  foreach($row_1 as $key => $val) {
	  $res[$i] = $val->action_id;
	  $i++;
  }
  //$res[$i] = '';
 return $res; 
}
//this method for testing cronjob.com is workin or not letter we will remove
public function RegisterSubscription($data) {

    $this->db->insert('establishment_subscription_free', $data);

  }

// old
// public function SendCompetitionCountryToDatabase($array_list)
// {
//   //print_r($array_list)  ;
//   $client_data=$this->GetRecordList('competition_country');
//   echo count($client_data);

//   $i=0;
//   foreach($array_list as $key=>$value)
//   {
//     $records[$key] =$value;
//     if(!in_array($value, $fixture_in_client))
//     {
//      $this->db->insert('fixture',$records[$key]); 
//     }
//     $i++;
//   }


// //$this->db->insert('fixture',$array_list);
// }



  //end of class
}