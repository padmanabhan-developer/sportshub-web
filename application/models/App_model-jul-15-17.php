<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 class App_model extends CI_Model
 {
  function __construct()
  {
   parent ::__construct();  
   
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
  
  
public function AdminLoginFormAttribute($values=array())
  {
     if(count($values) == 0)
     {
      $values=array('email'=>'Mail','password'=>'');
     }
     $attribute['form']=array('id'=>'signup_frm','name'=>'signup_frm');
     
     $attribute['email']=array('name'=> 'email','id'=> 'email','value' => trim($values['email']),'class'=>"mail-input" , 'onfocus'=>"if (this.value == 'Mail') {this.value = '';}" ,'onblur'=>"if (this.value == '') {this.value = 'Mail';}");

     $attribute['password']=array('type'=>'password','name'=> 'password','id'=> 'password','value' => trim($values['password']),'class'=>"password-input" , 'placeholder'=>'Password');
     
     $attribute['submit']=array('type' => 'submit',  'name' => 'form_submit','class'=>'signup-button','value'=>'sign in');
     return $attribute;
  }

  public function LoginFormAttribute($values=array())
  {
     if(count($values) == 0)
     {
      $values=array('email'=>'Mail','password'=>'');
     }
     $attribute['form']=array('id'=>'signup_frm','name'=>'signup_frm');
     
     $attribute['email']=array('name'=> 'email','id'=> 'email','value' => trim($values['email']),'class'=>"mail-input" , 'onfocus'=>"if (this.value == 'Mail') {this.value = '';}" ,'onblur'=>"if (this.value == '') {this.value = 'Mail';}");

     $attribute['password']=array('type'=>'password','name'=> 'password','id'=> 'password','value' => trim($values['password']),'class'=>"password-input" , 'placeholder'=>'Password');
     
     $attribute['submit']=array('type' => 'submit',  'name' => 'form_submit','class'=>'signup-button','value'=>'sign in');
     return $attribute;
  }
  public function ForgotFormAttribute($values=array())
  {
     if(count($values) == 0)
     {
      $values=array('email'=>'Mail','password'=>'');
     }
     $attribute['form']=array('id'=>'signup_frm','name'=>'signup_frm');
     
     $attribute['email']=array('name'=> 'email','id'=> 'email','value' => trim($values['email']),'class'=>"mail-input" , 'onfocus'=>"if (this.value == 'Mail') {this.value = '';}" ,'onblur'=>"if (this.value == '') {this.value = 'Mail';}");

     
     $attribute['submit']=array('type' => 'submit',  'name' => 'form_submit','class'=>'signup-button','value'=>'generate');
     return $attribute;
  }

  public function SearchFormAttribute($values=array())
  {
     if(count($values) == 0)
     {
      $values=array('date_from'=>'Date From','date_end'=>'Date End','search_text'=>'Search');
     }
     $fun="SearchResult(path.value,'1','20',date_from.value,date_end.value,search_text.value,'');";
     $attribute['form']=array('id'=>'search_frm2','name'=>'search_frm2');
     
     $attribute['date_from']=array('name'=> 'date_from','id'=> 'datepicker-example3','value' => trim($values['date_from']),'class'=>"date-input", 'tabindex'=>"1", 'onfocus'=>"if (this.value == 'Date From') {this.value = '';}" ,'onblur'=>"if (this.value == '') {this.value = 'Date From';}");

     $attribute['date_end']=array('name'=> 'date_end','id'=> 'datepicker-example4','value' => trim($values['date_end']),'class'=>"date-input" , 'tabindex'=>"2", 'onfocus'=>"if (this.value == 'Date End') {this.value = '';}" ,'onblur'=>"if (this.value == '') {this.value = 'Date End';}");

     $attribute['search_text']=array('name'=> 'search_text','id'=> 'search_text','value' => trim($values['search_text']),'class'=>"date-input" ,  'tabindex'=>"3", 'onfocus'=>"if (this.value == 'Search') {this.value = '';}" ,'onblur'=>"if (this.value == '') {this.value = 'Search';}");
     
     $attribute['submit']=array('type' => 'button',  'tabindex'=>"4", 'name' => 'form_submit','class'=>'search-button','value'=>'',
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
  
  public function CheckUser($email,$password)
  {

    if(!empty($email) and !empty($password))
    {

      // checking email id not empty
   
        $q="SELECT user_id FROM user WHERE `email_id` = '$email' LIMIT 1";
        $query = $this->db->query($q) ;
        // checking record exist in database 
        if($query->num_rows() > 0)
        {
          
          $query = $this->db->query("SELECT user_id FROM user WHERE `email_id` = '$email' AND password = '".$password."' LIMIT 1", $this->db);
          if($query->num_rows() > 0)
          {
            $row = $query->result();                
            $row=$row[0];
            if(!empty( $row->user_id )){ return $msg="success"; }
            else return $msg="Invalid credettial";
          }
          else{return $msg="Password is wrong";}
        }
        else{return $msg="Email does not exist"; }
    }
  }
  public function ResetUser($email,$randpwd, $encypwd)
  {

    if(!empty($email))
    {

      // checking email id not empty
   
        $q="SELECT * FROM user WHERE `email_id` = '$email' LIMIT 1";
        $query = $this->db->query($q) ;
        // checking record exist in database 
        if($query->num_rows() > 0)
        {
		  
          $query1 = $this->db->query("UPDATE user SET password = '".$encypwd."' WHERE `email_id` = '$email'", $this->db);
          if($query1){
			  
				$row = $query->result(); 
				$row=$row[0];
				/*$this->load->library('email');

				$this->email->from('vs@createassociates.com', 'No reply');
				$this->email->to($email);
				$newhtml = 'Helo <br> Your New password for Sh365@createassociates.com is :'.$randpwd;
				$newhtml .= '<br><br><br><br>Please dont forget to update your password once you login.';
				$this->email->subject('You New password for Sh365@createassociates.com');
				$this->email->message($newhtml);
				
				$this->email->send();*/
				$content = '';
				$content .= '<!DOCTYPE html>';
				$content .= '<html lang="en">';
				$content .= '<head>';
				$content .= '<meta charset="utf-8">';
				$content .= '</head>';
				$content .= '<body style="background:#f0f0f0; margin:0; padding:0;">';
				$content .= '<div style="float:left; width:100%;">';
				$content .= '<div style="width:600px; margin:auto">';
				$content .= '<div style="float:left; width:100%; text-align:center; margin:30px 0 33px 0;"><img src="http://sportshub365.com/images/logo_email.png"></div>';
				$content .= '<div style="background:#fff; width:100%; text-align:center; box-sizing:border-box; padding:0 50px; float:left;">';
				$content .= '<h2 style="color:#131e37; font-size:28px; font-family:Arial, Helvetica, sans-serif; text-transform:uppercase; margin:0; padding:40px 0;">HERE IS YOUR NEW PASSWORD</h2>';
				$content .= '<h3 style="color:#c8a50a; font-size:18px; font-family:Arial, Helvetica, sans-serif; margin:0; padding:0 0 30px 0;">Your new temporary password is: <strong>'.$randpwd.'</strong></h3>';
				$content .= '<a href="http://sportshub365.com/establishment/login" target="_blank" style="text-decoration:none; color:#fff; display:inline-block; font-family:Arial, Helvetica, sans-serif; font-size:13px; text-transform:uppercase; width:308px; height:42px; line-height:42px; text-align:center; padding:0; margin:0 0 34px 0; background:#1c6cd9;-webkit-border-radius: 10px;
				-moz-border-radius: 10px;
				border-radius: 10px;">LOGIN TO MY ACCOUNT</a>';
				$content .= '<p style="color:#6f6f6f; font-family:Arial, Helvetica, sans-serif; font-size:11px; line-height:14px; margin:0; padding:0 0 75px 0;">After you have login to your account you can change the password to your personal password or keep this. Please remember to make a unique password that includes both letters and numbers.</p>';
				$content .= '</div>';
				$content .= '<div style="width:100%; float:left; background:#131e38; height:58px; text-align:center; line-height:58px; color:#fff; font-family:Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold;">Visit us online <a href="http://www.sportshub365.com" target="_blank"  style="text-decoration:none; color:#dab503;">www.sportshub365.com</a> or send a mail to <a href="mailto:info@sportshub365.com" style="text-decoration:none; color:#dab503;">info@sportshub365.com</a></div>';
				$content .= '</div> </div></body></html>';
				$to = $email;
				$subject = "New password for Sportshub365.com";
			
				$headers = 'MIME-Version: 1.0' . "\r\n";
				$headers .= 'Content-type:text/html; charset= iso-8859-1' . "\r\n";
				$headers .= 'From: Sportshub365<info@sportshub365.com>' . "\r\n";
				$headers .= 'Reply-To: Sportshub365<info@sportshub365.com>' . "\r\n";
				$headers .= 'X-Mailer: PHP/' . phpversion();
				mail($to,$subject,$content,$headers);
			  return $msg="success-".$randpwd; 
			  
		  }

        }
        else{return $msg="Email does not exist"; }
    }
  }
 public function CheckUserForFacebook($email)
  {

    if(!empty($email)){

      // checking email id not empty

    
        $q="SELECT id FROM establishment_user WHERE `email` = '$email' LIMIT 1";
        $query = $this->db->query($q) or die(var_dump($query));
        
        // checking record exist in database 
        if($query->num_rows() > 0)
        {
          
         return false;
        }
        else{
          return true;
        }
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
  
 public function UpdateUserInfo($arr, $user_ref)
  {
   if(count($arr)>0)
   {
	  // print_r($user_ref); die;
     $this->db->where('user_id',$user_ref);
     $this->db->update('user',$arr);
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
    
  public function GetUserId($email)
    {

      $sql="select user_id from user where email_id='".$email."' ";
      $query=$this->db->query($sql);
      $rs=$query->result();
     
      return $rs;
    }
 public function UpdateProfileInfo($arr,$email)
  {
  
   if(count($arr)>0)
   {
     $user_id=$this->GetUserId($email);
      $id=$user_id[0]->id;
    $this->db->where('est_user_ref',$id);
    $this->db->update('establishment_info',$arr);
   }
  }

   public function SignupFormAttribute($values=array())
  {
    if(count($values) == 0)
    {
    $values=array('re_password'=>'','email'=>'Mail','password'=>'');
    }
    $attribute['form']=array('id'=>'signup_frm','name'=>'signup_frm');


    $attribute['email']=array('name'=> 'email','id'=> 'email','value' => trim($values['email']),'class'=>"mail-input" , 'onfocus'=>"if (this.value == 'Mail') {this.value = '';}" ,'onblur'=>"if (this.value == '') {this.value = 'Mail';}");


    $attribute['password']=array('type' => 'password','name'=> 'password','id'=> 'password','value' => trim($values['password']),'class'=>"password-input2",'placeholder'=>'Password');
    $attribute['re_password']=array('type' => 'password','name'=> 're_password','id'=> 're_password','value' => trim($values['re_password']),'class'=>"password-input3" ,'placeholder'=>'Retype Pass');

    $attribute['submit']=array('type' => 'submit',  'name' => 'form_submit','class'=>'signup-button','value'=>'sign up');
    return $attribute;
  }
  
 
  public function ChangePasswordFormAttribute($values=array())
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
  
  public function isExist($email)
  {
    $query=$this->db->get_where('establishment_subscription_free', array('email' => $email));
    if($query->num_rows()==0)
    {
      return FALSE;
    }
    return TRUE;
  }
   public function checkExstingUser($email)
  {
    $query=$this->db->get_where('user', array('email_id' => $email));
    if($query->num_rows()==0)
    {
      return FALSE;
    }
    return TRUE;
  }

  public function RegisterSubscription($data)
  {
   $this->db->insert('user', $data);
  }

  public function MakeFixtureSchedule($est_ref_id,$fixture_id,$establishment_ref,$sport_id,$fixture_rel_id)
  {
    
    $data=array();
    $check=$this->ChechkFixtureSchedule($est_ref_id,$fixture_id);
    if(!empty($check))
    {
      $this->db->where('fixture_ref',$fixture_id);
      $this->db->delete('establishment_schedule');
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
 
  public function MakeEstablishmentSchedule($fixture_id,$user_ref,$sport_id,$fixture_rel_id, $action='add')
  {
    
    $data=array(); echo $action;
	if($action == 'remove') {
    $check=$this->ChechkFixtureScheduleExists($user_ref,$fixture_id);
		if(!empty($check))
		{
			$sql_del="delete from app_schedule where fixture_ref='$fixture_id' and user_ref='$user_ref'";
			$query=$this->db->query($sql_del);
		}
	}
    else
    {
      $data['fixture_ref']=$fixture_id;
      $data['user_ref']=$user_ref;
      $data['sport_id']=$sport_id;
	  $data['competition_ref']=$fixture_rel_id;

      //print_r($data);
      $this->db->insert('app_schedule', $data) or die(mysql_error());
    }
  }

  public function InsertIntoPayment($payment_record)
  {
    $this->db->insert('payments',$payment_record);
    return $this->db->insert_id();
  }
  public function InsertIntoAccountHistory($account_record)
  {
    $this->db->insert('establishment_account_history',$account_record);
  }
  public function AddEvent($data,$event_id)
  {
    if(!empty($event_id))
    {
      $this->db->where('id',$event_id);
      $this->db->update('establishment_event',$data);
    }
    else
    {
     $this->db->insert('establishment_event', $data);
    }
  }
  public function AddOffer($data,$offer_id)
  {

    if(!empty($offer_id))
    {
	  //echo "offer_id".$offer_id;exit;
      $this->db->where('id',$offer_id);
      $this->db->update('establishment_offers',$data);
    }
    else
    {
     $this->db->insert('establishment_offers', $data);
    }

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

  public function InsertFacility($data,$est_ref_id)
  {    
    $this->db->where('est_ref', $est_ref_id);
    $this->db->delete('establishment_facility'); 

    $this->db->insert_batch('establishment_facility', $data);

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
  public function SearchResult($from_date,$to_date,$search_text,$est_info_id)
  { 
    //$rs= $this->db_query->FetchInformation(SPORT,"","1='1'");
    $where="where deleted_on is NULL";
	if(!empty($from_date)){
	$fromdat = explode("/",$from_date);
	$from_date = $fromdat[2]."-".$fromdat[1]."-".$fromdat[0];
	$where.=" and DATE(date) >='$from_date'";
	}
	if(!empty($to_date)){
	$todat = explode("/",$to_date);
	$to_date = $todat[2]."-".$todat[1]."-".$todat[0];
	$where.=" and DATE(date) <='$to_date'";
	}
    if(!empty($search_text) && $search_text!='Search') $where.=" and title like '%$search_text%'";
	$where.=" and est_ref='$est_info_id'";
     $sql="select *, date_format(date, '%d-%m-%Y') as dateform from establishment_event $where order by date";
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
  
  public function DeleteEvent($id)
  {
    $data_ar['deleted_on']=date('y-m-d:h:i:s');
    $this->db->where('id',$id);
    $this->db->update('establishment_event',$data_ar);
  }

  public function DeleteFixture($id)
  {
    $data_ar['deleted_on']=date('y-m-d:h:i:s');
    $this->db->where('fixture_id',$id);
    $this->db->update('fixture',$data_ar);
  }

  public function DeleteOffer($id)
  {
    $data_ar['deleted_on']=date('y-m-d:h:i:s');
    $this->db->where('id',$id);
    $this->db->update('establishment_offers',$data_ar);
  }
  
  public function AllEvents($est_ref_id)
  { 
    //$rs= $this->db_query->FetchInformation(SPORT,"","1='1'");
    $sql="select *, date_format(date, '%d-%m-%Y') as dateform from establishment_event where est_ref='$est_ref_id' and deleted_on is NULL order by date";
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
  
  public function AllChannels()
  { 
    //$rs= $this->db_query->FetchInformation(SPORT,"","1='1'");
    $sql="select ch.channel_id,ch.channel_name from channel ch inner join fixture_channel_list fcl on fcl.rel_channel_id=ch.channel_id inner join fixture f on f.fixture_id = fcl.rel_fixture_id where f.gmt_date_time >= NOW()  group by fcl.rel_channel_id order by ch.channel_name ";
    $query=$this->db->query($sql);
    $row=$query->result();
    if($query->num_rows()>0)
    {
     $i=0;
     foreach($query->result() as $row)
     {
      $sp[$i]['id']=$row->channel_id;
      $sp[$i]['channel_name']=$row->channel_name;
      $i++;
     }

    }
  return $sp;
  }
  
  public function SelectedChannels($userref) {
	$sp = array();  
	$sql = "SELECT apc.user_ref, apc.channel_id, c.channel_name as channel_name_o, pc.channel_name, pc.channel_name_dp FROM `app_provider_channel` as apc left join `channel` as c on apc.channel_id=c.channel_id left join `provider_channels` as pc ON apc.channel_id = pc.channel_id where apc.user_ref = '".$userref."' and apc.status='1' order by pc.channel_name_dp asc, c.channel_name asc";	
	//echo $sql; die;
	$query = $this->db->query($sql);
	$row = $query->result();
	
	if($query->num_rows()>0) {	
	$i=0;
	foreach($row as $val) {
		$channel_name = (empty($val->channel_name_dp))?$val->channel_name_o:$val->channel_name;
		if($val->channel_name!='') {
			$sql1 = "SELECT * FROM channel WHERE channel_name = '$channel_name' ";
			$query1 = $this->db->query($sql1);
			$row1 = $query1->result();
		
			if($query1->num_rows()>0) {
				$sp[$i]['id'] = $row1[0]->channel_id; }
			else {
				$sp[$i]['id'] = 0;
			}
		}
		else { $sp[$i]['id'] = 0; }
		
			$sp[$i]['channel_name'] = $val->channel_name;
			$sp[$i]['channel_name_dp'] = (empty($val->channel_name_dp))?$val->channel_name_o:$val->channel_name_dp;
			$i++;	

	 	}
	}
	
	$sp = array_map('unserialize', array_unique(array_map('serialize', $sp)));
		
	return $this->msort($sp, array('channel_name_dp'));

  }
  
  public function msort($array, $key, $sort_flags = SORT_REGULAR) {
    if (is_array($array) && count($array) > 0) {
        if (!empty($key)) {
            $mapping = array();
            foreach ($array as $k => $v) {
                $sort_key = '';
                if (!is_array($key)) {
                    $sort_key = $v[$key];
                } else {
                    // @TODO This should be fixed, now it will be sorted as string
                    foreach ($key as $key_key) {
                        $sort_key .= $v[$key_key];
                    }
                    $sort_flags = SORT_STRING;
                }
                $mapping[$k] = $sort_key;
            }
            asort($mapping, $sort_flags);
            $sorted = array();
            foreach ($mapping as $k => $v) {
                $sorted[] = $array[$k];
            }
            return $sorted;
        }
    }
    return $array;
}
  
  public function SelectedChannelsSearchResult($userref,$text) {
	  
	$sp = array();  
	$where = '';
	if($text!=''){ $where.="and (pc.channel_name_dp like '%$text%' or c.channel_name like '%$text%')"; }
	
	$sql = "SELECT apc.user_ref, apc.channel_id, c.channel_name as channel_name_o, pc.channel_name, pc.channel_name_dp FROM `app_provider_channel` as apc left join `channel` as c on apc.channel_id=c.channel_id left join `provider_channels` as pc ON apc.channel_id = pc.channel_id where apc.user_ref = '".$userref."' and apc.status='1' $where order by pc.channel_name_dp asc, c.channel_name asc";
	//echo $sql;  
	/*$sql = "SELECT epc.est_ref, epc.channel_id, pc.channel_name, pc.channel_name_dp FROM `establishment_provider_channel` as epc join `provider_channels` as pc ON epc.channel_id = pc.channel_id where epc.est_ref = '".$estref."' and pc.channel_name like '%$text%' order by pc.channel_name asc ";	*/
	$query = $this->db->query($sql);
	$row = $query->result();
	
	if($query->num_rows()>0) {	
	$i=0;
	foreach($row as $val) {
		$channel_name = (empty($val->channel_name_dp))?$val->channel_name_o:$val->channel_name;
		if($channel_name!='') {
			$sql1 = "SELECT * FROM channel WHERE channel_name = '$channel_name' ";
			$query1 = $this->db->query($sql1);
			$row1 = $query1->result();
		
			if($query1->num_rows()>0) {
				$sp[$i]['id'] = $row1[0]->channel_id; }
			else {
				$sp[$i]['id'] = 0;
			}
		}
		else { $sp[$i]['id'] = 0; }
		
			$sp[$i]['channel_name'] = $val->channel_name;
			$sp[$i]['channel_name_dp'] = (empty($val->channel_name_dp))?$val->channel_name_o:$val->channel_name_dp;
			$i++;	
	 }
  }
	$sp = array_map('unserialize', array_unique(array_map('serialize', $sp)));
		
	return $this->msort($sp, array('channel_name_dp'));
  }
  	
  public function ChannelSearchResult($text)
  { 
    $sp=array();
    //$rs= $this->db_query->FetchInformation(SPORT,"","1='1'");
     $sql="select ch.channel_id,ch.channel_name from channel ch inner join fixture_channel_list fcl on fcl.rel_channel_id=ch.channel_id inner join fixture f on f.fixture_id = fcl.rel_fixture_id where ch.channel_name like '%$text%' and f.gmt_date_time >= NOW() group by fcl.rel_channel_id ";
  /* $sql="select ch.channel_id,ch.channel_name,clfc.rel_fixture_channel_list_id 
    from channel ch inner join channel_list_fixture_channel_list clfc on clfc.rel_instance_id=ch.channel_id 
       inner join fixture f on f.fixture_id = clfc.rel_fixture_channel_list_id where ch.channel_name like '%$text%' and  f.gmt_date_time > CURDATE()
         group by clfc.rel_instance_id  ";*/
    $query=$this->db->query($sql);
    $row=$query->result();
    if($query->num_rows()>0)
    {
     $i=0;
     foreach($query->result() as $row)
     {
      $sp[$i]['id']=$row->channel_id;
      $sp[$i]['channel_name']=$row->channel_name;
      $i++;
     }
    }
    return $sp;
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

  public function AllChannelSport($channel_id)
  { 

    if(!empty($channel_id)){$channel_ids=str_replace("~","','",$channel_id); $channel_condition=" spt.channel_id in ('".$channel_ids."') ";}
    else $channel_condition=""; 
    $sport_ids=$this->GetSportId($channel_ids); 

    // echo "sarita";print_r($sport_ids);exit;

    //$rs= $this->db_query->FetchInformation(SPORT,"","1='1'");
    $sql="select sport_id,sport_name from sport inner join competition on  competition.competition_id=";
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
  public function AllSport()
  { 
    $sp=array();  //$rs= $this->db_query->FetchInformation(SPORT,"","1='1'");
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

    if(!empty($from_date) && $from_date!='Date From')
    {
     $from_date = str_replace("/","-", $from_date);$from_date=date('Y-m-d 00:00:00',strtotime($from_date));
     $where.=" and f.gmt_date_time >='$from_date'";
    }

    if(!empty($to_date) && $to_date!='Date End')
    {
      $to_date = str_replace("/","-", $to_date);$to_date= date('Y-m-d 23:59:59',strtotime($to_date));
      $where.=" and f.gmt_date_time <='$to_date'";
    }

    if(!empty($search_text) && $search_text!='Search') $where.=" and (t1.team_name like '%$search_text%' or t2.team_name like '%$search_text%')";

    //$sql="select * from establishment_event $where order by date";
    $sql="select f.fixture_id,date_format(f.gmt_date_time,'%Y-%m-%d') as gmt_date_time , time_format(f.local_time,'%h:%i %p' ) as local_time_form,
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
		$sp[$i]['local_time_form']=$row->local_time_form;
        $sp[$i]['team1']=$row->team1;
        $sp[$i]['team2']=$row->team2;

        $i++;
      }

     }
    return $sp;
  }
  public function GetFixtureIds($channel_ids)
  {
   
   $sql="select rel_fixture_id from fixture_channel_list where rel_channel_id in ('".$channel_ids."') ";
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
  public function getFixtureInfo($fixtureid){

   $sql="select * from fixture where fixture_id = '$fixtureid' limit 1";
   $query=$this->db->query($sql);
   if($query->num_rows()>0)
   {
	   $row=$query->result()[0];
	   return $row;
   }

  	  
  }
  public function AllFixture($user_ref_id,$sport_id,$channel_id,$from_date,$to_date,$search_text,$limit='')
  { 
    //echo $channel_id;
    if($channel_id!='')
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
    if(!empty($from_date) && $from_date!='Date From')
    {
     $from_date = str_replace("/","-", $from_date);
	 $from_date=date('Y-m-d',strtotime($from_date));
	 $from_date = $from_date." 00:00:00";
     $where.=" and f.gmt_date_time >='$from_date'";
    }

    if(!empty($to_date) && $to_date!='Date End')
    {
      $to_date = str_replace("/","-", $to_date);
	  $to_date= date('Y-m-d',strtotime($to_date));
	  $to_date = $to_date." 23:59:59";
      $where.=" and f.gmt_date_time <='$to_date'";
    }

    if(!empty($search_text) && $search_text!='Search') $where.=" and (t1.team_name like '%$search_text%' or t2.team_name like '%$search_text%')";
    // end for date search 
     $sql="select f.fixture_id,c.rel_sport_id,date_format(f.gmt_date_time,'%d-%m-%Y') as gmt_date_time , time_format(f.timezone_time,'%H:%i' ) as local_time_form, f.rel_competition_id, f.timezone_date, f.timezone_time, 
      t1.team_name as team1,t2.team_name as team2 from fixture f inner join team t1 on
    f.rel_team_id_1=t1.team_id inner join team t2 on f.rel_team_id_2=t2.team_id inner join 
    competition c on f.rel_competition_id=c.competition_id where f.gmt_date_time >= NOW()
    $cond $channel_condition $where ORDER BY f.gmt_date_time $limit";
	//echo $sql; die;
    $query=$this->db->query($sql);
    $row=$query->result();
    if($query->num_rows()>0)
    {
      $i=0;
	  $current_timezone = $this->gettimezone(); 
      foreach($query->result() as $row)
      {
      $check=$this->ChechkFixtureSchedule($user_ref_id,$row->fixture_id);
      if(!empty($check)) $sp[$i]['fixture_check']='checked';
      else $sp[$i]['fixture_check']="";
      $sp[$i]['id']=$row->fixture_id;
      //$sp[$i]['sport_id']=$row->rel_sport_id;
	  $matchtime = $row->timezone_date.". .".$row->timezone_time;
	  $CetTime = $this->ConvertOneTimezoneToAnotherTimezone($matchtime,'Europe/London', $current_timezone);
      $sp[$i]['gmt_date_time']=$row->gmt_date_time;
	  $sp[$i]['local_time_form']=date("H:i", strtotime($CetTime));
      $sp[$i]['team1']=$row->team1;
      $sp[$i]['team2']=$row->team2;
	  $sp[$i]['rel_competition_id']=$row->rel_competition_id;
	  $sp[$i]['sport_name']=$this->getSportName($row->rel_sport_id);
	  $sp[$i]['sport_icon'] = $this->getSportIcon($row->rel_sport_id);
      $i++;
      }
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
	
    public function TotalFixtureCount($user_ref_id,$sport_id,$channel_id,$from_date,$to_date,$search_text,$limit='')
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
    if(!empty($from_date) && $from_date!='Date From')
    {
     $from_date = str_replace("/","-", $from_date);
	 $from_date=date('Y-m-d',strtotime($from_date));
	 $from_date = $from_date." 00:00:00";
     $where.=" and f.gmt_date_time >='$from_date'";
    }

    if(!empty($to_date) && $to_date!='Date End')
    {
      $to_date = str_replace("/","-", $to_date);
	  $to_date= date('Y-m-d',strtotime($to_date));
	  $to_date = $to_date." 23:59:59";
      $where.=" and f.gmt_date_time <='$to_date'";
    }

    if(!empty($search_text) && $search_text!='Search') $where.=" and (t1.team_name like '%$search_text%' or t2.team_name like '%$search_text%')";

    // end for date search 
     $sql="select f.fixture_id,c.rel_sport_id,date_format(f.gmt_date_time,'%d-%m-%Y') as gmt_date_time , time_format(f.local_time,'%h:%i %p' ) as local_time_form, f.rel_competition_id, 
      t1.team_name as team1,t2.team_name as team2 from fixture f inner join team t1 on
    f.rel_team_id_1=t1.team_id inner join team t2 on f.rel_team_id_2=t2.team_id inner join 
    competition c on f.rel_competition_id=c.competition_id where f.deleted_on is NULL and f.gmt_date_time >= NOW()  
    $cond $channel_condition $where ORDER BY f.gmt_date_time $limit";
	

    $query=$this->db->query($sql);
    $row=$query->result();
    $total_record = 0;
	if($query->num_rows()>0)
    {
		$total_record= $query->num_rows();
    }

    return $total_record;

  }
  public function ChechkFixtureScheduleExists($user_ref,$fixture_id)
  {
     // $query=$this->db->select('id')->from('establishment_schedule')->where('fixture_ref', $fixture_id)->get();
    $sql="select id from app_schedule where fixture_ref='$fixture_id' and user_ref='$user_ref'";
    $query=$this->db->query($sql);
    if($query->num_rows()>0)
    {
      $row=$query->result()[0];
      return $row->id;
    }

  }

  public function ChechkFixtureSchedule($user_ref,$fixture_id)
  {
    $sql="select id from app_schedule where fixture_ref='$fixture_id' and user_ref='$user_ref'";
    $query=$this->db->query($sql);
    if($query->num_rows()>0)
    {
      $row=$query->result()[0];
      return $row->id;
    }

  }
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

  public function GetPremiumDueDate($est_ref_id)
  {
    $query=$this->db->select('valid_to')->from('establishment_account_history')->where('establishment_ref', $est_ref_id)->order_by('valid_to','desc')->get();

    if($query->num_rows()>0)
    {
      $row=$query->result()[0];
     return $row->valid_to;
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
 
  public function GetEventDetails($id)
  {

   $sql="select *,date_format(date, '%d-%m-%Y') as eventdate from establishment_event where id='$id'";
   $query=$this->db->query($sql);
   if($query->num_rows()>0)
   {
    $sp=array();
    foreach($query->result() as $row)
    {
          $sp['title']=$row->title;
          $sp['event_date']=$row->eventdate;
          $sp['event_time']=$row->time;
          $sp['duration']=$row->duration;
          
    }
    return $sp;
   }
 }
  public function GetOfferDetails($id)
  {

   $query=$this->db->get_where('establishment_offers', array('id' => $id));
   if($query->num_rows()>0)
   {
    $offer=array();
    foreach($query->result() as $row)
    {
          $offer['id']=$row->id;
          $offer['est_ref']=$row->est_ref;
          $offer['title']=$row->title;
          $offer['description']=$row->description;
          $offer['price_or_discount']=$row->price_or_discount;
		  $offer['promo_code']=$row->promo_code;
          $offer['isactive']=$row->isactive;
    }
  
    return $offer;
   }
  }
 
  public function GetProfileDetail($id)
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
	  if(!empty($row->geo_lat)) { $sp['geo_lat']=$row->geo_lat; } else { $sp['geo_lat'] = $userip->latitude; }
 	  if(!empty($row->geo_lang)){ $sp['geo_lang']=$row->geo_lang; } else {$sp['geo_lang'] = $userip->longitude; }
     if(!empty($row->short_description)) $sp['short_description']=$row->short_description;
    }
    return $sp;
   }
  }
  
  public function getuserlatlan() {
  	$ip  = !empty($_SERVER['HTTP_X_FORWARDED_FOR']) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR'];
	$url = "http://freegeoip.net/json/$ip";
	$ch  = curl_init();
	
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
	$data = curl_exec($ch);
	curl_close($ch);
	
	if ($data) {
		$location = json_decode($data);
		
		$lat = $location->latitude;
		$lon = $location->longitude;
		 
		$sun_info = date_sun_info(time(), $lat, $lon);
		
	}
	return $location;
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

  public function CheckSubscription($email)
  {
    $rec= $this->db_query->FetchSingleInformation('establishment_subscription_free','id',"email='$email'");
    if(count($rec)>0) return 'true';
    else return 'false';

  }

  public function GetEstablishmentCardDetail($est_ref_id)
  {	
   	return $this->db_query->FetchSingleInformation('establishment_card_details','card_number',"establishment_ref='$est_ref_id'");	
  }
  public function GetProPic($est_ref_id)
  {	

   	 $ar=$this->db_query->FetchSingleInformation('establishment_info',"picture","est_user_ref='$est_ref_id'");
  	 if(count($ar)>0) return $arr['current_picture']=$ar['picture'];
  	 else $arr['current_picture']="";
  	
  }
  public function GetEstInfoId($est_ref_id)
  {	
   	 $ar=$this->db_query->FetchSingleInformation('establishment_info',"id","est_user_ref='$est_ref_id'");
  	 if(count($ar)>0) return $est_info_id = $ar['id'];
  	 else $est_info_id = "";
  }

  public function AccountHistory($est_ref_id)
  {	
   	//return $this->db_query->FetchInformation('establishment_account_history','',"establishment_ref='$est_ref_id'");	
	
	 $sql="select est_acc_his.*,pay.* from establishment_account_history est_acc_his inner join
	 payments pay on pay.id= est_acc_his.payment_ref where est_acc_his.establishment_ref='$est_ref_id' ";
	 $query=$this->db->query($sql);
   if($query->num_rows()>0)
   {
    $history=array();
    $i=0;
    foreach($query->result() as $row)
    {
      $history[$i]['establishment_ref']=$row->establishment_ref;
      $history[$i]['payment_ref']=$row->payment_ref;
      $history[$i]['product']=$row->product;
      $history[$i]['amount']=$row->amount;
      $history[$i]['currency']=$row->currency;
      $history[$i]['payment_date']=$row->payment_date;
      $i++;
    }
  
    return $history;
   } 
  }
  public function WeekConstantHappyHours($est_ref_id)
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
        $week_id=$this->db_query->FetchSingleInformation('establishment_happy_hours',"from_time~to_time~is_active","est_ref='$est_ref_id' and week_ref='$row->id'");
        if(!empty($week_id['from_time'])) $week[$i]['from_time']= $week_id['from_time'];
        else $week[$i]['from_time']='';
        if(!empty($week_id['to_time'])) $week[$i]['to_time']= $week_id['to_time'];
        else $week[$i]['to_time']='';
        if(!empty($week_id['is_active'])) $week[$i]['is_active']= $week_id['is_active'];
        else $week[$i]['is_active']='';

        $i++; 

      }

      return $week;
    }
   // $array= $this->db_query->FetchInformation('week_constant',"","1=1");
  } 
  public function WeekConstantList($est_ref_id)
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
        $week_id=$this->db_query->FetchSingleInformation('establishment_opening_hours',"from_time~to_time","est_ref='$est_ref_id' and week_ref='$row->id'");
        if(!empty($week_id['from_time'])) $week[$i]['from_time']= $week_id['from_time'];
        else $week[$i]['from_time']='';
        if(!empty($week_id['to_time'])) $week[$i]['to_time']= $week_id['to_time'];
        else $week[$i]['to_time']='';

        $i++; 

      }

      return $week;
    }
   // $array= $this->db_query->FetchInformation('week_constant',"","1=1");
  } 
  public function checkWeek($est_ref,$week_ref)
  {
    return $this->db_query->FetchSingleInformation('establishment_opening_hours','id',"est_ref='$est_ref' and week_ref='$week_ref'");
  }
  public function checkhappyWeek($est_ref,$week_ref)
  {
    return $this->db_query->FetchSingleInformation('establishment_happy_hours','id',"est_ref='$est_ref' and week_ref='$week_ref'");
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
  public function getfixtureSportid($fixtureid){
	$sql =  "select rel_sport_id from competition c, fixture f where c.competition_id = f.rel_competition_id and f.fixture_id='".$fixtureid."'";
	$query=$this->db->query($sql);

    if($query->num_rows()>0)
    {
      $row=$query->result()[0];
      return $row->rel_sport_id;
    }

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
  
  public function upgateGallery($est_info_id, $defaultimage){

	$sql =  "select * from establishment_profile_image where est_ref='".$est_info_id."'";
  	$query=$this->db->query($sql);
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
		
	}else
	{
		/*if(!empty($defaultimage)){
		 $sql_2 =  "UPDATE establishment_profile_image SET default_image='0' where est_ref='".$est_info_id."'";
		$query_2=$this->db->query($sql_2);

		 $sql_2_1 =  "UPDATE establishment_profile_image SET default_image='1' where est_ref='".$est_info_id."' and image_ref='".$defaultimage."'";
		$query_2_1=$this->db->query($sql_2_1);
		}
//exit;*/
	}
	  
  }
  public function gerLastuser($email){
	  $q="SELECT user_id FROM user WHERE `email_id` = '$email' LIMIT 1";
	  //echo $q; die;
        $query = $this->db->query($q) ;
	if($query->num_rows() > 0)
       	 { 
		$row = $query->result();     
		$row=$row[0];
		return $row->id;
	}
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
  public function countoffer($est_info_id){
		$sql_1 =  "select * from establishment_offers where est_ref='".$est_info_id."' and deleted_on is NULL ";
		$query_1=$this->db->query($sql_1);
		return $query_1->num_rows();
  }
  

 }
?>