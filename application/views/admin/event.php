<script type="text/javascript" src="<?php echo base_url();?>js/admin/form_validation.js"></script>

<div class="offers">
			<h1>EVENTS</h1>
            <a href="javascript:void(0);" class="add-new-event" data-cta-target=".js-dialog2" onclick="javascript:OpenAddEventForm('<?php echo base_url();?>admin/','0');">add new event</a>
              <div class="js-dialog2  modal  dialog" style="text-align: center;">
      <span class="modal-close-btn"></span>
     <div id="open_event">
     <?php $this->load->view('admin/add-event');?>
   </div>
    </div>
              
            <?php if(count($all_events)>0)
            {
            ?> 
            <div class="events">
                   <h2 class="title2">my events</h2>
                   <?php /*?><div class="event-form">
                    <?php  echo form_open(base_url()."establishment/events",$attribute_search['form']);
                           echo form_hidden('caller','Search'); ?>
                      <span class="event-form-box">
                      <input id="datepicker-events-from" class="date-input" type="text" placeholder="Date From" tabindex="1" value="" name="date_from" readonly >
                           <?php //echo form_input($attribute_search['date_from']);?>
                        </span>
                        
                        <span class="event-form-box">
                         <input id="datepicker-events-to" class="date-input" type="text" placeholder="Date To" tabindex="1" value="" name="date_from" readonly >
                           <?php //echo form_input($attribute_search['date_end']);?>
                        </span>
                        
                        <span class="event-form-box">
                        <input id="search_text_event" class="date-input" type="text"  placeholder="Search" name="search_text">
                             <?php //echo form_input($attribute_search['search_text']);?>

                             <input class="search-button" type="button" >
                        </span>
                        <?php echo form_close();?>
                   </div><?php */?><!-- close event-form -->

                   <?php 
                   if(count($all_events)>0)
                   {
                    ?>
                   <div class="events-inner" id="events-inner">
                      <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table2">
                          <thead>
                          <tr>
                            <th>DATE & TIME </th>
                            <th>EVENT DESCRIPTION</th>
                            <th>delete</th>
                          </tr>
                          </thead>
                          <tbody>
                          <?php foreach($all_events as $event)
                          {
                            ?>
                          <input type="hidden" id="event_id" value="<?php echo $event['id'];?>" >
                          <tr>
                            <td><?php echo $event['date'];?> - <?php echo $event['time'];?> -
                             <?php echo $date = date('h:i A', strtotime($event['time'])+(3600*$event['duration']));

                             //echo $event['duration'];?></td>
                            
                            <td><a  data-cta-target=".js-dialog2" href="javascript:void(0)" title="Click here to edit"  onclick="javascript:OpenAddEventForm('<?php echo base_url();?>admin/','<?php echo $event['id'];?>');"><?php echo $event['title'];?></a></td>
                            <td><a href="javascript:void(0);" data-eventid="<?php echo $event['id'];?>" style="padding-left:20px;" id="del-event" class="del-event"><img src="<?php echo base_url();?>images/delete-icon.png"></a></td>
                          </tr>
                          <?php } ?><!-- close foreach loop -->
                         
                          </tbody>                        
                         </table>

                   </div><!-- close account-history-inner -->
                   <?php } 
                   else echo "<h2>No result found.<h2>";?><!-- close if statement -->
              </div><!-- close events -->
            <?php } 

            else echo "There is no event. Click on Add New Event button to add event";?>


         </div>