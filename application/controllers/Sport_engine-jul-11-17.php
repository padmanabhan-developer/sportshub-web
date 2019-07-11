<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sport_engine extends MY_Controller {

        function __construct()
          {
           parent :: __construct();
           $this->load->model('Client_model');
          
        }
        public function index()
        {
                $this->load->helper('url');
                $server_url = site_url('http://liveonsat.com/sh365/welcome/');
				//$server_url = site_url('http://localhost:81/sportshub/sport_engine/');
				//echo $server_url; die;
                $this->load->library('xmlrpc');

               // $this->xmlrpc->server('http://liveonsat.com/sh365/welcome/', 80);
			    $this->xmlrpc->server('http://liveonsat.com/sh365/welcome/', 80);
			   //$this->xmlrpc->server('http://localhost:81/liveonsat/sh365/welcome', 81);
                $this->xmlrpc->method('GetData'); 
                $dat=date('Y-m-d H:i:s');
                $last_val = $this->Client_model->GetLastSyncVal();
				//$last_date = '';
                $date = new DateTime();
                $date->setTimezone(new DateTimeZone('Europe/London'));
                $datestr = $date->format('Y-m-d H:i:s');
                $datestr . "\n";

                $request = $last_val;
				/*echo "<pre>";
				print_r($last_val); die;
                */
                $this->xmlrpc->request($request);
				//$this->xmlrpc->set_debug(TRUE);

                if ( ! $this->xmlrpc->send_request())
                {
                echo  $this->xmlrpc->display_error();
                 $this->xmlrpc->display_response();
                }
                else
                {

                 $this->Client_model->SetSyncDate($datestr);

 
                 $sport_list=$this->xmlrpc->display_response();
				 //echo "<pre>";
               	//print_r($sport_list);
                 //return false;
                if(count($sport_list['channel']) > 0){
					$this->Client_model->SendChannelToDatabase($sport_list['channel']);
				}
				
				//die;
                if(count($sport_list['channel_list']) > 0){
					$this->Client_model->SendChannelListToDatabase($sport_list['channel_list']);
				}
				if(count($sport_list['fixture_channel_list']) > 0){
					$this->Client_model->SendChannelListFixtureListToDatabase($sport_list['fixture_channel_list']);
				}
				if(count($sport_list['sport']) > 0){
					$this->Client_model->SendSportToDatabase($sport_list['sport']);
				}
				if(count($sport_list['competition']) > 0){
					$this->Client_model->SendCompetitionToDatabase($sport_list['competition']);
				}
				if(count($sport_list['competition_country']) > 0){
					//$this->Client_model->SendCompetitionCountyToDatabase($sport_list['competition_country']);
				}
				if(count($sport_list['competition_geographic']) > 0){
					//$this->Client_model->SendCompetitionGeographicToDatabase($sport_list['competition_geographic']);
				}
				if(count($sport_list['competition_team']) > 0){
					//$this->Client_model->SendCompetitionTeamToDatabase($sport_list['competition_team']);
				}
				if(count($sport_list['fixture']) > 0){
					$this->Client_model->SendFixtureToDatabase($sport_list['fixture']);
				}
				if(count($sport_list['team']) > 0){
					$this->Client_model->SendTeamDatabase($sport_list['team']);
				}
				if(count($sport_list['team_grouping']) > 0){
					//$this->Client_model->SendTeamGroupingToDatabase($sport_list['team_grouping']);
				}

                                 
			$arrData= array(
             
             'name' => 'test',
             'email' => 'cron@test.com',
             'address' =>'delhi',
             'password' => 'test123' 
           );
           
            $this->Client_model->RegisterSubscription($arrData);
              
           echo "success";
               //print_r($sport_list['fixture']);
                 /*
                                 
                 */
                // 

                }
        }
       
}