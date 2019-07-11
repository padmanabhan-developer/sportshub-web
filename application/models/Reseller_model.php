<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Reseller_model extends CI_Model {
  public function __construct()
  {
   parent ::__construct();  
  } 
  
  public function SearchResellerAttribute($values=array())
  {
     if(count($values) == 0)
     {
      $values=array('date_from'=>'Date From','date_end'=>'Date End','search_text'=>'Search');
     }
     $fun="SearchResultReseller(path.value,'1','20',date_from.value,date_end.value,search_text.value,'');";
     $attribute['form']=array('id'=>'search_frm2','name'=>'search_frm2');
     
     $attribute['date_from']=array('name'=> 'date_from','id'=> 'datepicker-example7-start','value' => trim($values['date_from']),'class'=>"date-input" , 'onfocus'=>"if (this.value == 'Date From') {this.value = '';}" ,'onblur'=>"if (this.value == '') {this.value = 'Date From';}");

     $attribute['date_end']=array('name'=> 'date_end','id'=> 'datepicker-example7-end','value' => trim($values['date_end']),'class'=>"date-input" , 'onfocus'=>"if (this.value == 'Date End') {this.value = '';}" ,'onblur'=>"if (this.value == '') {this.value = 'Date End';}");
   
     $attribute['search_text']=array('name'=> 'search_text','id'=> 'search_text','value' => trim($values['search_text']),'class'=>"date-input" , 'onfocus'=>"if (this.value == 'Search') {this.value = '';}" ,'onblur'=>"if (this.value == '') {this.value = 'Search';}");
     
     $attribute['submit']=array('type' => 'button',  'name' => 'form_submit','class'=>'search-button','value'=>'',
      'onclick'=>$fun);
     return $attribute;
  }
  
  public function ResellerFormAttribute($values=array())
  {
    //$values = $values_question;
    if(count($values) == 0)
    {
      $values=array('firstname'=>'','lastname'=>'','email'=>'','resellercode'=>'');
    }
    $attribute['form']=array('id'=>'reseller_frm','name'=>'reseller_frm');
  
    $attribute['firstname']=array('name'=> 'firstname','id'=> 'firstname','value' => trim($values['firstname']),'class'=>"input name" , 'placeholder'=>"First Name",);
	$attribute['lastname']=array('name'=> 'lastname','id'=> 'lastname','value' => trim($values['lastname']),'class'=>"input name" , 'placeholder'=>"Last Name",);
	$attribute['email']=array('name'=> 'email','id'=> 'email','value' => trim($values['email']),'class'=>"input name" , 'placeholder'=>"Email",);
	$attribute['resellercode']=array('name'=> 'resellercode','id'=> 'resellercode', 'value' => trim($values['resellercode']),'class'=>"input name" , 'placeholder'=>"Reseller code",);

    $attribute['submit']=array('type' => 'submit',  'name' => 'form_submit','class'=>'change-now pull-right','value'=>'Save');
    return $attribute;
  }
  
  public function SettingsFormAttribute($values=array())
  {
    if(count($values) == 0)
    {
      $values=array('competition'=>'','subtext'=>'', 'text' => '');
    }
  	if(empty($values['competition']))$values['competition']='';
  
    $attribute['form']=array('id'=>'question_frm','name'=>'question_frm');

  	if(!empty($values['competition']))$values['competition'] = trim($values['competition']);else $values['competition'] ='';

    $attribute['text']=array('name'=> 'text','id'=> 'text','value' => trim($values['text']),'class'=>"input name" , 'placeholder'=>"Text",);
	
	$attribute['competition']=array('name'=> 'competition','id'=> 'competition','value' => trim($values['competition']),'class'=>"input name" , 'placeholder'=>"Competition",);
	$attribute['subtext']=array('name'=> 'subtext','id'=> 'subtext','value' => trim($values['subtext']),'class'=>"input name" , 'placeholder'=>"Text",);

    $attribute['submit']=array('type' => 'submit',  'name' => 'form_submit','class'=>'change-now','value'=>'Save');
    return $attribute;
  }
  
  public function GetResellerData($resellerid='',$from_date,$to_date,$search_text, $status, $limit='') {
	  
	  $cond = 'where 1=1';
	  if($resellerid!='') $cond.=" and resellerid ='$resellerid'";
	  
	  if(!empty($from_date) && $from_date!='Date From'){
      $from_date = str_replace("/","-", $from_date);$from_date=date('Y-m-d',strtotime($from_date));
       $cond.=" and created_on >='$from_date'";
      }

      if(!empty($to_date) && $to_date!='Date End'){
        $to_date = str_replace("/","-", $to_date);$to_date= date('Y-m-d',strtotime($to_date));
         $cond.=" and created_on <='$to_date'";
       }
    
      if(!empty($search_text) && $search_text!='Search') $cond.=" and (email like '%$search_text%' or firstname like '%$search_text%')";
	   if($status!='') { $cond.=" and status IN ('$status')"; }	
	  
	  $sql = "select * from reseller $cond order by created_on DESC $limit";
	  //echo $sql; die; 
	  $query = $this->db->query($sql);
	  
	  if($query->num_rows()>0)
       {
		$sp=array();  $i=0;
		foreach($query->result() as $row)
		{
		  	$sql1 = "select count(user_ref) as count from reseller_establishment where resellerid='$row->resellerid' order by created_on DESC";
			$query1 = $this->db->query($sql1);  
			if($query1->num_rows()>0) {
				$row1 = $query1->result();
				$est_count = $row1[0]->count;
			}
			else {
				$est_count = $row1[0]->count;			
			}

		  $sp[$i]['resellerid'] = $row->resellerid;
		  $sp[$i]['firstname'] = $row->firstname;
		  $sp[$i]['lastname'] = $row->lastname;
		  $sp[$i]['email'] = $row->email;
		  $sp[$i]['resellercode'] = $row->resellercode;
		  $sp[$i]['est_count'] = $est_count;
		  $sp[$i]['created_on'] = $row->created_on;
		  $sp[$i]['status'] = $row->status;
		  
		  $i++;
		 }
		return $sp;
	  }
	   else {
		 $row = array();
		 return $row; 
	   }
  }
  
  public function GetReseller($id='') {
	  
	  $cond = '';
	  if($id!='') $cond.="where resellerid ='$id'";
	  
	  $sql = "select * from reseller $cond order by created_on DESC";
	  //echo $sql; die; 
	  $query = $this->db->query($sql);
	  if($query->num_rows()>0)
       {
		$sp=array();  $i=0;
		foreach($query->result() as $row)
		{
		  $sp[$i]['firstname']=$row->firstname;
		  $sp[$i]['lastname']=$row->lastname;
		  $sp[$i]['email']=$row->email;
		  $sp[$i]['resellercode']=$row->resellercode;
		  $sp[$i]['status']=$row->status;
		  $i++;
		 }
		return $sp;
	   }
	   else {
		   	 $row = array();
		 	return $row; 
	   }
  }
  
  public function GetResellerEst($id='', $limit) {
	  
	  $cond = '';
	  if($id!='') $cond.="where resellerid ='$id'";
	  
	  $sql = "select * from reseller_establishment $cond order by created_on DESC $limit";
	  //echo $sql; die; 
	  $query = $this->db->query($sql);
	  if($query->num_rows()>0)
       {
		$sp=array();  $i=0;
		foreach($query->result() as $row)
		{
		 $sql1 = "select eu.email,ei.title,eu.created_on from establishment_user as eu join establishment_info as ei on eu.id=ei.est_user_ref where eu.id =$row->user_ref";
		 //echo $sql1; die;
		 $query1 = $this->db->query($sql1);
		 if($query1->num_rows()>0)
       	 {
			 $res = $query1->result();
			 //echo "<pre>";
			 //print_r($res); die;
	     }
		  $sp[$i]['email']=$res[0]->email;
		  $sp[$i]['title']=$res[0]->title;
		  $sp[$i]['user_ref']=$row->user_ref;
		  $sp[$i]['created_on']=$res[0]->created_on;
		  $i++;
		 }
		return $sp;
	   }
	   else {
		   	$row = array();
		 	return $row; 
	   }
  }
  
  public function TotalResellerEst($id='') {
	  
	  $cond = '';
	  if($id!='') $cond.="where resellerid ='$id'";
	  
	  $sql = "select * from reseller_establishment $cond order by created_on DESC";
	  //echo $sql; die; 
	  $query = $this->db->query($sql);
	  if($query->num_rows()>0)
       {
		  $total_count = $query->num_rows();
		  
	   }
	   else {
		   $total_count = 0;
	   }
	   return $total_count;
  }
  
  public function TotalReseller($id='',$from_date,$to_date,$search_text,$status, $limit='') {
	  
	  $cond = 'where 1=1';
	  if($id!='') $cond.="and resellerid ='$id'";
	  
	  if(!empty($from_date) && $from_date!='Date From'){
      	$from_date = str_replace("/","-", $from_date);$from_date=date('Y-m-d h:i:s',strtotime($from_date));
        $cond.=" and modified_on >='$from_date'";
      }

      if(!empty($to_date) && $to_date!='Date End'){
        $to_date = str_replace("/","-", $to_date);$to_date= date('Y-m-d h:i:s',strtotime($to_date));
        $cond.=" and modified_on <='$to_date'";
       }
    
       if(!empty($search_text) && $search_text!='Search') $cond.=" and (email like '%$search_text%')";
	  if($status!='') { $cond.=" and status IN ('$status')"; }   	
	  
	  $sql = "select * from reseller $cond order by created_on DESC $limit";
	 // echo $sql; die; 
	  $query = $this->db->query($sql);
	 
	  
	  if($query->num_rows()>0)
       {
			$total_reseller = $query->num_rows();   
	   }
	   else {
		   	$total_reseller = 0;
	   }
	   return $total_reseller; 
  }
  
  public function AddResellerData($arr) {
	$this->db->insert('reseller',$arr);
	$res = $this->db->insert_id();
	
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
		/*$content .= '<p style="color:#6f6f6f; font-family:Arial, Helvetica, sans-serif; font-size:14px; line-height:18px; margin:0; padding:0 0 15px 0;">
Please find the below for your </p>';*/
		$content .= '<p style="color:#6f6f6f; font-family:Arial, Helvetica, sans-serif; font-size:14px; line-height:18px; margin:0; padding:0 0 15px 0;">
<strong>Reseller Code :</strong> '.$arr['resellercode'].'</p>';
		$content .= '<div style="width:100%; float:left; background:#131e38; height:44px; text-align:center;padding: 10px 0 0;color:#fff; font-family:Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold;">If you have any questions or would like any more information please feel free to contact us at, <br /> <a href="mailto:info@sportshub365.com" style="text-decoration:none; color:#dab503;">info@sportshub365.com</a>&nbsp;&nbsp;&nbsp;Tel: +44 208 705 0525</div>';
		$content .= ' </p>';
		$content .= '</div></div></body></html>';
		$to = $arr['email'];
		$subject = "Sportshub365.com - Reseller Code";
	
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
		$headers .= 'From: Sportshub365<info@sportshub365.com>' . "\r\n";
		echo mail($to,$subject,$content,$headers);
		
  }
  
  public function ResellerEmailCheck($email) {
	  
	 $sql = "select * from reseller where email='".$email."'";
	 $query = $this->db->query($sql);  
	 if($query->num_rows()==0) { 
	  	return false;
	 }
	 else {
	 	 return true;
	 }
  }
  
  public function ResellerCodeCheck($code) {
	  
	 $sql = "select * from reseller where resellercode='".$code."'";
	 $query = $this->db->query($sql);  
	 if($query->num_rows()==0) { 
	  	return false;
	 }
	 else {
	 	 return true;
	 }
  }
  
  public function UpdateResellerData($data, $reseller_ref) { 
  	
	if(count($data)>0) {
	
		$this->db->where('resellerid',$reseller_ref);
		$this->db->update('reseller', $data);
	}
  }
  public function DeleteQuestion($id)  {
    $sql ="select * from quiz_questions where question_id='$id'";
    $query =$this->db->query($sql);
    //echo $sql;  die;
    if($query->num_rows()>0)
    { 
			
        $this->db->where('question_id',$id);
		$this->db->delete('quiz_answer');
		
		$this->db->where('question_id',$id);
		$this->db->delete('quiz_questions');
		return true;
    }
    else
    {
      return false;
    }
  }
  
  public function BlockReseller($id,$status)
   {
    $sql ="select * from reseller where resellerid = '".$id."' ";
	
    $query = $this->db->query($sql);
    $result = $query->result();
	
    if($query->num_rows()>0)
    { 
	 $question_status = ($status=='block')?'1':'0';
	  
       $sql_rem = "UPDATE reseller SET status='".$question_status."' WHERE resellerid = '".$id."'";
       $query_rem = $this->db->query($sql_rem);
       return true;
    }
    else
    {
      return false;
    }
  }
  
  public function GetSettings() {
  	
	$sql ="select * from quiz_settings";
    $query = $this->db->query($sql);
    $result = $query->result();
	$res = array();
    if($query->num_rows()>0)
    { 
		$res['id'] = $result[0]->id;
		$res['text'] = $result[0]->text;
		$res['competition'] = $result[0]->competition;
		$res['subtext'] = $result[0]->subtext;
	}
	return $res;
  }
  
    public function UpdateSettings($data, $id)
   {
    $sql ="select * from quiz_settings where id = '".$id."' ";
	
    $query = $this->db->query($sql);
    $result = $query->result();
	
    if($query->num_rows()>0)
    { 
		//echo "<pre>";
		//print_r($data); die;
      $this->db->where('id',$id);
	  $this->db->update('quiz_settings', $data);
      return true;
    }
    else
    {
      return false;
    }
  }
}

?>