<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 class Admin_model extends CI_Model
 {
  function __construct()
  {
   parent ::__construct();  
  } 


public function AdminLoginFormAttribute($values=array())
  {
     if(count($values) == 0)
     {
      $values=array('email'=>'Mail','password'=>'');
     }
     $attribute['form']=array('id'=>'signup_frm','name'=>'signup_frm');
     
     $attribute['email']=array('name'=> 'email','id'=> 'email','value' => trim($values['email']),'class'=>"mail-input" , 'onfocus'=>"if (this.value == 'Mail') {this.value = '';}" ,'onblur'=>"if (this.value == '') {this.value = 'Mail';}");

     $attribute['password']=array('type'=>'password','name'=> 'password','id'=> 'password','value' => trim($values['password']),'class'=>"password-input" , 'placeholder'=>'Password');
     
     $attribute['submit']=array('type' => 'submit',  'name' => 'form_submit','class'=>'signup-button','value'=>'signin');
     return $attribute;
  }

 
  public function SearchFormAttribute($values=array())
  {
     if(count($values) == 0)
     {
      $values=array('date_from'=>'Date From','date_end'=>'Date End','search_text'=>'Search');
     }
     $fun="SearchResultAdmin(path.value,'1','20',date_from.value,date_end.value,search_text.value,'');";
     $attribute['form']=array('id'=>'search_frm2','name'=>'search_frm2');
     
     $attribute['date_from']=array('name'=> 'date_from','id'=> 'datepicker-example7-start','value' => trim($values['date_from']),'class'=>"date-input" , 'onfocus'=>"if (this.value == 'Date From') {this.value = '';}" ,'onblur'=>"if (this.value == '') {this.value = 'Date From';}");

     $attribute['date_end']=array('name'=> 'date_end','id'=> 'datepicker-example7-end','value' => trim($values['date_end']),'class'=>"date-input" , 'onfocus'=>"if (this.value == 'Date End') {this.value = '';}" ,'onblur'=>"if (this.value == '') {this.value = 'Date End';}");
   
  /* $attribute['date_disable']=array('name'=> 'date_disable','id'=> 'datepicker-example12','value' => trim($values['date_end']),'class'=>"date-input" , 'onfocus'=>"if (this.value == 'Date End') {this.value = '';}" ,'onblur'=>"if (this.value == '') {this.value = 'Date End';}");*/

     $attribute['search_text']=array('name'=> 'search_text','id'=> 'search_text','value' => trim($values['search_text']),'class'=>"date-input" , 'onfocus'=>"if (this.value == 'Search') {this.value = '';}" ,'onblur'=>"if (this.value == '') {this.value = 'Search';}");
     
     $attribute['submit']=array('type' => 'button',  'name' => 'form_submit','class'=>'search-button','value'=>'',
      'onclick'=>$fun);
     return $attribute;
  }
  
  public function SearchUserAttribute($values=array())
  {
     if(count($values) == 0)
     {
      $values=array('date_from'=>'Date From','date_end'=>'Date End','search_text'=>'Search');
     }
     $fun="SearchResultUser(path.value,'1','20',date_from.value,date_end.value,search_text.value,'');";
     $attribute['form']=array('id'=>'search_frm2','name'=>'search_frm2');
     
     $attribute['date_from']=array('name'=> 'date_from','id'=> 'datepicker-example7-start','value' => trim($values['date_from']),'class'=>"date-input" , 'onfocus'=>"if (this.value == 'Date From') {this.value = '';}" ,'onblur'=>"if (this.value == '') {this.value = 'Date From';}");

     $attribute['date_end']=array('name'=> 'date_end','id'=> 'datepicker-example7-end','value' => trim($values['date_end']),'class'=>"date-input" , 'onfocus'=>"if (this.value == 'Date End') {this.value = '';}" ,'onblur'=>"if (this.value == '') {this.value = 'Date End';}");
   
  /* $attribute['date_disable']=array('name'=> 'date_disable','id'=> 'datepicker-example12','value' => trim($values['date_end']),'class'=>"date-input" , 'onfocus'=>"if (this.value == 'Date End') {this.value = '';}" ,'onblur'=>"if (this.value == '') {this.value = 'Date End';}");*/

     $attribute['search_text']=array('name'=> 'search_text','id'=> 'search_text','value' => trim($values['search_text']),'class'=>"date-input" , 'onfocus'=>"if (this.value == 'Search') {this.value = '';}" ,'onblur'=>"if (this.value == '') {this.value = 'Search';}");
     
     $attribute['submit']=array('type' => 'button',  'name' => 'form_submit','class'=>'search-button','value'=>'',
      'onclick'=>$fun);
     return $attribute;
  }
  
  public function SearchQuestionAttribute($values=array())
  {
     if(count($values) == 0)
     {
      $values=array('date_from'=>'Date From','date_end'=>'Date End','search_text'=>'Search');
     }
     $fun="SearchResultQuestion(path.value,'1','20',date_from.value,date_end.value,search_text.value,'');";
     $attribute['form']=array('id'=>'search_frm2','name'=>'search_frm2');
     
     $attribute['date_from']=array('name'=> 'date_from','id'=> 'datepicker-example7-start','value' => trim($values['date_from']),'class'=>"date-input" , 'onfocus'=>"if (this.value == 'Date From') {this.value = '';}" ,'onblur'=>"if (this.value == '') {this.value = 'Date From';}");

     $attribute['date_end']=array('name'=> 'date_end','id'=> 'datepicker-example7-end','value' => trim($values['date_end']),'class'=>"date-input" , 'onfocus'=>"if (this.value == 'Date End') {this.value = '';}" ,'onblur'=>"if (this.value == '') {this.value = 'Date End';}");
   
     $attribute['search_text']=array('name'=> 'search_text','id'=> 'search_text','value' => trim($values['search_text']),'class'=>"date-input" , 'onfocus'=>"if (this.value == 'Search') {this.value = '';}" ,'onblur'=>"if (this.value == '') {this.value = 'Search';}");
     
     $attribute['submit']=array('type' => 'button',  'name' => 'form_submit','class'=>'search-button','value'=>'',
      'onclick'=>$fun);
     return $attribute;
  }
  
  public function SearchRatingAttribute($values=array())
  {
     if(count($values) == 0)
     {
      $values=array('date_from'=>'Date From','date_end'=>'Date End','search_text'=>'Search');
     }
     $fun="SearchResultRating(path.value,'1','20',date_from.value,date_end.value,search_text.value,'');";
     $attribute['form']=array('id'=>'search_frm2','name'=>'search_frm2');
     
     $attribute['date_from']=array('name'=> 'date_from','id'=> 'datepicker-example7-start','value' => trim($values['date_from']),'class'=>"date-input" , 'onfocus'=>"if (this.value == 'Date From') {this.value = '';}" ,'onblur'=>"if (this.value == '') {this.value = 'Date From';}");

     $attribute['date_end']=array('name'=> 'date_end','id'=> 'datepicker-example7-end','value' => trim($values['date_end']),'class'=>"date-input" , 'onfocus'=>"if (this.value == 'Date End') {this.value = '';}" ,'onblur'=>"if (this.value == '') {this.value = 'Date End';}");
   
  /* $attribute['date_disable']=array('name'=> 'date_disable','id'=> 'datepicker-example12','value' => trim($values['date_end']),'class'=>"date-input" , 'onfocus'=>"if (this.value == 'Date End') {this.value = '';}" ,'onblur'=>"if (this.value == '') {this.value = 'Date End';}");*/

     $attribute['search_text']=array('name'=> 'search_text','id'=> 'search_text','value' => trim($values['search_text']),'class'=>"date-input" , 'onfocus'=>"if (this.value == 'Search') {this.value = '';}" ,'onblur'=>"if (this.value == '') {this.value = 'Search';}");
     
     $attribute['submit']=array('type' => 'button',  'name' => 'form_submit','class'=>'search-button','value'=>'',
      'onclick'=>$fun);
     return $attribute;
  }
  
  public function UserFormAttribute($values=array(),$values_profile)
  {
    $values = $values_profile;
    if(count($values) == 0)
    {
      $values=array('firstname'=>'','lastname'=>'','email'=>'','gender'=>'','country'=>'');
    }
  if(empty($values['title']))$values['title']='';
    $attribute['form']=array('id'=>'profile_frm','name'=>'profile_frm');

  if(!empty($values['firstname']))$values['firstname'] = trim($values['firstname']);else $values['firstname'] ='';
  if(!empty($values['lastname']))$values['lastname'] = trim($values['lastname']);else $values['lastname']='';
  if(!empty($values['email']))$values['email'] = trim($values['email']);else $values['email'] ='';
  if(!empty($values['gender']))$values['gender'] = trim($values['gender']);else $values['gender']='';
  if(!empty($values['country']))$values['country'] = trim($values['country']);else $values['country']='';

    $attribute['firstname']=array('name'=> 'firstname','id'=> 'firstname','value' => trim($values['firstname']),'class'=>"input name" , 'placeholder'=>"Firstname",);


    $attribute['lastname']=array('type' => 'lastname','name'=> 'lastname','id'=> 'lastname','value' => $values['lastname'],'class'=>"input" , 'placeholder'=>"Lastname");

    $attribute['email']=array('name'=> 'email','id'=> 'email','value' => $values['email'],'class'=>"input" , 'placeholder'=>"Email",'readonly'=>'readonly' );
	$attribute['gender']=array('name'=> 'gender','id'=> 'gender','value' => $values['gender'],'class'=>"input" , 'placeholder'=>"Email");
	$attribute['gender_option'] = array(''=>'Please select', 'Male' => 'Male', 'Female' => 'Female');
	$attribute['gender_selected'] = $values['gender'];
	
	$attribute['country']=array('name'=> 'country','id'=> 'country', 'value' => $values['country'],'class'=>"input" , 'placeholder'=>"Country");
 	$attribute['country_option'] = $this->GetCountry();
	$attribute['country_selected'] = $values['country'];
	
    $attribute['submit']=array('type' => 'submit',  'name' => 'form_submit','class'=>'change-now pull-right','value'=>'Save');
    return $attribute;
  }
  
  public function AdminUserFormAttribute($values=array(),$values_profile)
  {
    $values = $values_profile;
    if(count($values) == 0)
    {
      $values=array('firstname'=>'','lastname'=>'','email'=>'');
    }
  if(empty($values['title']))$values['title']='';
    $attribute['form']=array('id'=>'profile_frm','name'=>'profile_frm');

  if(!empty($values['firstname']))$values['firstname'] = trim($values['firstname']);else $values['firstname'] ='';
  if(!empty($values['lastname']))$values['lastname'] = trim($values['lastname']);else $values['lastname']='';
  if(!empty($values['email']))$values['email'] = trim($values['email']);else $values['email'] ='';

    $attribute['firstname']=array('name'=> 'firstname','id'=> 'firstname','value' => trim($values['firstname']),'class'=>"input name" , 'placeholder'=>"Firstname",);


    $attribute['lastname']=array('type' => 'lastname','name'=> 'lastname','id'=> 'lastname','value' => $values['lastname'],'class'=>"input" , 'placeholder'=>"Lastname");

    $attribute['email']=array('name'=> 'email','id'=> 'email','value' => $values['email'],'class'=>"input" , 'placeholder'=>"Email",'readonly'=>'readonly' );
	
    $attribute['submit']=array('type' => 'submit',  'name' => 'form_submit','class'=>'change-now pull-right','value'=>'Save');
    return $attribute;
  }
  
  public function AddEstablishmentAttribute($values=array())
  {
    if(count($values) == 0)
    {
    $values=array('title'=>'','email'=>'','password'=>'');
    }
    $attribute['form']=array('id'=>'signup_frm','name'=>'signup_frm', 'onSubmit'=>'return ValidateEstablishmentForm();');


    $attribute['title']=array('name'=> 'title','id'=> 'title','value' => trim($values['title']),'class'=>"popup-input" , 'placeholder'=>"Title:");


    $attribute['email']=array('name'=> 'email','id'=> 'email','value' => trim($values['email']),'class'=>"popup-input" , 'placeholder'=>"Email:");

    $attribute['password']=array('name'=> 'password', 'type' =>'password', 'id'=> 'password','value' => trim($values['password']),'class'=>"popup-input" , 'placeholder'=>"Password:");

    $attribute['submit']=array('type' => 'submit',  'name' => 'form_submit','class'=>'popup-button','value'=>'Add now');
    return $attribute;
  }
  
  public function AddAdminUserAttribute($values=array())
  {
    if(count($values) == 0)
    {
    $values=array('email'=>'','password'=>'');
    }
    $attribute['form']=array('id'=>'signup_frm','name'=>'signup_frm', 'onSubmit'=>'return ValidateAdminUserForm();');

    $attribute['email']=array('name'=> 'email','id'=> 'email','value' => trim($values['email']),'class'=>"popup-input" , 'placeholder'=>"Email:");

    $attribute['password']=array('name'=> 'password', 'type' =>'password', 'id'=> 'password','value' => trim($values['password']),'class'=>"popup-input" , 'placeholder'=>"Password:");

    $attribute['submit']=array('type' => 'submit',  'name' => 'form_submit','class'=>'popup-button','value'=>'Add now');
    return $attribute;
  }
  
  public function SliderFormAttribute($values=array(),$values_slider)
  {
    $values = $values_slider;
    if(count($values) == 0)
    {
      $values=array('slidername'=>'','url'=>'','desc'=>'','image'=>'');
    }
  if(empty($values['slidername']))$values['slidername']='';
    $attribute['form']=array('id'=>'slider_frm','name'=>'slider_frm', 'enctype'=>'multipart/form-data');

  if(!empty($values['slidername']))$values['slidername'] = trim($values['slidername']);else $values['slidername'] ='';
  if(!empty($values['url']))$values['url'] = trim($values['url']);else $values['url']='';
  if(!empty($values['desc']))$values['desc'] = trim($values['desc']);else $values['desc'] ='';
  if(!empty($values['image']))$values['image'] = trim($values['image']);else $values['image']='';

    $attribute['slidername']=array('name'=> 'slidername','id'=> 'slidername','value' => trim($values['slidername']),'class'=>"input name" , 'placeholder'=>"Slider Name",);


    $attribute['url']=array('type' => 'lastname','name'=> 'url','id'=> 'url','value' => $values['url'],'class'=>"input" , 'placeholder'=>"URL");

    $attribute['desc']=array('name'=> 'desc','id'=> 'desc','value' => $values['desc'],'class'=>"textarea" , 'placeholder'=>"CONTENT");
	$attribute['image']=array('name'=> 'image','id'=> 'image','value' => '' ,'class'=>"upload");
	
	if(isset($values['image']) and !empty($values['image']))
    {
	  $attribute['current_picture'] = $values['image'];
    }
	else {
	  $attribute['current_picture'] = '';	
	}
    $attribute['submit']=array('type' => 'submit',  'name' => 'form_submit','class'=>'change-now pull-right','value'=>'Save', 'onclick' => 'return form_validate();');
    return $attribute;
  }
  
  
  public function RatingFormAttribute($values=array(),$values_profile)
  {
    $values = $values_profile;
    if(count($values) == 0)
    {
      $values=array('title'=>'','user'=>'','rating'=>'','comment'=>'');
    }
  if(empty($values['title']))$values['title']='';
    $attribute['form']=array('id'=>'profile_frm','name'=>'profile_frm');

  if(!empty($values['title']))$values['title'] = trim($values['title']);else $values['title'] ='';
  if(!empty($values['user']))$values['user'] = trim($values['user']);else $values['user']='';
  if(!empty($values['rating']))$values['rating'] = trim($values['rating']);else $values['rating'] ='';
  if(!empty($values['comment']))$values['comment'] = trim($values['comment']);else $values['comment']='';

    $attribute['title']=array('name'=> 'title','id'=> 'title','value' => trim($values['title']),'class'=>"input name" , 'placeholder'=>"Title",'readonly'=>'readonly');


    $attribute['user']=array('type' => 'user','name'=> 'user','id'=> 'user','value' => $values['user'],'class'=>"input" , 'placeholder'=>"User",'readonly'=>'readonly');

    //$attribute['email']=array('name'=> 'email','id'=> 'email','value' => $values['email'],'class'=>"input" , 'placeholder'=>"Email",'readonly'=>'readonly' );
	$attribute['rating']=array('name'=> 'rating','id'=> 'rating','value' => $values['rating'],'class'=>"input" , 'placeholder'=>"Rating");
	$attribute['rating_option'] = array(''=>'Please select', '0' => '0', '1' => '1','2' => '2', '3' => '3','4' => '4', '5' => '5');
	$attribute['rating_selected'] = $values['rating'];
	
	$attribute['comment']=array('name'=> 'comment','id'=> 'comment','value' => $values['comment'],'class'=>"textarea" , 'placeholder'=>"Comment");
	
	
    $attribute['submit']=array('type' => 'submit',  'name' => 'form_submit','class'=>'change-now pull-right','value'=>'Save');
    return $attribute;
  }
  
  public function CheckUser($email,$password)
  {

    if(!empty($email) and !empty($password)){

      // checking email id not empty
        $q="SELECT id FROM admin_user WHERE `email` = '$email' LIMIT 1";
        $query = $this->db->query($q) or die(var_dump($query));
        
        // checking record exist in database 
        if($query->num_rows() > 0)
        {
          $query = $this->db->query("SELECT id FROM admin_user WHERE `email` = '$email' AND password = '".$password."' LIMIT 1", $this->db);
          
          if($query->num_rows() > 0)
          {
            $row = $query->result();
                
            $row=$row[0];
            // If success everythig is good send header as "OK" and establishment_user details
            //$this->response($this->json($row), 200);
            //print_r($row);
            if(!empty( $row->id )){

              return $msg="success";
            }
            else
              return $msg="Invalid credettial";
          }
          else{
            return $msg="Password is wrong";
          }
        }
        else{
          return $msg="Email does not exist";
        }
     }
  }
  
  public function GetFacilityConstants()
  { 
      //$rs= $this->db_query->FetchInformation(SPORT,"","1='1'");
      $sql="select * from establishment_facility_constant ";
      $query=$this->db->query($sql);
      
      $row=$query->result();
      if($query->num_rows()>0)
       {
         $i=0;
         foreach($query->result() as $row)
         {
           $sp[$i]['id']=$row->id;  //die;
          $sp[$i]['name']=$row->name;
          $sp[$i]['icon']=$row->icon;
          $sp[$i]['type']=$row->type;

          $i++;
         }
       }
    return $sp;
  }
  
  public function GetFixtureIds($channel_ids)
  {
   
   $sql="select rel_fixture_channel_list_id from channel_list_fixture_channel_list where rel_instance_id in ('".$channel_ids."') ";
   $query=$this->db->query($sql);
   if($query->num_rows()>0)
   {
    $i=0;
    foreach($query->result() as $row)
    {
     $ch[$i]=$row->rel_fixture_channel_list_id;
     $i++;
    }
   return $ch;
   }
  }
 
 public function AllFixture($est_ref_id,$sport_id,$channel_id,$from_date,$to_date,$search_text,$limit='')
  { 
//echo $channel_id;
   if(!empty($channel_id))
   {
    $channel_ids=str_replace("~","','",$channel_id);
    $fixture_ids=$this->GetFixtureIds($channel_ids); 
    //print_r($fixture_ids);

    if(is_array($fixture_ids)) $ar=implode("','",$fixture_ids);
    else $ar=$fixture_ids;

//print_r($ar);
     $channel_condition="and f.fixture_id in ('".$ar."') ";
   
   }
    else $channel_condition="";  
    $sp=array();

    if(!empty($sport_id))
    {
      $sport_ids=str_replace("~","','",$sport_id);


     $cond="and c.rel_sport_id in ('".$sport_ids."')";
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
    $sql="select f.fixture_id,c.rel_sport_id,date_format(f.gmt_date_time,'%Y-%m-%d') as gmt_date_time , time_format(f.local_time,'%H:%i' ) as local_time_form
    t1.team_name as team1,t2.team_name as team2 from fixture f inner join team t1 on
     f.rel_team_id_1=t1.team_id inner join team t2 on f.rel_team_id_2=t2.team_id inner join 
     competition c on f.rel_competition_id=c.competition_id where f.deleted_on = '' and f.gmt_date_time > CURDATE() 
     $cond $channel_condition $where $limit";

      $query=$this->db->query($sql);
      
      $row=$query->result();
      if($query->num_rows()>0)
       {
         $i=0;
         foreach($query->result() as $row)
         {
          $check=$this->ChechkFixtureSchedule($est_ref_id,$row->fixture_id);
          if(!empty($check)) $sp[$i]['fixture_check']='checked';
          else $sp[$i]['fixture_check']="";
          $sp[$i]['id']=$row->fixture_id;
          $sp[$i]['sport_id']=$row->rel_sport_id;
          $sp[$i]['gmt_date_time']=$row->gmt_date_time;
		  $CetTime = $this->ConvertOneTimezoneToAnotherTimezone($row->local_time_form,'Europe/London','Europe/Berlin');
		  $sp[$i]['local_time_form'] = date("H:i", strtotime($CetTime));
          $sp[$i]['team1']=$row->team1;
          $sp[$i]['team2']=$row->team2;

          $i++;
         }
       }
    return $sp;
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

  public function DashboardDetails() {
		
		$sql = "SELECT
				  (SELECT COUNT(*) FROM user) as totaluser, 
				  (SELECT COUNT(*) FROM establishment_info) as totalestablishment,
				  (SELECT COUNT(*) FROM fixture f inner join team t1 on
					 f.rel_team_id_1=t1.team_id inner join team t2 on f.rel_team_id_2=t2.team_id inner join 
					 competition c on f.rel_competition_id=c.competition_id where f.deleted_on is NULL and f.gmt_date_time > CURDATE()) as totalmatches";
				  		
		$query = $this->db->query($sql);
		$result = $query->result();
		//echo "<pre>";
		//print_r($result); die;
		return $result;
  }

  public function UserList($from_date='',$to_date='',$search_text='',$limit='')
  { 

      //$rs= $this->db_query->FetchInformation(SPORT,"","1='1'");

     // for date search
    $where="where deleted_on is NULL";
     if(!empty($from_date) && $from_date!='Date From'){
       $from_date = str_replace("/","-", $from_date);$from_date=date('Y-m-d h:i:s',strtotime($from_date));
       $where.=" and created_date >='$from_date'";
     }
     if(!empty($to_date) && $to_date!='Date End'){
		$to_date = str_replace("/","-", $to_date);$to_date= date('Y-m-d h:i:s',strtotime($to_date));
		 $where.=" and  created_date <='$to_date'";
	 }
	 if($from_date == $to_date){
		$from_date = str_replace("/","-", $from_date);$from_date=date('Y-m-d h:i:s',strtotime($from_date));
	   $where.=" or created_date ='$from_date'";
	 }
     
     if(!empty($search_text) && $search_text!='Search')
      $where.=" and (firstname like '%$search_text%' or lastname like '%$search_text%' or country like '%$search_text%')";

// end for date search 

      $sql="select * from user $where order by created_date desc $limit";
	  //echo $sql; die; 
      $query=$this->db->query($sql);
    
      $user=array();
      $row=$query->result();
      if($query->num_rows()>0)
       {
         $i=0;
         foreach($query->result() as $row)
         {
          $user[$i]['user_id']=$row->user_id;
          $user[$i]['email_id']=$row->email_id;
          $user[$i]['firstname']=$row->firstname;
          $user[$i]['lastname']=$row->lastname;
          $user[$i]['gender']=$row->gender;
          $user[$i]['isActive']=$row->isActive;
          $user[$i]['country']=$row->country;

          $i++;
         }

       }
    return $user;

  }
  
  public function AdminUserList($from_date='',$to_date='',$search_text='',$limit='')
  { 

     // for date search
    //$where="where deleted_on is NULL";
	$where="where 1=1 ";
     if(!empty($from_date) && $from_date!='Date From'){
       $from_date = str_replace("/","-", $from_date);$from_date=date('Y-m-d h:i:s',strtotime($from_date));
       $where.=" and created_date >='$from_date'";
     }
     if(!empty($to_date) && $to_date!='Date End'){
		$to_date = str_replace("/","-", $to_date);$to_date= date('Y-m-d h:i:s',strtotime($to_date));
		 $where.=" and  created_date <='$to_date'";
	 }
	 /*if($from_date == $to_date ){
		$from_date = str_replace("/","-", $from_date);$from_date=date('Y-m-d h:i:s',strtotime($from_date));
	   $where.=" or created_date ='$from_date'";
	 }*/
     
     if(!empty($search_text) && $search_text!='Search')
      $where.=" and (firstname like '%$search_text%' or lastname like '%$search_text%' or country like '%$search_text%')";

// end for date search 

      $sql="select * from admin_user $where order by created_on desc $limit";
	  //echo $sql; die; 
      $query=$this->db->query($sql);
    
      $user=array();
      $row=$query->result();
      if($query->num_rows()>0)
       {
         $i=0;
         foreach($query->result() as $row)
         {
          $user[$i]['id']=$row->id;
          $user[$i]['email']=$row->email;
          $user[$i]['firstname']=$row->first_name;
          $user[$i]['lastname']=$row->last_name;
          $user[$i]['created_on']=$row->created_on;
		   $user[$i]['is_block']=$row->is_block;

          $i++;
         }

       }
    return $user;

  }
  
  public function EstablishmentAccountList($from_date='',$to_date='',$search_text='',$limit='')
  { 
    //$where=" where est_info.deleted_on is NULL ";
   // if(!empty($city) && $city!='City'){     
    // $where.=" and city ='$city'";
    //}

   // if(!empty($country) && $country!='Country'){
    // $where.=" and country <='$country'";
   // }
    $where=" and ei.deleted_on is NULL";
     
    if(!empty($search_text) && $search_text!='Search')
  {
      $where.=" and (ei.title like '%$search_text%' or eu.email like '%$search_text%')";
  }
// end for date search 
    
    /*echo   $sql="select est_info.id,est_info.est_user_ref,est_info.title,est_info.address,
        est_info.country,est_ac_hist.product as account from
       establishment_info est_info right join 
       establishment_account_history est_ac_hist on 
       est_ac_hist.establishment_ref = est_info.est_user_ref $where  order by modified_on desc"; */
     
      // for date search
  
    
     if(!empty($from_date) && $from_date!='Date From'){
      $from_date = str_replace("/","-", $from_date);$from_date=date('Y-m-d h:i:s',strtotime($from_date));
       $where.=" and ei.created_on >='$from_date'";
     }

       if(!empty($to_date) && $to_date!='Date End'){
        $to_date = str_replace("/","-", $to_date);$to_date= date('Y-m-d h:i:s',strtotime($to_date));
         $where.=" and ei.created_on <='$to_date'";
       }
      if($from_date = $to_date){
        $from_date = str_replace("/","-", $from_date);$from_date=date('Y-m-d h:i:s',strtotime($from_date));
       $where.=" or ei.created_on ='$from_date'";
       }

/*     
     if(!empty($search_text) && $search_text!='Search') $where.=" and (t1.team_name like '%$search_text%' or t2.team_name like '%$search_text%')";*/

// end for date search 
       $sql="select ei.est_user_ref,ei.title,ei.id,ei.country,ei.address,ei.status,ei.totallikes,eu.first_name,eu.email from establishment_info as ei inner join
establishment_user as eu on ei.est_user_ref=eu.id  where ei.title != ''  $where order by ei.created_on desc $limit ";
//echo $sql; die;
//print_r($sql);
//die;
      $query=$this->db->query($sql);
      $user=array();
      //$row=$query->result();
      if($query->num_rows()>0)
       {
         $i=0;
         foreach($query->result() as $row)
         {
      	   $user[$i]['id']=$row->id;
          $user[$i]['est_user_ref']=$row->est_user_ref;
          $user[$i]['title']=$row->title;
          $user[$i]['address']=$row->address;
          $user[$i]['country']=$row->country;
      	  $user[$i]['first_name']=$row->first_name;
     	  $user[$i]['email']=$row->email;
		  $user[$i]['status']=$row->status;
		  $user[$i]['totallikes']=$row->totallikes;
         // $user[$i]['account']=$row->account;
          $i++;
         }
       }
    return $user;
  }
  public function AddNewEstablishment($data) {
	//echo "<pre>";
	//print_r($data); die;  
  	$query=$this->db->get_where('establishment_user', array('email' => $data['email']));
	if($query->num_rows()==0)
     {
		$arraydata = array();
		$arraydata['email'] = $data['email'];
		$arraydata['password'] = myencrypt($data['password']);
		 
		$this->db->insert('establishment_user', $arraydata);
		$user_ref = $this->db->insert_id();
		
		$arrayest = array();
		//$arrayest['est_user_ref'] = $user_ref;
		$arrayest['title'] = $data['title'];
		
		$this->db->where('est_user_ref',$user_ref);
	    $this->db->update('establishment_info',$arrayest);
		
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
			$content .= '<p style="color:#6f6f6f; font-size:14px; font-family:Arial, Helvetica, sans-serif; margin:0; padding:0 0 30px 0;"><br/>Welcome to <a href="http://sportshub365.com" style="text-decoration:none; color:#dab503;" target="_blank">Sportshub365.com</a>. You\'re nearly ready to go!</p>';
			$content .= '<p style="color:#6f6f6f; font-size:14px; font-family:Arial, Helvetica, sans-serif; margin:0; padding:0 0 30px 0;">Here at Sportshub365 we love our sport, the atmosphere of a busy venue with like-minded fans is a great way to watch it. Sportshub365 is excited that you have joined their growing number of venues and with you now onboard sports fans in your area can now be directed straight to you.</p>';
			$content .= '<p style="color:#6f6f6f; font-family:Arial, Helvetica, sans-serif; font-size:14px; line-height:18px; margin:0; padding:0 0 15px 0;">
	Please fill out your profile account with all your information and take advantage of our 6 months FREE offer.
	Photos say a thousand words so add up to 5 images of your venue and don\'t forget to add those special offers to entice sport lovers into your venue.</p>';
			$content .= '<p style="color:#6f6f6f; font-family:Arial, Helvetica, sans-serif; font-size:14px; line-height:18px; margin:0; padding:0 0 15px 0;">
	Select the games that you will be showing from your generated fixtures list and this will automatically be updated onto the App along with your venue\'s profile.</p>';
			$content .= '<p style="color:#6f6f6f; font-family:Arial, Helvetica, sans-serif; font-size:14px; line-height:18px; margin:0; padding:0 0 15px 0;">
	Don\'t forget your login detail!</p>';
			$content .= '<p style="color:#6f6f6f; font-family:Arial, Helvetica, sans-serif; font-size:14px; line-height:18px; margin:0; padding:0 0 15px 0;">
	<strong>Email :</strong> '.$data['email'].'<br/><strong>Password :</strong> '.$data['password'].'</p>';
			$content .= '<p style="color:#6f6f6f; font-family:Arial, Helvetica, sans-serif; font-size:14px; line-height:18px; margin:0; padding:0 0 15px 0;"><br />If you have any questions or would like any more information please feel free to contact us at, <br /> <a href="mailto:info@sportshub365.com" style="text-decoration:none; color:#dab503;">info@sportshub365.com</a>&nbsp;&nbsp;&nbsp;Tel: +44 208 705 0525 </div>';
			$content .= ' </p>';
			$content .= '</div></div></body></html>';
			$to = $data['email'];
			$subject = "Welcome to Sportshub365.com";
		
			$headers = 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'Content-type:text/html; charset= iso-8859-1' . "\r\n";
			$headers .= 'From: Sportshub365<info@sportshub365.com>' . "\r\n";
			$headers .= 'Reply-To: Sportshub365<info@sportshub365.com>' . "\r\n";
			$headers .= 'X-Mailer: PHP/' . phpversion();
			mail($to,$subject,$content,$headers);
	 }
	 else {
	 
	 	}
  }
  
  public function AddNewAdminUser($data) {
	//echo "<pre>";
	//print_r($data); die;  
  	$query=$this->db->get_where('admin_user', array('email' => $data['email']));
	if($query->num_rows()==0)
     {
		$arraydata = array();
		$arraydata['email'] = $data['email'];
		$arraydata['password'] = myencrypt($data['password']);
		 
		$this->db->insert('admin_user', $arraydata);
		
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
			$content .= '<p style="color:#6f6f6f; font-size:14px; font-family:Arial, Helvetica, sans-serif; margin:0; padding:0 0 30px 0;"><br/>Welcome to <a href="http://sportshub365.com" style="text-decoration:none; color:#dab503;" target="_blank">Sportshub365.com</a>. You\'re nearly ready to go!</p>';
			/*$content .= '<p style="color:#6f6f6f; font-size:14px; font-family:Arial, Helvetica, sans-serif; margin:0; padding:0 0 30px 0;">Here at Sportshub365 we love our sport, the atmosphere of a busy venue with like-minded fans is a great way to watch it. Sportshub365 is excited that you have joined their growing number of venues and with you now onboard sports fans in your area can now be directed straight to you.</p>';
			$content .= '<p style="color:#6f6f6f; font-family:Arial, Helvetica, sans-serif; font-size:14px; line-height:18px; margin:0; padding:0 0 15px 0;">
	Please fill out your profile account with all your information and take advantage of our 6 months FREE offer.
	Photos say a thousand words so add up to 5 images of your venue and don\'t forget to add those special offers to entice sport lovers into your venue.</p>';
			$content .= '<p style="color:#6f6f6f; font-family:Arial, Helvetica, sans-serif; font-size:14px; line-height:18px; margin:0; padding:0 0 15px 0;">
	Select the games that you will be showing from your generated fixtures list and this will automatically be updated onto the App along with your venue\'s profile.</p>';*/
			$content .= '<p style="color:#6f6f6f; font-family:Arial, Helvetica, sans-serif; font-size:14px; line-height:18px; margin:0; padding:0 0 15px 0;">
	Don\'t forget your login detail!</p>';
			$content .= '<p style="color:#6f6f6f; font-family:Arial, Helvetica, sans-serif; font-size:14px; line-height:18px; margin:0; padding:0 0 15px 0;">
	<strong>Email :</strong> '.$data['email'].'<br/><strong>Password :</strong> '.$data['password'].'</p>';
			$content .= '<div style="width:100%; float:left; background:#131e38; height:44px; text-align:center;padding: 10px 0 0;color:#fff; font-family:Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold;">If you have any questions or would like any more information please feel free to contact us at, <br /> <a href="mailto:info@sportshub365.com" style="text-decoration:none; color:#dab503;">info@sportshub365.com</a>&nbsp;&nbsp;&nbsp;Tel: +44 208 705 0525</div>';
			$content .= ' </p>';
			$content .= '</div></div></body></html>';
			$to = $data['email'];
			$subject = "Welcome to Sportshub365.com";
		
				$headers = 'MIME-Version: 1.0' . "\r\n";
				$headers .= 'Content-type:text/html; charset= iso-8859-1' . "\r\n";
				$headers .= 'From: Sportshub365<info@sportshub365.com>' . "\r\n";
				$headers .= 'Reply-To: Sportshub365<info@sportshub365.com>' . "\r\n";
				$headers .= 'X-Mailer: PHP/' . phpversion();
			mail($to,$subject,$content,$headers);
				
	 }
	 else {
	 
	 	}
  }
  
  public function checkExstingUser($email)
  { 
    $query = $this->db->get_where('establishment_user', array('email' => $email));
    if($query->num_rows()==0)
    {
      return FALSE;
    }
      return TRUE;
  }
  
   public function checkExstingAdminUser($email)
  { 
    $query = $this->db->get_where('admin_user', array('email' => $email));
    if($query->num_rows()==0)
    {
      return FALSE;
    }
      return TRUE;
  }
  	
  public function DeleteUser($id)
  {
    $data_ar['deleted_on']=date('y-m-d:h:i:s');
    $this->db->where('user_id',$id);
    $this->db->update('user',$data_ar);
  }
 public function DeleteEstablishmentInfo($id)
  {
    /*$data_ar['deleted_on']=date('y-m-d:h:i:s');
    $this->db->where('id',$id);
	$this->db->update('user',$data_ar);*/
	
   //$this->db->Delete('establishment_info',$this);
  //return true;
  ///redirect('admin/esatblishment');
     //print_r($this);
     //die;
    $sql_1 ="select * from establishment_info where id= '".$id."' ";
  
    $query_1 =$this->db->query($sql_1);
    
    if($query_1->num_rows()>0)
    { 
     // $sql_rem = " delete from establishment_info where id= '".$id."'  ";
	 $data_ar['title'] = '';
  	  $data_ar['deleted_on'] = date('y-m-d:h:i:s');
      $this->db->where('id',$id);
	  $this->db->update('establishment_info',$data_ar);
	
     // $query_rem = $this->db->query($sql_rem);
     // print_r($this);
    
      return true;
    }
    else
    {
      return false;
    }
  }
  
  public function DeleteUserInfo($id)
  {
   
    $sql_1 ="select * from user where user_id= '".$id."' ";
    $query_1 =$this->db->query($sql_1);
    
    if($query_1->num_rows()>0)
    { 
      $sql_rem = " delete from user where user_id= '".$id."'  ";
  
      $query_rem = $this->db->query($sql_rem);
           print_r($query_rem);
      return true;
    }
    else
    {
      return false;
    }
  }
  
   public function DeleteAdminUserInfo($id)
  {
   
    $sql_1 ="select * from admin_user where id= '".$id."' ";
    $query_1 =$this->db->query($sql_1);
    
    if($query_1->num_rows()>0)
    { 
      $sql_rem = " delete from admin_user where id= '".$id."'  ";
  
      $query_rem = $this->db->query($sql_rem);
           print_r($query_rem);
      return true;
    }
    else
    {
      return false;
    }
  }
  
 public function DeleteRating($id)
  {
   
    $sql_1 ="select * from establishment_rating where id='".$id."'";
    $query_1 =$this->db->query($sql_1);
    
    if($query_1->num_rows()>0)
    { 
      $sql_rem = " delete from establishment_rating where id='".$id."'";
	  //echo $sql_rem; die;
      $query_rem = $this->db->query($sql_rem);
           print_r($query_rem);
      return true;
    }
    else
    {
      return false;
    }
  }
  
   public function DeleteSlider($id)
  {
   
    $sql_1 ="select * from slider where id='".$id."'";
    $query_1 =$this->db->query($sql_1);
    
    if($query_1->num_rows()>0)
    { 
      $sql_rem = " delete from slider where id='".$id."'";
	  //echo $sql_rem; die;
      $query_rem = $this->db->query($sql_rem);
           print_r($query_rem);
      return true;
    }
    else
    {
      return false;
    }
  }
  
  public function BlockEstablishmentInfo($id,$status)
   {
    $sql_1 ="select * from establishment_info as ei join establishment_user as eu on ei.est_user_ref=eu.id where ei.id= '".$id."' ";

    $query_1 = $this->db->query($sql_1);
    $result = $query_1->result();
	
    if($query_1->num_rows()>0)
    { 
	 $user_status = ($status=='block')?1:0;
	  
       $sql_rem = "UPDATE establishment_info SET status='".$user_status."' WHERE id= '".$id."'";
       $query_rem = $this->db->query($sql_rem);
	   if($query_rem) {
		   
		   $email = $result[0]->email;
		   
			if($status == 'block' ) {
		    
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
				$content .= '<p style="color:#6f6f6f; font-size:14px; font-family:Arial, Helvetica, sans-serif; margin:0; padding:0 0 30px 0;"><br/>Your establishment blocked from admin for below reason.</p>';
				$content .= '<p style="color:#6f6f6f; font-size:14px; font-family:Arial, Helvetica, sans-serif; margin:0; padding:0 0 30px 0;">Reason : '.$reason.'.</p>';
				$content .= '<p style="color:#6f6f6f; font-family:Arial, Helvetica, sans-serif; font-size:14px; line-height:18px; margin:0; padding:0 0 15px 0;">
	You can\'t access your account now. Please contact admin for further information!</p>';
				
				$content .= '<div style="width:100%; float:left; background:#131e38; height:44px; text-align:center;padding: 10px 0 0;color:#fff; font-family:Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold;">If you have any questions or would like any more information please feel free to contact us at, <br /> <a href="mailto:info@sportshub365.com" style="text-decoration:none; color:#dab503;">info@sportshub365.com</a>&nbsp;&nbsp;&nbsp;Tel: +44 208 705 0525</div>';
				
				$content .= ' </p>';
				$content .= '</div></div></body></html>';
				$to = $email;
				$subject = "Establishment Blocked - Sportshub365.com";
			
				$headers = 'MIME-Version: 1.0' . "\r\n";
				$headers .= 'Content-type:text/html; charset= iso-8859-1' . "\r\n";
				$headers .= 'From: Sportshub365<info@sportshub365.com>' . "\r\n";
				$headers .= 'Reply-To: Sportshub365<info@sportshub365.com>' . "\r\n";
				$headers .= 'X-Mailer: PHP/' . phpversion();
				$mail_status = mail($to,$subject,$content,$headers);
		  }
		  else {
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
				$content .= '<p style="color:#6f6f6f; font-size:14px; font-family:Arial, Helvetica, sans-serif; margin:0; padding:0 0 30px 0;"><br/>Your establishment unblocked from admin.</p>';
				$content .= '<p style="color:#6f6f6f; font-family:Arial, Helvetica, sans-serif; font-size:14px; line-height:18px; margin:0; padding:0 0 15px 0;">
	You can access your account now. Please contact admin for further information!</p>';
				
				$content .= '<div style="width:100%; float:left; background:#131e38; height:44px; text-align:center;padding: 10px 0 0;color:#fff; font-family:Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold;">If you have any questions or would like any more information please feel free to contact us at, <br /> <a href="mailto:info@sportshub365.com" style="text-decoration:none; color:#dab503;">info@sportshub365.com</a>&nbsp;&nbsp;&nbsp;Tel: +44 208 705 0525</div>';
				
				$content .= ' </p>';
				$content .= '</div></div></body></html>';
				$to = $email;
				$subject = "Establishment Unblocked - Sportshub365.com";
			
				$headers = 'MIME-Version: 1.0' . "\r\n";
				$headers .= 'Content-type:text/html; charset= iso-8859-1' . "\r\n";
				$headers .= 'From: Sportshub365<info@sportshub365.com>' . "\r\n";
				$headers .= 'Reply-To: Sportshub365<info@sportshub365.com>' . "\r\n";
				$headers .= 'X-Mailer: PHP/' . phpversion();
				$mail_status = mail($to,$subject,$content,$headers);
			}
		}
       return true;
    }
    else
    {
      return false;
    }
  }
  
  public function BlockRating($id,$status,$reason)
   {
    $sql_1 ="select eu.email as est_email, u.email_id as user_email from establishment_rating as ei join establishment_user as eu on ei.user_ref=eu.id join user as u on u.user_id=ei.user_ref where ei
.id= '".$id."'";
	 
    $query_1 = $this->db->query($sql_1);
    $result = $query_1->result();
	
    if($query_1->num_rows()>0)
    { 
	 $user_status = ($status=='block')?1:0;
	  
       $sql_rem = "UPDATE establishment_rating SET is_blocked='".$user_status."' WHERE id= '".$id."'";
       $query_rem = $this->db->query($sql_rem);
	   if($query_rem) {
		   
		   $email_est  = $result[0]->est_email;
		   $email_user = $result[0]->user_email;
		   
			if($status == 'block' ) {
		    
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
				$content .= '<p style="color:#6f6f6f; font-size:14px; font-family:Arial, Helvetica, sans-serif; margin:0; padding:0 0 30px 0;"><br/>Your comment blocked from admin for below reason.</p>';
				$content .= '<p style="color:#6f6f6f; font-size:14px; font-family:Arial, Helvetica, sans-serif; margin:0; padding:0 0 30px 0;">Reason : '.$reason.'.</p>';
				$content .= '<p style="color:#6f6f6f; font-family:Arial, Helvetica, sans-serif; font-size:14px; line-height:18px; margin:0; padding:0 0 15px 0;">
	You can\'t access your account now. Please contact admin for further information!</p>';
				
				$content .= '<div style="width:100%; float:left; background:#131e38; height:44px; text-align:center;padding: 10px 0 0;color:#fff; font-family:Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold;">If you have any questions or would like any more information please feel free to contact us at, <br /> <a href="mailto:info@sportshub365.com" style="text-decoration:none; color:#dab503;">info@sportshub365.com</a>&nbsp;&nbsp;&nbsp;Tel: +44 208 705 0525</div>';
				
				$content .= ' </p>';
				$content .= '</div></div></body></html>';
				$to = $email_user;
				$subject = "Comment Blocked - Sportshub365.com";
			
				$headers = 'MIME-Version: 1.0' . "\r\n";
				$headers .= 'Content-type:text/html; charset= iso-8859-1' . "\r\n";
				$headers .= 'From: Sportshub365<info@sportshub365.com>' . "\r\n";
				$headers .= 'Reply-To: Sportshub365<info@sportshub365.com>' . "\r\n";
				$headers .= 'X-Mailer: PHP/' . phpversion();
				$mail_status = mail($to,$subject,$content,$headers);
				
				//mail for establishment
				/*$content = '';
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
				$content .= '<p style="color:#6f6f6f; font-size:14px; font-family:Arial, Helvetica, sans-serif; margin:0; padding:0 0 30px 0;"><br/>Your app account blocked from admin for below reason.</p>';
				$content .= '<p style="color:#6f6f6f; font-size:14px; font-family:Arial, Helvetica, sans-serif; margin:0; padding:0 0 30px 0;">Reason : '.$reason.'.</p>';
				$content .= '<p style="color:#6f6f6f; font-family:Arial, Helvetica, sans-serif; font-size:14px; line-height:18px; margin:0; padding:0 0 15px 0;">
	You can\'t access your account now. Please contact admin for further information!</p>';
				
				$content .= '<div style="width:100%; float:left; background:#131e38; height:44px; text-align:center;padding: 10px 0 0;color:#fff; font-family:Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold;">If you have any questions or would like any more information please feel free to contact us at, <br /> <a href="mailto:info@sportshub365.com" style="text-decoration:none; color:#dab503;">info@sportshub365.com</a>&nbsp;&nbsp;&nbsp;Tel: +44 208 705 0525</div>';
				
				$content .= ' </p>';
				$content .= '</div></div></body></html>';
				$to = $email_est;
				$subject = "Comments Blocked - Sportshub365.com";
			
				$headers = 'MIME-Version: 1.0' . "\r\n";
				$headers .= 'Content-type:text/html; charset= iso-8859-1' . "\r\n";
				$headers .= 'From: Sportshub365<info@sportshub365.com>' . "\r\n";
				$headers .= 'Reply-To: Sportshub365<info@sportshub365.com>' . "\r\n";
				$headers .= 'X-Mailer: PHP/' . phpversion();
				$mail_status = mail($to1,$subject1,$content1,$headers);*/
		  }
		  else {
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
				$content .= '<p style="color:#6f6f6f; font-size:14px; font-family:Arial, Helvetica, sans-serif; margin:0; padding:0 0 30px 0;"><br/>Your comment unblocked from admin.</p>';
				$content .= '<p style="color:#6f6f6f; font-family:Arial, Helvetica, sans-serif; font-size:14px; line-height:18px; margin:0; padding:0 0 15px 0;">
	Please contact admin for further information!</p>';
				
				$content .= '<div style="width:100%; float:left; background:#131e38; height:44px; text-align:center;padding: 10px 0 0;color:#fff; font-family:Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold;">If you have any questions or would like any more information please feel free to contact us at, <br /> <a href="mailto:info@sportshub365.com" style="text-decoration:none; color:#dab503;">info@sportshub365.com</a>&nbsp;&nbsp;&nbsp;Tel: +44 208 705 0525</div>';
				
				$content .= ' </p>';
				$content .= '</div></div></body></html>';
				$to = $email_user;
				$subject = "Comments Unblocked - Sportshub365.com";
			
				$headers = 'MIME-Version: 1.0' . "\r\n";
				$headers .= 'Content-type:text/html; charset= iso-8859-1' . "\r\n";
				$headers .= 'From: Sportshub365<info@sportshub365.com>' . "\r\n";
				$headers .= 'Reply-To: Sportshub365<info@sportshub365.com>' . "\r\n";
				$headers .= 'X-Mailer: PHP/' . phpversion();
				$mail_status = mail($to,$subject,$content,$headers);
				
				//mail for establishment
				/*$content1 = '';
				$content1 .= '<!DOCTYPE html>';
				$content1 .= '<html lang="en">';
				$content1 .= '<head>';
				$content1 .= '<meta charset="utf-8">';
				$content1 .= '</head>';
				$content1 .= '<body style="background:#f0f0f0; margin:0; padding:0;">';
				$content1 .= '<div style="float:left; width:100%;">';
				$content1 .= '<div style="width:650px; margin:auto">';
				$content1 .= '<div style="float:left; width:100%; text-align:center; margin:30px 0 33px 0;"><img src="http://sportshub365.com/images/logo_email.png"></div>';
				$content1 .= '<div style="background:#fff; width:100%;  box-sizing:border-box; padding:0 10px; float:left;">';
				$content1 .= '<p style="color:#6f6f6f; font-size:14px; font-family:Arial, Helvetica, sans-serif; margin:0; padding:0 0 30px 0;"><br/>Your establishment comment unblocked from admin.</p>';
				$content1 .= '<p style="color:#6f6f6f; font-family:Arial, Helvetica, sans-serif; font-size:14px; line-height:18px; margin:0; padding:0 0 15px 0;">
	Please contact admin for further information!</p>';
				
				$content1 .= '<div style="width:100%; float:left; background:#131e38; height:44px; text-align:center;padding: 10px 0 0;color:#fff; font-family:Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold;">If you have any questions or would like any more information please feel free to contact us at, <br /> <a href="mailto:info@sportshub365.com" style="text-decoration:none; color:#dab503;">info@sportshub365.com</a>&nbsp;&nbsp;&nbsp;Tel: +44 208 705 0525</div>';
				
				$content1 .= ' </p>';
				$content1 .= '</div></div></body></html>';
				$to1 = $email_est;
				$subject1 = "Establishment Comment Unlocked - Sportshub365.com";
			
				$headers1 = 'MIME-Version: 1.0' . "\r\n";
				$headers1 .= 'Content-type:text/html; charset= iso-8859-1' . "\r\n";
				$headers1 .= 'From: Sportshub365<info@sportshub365.com>' . "\r\n";
				$headers1 .= 'Reply-To: Sportshub365<info@sportshub365.com>' . "\r\n";
				$headers1 .= 'X-Mailer: PHP/' . phpversion();
				$mail_status1 = mail($to1,$subject1,$content1,$headers1);*/
			}
		}
       return true;
    }
    else
    {
      return false;
    }
  }
  
  public function BlockUserInfo($id,$status,$reason)
   {
    $sql_1 ="select * from user where user_id = '".$id."' ";
	
    $query_1 = $this->db->query($sql_1);
    $result = $query_1->result();
	
    if($query_1->num_rows()>0)
    { 
	 $user_status = ($status=='block')?'no':'yes';
	  
       $sql_rem = "UPDATE user SET isActive='".$user_status."' WHERE user_id = '".$id."'";
       $query_rem = $this->db->query($sql_rem);
	   
	   if($query_rem) {
		   $email = $result[0]->email_id;
		   if($status == 'block' ) {
		    
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
				$content .= '<p style="color:#6f6f6f; font-size:14px; font-family:Arial, Helvetica, sans-serif; margin:0; padding:0 0 30px 0;"><br/>Your app account blocked from admin for below reason.</p>';
				$content .= '<p style="color:#6f6f6f; font-size:14px; font-family:Arial, Helvetica, sans-serif; margin:0; padding:0 0 30px 0;">Reason : '.$reason.'.</p>';
				$content .= '<p style="color:#6f6f6f; font-family:Arial, Helvetica, sans-serif; font-size:14px; line-height:18px; margin:0; padding:0 0 15px 0;">
	You can\'t access your account now. Please contact admin for further information!</p>';
				
				$content .= '<div style="width:100%; float:left; background:#131e38; height:44px; text-align:center;padding: 10px 0 0;color:#fff; font-family:Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold;">If you have any questions or would like any more information please feel free to contact us at, <br /> <a href="mailto:info@sportshub365.com" style="text-decoration:none; color:#dab503;">info@sportshub365.com</a>&nbsp;&nbsp;&nbsp;Tel: +44 208 705 0525</div>';
				
				$content .= ' </p>';
				$content .= '</div></div></body></html>';
				$to = $email;
				$subject = "User Blocked - Sportshub365.com";
			
				$headers = 'MIME-Version: 1.0' . "\r\n";
				$headers .= 'Content-type:text/html; charset= iso-8859-1' . "\r\n";
				$headers .= 'From: Sportshub365<info@sportshub365.com>' . "\r\n";
				$headers .= 'Reply-To: Sportshub365<info@sportshub365.com>' . "\r\n";
				$headers .= 'X-Mailer: PHP/' . phpversion();
				$mail_status = mail($to,$subject,$content,$headers);
		  }
		  else {
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
				$content .= '<p style="color:#6f6f6f; font-size:14px; font-family:Arial, Helvetica, sans-serif; margin:0; padding:0 0 30px 0;"><br/>Your app account unblocked from admin.</p>';
				$content .= '<p style="color:#6f6f6f; font-family:Arial, Helvetica, sans-serif; font-size:14px; line-height:18px; margin:0; padding:0 0 15px 0;">
	You can access your account now. Please contact admin for further information!</p>';
				
				$content .= '<div style="width:100%; float:left; background:#131e38; height:44px; text-align:center;padding: 10px 0 0;color:#fff; font-family:Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold;">If you have any questions or would like any more information please feel free to contact us at, <br /> <a href="mailto:info@sportshub365.com" style="text-decoration:none; color:#dab503;">info@sportshub365.com</a>&nbsp;&nbsp;&nbsp;Tel: +44 208 705 0525</div>';
				
				$content .= ' </p>';
				$content .= '</div></div></body></html>';
				$to = $email;
				$subject = "User Unblocked - Sportshub365.com";
			
				$headers = 'MIME-Version: 1.0' . "\r\n";
				$headers .= 'Content-type:text/html; charset= iso-8859-1' . "\r\n";
				$headers .= 'From: Sportshub365<info@sportshub365.com>' . "\r\n";
				$headers .= 'Reply-To: Sportshub365<info@sportshub365.com>' . "\r\n";
				$headers .= 'X-Mailer: PHP/' . phpversion();
				$mail_status = mail($to,$subject,$content,$headers);
			}
		}
       return true;
    }
    else
    {
      return false;
    }
  }
  

public function GetProfileDetail($user_id)
  {
    $sql_1 ="select * from establishment_info as ei join establishment_user as eu ON ei.est_user_ref=eu.id where ei.est_user_ref= '$user_id'";
  
    $query_1 =$this->db->query($sql_1);

   if($query_1->num_rows()>0)
   {
    $sp=array();
    foreach($query_1->result() as $row)
    {
	  if(!empty($row->title)) $sp['email']=$row->email;
      if(!empty($row->title)) $sp['title']=$row->title;
      if(!empty($row->address)) $sp['address']=$row->address;
	  if(!empty($row->city)) $sp['city']=$row->city;
	  if(!empty($row->zip)) $sp['zip']=$row->zip;
	  if(!empty($row->geo_lat)) $sp['geo_lat']=$row->geo_lat;
	  if(!empty($row->geo_lang)) $sp['geo_lang']=$row->geo_lang;
      if(!empty($row->short_description)) $sp['short_description']=$row->short_description;
    }
    return $sp;
   }
  }

public function GetUserDetail($user_id)
  {
    $sql_1 ="select * from user where user_id = '$user_id'";
  
    $query_1 =$this->db->query($sql_1);

   if($query_1->num_rows()>0)
   {
    $sp=array();
    foreach($query_1->result() as $row)
    {
	  if(!empty($row->firstname)) $sp['firstname']=$row->firstname;
      if(!empty($row->lastname)) $sp['lastname']=$row->lastname;
      if(!empty($row->email_id)) $sp['email']=$row->email_id;
	  if(!empty($row->gender)) $sp['gender']=$row->gender;
	  if(!empty($row->country)) $sp['country']=$row->country;
	 }
    return $sp;
   }
  }
  
  public function GetAdminUserDetail($id)
  {
    $sql_1 ="select * from admin_user where id = '$id'";
  
    $query_1 =$this->db->query($sql_1);

   if($query_1->num_rows()>0)
   {
    $sp=array();
    foreach($query_1->result() as $row)
    {
	  if(!empty($row->first_name)) $sp['firstname']=$row->first_name;
      if(!empty($row->last_name)) $sp['lastname']=$row->last_name;
      if(!empty($row->email)) $sp['email']=$row->email;
	 }
    return $sp;
   }
  }
  
  public function GetRatingDetail($user_id)
  {
    $sql_1 ="select er.created_on, ei.title, u.email_id, er.comment, er.rating, er.is_blocked, er.id from establishment_rating as er inner join establishment_info as ei on er.est_ref=ei.id inner join user as u on u.`user_id`= er.`user_ref` where er.`id` = '$user_id'";
  
    $query_1 =$this->db->query($sql_1);

   if($query_1->num_rows()>0)
   {
    $sp=array();
    foreach($query_1->result() as $row)
    {
	  if(!empty($row->title)) $sp['title']=$row->title;
      if(!empty($row->email_id)) $sp['user']=$row->email_id;
      if(!empty($row->rating)) $sp['rating']=$row->rating;
	  if(!empty($row->comment)) $sp['comment']=$row->comment;
	 }
    return $sp;
   }
  }
  
  public function GetCountry()
    {
        //$sql="SELECT * FROM `country` order by european_country desc, country_name asc";
		$sql="SELECT country_name FROM `country` order by country_name asc";
        $query=$this->db->query($sql);
        $rs=$query->result();
		foreach($rs as $key => $value) {
			$result[$value->country_name] = $value->country_name;
		}
        
		return $result;
   }
	
  public function ChangePasswordFormAttribute($values=array(),$email )
  {
    if(count($values) == 0)
    {
      $values=array('re_password'=>'Retype Pass','password'=>'Password', 'Email'=>'');
    }
    $attribute['form']=array('id'=>'signup_frm','name'=>'signup_frm');
	
	$attribute['email']=array('type' => 'email','name'=> 'email','id'=> 'email','class'=>"input name" , 'value' => trim($email), 'placeholder'=>'Email');
	
    $attribute['password']=array('type' => 'password','name'=> 'password','id'=> 'password','class'=>"password-input2" ,'placeholder'=>'Password');
    $attribute['re_password']=array('type' => 'password','name'=> 're_password','id'=> 're_password','class'=>"password-input3" ,'placeholder'=>'Retype Password' );

    $attribute['submit']=array('type' => 'submit',  'name' => 'form_submit','class'=>'change-now','value'=>'Change now');
    return $attribute;
  }

  public function ChangePasswordUserFormAttribute($values=array())
  {
    if(count($values) == 0)
    {
      $values=array('re_password'=>'Retype Pass','password'=>'Password');
    }
    $attribute['form']=array('id'=>'signup_frm','name'=>'signup_frm');
	
    $attribute['password']=array('type' => 'password','name'=> 'password','id'=> 'password','class'=>"password-input2" ,'placeholder'=>'Password');
    $attribute['re_password']=array('type' => 'password','name'=> 're_password','id'=> 're_password','class'=>"password-input3" ,'placeholder'=>'Retype Password' );

    $attribute['submit']=array('type' => 'submit',  'name' => 'form_submit','class'=>'change-now','value'=>'Change now');
    return $attribute;
  }
  
  public function GetEstInfoId($est_user_ref)
  { 
     //$ar=$this->db_query->FetchSingleInformation('establishment_info',"id","est_user_ref='$est_ref_id'");
     $sql = "select  id from establishment_info where est_user_ref= '$est_user_ref' ";
     
     $query1 = $this->db->query($sql);

     $ar = $query1->result();

      if(count($ar)>0)
      {
     ;
       return $est_info_id = $ar[0]->id;
     }
     else $est_info_id = "";
     {
     }
  }

  public function UpdateProfileInfo($arr,$est_user_ref)
  {
   if(count($arr)>0)
   {
     $user_id=$this->GetUserId($est_user_ref);
      $id=$user_id[0]->id;
    $this->db->where('est_user_ref',$id);
    $this->db->update('establishment_info',$arr);
   }
  }
  
  public function UpdateUserInfo($arr, $user_ref)
  {
   if(count($arr)>0)
   {
	  // print_r($user_ref); die;
     $this->db->where('user_id',$user_ref);
     $this->db->update('user',$arr);
   }
  }
  
   public function UpdateAdminUserInfo($arr, $user_ref)
  {
   if(count($arr)>0)
   {
	  // print_r($user_ref); die;
     $this->db->where('id',$user_ref);
     $this->db->update('admin_user',$arr);
   }
  }
  
   public function UpdateRatingInfo($arr, $rat_ref)
  {
   if(count($arr)>0)
   {
	  // print_r($user_ref); die;
     $this->db->where('id',$rat_ref);
     $this->db->update('establishment_rating',$arr);
   }
  }
  
  public function UpdateUserPassword($arr,$user_ref)
  {
    if(count($arr)>0)
    {
      $this->db->where('user_id',$user_ref);
  	 $this->db->update('user',$arr);
  	}
  }
  
    public function UpdateAdminUserPassword($arr,$user_ref)
  {
    if(count($arr)>0)
    {
      $this->db->where('id',$user_ref);
  	 $this->db->update('admin_user',$arr);
  	}
  }
   
  public function GetUserId($est_user_ref)
    {

      $sql="select id from establishment_user where id='".$est_user_ref."' ";
      $query=$this->db->query($sql);
       $rs=$query->result(); 
       
     
      return $rs;
    }

  public function UpdateSubscription($arr,$est_user_ref)
  {
    if(count($arr)>0)
    {
	   $email=$this->GetUseremail($est_user_ref);
	   $email_id = $email[0]->email;
	   $this->db->where('email',$email_id);
	   $this->db->update('establishment_user',$arr);
  	}
  }
  
  public function UpdateEmail($arr,$est_ref_id)
  {
	$q="SELECT * FROM establishment_user WHERE `email` = '".$arr['email']."' LIMIT 1";
    $query = $this->db->query($q) ;
        // checking record exist in database 
        if($query->num_rows() > 0)
        { 
			$msg = 'Already registered with this email!';
		}
		else {
			$this->db->where('id',$est_ref_id);
    		$this->db->update('establishment_user',$arr);
			$msg = 'Email changed sucessfully.';
		}
	 return $msg;	
  }


public function GetUseremail($est_user_ref)
    {

      $sql="select email from establishment_user where id='".$est_user_ref."' ";
      $query=$this->db->query($sql);
       $rs=$query->result(); 
     
      return $rs;
    }

  public function GetEstablishmentCardDetail($est_ref_id)
  { 
    
    //return $this->db_query->FetchSingleInformation('establishment_card_details','card_number',"establishment_ref='$est_ref_id'"); 
     $sql = "select  card_number from  establishment_card_details where establishment_ref='$est_ref_id' ";
     $query = $this->db->query($sql);
    
  }

   /*public function CheckPremium($est_ref_id)
  {
           
    $sql_1 ="select  valid_to  from establishment_account_history where establishment_ref= '$est_ref_id' order_by('valid_to','desc') ";
  
    $query_1 =$this->db->query($sql_1);

    //$query=$this->db->select('valid_to')->from('establishment_account_history')->where('establishment_ref', $est_ref_id)->order_by('valid_to','desc')->get();

   
    if($query->num_rows()>0)
    {
     $row=$query->result()[0];
     return $row->valid_to;
    }

  }*/

 
  public function GetEstablishmentFacilities($id)
  {
    $sql="select est_facility_ref from establishment_facility where est_ref='$id' and deleted_on is NULL";
    $query=$this->db->query($sql);

    $result=$query->result_array();

    $ids = array();
    foreach ($result as $row) {
    $ids[] = $row['est_facility_ref'];
    }
    return $ids;
 
  }
  public function checkWeek($est_ref,$week_ref)
  {
    $sql = "select id from establishment_opening_hours where est_ref='$est_ref' and week_ref='$week_ref'";
    $query=$this->db->query($sql);
    $result = $query->result();
    return $result;
  }
  public function checkhappyWeek($est_ref,$week_ref)
  {
   $sql = "select id from establishment_happy_hours where est_ref='$est_ref' and week_ref='$week_ref'";
    $query=$this->db->query($sql);
    $result = $query->result();
    return $result;
  }

   public function WeekConstantList($est_info_id)
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
   public function WeekConstantHappyHours($est_info_id)
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
        //$week_id=$this->db_query->FetchSingleInformation('establishment_happy_hours',"from_time~to_time~is_active","est_ref='$est_ref_id' and week_ref='$row->id'");
        $i++; 
      }
      return $week;
    }
   // $array= $this->db_query->FetchInformation('week_constant',"","1=1");
  } 

   public function ProfileFormAttribute($values=array(),$values_profile)
  {
    $values=$values_profile;
    if(count($values) == 0)
    {
      $values=array('title'=>'','address'=>'','short_description'=>'');
    }
  if(empty($values['title']))$values['title']='';
    $attribute['form']=array('id'=>'profile_frm','name'=>'profile_frm');

  if(!empty($values['address']))$values['address'] = trim($values['address']);else $values['address'] ='';
  if(!empty($values['short_description']))$values['short_description'] = trim($values['short_description']);else $values['short_description']='';

    $attribute['title']=array('name'=> 'title','id'=> 'title','value' => trim($values['title']),'class'=>"input name" , 'placeholder'=>"Title / name at Venue:");


    $attribute['address']=array('type' => 'address','name'=> 'address','id'=> 'address','value' => $values['address'],'class'=>"input" , 'placeholder'=>"Address:");

    $attribute['short_description']=array('name'=> 'short_description','id'=> 'short_description','value' => $values['short_description'],'class'=>"textarea" , 'placeholder'=>"Short description:" );
 
    $attribute['submit']=array('type' => 'submit',  'name' => 'form_submit','class'=>'change-now','value'=>'Save');
    return $attribute;
  }


public function GetProDefaultPic($est_info_id)
  { 
    $sql_1 =  "select * from establishment_profile_image where est_ref='".$est_info_id."' and default_image='1'";
    $query_1=$this->db->query($sql_1);
      if($query_1->num_rows()>0){
     $row=$query_1->result()[0];
      return $row->picture;
    }
  }

  public function UploadFormAttribute($values=array())
  {
   if(count($values) == 0)
   {
    $values=array('picture'=>'');
   }$attribute['form']=array('id'=>'contact_frm','name'=>'contact_frm','onSubmit'=>'return true;');
  
   $attribute['picture']=array('name'=> 'picture','id'=> 'picture','value'=>'','class'=>'upload');
   if(isset($values['current_picture']) and !empty($values['current_picture']))
   {
    $attribute['current_picture']=$values['current_picture'];
   }
   
   $attribute['submit']=array('type' => 'submit', 'class' => 'upload-img', 'name' => 'form_submit','value'=>'Upload','id'=>'form_submit');
   //sprint_r($attribute);
   return $attribute;
  }

  public function UpdateProfilePicture($arr,$est_ref_id)
  {
    
  $this->db->where('est_user_ref',$est_ref_id);
    $this->db->update('establishment_info',$arr);
  
  }

public function UpdateCardFormAttribute($values_card=array())
  {
     if(count($values_card) == 0)
     {
      $values_card=array('first_name'=>'First Name:','last_name'=>'Last Name:','card_number'=>'Card Number:','exp_month'=>'Expiries Month:','exp_year'=>'Expiries Year:','code'=>'Code:');
     }
     $attribute['form']=array('id'=>'update_card_frm','name'=>'update_card_frm','onSubmit'=>'return ValidateCardForm();');
   
     $attribute['first_name']=array('name'=> 'first_name','id'=> 'first_name','value' => trim($values_card['first_name']),'class'=>"popup-input" , 'onfocus'=>"if (this.value == 'First Name:') {this.value = '';}" ,'onblur'=>"if (this.value == '') {this.value = 'First Name:';}");

     $attribute['last_name']=array('name'=> 'last_name','id'=> 'last_name','value' => trim($values_card['last_name']),'class'=>"popup-input" , 'onfocus'=>"if (this.value == 'Last Name:') {this.value = '';}" ,'onblur'=>"if (this.value == '') {this.value = 'Last Name:';}");

     $attribute['card_number']=array('name'=> 'card_number','id'=> 'card_number','value' => trim($values_card['card_number']),'class'=>"popup-input" , 'onfocus'=>"if (this.value == 'Card Number:') {this.value = '';}" ,'onblur'=>"if (this.value == '') {this.value = 'Card Number:';}");

      $attribute['exp_month']=array('name'=> 'exp_month','id'=> 'exp_month','value' => trim($values_card['exp_month']),'class'=>"popup-input" , 'onfocus'=>"if (this.value == 'Expiries Month:') {this.value = '';}" ,'onblur'=>"if (this.value == '') {this.value = 'Expiries Month:';}");

      $attribute['exp_year']=array('name'=> 'exp_year','id'=> 'exp_year','value' => trim($values_card['exp_year']),'class'=>"popup-input" , 'onfocus'=>"if (this.value == 'Expiries Year:') {this.value = '';}" ,'onblur'=>"if (this.value == '') {this.value = 'Expiries Year:';}");

       $attribute['code']=array('name'=> 'code','id'=> 'code','value' => trim($values_card['code']),'class'=>"popup-input" , 'onfocus'=>"if (this.value == 'Code:') {this.value = '';}" ,'onblur'=>"if (this.value == '') {this.value = 'Code:';}");

     $attribute['submit']=array('type' => 'submit',  'name' => 'form_submit','class'=>'popup-button','value'=>'Update Now');
     return $attribute;
  }

  public function GetCardDetailForUpgrade($id)
  {

   $query=$this->db->get_where('establishment_card_details', array('est_user_ref' => $id));
   if($query->num_rows()>0)
   {
    $sp=array();
    foreach($query->result() as $row)
    {
      $sp['first_name']=$row->first_name;
      $sp['last_name']=$row->last_name;
      $sp['card_number']=$row->card_number;
      $sp['exp_month']='';
      $sp['exp_year']='';
      $sp['code']='';
    }
    return $sp;
   }
  }



public function UpgradeCardFormAttribute($values_upgrade_card=array())
  {
    if(count($values_upgrade_card) == 0)
    {
    $values_upgrade_card=array('first_name'=>'First Name:','last_name'=>'Last Name:','card_number'=>'Card Number:','exp_month'=>'Expiries Month:','exp_year'=>'Expiries Year:','code'=>'Code:');
    }

    $attribute['form']=array('id'=>'upgrade_card_frm','name'=>'upgrade_card_frm','onSubmit'=>'return ValidateUpgradeCardForm();');


    $attribute['first_name']=array('name'=> 'first_name','id'=> 'upgrade_first_name','value' => trim($values_upgrade_card['first_name']),'class'=>"popup-input" , 'onfocus'=>"if (this.value == 'First Name:') {this.value = '';}" ,'onblur'=>"if (this.value == '') {this.value = 'First Name:';}");

    $attribute['last_name']=array('name'=> 'last_name','id'=> 'upgrade_last_name','value' => trim($values_upgrade_card['last_name']),'class'=>"popup-input" , 'onfocus'=>"if (this.value == 'Last Name:') {this.value = '';}" ,'onblur'=>"if (this.value == '') {this.value = 'Last Name:';}");

    $attribute['card_number']=array('name'=> 'card_number','id'=> 'upgrade_card_number','value' => trim($values_upgrade_card['card_number']),'class'=>"popup-input" , 'onfocus'=>"if (this.value == 'Card Number:') {this.value = '';}" ,'onblur'=>"if (this.value == '') {this.value = 'Card Number:';}");

    $attribute['exp_month']=array('name'=> 'exp_month','id'=> 'upgrade_exp_month','value' => trim($values_upgrade_card['exp_month']),'class'=>"popup-input" , 'onfocus'=>"if (this.value == 'Expiries Month:') {this.value = '';}" ,'onblur'=>"if (this.value == '') {this.value = 'Expiries Month:';}");

    $attribute['exp_year']=array('name'=> 'exp_year','id'=> 'upgrade_exp_year','value' => trim($values_upgrade_card['exp_year']),'class'=>"popup-input" , 'onfocus'=>"if (this.value == 'Expiries Year:') {this.value = '';}" ,'onblur'=>"if (this.value == '') {this.value = 'Expiries Year:';}");

    $attribute['code']=array('name'=> 'code','id'=> 'upgrade_code','value' => trim($values_upgrade_card['code']),'class'=>"popup-input" , 'onfocus'=>"if (this.value == 'Code:') {this.value = '';}" ,'onblur'=>"if (this.value == '') {this.value = 'Code:';}");

    $attribute['submit']=array('type' => 'submit',  'name' => 'form_submit','class'=>'popup-button','value'=>'Upgrade to premium');
    return $attribute;
  }
  
  public function AddEventFormAttribute($values=array())
  {
    if(count($values) == 0)
    {
    $values=array('title'=>'','event_date'=>'','event_time'=>'','duration'=>'');
    }
    $attribute['form']=array('id'=>'signup_frm','name'=>'signup_frm', 'onSubmit'=>'return ValidateEventForm();');


    $attribute['title']=array('name'=> 'title','id'=> 'title_event','value' => trim($values['title']),'class'=>"popup-input" , 'placeholder'=>"this is the event title / description");


    $attribute['event_date']=array('name'=> 'event_date','id'=> 'event_date','value' => trim($values['event_date']),'class'=>"popup-input eventcreatedate" , 'placeholder'=>"Date:dd-mm-yyyy");

    $attribute['event_time']=array('name'=> 'event_time','id'=> 'event_time','value' => trim($values['event_time']),'class'=>"popup-input eventstarttime" , 'placeholder'=>"Time:hh:mm am/pm");

     $attribute['duration']=array('name'=> 'duration','id'=> 'duration','value' => trim($values['duration']),'class'=>"popup-input" , 'placeholder'=>"Duration:hh");

    $attribute['submit']=array('type' => 'submit',  'name' => 'form_submit','class'=>'popup-button','value'=>'Add now');
     $attribute['update']=array('type' => 'submit',  'name' => 'form_submit','class'=>'popup-button','value'=>'Update now');
    return $attribute;
  }
  
  public function AddOfferFormAttribute($values=array())
  {
    if(count($values) == 0)
    {
    $values=array('title'=>'','description'=>'','price_or_discount'=>'','promo_code'=> '', 'isactive'=>'1');
    }
    if($values['isactive']==1) $checked="checked";
    else $checked="";
    $attribute['form']=array('id'=>'signup_frm','name'=>'signup_frm', 'onSubmit'=>'return ValidateOfferForm();');


    $attribute['title']=array('name'=> 'title','id'=> 'title_offer','value' => trim($values['title']),'class'=>"popup-input" , 'placeholder'=>"Title:");


    $attribute['description']=array('name'=> 'description','id'=> 'description','value' => trim($values['description']),'class'=>"popup-input" , 'placeholder'=>"Description:");

    $attribute['price_or_discount']=array('name'=> 'price_or_discount','id'=> 'price_or_discount','value' => trim($values['price_or_discount']),'class'=>"popup-input" , 'placeholder'=>"Price or discount:");

	$attribute['promo_code']=array('name'=> 'promo_code','id'=> 'promo_code','value' => trim($values['promo_code']),'class'=>"popup-input" , 'placeholder'=>"Promo Code:");

    $attribute['isactive']=array('name'=> 'isactive','value' => trim($values['isactive']),'checked'=>$checked );
        

    $attribute['submit']=array('type' => 'submit',  'name' => 'form_submit','class'=>'popup-button','value'=>'Add now');
    $attribute['update']=array('type' => 'submit',  'name' => 'form_submit','class'=>'popup-button','value'=>'Update now');
    return $attribute;
  }
  
   public function GetEstablishmentFacilitydetail($id, $fecid)
  {
    $sql="select value from establishment_facility where est_ref='$id' and est_facility_ref='$fecid' and deleted_on is NULL";
    $query=$this->db->query($sql);

    if($query->num_rows()>0)
    {
      $row=$query->result()[0];
      return $row->value;
    }
  }

	public function InsertOpeningHours($arr)
	  {
		$ids=$this->checkWeek($arr['est_ref'],$arr['week_ref']);
		if(count($ids)==1)
		{
	  $sql_update_open_hors =  "UPDATE establishment_opening_hours SET from_time='".$arr['from_time']."', to_time='".$arr['to_time']."' where est_ref='".$arr['est_ref']."' and week_ref='".$arr['week_ref']."'";
	  $query=$this->db->query($sql_update_open_hors);
		}
		else
		{
		  $this->db->insert('establishment_opening_hours',$arr);
		}
		$this->db->where('from_time','');
		$this->db->delete('establishment_opening_hours');
	
	  }
	
	  public function UpdateCardDetail($data,$est_user_id)
	  {
		 
		$sql="select id from establishment_card_details  where est_user_ref='$est_user_id'";
		$query=$this->db->query($sql);
		
		$row=$query->result();
		if($query->num_rows()>0)
		{ 
		  $this->db->where('est_user_ref',$est_user_id);
		  $this->db->update('establishment_card_details', $data);
		}
		else $this->db->insert('establishment_card_details', $data);
	  }


   public function InsertHappyHours($arr)
  {
    
    $ids=$this->checkhappyWeek($arr['est_ref'],$arr['week_ref']);
    if(count($ids)==1)
    {
     
  $sql_update_open_hors =  "UPDATE establishment_happy_hours SET from_time='".$arr['from_time']."', to_time='".$arr['to_time']."', is_active = '".$arr['is_active']."' where est_ref='".$arr['est_ref']."' and week_ref='".$arr['week_ref']."'";
  $query=$this->db->query($sql_update_open_hors);
      
    }
    else
    {
      $this->db->insert('establishment_happy_hours',$arr);
    }
    $this->db->where('from_time','');
    $this->db->delete('establishment_happy_hours');

  }
  
 public function InsertFacility($data,$est_ref_id)
  {    
    $this->db->where('est_ref', $est_ref_id);
    $this->db->delete('establishment_facility'); 

    $this->db->insert_batch('establishment_facility', $data);

  }

public function GetCardDetail($id)
 {

  $query=$this->db->get_where('establishment_card_details', array('est_user_ref' => $id));
  if($query->num_rows()>0)
  {
    $sp=array();
    foreach($query->result() as $row)
    {
      $sp['first_name']=$row->first_name;
      $sp['last_name']=$row->last_name;
      $sp['card_number']=$row->card_number;
      $sp['exp_month']=$row->exp_month;
      $sp['exp_year']=$row->exp_year;
      $sp['code']=$row->code;
    }
    return $sp;
  }
 }


public function CheckPremium($est_ref_id)
  {
    $query=$this->db->select('valid_to')->from('establishment_account_history')->where('establishment_ref', $est_ref_id)->order_by('valid_to','desc')->get();

    if($query->num_rows()>0)
    {
     $row=$query->result()[0];
     return $row->valid_to;
    }

  }

  public function upgateGallery($est_info_id, $defaultimage){

  $sql =  "select * from establishment_profile_image where est_ref='".$est_info_id."'";
    $query=$this->db->query($sql);
    //$q = $query->result();
   //print_r($q);
   // die;

    if($query->num_rows()>0)
    {
        $sql_1_2 =  "UPDATE establishment_profile_image SET image_temp='0' where est_ref='".$est_info_id."'";
        $query_1_2=$this->db->query($sql_1_2);
        
        $sql_1_3 =  "UPDATE establishment_profile_image SET default_image='0' where est_ref='".$est_info_id."'";
        $query_1_3=$this->db->query($sql_1_3);
    /*foreach($query->result() as $row)
      {
      $file = $row->picture;
      $image_ref = $row->image_ref;
      $createdate = $row->created_date;
      if($defaultimage == $image_ref){
        $defaultimag = $defaultimage;
      }
      else
      $defaultimag= 0; 
      //if(empty($defaultimag))$defaultimag=$image_ref;
      $sql_1 =  "select * from establishment_profile_image where est_ref='".$est_info_id."'";
      $query_1=$this->db->query($sql_1);
        if($query_1->num_rows()>0){
          echo $sql_2_1 =  "DELETE FROM establishment_profile_image WHERE est_ref='".$est_info_id."'";
          $query_2_1=$this->db->query($sql_2_1);
        }
          $sql_2 = "INSERT INTO establishment_profile_image (`est_ref`, `picture`, `created_date`) VALUES ('".$est_info_id."', '".$file."', '".$createdate."')";  
          $query_2=$this->db->query($sql_2);

      
      $sql_1 =  "DELETE from establishment_profile_image_temp where est_ref='".$est_info_id."' and image_ref='".$image_ref."'";
      $query_1=$this->db->query($sql_1);
      
    }*/
       $sql_1_2_1 =  "UPDATE establishment_profile_image SET default_image='1' where est_ref='".$est_info_id."' and id='".$defaultimage."'";
      $query_1_2_1=$this->db->query($sql_1_2_1);
    return true;

  }else
  {
    return false;
    /*if(!empty($defaultimage)){
     $sql_2 =  "UPDATE establishment_profile_image SET default_image='0' where est_ref='".$est_info_id."'";
    $query_2=$this->db->query($sql_2);

     $sql_2_1 =  "UPDATE establishment_profile_image SET default_image='1' where est_ref='".$est_info_id."' and image_ref='".$defaultimage."'";
    $query_2_1=$this->db->query($sql_2_1);
    }
//exit;*/
  }
    
  }

  public function getProfileGallery($est_info_id){
    $sql_1 =  "select * from establishment_profile_image where est_ref='".$est_info_id."'";
    $query_1=$this->db->query($sql_1);
      if($query_1->num_rows()>0){
      $profile=array();
      $i=0;
     foreach($query_1->result() as $row)
        {
        $profile[$i]['id']=$row->id;
        $profile[$i]['picture']=$row->picture;
        $profile[$i]['image_ref']=$row->image_ref;
        $profile[$i]['default_image']=$row->default_image;
         $i++;
      }
      return $profile;
    }
    else{return '';}
    
  }

  public function removeGalleryImage($imageID, $est_info_id){
     $sql_1 =  "select * from establishment_profile_image where id='".$imageID."' and est_ref='".$est_info_id."'";
    $query_1=$this->db->query($sql_1);
      if($query_1->num_rows()>0){
      $sql_rem =  "delete from establishment_profile_image where id='".$imageID."' and est_ref='".$est_info_id."'";
      $query_rem = $this->db->query($sql_rem);
      return true;
    }
    else{return false;}
    
  }

  public function CityCountrySearchFormAttribute($values=array())
  {
     if(count($values) == 0)
     {
      $values=array('city'=>'City','country'=>'Country','search_text'=>'Search');
     }
     $fun="SearchResultAdmin('1','20',date_from.value,date_end.value,search_text.value);";
     $attribute['form']=array('id'=>'search_frm2','name'=>'search_frm2');
     
     $attribute['city']=array('name'=> 'city','id'=> 'datepicker-example3','value' => trim($values['city']),'class'=>"date-input" , 'onfocus'=>"if (this.value == 'City') {this.value = '';}" ,'onblur'=>"if (this.value == '') {this.value = 'City';}");

     $attribute['country']=array('name'=> 'country','id'=> 'datepicker-example4','value' => trim($values['country']),'class'=>"date-input" , 'onfocus'=>"if (this.value == 'Country') {this.value = '';}" ,'onblur'=>"if (this.value == '') {this.value = 'Country';}");

     $attribute['search_text']=array('name'=> 'search_text','id'=> 'search_text','value' => trim($values['search_text']),'class'=>"search-input" , 'onfocus'=>"if (this.value == 'Search') {this.value = '';}" ,'onblur'=>"if (this.value == '') {this.value = 'Search';}");
     
     $attribute['submit']=array('type' => 'button',  'name' => 'form_submit','class'=>'search-button','value'=>'',
      'onclick'=>$fun);
     return $attribute;
  }

  public function RatingsComment($from_date='',$to_date='',$search_text='',$status='',$limit='') {
	  
	   $where="";
     
		if(!empty($search_text) && $search_text!='Search')
		  {
			  $where.=" and (ei.title like '%$search_text%')";
		  }
		if($status!='')
		  {
			  $where.=" and er.is_blocked IN ($status)";
		  }  
	  
	   if(!empty($from_date) && $from_date!='Date From'){
		   $from_date = str_replace("/","-", $from_date);$from_date=date('Y-m-d h:i:s',strtotime($from_date));
		   $where.=" and er.created_on >='$from_date'";
       }

       if(!empty($to_date) && $to_date!='Date End'){
           $to_date = str_replace("/","-", $to_date);$to_date= date('Y-m-d h:i:s',strtotime($to_date));
           $where.=" and er.created_on <='$to_date'";
       }
	   //echo $from_date.'_'.$to_date; duie;
      if($from_date == $to_date){
          $from_date = str_replace("/","-", $from_date);$from_date=date('Y-m-d h:i:s',strtotime($from_date));
          $where.=" or er.created_on ='$from_date'";
      }
	  $sql="select er.created_on, ei.title, u.email_id, er.comment, er.rating, er.is_blocked, er.id from establishment_rating as er inner join establishment_info as ei on er.est_ref=ei.id inner join user as u on u.`user_id`= er.`user_ref` $where order by er.created_on DESC $limit";
	  //echo $sql;  
      $query=$this->db->query($sql);
    
      $rc = array();
      $row = $query->result();
      if($query->num_rows()>0)
       {
	   		return $row;
	   }
	   else {
		 	return $rc; 
	   }
  }  
  public function GetSliderData($id='') {
	  
	  $cond = '';
	  if($id!='') $cond.="where id ='$id'";
	  
	  $sql = "select * from slider $cond order by created_on DESC";
	  
	  $query = $this->db->query($sql);
	 
	  
	  if($query->num_rows()>0)
       {
		$sp=array();  $i=0;
		foreach($query->result() as $row)
		{
		  if(!empty($row->id)) $sp[$i]['id']=$row->id;
		  if(!empty($row->slidername)) $sp[$i]['slidername']=$row->slidername;
		  if(!empty($row->url)) $sp[$i]['url']=$row->url;
		  if(!empty($row->desc)) $sp[$i]['desc']=$row->desc;
		  if(!empty($row->image)) $sp[$i]['image']=$row->image;
		  if(!empty($row->created_on)) $sp[$i]['created_on']=$row->created_on;
		  $i++;
		 }
		return $sp;
	   }
	   else {
		   	 $row = array();
		 	return $row; 
	   }
  }
  
  public function AddSliderData($arr) {
	  
	$this->db->insert('slider',$arr);
  }
  
  public function UpdateSliderData($data, $slider_ref) { 
  	
	if(count($data)>0) {
		$this->db->where('id',$slider_ref);
		$this->db->update('slider', $data);
	}
  }
  
}
?>