<div class="events-inner" id="admin_events_inner">
           <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table2">
                          <thead>
                          <tr>
                          <th> ESTABLISHMENT </th>
                            <th>SUBSCRIPTION NAME</th>
                            <th>AMOUNT</th>
                            <th>DATE</th>
                           <!--  <th>PERIOD FROM</th>
                            <th>PERIOD TO</th> -->
                            <th> INVOICE</th>
                           <!--  <th>COUNTRY</th>
                            <th>actions</th> -->
                          </tr>
                          </thead>
                          <tbody>
                          <?php  foreach($result as $row) { ?>
                          <tr>
                          <td><?php echo $row->title; ?></td>
                            <td><?php if($row->subscription_plan == 'standard_monthly_plan') { echo "MONTHLY SUBSCRIPTION"; }elseif($row->subscription_plan == 'standard_yearly_plan') { echo "YEARLY SUBSCRIPTION"; }; ?></td>
                            <td>&euro;<?php echo $row->subscription_amount/100; ?></td>
                            <td> <?php   $data= strtotime($row->created_on);  echo date('d-m-Y', $data); ?> </td>
                           <!--  <td><?php echo $row->subscription_start; ?></td>
                            <td><?php echo $row->subscription_end; ?></td> -->
                            <td><!-- <a href="#"  class="viewpdf" data-subsid= "<?php //echo $row->sub_incr_id; ?>" data-esid= "<?php //echo $row->est_ref ?>"> --> <!-- Download</a> -->

                            <a target="_blank" href="<?php echo base_url();?>Invoice/<?php echo $row->invoice_link; ?>" > DOWNLOAD</a></td>
                            <!-- <td>COUNTRY</td>
                            <td>actions</td> -->
                          </tr>
                          <?php } ?>
                          </tbody>
                          </table>
                          <div class="row2">

 <?php //echo $pagination['total_page']."-Total Rec-".$total_records."-PPR-".$ppr;


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
    onclick="SearchResultAdmin1('<?php echo base_url();?>admin/','<?php echo $pagination['previous_page'];?>','<?php echo $ppr;?>')"
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
   <a href="javascript:void(0)" onclick="SearchResultAdmin1('<?php echo base_url();?>admin/','<?php echo $pagination['next_page'];?>','<?php echo $ppr;?>')" class="nextArrow3"><img style="margin-top:-6px;" src="<?php echo base_url();?>images/leftactive.jpg" alt="" /></a>
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
 <li><a href="javascript:void(0)"  onclick="SearchResultAdmin1('<?php echo base_url();?>admin/','1','<?php echo $ppr;?>',)" <?php if($cp == $start){?> class="active" <?php } ?>> &lt;&lt; </a></li>
 <?php }?>
    <?php if(($start >= 10) ){
    $prevset = $start-7;
    if($prevset < 1)$prevset =1;
    ?>
 <li><a href="javascript:void(0)"  onclick="SearchResultAdmin1('<?php echo base_url();?>admin/','<?php echo $prevset;?>','<?php echo $ppr;?>','')" <?php if($cp == $start){?> class="active" <?php } ?>> &lt; </a></li>
 <?php }?>
  <?php 
      /*** declaring the page numbering based on current page Edited by Bagyaraj on Jul 23, 2015*///

 for($start;$start<=$endpage;$start++){ ?>
       <li><a href="javascript:void(0)"  onclick="SearchResultAdmin1('<?php echo base_url();?>admin/','<?php echo $start;?>','<?php echo $ppr;?>')" <?php if($cp == $start){?> class="active" <?php } ?>><?php echo $start;?></a></li>

<?php }  
   /*** declaring the page numbering ends*///
 ?>
    <?php if($pagination['total_page'] - $endpage >= 10){
    $nextset = $endpage +7;
    if($nextset > $pagination['total_page'])$nextset = $pagination['total_page'];
    ?>
 <li><a href="javascript:void(0)"  onclick="SearchResultAdmin1('<?php echo base_url();?>admin/','<?php echo $nextset;?>','<?php echo $ppr;?>')" <?php if($cp == $start){?> class="active" <?php } ?>> &gt; </a></li>
 <?php }?>

    <?php if($endpage < ($pagination['total_page'])){?>
 <li><a href="javascript:void(0)"  onclick="SearchResultAdmin1('<?php echo base_url();?>admin/','<?php echo $pagination['total_page'];?>','<?php echo $ppr;?>'
 )" <?php if($cp == $start){?> class="active" <?php } ?>> &gt;&gt; </a></li>
 <?php }?>

  </ul>
 </div>
 <?php
 }
 ?> 
  
</div>


          </div>