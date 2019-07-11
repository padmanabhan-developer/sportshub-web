<?php
class Api_establishments_model extends CI_Model
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

  	public function GetEstablishmentSchedules( $sync_date , $offset , $limit )
    {

	    $schedules=array();
	    $cond = "";

	    if(!empty($sync_date) && $sync_date != '' ) $cond.= " WHERE est.modified_on > '$sync_date' ";

	    $cond.=" ORDER BY modified_on";


	    if($offset >0 && $limit >0 ){
	    	$cond.= " Limit  $limit  OFFSET $offset";
	    } 

	   	$sql="SELECT id, 
	   				fixture_ref, 
	   				establishment_ref, 
	   				sport_id, 
	   				competition_ref, 
	   				modified_on
	   						FROM establishment_schedule
	     					$cond";

	    $query=$this->db->query($sql);
	    
	    if($query->num_rows()>0)
       {
         $i=0;
         foreach($query->result() as $row)
         {
          	$schedules[$i]['id']=$row->id;
	          $schedules[$i]['fixture_ref']=$row->fixture_ref;
	          $schedules[$i]['establishment_ref']=$row->establishment_ref;
	          $schedules[$i]['sport_id']=$row->sport_id;
	          $schedules[$i]['competition_ref']=$row->competition_ref;
	          $schedules[$i]['date']=$row->modified_on;

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
	 
	public function GetEstablishment( $user_key , $rel_sport_id,$league_id,$fixture_id,$latitude,$longitude,$distance,$sync_date,$sortby,$offset,$limit)
    {
		$fixq = '';
	    $establishments=array();
	    $cond = "WHERE est.title != '' and est.deleted_on is NULL AND status='0'";

	    if(!empty($rel_sport_id)) $cond.=" AND est_sch.sport_id='$rel_sport_id' ";

	    if(!empty($league_id)) $cond.=" AND f.rel_competition_id = '$league_id' ";

		if(!empty($fixture_id)) { $cond.=" AND est_sch.fixture_ref='$fixture_id' ";
			$fixq = "LEFT JOIN establishment_schedule est_sch ON est.id = est_sch.establishment_ref 
					 LEFT JOIN fixture f ON f.fixture_id = est_sch.fixture_ref";
		}

	    if(!empty($sync_date) && $sync_date != '' ) $cond.= " AND ( est.modified_on > '$sync_date' OR est_fac.modified_on > '$sync_date' OR est_sch.created_on > '$sync_date' OR est_pic.created_date > '$sync_date' )";

	    //$cond.=" GROUP BY est.id HAVING distance <=$distance ORDER BY distance , est.modified_on ";
		
		$group = '';
	    $group.=" GROUP BY est.id";
		if(!empty($distance)) $group.=" HAVING distance <='$distance' ";
		
		/*$order = '';
		$order.= "ORDER BY distance";*/
		
		// order start
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
			//if($value == 2) $order_key[] = " offers DESC";
			
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
		// order end
		 
		$limits = '';
	    if($offset >0 && $limit >0 ){
	    	$limits.= " Limit  $limit  OFFSET $offset";
	    } 

	   	$sql="SELECT est.id,
	   						est.title,
	   						GROUP_CONCAT( DISTINCT est_pic.id ORDER BY est_pic.est_ref ASC , est_pic.default_image DESC SEPARATOR ', ') AS pictures ,
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
							est.modified_on AS date
	   						FROM establishment_info est 
	   						LEFT JOIN establishment_profile_image est_pic ON est.id = est_pic.est_ref ".$fixq."
	     					LEFT JOIN establishment_facility est_fac ON est.id = est_fac.est_ref
	     					$cond $group $order $limits";
		//echo $sql; die;
	    $query=$this->db->query($sql);
	    
	    if($query->num_rows()>0)
       {
         $i=0;
         foreach($query->result() as $row)
         {
          	  $address = (($row->address!='')?$row->address:'').(($row->city!='')?','.$row->city:'').(($row->zip!='')?','.$row->zip:'').(($row->country=='' || $row->country=='--')?'':','.$row->country);
			  
			  $schedules = $this->GetSchedules($row->id, $sync_date , $offset , $limit  );
			  $rch = $this->GetRatingCommentHasratedCount($row->id, $user_key );
			  
			  $establishments[$i]['id']=$row->id;
	          $establishments[$i]['title']=$row->title;
	          $establishments[$i]['pictures']=$row->pictures;
	          $establishments[$i]['description']=$row->short_description;
	          $establishments[$i]['address']=$row->address;
			  $establishments[$i]['city']=$row->city;
			  $establishments[$i]['zip']=$row->zip;
			  $establishments[$i]['country']=$row->country;
			  $establishments[$i]['totallikes']=$row->totallikes;
	          $establishments[$i]['offer']=$rch['offer'];
	          $establishments[$i]['rating']=$rch['rating'];
	          $establishments[$i]['comment_count']=$rch['comment_count'];
	          $establishments[$i]['has_rated']=$rch['has_rated'];
	          $establishments[$i]['facilities']=$row->facilities;
	          $establishments[$i]['schedules'] = $schedules;
	          $establishments[$i]['distance']=$row->distance;
	          $establishments[$i]['latitude'] = ($row->latitude!='')?$row->latitude:0;
	          $establishments[$i]['longitude'] = ($row->longitude!='')?$row->longitude:0;
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
	
	public function GetEstablishmentMapview( $user_key , $rel_sport_id,$league_id,$fixture_id,$latitude,$longitude,$distance,$sync_date,$sortby,$offset,$limit)
    {
		$fixq = '';
	    $establishments=array();
	    $cond = "WHERE est.title != '' and est.deleted_on is NULL ";

	    if(!empty($rel_sport_id)) $cond.=" AND est_sch.sport_id='$rel_sport_id' ";

	    if(!empty($league_id)) $cond.=" AND f.rel_competition_id = '$league_id' ";

		if(!empty($fixture_id)) { $cond.=" AND est_sch.fixture_ref='$fixture_id' ";
			$fixq = "LEFT JOIN establishment_schedule est_sch ON est.id = est_sch.establishment_ref 
					 LEFT JOIN fixture f ON f.fixture_id = est_sch.fixture_ref";
		}

	    if(!empty($sync_date) && $sync_date != '' ) $cond.= " AND ( est.modified_on > '$sync_date' OR est_fac.modified_on > '$sync_date' OR est_pic.created_date > '$sync_date' )";

	    //$cond.=" GROUP BY est.id HAVING distance <=$distance ORDER BY distance , est.modified_on ";
		
		$group = '';
	    $group.=" GROUP BY est.id";
		if(!empty($distance)) $group.=" HAVING distance <='$distance' ";
		
		/*$order = '';
		$order.= "ORDER BY distance";*/
		
		// order start
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
			//if($value == 2) $offer_flag = true;
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
		// order end
		 
		$limits = '';
	    if($offset >=0 && $limit >0 ){
	    	$limits.= " Limit  $limit  OFFSET $offset";
	    } 

	   	$sql="SELECT est.id,
	   						est.title,
	   						GROUP_CONCAT( DISTINCT est_pic.id ORDER BY est_pic.est_ref ASC , est_pic.default_image DESC SEPARATOR ', ') AS pictures ,
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
							est.modified_on AS date
	   						FROM establishment_info est 
	   						LEFT JOIN establishment_profile_image est_pic ON est.id = est_pic.est_ref ".$fixq."
	     					LEFT JOIN establishment_facility est_fac ON est.id = est_fac.est_ref
	     					$cond $group $order $limits";
		//echo $sql; die;
	    $query=$this->db->query($sql);
	    
	    if($query->num_rows()>0)
       {
         $i=0;
         foreach($query->result() as $row)
         {
          	  $address = (($row->address!='')?$row->address:'').(($row->city!='')?','.$row->city:'').(($row->zip!='')?','.$row->zip:'').(($row->country=='' || $row->country=='--')?'':','.$row->country);
			  
			  $schedules = $this->GetSchedules($row->id, $sync_date , $offset , $limit  );
			  $rch = $this->GetRatingCommentHasratedCount($row->id, $user_key );
			  
			  $establishments[$i]['id']=$row->id;
	          $establishments[$i]['title']=$row->title;
	          $establishments[$i]['pictures']=$row->pictures;
	          $establishments[$i]['description']=$row->short_description;
	          $establishments[$i]['address']= $row->address;
			  $establishments[$i]['city']=$row->city;
			  $establishments[$i]['zip']=$row->zip;
			  $establishments[$i]['country']=$row->country;
	          //$establishments[$i]['offer']=$rch['offer'];
			  $establishments[$i]['totallikes']=$row->totallikes;
	          $establishments[$i]['rating']=$rch['rating'];
	          $establishments[$i]['comment_count']=$rch['comment_count'];
	          $establishments[$i]['has_rated']=$rch['has_rated'];
	          $establishments[$i]['facilities']=$row->facilities;
	          $establishments[$i]['schedules'] = $schedules;
	          $establishments[$i]['distance']=$row->distance;
	          $establishments[$i]['latitude'] = ($row->latitude!='')?$row->latitude:0;
	          $establishments[$i]['longitude'] = ($row->longitude!='')?$row->longitude:0;
	          $establishments[$i]['date']=$row->date;

	          $i++;
         }

       }
       if($rating_flag) {
	   	$establishments = $this->multid_sort($establishments, 'rating');
	   }
	   /*if($offer_flag) {
	   	$establishments = $this->multid_sort($establishments, 'offer');
	   }*/
	   
	    return $establishments;
     }
	
	public function GetEstablishmentCount( $user_key , $rel_sport_id,$league_id,$fixture_id,$latitude,$longitude,$distance,$sync_date,$sortby,$offset,$limit)
    {
		$fixq = '';
	    $establishments=array();
	    $cond = "WHERE est.title != '' and est.deleted_on is NULL ";

	    if(!empty($rel_sport_id)) $cond.=" AND est_sch.sport_id='$rel_sport_id' ";

	    if(!empty($league_id)) $cond.=" AND f.rel_competition_id = '$league_id' ";

		if(!empty($fixture_id)) { $cond.=" AND est_sch.fixture_ref='$fixture_id' ";
			$fixq = "LEFT JOIN establishment_schedule est_sch ON est.id = est_sch.establishment_ref 
					 LEFT JOIN fixture f ON f.fixture_id = est_sch.fixture_ref";
		}

	    if(!empty($sync_date) && $sync_date != '' ) $cond.= " AND ( est.modified_on > '$sync_date' OR est_fac.modified_on > '$sync_date' OR est_pic.created_date > '$sync_date' )";

	    //$cond.=" GROUP BY est.id HAVING distance <=$distance ORDER BY distance , est.modified_on ";
		
		$group = '';
	    $group.=" GROUP BY est.id";
		if(!empty($distance)) $group.=" HAVING distance <='$distance' ";
		
		/*$order = '';
		$order.= "ORDER BY distance";*/
		
		// order start
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
			//if($value == 2) $offer_flag = true;
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
		// order end
		 
		$limits = '';
	    if($offset >0 && $limit >0 ){
	    	$limits.= " Limit  $limit  OFFSET $offset";
	    } 

	   	$sql="SELECT est.id,
	   						est.title,
	   						GROUP_CONCAT( DISTINCT est_pic.id ORDER BY est_pic.est_ref ASC , est_pic.default_image DESC SEPARATOR ', ') AS pictures ,
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
							est.modified_on AS date
	   						FROM establishment_info est 
	   						LEFT JOIN establishment_profile_image est_pic ON est.id = est_pic.est_ref ".$fixq."
	     					LEFT JOIN establishment_facility est_fac ON est.id = est_fac.est_ref
	     					$cond $group $order";
		//echo $sql; die;
	    $query=$this->db->query($sql);
	    
	   if($query->num_rows()>0)
       {
		  $establishments_count = $query->num_rows();
       }else {  $establishments_count = 0;  }
	   //echo $establishments_count; die;
	    
		return $establishments_count;
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
	
	//public function GetDelBlockEstablishment( $user_key , $rel_sport_id,$league_id,$fixture_id,$latitude,$longitude,$distance,$sync_date,$offset,$limit)
//    {
//
//	    $establishments=array();
//	    $cond = "WHERE (est.deleted_on is NOT NULL OR est.status = '1') ";
//
//	    //if(!empty($rel_sport_id)) $cond.=" AND est_sch.sport_id='$rel_sport_id' ";
//
//	    //if(!empty($league_id)) $cond.=" AND f.rel_competition_id = '$league_id' ";
//
//		//if(!empty($fixture_id)) $cond.=" AND est_sch.fixture_ref='$fixture_id' ";
//
//	   /* if(!empty($sync_date) && $sync_date != '' ) $cond.= " AND ( est.modified_on > '$sync_date' OR est_fac.modified_on > '$sync_date' OR est_sch.created_on > '$sync_date' OR est_pic.created_date > '$sync_date' )";*/
//	     if(!empty($sync_date) && $sync_date != '' ) $cond.= " AND ( est.deleted_on <= '$sync_date' OR est.modified_on <= '$sync_date')";
//
//	    //$cond.=" GROUP BY est.id HAVING distance <=$distance ORDER BY distance , est.modified_on ";
//		
//		/*$group = '';
//	    $group.=" GROUP BY est.id";
//		if(!empty($distance)) $group.=" HAVING distance <='$distance' ";
//*/		
//		$order = '';
//		$order.= "ORDER BY est.modified_on DESC";
//		
//		$limit = '';
//	   /* if($offset >0 && $limit >0 ){
//	    	$limit.= " Limit  $limit  OFFSET $offset";
//	    } */
//
//	   	$sql="SELECT est.id,est.title,est.modified_on AS date
//	   						FROM establishment_info est 
//	     					$cond $order $limit";
//		//echo $sql; die;
//	    $query=$this->db->query($sql);
//	    
//	    if($query->num_rows()>0)
//       {
//         $i=0;
//         foreach($query->result() as $row)
//         {
//          	  /*$address = (($row->address!='')?$row->address:'').(($row->city!='')?','.$row->city:'').(($row->zip!='')?','.$row->zip:'').(($row->country=='' || $row->country=='--')?'':','.$row->country);
//			   $schedules = $this->GetSchedules($row->id, $sync_date , $offset , $limit  );
//*/			   
//			  $establishments[$i]['id']=$row->id;
//	          $establishments[$i]['title']=$row->title;
//	         /*$establishments[$i]['pictures']=$row->pictures;
//	          $establishments[$i]['description']=$row->short_description;
//	          $establishments[$i]['address']= $address;
//			  $establishments[$i]['totallikes']=$row->totallikes;
//	          $establishments[$i]['rating']=$row->rating;
//	          $establishments[$i]['comment_count']=$row->comment_count;
//	          $establishments[$i]['has_rated']=$row->has_rated;
//	          $establishments[$i]['facilities']=$row->facilities;
//	          $establishments[$i]['schedules']=$schedules;
//	          $establishments[$i]['distance']=$row->distance;
//	          $establishments[$i]['latitude'] = ($row->latitude!='')?$row->latitude:0;
//	          $establishments[$i]['longitude'] = ($row->longitude!='')?$row->longitude:0;*/
//	          $establishments[$i]['date']=$row->date;
//
//	          $i++;
//         }
//
//       }
//     
//	    return $establishments;
//     }

    
	public function GetDelBlockEstablishment( $user_key , $rel_sport_id,$league_id,$fixture_id,$latitude,$longitude,$distance,$sync_date,$offset,$limit)
    {

	    $establishments=array();
	    $cond = "WHERE (est.deleted_on is NOT NULL OR est.status = '1') ";

	    if(!empty($rel_sport_id)) $cond.=" AND est_sch.sport_id='$rel_sport_id' ";

	    if(!empty($league_id)) $cond.=" AND f.rel_competition_id = '$league_id' ";

		if(!empty($fixture_id)) $cond.=" AND est_sch.fixture_ref='$fixture_id' ";

	   /* if(!empty($sync_date) && $sync_date != '' ) $cond.= " AND ( est.modified_on > '$sync_date' OR est_fac.modified_on > '$sync_date' OR est_sch.created_on > '$sync_date' OR est_pic.created_date > '$sync_date' )";*/
	     if(!empty($sync_date) && $sync_date != '' ) $cond.= " AND ( est.deleted_on <= '$sync_date' OR est.modified_on <= '$sync_date')";

	    //$cond.=" GROUP BY est.id HAVING distance <=$distance ORDER BY distance , est.modified_on ";
		
		$group = '';
	    $group.=" GROUP BY est.id";
		if(!empty($distance)) $group.=" HAVING distance <='$distance' ";
		
		$order = '';
		$order.= "ORDER BY distance";
		
		$limit = '';
	    if($offset >0 && $limit >0 ){
	    	$limit.= " Limit  $limit  OFFSET $offset";
	    } 

	   	$sql="SELECT est.id,
	   						est.title,
	   						GROUP_CONCAT( DISTINCT est_pic.id ORDER BY est_pic.est_ref ASC , est_pic.default_image DESC SEPARATOR ', ') AS pictures ,
	   						est.short_description,
	   						est.address,
							est.city,
							est.zip,
							est.country,
	   						( SELECT AVG( rating ) FROM establishment_rating WHERE est_ref = est.id )  AS rating,
	   						( SELECT COUNT( comment ) FROM establishment_rating WHERE est_ref = est.id )  AS comment_count,
	   						( SELECT (COUNT( comment ) > 0) FROM establishment_rating WHERE est_ref = est.id  AND user_ref = '$user_key')  AS has_rated,
	   						GROUP_CONCAT( DISTINCT CONCAT( est_fac.est_facility_ref,'/',est_fac.value ) ORDER BY est_fac.est_facility_ref ASC SEPARATOR ', ') AS facilities ,
	   						GROUP_CONCAT( DISTINCT CONCAT( est_sch.id,'/',est_sch.fixture_ref,'/',est_sch.establishment_ref,'/',est_sch.sport_id,'/',est_sch.competition_ref ) ORDER BY est_sch.id ASC SEPARATOR ', ') AS schedules ,
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
							est.modified_on AS date
	   						FROM establishment_info est 
	   						LEFT JOIN establishment_profile_image est_pic ON est.id = est_pic.est_ref 
	   						LEFT JOIN establishment_schedule est_sch ON est.id = est_sch.establishment_ref 
	    					-- INNER JOIN competition c ON est_sch.sport_id = c.rel_sport_id 
	     					LEFT JOIN fixture f ON f.fixture_id = est_sch.fixture_ref 
	     					LEFT JOIN establishment_facility est_fac ON est.id = est_fac.est_ref
	     					$cond $group $order $limit";
		//echo $sql; die;
	    $query=$this->db->query($sql);
	    
	    if($query->num_rows()>0)
       {
         $i=0;
         foreach($query->result() as $row)
         {
          	  $address = (($row->address!='')?$row->address:'').(($row->city!='')?','.$row->city:'').(($row->zip!='')?','.$row->zip:'').(($row->country=='' || $row->country=='--')?'':','.$row->country);
			   $schedules = $this->GetSchedules($row->id, $sync_date , $offset , $limit  );
			   
			  $establishments[$i]['id']=$row->id;
	          $establishments[$i]['title']=$row->title;
	          $establishments[$i]['pictures']=$row->pictures;
	          $establishments[$i]['description']=$row->short_description;
	          $establishments[$i]['address']= $address;
			  $establishments[$i]['totallikes']=$row->totallikes;
	          $establishments[$i]['rating']=$row->rating;
	          $establishments[$i]['comment_count']=$row->comment_count;
	          $establishments[$i]['has_rated']=$row->has_rated;
	          $establishments[$i]['facilities']=$row->facilities;
	          $establishments[$i]['schedules']=$schedules;
	          $establishments[$i]['distance']=$row->distance;
	          $establishments[$i]['latitude'] = ($row->latitude!='')?$row->latitude:0;
	          $establishments[$i]['longitude'] = ($row->longitude!='')?$row->longitude:0;
	          $establishments[$i]['date']=$row->date;

	          $i++;
         }

       }
     
	    return $establishments;
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

     	if(!empty($sync_date)) $sql.=" and modified_on >= '$sync_date' ";
     	if(!empty($offset) && !empty($limit) ) $sql.=" Limit  $limit  OFFSET $offset ";
	  
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

     	if(!empty($sync_date)) $sql.=" and modified_on >= '$sync_date' ";
     	if(!empty($offset) && !empty($limit) ) $sql.=" Limit  $limit  OFFSET $offset ";
	  $sql.=" ORDER BY date ASC";
	  
		$query=$this->db->query($sql);
		$result=$query->result_array();

		$events = array();
		foreach ($result as $row) {
			$ids[] = $row['id'];

			$event = array(	'id' => $row['id'],
							'title' => $row['title'],
							'day' => ($row['gmt_date']=='0000-00-00')?$row['date']:$row['gmt_date'],
							'time' => ($row['gmt_time']=='')?$row['time']:$row['gmt_time'],
							'duration' => $row['duration'],
							'date' => $row['created_on'] );

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
		$rating_id = $this->db->insert_id();
		if($rating_id)
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
								'date' => $row['created_on'] );

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
				return array('status'=>'failed','message'=>'user already like this recipe');		
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
					return array('status'=>'success','totallikes' => $like);
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
					return array('status'=>'success','totallikes' => $like);
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
	   		$sql .= " and modified_on >= '$sync_date'";

	   	if( !empty($limit) )
			$sql .= " and limit $limit";

		if( !empty($offset) )
			$sql .= " and offset $offset";			

	    $query=$this->db->query($sql);

	    //If Data exists
	    if( !empty($query) && $query->num_rows() > 0){

	    	$result=$query->result_array();

	    	$ratings = array();

	    	foreach ($result as $row) {
				
				$rating = array(	'id' => $row['id'],
								'user_ref' => $row['user_ref'],
								'est_ref' => $row['est_ref'],
								'user_name' => $row['user_name'],
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
			 $result = array('success' => false);
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
}

?>