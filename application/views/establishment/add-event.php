
 <div class="popup-box">

                   <h2>add new event</h2> <div id="errorDiv1" style="float:left; width:268px; background:#f4f3f3; color:#e60000; border:dotted 1px #c12e1e; font-family: 'open_sansregular'; margin-top:2px; margin-bottom:8px; padding:5px;font-size:13px; display:none;">       </div>


                    <?php  if($form_action=="insert"){ echo form_open(base_url()."establishment/events",$attribute_event['form']);}
                    else {
                      echo form_open(base_url()."establishment/display_open",$attribute_event['form']);
                      echo  form_hidden('event_id',$event_id); 
                    }
                           echo form_hidden('caller','Event'); ?>
                   
                   <span class="popup-form"><?php echo form_input($attribute_event['title']);?></span>
                   
                   <span class="popup-form">
                       <span class="form-box2"><?php echo form_input($attribute_event['event_date']);?></span><span class="devider"></span>
                       <span class="form-box2" id="timpick"><?php echo form_input($attribute_event['event_time']);?></span><span class="devider"></span>
                       <span class="form-box2"><?php echo form_input($attribute_event['duration']);?></span>
                   </span>

                   <span class="button-row"><?php  if($form_action=="insert"){echo form_submit($attribute_event['submit']); }
                   else echo form_submit($attribute_event['update']);?></span>
                  <?php echo form_close();?>
              </div><!-- close popup-box -->
               
