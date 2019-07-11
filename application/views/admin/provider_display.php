<div class="events-inner" id="admin_events_inner">
                    <?php if(count($provider_list)>0)
                    {
                      ?>
                      <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table2">
                          <thead>
                          <tr>
                            <th style="text-align:left;">NAME</th>
                          </tr>
                          </thead>
                          <tbody>
                          <?php 
                        //  print_r($establishment_list);
                          foreach($provider_list as $list)
                          {?>
                          <tr>
                            <td style="width:20%"><a title="Edit Provider Name" href="#inline<?php echo $list['id'];?>" class="fancybox view"><span id="provider_text_display_<?php echo $list['id'];?>"><?php echo $list['provider_name'];?></span> </a></td>
                            <td style="width:20%" align="center" class="tdedit">
                              <a title="Edit Providers Channel Lists" href="<?php echo base_url();?>admin/provider_edit?id=<?php echo $list['id'];?>" class="view" data-viewid="<?php echo $list['id'];?>"><img src="<?php echo base_url();?>images/edit.png"></a>&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;
                              <!-- <img src="<?php echo base_url();?>images/edit.png"></a>-->
                               
                               <div id="inline<?php echo $list['id'];?>" style="width:400px;display: none;">
		<h3>Edit Provider name</h3>
		<p> 
			
            <span class="form-row-popup">Provider Name :
            <input type="text" name="provider_display_name" class="input_provider_name" id="provider_display_name<?php echo $list['id'];?>" value="<?php echo $list['provider_name'];?>" />
            </span>
             <span class="form-row-popup">
             <span id="alreadyexists<?php echo $list['id'];?>" class="alreadyexists"></span>
           <input type="button" class="popup-submit" name="update" value="Update" onclick="update_provider_name('<?php echo $list['id'];?>')" />
            </span>
		</p>
	</div>
                                <a href="javascript:;" class="close2" data-deleteid="<?php echo $list['id'];?>" ><img src="<?php echo base_url();?>images/delete-icon.png"></a>
                            </td>
                          </tr>
                          <?php 
                          } 
                        ?>
                          </tbody>                        
                         </table>
                         <div class="row2">
 <?php //echo $pagination['total_page']."-Total Rec-".$total_records."-PPR-".$ppr;
 //print_r($pagination);
 if($total_records >= $ppr)
 {
	 /*** defining the page counts and numbering based on current page Edited by Bagyaraj on Jul 23, 2015*///

	 $start = $pagination['cp']-6;
	 $endpage = $pagination['cp']+6;
	 if($endpage <12) $endpage = 12;
	 if($endpage > $pagination['total_page']){$endpage = $pagination['total_page'];}
	 if($pagination['cp'] >= ($pagination['total_page']-5)){$start = $pagination['total_page']-12;}
	 if($start <= 0){$start = 1;}
	 
	/*** defining the page counts  ends***/
	 //echo $start."??".$endpage;
  ?>

  <div class="paginBox3">
  <?php  
  if($pagination['previous_page'] > 0)
  {
   ?>
   <a href="javascript:void(0)"
    onclick="SearchResultProvider('<?php echo base_url();?>admin/','<?php echo $pagination['previous_page'];?>','<?php echo $ppr;?>','<?php echo $search_provider;?>','<?php echo $sport_id;?>')"
    class="prevArrow3"><img  style="margin-top:-6px;" src="<?php echo base_url();?>images/rightactive.jpg" alt="Previous" /></a>
   <?php
  }
  else
  {
   ?>
    <a href="javascript:void(0)" class="prevArrow3"><img src="<?php echo base_url();?>images/prev-arrow.png" alt="" /></a>
   <?php
  }  
  if($pagination['next_page'] > 0)
  {
   ?>
   <a href="javascript:void(0)" onclick="SearchResultProvider('<?php echo base_url();?>admin/','<?php echo $pagination['next_page'];?>','<?php echo $ppr;?>',<?php echo $search_provider;?>','<?php echo $sport_id;?>')" class="nextArrow3"><img style="margin-top:-6px;" src="<?php echo base_url();?>images/leftactive.jpg" alt="" /></a>
   <?php
  }
  else
  {
   ?>
    <a href="javascript:void(0)" class="nextArrow3"><img src="<?php echo base_url();?>images/next-arrow.png" alt="" /></a>
   <?php
  }  
  ?>
  
   <ul>
   <?php if($start >= 2){?>
 <li><a href="javascript:void(0)"  onclick="SearchResultProvider('<?php echo base_url();?>admin/','1','<?php echo $ppr;?>','<?php echo $search_provider;?>','<?php echo $sport_id;?>')" <?php if($cp == $start){?> class="active" <?php } ?>> &lt;&lt; </a></li>
 <?php }?>
    <?php if(($start >= 10) ){
		$prevset = $start-7;
		if($prevset < 1)$prevset =1;
		?>
 <li><a href="javascript:void(0)"  onclick="SearchResultProvider('<?php echo base_url();?>admin/','<?php echo $prevset;?>','<?php echo $ppr;?>','<?php echo $search_provider;?>','')" <?php if($cp == $start){?> class="active" <?php } ?>> &lt; </a></li>
 <?php }?>
  <?php 
      /*** declaring the page numbering based on current page Edited by Bagyaraj on Jul 23, 2015*///

 for($start;$start<=$endpage;$start++){ ?>
       <li><a href="javascript:void(0)"  onclick="SearchResultProvider('<?php echo base_url();?>admin/','<?php echo $start;?>','<?php echo $ppr;?>','<?php echo $search_provider;?>','<?php echo $sport_id;?>')" <?php if($cp == $start){?> class="active" <?php } ?>><?php echo $start;?></a></li>

<?php }  
   /*** declaring the page numbering ends*///
 ?>
    <?php if($pagination['total_page'] - $endpage >= 10){
		$nextset = $endpage +7;
		if($nextset > $pagination['total_page'])$nextset = $pagination['total_page'];
		?>
 <li><a href="javascript:void(0)"  onclick="SearchResultProvider('<?php echo base_url();?>admin/','<?php echo $nextset;?>','<?php echo $ppr;?>','<?php echo $search_provider;?>','<?php echo $sport_id;?>')" <?php if($cp == $start){?> class="active" <?php } ?>> &gt; </a></li>
 <?php }?>

    <?php if($endpage < ($pagination['total_page'])){?>
 <li><a href="javascript:void(0)"  onclick="SearchResultProvider('<?php echo base_url();?>admin/','<?php echo $pagination['total_page'];?>','<?php echo $ppr;?>','<?php echo $search_provider;?>','<?php echo $sport_id;?>')" <?php if($cp == $start){?> class="active" <?php } ?>> &gt;&gt; </a></li>
 <?php }?>

  </ul>
 </div>
 <?php
 }
 ?> 
</div>
 <?php }
                         else echo "No records found!"; ?>

                   </div><!-- close account-history-inner -->
                  