<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 class Promotion_model extends CI_Model
 {
  
  function __construct()
  {
   parent ::__construct();  
  } 


  public function SignupFormAttribute($values=array())
  {
     if(count($values) == 0)
     {
      $values=array('name'=>'Establishment name','address'=>'Address of the Establishment','email'=>'Your e-mail','password'=>'Password');
     }
     $attribute['form']=array('id'=>'signup_frm','name'=>'signup_frm');
     $attribute['name']=array('name'=> 'name','id'=> 'name','value' => trim($values['name']),'class'=>"home-input",'onfocus'=>"if (this.value == 'Establishment name') {this.value = '';}" ,'onblur'=>"if (this.value == '') {this.value = 'Establishment name';}" );
   
     $attribute['email']=array('name'=> 'email','id'=> 'email','value' => trim($values['email']),'class'=>"mail-input" , 'onfocus'=>"if (this.value == 'Your e-mail') {this.value = '';}" ,'onblur'=>"if (this.value == '') {this.value = 'Your e-mail';}");

     $attribute['address']=array('name'=> 'address','id'=> 'address','value' => trim($values['address']),'class'=>"address" , 'onfocus'=>"if (this.value == 'Address of the Establishment') {this.value = '';}" ,'onblur'=>"if (this.value == '') {this.value = 'Address of the Establishment';}");
     $attribute['password']=array('name'=> 'password','id'=> 'password','value' => trim($values['password']),'class'=>"password-input" , 'onfocus'=>"if (this.value == 'Password') {this.value = '';}" ,'onblur'=>"if (this.value == '') {this.value = 'Password';}");
     
     $attribute['submit']=array('type' => 'submit',  'name' => 'form_submit','class'=>'signup-button','value'=>'signup');
     return $attribute;
  }
  
  public function RecBarFormAttribute($values=array())
  {
     if(count($values) == 0)
     {
      $values=array('barname'=>'Bar name','baraddress'=>'Bar address','baremail'=>'Bar e-mail','barphone'=>'Bar phone', 'useremail' => 'Your e-mail', 'userphone' => 'Your phone');
     }
     $attribute['form']=array('id'=>'recommendbar_frm','name'=>'recommendbar_frm');
	 
     $attribute['barname']=array('name'=> 'barname','id'=> 'barname','value' => trim($values['barname']),'class'=>"title-input",'onfocus'=>"if (this.value == 'Bar name') {this.value = '';}" ,'onblur'=>"if (this.value == '') {this.value = 'Bar name';}" );
	 
	 $attribute['baraddress']=array('name'=> 'baraddress','id'=> 'baraddress','value' => trim($values['baraddress']),'class'=>"title-input",'onfocus'=>"if (this.value == 'Bar address') {this.value = '';}" ,'onblur'=>"if (this.value == '') {this.value = 'Bar address';}" );
     
	 $attribute['baremail']=array('name'=> 'baremail','id'=> 'baremail','value' => trim($values['baremail']),'class'=>"title-input",'onfocus'=>"if (this.value == 'Bar e-mail') {this.value = '';}" ,'onblur'=>"if (this.value == '') {this.value = 'Bar e-mail';}" );
     
	 
	 $attribute['barphone']=array('name'=> 'barphone','id'=> 'barphone','value' => trim($values['barphone']),'class'=>"title-input",'onfocus'=>"if (this.value == 'Bar phone') {this.value = '';}" ,'onblur'=>"if (this.value == '') {this.value = 'Bar phone';}" );
     
	 
	 $attribute['useremail']=array('name'=> 'useremail','id'=> 'useremail','value' => trim($values['useremail']),'class'=>"title-input",'onfocus'=>"if (this.value == 'Your e-mail') {this.value = '';}" ,'onblur'=>"if (this.value == '') {this.value = 'Your e-mail';}" );
	 
	 $attribute['userphone']=array('name'=> 'userphone','id'=> 'userphone','value' => trim($values['userphone']),'class'=>"title-input",'onfocus'=>"if (this.value == 'Your phone') {this.value = '';}" ,'onblur'=>"if (this.value == '') {this.value = 'Your phone';}" );
     
     $attribute['submit']=array('type' => 'submit',  'name' => 'form_submit','class'=>'signup-button','value'=>'submit');
     return $attribute;
  }	

  public function isExist($email) {

    $query=$this->db->get_where('establishment_subscription_free', array('email' => $email));
      
    if($query->num_rows()==0)
    {
        return FALSE;
    }

    return TRUE;

  }

  

  public function RegisterSubscription($data) {

    $this->db->insert('establishment_subscription_free', $data);

  }

  public function GetSubscription()
  { 
      //$rs= $this->db_query->FetchInformation(SPORT,"","1='1'");
      $sql="select @no:=@no+1  no, name,email,address from establishment_subscription_free ,(SELECT @no:= 0) AS no;";
      $query=$this->db->query($sql);
      
      $row=$query->result();
      if($query->num_rows()>0)
       {
         $i=0;
         foreach($query->result() as $row)
         {
          $sp[$i]['no']=$row->no;
          $sp[$i]['name']=$row->name;
          $sp[$i]['email']=$row->email;
          $sp[$i]['address']=$row->address;

          $i++;
         }

       }
    return $sp;
  }

	public function addrecommnedbar($data) {
		
		$this->db->insert('establishment_recommendbar', $data);
		$id = $this->db->insert_id();
		
		$content = '';
		$content .= '<!DOCTYPE html>';
		$content .= '<html lang="en">';
		$content .= '<head>';
		$content .= '<meta charset="utf-8">';
		$content .= '</head>';
		$content .= '<body style="background:#f0f0f0; margin:0; padding:0;">';
		$content .= '<div style="float:left; width:100%;">';
		$content .= '<div style="width:650px; margin:auto">';
		$content .= '<div style="float:left; width:100%; text-align:center; margin:30px 0 33px 0;"><img src="http://sportshub365.com/images/logo_email.png"></div>';
		$content .= '<div style="background:#fff; width:100%;  box-sizing:border-box; padding:0 10px; float:left;">';
		$content .= '<p style="color:#6f6f6f; font-size:14px; font-family:Arial, Helvetica, sans-serif; margin:0; padding:0 0 30px 0;"><br/>Welcome to <a href="http://sportshub365.com" style="text-decoration:none; color:#dab503;" target="_blank">Sportshub365.com</a>.</p>';
		/*$content .= '<p style="color:#6f6f6f; font-family:Arial, Helvetica, sans-serif; font-size:14px; line-height:18px; margin:0; padding:0 0 15px 0;">
Please find the below for your </p>';*/
		$content .= '<p style="color:#6f6f6f; font-family:Arial, Helvetica, sans-serif; font-size:14px; line-height:18px; margin:0; padding:0 0 15px 0;"><strong>Bar Name :</strong> '.$data['barname'].'</p>';
		$content .= '<p style="color:#6f6f6f; font-family:Arial, Helvetica, sans-serif; font-size:14px; line-height:18px; margin:0; padding:0 0 15px 0;"><strong>Bar Address :</strong> '.$data['baraddress'].'</p>';
		$content .= '<p style="color:#6f6f6f; font-family:Arial, Helvetica, sans-serif; font-size:14px; line-height:18px; margin:0; padding:0 0 15px 0;"><strong>Bar Email :</strong> '.$data['baremail'].'</p>';
		$content .= '<p style="color:#6f6f6f; font-family:Arial, Helvetica, sans-serif; font-size:14px; line-height:18px; margin:0; padding:0 0 15px 0;"><strong>Bar Phone :</strong> '.$data['barphone'].'</p>';
		$content .= '<p style="color:#6f6f6f; font-family:Arial, Helvetica, sans-serif; font-size:14px; line-height:18px; margin:0; padding:0 0 15px 0;"><strong>User Email :</strong> '.$data['useremail'].'</p>';
		$content .= '<p style="color:#6f6f6f; font-family:Arial, Helvetica, sans-serif; font-size:14px; line-height:18px; margin:0; padding:0 0 15px 0;"><strong>User Phone :</strong> '.$data['userphone'].'</p>';

		$content .= '<div style="width:100%; float:left; background:#131e38; height:44px; text-align:center;padding: 10px 0 0;color:#fff; font-family:Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold;">If you have any questions or would like any more information please feel free to contact us at, <br /> <a href="mailto:info@sportshub365.com" style="text-decoration:none; color:#dab503;">info@sportshub365.com</a>&nbsp;&nbsp;&nbsp;Tel: +44 208 705 0525</div>';
		$content .= ' </p>';
		$content .= '</div></div></body></html>';
		$to = 'shaikul@likepoles.com';
		$subject = "Sportshub365.com - Recommend a Bar";
	
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
		$headers .= 'From: Sportshub365<info@sportshub365.com>' . "\r\n";
		echo mail($to,$subject,$content,$headers);
		
		return $id;
	}
  
	/*********  Sports Fan Find Bars and Matches) pages edited by Bagyaraj Sekar May 18, 2017      */
	
	public function CheckBarExists($id)
	{
		$query=$this->db->get_where('establishment_info', array('est_user_ref' => $id));
			if($query->num_rows()>0)
			   return true;
			else
				return false;
	}

	public function GetBarDetail($id)
	{
		$query=$this->db->get_where('establishment_info', array('est_user_ref' => $id));
		if($query->num_rows()>0)
		{
			$sp=array();
			$userip = $this->getuserlatlan();
			foreach($query->result() as $row)
			{
				if(!empty($row->title)) $sp['title']=$row->title;
				if(!empty($row->address)) $sp['address']=$row->address;
				if(!empty($row->city)) $sp['city']=$row->city;
				if(!empty($row->zip)) $sp['zip']=$row->zip;
				if(!empty($row->picture)) $sp['picture']=$row->picture;
				if(!empty($row->geo_lat)) { $sp['geo_lat']=$row->geo_lat; } else { $sp['geo_lat'] = $userip['latitude']; }
				if(!empty($row->geo_lang)){ $sp['geo_lang']=$row->geo_lang; } else {$sp['geo_lang'] = $userip['longitude']; }
				if(!empty($row->short_description)) $sp['short_description']=$row->short_description;
			}
			return $sp;
		}
	}
  public function GetBarOffer($est_ref_id)
  { 
    //$rs= $this->db_query->FetchInformation(SPORT,"","1='1'");
    $sql="select * from establishment_offers where est_ref='$est_ref_id' and deleted_on is NULL order by modified_on desc";
    $query=$this->db->query($sql);
    $offer=array();
    $row=$query->result();
    if($query->num_rows()>0)
     {
       $i=0;
       foreach($query->result() as $row)
       {
        $offer[$i]['id']=$row->id;
        $offer[$i]['est_ref']=$row->est_ref;
        $offer[$i]['title']=$row->title;
        $offer[$i]['description']=$row->description;
        $offer[$i]['price_or_discount']=$row->price_or_discount;
		 $offer[$i]['promo_code']=$row->promo_code;
        $offer[$i]['isactive']=$row->isactive;
        $i++;
       }

     }
    return $offer;

  }

  public function GetBarFacilities($est_ref_id)
  { 
    //$rs= $this->db_query->FetchInformation(SPORT,"","1='1'");
    $sql="select ef.*, efc.* from establishment_facility ef, establishment_facility_constant efc where efc.id = ef.est_facility_ref and ef.est_ref='$est_ref_id' and ef.deleted_on is NULL order by ef.est_facility_ref asc";
    $query=$this->db->query($sql);
    $offer=array();
   // $row=$query->result();
    if($query->num_rows()>0)
     {
       $i=0;
       foreach($query->result_array() as $row)
       {
        $offer[$i]=$row;
        $i++;
       }

     }
    return $offer;

  }
   public function GetBarOpeningHours($est_info_id)
	{
		$sql="select * from week_constant";
		$query=$this->db->query($sql);
		if($query->num_rows()>0)
		{
		$week=array();
		$i=0;
		foreach($query->result() as $row)
		{
			$week[$i]['id']=$row->id;
			$week[$i]['name']=$row->name;
			$sql1="select from_time,to_time  from establishment_opening_hours where est_ref='$est_info_id' and week_ref='$row->id' ";
			$query1 = $this->db->query($sql1);
			$week_id = $query1->result();
			if(count($week_id)>0){
				
				$week[$i]['from_time']= $week_id[0]->from_time;
				$week[$i]['to_time']= $week_id[0]->to_time;
			}
			else { 
				$week[$i]['from_time']='';
				$week[$i]['to_time']='';
			}
			
			$i++; 
		}
		return $week;
		} 
	}
   public function GetBarHappyHours($est_info_id)
	{
		$sql="select * from week_constant";
		$query=$this->db->query($sql);
		if($query->num_rows()>0)
		{
			$week=array();
			$i=0;
			foreach($query->result() as $row)
			{
				$week[$i]['id']=$row->id;
				$week[$i]['name']=$row->name;
				$sql1="select from_time,to_time,`is_active`from establishment_happy_hours where est_ref='$est_info_id'  and week_ref='$row->id'";
				$query1 = $this->db->query($sql1);
				$week_id = $query1->result();
				if(count($week_id)>0){
					
					$week[$i]['from_time']= $week_id[0]->from_time;
					$week[$i]['to_time']= $week_id[0]->to_time;
					$week[$i]['is_active']=$week_id[0]->is_active;
				}
				else { 
					$week[$i]['from_time']='';
					$week[$i]['to_time']='';
					$week[$i]['is_active']='';
				}
				$i++; 
			}
			return $week;
		}
	}
	public function getBarEvents($est_info_id)
  	{ 
		//$rs= $this->db_query->FetchInformation(SPORT,"","1='1'");
		$where="where deleted_on is NULL and date >= CURDATE() ";
		$where.=" and est_ref='$est_info_id'";
		$sql="select *, date_format(date, '%D of %M %Y') as dateform from establishment_event $where order by date";
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
				$event[$i]['date']=$row->dateform;
				$event[$i]['time']=$row->time;
				$event[$i]['duration']=$row->duration;
				$i++;
			}
			
		}
		return $event;
  }
   	public function GetBarSchedules( $est_ref, $sync_date='' , $offset=0 , $limit=0 )
    {

	    $schedules=array();
	    $cond = "";

	    if(!empty($sync_date) && $sync_date != '' ) $cond.= " and  f.gmt_date_time >= '$sync_date' ";
		else{
			 $cond.= " and  f.gmt_date_time >= NOW() ";
		}

	    $cond.=" ORDER BY f.gmt_date_time";


	    if($offset >0 && $limit >0 ){
	    	$cond.= " Limit  $limit  OFFSET $offset";
	    } 

	   	$sql="select 
	    f.fixture_id as id,
        esc.establishment_ref as establishment_ref,
		 esc.sport_id as sport_id,
	    f.gmt_date_time as date_time,
		date_format(f.gmt_date_time, '%Y-%m-%d') as dateonly,
	    f.rel_competition_id as competition_id,
	    t1.team_name as team1,
	    t2.team_name as team2
	    from fixture f 
        inner join establishment_schedule esc on
        esc.fixture_ref = f.fixture_id
	    inner join team t1 on 
	    t1.team_id = f.rel_team_id_1 
	    inner join team t2 on 
	    t2.team_id = f.rel_team_id_2 
        where esc.establishment_ref = '$est_ref' $cond";
		//echo $sql;
	    $query=$this->db->query($sql);
	    
	    if($query->num_rows()>0)
       {
         $i=0;
		 $current_timezone = $this->gettimezone();
         foreach($query->result() as $row)
         {
			$query_comp = "select * from competition where competition_id='".$row->competition_id."'";
			$querycomp=$this->db->query($query_comp);
			$compename ='';
			if($querycomp->num_rows()>0)
				{
					$compe = $querycomp->result_array(); 
					$compename = $compe[0]['competition_name'];
				}
			 //if()
			$query_sport = "select * from sport where sport_id='".$row->sport_id."'";
			$querysp=$this->db->query($query_sport);
			$spname ='';
			if($querysp->num_rows()>0)
				{
					$spo = $querysp->result_array(); 
					$spname = $spo[0]['sport_name'];
				}
			 
          	$schedules[$i]['id']=$row->id;
	          $schedules[$i]['competition_id']=$row->competition_id;
			  $schedules[$i]['competition_name']=$compename;
			  $schedules[$i]['sport_name']=$spname;
	          $schedules[$i]['team1']=$row->team1;
	          $schedules[$i]['team2']=$row->team2;
			  $CetTime = $this->ConvertOneTimezoneToAnotherTimezone($row->date_time, 'Europe/London', $current_timezone);
	          $schedules[$i]['date_time']=$CetTime;
			  $schedules[$i]['dateonly']=$row->dateonly;

	          $i++;
         }

       }
     
	    return $schedules;
     }

	public function getuserlatlan() {
		$ip  = !empty($_SERVER['HTTP_X_FORWARDED_FOR']) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR'];
		//$url = "http://freegeoip.net/json/$ip";
		$url = "http://ip-api.com/php/$ip";
		$ch  = curl_init();
		
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
		$data = curl_exec($ch);
		curl_close($ch);
		$res = array('latitude' => '', 'longitude' => ''); 
		if ($data) {
			//$location = json_decode($data);
			$location = unserialize($data);
			//echo "<pre>";
			//print_r($location); die;
			$lat = isset($location['lat'])?$location['lat']:'';
			$lon = isset($location['lon'])?$location['lon']:'';
			$res = array('latitude' => $lat, 'longitude' => $lon); 
			//$sun_info = date_sun_info(time(), $lat, $lon);
		}
		return $res;
	}
	public function gettimezone() {
	  
		$ip  = !empty($_SERVER['HTTP_X_FORWARDED_FOR']) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR'];
		//$ip = '83.32.115.154';
		//$url = "http://freegeoip.net/json/$ip";
		$url = "http://ip-api.com/php/$ip";
		$ch  = curl_init();
		
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
		$data = curl_exec($ch);
		curl_close($ch);
			/*echo "<pre>";
			print_r($data); die;*/
		if ($data) {
			$location = unserialize($data);
			/*echo "<pre>";
			print_r($location); die;*/
			$timezone = $location['timezone'];
			/*echo $timezone; die;*/
			if($timezone=='')
			$timezone = 'Europe/London';
		}
		else {
			$timezone = 'Europe/London';
		}
		
		return $timezone;
  }
  
	/* Converting GMT time zone in to CET Edited on Oct26 2015 Bagayraj*/

	public function ConvertOneTimezoneToAnotherTimezone($time,$currentTimezone,$timezoneRequired)
	{
		$system_timezone = date_default_timezone_get();
		$local_timezone = $currentTimezone;
		date_default_timezone_set($local_timezone);
		$local = date("Y-m-d h:i:s A");
	 
		date_default_timezone_set("CET");
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

}
?>