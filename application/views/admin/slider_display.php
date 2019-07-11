  <div class="events-inner" id="rating_events_inner">
  <?php if(count($slider)>0)
                    { ?>
                      <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table2">
                          <thead>
                          <tr>
                            <th>CREATION DATE</th>
                            <th >Slider Name</th>
                            <th>URL</th>
                            <th>CONTENT</th>
                            <th>actions</th>
                          </tr>
                          </thead>
                          <tbody>
                          <?php foreach($slider as $key => $value) { ?>
                          	<tr>
                            <td width="14%"><?php echo $value['created_on']; ?></td>
                            <td width="20%"><?php echo $value['slidername']; ?></td>
                            <td width="20%"><a href="<?php echo $value['url']; ?>" target="_blank" ><?php echo $value['url']; ?></a></td>
                            <td width="20%"><?php echo $value['desc']; ?></td>
                            <td>
                              <a href="<?php echo base_url();?>admin/edit_slider/<?php echo $value['id'];?>"><img src="<?php echo base_url();?>images/edit.png"></a>  
                                <?php /*?><?php  $status = $value->is_blocked;
                              if($status == 0)
                              {
                              ?>
                             <a href="#" class="block" data-blockid="<?php echo $value->id;?>" ><img src="<?php echo base_url();?>images/do-not-disturb.png"></a>
                             <?php } else {?>
                             
                              <a href="#" class="unblock" data-unblockid="<?php echo $value->id;?>" ><img src="<?php echo base_url();?>images/do-not-disturb-block.png"></a>
                              <?php }?><?php */?>
                                <a href="#" class="close2" data-deleteid="<?php echo $value['id'];?>"><img src="<?php echo base_url();?>images/delete-icon.png"></a>
                            </td>
                          </tr>
                          <?php } ?>
                          </tbody>                        
                         </table>

         <?php }
             else echo "No records found!"; ?>          
                   
                   </div><!-- close account-history-inner -->