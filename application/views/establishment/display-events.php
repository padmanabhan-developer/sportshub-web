<table width="100%" border="0" cellspacing="0" cellpadding="0" class="table2">
                          <thead>
                          <tr>
                            <th>DATE & TIME </th>
                            <th>EVENT DESCRIPTION</th>
                            <th>delete</th>
                          </tr>
                          </thead>
                          <tbody>
                          <?php 
						  if(count($all_events) > 0){
						  foreach($all_events as $event)
                          {
                            ?>
                          <input type="hidden" id="event_id" value="<?php echo $event['id'];?>" >
                          <tr>
                            <td><?php echo $event['date'];?> - <?php echo $event['time'];?> -
                             <?php echo $date = date('h:i A', strtotime($event['time'])+(3600*$event['duration']));

                             //echo $event['duration'];?></td>
                            
                            <td><a  data-cta-target=".js-dialog" href="javascript:void(0)" title="Click here to edit"  onclick="javascript:OpenAddEventForm('<?php echo base_url();?>establishment/','<?php echo $event['id'];?>');"><?php echo $event['title'];?></a></td>
                            <td><a href="<?php echo base_url();?>establishment_events/delete/<?php echo $event['id'];?>"><img src="<?php echo base_url();?>images/delete-icon.png"></a></td>
                          </tr>
                          <?php } 
						  }
						 else{
						 ?>
                         <tr>
                            <td colspan="3">No Events found.
                            </td>
                            </tr>
                         <?php }?>
                          </tbody>                        
                         </table>