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
 
}
?>