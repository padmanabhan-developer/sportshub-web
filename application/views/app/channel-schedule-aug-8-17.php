 
 <div id="pop1" class="simplePopup">
  <div class="schedule-left">
                      <h2 class="title4">Channels:</h2>

                       <?php $i=0;
							$heigCount = 0;
							 $checked_arr=explode("~",$channel_id);
							?>
                            
                       <?php if(count($selected_channel_list)>0)
                       {?>
                         <div class="side">
                            <ul> 
                            <?php
                            
                          
                           // print_r($checked_arr);
                            foreach($selected_channel_list as $channel)
                            {
                              $i++;
								$heigCount += 20;
                              ?> 
                                  <li>
                                    <span class="checkbox-box2">
                                   <input id="channel_<?=$i?>" class="checkBox" <?php if(in_array($channel['id'], $checked_arr)) echo "checked='checked'";?> type="checkbox" 
                                   onclick="SendChannelInfo('<?php echo base_url();?>')" value="<?php echo $channel['id'];?>" name="channel_<?=$i?>" style="opacity: 0;">
                                   <label for="channel_<?=$i?>"></label>
                                    </span><?php echo $channel['channel_name_dp'];?>
                                  </li>
                              <?php 
                            } ?>
                            <input id="total_channels" type="hidden" value="<?php echo count($selected_channel_list);?>" name="total_channels">
                            </ul>
                         </div>
                             <?php } ?>
                          
                        
                   </div>
  <!-- close schedule-left --> 
</div>
                   
                   <div class="schedule-right">
                       <h2 class="title2">TV schedule:</h2>
                        <?php  echo form_open("",$attribute_search['form']);
                        echo form_hidden('caller','Search'); ?>
                       <div class="event-form">
                      <span class="event-form-box">
                      <input id="datepicker-schedule-from" class="date-input" type="text" placeholder="Date From" tabindex="1" value="<?php echo $date_from;?>" name="date_from" readonly >
                           <?php //echo form_input($attribute_search['date_from']);?>
                        </span>
                        
                        <span class="event-form-box">
                        <input id="datepicker-schedule-to" class="date-input" type="text" placeholder="Date To" tabindex="1" value="<?php echo $date_end;?>" name="date_end" readonly >
                           <?php //echo form_input($attribute_search['date_end']);?>
                        </span>
                        
                        <span class="event-form-box">
                        <input id="search_text_schedule" class="date-input" type="text" value="<?php echo $search_text;?>"  placeholder="Search" name="search_text">
                             <?php //echo form_input($attribute_search['search_text']);?>
						<input class="search-button" id="search-button-schedule" type="button" >
                              <?php //echo form_submit($attribute_search['submit']);?>
                        </span>
                        <input type="hidden" id="path" value="<?php echo base_url();?>app/">
                       
                   </div><!-- close event-form -->
                   <?php  if(count($selected_channel_list)>0 || $channel_search_text!='') { ?>
<div class="event_row2">
                            <ul>
                            <input id="total_sports" type="hidden" value="<?php echo count($sport_list);?>" name="total_sports">    
                            <?php
                            $j=5;
                            $s=0;
                             $checked_sport_arr=explode("~",$sport_id);
                           // print_r($checked_sport_arr);
                            foreach($sport_list as $sport)
                            {
                              $j++;
                              $s++;
                              ?> 
                                <li>
                                   <span class="checkbox-box2">
                                  <input id="sport_<?=$s?>" class="checkBox"  <?php if(in_array($sport['id'], $checked_sport_arr)) echo "checked='checked'";?> type="checkbox" 
                                   onclick="ShowSportFixture('<?php echo base_url();?>app/')"
                                    value="<?php echo $sport['id'];?>" name="sport_<?=$s?>" style="">
                                   <label for="sport_<?=$s?>"><?=$sport['sport_name']?></label></span>

                                  </li>
                            <?php
                            }
                            ?>
                                
                            </ul>
                       </div><!-- close event_row -->
 <?php echo form_close();?>
                      <div id="show_channel">
                       <?php $this->load->view('app/display-schedule');?>
                     </div>
                     <!-- close show_channel div -->
				<?php } else { ?>
                	<div class="no_content">
                       	    <span class="no_content_title1">no content</span>
                            <span class="no_content_title2">Please select your tv provider &amp; channels before making your tv schedule</span>
                            <a class="blue_button button_center" href="<?php echo base_url();?>app/tv_provider_channel">CHOOSE TV PROVIDER</a>
</div>
<?php } ?>
                   </div><!-- close schedule-right -->
                   <script type="text/javascript" src="<?php echo base_url();?>js/establishment/jquery.min.js"></script>
 <script>
 
var scrolled=0;
		/*$(function() {
			$( "#ch-lists" ).customScroll({ scrollbarWidth: 10 });
		});*/
		function viewallchannel(){
			$('#remain_channel').show();
			var totalh = $('#totheight').val();
			if(totalh > 300){
			var toppos = parseInt(totalh) + parseInt(350);
			$('.side').animate({ scrollTop: toppos }, 2000);
			}
			$('.hideremain_all').show();
			$('#view_all').hide();
		}
		function hideallchannel(){
			$('#remain_channel').hide();
			$('#view_all').show();
			$('.hideremain_all').hide();
		}
	
	</script>