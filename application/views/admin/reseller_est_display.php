  <div class="events-inner" id="reseller_est_inner">
  <?php if(count($reseller)>0) 
                    {  $i = (($cp-1) * 20)+1;
					?>
                      <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table2">
                          <thead>
                          <tr>
                            <th>S. No</th>
                            <th>Email</th>
                            <th>Establishment</th>
                            <th>Registered DATE</th>
                            <th>Action</th>
                          </tr>
                          </thead>
                          <tbody>
                          <?php foreach($reseller as $key => $value) { ?>
                          	<tr>
                            <td width="10%"><?php echo $i; ?></td>
                            <td width="15%"><?php echo $value['email']; ?></td>
                            <td width="15%"><?php echo $value['title']; ?></td>
                            <td width="10%"><?php echo $value['created_on']; ?></td>
                            <td width="15%">
                              <a href="<?php echo base_url();?>admin/establishments_edit?id=<?php echo $value['user_ref'];?>" target="_blank"><img src="<?php echo base_url();?>images/search-icon.png"></a> 
                            </td>
                          </tr>
                          <?php $i++;  } ?>
                          </tbody>                        
                         </table>

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
<div class="pagination_bottom">
  <ul>
    <?php  
  if($pagination['previous_page'] > 0)
  {
   ?>
    <li class="pagi_prev" ><a href="javascript:void(0)"
    onclick="SearchResultResellerEst('<?php echo base_url();?>admin/','<?php echo $pagination['previous_page'];?>','<?php echo $ppr;?>')"
   >Previous</a></li>
    <?php
  }
  else
  {
   ?>
    <li class="pagi_prev"><a href="javascript:void(0)" >Previous</a></li>
    <?php
  }
  
  if($start >= 2){?>
    <li><a href="javascript:void(0)"  onclick="SearchResultResellerEst('<?php echo base_url();?>admin/','1','<?php echo $ppr;?>')" <?php if($cp == $start){?> class="active" <?php } ?>> &lt;&lt; </a></li>
    <?php }?>
    <?php if(($start >= 10) ){
		$prevset = $start-7;
		if($prevset < 1)$prevset =1;
		?>
    <li <?php if($cp == $start){?> class="active" <?php } ?> ><a href="javascript:void(0)"  onclick="SearchResultResellerEst('<?php echo base_url();?>admin/','<?php echo $prevset;?>','<?php echo $ppr;?>')" > &lt; </a></li>
    <?php }?>
    <?php 
      /*** declaring the page numbering based on current page Edited by Bagyaraj on Jul 23, 2015*///

 for($start;$start<=$endpage;$start++){ ?>
    <li <?php if($cp == $start){?> class="active" <?php } ?> ><a href="javascript:void(0)"  onclick="SearchResultResellerEst('<?php echo base_url();?>admin/','<?php echo $start;?>','<?php echo $ppr;?>')" ><?php echo $start;?></a></li>
    <?php }  
   /*** declaring the page numbering ends*///
 ?>
    <?php if($pagination['total_page'] - $endpage >= 10){
		$nextset = $endpage +7;
		if($nextset > $pagination['total_page'])$nextset = $pagination['total_page'];
		?>
    <li><a href="javascript:void(0)"  onclick="SearchResultResellerEst('<?php echo base_url();?>admin/','<?php echo $nextset;?>','<?php echo $ppr;?>')" <?php if($cp == $start){?> class="active" <?php } ?>> &gt; </a></li>
    <?php }?>
    <?php if($endpage < ($pagination['total_page'])){?>
    <li><a href="javascript:void(0)"  onclick="SearchResultResellerEst('<?php echo base_url();?>admin/','<?php echo $pagination['total_page'];?>','<?php echo $ppr;?>')" <?php if($cp == $start){?> class="active" <?php } ?>> &gt;&gt; </a></li>
    <?php }?>
    <?php  
  if($pagination['next_page'] > 0)
  {
   ?>
    <li class="pagi_next"><a href="javascript:void(0)" onclick="SearchResultResellerEst('<?php echo base_url();?>admin/','<?php echo $pagination['next_page'];?>','<?php echo $ppr;?>')" >Next</a></li>
    <?php
  }
  else
  {
   ?>
    <li class="pagi_next"><a href="javascript:void(0)" >Next</a></li>
    <?php
  }  
  ?>
  </ul>
</div>
<?php
 }
 ?>
</div>
         <?php }
             else echo "No records found!"; ?>          
                   
                   </div><!-- close account-history-inner -->