<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 class App_tv_model extends CI_Model
 {
  function __construct()
  {
   parent ::__construct();  
  } 


 public function GetUserId($email)
    {

      $sql="select id from establishment_user where email='".$email."' ";
      $query=$this->db->query($sql);
      $rs=$query->result();
     
      return $rs;
    }

  public function SearchFormAttribute($values=array())
  {
     if(count($values) == 0)
     {
      $values=array('date_from'=>'Date From','date_end'=>'Date End','search_text'=>'Search');
     }
     $fun="SearchResult(path.value,'1','20',date_from.value,date_end.value,search_text.value,'');";
     $attribute['form']=array('id'=>'search_frm2','name'=>'search_frm2');
     
     $attribute['date_from']=array('name'=> 'date_from','id'=> 'datepicker-example3','value' => trim($values['date_from']),'class'=>"date-input" , 'onfocus'=>"if (this.value == 'Date From') {this.value = '';}" ,'onblur'=>"if (this.value == '') {this.value = 'Date From';}");

     $attribute['date_end']=array('name'=> 'date_end','id'=> 'datepicker-example4','value' => trim($values['date_end']),'class'=>"date-input" , 'onfocus'=>"if (this.value == 'Date End') {this.value = '';}" ,'onblur'=>"if (this.value == '') {this.value = 'Date End';}");

     $attribute['search_text']=array('name'=> 'search_text','id'=> 'search_text','value' => trim($values['search_text']),'class'=>"date-input" , 'onfocus'=>"if (this.value == 'Search') {this.value = '';}" ,'onblur'=>"if (this.value == '') {this.value = 'Search';}");
     
     $attribute['submit']=array('type' => 'button',  'name' => 'form_submit','class'=>'search-button','value'=>'',
      'onclick'=>$fun);
     return $attribute;
  }

  
  public function SearchResult($from_date,$to_date,$search_text)
  { 
      //$rs= $this->db_query->FetchInformation(SPORT,"","1='1'");

     $from_date = str_replace("/","-", $from_date);
     $to_date = str_replace("/","-", $to_date);
     $where="where deleted_on is NULL";
     if(!empty($from_date) && $from_date!='Date From') $where.=" and date >='$from_date'";
     if(!empty($to_date) && $to_date!='Date End') $where.=" and date <='$to_date'";
     if(!empty($search_text) && $search_text!='Search') $where.=" and title like '%$search_text%'";

      $sql="select * from establishment_event $where order by date";
      $query=$this->db->query($sql);
      $event=array();
      $row=$query->result();
      if($query->num_rows()>0)
       {
         $i=0;
         foreach($query->result() as $row)
         {
          $event[$i]['id']=$row->id;
          $event[$i]['est_ref']=$row->est_ref;
          $event[$i]['title']=$row->title;
          $event[$i]['date']=$row->date;
          $event[$i]['time']=$row->time;
          $event[$i]['duration']=$row->duration;



          $i++;
         }

       }

     
      
    return $event;

  }
  
  
  public function GetSportId($channel_ids)
  {
   
    $sql="select rel_sport_id from competition where competition_id in ('".$channel_ids."')";
    $query=$this->db->query($sql);
    //$this->db->select('sport_id')->from('competition')->where('competition_id', $est_ref_id)->order_by('valid_to','desc')->get();

 if($query->num_rows()>0)
   {
    $row=$query->result();
    print_r($row);
   //return $row->rel_sport_id;
   }


  }

  
  
  public function AllSport()
  { 
       //$rs= $this->db_query->FetchInformation(SPORT,"","1='1'");
      $sql="select s.sport_id,s.sport_name from sport s inner join
       competition c on c.rel_sport_id=s.sport_id inner join fixture f on f.rel_competition_id=c.competition_id 
       where f.gmt_date_time > CURDATE() group by s.sport_id";
      $query=$this->db->query($sql);
      
      $row=$query->result();
      if($query->num_rows()>0)
       {
         $i=0;
         foreach($query->result() as $row)
         {
          $sp[$i]['id']=$row->sport_id;
          $sp[$i]['sport_name']=$row->sport_name;
          $i++;
         }

       }

     
      
    return $sp;

  }
  public function FixtureSearchResult($from_date,$to_date,$search_text)
  { 
      //$rs= $this->db_query->FetchInformation(SPORT,"","1='1'");
    $sp=array();
  $where="where f.gmt_date_time > CURDATE()";
     
      if(!empty($from_date) && $from_date!='Date From'){
      $from_date = str_replace("/","-", $from_date);$from_date=date('Y-m-d h:i:s',strtotime($from_date));
       $where.=" and f.gmt_date_time >='$from_date'";
     }

       if(!empty($to_date) && $to_date!='Date End'){
        $to_date = str_replace("/","-", $to_date);$to_date= date('Y-m-d h:i:s',strtotime($to_date));
         $where.=" and f.gmt_date_time <='$to_date'";
       }
    
   

    
     
     if(!empty($search_text) && $search_text!='Search') $where.=" and (t1.team_name like '%$search_text%' or t2.team_name like '%$search_text%')";

      //$sql="select * from establishment_event $where order by date";
       $sql="select f.fixture_id,date_format(f.gmt_date_time,'%Y-%m-%d') as gmt_date_time ,
       t1.team_name as team1,t2.team_name as team2 from fixture f inner join team t1 on f.rel_team_id_1=t1.team_id
       inner join team t2 on f.rel_team_id_2=t2.team_id
        inner join competition c on f.rel_competition_id=c.competition_id $where ";

      $query=$this->db->query($sql);
      
      $row=$query->result();
      if($query->num_rows()>0)
       {
         $i=0;
         foreach($query->result() as $row)
         {
          $sp[$i]['id']=$row->fixture_id;
          $sp[$i]['gmt_date_time']=$row->gmt_date_time;
          $sp[$i]['team1']=$row->team1;
          $sp[$i]['team2']=$row->team2;

          $i++;
         }

       }


     
      
    return $sp;

  }
 
  public function AllFixture($user_ref,$sport_id,$from_date,$to_date,$search_text,$limit='')
  { 

    $sp=array();
    

    if(!empty($sport_id))
    {
      $sport_ids=str_replace("~","','",$sport_id);
     


     $cond="and aps.sport_id in ('".$sport_ids."')";
    }
    else $cond="";


    // for date search
    $where="";
     if(!empty($from_date) && $from_date!='Date From'){
      $from_date = str_replace("/","-", $from_date);$from_date=date('Y-m-d h:i:s',strtotime($from_date));
       $where.=" and f.gmt_date_time >='$from_date'";
     }

       if(!empty($to_date) && $to_date!='Date End'){
        $to_date = str_replace("/","-", $to_date);$to_date= date('Y-m-d h:i:s',strtotime($to_date));
         $where.=" and f.gmt_date_time <='$to_date'";
       }
    
   

    
     
     if(!empty($search_text) && $search_text!='Search') $where.=" and (t1.team_name like '%$search_text%' or t2.team_name like '%$search_text%')";

// end for date search 
     $sql="select f.fixture_id,aps.sport_id,date_format(f.gmt_date_time,'%d-%m-%Y') as gmt_date_time , time_format(f.timezone_time,'%H:%i' ) as local_time_form,
    t1.team_name as team1,t2.team_name as team2 from fixture f inner join team t1 on
     f.rel_team_id_1=t1.team_id inner join team t2 on f.rel_team_id_2=t2.team_id inner join 
     app_schedule aps on f.fixture_id=aps.fixture_ref where aps.user_ref='$user_ref' and f.gmt_date_time > CURDATE() 
     $cond  $where ORDER BY f.gmt_date_time $limit";
	 //echo $sql; die;	
      $query=$this->db->query($sql);
      
      $row=$query->result();
      if($query->num_rows()>0)
       {
         $i=0;
		 $current_timezone = $this->gettimezone();
         foreach($query->result() as $row)
         {
          $check=$this->ChechkFixtureSchedule($row->fixture_id);
		  $channels = '';
		  $channels = $this->GetFixtureChannel($row->fixture_id,$user_ref);
		  $channel_list = implode(' , ',$channels);
		  /*foreach($channels as $channel)
			{
				$new_arr[] = $channel->channel_name;
			}
		  $channel_list = implode(' , ',$new_arr);
		  */
          if(!empty($check)) $sp[$i]['fixture_check']='checked';
          else $sp[$i]['fixture_check']="";
          $sp[$i]['id']=$row->fixture_id;
          $sp[$i]['sport_id']=$row->sport_id;
          $sp[$i]['gmt_date_time']=$row->gmt_date_time;
		  
		  $CetTime = $this->ConvertOneTimezoneToAnotherTimezone($row->local_time_form,'Europe/London',$current_timezone);
		  
		  //$time = date('H:i', strtotime($row->local_time_form . ' + 1 hour'));
 	  	  $sp[$i]['local_time_form']=date("H:i", strtotime($CetTime));
          $sp[$i]['team1']=$row->team1;
          $sp[$i]['team2']=$row->team2;
		  $sp[$i]['sport_name'] = $this->getSportName($row->sport_id);
		  $sp[$i]['sport_icon'] = $this->getSportIcon($row->sport_id);
		  $sp[$i]['channel_name'] = $channel_list;
		  	
          $i++;
         }
       }
    return $sp;
  }
  
  public function TotalFixtureCount($user_ref,$sport_id,$from_date,$to_date,$search_text,$limit='')
  { 

    $sp=array();
    

    if(!empty($sport_id))
    {
      $sport_ids=str_replace("~","','",$sport_id);
     


     $cond="and aps.sport_id in ('".$sport_ids."')";
    }
    else $cond="";


    // for date search
    $where="";
     if(!empty($from_date) && $from_date!='Date From'){
      $from_date = str_replace("/","-", $from_date);$from_date=date('Y-m-d h:i:s',strtotime($from_date));
       $where.=" and f.gmt_date_time >='$from_date'";
     }

       if(!empty($to_date) && $to_date!='Date End'){
        $to_date = str_replace("/","-", $to_date);$to_date= date('Y-m-d h:i:s',strtotime($to_date));
         $where.=" and f.gmt_date_time <='$to_date'";
       }
     
     if(!empty($search_text) && $search_text!='Search') $where.=" and (t1.team_name like '%$search_text%' or t2.team_name like '%$search_text%')";

// end for date search 
     $sql="select f.fixture_id,aps.sport_id,date_format(f.gmt_date_time,'%d-%m-%Y') as gmt_date_time , time_format(f.local_time,'%H:%i' ) as local_time_form,
    t1.team_name as team1,t2.team_name as team2 from fixture f inner join team t1 on
     f.rel_team_id_1=t1.team_id inner join team t2 on f.rel_team_id_2=t2.team_id inner join 
     app_schedule aps on f.fixture_id=aps.fixture_ref where aps.user_ref='$user_ref' and f.gmt_date_time > CURDATE() 
     $cond  $where ORDER BY f.gmt_date_time $limit";
	 //echo $sql; die;	
      $query=$this->db->query($sql);
      
      $row=$query->result();
	  $sp = 0;
      if($query->num_rows()>0)
       {
		   $sp = $query->num_rows();
       }
    return $sp;
  }
  
  public function gettimezone() {
	  
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
		$timestamp = $date->format("d-m-Y H:i:s");
		return $timestamp;
}
  
  public function GetFixtureChannel($fixtureid,$user_ref)
  { 
  	$sql = "SELECT distinct(fl.rel_channel_id), c.channel_name from fixture_channel_list fl join channel as c on fl.rel_channel_id=c.channel_id where rel_fixture_id = '".$fixtureid."'";
	//echo $sql; die; 
	$query=$this->db->query($sql);
	$row = $query->result();
	//return $row;
	$result = array();
	$i = 0;
	  foreach($row as $channel)
		{
		//  $new_arr[] = $channel->rel_channel_id;
		$sql1 =  "SELECT pc.channel_name, pc.channel_name_dp FROM `app_provider_channel` as ac join `provider_channels` as pc on ac.`channel_id`=pc.`channel_id` WHERE pc.`channel_name`='".mysql_real_escape_string($channel->channel_name)."' and ac.`user_ref`='$user_ref'";
		
	 //echo $sql1; die;
	  $query1 = $this->db->query($sql1);
	   if($query1->num_rows()>0)
	   {
		   $row1 = $query1->result();
		   //echo "<pre>";
		   //print_r($row1); die;
		   //echo $row1[0]->channel_name_dp; die;
		   $result[$i] = $row1[0]->channel_name_dp;
		   $i++;
	   }
	   else{
		   $result[$i] = $channel->channel_name;
		   $i++;
	   }

	}
	//echo "<pre>";
	//print_r($result); die;
	return $result;
  }
  
      public function getSportName($sportid)
  {   
	$sql =  "select sport_name from sport where sport_id='$sportid'";
	$query=$this->db->query($sql);
    if($query->num_rows()>0)
    {
      $row=$query->result()[0];
      return $row->sport_name;
    }
  }

  public function ChechkFixtureSchedule($fixture_id)
  {
    $query=$this->db->select('id')->from('establishment_schedule')->where('fixture_ref', $fixture_id)->get();
    if($query->num_rows()>0)
    {
     $row=$query->result()[0];
    return $row->id;
   }


  }
    public function GetProfileInfo($id)
  {
   $query=$this->db->get_where('establishment_info', array('est_user_ref' => $id));
   if($query->num_rows()>0)
   {
    $sp=array();
    foreach($query->result() as $row)
    {
	  if(!empty($row->id)) $sp['id']=$row->id;
      if(!empty($row->title)) $sp['title']=$row->title;
      if(!empty($row->address)) $sp['address']=$row->address;
      if(!empty($row->short_description)) $sp['short_description']=$row->short_description;
    }
    return $sp;
   }
  }

  public function MakeFixtureSchedule($fixture_id,$user_ref)
   {
    $data=array();
    if(!empty($fixture_id))
    {
      $this->db->where('fixture_ref',$fixture_id);
      $this->db->where('user_ref',$user_ref);
      $this->db->delete('app_schedule');
    }
    
  }
   
 public function AllProvider()
 	 { 
		$sql="select * from provider order by provider_name";
		$query=$this->db->query($sql);
		$row=$query->result();
			if($query->num_rows()>0)
			{
			 $i=0;
			 $result = $query->result();
			 foreach($result as $row)
			 {
			  if($row->provider_id=='10') { $key = $i; continue;  }
			  $sp[$i]['id']=$row->provider_id;
			  $sp[$i]['provider_name']=$row->provider_name;
			  $i++;
			 }
			  $sp[$i]['id']=$result[$key]->provider_id;
			  $sp[$i]['provider_name']=$result[$key]->provider_name;
			}
	   return $sp;
  }
  
  public function DeletedTempChannel($userref) {

	 $this->db->where('user_ref', $userref);
	 $this->db->where('status', '0');
	 $this->db->delete('app_provider_channel'); 
  }
  
  public function SelectedProvider($estref) {
	 $sp = array(); 
	$sql = "SELECT DISTINCT(apc.provider_id), p.provider_name, count(`channel_id`) as channel_count, p.provider_id as prid FROM `app_provider_channel` as apc join `provider` as p ON apc.provider_id = p.provider_id where apc.user_ref = '".$estref."' and status='1' group by `provider_id` order by p.provider_id asc ";
	
	$query=$this->db->query($sql);
	$row=$query->result();
	
	if($query->num_rows()>0)
		{
		 $i=0;
		 foreach($query->result() as $row)
		 {
			  $sp[$i]['id']=$row->provider_id;
			  $sp[$i]['provider_name']=$row->provider_name;
			  $sp[$i]['channel_count']=$row->channel_count;
			  $i++;
		 }
	}
	   return $sp;
  }
  public function SelectedProviderIds($userref) {
	 $sp = array(); 
	$sql = "SELECT DISTINCT(apc.provider_id), p.provider_name, p.provider_id FROM `app_provider_channel` as apc join `provider` as p ON apc.provider_id = p.provider_id where apc.user_ref = '".$userref."' order by p.provider_id asc ";
	$query=$this->db->query($sql);
	$row=$query->result();
	
	if($query->num_rows()>0)
		{
		 $i=0;
		 foreach($query->result() as $row)
		 {
			  $sp[]=$row->provider_id;
			  $i++;
		 }
	}
	   return $sp;
  }
  public function ProviderChannel($providerid = array()){
	  
	 $sp = array();
	 if(count($providerid)>0) {
	 	$id = implode(',', $providerid);
	 	 
	 $sql="SELECT *  FROM `provider_channels` WHERE `provider_id` IN ($id) order by channel_name_dp";
		$query=$this->db->query($sql);
		$row=$query->result();
		
			if($query->num_rows()>0)
			{
			 $i=0;
			 foreach($query->result() as $row)
			 {
			  $sp[$i]['id']=$row->channel_id;
			  $sp[$i]['channel_name']=$row->channel_name;
			  $sp[$i]['channel_name_dp']=$row->channel_name_dp;
			  $sp[$i]['provider_id']=$row->provider_id;
			  $i++;
			 }
			}
	   return $sp;
	 }
	 else {
		  return $sp;

		 }
	}
  public function ProviderChannelSingle($user_ref, $providerid, $provider, $limit='', $text){
	 
	 $sp = array();$prochaarray = array();
	 //echo $providerid; die;
	 if($providerid != '10') {
		 $sql="SELECT *  FROM `provider_channels` WHERE `provider_id` = '$providerid' order by channel_name_dp $limit";
			$query=$this->db->query($sql);
			$row=$query->result();
			
				if($query->num_rows()>0)
				{
				 $i=0;$j=0;
				 foreach($query->result() as $row)
				 {
					 $sp[$i]['id']=$row->channel_id;
					 $sp[$i]['channel_name']=$row->channel_name;
					 $sp[$i]['channel_name_dp']=$row->channel_name_dp;
				     $sp[$i]['provider_id']=$row->provider_id;
					  
					 $sql1 = "SELECT * FROM `app_provider_channel` WHERE `provider_id` = '$providerid' and user_ref= '$user_ref' and channel_id = '$row->channel_id'";
					 $query=$this->db->query($sql1);
					 if($query->num_rows()==0) {
						$prochaarray[] = array('user_ref'=> $user_ref, 'provider_id'=> $row->provider_id, 'channel_id'=> $row->channel_id);
					 	//$this->db->insert('app_provider_channel',$prochaarray);
						$j++;	
					 }
					 $i++;
				 }
				 $sql2 = "SELECT * FROM `app_provider_channel` WHERE `provider_id` = '$providerid' and user_ref= '$user_ref'";
				  //echo $sql2; die;
				  $query2 = $this->db->query($sql2);
					if($query2->num_rows()==0) { 
						//echo "<pre>";
						//print_r($prochaarray); die;
					 	$this->db->insert_batch('app_provider_channel',$prochaarray);
					}
			}
	  }
	 else {
		 $where = '';
		 
		 if($text!='') { $where.= "and ch.channel_name like '%$text%' "; };
		 
		 //$sql="select ch.channel_id,ch.channel_name from channel ch inner join provider_channels pc on pc.channel_name!=ch.channel_name inner join fixture_channel_list fcl on fcl.rel_channel_id=ch.channel_id inner join fixture f on f.fixture_id = fcl.rel_fixture_id where f.gmt_date_time >= NOW() $where group by fcl.rel_channel_id order by ch.channel_name $limit";
		 
		$sql = "select ch.channel_id,ch.channel_name from channel ch where exists (select 1 from fixture_channel_list where rel_channel_id = ch.channel_id) $where order by ch.channel_name $limit";
		//echo $sql;
		$query=$this->db->query($sql);
		$row=$query->result();
		//echo $query->num_rows();
		if($query->num_rows()>0)
		{
			 $i=0;
			 foreach($query->result() as $row)
			 {
			    /*$sql1 = "SELECT * FROM provider_channels WHERE channel_name = '".mysql_real_escape_string($row->channel_name)."' ";
			   $query1 = $this->db->query($sql1);
				$row1 = $query1->result();*/
				//echo "<pre>";
				//print_r($row1); 
				//if($query1->num_rows()==0) { 
			   		$sp[$i]['id']=$row->channel_id;
				  	$sp[$i]['channel_name']=$row->channel_name;
				 	$sp[$i]['channel_name_dp']=$row->channel_name;
				  	$sp[$i]['provider_id']=$providerid;
			   		$i++;
					continue;
				//}
			 }
		}
		//echo "<pre>";
		//print_r($sp); die;
	}
	return $sp;
 }
  public function ProviderChannelPagenation($user_ref, $providerid, $provider, $limit='', $text){
	 
	 $sp = array();
	 //echo $providerid; die;
	 if($providerid != '10') {
		 $sql="SELECT *  FROM `provider_channels` WHERE `provider_id` = '$providerid' order by channel_name_dp $limit";
			$query=$this->db->query($sql);
			$row=$query->result();
			
				if($query->num_rows()>0)
				{
				 $i=0;
				 foreach($query->result() as $row)
				 {
					 $prochaarray = array();
					 
					 $sp[$i]['id']=$row->channel_id;
					 $sp[$i]['channel_name']=$row->channel_name;
					 $sp[$i]['channel_name_dp']=$row->channel_name_dp;
				     $sp[$i]['provider_id']=$row->provider_id;
					  
					 $prochaarray['user_ref']= $user_ref;
					 $prochaarray['provider_id']=$row->provider_id;
					 $prochaarray['channel_id']=$row->channel_id;
					 
					 $sql1 = "SELECT * FROM `app_provider_channel` WHERE `provider_id` = '$providerid' and user_ref= '$user_ref' and channel_id = '$row->channel_id'";
					 $query=$this->db->query($sql1);
					 if($query->num_rows()==0) {
					 	//$this->db->insert('establishment_provider_channel',$prochaarray);
					 }
					 
					 $i++;
				 }
			}
	  }
	 else {
		$where = '';
		 
		if($text!='') { $where.= "and ch.channel_name like '%$text%' "; };
		 
		 //$sql="select ch.channel_id,ch.channel_name from channel ch inner join provider_channels pc on pc.channel_name!=ch.channel_name inner join fixture_channel_list fcl on fcl.rel_channel_id=ch.channel_id inner join fixture f on f.fixture_id = fcl.rel_fixture_id where f.gmt_date_time >= NOW() $where group by fcl.rel_channel_id order by ch.channel_name $limit";
		 
		$sql = "select ch.channel_id,ch.channel_name from channel ch where exists (select 1 from fixture_channel_list where rel_channel_id = ch.channel_id) $where order by ch.channel_name $limit";
		//echo $sql; 
		$query=$this->db->query($sql);
		$row=$query->result();
		//echo $query->num_rows();
		if($query->num_rows()>0)
		{
			 $i=0;
			 foreach($query->result() as $row)
			 {
			   /*$sql1 = "SELECT * FROM provider_channels WHERE channel_name = '".mysql_real_escape_string($row->channel_name)."' ";
			   $query1 = $this->db->query($sql1);
				$row1 = $query1->result();*/
				//echo "<pre>";
				//print_r($row1); 
				//if($query1->num_rows()==0) { 
			   		$sp[$i]['id']=$row->channel_id;
				  	$sp[$i]['channel_name']=$row->channel_name;
				 	$sp[$i]['channel_name_dp']=$row->channel_name;
				  	$sp[$i]['provider_id']=$providerid;
			   		$i++;
					continue;
				//}
			 }
		}
		//echo "<pre>";
		//print_r($sp); die;
	}
	return $sp;
 }
 
	public function SelectedChannels($userref) {
	  
	$sql = "SELECT apc.user_ref, apc.channel_id, apc.provider_id, pc.channel_name, pc.channel_name_dp FROM `app_provider_channel` as apc join `provider_channels` as pc ON apc.channel_id = pc.channel_id where apc.user_ref = '".$userref."' order by pc.channel_name asc ";	
	//echo $sql; die; 
	$query = $this->db->query($sql);
	$row = $query->result();
	$i=0;
	if($query->num_rows()>0) {
	foreach($row as $val) {
		
			$sp[$i]['id']=$val->channel_id;
			$sp[$i]['channel_name']=$val->channel_name;
			$sp[$i]['channel_name_dp']=$val->channel_name_dp;
			$sp[$i]['provider_id']=$val->provider_id;
			$i++;	
	 }
	return $sp;
	}
	else {
		$sp = array();
		 return $sp;
	}
	
  }
  
	public function SelectedChannelsIds($userref, $providerid='') {
	  
	//$sql = "SELECT epc.est_ref, epc.channel_id, epc.provider_id, pc.channel_name FROM `establishment_provider_channel` as epc join `provider_channels` as pc ON epc.channel_id = pc.channel_id where epc.est_ref = '".$estref."' and epc.provider_id='".$providerid."' and status = '1' order by pc.channel_name asc ";	
	$sql = "SELECT user_ref, channel_id, provider_id FROM `app_provider_channel` where user_ref = '".$userref."' and provider_id='".$providerid."' order by channel_id asc ";	
	 
	$query = $this->db->query($sql);
	$row = $query->result();
	$i=0;
	if($query->num_rows()>0) {
	foreach($row as $val) {
		
			$sp[]=$val->channel_id;
			$i++;	
	 }
	return $sp;
	}
	else {
		$sp = array();
		 return $sp;
	}
	
  }

	public function SaveProviderChannel($providerid, $channelid, $check, $type, $user_ref){ 
		$i = 0;
		if($type == 'single') {
			if($check == 'true') { 
				  $prochaarray['user_ref'] = $user_ref;
				  $prochaarray['provider_id'] = $providerid;
				  $prochaarray['channel_id'] = $channelid;
				  
				  $this->db->insert('app_provider_channel',$prochaarray); 
				  $i++;
			}
			else { 
				$this->db->where('user_ref', $user_ref);
				$this->db->where('provider_id', $providerid);
				$this->db->where('channel_id', $channelid);
				$this->db->delete('app_provider_channel');
			}
		}
		else {
			if($check == 'true') {
				 
			   $sql="SELECT *  FROM `provider_channels` WHERE `provider_id` = $providerid";
				$query=$this->db->query($sql);
				$row=$query->result();
				
				if($query->num_rows()>0)
				{
					 foreach($query->result() as $row)
					 {
						  $prochaarray = array();
						  $prochaarray['user_ref'] = $user_ref;
						  $prochaarray['provider_id'] = $providerid;
						  $prochaarray['channel_id'] = $row->channel_id;
						  
						   $sql1 = "SELECT * FROM `app_provider_channel` WHERE `provider_id` = '$providerid' and user_ref= '$user_ref' and channel_id = '$row->channel_id'";
					 $query=$this->db->query($sql1);
						 if($query->num_rows()==0) {
							  
							  $this->db->insert('app_provider_channel',$prochaarray);
						 }
					  $i++; 
					 }
				}
			}
			else { 
				$this->db->where('user_ref', $user_ref);
				$this->db->where('provider_id', $providerid);
				$this->db->delete('app_provider_channel');
			}
		}
		return $i;
	}
	
	public function SaveFinalChannel($user_ref){ 
			print_r($data_ar);
			$data_ar['status'] = '1';
			$this->db->where('user_ref', $user_ref);
    		$this->db->update('app_provider_channel', $data_ar);
	}
	public function getSportIcon($sportid)
	  {   
		$sql =  "select icon from sports_icon where sport_id='$sportid'";
		$query=$this->db->query($sql);
		if($query->num_rows()>0)
		{
		  $row=$query->result()[0];
		  return $row->icon;
		}
	  }


}
?>