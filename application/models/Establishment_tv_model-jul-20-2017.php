<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 class Establishment_tv_model extends CI_Model
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
 
  public function AllFixture($est_ref_id,$sport_id,$from_date,$to_date,$search_text,$limit='')
  { 

    $sp=array();
    
    if(!empty($sport_id))
    {
      $sport_ids=str_replace("~","','",$sport_id);

     $cond="and es.sport_id in ('".$sport_ids."')";
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
     $sql="select f.fixture_id,es.sport_id,date_format(f.gmt_date_time,'%d-%m-%Y') as gmt_date_time , f.gmt_date_time as local_time_form,
    t1.team_name as team1,t2.team_name as team2 from fixture f inner join team t1 on
     f.rel_team_id_1=t1.team_id inner join team t2 on f.rel_team_id_2=t2.team_id inner join 
     establishment_schedule es on f.fixture_id=es.fixture_ref where es.establishment_ref='$est_ref_id' and f.gmt_date_time > CURDATE() 
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
		  $channels = $this->GetFixtureChannel($row->fixture_id,$est_ref_id);
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
          
		  //$current_timezone = date_default_timezone_get(); 
		  //$current_timezone = 'Europe/Berlin';
		  $CetTime = $this->ConvertOneTimezoneToAnotherTimezone($row->local_time_form, 'Africa/Accra', $current_timezone);
		  if($current_timezone == 'Atlantic/Canary' ) {
			$CetTime = date("d-m-Y H:i:s", strtotime('-1 hour', strtotime($CetTime)));
		  }
		  //$time = date('H:i', strtotime($row->local_time_form . ' + 2 hour'));
		  $sp[$i]['gmt_date_time']=date("d-m-Y", strtotime($CetTime));
 	  	  $sp[$i]['local_time_form'] = date("H:i", strtotime($CetTime));
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
  
  public function TotalFixtureCount($est_ref_id,$sport_id,$from_date,$to_date,$search_text,$limit='')
  { 

    $sp=array();
    
    if(!empty($sport_id))
    {
      $sport_ids=str_replace("~","','",$sport_id);

     $cond="and es.sport_id in ('".$sport_ids."')";
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
     $sql="select f.fixture_id,es.sport_id,date_format(f.gmt_date_time,'%d-%m-%Y') as gmt_date_time , time_format(f.local_time,'%H:%i' ) as local_time_form,
    t1.team_name as team1,t2.team_name as team2 from fixture f inner join team t1 on
     f.rel_team_id_1=t1.team_id inner join team t2 on f.rel_team_id_2=t2.team_id inner join 
     establishment_schedule es on f.fixture_id=es.fixture_ref where es.establishment_ref='$est_ref_id' and f.gmt_date_time > CURDATE() 
     $cond  $where ORDER BY f.gmt_date_time $limit";
	//echo $sql; die;	
      $query=$this->db->query($sql);
      $total_record = 0;
      $row=$query->result();
      if($query->num_rows()>0)
       {
		   $total_record = $query->num_rows();
       }
    return $total_record;
  }
  
 public function gettimezone() {
	  
		//$ip = '212.98.109.0';
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
		$local = date("Y-m-d H:i:s");
	 
		date_default_timezone_set("CET");
		$gmt = date("Y-m-d H:i:s A");
	 
		$require_timezone = $timezoneRequired;
		date_default_timezone_set($require_timezone);
		$required = date("Y-m-d H:i:s");
	 
		date_default_timezone_set($system_timezone);
	
		$diff1 = (strtotime($gmt) - strtotime($local));
		$diff2 = (strtotime($required) - strtotime($gmt));
	
		$date = new DateTime($time);
		$date->modify("+$diff1 seconds");
		$date->modify("+$diff2 seconds");
		$timestamp = $date->format("d-m-Y H:i:s");
		return $timestamp;
}
 
  public function GetFixtureChannel($fixtureid,$est_ref)
  { 
  	$sql = "SELECT distinct(fl.rel_channel_id), c.channel_name from fixture_channel_list fl join channel as c on fl.rel_channel_id=c.channel_id where rel_fixture_id = '".$fixtureid."'";
	//echo $sql; 
	$query=$this->db->query($sql);
	$row = $query->result();
	//return $row;
	$result = array();
	$i = 0;
	  foreach($row as $channel)
		{
		//  $new_arr[] = $channel->rel_channel_id;
		$sql1 =  "SELECT pc.channel_name, pc.channel_name_dp FROM `establishment_provider_channel` as ec join `provider_channels` as pc on ec.`channel_id`=pc.`channel_id` WHERE pc.`channel_name`='".mysql_real_escape_string($channel->channel_name)."' and ec.`est_ref`='$est_ref' UNION SELECT c.channel_name, c.channel_name as channel_name_dp FROM `establishment_provider_channel` as epc join `channel` as c on epc.`channel_id`=c.`channel_id` WHERE c.`channel_name`='".mysql_real_escape_string($channel->channel_name)."' and epc.`est_ref`='$est_ref'";
		
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
	  
	}
	//die;
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

  public function MakeFixtureSchedule($fixture_id,$establishment_ref)
   {
    $data=array();
    if(!empty($fixture_id))
    {
      $this->db->where('fixture_ref',$fixture_id);
      $this->db->where('establishment_ref',$establishment_ref);
      $this->db->delete('establishment_schedule');
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
  
  public function DeletedTempChannel($estref) {

	 $this->db->where('est_ref', $estref);
	 $this->db->where('status', '0');
	 $this->db->delete('establishment_provider_channel'); 
  }
  
  public function SelectedProvider($estref) {
	 $sp = array(); 
	$sql = "SELECT DISTINCT(epc.provider_id), p.provider_name, count(`channel_id`) as channel_count, p.provider_id as prid FROM `establishment_provider_channel` as epc join `provider` as p ON epc.provider_id = p.provider_id where epc.est_ref = '".$estref."' and status='1' group by `provider_id` order by p.provider_id asc ";
	
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
  public function SelectedProviderIds($estref) {
	 $sp = array(); 
	$sql = "SELECT DISTINCT(epc.provider_id), p.provider_name, p.provider_id as prid FROM `establishment_provider_channel` as epc join `provider` as p ON epc.provider_id = p.provider_id where epc.est_ref = '".$estref."' order by p.provider_id asc ";
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
  public function ProviderChannelSingle($est_ref, $providerid, $provider, $limit='', $text){
	 
	 $sp = array();$prochaarray = array();
	 //echo $providerid; die;
	 if($providerid != '10') {
		 $sql="SELECT *  FROM `provider_channels` WHERE `provider_id` = '$providerid' order by channel_name_dp $limit";
			$query=$this->db->query($sql);
			$row=$query->result();
			
				if($query->num_rows()>0)
				{
				 $i=0;$j =0;
				 foreach($query->result() as $row)
				 {
					 $sp[$i]['id']=$row->channel_id;
					 $sp[$i]['channel_name']=$row->channel_name;
					 $sp[$i]['channel_name_dp']=$row->channel_name_dp;
				     $sp[$i]['provider_id']=$row->provider_id;
					 
					 $sql1 = "SELECT * FROM `establishment_provider_channel` WHERE `provider_id` = '$providerid' and est_ref= '$est_ref' and channel_id = '$row->channel_id'";
					 $query=$this->db->query($sql1);
					 if($query->num_rows()==0) {
						 
						$prochaarray[] = array('est_ref'=> $est_ref, 'provider_id'=> $row->provider_id, 'channel_id'=> $row->channel_id);
						 
/*						$prochaarray[$j]['est_ref']= $est_ref;
					 	$prochaarray[$j]['provider_id']=$row->provider_id;
					 	$prochaarray[$j]['channel_id']=$row->channel_id;
*/					 	$j++;	
					 	//$this->db->insert('establishment_provider_channel',$prochaarray);
					 }
					 
					 $i++;
				 }
				  $sql2 = "SELECT * FROM `establishment_provider_channel` WHERE `provider_id` = '$providerid' and est_ref= '$est_ref'";
				  //echo $sql2; die;
				  $query2 = $this->db->query($sql2);
					if($query2->num_rows()==0) { 
						//echo "<pre>";
						//print_r($prochaarray); die;
					 	$this->db->insert_batch('establishment_provider_channel',$prochaarray);
					}
			}
	  }
	 else {
		 $where = '';
		 
		 if($text!='') { $where.= "and ch.channel_name like '%$text%' "; };
		 
		 //$sql="select ch.channel_id,ch.channel_name from channel ch inner join provider_channels pc on pc.channel_name!=ch.channel_name inner join fixture_channel_list fcl on fcl.rel_channel_id=ch.channel_id inner join fixture f on f.fixture_id = fcl.rel_fixture_id where f.gmt_date_time >= NOW() $where group by fcl.rel_channel_id order by ch.channel_name $limit";
		 
		 $sql = "select ch.channel_id,ch.channel_name from channel ch inner join fixture_channel_list fcl on fcl.rel_channel_id=ch.channel_id inner join fixture f on f.fixture_id = fcl.rel_fixture_id where f.gmt_date_time >= NOW() $where group by fcl.rel_channel_id order by ch.channel_name $limit";
		//echo $sql; 
		$query=$this->db->query($sql);
		$row=$query->result();
		//echo $query->num_rows();
		if($query->num_rows()>0)
		{
			 $i=0;
			 foreach($query->result() as $row)
			 {
			   $sql1 = "SELECT * FROM provider_channels WHERE channel_name = '".mysql_real_escape_string($row->channel_name)."' ";
			   $query1 = $this->db->query($sql1);
				$row1 = $query1->result();
				//echo "<pre>";
				//print_r($row1); 
				if($query1->num_rows()==0) { 
			   		$sp[$i]['id']=$row->channel_id;
				  	$sp[$i]['channel_name']=$row->channel_name;
				 	$sp[$i]['channel_name_dp']=$row->channel_name;
				  	$sp[$i]['provider_id']=$providerid;
			   		$i++;
					continue;
				}
			 }
		}
		//echo "<pre>";
		//print_r($sp); die;
	}
	return $sp;
 }
 
 public function ProviderChannelCount($est_ref, $providerid, $provider, $limit='', $text){
	 
	 $sp = array();$prochaarray = array();
	 //echo $providerid; die;
	 $toatl_count = 0;
	 if($providerid != '10') {
		 $sql="SELECT *  FROM `provider_channels` WHERE `provider_id` = '$providerid' order by channel_name_dp $limit";
			$query=$this->db->query($sql);
			$row=$query->result();
				if($query->num_rows()>0)
				{
					$toatl_count = $query->num_rows();
				}
	  }
	 else {
		 $where = '';
		 
		 if($text!='') { $where.= "and ch.channel_name like '%$text%' "; };
		 
		 //$sql="select ch.channel_id,ch.channel_name from channel ch inner join provider_channels pc on pc.channel_name!=ch.channel_name inner join fixture_channel_list fcl on fcl.rel_channel_id=ch.channel_id inner join fixture f on f.fixture_id = fcl.rel_fixture_id where f.gmt_date_time >= NOW() $where group by fcl.rel_channel_id order by ch.channel_name $limit";
		 
		 $sql = "select ch.channel_id,ch.channel_name from channel ch inner join fixture_channel_list fcl on fcl.rel_channel_id=ch.channel_id inner join fixture f on f.fixture_id = fcl.rel_fixture_id where f.gmt_date_time >= NOW() $where group by fcl.rel_channel_id order by ch.channel_name $limit";
		//echo $sql; 
		
		$query=$this->db->query($sql);
		$row=$query->result();
		//echo $query->num_rows();
		$toatl_count = 0;
		if($query->num_rows()>0)
		{
			$toatl_count = $query->num_rows();
		}
		//echo "<pre>";
		//print_r($sp); die;
	}
	return $toatl_count;
 }
 
 public function ProviderChannelPagenation($est_ref, $providerid, $provider, $limit='', $text){
	 
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
					  
					 $prochaarray['est_ref']= $est_ref;
					 $prochaarray['provider_id']=$row->provider_id;
					 $prochaarray['channel_id']=$row->channel_id;
					 
					 $sql1 = "SELECT * FROM `establishment_provider_channel` WHERE `provider_id` = '$providerid' and est_ref= '$est_ref' and channel_id = '$row->channel_id'";
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
		 
		 $sql = "select ch.channel_id,ch.channel_name from channel ch inner join fixture_channel_list fcl on fcl.rel_channel_id=ch.channel_id inner join fixture f on f.fixture_id = fcl.rel_fixture_id where f.gmt_date_time >= NOW() $where group by fcl.rel_channel_id order by ch.channel_name $limit";
		//echo $sql; 
		$query=$this->db->query($sql);
		$row=$query->result();
		//echo $query->num_rows();
		if($query->num_rows()>0)
		{
			 $i=0;
			 foreach($query->result() as $row)
			 {
			   $sql1 = "SELECT * FROM provider_channels WHERE channel_name = '".mysql_real_escape_string($row->channel_name)."' ";
			   $query1 = $this->db->query($sql1);
				$row1 = $query1->result();
				//echo "<pre>";
				//print_r($row1); 
				if($query1->num_rows()==0) { 
			   		$sp[$i]['id']=$row->channel_id;
				  	$sp[$i]['channel_name']=$row->channel_name;
				 	$sp[$i]['channel_name_dp']=$row->channel_name;
				  	$sp[$i]['provider_id']=$providerid;
			   		$i++;
					continue;
				}
			 }
		}
		//echo "<pre>";
		//print_r($sp); die;
	}
	return $sp;
 }
 
	public function SelectedChannels($estref) {
	  
	$sql = "SELECT epc.est_ref, epc.channel_id, epc.provider_id, pc.channel_name, pc.channel_name_dp FROM `establishment_provider_channel` as epc join `provider_channels` as pc ON epc.channel_id = pc.channel_id where epc.est_ref = '".$estref."' order by pc.channel_name asc ";	
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
  
	public function SelectedChannelsIds($estref, $providerid='') {
	  
	//$sql = "SELECT epc.est_ref, epc.channel_id, epc.provider_id, pc.channel_name FROM `establishment_provider_channel` as epc join `provider_channels` as pc ON epc.channel_id = pc.channel_id where epc.est_ref = '".$estref."' and epc.provider_id='".$providerid."' and status = '1' order by pc.channel_name asc ";	
	$sql = "SELECT est_ref, channel_id, provider_id FROM `establishment_provider_channel` where est_ref = '".$estref."' and provider_id='".$providerid."' order by channel_id asc ";	
	 
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

	public function SaveProviderChannel($providerid, $channelid, $check, $type, $est_ref){ 
		$i = 0;
		if($type == 'single') {
			if($check == 'true') { 
				  $prochaarray['est_ref'] = $est_ref;
				  $prochaarray['provider_id'] = $providerid;
				  $prochaarray['channel_id'] = $channelid;
				  
				  $this->db->insert('establishment_provider_channel',$prochaarray); 
				  $i++;
			}
			else { 
				$this->db->where('est_ref', $est_ref);
				$this->db->where('provider_id', $providerid);
				$this->db->where('channel_id', $channelid);
				$this->db->delete('establishment_provider_channel');
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
						  $prochaarray['est_ref'] = $est_ref;
						  $prochaarray['provider_id'] = $providerid;
						  $prochaarray['channel_id'] = $row->channel_id;
						  
						   $sql1 = "SELECT * FROM `establishment_provider_channel` WHERE `provider_id` = '$providerid' and est_ref= '$est_ref' and channel_id = '$row->channel_id'";
					 $query=$this->db->query($sql1);
						 if($query->num_rows()==0) {
							  
							  $this->db->insert('establishment_provider_channel',$prochaarray);
						 }
					  $i++; 
					 }
				}
			}
			else { 
				$this->db->where('est_ref', $est_ref);
				$this->db->where('provider_id', $providerid);
				$this->db->delete('establishment_provider_channel');
			}
		}
		return $i;
	}
	
	public function SaveFinalChannel($est_ref){ 
		
			$this->AddEstablishmentSchedule($est_ref); // Add to establishment schedule						

			$data_ar['status'] = '1';
			$this->db->where('est_ref', $est_ref);
    		$this->db->update('establishment_provider_channel', $data_ar);
			
			$providecount  =  $this->CheckProviderList($est_ref);
			if($providecount >= 1){
				$this->session->set_userdata('schedule_step1',1);
			}
			else{
				$this->session->set_userdata('schedule_step1',0);
			}
			
			$channelcount  =  $this->CheckProviderChannel($est_ref);
			if($channelcount >= 1){
				$this->session->set_userdata('schedule_step2',1);
			}
			else{
				$this->session->set_userdata('schedule_step2',0);
			}
			if(($providecount >= 1) && ($channelcount >= 1)){
				$this->session->set_userdata('schedule_step3',1);
			}else{-
				$this->session->set_userdata('schedule_step3',0);
			}

	}
	
	public function AddEstablishmentSchedule( $est_ref){  
		$this->load->model('Establishment_model');
		//echo $channelid; 
		$channel_id = '';
		$sql1 = "SELECT pc.channel_name FROM `establishment_provider_channel` as ep JOIN `provider_channels` as pc ON ep.channel_id = pc.channel_id WHERE ep.est_ref= '$est_ref' and ep.status='0'";
		
		//$sql1 = "SELECT channel_name FROM `establishment_provider_channel` WHERE est_ref= '$est_ref' and status='0' ";
		//echo $sql1; die;
		$query1 = $this->db->query($sql1);
		if($query1->num_rows()>0) { 
			$channels = $query1->result();
			foreach($channels as $channel) {
				$sql2 = "SELECT channel_id FROM `channel` WHERE channel_name= '$channel->channel_name'";
				$query2 = $this->db->query($sql2);
				if($query2->num_rows()>0) { 
					$channelArray = $query2->result();
					$channelids[] = $channelArray[0]->channel_id;
				}
			}
			
			$channel_id = implode(',', $channelids); 
		}
		//echo $channel_id; die;	
		if($channel_id!='') {			 
			$fixture_ids = $this->GetFixtureIds($channel_id); 
			//print_r($fixture_ids); die;
			if(count($fixture_ids)>0) {
				//$fixtureid = $fixture_ids[0]; 
				$fixture_id = implode(',', $fixture_ids);
				$sql="select f.fixture_id,c.rel_sport_id, f.rel_competition_id, t1.team_name as team1,t2.team_name as team2 
					  from fixture f inner join team t1 on f.rel_team_id_1=t1.team_id inner join team t2 
					  on f.rel_team_id_2=t2.team_id inner join competition c on f.rel_competition_id=c.competition_id 
					  where f.gmt_date_time >= NOW() and f.fixture_id in (".$fixture_id.")";
				
				$query=$this->db->query($sql);
				
				if($query->num_rows()>0)
				{
					$rows = $query->result();
					foreach($rows as $row) {
						$fixtureid = $row->fixture_id;
						$fixturesportsid = $row->rel_sport_id;
						$fixture_rel_id = $row->rel_competition_id;
						
						$check = $this->Establishment_model->ChechkFixtureScheduleExists($est_ref,$fixtureid);
						//echo $check;
						if(empty($check)) {
							$action = "add";
							$this->MakeEstablishmentSchedule($fixtureid, $est_ref, $fixturesportsid, $fixture_rel_id, $action);
						}
					}
				}
			}
		}
	}
	
	public function MakeEstablishmentSchedule($fixture_id,$establishment_ref,$sport_id,$fixture_rel_id, $action='add')
	  {
		
		$data=array(); 
		if($action == 'remove') {
		$check=$this->ChechkFixtureScheduleExists($establishment_ref,$fixture_id);
			if(!empty($check))
			{
				$sql_del="delete from establishment_schedule where fixture_ref='$fixture_id' and establishment_ref='$establishment_ref'";
				$query=$this->db->query($sql_del);
			}
		}
		else
		{
		  $data['fixture_ref']=$fixture_id;
		  $data['establishment_ref']=$establishment_ref;
		  $data['sport_id']=$sport_id;
		  $data['competition_ref']=$fixture_rel_id;
	
		  //print_r($data);
		  $this->db->insert('establishment_schedule', $data) or die(mysql_error());
		}
	  }
	  
	public function GetFixtureIds($channel_ids)
	  {
	   
	   $sql="select rel_fixture_id from fixture_channel_list where rel_channel_id in (".$channel_ids.") ";
	   //echo $sql; die; 
	   $query=$this->db->query($sql);
	   if($query->num_rows()>0)
	   {
		$i=0;
		foreach($query->result() as $row)
		{
		 $ch[$i]=$row->rel_fixture_id;
		 $i++;
		}
	   return $ch;
	   }
	  }	
	public function CheckProviderList($est_ref_id){
		$query_happy=$this->db->query("select * from establishment_provider_channel WHERE est_ref = '".$est_ref_id."'");
		return $query_happy->num_rows();
	}
	public function CheckProviderChannel($est_ref_id){
		$query_happy=$this->db->query("select * from establishment_provider_channel WHERE est_ref = '".$est_ref_id."' AND status='1'");
		return $query_happy->num_rows();
	}

}
?>