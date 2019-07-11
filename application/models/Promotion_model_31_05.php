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

 
}
?>