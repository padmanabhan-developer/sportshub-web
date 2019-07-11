<div class="events-inner" id="user_events_inner">
<?php if(count($admin_user_list)>0)
                    {
                      ?><table width="100%" border="0" cellspacing="0" cellpadding="0" class="table2">
                          <thead>
                          <tr>
                            <th>NAME</th>
                            <th>Email</th>
                            <th>Created Date</th>
                            <th>actions</th>
                          </tr>
                          </thead>
                          <tbody>
                            <?php foreach($admin_user_list as $user)
                            {?>
                            <tr>
                            <td><?php echo $user['firstname']." ".$user['lastname'];?></td>
                            <td><?php echo $user['email']?></td>
                            <td><?php echo $user['created_on'];?></td>
                            <td>
                            <a href="<?php echo base_url();?>admin/admin_user_edit/<?php echo $user['id'];?>"><img src="<?php echo base_url();?>images/edit.png"></a>&nbsp;&nbsp;&nbsp;&nbsp;
                             <?php /*?><?php  $status = $user['is_block'];
                              if($status == '0')
                              {
                              ?>
                             <a href="#" class="block" data-blockid="<?php echo $user['id'];?>" ><img src="<?php echo base_url();?>images/do-not-disturb.png"></a>&nbsp;&nbsp;&nbsp;&nbsp;
                             <?php } else {?>
                             
                              <a href="#" class="unblock" data-unblockid="<?php echo $user['id'];?>" ><img src="<?php echo base_url();?>images/do-not-disturb-block.png"></a>&nbsp;&nbsp;&nbsp;&nbsp;
                              <?php }?><?php */?>
                                
                                <a href="#" class="close2" data-deleteid="<?php echo $user['id'];?>" ><img src="<?php echo base_url();?>images/delete-icon.png"></a>&nbsp;&nbsp;&nbsp;&nbsp;
                            </td>
                          </tr>
                          <?php } ?>
                        
                          </tbody>                        
                         </table>
			 <?php }
             else echo "No records found!"; ?>
</div><!-- close account-history-inner -->			 