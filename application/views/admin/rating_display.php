  <div class="events-inner" id="rating_events_inner">
  <?php if(count($rating_comment)>0)
                    { ?>
                      <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table2">
                          <thead>
                          <tr>
                            <th>DATE</th>
                            <th class="rating">RATING</th>
                            <th>ESTABLISHMENT</th>
                            <th>User</th>
                            <th>comment</th>
                            <th>actions</th>
                          </tr>
                          </thead>
                          <tbody>
                          <?php foreach($rating_comment as $key => $value) { ?>
                          	<tr>
                            <td width="14%"><?php echo $value->created_on ?></td>
                            <td width="14%" class="rating">
								<?php if($value->rating==0){ ?>
                                	<img src="<?php echo base_url();?>images/star.png"><img src="<?php echo base_url();?>images/star.png"><img src="<?php echo base_url();?>images/star.png"><img src="<?php echo base_url();?>images/star.png"><img src="<?php echo base_url();?>images/star.png">
                                <?php } else if($value->rating==1) {?>
                                <img src="<?php echo base_url();?>images/star-active.png"><img src="<?php echo base_url();?>images/star.png"><img src="<?php echo base_url();?>images/star.png"><img src="<?php echo base_url();?>images/star.png"><img src="<?php echo base_url();?>images/star.png">
                                <?php } else if($value->rating==2) {?>
                                <img src="<?php echo base_url();?>images/star-active.png"><img src="<?php echo base_url();?>images/star-active.png"><img src="<?php echo base_url();?>images/star.png"><img src="<?php echo base_url();?>images/star.png"><img src="<?php echo base_url();?>images/star.png">
                                <?php } else if($value->rating==3) {?>
                                <img src="<?php echo base_url();?>images/star-active.png"><img src="<?php echo base_url();?>images/star-active.png"><img src="<?php echo base_url();?>images/star-active.png"><img src="<?php echo base_url();?>images/star.png"><img src="<?php echo base_url();?>images/star.png">
                                <?php } else if($value->rating==4) {?>
                                <img src="<?php echo base_url();?>images/star-active.png"><img src="<?php echo base_url();?>images/star-active.png"><img src="<?php echo base_url();?>images/star-active.png"><img src="<?php echo base_url();?>images/star-active.png"><img src="<?php echo base_url();?>images/star.png">
                                <?php } else if($value->rating==5) {?>
                                <img src="<?php echo base_url();?>images/star-active.png"><img src="<?php echo base_url();?>images/star-active.png"><img src="<?php echo base_url();?>images/star-active.png"><img src="<?php echo base_url();?>images/star-active.png"><img src="<?php echo base_url();?>images/star-active.png">
                                <?php }?>
                                                            
                            </td>
                            <td width="20%"><?php echo $value->title; ?></td>
                            <td width="20%"><?php echo $value->email_id; ?></td>
                            <td width="20%"><?php echo $value->comment; ?></td>
                            <td>
                              <a href="<?php echo base_url();?>admin/rating_edit/<?php echo $value->id;?>"><img src="<?php echo base_url();?>images/edit.png"></a>  
                                <?php  $status = $value->is_blocked;
                              if($status == 0)
                              {
                              ?>
                             <a href="#" class="block" data-blockid="<?php echo $value->id;?>" ><img src="<?php echo base_url();?>images/do-not-disturb.png"></a>
                             <?php } else {?>
                             
                              <a href="#" class="unblock" data-unblockid="<?php echo $value->id;?>" ><img src="<?php echo base_url();?>images/do-not-disturb-block.png"></a>
                              <?php }?>
                                <a href="#" class="close2" data-deleteid="<?php echo $value->id;?>"><img src="<?php echo base_url();?>images/delete-icon.png"></a>
                            </td>
                          </tr>
                          <?php } ?>
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
    onclick="SearchResultRating('<?php echo base_url();?>admin/','<?php echo $pagination['previous_page'];?>','<?php echo $ppr;?>','<?php echo $date_from;?>','<?php echo $date_end;?>','<?php echo $search_text;?>','<?php echo $sport_id;?>')"
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
   <a href="javascript:void(0)" onclick="SearchResultRating('<?php echo base_url();?>admin/','<?php echo $pagination['next_page'];?>','<?php echo $ppr;?>','<?php echo $date_from;?>','<?php echo $date_end;?>','<?php echo $search_text;?>','<?php echo $sport_id;?>')" class="nextArrow3"><img style="margin-top:-6px;" src="<?php echo base_url();?>images/leftactive.jpg" alt="" /></a>
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
 <li><a href="javascript:void(0)"  onclick="SearchResultRating('<?php echo base_url();?>admin/','1','<?php echo $ppr;?>','<?php echo $date_from;?>','<?php echo $date_end;?>','<?php echo $search_text;?>','<?php echo $sport_id;?>')" <?php if($cp == $start){?> class="active" <?php } ?>> &lt;&lt; </a></li>
 <?php }?>
    <?php if(($start >= 10) ){
		$prevset = $start-7;
		if($prevset < 1)$prevset =1;
		?>
 <li><a href="javascript:void(0)"  onclick="SearchResultRating('<?php echo base_url();?>admin/','<?php echo $prevset;?>','<?php echo $ppr;?>','<?php echo $date_from;?>','<?php echo $date_end;?>','<?php echo $search_text;?>','')" <?php if($cp == $start){?> class="active" <?php } ?>> &lt; </a></li>
 <?php }?>
  <?php 
      /*** declaring the page numbering based on current page Edited by Bagyaraj on Jul 23, 2015*///

 for($start;$start<=$endpage;$start++){ ?>
       <li><a href="javascript:void(0)"  onclick="SearchResultRating('<?php echo base_url();?>admin/','<?php echo $start;?>','<?php echo $ppr;?>','<?php echo $date_from;?>','<?php echo $date_end;?>','<?php echo $search_text;?>','<?php echo $sport_id;?>')" <?php if($cp == $start){?> class="active" <?php } ?>><?php echo $start;?></a></li>

<?php }  
   /*** declaring the page numbering ends*///
 ?>
    <?php if($pagination['total_page'] - $endpage >= 10){
		$nextset = $endpage +7;
		if($nextset > $pagination['total_page'])$nextset = $pagination['total_page'];
		?>
 <li><a href="javascript:void(0)"  onclick="SearchResultRating('<?php echo base_url();?>admin/','<?php echo $nextset;?>','<?php echo $ppr;?>','<?php echo $date_from;?>','<?php echo $date_end;?>','<?php echo $search_text;?>','<?php echo $sport_id;?>')" <?php if($cp == $start){?> class="active" <?php } ?>> &gt; </a></li>
 <?php }?>

    <?php if($endpage < ($pagination['total_page'])){?>
 <li><a href="javascript:void(0)"  onclick="SearchResultRating('<?php echo base_url();?>admin/','<?php echo $pagination['total_page'];?>','<?php echo $ppr;?>','<?php echo $date_from;?>','<?php echo $date_end;?>','<?php echo $search_text;?>','<?php echo $sport_id;?>')" <?php if($cp == $start){?> class="active" <?php } ?>> &gt;&gt; </a></li>
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