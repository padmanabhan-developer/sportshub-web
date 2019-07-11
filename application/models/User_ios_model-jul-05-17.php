<?php
class User_ios_model extends CI_Model
{
	public function CheckUser($email,$password , $facebook_id )
	{

		if( (!empty($email) and !empty($password)) || !empty($facebook_id) ){

			// checking email id not empty

			if( valid_email($email) ){
					
				$query = $this->db->query("SELECT user_id,isActive FROM user WHERE email_id = '$email' AND password = '".$password."' LIMIT 1", $this->db);
				
				
			}
			else if( !empty($facebook_id) ){
				$query = $this->db->query("SELECT user_id,isActive FROM user WHERE facebook_id = '".$facebook_id."' LIMIT 1", $this->db);
			}
			else{
					return array('status'=>'failed','message'=>'Invalid email Id');
				}

			// checking record exist in database 
				if($query->num_rows() > 0)
				{
					$row = $query->result();
								
					$row=$row[0];
					// If success everythig is good send header as "OK" and user details
					//$this->response($this->json($row), 200);
					//print_r($row);
					if(!empty( $row->user_id )){
						if($row->isActive == 'yes') { 
							return array('status'=>'success','user_id'=>$row->user_id);
						}
						else {
							return array('status'=>'failed','message'=>'Your account blocked from admin');	
						}
					}
					else
						return array('status'=>'failed','message'=>'Invalid credential');
				
				}
				else{
					
					$query = $this->db->query("SELECT user_id FROM user WHERE `email_id` = '$email' LIMIT 1", $this->db);

					if($query->num_rows() > 0)
					{
						return array('status'=>'failed','message'=>'Password is wrong');
					}
					else{
						return array('status'=>'failed','message'=>'User does not exist');	
					}
				}

		}
	}

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

    public function Register($values)
    {
			// checking email id not empty

			if(filter_var($values['email_id'], FILTER_VALIDATE_EMAIL) && empty($values['facebook_id'])){
					
				// if user does not exist, create new user record
				if($this->CheckIfUserExists( $values['email_id'] )==true) {
					$password = $values['password'];
					$values['password'] = myencrypt($password);
					$records=array();
					$records=$values;
					$records['isActive']='yes';
					$records['created_date'] = date('Y-m-d H:i:s');
					$records['updated_date'] = date('Y-m-d H:i:s');
					
					$this->db->insert('user',$records);
					$last_inserted_id = $this->db->insert_id();
					
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
					$content .= '<p style="color:#6f6f6f; font-size:14px; font-family:Arial, Helvetica, sans-serif; margin:0; padding:0 0 15px 0;"><br/>Welcome sports fan!</p>';
					$content .= '<p style="color:#6f6f6f; font-size:14px; font-family:Arial, Helvetica, sans-serif; margin:0; padding:0 0 15px 0;">Use the Sportshub365 app to find that perfect venue to watch all important games, wherever you may be.</p>';
					$content .= '<p style="color:#6f6f6f; font-family:Arial, Helvetica, sans-serif; font-size:14px; line-height:18px; margin:0; padding:0 0 15px 0;">
	Sportshub365 is a worldwide app. Use it in your home town, or on holiday.</p>';
					$content .= '<p style="color:#6f6f6f; font-family:Arial, Helvetica, sans-serif; font-size:14px; line-height:18px; margin:0; padding:0 0 15px 0;">
	Get notified with all the latest sports news from around the world.</p>';
	$content .= '<p style="color:#6f6f6f; font-family:Arial, Helvetica, sans-serif; font-size:14px; line-height:18px; margin:0; padding:0 0 15px 0;">
	Automatically enter our monthly competition, to win two tickets to major sportsevent in Europe!</p>';
					$content .= '<p style="color:#6f6f6f; font-family:Arial, Helvetica, sans-serif; font-size:14px; line-height:18px; margin:0; padding:0 0 15px 0;">
	Don\'t forget your login detail!</p>';
					$content .= '<p style="color:#6f6f6f; font-family:Arial, Helvetica, sans-serif; font-size:14px; line-height:18px; margin:0; padding:0 0 15px 0;">
	<strong>Email :</strong> '.$values['email_id'].'<br/><strong>Password :</strong> '.$password.'</p>';
					$content .= '<div style="width:100%; float:left; background:#131e38; height: auto; padding-bottom: 10px;text-align:center; line-height:18px; color:#fff; font-family:Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold;"><br />If you have any questions or would like any more information please feel free to contact us at, <br /> <a href="mailto:info@sportshub365.com" style="text-decoration:none; color:#dab503;">info@sportshub365.com</a>&nbsp;&nbsp;&nbsp;Tel: +44 208 705 0525 <br />&nbsp; </div>';
					$content .= '</div></div></body></html>';
					$to = $values['email_id'];
					$subject = "Welcome to Sportshub365 APP";
				
					$headers = "MIME-Version: 1.0" . "\r\n";
					$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
					$headers .= 'From: Sportshub365<info@sportshub365.com>' . "\r\n";
					$mail_status = mail($to,$subject,$content,$headers);
					return array('status'=>'success','user_id'=>$last_inserted_id);
			}
				else{
					return array('status'=>'failed','message'=>'User already exist with same email id');

				}
			}
			else if( !empty($values['facebook_id']) ){ 
				$check_fb_id = $this->GetFBID($values['facebook_id']); 
				
				if(count($check_fb_id)==0) {
					if(!empty($values['email_id'])) {
						if($this->CheckIfUserExists( $values['email_id'] )==false){ 
							
							$user = $this->GetUserID($values['email_id']);
							$user_id = $user['user_id'];
							
							$password = $values['password'];
							$values['password'] = myencrypt($password);
							
							$records=array();
							$records=$values;
							$records['isActive']='yes';
							$records['created_date'] = date('Y-m-d H:i:s');
							$records['updated_date'] = date('Y-m-d H:i:s');
							
							$this->db->where('user_id', $user_id);
							$this->db->update('user',$records);
							
							return array('status'=>'success','user_id'=>$user_id);
						}	
						else {
							$password = $values['password'];
							$values['password'] = myencrypt($password);
							
							$records=array();
							$records=$values;
							$records['isActive']='yes';
							$records['created_date'] = date('Y-m-d H:i:s');
							$records['updated_date'] = date('Y-m-d H:i:s');
							//print_r($records); die;
							$this->db->insert('user',$records);
							$last_inserted_id = $this->db->insert_id();
							
							return array('status'=>'success','user_id'=>$last_inserted_id);
						}
					}	
					else {
							$password = $values['password'];
							$values['password'] = myencrypt($password);
							$values['email_id'] = '';
							$records=array();
							$records=$values;
							$records['isActive']='yes';
							$records['created_date'] = date('Y-m-d H:i:s');
							$records['updated_date'] = date('Y-m-d H:i:s');
							
							$this->db->insert('user',$records);
							
							$last_inserted_id = $this->db->insert_id();
							return array('status'=>'success','user_id'=>$last_inserted_id);
					}	
				}
				else {
					return array('status'=>'success','user_id'=>$check_fb_id['user_id']);
				}
			}	
			else{
					return array('status'=>'failed','message'=>'Invalid email Id');
			}

    }
	
	public function Update($values, $userid)
    {
			// checking email id not empty
		if(!empty($values['email_id'])) {	
			if(filter_var($values['email_id'], FILTER_VALIDATE_EMAIL)){
					
					$records=array();
					$records=$values;
					$records['isActive']='yes';
					$records['updated_date'] = date('Y-m-d H:i:s');
					
					$this->db->where('user_id', $userid);
					$this->db->update('user', $records);
					
					$last_inserted_id= $this->db->insert_id();
					return array('status'=>'success');
		}	
			else{
					return array('status'=>'failed','message'=>'Invalid email Id');
			}
		}
		else {
				$records=array();
				$records=$values;
				$records['isActive']='yes';
				$records['updated_date'] = date('Y-m-d H:i:s');
				
				$this->db->where('user_id', $userid);
				$this->db->update('user', $records);
				
				$last_inserted_id= $this->db->insert_id();
				return array('status'=>'success');
		}
    }
	
	public function ForgetPassword($values) {
	
		if(filter_var($values['email_id'], FILTER_VALIDATE_EMAIL)){ 
			$password = $this->generateRandomString();
			$email = $values['email_id'];
			
			$records = array();
			$records['password'] = myencrypt($password); 
			
			$this->db->where('email_id', $email);
			$this->db->update('user', $records);
			
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
				$content .= '<p style="color:#6f6f6f; font-size:14px; font-family:Arial, Helvetica, sans-serif; margin:0; padding:0 0 30px 0;"><br/>Password successfully changed.</p>';
				$content .= '<p style="color:#6f6f6f; font-family:Arial, Helvetica, sans-serif; font-size:14px; line-height:18px; margin:0; padding:0 0 15px 0;">
Your new Sportshub365 app password for the account '.$email.' has been set.</p>';
				$content .= '<p style="color:#6f6f6f; font-family:Arial, Helvetica, sans-serif; font-size:14px; line-height:18px; margin:0; padding:0 0 15px 0;">
You can now access your account with below details. Don\'t forget your login detail!</p>';
				$content .= '<p style="color:#6f6f6f; font-family:Arial, Helvetica, sans-serif; font-size:14px; line-height:18px; margin:0; padding:0 0 15px 0;">
<strong>Email :</strong> '.$email.'<br/><strong>Password :</strong> '.$password.'</p>';

				$content .= '<div style="width:100%; float:left; background:#131e38; height: auto; padding-bottom: 10px;text-align:center; line-height:18px; color:#fff; font-family:Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold;"><br />If you have any questions or would like any more information please feel free to contact us at, <br /> <a href="mailto:info@sportshub365.com" style="text-decoration:none; color:#dab503;">info@sportshub365.com</a>&nbsp;&nbsp;&nbsp;Tel: +44 208 705 0525 <br />&nbsp; </div>';
				
				$content .= ' </p>';
				$content .= '</div></div></body></html>';
				$to = $email;
				$subject = "New Password - Sportshub365 APP";
			
				$headers = "MIME-Version: 1.0" . "\r\n";
				$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
				$headers .= 'From: Sportshub365<info@sportshub365.com>' . "\r\n";
				$mail_status = mail($to,$subject,$content,$headers);
				return array('status'=>'success', 'password' => $password );
		}
		else {
			return array('status'=>'failed','message'=>'Invalid email Id');
		}
	}
	
	public function generateRandomString($length = 10) {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
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
   
    public function GetTeam($sportid, $search_text)
    {
		$cond = "WHERE deleted_on is NULL ";
		
		if(!empty($sportid)) $cond.=" AND rel_sport_id = '$sportid' ";
		if(!empty($search_text)) $cond.=" AND team_name like '%$search_text%' ";
		
	    $sql="select * from team $cond";
	    $query=$this->db->query($sql);
	    $rs=$query->result();
	   
	    return $rs;
     }
     public function GetUserDetails($user_id)
     {
     	return $this->db_query->FetchSingleInformation('user','user_id~email_id~firstname~lastname~gender~phone~country~facebook_id',"user_id='$user_id'");
     }
	 public function GetUserID($email)
     {
     	return $this->db_query->FetchSingleInformation('user','user_id',"email_id='$email'");
     }
	 public function GetFBID($facebook_id)
     {
     	return $this->db_query->FetchSingleInformation('user','user_id',"facebook_id='$facebook_id'");
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



	public function get_request_method(){
			return $_SERVER['REQUEST_METHOD'];
	}
}

?>