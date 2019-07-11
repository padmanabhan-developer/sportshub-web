<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH.'/libraries/REST_Controller.php';

class Api extends REST_Controller {

	public function __construct()
	{
 		parent::__construct();
	
	}
		
	

	public function login_post()
	{
		if($_SERVER['REQUEST_METHOD'] != "POST")
		{
		 $this->response('Not Acceptable',406);
		}
		$this->load->model('User_model');
		$this->load->model('Api_model');

		$facebook_id = $this->input->get('facebook_id');		
		$email = $this->input->get('email');		
		$password = $this->input->get('password');

		
		$resp = array();
		$team_arr = array();
		$sport_arr = array();
		$league_arr = array();

		$response_login=$this->User_model->CheckUser( $email , myencrypt($password) , $facebook_id );


		if($response_login['status']=='success')
		{   
			//$this->data['user_info']=array('status'=>'success');
			$fev_leagues=$this->Api_model->GetFavoriteCompetition($response_login['user_id']);
			$league_arr = array();
			foreach($fev_leagues as $list)
		     {

		      $league_arr[]=$list['rel_competiton_id'];
		     }
			$fev_team=$this->Api_model->GetFavoriteTeam($response_login['user_id']);
			$team_arr = array();
			foreach($fev_team as $list)
		     {

		      $team_arr[]=$list['rel_team_id'];
		     }
			$fev_sport =$this->Api_model->GetFavoriteSport($response_login['user_id']);
			$sport_arr = array();
			foreach($fev_sport as $list)
		     {

		      $sport_arr[]=$list['rel_sport_id'];
		     }

			$user_info=$this->User_model->GetUserDetails($response_login['user_id']);
			//$resp=$this->data['user_info'];

			$resp['status']='success';
			$resp['user_id']=$user_info['user_id'];
			$resp['firstname']=$user_info['firstname'];
			$resp['lastname']=$user_info['lastname'];
			$resp['email']=$user_info['email_id'];
			$resp['gender']=$user_info['gender'];
			$resp['phone']=$user_info['phone'];
			$resp['country']=$user_info['country'];
			$resp['favorite_teams'] = $team_arr;
			$resp['favorite_sports']	= $sport_arr;
			$resp['favorite_leagues']=$league_arr;
			$this->response($resp, 200);
		}
		else  $this->response($response_login, 200);

		
		
	}

	public function register_post()
	{
		if($_SERVER['REQUEST_METHOD'] != "POST")
		{
		 $this->response('Not Acceptable',406);
		}

		$this->load->model('User_model');

		/*
		* email_id
		* password
		* country
		*/
			
		$email_id = $this->input->get('email');
		$password = $this->input->get('password');

		$firstname = $this->get('firstname');
		$lastname = $this->get('lastname');
		
		$gender = $this->get('gender');
		$phone = $this->get('phone');
		$country = $this->input->get('country',null);
		$facebook_id = $this->get('facebook_id');
		
		if(empty($country) || $country==false)
			$country=NULL;
		
		
		// $preference_id = $this->post('preference_id');
		if(empty($email_id)){
			$this->response(array('status'=>'failed','message'=>'Email id is required'),200);
		}
		else if(empty($password)){
			$this->response(array('status'=>'failed','message'=>'Password cannot be empty'),200);
		}
		else{

			if(empty($country) || $country==false)
				$country=NULL;

			$records=array();
			$records['email_id']=$email_id;
			$records['password']=myencrypt($password);
			$records['firstname']=$firstname;
			$records['lastname']=$lastname;
			$records['gender']=$gender;
			$records['phone']=$phone;
			$records['country']=$country;
			$records['facebook_id']=$facebook_id;
			//$records['preference_id']=$preference_id;

			$response=$this->User_model->Register($records);

			if($response['status']=='success'){

				$response['email']=$email_id;
				$response['firstname']=$firstname;
				$response['lastname']=$lastname;
				$response['gender']=$gender;
				$response['phone']=$phone;
				$response['country']=$country;
				$response['facebook_id']=$facebook_id;

				$this->response($response, 200);

			}else{
				
				$this->response($response, 200);
			}
			
		}

	}


	public function sports_get()
	{

		if($_SERVER['REQUEST_METHOD'] != "GET")
		{
		 $this->response('Not Acceptable',406);
		}

		$this->load->model('Sports_model');
		$sync_date=$this->input->get('sync_date');
		$offset=$this->input->get('offset');
		$limit=$this->input->get('limit');

		$sports_list=$this->Sports_model->GetSportsList($sync_date,$offset,$limit);
		$deleted_sports_list=$this->Sports_model->GetDeletedSportsList();

		if( count($sports_list)>0 || count($deleted_sports_list) >0 )
		{
			$this->response( array(
								'status'=>'success',
								'sports' => $sports_list,
								'deleted' => $deleted_sports_list ), 200);
		}
		else
			$this->response(array('status'=>'failed','message'=>'No records in database'),200);

			
	}

	public function leagues_get()
	{

		if($_SERVER['REQUEST_METHOD'] != "GET")
		{
		 $this->response('Not Acceptable',406);
		}

		$this->load->model('League_model');
		$user_key=$this->input->get('user_key');// We are not using this variable any where. It wiil use later
		$sport_id=$this->input->get('sport_id');
		$sync_date=$this->input->get('sync_date');
		$offset=$this->input->get('offset');
		$limit=$this->input->get('limit');
		$deleted_league_list=$this->League_model->GetDeletedLeagueList();

		$competition_list_arr=$this->League_model->GetCompetition($user_key,$sport_id,$sync_date,$offset,$limit);
		$resp_league = array(
			'status'=>'success',
								'leagues' => $competition_list_arr,
								'deleted' => $deleted_league_list );
		if(count($competition_list_arr)>0  || count($deleted_league_list)>0)
		{
			$this->response($resp_league, 200);
		}
		else
			$this->response(array('status'=>'failed','message'=>'No records found in database for sport id'),200);
	
	
	}

	//geting all fixture list on the basis of competition id and current date.
	public function matches_get()
	{

		if($_SERVER['REQUEST_METHOD'] != "GET")
		{
		 $this->response('Not Acceptable',406);
		}

		$this->load->model('Matches_model');
		$rel_competition_id=$this->get('competition_id');
		$user_key=$this->get('user_key');// We are not using this variable any where. It wiil use later

		$sync_date=$this->input->get('sync_date');
		$offset=$this->input->get('offset');
		$limit=$this->input->get('limit');

		$deleted_match_list=$this->Matches_model->GetDeletedMatcheList();

		$match_list_arr=$this->Matches_model->GetMatches($rel_competition_id,$sync_date,$offset,$limit);

		$resp_league = array(
			'status'=>'success',
			'deleted' => $deleted_match_list,
								'matches' => $match_list_arr
								 );

		if(count($match_list_arr)>0 || count($deleted_match_list)>0)
		{
			$this->response($resp_league, 200);
		}
		else
		$this->response(array('status'=>'failed','message'=>'No records found in database for competition id and date'),200);
	
		
	}

	// method for geting all team information
	public function teamlist_get()
	{

		if($_SERVER['REQUEST_METHOD'] != "GET")
		{
		 $this->response('Not Acceptable',406);
		}

		$this->load->model('User_model');
		$team_list_arr=$this->User_model->GetTeam();
		if(count($team_list_arr)>0)
		{
			$this->response(array('status'=>'success','team'=>$team_list_arr), 200);
		}
		else
			$this->response(array('status'=>'failed','message'=>'No records in database'),200);
	
	
	}

	public function setfavorite_post()
	{
		if($_SERVER['REQUEST_METHOD'] != "POST")
		{
		 $this->response('Not Acceptable',406);
		}
		$this->load->model('Api_model');
		$user_key = $this->input->get('ref_user_key');
		$sport_keys = $this->input->get('sport_keys');
		$league_keys = $this->input->get('competition_keys');
		$team_keys = $this->input->get('team_keys');
		
		if( empty($league_keys) )
			$league_keys  = array();
			$response_comp=$this->Api_model->MakeFavoriteCompetition($user_key,$league_keys);

		if( empty($team_keys) )
			$team_keys  = array();
		
			$response_team=$this->Api_model->MakeFavoriteTeam($user_key,$team_keys);

		if( empty($sport_keys) )
			$sport_keys  = array();
		
			$response_sport =$this->Api_model->MakeFavoriteSport($user_key,$sport_keys);

		$resp_arr = array(
			'status'=>'success',
			'leagues'=>$response_comp['status'],
			'sports'=>$response_sport['status'],
			'teams'=>$response_team['status'] );

	
		
		$this->response($resp_arr, 200);
		
	}
	public function getfavorite_get()
	{
		if($_SERVER['REQUEST_METHOD'] != "GET")
		{
		 $this->response('Not Acceptable',406);
		}
		$this->load->model('Api_model');
		$user_key = $this->get('ref_user_key');
					
		$responce_comp=$this->Api_model->GetFavoriteCompetition($user_key);
		
		$responce_team=$this->Api_model->GetFavoriteTeam($user_key);
		$responce_sport =$this->Api_model->GetFavoriteSport($user_key);

		$resp_arr = array(
			'status'=>'success',
								'favorite_teams' => $responce_team,
								'favorite_sports' => $responce_sport,
								'favorite_leagues' => $responce_comp
								 );


		$this->response($resp_arr, 200);
	}
	/*
	public function favourites_get()
	{

		if($_SERVER['REQUEST_METHOD'] != "GET")
		{
		 $this->response('Not Acceptable',406);
		}

		$this->load->model('User/User_model');
		$user_id=$this->get('user_id');
		
		$favourite_sports_arr=$this->User_model->GetFavouriteSport($user_id);
		if(count($favourite_sports_arr)>0)
		{
			$this->response($favourite_sports_arr, 200);
		}
		$favourite_players_arr=$this->User_model->GetFavouritePlayers($user_id);
		if(count($favourite_players_arr)>0)
		{
			$this->response($favourite_players_arr, 200);
		}
		
		$favourite_team_arr=$this->User_model->GetFavouriteTeam($user_id);
		if(count($favourite_team_arr)>0)
		{
			$this->response($favourite_team_arr, 200);
		}
		

		else
			$this->response(array('status'=>'failed','message'=>'No records found in database for email and password'),200);
	}*/

	public function schedules_get()
	{

		if($_SERVER['REQUEST_METHOD'] != "GET")
		{
		 $this->response('Not Acceptable',406);
		}

		$this->load->model('Api_establishments_model');
		
		$user_key = $this->get('user_key');// We are not using this variable any where. It wiil use later
		$sync_date=$this->input->get('sync_date');
		$offset=$this->input->get('offset');
		$limit=$this->input->get('limit');
			
		$schedule_list_arr=$this->Api_establishments_model->GetEstablishmentSchedules( $sync_date , $offset , $limit );

		$schedules = array('status'=>'success','establishments' => $schedule_list_arr);

			if( count($schedule_list_arr)>0 )
			{
				$this->response($schedules, 200);
			}
			else
				$this->response(array('status'=>'failed','message'=>'No records found in database'),200);
		
	}

	public function establishments_get()
	{

		if($_SERVER['REQUEST_METHOD'] != "GET")
		{
		 $this->response('Not Acceptable',406);
		}

		$this->load->model('Api_establishments_model');
		$rel_sport_id = $this->input->get('sport_id');
		$league_id = $this->input->get('league_id');
		$fixture_id = $this->input->get('fixture_id');
		$user_key = $this->input->get('user_key');// We are not using this variable any where. It wiil use later
		if( empty($user_key) )
			$user_key = 0;
		$latitude = $this->input->get('latitude');
		$longitude = $this->input->get('longitude');
		$sync_date=$this->input->get('sync_date');
		$offset=$this->input->get('offset');
		$limit=$this->input->get('limit');
		$establishment_list_arr=$this->Api_establishments_model->GetEstablishment( $user_key , $rel_sport_id,
		$league_id,$fixture_id,$latitude,$longitude,$sync_date,$offset,$limit);
		$resp_league = array('status'=>'success','establishments' => $establishment_list_arr);

		if(!empty($latitude) && !empty($longitude))
		{
			if( count($establishment_list_arr)>0 )
			{
				$this->response($resp_league, 200);
			}
			else
			$this->response(array('status'=>'failed','message'=>'No records found in database'),200);
		}
		else
			$this->response(array('status'=>'failed','message'=>'Latitude and Latitude must be compulsory'),200);
	
		
	}

	public function establishment_details_get()
	{

		if($_SERVER['REQUEST_METHOD'] != "GET")
		{
		 $this->response('Not Acceptable',406);
		}

		$this->load->model('Api_establishments_model');
		$est_ref = $this->get('establishment_key');
		$user_key = $this->get('user_key');// We are not using this variable any where. It wiil use later
		$sync_date=$this->input->get('sync_date');
		$offset=$this->input->get('offset');
		$limit=$this->input->get('limit');
			
		$offers=$this->Api_establishments_model->GetEstablishmentOffers($est_ref , $sync_date , $offset , $limit );
		$events=$this->Api_establishments_model->GetEstablishmentEvents($est_ref , $sync_date , $offset , $limit );

		$responseData = array(
								'status'=>'success',
								'offers' => $offers,
								'events' => $events
								);		

			if( count($offers)>0 || count($events)>0 )
			{
				$this->response($responseData, 200);
			}
			else
				$this->response(array('status'=>'failed','message'=>'No records found in database'),200);
		
	}
	// geting static new from model not from db
	public function latestnews_get()
	{
		if($_SERVER['REQUEST_METHOD'] != "GET")
		{
		 $this->response('Not Acceptable',406);
		}
		$this->load->model('News_model');
		
					
		$response=$this->News_model->get_latest_news();
		
		

		$this->response($response, 200);
	}
	public function getreviews_get()
	{
		if($_SERVER['REQUEST_METHOD'] != "GET")
		{
		 $this->response('Not Acceptable',406);
		}
		$user_key = $this->get('user_key');
		$est_key = $this->get('est_key');
		$sync_date = $this->get('sync_date');
		$offset = $this->get('offset');
		$limit = $this->get('limit');

		$this->load->model('Api_establishments_model');	
					
		$reviews=$this->Api_establishments_model->getReviews($est_key , $sync_date , $offset , $limit );
		$deleted=$this->Api_establishments_model->getDeletedReviews($est_key , $sync_date , $offset , $limit );
		
		if( !empty($reviews) || !empty($deleted) )
			$this->response(array('status'=>'success','reviews'=>$reviews,'deleted'=>$deleted), 200);
		else
			$this->response(array('status'=>'failed'), 200);
	}


	public function setreviews_post()
	{
		if($_SERVER['REQUEST_METHOD'] != "POST")
		{
			$this->response('Not Acceptable',406);
		}
		$this->load->model('Api_establishments_model');
		$user_key = $this->input->get('user_key');
		$est_key = $this->input->get('est_key');
		$rating = $this->input->get('rating');
		$comment = $this->input->get('comment');
		
		if( empty($comment) ) {
			$comment = ""; }
			
		$recordArray=array();
		$recordArray['user_ref']=$user_key;
		$recordArray['est_ref']=$est_key;
		$recordArray['rating']=$rating;
		$recordArray['comment']=$comment;
		
		$response=$this->Api_establishments_model->setRating($recordArray);
		
		$this->response($response, 200);
		
	}
	//Registers device for Push Notification
	//Params:
	//	devicetoken	devicetoken
	//	user_key	user id (optional)
	//	platform	ios/android with version number
	public function registerdevice_post()
	{

		if($_SERVER['REQUEST_METHOD'] != "POST")
		{
			$this->response('Not Acceptable',406);
		}

		$token = $this->get('token');
		if( empty( $token ) ){
			//Error Response: Requires Device Token
			$this->response( array(
								'status'=>'failed',
								'error' => 'Device Token is required'), 200);
		}
		else{
			//Check it exists
			//If Exists Update
			//Or Insert new
			$this->load->model('App_model');

			$values=array();
			$values['token']= $token;
			$values['user_key']= $this->get('user_key');
			$values['platform']= $this->get('platform');

			$message = $this->App_model->InsertOrUpdateDevice( $values );

			$this->response( array(
								'status'=>'success',
								'message' => $message ), 200);
		}

	}

// method for geting all competition country  information
	public function competition_country_get()
	{

		if($_SERVER['REQUEST_METHOD'] != "GET")
		{
		 $this->response('Not Acceptable',406);
		}
		$comp_country_list_arr=array();

		$this->load->model('Table_model');
		$comp_country_list_arr=$this->Table_model->GetLeagueCountry();
		if(count($comp_country_list_arr)>0)
		{
			$this->response(array('status'=>'success','competition_country'=>$comp_country_list_arr), 200);
		}
		else
			$this->response(array('status'=>'failed','message'=>'No records in database'),200);
	
	
	}

	// method for geting all competition country  information
	public function competition_geographic_get()
	{

		if($_SERVER['REQUEST_METHOD'] != "GET")
		{
		 $this->response('Not Acceptable',406);
		}
		$comp_geo_list_arr=array();

		$this->load->model('Table_model');
		$comp_geo_list_arr=$this->Table_model->GetCompetitionGeographic();
		if(count($comp_geo_list_arr)>0)
		{
			$this->response(array('status'=>'success','competition_geographic'=>$comp_geo_list_arr), 200);
		}
		else
			$this->response(array('status'=>'failed','message'=>'No records in database'),200);
	
	
	}
	// method for geting all competition team  information
	public function competition_team_get()
	{

		if($_SERVER['REQUEST_METHOD'] != "GET")
		{
		 $this->response('Not Acceptable',406);
		}
		$comp_team_list_arr=array();

		$this->load->model('Table_model');
		$comp_team_list_arr=$this->Table_model->GetCompetitionTeam();
		if(count($comp_team_list_arr)>0)
		{
			$this->response(array('status'=>'success','competition_team'=>$comp_team_list_arr), 200);
		}
		else
			$this->response(array('status'=>'failed','message'=>'No records in database'),200);
	
	
	}

	// method for geting all country team  information
	public function  country_get()
	{

		if($_SERVER['REQUEST_METHOD'] != "GET")
		{
		 $this->response('Not Acceptable',406);
		}
		$country_list_arr=array();

		$this->load->model('Table_model');
		$country_list_arr=$this->Table_model->GetCountry();
		if(count($country_list_arr)>0)
		{
			$this->response(array('status'=>'success','country'=>$country_list_arr), 200);
		}
		else
			$this->response(array('status'=>'failed','message'=>'No records in database'),200);
	
	
	}

	public function  devices_get()
	{

		if($_SERVER['REQUEST_METHOD'] != "GET")
		{
		 $this->response('Not Acceptable',406);
		}
		$devices_list_arr=array();

		$this->load->model('Table_model');
		$devices_list_arr=$this->Table_model->GetDevices();
		if(count($devices_list_arr)>0)
		{
			$this->response(array('status'=>'success','devices'=>$devices_list_arr), 200);
		}
		else
			$this->response(array('status'=>'failed','message'=>'No records in database'),200);
	
	
	}
	public function  establishment_facility_constant_get()
	{

		if($_SERVER['REQUEST_METHOD'] != "GET")
		{
		 $this->response('Not Acceptable',406);
		}
		$establishment_facility_constant_list_arr=array();

		$this->load->model('Table_model');
		$establishment_facility_constant_list_arr=$this->Table_model->GetEstablishment_facility_constant();
		if(count($establishment_facility_constant_list_arr)>0)
		{
			$this->response(array('status'=>'success','establishment_facility_constant'=>$establishment_facility_constant_list_arr), 200);
		}
		else
			$this->response(array('status'=>'failed','message'=>'No records in database'),200);
	
	
	}
	public function  establishment_subscription_free_get()
	{

		if($_SERVER['REQUEST_METHOD'] != "GET")
		{
		 $this->response('Not Acceptable',406);
		}
		$establishment_subscription_free_list_arr=array();

		$this->load->model('Table_model');
		$establishment_subscription_free_list_arr=$this->Table_model->EstablishmentSubscriptionFree();
		if(count($establishment_subscription_free_list_arr)>0)
		{
			$this->response(array('status'=>'success','establishment_subscription_free'=>$establishment_subscription_free_list_arr), 200);
		}
		else
			$this->response(array('status'=>'failed','message'=>'No records in database'),200);
	
	
	}
	
	public function  geographic_get()
	{

		if($_SERVER['REQUEST_METHOD'] != "GET")
		{
		 $this->response('Not Acceptable',406);
		}
		$geographic_list_arr=array();

		$this->load->model('Table_model');
		$geographic_list_arr=$this->Table_model->GetGeographic();
		if(count($geographic_list_arr)>0)
		{
			$this->response(array('status'=>'success','geographic'=>$geographic_list_arr), 200);
		}
		else
			$this->response(array('status'=>'failed','message'=>'No records in database'),200);
	
	
	}
	public function  grouping_get()
	{

		if($_SERVER['REQUEST_METHOD'] != "GET")
		{
		 $this->response('Not Acceptable',406);
		}
		$grouping_list_arr=array();

		$this->load->model('Table_model');
		$grouping_list_arr=$this->Table_model->GetGrouping();
		if(count($grouping_list_arr)>0)
		{
			$this->response(array('status'=>'success','grouping'=>$grouping_list_arr), 200);
		}
		else
			$this->response(array('status'=>'failed','message'=>'No records in database'),200);
	
	
	}
	public function  league_group_get()
	{

		if($_SERVER['REQUEST_METHOD'] != "GET")
		{
		 $this->response('Not Acceptable',406);
		}
		$league_group_list_arr=array();

		$this->load->model('Table_model');
		$league_group_list_arr=$this->Table_model->GetLeagueGroup();
		if(count($league_group_list_arr)>0)
		{
			$this->response(array('status'=>'success','league_group'=>$league_group_list_arr), 200);
		}
		else
			$this->response(array('status'=>'failed','message'=>'No records in database'),200);
	}
	public function  news_get()
	{

		if($_SERVER['REQUEST_METHOD'] != "GET")
		{
		 $this->response('Not Acceptable',406);
		}
		$news_list_arr=array();

		$this->load->model('Table_model');
		$news_list_arr=$this->Table_model->GetNews();
		if(count($news_list_arr)>0)
		{
			$this->response(array('status'=>'success','news'=>$news_list_arr), 200);
		}
		else
			$this->response(array('status'=>'failed','message'=>'No records in database'),200);
	}
	public function  team_grouping_get()
	{

		if($_SERVER['REQUEST_METHOD'] != "GET")
		{
		 $this->response('Not Acceptable',406);
		}
		$team_grouping_list_arr=array();

		$this->load->model('Table_model');
		$team_grouping_list_arr=$this->Table_model->GetTeamGrouping();
		if(count($team_grouping_list_arr)>0)
		{
			$this->response(array('status'=>'success','team_grouping'=>$team_grouping_list_arr), 200);
		}
		else
			$this->response(array('status'=>'failed','message'=>'No records in database'),200);
	}
	public function  timezone_get()
	{

		if($_SERVER['REQUEST_METHOD'] != "GET")
		{
		 $this->response('Not Acceptable',406);
		}
		$timezone_list_arr=array();

		$this->load->model('Table_model');
		$timezone_list_arr=$this->Table_model->GetTimezone();
		if(count($timezone_list_arr)>0)
		{
			$this->response(array('status'=>'success','timezone'=>$timezone_list_arr), 200);
		}
		else
			$this->response(array('status'=>'failed','message'=>'No records in database'),200);
	}
	
	public function  user_get()
	{

		if($_SERVER['REQUEST_METHOD'] != "GET")
		{
		 $this->response('Not Acceptable',406);
		}
		$user_list_arr=array();

		$this->load->model('Table_model');
		$user_list_arr=$this->Table_model->GetUserList();
		if(count($user_list_arr)>0)
		{
			$this->response(array('status'=>'success','user'=>$user_list_arr), 200);
		}
		else
			$this->response(array('status'=>'failed','message'=>'No records in database'),200);
	}
	
	
	public function  week_constant_get()
	{

		if($_SERVER['REQUEST_METHOD'] != "GET")
		{
		 $this->response('Not Acceptable',406);
		}
		$week_constant_list_arr=array();

		$this->load->model('Table_model');
		$week_constant_list_arr=$this->Table_model->GetWeekConstantList();
		if(count($week_constant_list_arr)>0)
		{
			$this->response(array('status'=>'success','week_constant'=>$week_constant_list_arr), 200);
		}
		else
			$this->response(array('status'=>'failed','message'=>'No records in database'),200);
	}
	
	public function image_get()
	{

		if($_SERVER['REQUEST_METHOD'] != "GET")
		{
		 	$this->response('Not Acceptable', 406);
		}
		
		$picture_id = $this->input->get('picture_id');
		$width = $this->input->get('width');
		$height = $this->input->get('height');
		
		
		$this->load->model('Api_establishments_model');
		$this->load->model('Api_thumbnail_image_model');
		
		if(empty($picture_id))
		{ 
			$this->response(array('status'=>'failed','message'=>'picture_id must be compulsory'),200);
		}
		else if(empty($width)) {
			$this->response(array('status'=>'failed','message'=>'Width must be compulsory'),200);
		}
		else if(empty($height)) {
			$this->response(array('status'=>'failed','message'=>'Height must be compulsory'),200);
		}
		else {
			$image = $this->Api_establishments_model->GetImageResize( $picture_id , $width , $height );
			
			if($image['success'] == true) {
				$this->response(array('status'=>'success','target_path'=>$image['target']), 200);;
			}
			else {
				$this->response(array('status'=>'failed','message'=>'No record found'), 200);;
			}
		}
	}
	
	public function index_get()
	{

		$data = array();

		$data[] = array('Method_name' => 'Login',
						'url' => 'api/login',
						'type' => 'POST',
						'parameters' =>'email , password',
						'response' => 'status , user_id , firstname , lastname , email , favourite_sports, favourite_leagues , favourite_team' );

	
		$data[] = array('Method_name' => 'Register',
						'url' => 'api/register',
						'type' => 'POST',
						'parameters' =>'email , password , country',
						'response' => 'status , email , country ');

		$data[] = array('Method_name' => 'Sports',
						'url' => 'api/sports',
						'type' => 'GET',
						'parameters' =>'sync_date,offset,limit',
						'response' => 'status , sports{id,name,image,},deleted');

		$data[] = array('Method_name' => 'Leagues',
						'url' => 'api/leagues',
						'type' => 'GET',
						'parameters' =>'user_key,sport_id,sync_date,offset,limit',
						'response' => 'status , leagues{id,name,isFavorite,date,sport_ref}, deleted');


		$data[] = array('Method_name' => 'Matches',
						'url' => 'api/matches',
						'type' => 'GET',
						'parameters' =>'user_key,competition_id,sync_date,offset,limit',
						'response' => 'status , Matches{id,date_time,competition_id,team1,team2} , deleted');

		$data[] = array('Method_name' => 'Setfavorite',
						'url' => 'api/setfavorite',
						'type' => 'POST',
						'parameters' =>'ref_user_key, sport_key , competition_key , team_key',
						'response' => 'status');

		$data[] = array('Method_name' => 'Getfavorite',
						'url' => 'api/getfavorite',
						'type' => 'GET',
						'parameters' =>'ref_user_key',
						'response' => 'status , favorite{favorite_competition,favorite_team,favorite_sport}');
		$data[] = array('Method_name' => 'Establishments',
						'url' => 'api/establishments',
						'type' => 'GET',
						'parameters' =>'sport_id , league_id , fixture_id , user_key , latitude , longitude , sync_date , offset,limit',
						'response' => 'status , establishments{id,title,picture,facilities}');

		$data[] = array('Method_name' => 'Establishment_details',
						'url' => 'api/establishment_details',
						'type' => 'GET',
						'parameters' =>'user_key ,  establishment_key ',
						'response' => 'status , establishments{id,title,picture,facilities[],rating,comment_count,offers[],matches[]}');

		$data[] = array('Method_name' => 'Getreviews',
						'url' => 'api/getreviews',
						'type' => 'GET',
						'parameters' =>'user_key ,  establishment_key ',
						'response' => 'status , rating{est_ref,rating,comment}');
		$data[] = array('Method_name' => 'setreviews',
						'url' => 'api/setreviews',
						'type' => 'POST',
						'parameters' =>'user_key, establishment_key , rating , comment',
						'response' => 'status');
		$data[] = array('Method_name' => 'Registerdevice',
						'url' => 'api/registerdevice',
						'type' => 'POST',
						'parameters' =>'token , user_key,  platform ',
						'response' => 'status , message');
		$data[] = array('Method_name' => 'Competition_country',
						'url' => 'api/competition_country',
						'type' => 'GET',
						'parameters' =>'',
						'response' => 'status , competition_country{rel_competition_id,rel_country_id,deleted_on,created_on,modified_on}');

		$data[] = array('Method_name' => 'Competition_geographic',
						'url' => 'api/competition_geographic',
						'type' => 'GET',
						'parameters' =>'',
						'response' => 'status , competition_geographic{rel_competition_id,rel_geographic_id,deleted_on,created_on,modified_on}');

		$data[] = array('Method_name' => 'Competition_team',
						'url' => 'api/competition_team',
						'type' => 'GET',
						'parameters' =>'',
						'response' => 'status , competition_team{rel_competition_id,rel_team_id,deleted_on,created_on,modified_on}');
		
		$data[] = array('Method_name' => 'country',
						'url' => 'api/country',
						'type' => 'GET',
						'parameters' =>'',
						'response' => 'status , country{country_id,country_name,image,rel_geographic_id,deleted_on,created_on,modified_on}');


		$data[] = array('Method_name' => 'Devices',
						'url' => 'api/devices',
						'type' => 'GET',
						'parameters' =>'',
						'response' => 'status , devices{id,token,user_key,platform,created_on,modified_on ,deleted_on}');

		$data[] = array('Method_name' => 'establishment_facility_constant',
						'url' => 'api/establishment_facility_constant',
						'type' => 'GET',
						'parameters' =>'',
						'response' => 'status , establishment_facility_constant{id,name,icon,type,created_on,modified_on,deleted_on}');
		
		$data[] = array('Method_name' => 'Establishment_subscription_free',
						'url' => 'api/establishment_subscription_free',
						'type' => 'GET',
						'parameters' =>'',
						'response' => 'status , establishment_subscription_free{id,name,address,email,subscribed_on}');

		$data[] = array('Method_name' => 'Geographic',
						'url' => 'api/geographic',
						'type' => 'GET',
						'parameters' =>'',
						'response' => 'status , geographic{geographic_id,geographic_name,created_on,modified_on,deleted_on}');

		$data[] = array('Method_name' => 'Grouping',
						'url' => 'api/grouping',
						'type' => 'GET',
						'parameters' =>'',
						'response' => 'status , grouping{grouping_id,grouping_name,created_on,modified_on,deleted_on}');

		$data[] = array('Method_name' => 'League_group',
						'url' => 'api/league_group',
						'type' => 'GET',
						'parameters' =>'',
						'response' => 'status , league_group{id,name,address,email,created_on,modified_on,deleted_on}');


		$data[] = array('Method_name' => 'News',
						'url' => 'api/news',
						'type' => 'GET',
						'parameters' =>'',
						'response' => 'status , news{id,date,news_feed}');


		$data[] = array('Method_name' => 'Team_grouping',
						'url' => 'api/team_grouping',
						'type' => 'GET',
						'parameters' =>'',
						'response' => 'status , team_grouping{rel_team_id,rel_grouping_id,created_on,modified_on,deleted_on}');


		$data[] = array('Method_name' => 'timezone',
						'url' => 'api/timezone',
						'type' => 'GET',
						'parameters' =>'',
						'response' => 'status , timezone{timezone_id,timezone_name,offset,location,timezone_code,deleted_on,created_on,modified_on}');


		$data[] = array('Method_name' => 'User',
						'url' => 'api/user',
						'type' => 'GET',
						'parameters' =>'',
						'response' => 'status , user{user_id,email_id,password,firstname,lastname,gender,phone,country,isActive,created_on,modified_on,deleted_on,last_login_timestamp,preference_id}');

$data[] = array('Method_name' => 'Week_constant',
						'url' => 'api/week_constant',
						'type' => 'GET',
						'parameters' =>'',
						'response' => 'status , week_constant{id,name}');
						
$data[] = array('Method_name' => 'Image_resize',
						'url' => 'api/image',
						'type' => 'GET',
						'parameters' =>'picture_id,width,height',
						'response' => 'status , target_path');	

		$this->data['resp'] = $data;
		$this->load->view('document',$this->data);
	}

	public function report_post(){
		
		$this->load->helper('file');
	    // Outputs all POST parameters to a text file. The file name is the date_time of the report reception
	    $fileName = './android_crashes/'.date('Y-m-d_H-i-s').'.txt';
	    //$file = fopen($fileName,'w') or die('Could not create report file: ' . $fileName);
	    $reportLine = "";
	    foreach($_POST as $key => $value) {
	    $reportLine .= $key." = ".$value."\n";
	        //fwrite($file, $reportLine) or die ('Could not write to report file ' . $reportLine);
	    }

	    if ( !write_file($fileName, $reportLine) )
		{
		     echo 'Unable to write the file';
		}
		else
		{
		     echo 'File written!';
		}

	    //fclose($file);

	}
	
}

?>