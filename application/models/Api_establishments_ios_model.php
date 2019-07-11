<?php
class Api_establishments_ios_model extends CI_Model
{
	
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

  	public function GetEstablishmentSchedules( $est_ref, $sync_date , $offset , $limit )
    {

	    $schedules=array();
	    $cond = "";

	    if(!empty($sync_date) && $sync_date != '' ) $cond.= " and  f.gmt_date_time >= '$sync_date' ";

	    $cond.=" ORDER BY f.gmt_date_time";


	    if($offset >0 && $limit >0 ){
	    	$cond.= " Limit  $limit  OFFSET $offset";
	    } 

	   	$sql="select 
	    f.fixture_id as id,
        esc.establishment_ref as establishment_ref,
	    f.gmt_date_time as date_time,
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
        where esc.establishment_ref = $est_ref $cond";

	    $query=$this->db->query($sql);
	    
	    if($query->num_rows()>0)
       {
         $i=0;
		 $current_timezone = $this->gettimezone();
         foreach($query->result() as $row)
         {
          	$schedules[$i]['id']=$row->id;
	          $schedules[$i]['competition_id']=$row->competition_id;
	          $schedules[$i]['team1']=$row->team1;
	          $schedules[$i]['team2']=$row->team2;
			  $CetTime = $this->ConvertOneTimezoneToAnotherTimezone($row->date_time, 'Europe/London', $current_timezone);
	          $schedules[$i]['date_time']=$CetTime;

	          $i++;
         }

       }
     
	    return $schedules;
     }
	
	public function GetSchedules( $est_ref, $sync_date , $offset , $limit )
    {
	    $schedules=array();
	    $cond = "";
		$sync_date = date('Y-m-d');	
	    if(!empty($sync_date) && $sync_date != '' ) $cond.= " and  f.gmt_date_time >= '$sync_date' ";

	    $cond.=" ORDER BY f.gmt_date_time DESC";

	    if($offset >0 && $limit >0 ){
	    	$cond.= " Limit  $limit  OFFSET $offset";
	    } 

		 $sql="select 
	     esc.id as id,
		 f.fixture_id as fixture_id,
         esc.establishment_ref as establishment_ref,
         esc.sport_id as sport_id,
	     f.rel_competition_id as competition_id
	     from fixture f 
         inner join establishment_schedule esc on
         esc.fixture_ref = f.fixture_id
         where esc.establishment_ref = $est_ref $cond";
							
	    $query=$this->db->query($sql);
	    
	    if($query->num_rows()>0)
       {
         $i=0;
         foreach($query->result() as $row)
         {
			  $schedules[$i] = $row->id.'/'.$row->fixture_id.'/'.$row->establishment_ref.'/'.$row->sport_id.'/'.$row->competition_id; 
	          $i++;
         }
       }
	   
     	if(count($schedules)>0) {
			$schedules = implode(', ', $schedules);
		}
		else {
			$schedules = '';
		}
		
	    return $schedules;
     }
	 
	public function GetEstablishment( $user_key , $rel_sport_id,$league_id,$fixture_id,$latitude,$longitude, $distance, $search_text, $sync_date,$sortby, $offset,$limit)
    {

	    $establishments=array();
		$fixq = '';
	    $cond = "WHERE est.deleted_on is NULL AND status='0' ";
		
	    if(!empty($rel_sport_id)) $cond.=" AND est_sch.sport_id='$rel_sport_id' ";

	    if(!empty($league_id)) $cond.=" AND f.rel_competition_id = '$league_id' ";

		if(!empty($fixture_id)) { $cond.=" AND est_sch.fixture_ref='$fixture_id' "; 
			$fixq = "LEFT JOIN establishment_schedule est_sch ON est.id = est_sch.establishment_ref 
					 LEFT JOIN fixture f ON f.fixture_id = est_sch.fixture_ref"; 
		}
		
		if(!empty($search_text)) $cond.=" AND est.title like '%$search_text%' ";
		
	    if(!empty($sync_date) && $sync_date != '' ) $cond.= " AND ( est.modified_on > '$sync_date' OR est_fac.modified_on > '$sync_date' OR est_sch.modified_on > '$sync_date' )";
		
		$group = '';
	    $group.=" GROUP BY est.id";
		if(!empty($distance)) $group.=" HAVING distance <='$distance' ";
		
		$order = '';
		$order_key = array();
		$cond_s = array();
		$cond_sort = array();
		
		$sort = explode(',', $sortby);
		$rating_flag = false;
		$offer_flag = false;
		foreach($sort as $key => $value) {
			if($value == 0) $order_key[] = " distance";
			if($value == 1) $rating_flag = true;
			if($value == 2) $offer_flag = true;
			
			if($value == 3) $cond_sort[] = "est_fac.est_facility_ref='11'";
			if($value == 4) $cond_sort[] = "est_fac.est_facility_ref='1' OR est_fac.est_facility_ref='3'";
			if($value == 5) $cond_sort[] = "est_fac.est_facility_ref='15' OR est_fac.est_facility_ref='17'";
			if($value == 6) $cond_sort[] = "est_fac.est_facility_ref='4'";
		}
		
		if(count($order_key)>0) {
			$order.= "ORDER BY ";
			$order_im = implode(',', $order_key);
			$order_im = trim($order_im , ', ');
			$order.= $order_im;
		}
		else {
			$order.= "ORDER BY distance";
		}
		
		if(count($cond_sort)>0) {
			$cond_s = implode(' OR ', $cond_sort);
			$cond_s = trim($cond_s , ' OR ');
			
			$cond.=" AND (" .$cond_s. ") ";
		}
		
		$limit ='';
	    if($offset >0 && $limit >0 ){
	    	$limit.= " Limit  $limit  OFFSET $offset";
	    } 

	   	$sql="SELECT est.id,
	   						est.title,
	   						GROUP_CONCAT( DISTINCT CONCAT(est_pic.id,'/',est_pic.default_image) ORDER BY est_pic.est_ref ASC SEPARATOR ', ') AS pictures ,
	   						est.short_description,
	   						est.address,
							est.city,
							est.zip,
							est.country,
	   						GROUP_CONCAT( DISTINCT CONCAT( est_fac.est_facility_ref,'/',est_fac.value ) ORDER BY est_fac.est_facility_ref ASC SEPARATOR ', ') AS facilities ,
							(2 * (3959 * ATAN2(
							          SQRT(
							            POWER(SIN((RADIANS($latitude - est.geo_lat ) ) / 2 ), 2 ) +
							            COS(RADIANS(est.geo_lat)) *
							            COS(RADIANS($latitude )) *
							            POWER(SIN((RADIANS($longitude - est.geo_lang ) ) / 2 ), 2 )
							          ),
							          SQRT(1-(
							            POWER(SIN((RADIANS($latitude - est.geo_lat ) ) / 2 ), 2 ) +
							            COS(RADIANS(est.geo_lat)) *
							            COS(RADIANS($latitude)) *
							            POWER(SIN((RADIANS($longitude - est.geo_lang ) ) / 2 ), 2 )
							          ))
							        )
							      ))
							AS distance,
							est.geo_lat AS latitude,
							est.geo_lang AS longitude,
							est.totallikes AS totallikes,
							est.created_on AS date
	   						FROM establishment_info est 
	   						LEFT JOIN establishment_profile_image est_pic ON est.id = est_pic.est_ref ".$fixq."
							LEFT JOIN establishment_facility est_fac ON est.id = est_fac.est_ref
	     					$cond $group $order $limit";
		//echo $sql; die; 					
		$query=$this->db->query($sql);
	    
	    if($query->num_rows()>0)
       {
         $i=0;
         foreach($query->result() as $row)
         {
			 if(!is_null($row->pictures)) {
				$pic_id = array(); 
				$default_id = '';
				$picture = explode(',', $row->pictures);
				 foreach($picture as $key => $value) {
				 	$data = explode('/', $value);
					if($data['1'] == 1) {
					 $default_id = $data['0'];		
					}
					 $pic_id[] = $data['0'];
				 }
				 //$default_pic_id = $this->GetImageResize($default_id, '200', '200');
				 $default_pic_id = $default_id;
				 //echo $default_pic_id['target']; die;
				 //print_r($default_pic_id); die;
				 $picture_id = implode(',', $pic_id);
			  }
			 else {
				$default_pic_id = 'null';
				$picture_id = 'null';	
			}	
			 
			  $schedules = $this->GetSchedules($row->id, $sync_date , $offset , $limit  );
			  $rch = $this->GetRatingCommentHasratedCount($row->id, $user_key );
			 
          	  $establishments[$i]['id']=$row->id;
	          $establishments[$i]['title']=$row->title;
	          $establishments[$i]['default_pic']= $default_pic_id;
			  $establishments[$i]['pictures']= $picture_id;
	          $establishments[$i]['description']=$row->short_description;
	          $establishments[$i]['address']=$row->address;
			  $establishments[$i]['city']=$row->city;
			  $establishments[$i]['zip']=$row->zip;
			  $establishments[$i]['country']=$row->country;
			  $establishments[$i]['offer']=$rch['offer'];
	          $establishments[$i]['rating']=$rch['rating'];
	          $establishments[$i]['comment_count']=$rch['comment_count'];
			  $establishments[$i]['totallikes']=$row->totallikes;
	          $establishments[$i]['has_rated']=$rch['has_rated'];
	          $establishments[$i]['facilities']=$row->facilities;
	          $establishments[$i]['schedules']=$schedules;
	          $establishments[$i]['distance']=$row->distance;
	          $establishments[$i]['latitude']=$row->latitude;
	          $establishments[$i]['longitude']=$row->longitude;
	          $establishments[$i]['date']=$row->date;

	          $i++;
         }
       }
	   if($rating_flag) {
	   	$establishments = $this->multid_sort($establishments, 'rating');
	   }
	   if($offer_flag) {
	   	$establishments = $this->multid_sort($establishments, 'offer');
	   }
	   
	    return $establishments;
     }
	 
	public function multid_sort($arr, $index) {
		$b = array();
		$c = array();
		foreach ($arr as $key => $value) {
			$b[$key] = $value[$index];
		}
		arsort($b);
		foreach ($b as $key => $value) {
			$c[] = $arr[$key];
		}
		return $c;
	}
	
	public function GetEstablishmentMapview( $user_key , $rel_sport_id,$league_id,$fixture_id,$latitude,$longitude, $distance, $search_text, $sync_date,$sortby, $offset,$limit)
    {

	    $establishments=array();
		$fixq = '';
	    $cond = "WHERE est.title != '' and est.deleted_on is NULL AND status='0' AND (est.geo_lat!=0 AND est.geo_lat!='' AND est.geo_lang!=0 AND est.geo_lang!='')";
		
	    if(!empty($rel_sport_id)) $cond.=" AND est_sch.sport_id='$rel_sport_id' ";

	    if(!empty($league_id)) $cond.=" AND f.rel_competition_id = '$league_id' ";

		if(!empty($fixture_id))  { $cond.=" AND est_sch.fixture_ref='$fixture_id' "; 
			 $fixq = "LEFT JOIN establishment_schedule est_sch ON est.id = est_sch.establishment_ref 
					 LEFT JOIN fixture f ON f.fixture_id = est_sch.fixture_ref";
		}
		
		if(!empty($search_text)) $cond.=" AND est.title like '%$search_text%' ";
		
	    if(!empty($sync_date) && $sync_date != '' ) $cond.= " AND ( est.modified_on > '$sync_date' OR est_fac.modified_on > '$sync_date' OR est_sch.modified_on > '$sync_date' )";
		
		$group = '';
	    $group.=" GROUP BY est.id";
		if(!empty($distance)) $group.=" HAVING distance <='$distance' ";
		
		$order = '';
		$order_key = array();
		$cond_s = array();
		$cond_sort = array();
		
		$sort = explode(',', $sortby);
		foreach($sort as $key => $value) {
			if($value == 0) $order_key[] = " distance";
			if($value == 1) $order_key[] = " rating DESC";
			if($value == 2) $order_key[] = " offers DESC";
			
			if($value == 3) $cond_sort[] = "est_fac.est_facility_ref='11'";
			if($value == 4) $cond_sort[] = "est_fac.est_facility_ref='1' OR est_fac.est_facility_ref='3'";
			if($value == 5) $cond_sort[] = "est_fac.est_facility_ref='15' OR est_fac.est_facility_ref='17'";
			if($value == 6) $cond_sort[] = "est_fac.est_facility_ref='4'";
		}
		
		if(count($order_key)>0) {
			$order.= "ORDER BY ";
			$order_im = implode(',', $order_key);
			$order_im = trim($order_im , ', ');
			$order.= $order_im;
		}
		else {
			$order.= "ORDER BY distance";
		}
		
		if(count($cond_sort)>0) {
			$cond_s = implode(' OR ', $cond_sort);
			$cond_s = trim($cond_s , ' OR ');
			
			$cond.=" AND (" .$cond_s. ") ";
		}
		
		$limit ='';
	    if($offset >=0 && $limit >0 ){
	    	$limit.= " Limit  $limit  OFFSET $offset";
	    } 

	   	$sql="SELECT est.id,
	   						est.title,
	   						GROUP_CONCAT( DISTINCT CONCAT(est_pic.id,'/',est_pic.default_image) ORDER BY est_pic.est_ref ASC SEPARATOR ', ') AS pictures ,
	   						est.short_description,
	   						est.address,
							est.city,
							est.zip,
							est.country,
	   						GROUP_CONCAT( DISTINCT CONCAT( est_fac.est_facility_ref,'/',est_fac.value ) ORDER BY est_fac.est_facility_ref ASC SEPARATOR ', ') AS facilities ,
							(2 * (3959 * ATAN2(
							          SQRT(
							            POWER(SIN((RADIANS($latitude - est.geo_lat ) ) / 2 ), 2 ) +
							            COS(RADIANS(est.geo_lat)) *
							            COS(RADIANS($latitude )) *
							            POWER(SIN((RADIANS($longitude - est.geo_lang ) ) / 2 ), 2 )
							          ),
							          SQRT(1-(
							            POWER(SIN((RADIANS($latitude - est.geo_lat ) ) / 2 ), 2 ) +
							            COS(RADIANS(est.geo_lat)) *
							            COS(RADIANS($latitude)) *
							            POWER(SIN((RADIANS($longitude - est.geo_lang ) ) / 2 ), 2 )
							          ))
							        )
							      ))
							AS distance,
							est.geo_lat AS latitude,
							est.geo_lang AS longitude,
							est.totallikes AS totallikes,
							est.created_on AS date
	   						FROM establishment_info est 
	   						LEFT JOIN establishment_profile_image est_pic ON est.id = est_pic.est_ref ".$fixq."
	     					LEFT JOIN establishment_facility est_fac ON est.id = est_fac.est_ref
	     					$cond $group $order $limit";
		//echo $sql; die; 					
		$query=$this->db->query($sql);
	    
	    if($query->num_rows()>0)
       {
         $i=0;
         foreach($query->result() as $row)
         {
			 if(!is_null($row->pictures)) {
				$pic_id = array(); 
				$default_id = '';
				$picture = explode(',', $row->pictures);
				 foreach($picture as $key => $value) {
				 	$data = explode('/', $value);
					if($data['1'] == 1) {
					 $default_id = $data['0'];		
					}
					 $pic_id[] = $data['0'];
				 }
				 //$default_pic_id = $this->GetImageResize($default_id, '200', '200');
				 $default_pic_id = $default_id;
				 //echo $default_pic_id['target']; die;
				 //print_r($default_pic_id); die;
				 $picture_id = implode(',', $pic_id);
			  }
			 else {
				$default_pic_id = 'null';
				$picture_id = 'null';	
			}	
			 $schedules = $this->GetSchedules($row->id, $sync_date , $offset , $limit  );
			 $rch = $this->GetRatingCommentHasratedCount($row->id, $user_key );
			 
          	  $establishments[$i]['id']=$row->id;
	          $establishments[$i]['title']=$row->title;
	          $establishments[$i]['default_pic']= $default_pic_id;
			  $establishments[$i]['pictures']= $picture_id;
	          $establishments[$i]['description']=$row->short_description;
	          $establishments[$i]['address']=$row->address;
			  $establishments[$i]['city']=$row->city;
			  $establishments[$i]['zip']=$row->zip;
			  $establishments[$i]['country']=$row->country;
	          $establishments[$i]['rating']=$rch['rating'];
	          $establishments[$i]['comment_count']=$rch['comment_count'];
			  $establishments[$i]['totallikes']=$row->totallikes;
	          $establishments[$i]['has_rated']=$rch['has_rated'];
	          $establishments[$i]['facilities']=$row->facilities;
	          $establishments[$i]['schedules']=$schedules;
	          $establishments[$i]['distance']=$row->distance;
	          $establishments[$i]['latitude']=$row->latitude;
	          $establishments[$i]['longitude']=$row->longitude;
	          $establishments[$i]['date']=$row->date;

	          $i++;
         }

       }
     
	    return $establishments;
     }
	 
	public function GetRatingCommentHasratedCount($rel_est_id, $user_key){
	 
	 //rating 
	 $sql="SELECT AVG( rating ) as rating FROM establishment_rating WHERE est_ref = '$rel_est_id' ";
	 $query=$this->db->query($sql);
	 if($query->num_rows() > 0)  { $ratingarray = $query->result_array(); 
	 	$rating = $ratingarray[0]['rating'];
	 }
	 else   { $rating = 0; }
	 //comment
	 $sql1="SELECT COUNT( comment ) as comment FROM establishment_rating WHERE comment !='' and est_ref = '$rel_est_id' ";
	 $query1=$this->db->query($sql1);
	 if($query1->num_rows() > 0)  { $commentarray = $query1->result_array(); 
	 	$comment = $commentarray[0]['comment'];
	 }
	 else { $comment = 0; }
	 //hasrated
	 $sql2="SELECT (COUNT( comment ) > 0) as hasrated FROM establishment_rating WHERE est_ref = '$rel_est_id'  AND user_ref = '$user_key' ";
	 $query2=$this->db->query($sql2);
	 if($query2->num_rows() > 0)  { $hasratedarray = $query2->result_array(); 
	 	$hasrated = $hasratedarray[0]['hasrated'];
	 }
	 else  { $hasrated = 0; }
	 //offer
	 $sql3="SELECT COUNT( id ) as offer FROM establishment_offers WHERE est_ref = '$rel_est_id' ";
	 $query3=$this->db->query($sql3);
	 if($query3->num_rows() > 0)  { $offerarray = $query3->result_array(); 
	 	$offer = $offerarray[0]['offer'];
	 }
	 else { $offer = 0; }	
	 
	 $res = array('rating' =>  $rating, 'comment_count'=>$comment, 'has_rated' => $hasrated, 'offer' => $offer);
	 
	 return $res;
  }
   
    public function GetEstablishmentDetail($rel_est_id)
    {
      $sql="select est.id,est.title,est.picture from 
	   establishment_info est where est.id='$rel_est_id' ";
	    $query=$this->db->query($sql);
	     $query=$this->db->query($sql);
		    
		   if($query->num_rows()>0)
	       {
	         $i=0;
	         foreach($query->result() as $row)
	         {
	          $establishments[$i]['id']=$row->id;
	          $establishments[$i]['title']=$row->title;
	          $establishments[$i]['picture']=$row->picture;
	          $establishments[$i]['facilities']=$this->GetEstablishmentFacilities($row->id);
	          $establishments[$i]['rating']=$this->GetAverageEstablishmentRating($row->id);
	          $establishments[$i]['comment_count']=$this->GetAverageEstablishmentComment($row->id);
	          $establishments[$i]['offers']=$this->GetAverageEstablishmentOffers($row->id);
	          $establishments[$i]['matches']=$this->GetAverageEstablishmentFixture($row->id);

	          $i++;
	         }

	       }
	     
		    return $establishments;
    }
	
  public function GetNotifications($user_id,$fev_team=array()) {
	 
	 //echo $user_id;
	 echo "</br>";
	 echo "<pre>";
	 //print_r($fev_team);
	 if(count($fev_team)>0) {
		 
		foreach($fev_team as $key => $value) {
			$team[] = $value['rel_team_id'];
		}
		 
		$team_id = implode(',', $team);
		$team_id = trim($team_id, ',');
		//echo $team_id; die;
	 	$match_details = $this->GetMatchesDetails($team_id);
		print_r($match_details);
	 }
  }
  
  public function GetMatchesDetails($team_id)
    {
	    
		$sync_date = date("Y-m-d H:i:s");
		
	    $cond = "where (f.deleted_on='' or f.deleted_on is NULL)";
	    //if(!empty($rel_competition_id)) $cond.="and f.rel_competition_id IN ($rel_competition_id) ";
		if(!empty($team_id)) $cond.="and (t1.team_id = '$team_id' or t2.team_id = '$team_id') ";
		//if(!empty($team_id)) $cond.="and (f.gmt_date_time = NOW() - INTERVAL 2 HOUR) ";
		
	    if(!empty($sync_date) && $sync_date != '' ) $cond.= " and f.gmt_date_time >= '$sync_date'";
	    
	    $cond .= " order by date_time ";

	    /*if($offset >0 && $limit >0 ){
	    	$cond.= " Limit  $limit  OFFSET $offset";
	    } */

	    $sql="select 
	    f.fixture_id as id,
	    f.gmt_date_time as date_time,
	    f.rel_competition_id as competition_id,
	    t1.team_name as team1,
	    t2.team_name as team2
	    from fixture f 
	    inner join team t1 on 
	    t1.team_id = f.rel_team_id_1 
	    inner join team t2 on 
	    t2.team_id = f.rel_team_id_2 
	    $cond";
		//echo $sql; die; 
	    $query=$this->db->query($sql);
	    if($query->num_rows() > 0) {

	    	$result = $query->result_array();

			$rs = array( );
	    	foreach( $result as $row ){
				
				$hours = date("Y-m-d H:i", strtotime('45 minutes', strtotime($sync_date)) );
				
				$hours1 = date("Y-m-d H:", strtotime('+26 hours', strtotime($sync_date)) );
				echo $hours.'______'.$row['date_time'];
				//die;
				if( strtotime($hours1) == strtotime($row['date_time']) ) { echo 'test';
					//$a = 'test';
					$rs[] = array('matchid' => $row['id'],
								  //'competition_id' => $row['competition_id'],
								  'team1' => $row['team1'],
								  'team2' => $row['team2'],
								  'date_time' => date("d-m-Y H:i:s", strtotime($row['date_time'].' + 2 hour')) );	
						continue;		  
				}
				else if( strtotime($hours) == strtotime($row['date_time']) ) { echo 'test1';
					$rs[] = array('matchid' => $row['id'],
								  //'competition_id' => $row['competition_id'],
								  'team1' => $row['team1'],
								  'team2' => $row['team2'],
								  'date_time' => date("d-m-Y H:i:s", strtotime($row['date_time'].' + 2 hour')) );
								  continue;
				}
				/*else {
					$rs= array();
				}*/
	    	}
	    }
	    else  $rs = array();
	   // print_r($rs);
	    return $rs;
     }
		
  public function GetAverageEstablishmentRating($rel_est_id)
    {
      $sql="select AVG(rating) as rating from 
	   establishment_rating  where est_ref='$rel_est_id' ";
	    $query=$this->db->query($sql);
	    if($query->num_rows() > 0)  $rs=$query->result_array();
	    else  $rs= array();
    
	    return $rs;
    }

    public function GetAverageEstablishmentComment($rel_est_id)
    {
      $sql="select id as comments from 
	   establishment_rating  where comment !='' and est_ref='$rel_est_id' ";
	    $query=$this->db->query($sql) or die();
	    if($query->num_rows() > 0)  $rs=$query->result_array();
	    else  $rs= array();
    
	    return $rs;
    }


    public function GetEstablishmentOffers($est_ref , $sync_date , $offset , $limit )
    {
     	$sql="select * from establishment_offers  where est_ref='$est_ref' and deleted_on is NULL and isactive = '1' ";

     	//if(!empty($sync_date)) $sql.=" and modified_on >= '$sync_date' ";
     	if(!empty($offset) && !empty($limit) ) $sql.=" Limit  $limit  OFFSET $offset ";
		 $sql.=" ORDER BY created_on DESC";
	  
		$query=$this->db->query($sql);
		$result=$query->result_array();

		$offers = array();
		foreach ($result as $row) {
			$ids[] = $row['id'];

			$offer = array(	'id' => $row['id'],
							'title' => $row['title'],
							'description' => $row['description'],
							'value' => $row['price_or_discount'],
							'promo_code' => $row['promo_code'],
							'date' => $row['created_on'] );

			$offers[] = $offer;

		}

		 return $offers;
    }

    public function GetEstablishmentEvents($est_ref , $sync_date , $offset , $limit )
    {
     	$sql="select * from establishment_event  where est_ref = '$est_ref' and deleted_on is NULL";

     	//if(!empty($sync_date)) $sql.=" and modified_on >= '$sync_date' ";
     	if(!empty($offset) && !empty($limit) ) $sql.=" Limit  $limit  OFFSET $offset ";
		$sql.=" ORDER BY created_on DESC";
	  
		$query=$this->db->query($sql);
		$result=$query->result_array();

		$events = array();
		foreach ($result as $row) {
			$ids[] = $row['id'];

			$event = array(	'id' => $row['id'],
							'title' => $row['title'],
							'day' => $row['date'],
							'time' => $row['time'],
							'duration' => $row['duration'],
							'date' => date("d-m-Y H:i:s", strtotime($row['created_on'])) );

			$events[] = $event;

		}

		 return $events;
    }

     public function GetAverageEstablishmentFixture($rel_est_id)
    {
      $sql="select fixture_ref from 
	   establishment_schedule  where establishment_ref='$rel_est_id' ";
	    $query=$this->db->query($sql);
	    if($query->num_rows() > 0)  $rs=$query->result_array();
	    else  $rs= array();
    
	    return $rs;
    }

    public function setRating($records)
    {
    	$user_key = $records['user_ref'];

    	$this->db->insert( 'establishment_rating',$records );
		$rating_id= $this->db->insert_id();

		$sql="select * , 
					(select CONCAT( firstname,' ',lastname) as user_name from user where user_id = $user_key ) as user_name
					from 
	   				establishment_rating 
	   				where 
	   				id ='$rating_id' limit 1";

	    $query=$this->db->query($sql);

	    if($query->num_rows() > 0){

	    	$result=$query->result_array();

	    	foreach ($result as $row) {
				
				$rating = array(	'id' => $row['id'],
								'user_ref' => $row['user_ref'],
								'est_ref' => $row['est_ref'],
								'user_name' => $row['user_name'],
								'rating' => $row['rating'],
								'comment' => $row['comment'],
								'date' => $row['modified_on'] );

				return $rating;

			}

	    }  
	    
    

	    return;
    }
	
	public function setLike($records,$status)
    {
    	$user_key = $records['user_ref'];
		$est_key = $records['est_ref'];
		
		if($status==1) { 
			$sql = "select * from establishment_like where user_ref='$user_key' and est_ref='$est_key' ";
			$query=$this->db->query($sql);
			if($query->num_rows() > 0){ 
				return array('status'=>'failed','message'=>'user already like this establishment');		
			}
			else {
				
				$sql1 = "select totallikes from establishment_info where id='$est_key' ";
				$query_1 = $this->db->query($sql1);
				$result_1 = $query_1->result_array();
				
				$sql2 = "select * from user where user_id='$user_key' ";
				$query_2 = $this->db->query($sql2);
				
				if($query_1->num_rows() > 0 && $query_2->num_rows() > 0 ){ 
				
					$this->db->insert( 'establishment_like',$records );
					
					$like = $result_1[0]['totallikes']+1;
					
					$data = array();
					$data['totallikes'] = $like;
					
					$this->db->where('id', $est_key);
					$this->db->update('establishment_info', $data);
					
					$res['totallikes'] = $like;
					$res['status'] = 'Like';
					
					return array('status'=>'success','like' => $res);
				}
				else {
					return array('status'=>'failed','message'=>"establishment or user id is wrong");	
				}
			}
		}
		else if($status==0) {
			
			$sql = "select * from establishment_like where user_ref='$user_key' and est_ref='$est_key' ";
			$query=$this->db->query($sql);
			if($query->num_rows() > 0){ 
				$sql1 = "select totallikes from establishment_info where id='$est_key' ";
				$query_1 = $this->db->query($sql1);
				$result_1 = $query_1->result_array();
				
				$sql2 = "select * from user where user_id='$user_key' ";
				$query_2 = $this->db->query($sql2);
				
				if($query_1->num_rows() > 0 && $query_2->num_rows() > 0 ){ 
				
					$sql_del =  "delete from establishment_like where user_ref='$user_key' and est_ref='$est_key'";
      				$query_del = $this->db->query($sql_del);
					
					$like = $result_1[0]['totallikes']-1;
					
					$like = ($like >= 0 )?$like:'0';
					
					$data = array();
					$data['totallikes'] = $like;
					
					$this->db->where('id', $est_key);
					$this->db->update('establishment_info', $data);
					
					$res['totallikes'] = $like;
					$res['status'] = 'Unlike';
					
					return array('status'=>'success','like' => $res);
				}
				else {
					return array('status'=>'failed','message'=>"establishment or user id is wrong");	
				}
			}
			else {
				return array('status'=>'failed','message'=>'No record found');
			}
		}
    }
	
	public function getLike($records)
    {
		$user_key = $records['user_ref'];
		$est_key = $records['est_ref'];
		
		$sql1 = "select totallikes from establishment_info where id='$est_key' ";
		$query_1 = $this->db->query($sql1);
		$result_1 = $query_1->result_array();
		$like = $result_1[0]['totallikes'];
		$res['totallikes'] = $like;
		
		if($user_key!='') {
			$sql = "select * from establishment_like where user_ref='$user_key' and est_ref='$est_key' ";
			$query=$this->db->query($sql);
					
				if($query->num_rows() > 0){ 
				
					$res['status'] = 'Like';
					return array('status'=>'success','like' => $res);
				}
				else {
					$res['status'] = 'Unlike';
					return array('status'=>'success','like' => $res);
				}
		}
		else {
			return array('status'=>'success','like' => $res);
		}
	}
    //Get Ratings by Establishment
    public function getReviews($est_key , $sync_date , $offset , $limit )
    {
    	
		$sql="select * , 
					(select CONCAT( firstname,' ',lastname) as user_name from user where user_id = user_ref ) as user_name
					from 
	   				establishment_rating 
	   				where 
	   				est_ref = '$est_key' and 
	   				deleted_on is null and is_blocked = '0' ";

	   	if( !empty($sync_date) )
	   		$sql .= " and created_on >= '$sync_date'";

	   	if( !empty($limit) )
			$sql .= " and limit $limit";

		if( !empty($offset) )
			$sql .= " and offset $offset";			
			
		$sql .= "order by created_on DESC";
		
	    $query=$this->db->query($sql);

	    //If Data exists
	    if( !empty($query) && $query->num_rows() > 0){

	    	$result=$query->result_array();

	    	$ratings = array();

	    	foreach ($result as $row) {
				
				$rating = array('id' => $row['id'],
								'user_ref' => $row['user_ref'],
								'est_ref' => $row['est_ref'],
								'user_name' => ($row['user_name']=='0 0')?'':$row['user_name'],
								'rating' => $row['rating'],
								'comment' => $row['comment'],
								'date' => $row['created_on'] );

				$ratings[] = $rating;

			}
			
			return $ratings;

	    }  
	    
    
	    //If data doesn't exists
	    return;
    }
    
    //Get Ratings by Establishment
    public function getDeletedReviews($est_key , $sync_date , $offset , $limit )
    {
    	
		$sql="select id 
					from 
	   				establishment_rating 
	   				where 
	   				est_ref ='$est_key' and 
	   				( deleted_on is not null or is_blocked = '1' )";

	   	if( !empty($sync_date) )
	   		$sql .= " and modified_on >= '$sync_date'";

	   	if( !empty($limit) )
			$sql .= " and limit $limit";

		if( !empty($offset) )
			$sql .= " and offset $offset";			

	    $query=$this->db->query($sql);

	    //If Data exists
	    if( !empty($query) && $query->num_rows() > 0){

	    	$result=$query->result_array();

	    	$deleted = array();

	    	foreach ($result as $row) {
				
				$deleted[] = $row['id'];

			}
			
			return $deleted;

	    }  
	    
    
	    //If data doesn't exists
	    return;
    }

	public function GetImageResize($pid, $width, $height) {
	
		$sql = "select picture from establishment_profile_image where id='".$pid."'";
		$query = $this->db->query($sql);
		$result = $query->result();
		if( !empty($query) && $query->num_rows() > 0){
			$image = explode('.', $result[0]->picture);
			
			$imagename = $image['0'];
			$imagepath_o = $_SERVER['DOCUMENT_ROOT'].'/images/profile/';
			$type = $image['1'];
			$imagepath_r =  $_SERVER['DOCUMENT_ROOT'].'/images/profile_resize/';
			$this->createimage($width, $height, $imagepath_o, $imagepath_r,'',$type,$imagename); 
			 
			 $target =  base_url().'images/profile_resize/'.$imagename.'_'.$width.'_'.$height.'.'.$type;
			 
			 $result = array('success' => true, 'target' => $target );
		}
		else {
			 $result = array('success' => false, 'target' => '');
		}
			
			return $result;
	}
	
	public function GetSliderData($width, $height) {
	
		$sql = "select * from slider order by created_on";
		$query = $this->db->query($sql);
		$slider_data = $query->result();
		
		if($query->num_rows() > 0){
			$result = array();
			//echo "<pre>";
			//print_r($result); die;
			$i = 0;
			foreach ($slider_data as $key => $value) {
				$image = explode('.', $value->image);
				$imagename = $image['0'];
				$imagepath_o = $_SERVER['DOCUMENT_ROOT'].'/images/slider/';
				$type = $image['1'];
				$imagepath_r =  $_SERVER['DOCUMENT_ROOT'].'/images/slider_resize/';
				$this->createimage($width, $height, $imagepath_o, $imagepath_r,'',$type,$imagename); 
				 
				 $target =  base_url().'images/slider_resize/'.$imagename.'_'.$width.'_'.$height.'.'.$type;
				 
				 $result[$i]['slidername'] = $value->slidername;
				 $result[$i]['url'] = $value->url;
				 $result[$i]['content'] = $value->desc;
				 $result[$i]['image'] = $target;
				 
				 $i++;
			} 
		}
		else {
			 $result = array();
		}
			return $result;
	}
	
	/*public function createimage($width, $height, $source, $destination, $thumb, $type, $imagename) {
			//$obj_imgl = new thumbnail_images;
			$this->load->model('Api_thumbnail_image_model');
			
			$this->Api_thumbnail_image_model->PathImgOld = $source.$imagename.".".$type;
			$this->Api_thumbnail_image_model->PathImgNew = $destination.$imagename.'_'.$width.'_'.$height."$thumb.".$type;
			$this->Api_thumbnail_image_model->NewWidth = $width;
			if($height!=''){
					$this->Api_thumbnail_image_model->NewHeight = $height;
			}
			if (!$this->Api_thumbnail_image_model->create_thumbnail_images()){
					echo "error";
			}
	}*/
	
	public function createimage($width, $height, $source, $destination, $thumb, $type, $imagename) {
			//$obj_imgl = new thumbnail_images;
			//$this->load->model('Api_thumbnail_image_model');
			
			$PathImgOld = $source.$imagename.".".$type;
			$PathImgNew = $destination.$imagename.'_'.$width.'_'.$height."$thumb.".$type;
			$Width = $width;
			if($height!=''){
					$Height = $height;
			}
			if (!$this->create_thumbnail($PathImgOld,$PathImgNew,$Width,$Height,$type)){
					echo "error";
			}
	}
	
	public function create_thumbnail($source, $destination, $thumbWidth,$thumbHeight,$type)
	{
		$extension = $type;
		$size = getimagesize($source);
		$imageWidth  = $newWidth  = $size[0];
		$imageHeight = $newHeight = $size[1];
	
		if ($imageWidth > $thumbWidth)
		{
			$newWidth  = $thumbWidth;
		}
		if ($imageHeight > $thumbHeight)
		{
			$newHeight = $thumbHeight;
		}
	
		$newImage = imagecreatetruecolor($newWidth, $newHeight);
	
		switch ($extension)
		{
			case 'jpeg':
				$imageCreateFrom = 'imagecreatefromjpeg';
				$store = 'imagejpeg';
				break;
			case 'jpg':
				$imageCreateFrom = 'imagecreatefromjpeg';
				$store = 'imagejpeg';
				break;
			case 'JPG':
				$imageCreateFrom = 'imagecreatefromjpeg';
				$store = 'imagejpeg';
				break;
			case 'png':
				$imageCreateFrom = 'imagecreatefrompng';
				$store = 'imagepng';
				break;
			case 'PNG':
				$imageCreateFrom = 'imagecreatefrompng';
				$store = 'imagepng';
				break;	
	
			case 'gif':
				$imageCreateFrom = 'imagecreatefromgif';
				$store = 'imagegif';
				break;
	
			default:
				return false;
		}
	
		$container = $imageCreateFrom($source);
		imagecopyresampled($newImage, $container, 0, 0, 0, 0, $newWidth, $newHeight, $imageWidth, $imageHeight);
		return $store($newImage, $destination);
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