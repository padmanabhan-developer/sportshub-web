       

	   <?php
       $i=0;
         $val_tbl=$rav_;
         //$all_data=$all_;
         //echo json_encode($all_data);

         $date=$date1;



        $this->load->model('Establishment_model');
        $id=$this->session->userdata('email');
        $user_id=$this->Establishment_model->GetUserId($id);
        $est_user_ref_id=$user_id[0]->id;
        $establishmentuser_id=$this->Establishment_model->GetUseresiinfoId($est_user_ref_id);
        $user_est_info=$establishmentuser_id[0]->id;
        $user_data=$this->Establishment_model->GetUserSubs($user_est_info);

        foreach ($user_data as $key => $value) {

          $first_date=$value->created_on;
          $subscription_end_date=$value->subscription_end;
        }

        $current_date=date('Y-m-d');
        $end_date=date('Y-m-d  H:i:s',strtotime('+30 days',strtotime($first_date)));

       if(($end_date>=$current_date) || ($subscription_end_date>=$current_date)){
        //echo json_encode($schedules);
        
         if($schedules){
                foreach($schedules as $schedule){

                   $i++;
                        $channel=$schedule['id'];
                        $this->load->model('Establishment_model');
                        $channel_info=$this->Establishment_model->GetFixChannel($channel,$bar_id);
                        $competition_id_sports=$schedule['compid'];
                        $sport_rel_id=$this->Establishment_model->GetSportRelId($competition_id_sports);      
                        ?>
                        <?php $schedule_info=$this->Establishment_model->GetCheckSchedule($bar_id);
                        ?>
                        
                    



                      <div>
                            <div class=" blog-schedule"> 
                               <?php  
                                $result = $this->db->select('fixture_ref')->from('establishment_schedule')->where('fixture_ref', $schedule['fixture_id'])->where('establishment_ref', $bar_id)->limit(1)->get()->row();
                                if($result){
                                ?>
                                <input type="checkbox" name="sp_schedule<?=$val_tbl?><?=$i?>" onclick="gotosubmit_weak('<?=$val_tbl?>','<?=$i?>')" id="sp_schedule<?=$val_tbl?><?=$i?>" checked/><label for="sp_schedule<?=$val_tbl?><?=$i?>" class=""></label>
    					                  <?php
                                }else
                                {
                                  ?><input type="checkbox" name="sp_schedule<?=$val_tbl?><?=$i?>" onclick="gotosubmit_weak('<?=$val_tbl?>','<?=$i?>')" id="sp_schedule<?=$val_tbl?><?=$i?>"/><label for="sp_schedule<?=$val_tbl?><?=$i?>" class=""></label>
    					                  <?php } ?>
                            </div>
          
                            <div class="blog allsearch_sch" data-gameid="<?php echo $schedule['id'];?>" data-actual="<?php echo $schedule['actualdate'];?>" data-timezone="<?php echo $schedule['current_timezone'];?>">


                                  <div class="blog-4">
                                   <input type="hidden" name="fixture_id<?=$val_tbl?><?=$i?>" id="fixture_id<?=$val_tbl?><?=$i?>" value="<?php echo $schedule['fixture_id']; ?>" />
                                   <input type="hidden" name="establishment_ref<?=$val_tbl?><?=$i?>" id="establishment_ref<?=$val_tbl?><?=$i?>" value="<?php if($bar_id) echo $bar_id  ?>" />
                                   <input type="hidden" name="sport_id<?=$val_tbl?><?=$i?>" id="sport_id<?=$val_tbl?><?=$i?>" value="<?php echo $schedule['sport_id'] ?>" />
                                   <input type="hidden" name="competition_ref_id<?=$val_tbl?><?=$i?>" id="competition_ref_id<?=$val_tbl?><?=$i?>" value="<?php echo $schedule['compid'] ?>" />

                                  <h4><?php echo $schedule['sport_name'];?></h4>
                                  <p><?php echo $schedule['competition_name'];?></p>
                                 </div>

                                  <div class="blog-8" data-timezone="<?php echo $schedule['curtimezone'];?>">
                                      <span class="yellow"><?php echo $schedule['team1'];?>   vs.   <?php echo $schedule['team2'];?></span>
                                      <p><?php echo $schedule['date_time'];?></p>
                                  </div>
                                  <div class="blog-4"></div>
                              </div>
                    
                    
                                <div class=" blog-42">
                                <!--<nav class=" scroll" id="style-7">-->
                                 <div class="example">
                                 <ul>
                                     <?php foreach($channel_info as $channel_){?>
                                      <li class="listscroll">
                                        <span ><?php echo $channel_->channel_name;?></span>
                                      </li>
                                      <?php } ?>
                                     
                                      </ul> 
                                     </div> 
                                      
                                <!-- </nav>-->
                                </div>
                               </div>
                          
                         <?php }}} else{ ?>


<?php if($schedules){

         $i=0;
         $val_tbl=$rav_;

         $date=$date1;

 foreach($schedules as $schedule){

                   $i++;
                        $channel=$schedule['id'];
                        $this->load->model('Establishment_model');
                        $channel_info=$this->Establishment_model->GetFixChannel($channel,$bar_id);
                        $competition_id_sports=$schedule['compid'];
                        $sport_rel_id=$this->Establishment_model->GetSportRelId($competition_id_sports);      
                        ?>
                        <?php $schedule_info=$this->Establishment_model->GetCheckSchedule($bar_id);

                       // echo $schedule['actualdate']; echo $current_date;
                        ?>


<?php if($schedule['actualdate']==date('d-m-Y', strtotime(str_replace('-','/', $current_date)))){ ?>
                      <div>     
                            <div class=" blog-schedule"> 
                               <?php  
                                $result = $this->db->select('fixture_ref')->from('establishment_schedule')->where('fixture_ref', $schedule['fixture_id'])->where('establishment_ref', $bar_id)->limit(1)->get()->row();
                                if($result){
                                ?>
                                <input type="checkbox" name="sp_schedule<?=$val_tbl?><?=$i?>" onclick="gotosubmit_weak('<?=$val_tbl?>','<?=$i?>')" id="sp_schedule<?=$val_tbl?><?=$i?>" checked/><label for="sp_schedule<?=$val_tbl?><?=$i?>" class=""></label>
                                <?php
                                }else
                                {
                                  ?><input type="checkbox" name="sp_schedule<?=$val_tbl?><?=$i?>" onclick="gotosubmit_weak('<?=$val_tbl?>','<?=$i?>')" id="sp_schedule<?=$val_tbl?><?=$i?>"/><label for="sp_schedule<?=$val_tbl?><?=$i?>" class=""></label>
                                <?php } ?>
                            </div>
          
                            <div class="blog allsearch_sch" data-gameid="<?php echo $schedule['id'];?>" data-actual="<?php echo $schedule['actualdate'];?>" data-timezone="<?php echo $schedule['current_timezone'];?>">


                                  <div class="blog-4">
                                   <input type="hidden" name="fixture_id<?=$val_tbl?><?=$i?>" id="fixture_id<?=$val_tbl?><?=$i?>" value="<?php echo $schedule['fixture_id']; ?>" />
                                   <input type="hidden" name="establishment_ref<?=$val_tbl?><?=$i?>" id="establishment_ref<?=$val_tbl?><?=$i?>" value="<?php if($bar_id) echo $bar_id  ?>" />
                                   <input type="hidden" name="sport_id<?=$val_tbl?><?=$i?>" id="sport_id<?=$val_tbl?><?=$i?>" value="<?php echo $schedule['sport_id'] ?>" />
                                   <input type="hidden" name="competition_ref_id<?=$val_tbl?><?=$i?>" id="competition_ref_id<?=$val_tbl?><?=$i?>" value="<?php echo $schedule['compid'] ?>" />

                                  <h4><?php echo $schedule['sport_name'];?></h4>
                                  <p><?php echo $schedule['competition_name'];?></p>
                                 </div>

                                  <div class="blog-8" data-timezone="<?php echo $schedule['curtimezone'];?>">
                                      <span class="yellow"><?php echo $schedule['team1'];?>   vs.   <?php echo $schedule['team2'];?></span>
                                      <p><?php echo $schedule['date_time'];?></p>
                                  </div>
                                  <div class="blog-4"></div>
                              </div>
                    
                    
                                <div class=" blog-42">
                                <!--<nav class=" scroll" id="style-7">-->
                                  <div class="example">
                                 <ul>
                                     <?php foreach($channel_info as $channel_){?>
                                      <li class="listscroll">
                                        <span ><?php echo $channel_->channel_name;?></span>
                                      </li>
                                      <?php } ?>
                                     
                                      </ul> 
                                    </div>  
                                      
                                 <!--</nav>-->
                                </div>

                          </div>




                         <?php }}}} ?>

                        
 

