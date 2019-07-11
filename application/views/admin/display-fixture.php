
                            
                              <input type="hidden" value="<?php echo $sport_id;?>" id="total_sport_ids" >
                              <?php if(count($fixture_list)>0)
                              {
                                ?>
                             <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table2">
                              <thead>
                              <tr>
                                <th>DATE</th>
                                <th>TIME </th>
                                <th>eVENT DESCRIPTION </th>
                                <th>action</th>
                              </tr>
                            
                             </thead>

                              <tbody>
                                <?php 
                                $k=0;
                                //echo count($fixture_list);
                               // print_r($fixture_list);
                                foreach($fixture_list as $fixture)
                                {
                                  $k++;
                                  ?>
                                
                                <tr>
                                  <td><?php echo $fixture['gmt_date_time'];?></td>
                                  <td><?php echo $fixture['local_time_form'];?></td>
                                  <td><?php echo $fixture['team1'];?> <span class="vs">vs.</span>  <?php echo $fixture['team2'];?></td>
                                 
                                                              
                                  <td>
                                  <a href="#"><img src="<?php echo base_url();?>images/pokar.png"></a>
                                  <a href="#"><img src="<?php echo base_url();?>images/edit.png"></a>
                                  <a href="<?php echo base_url();?>admin/delete/<?php echo $fixture['id'];?>"><img src="<?php echo base_url();?>images/delete-icon.png"></a>
                                  </td>
                                </tr>
                              <?php 
                            } 
                            ?>
                             
                              </tbody>                        
                             </table>

<div class="row2">
 <?php //echo $pagination['total_page'];
 if($total_records >= $ppr)
 {
	 /*** defining the page counts and numbering based on current page Edited by Bagyaraj on Jul 23, 2015*///

	 $start = $pagination['cp']-6;
	 if($start <= 0){$start = 1;}
	 $endpage = $pagination['cp']+6;
	 if($endpage <12) $endpage = 12;
	 if($endpage > $pagination['total_page']){$endpage = $pagination['total_page'];}
	 if($pagination['cp'] >= ($pagination['total_page']-5)){$start = $pagination['total_page']-12;}
	 
	/*** defining the page counts  ends***/

  ?>

  <div class="paginBox3">
  <?php  
  if($pagination['previous_page'] > 0)
  {
   ?>
   <a href="javascript:void(0)"
    onclick="SearchResult('<?php echo base_url();?>admin/','<?php echo $pagination['previous_page'];?>','<?php echo $ppr;?>','<?php echo $date_from;?>','<?php echo $date_end;?>','<?php echo $search_text;?>','')"
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
   <a href="javascript:void(0)" onclick="SearchResult('<?php echo base_url();?>admin/','<?php echo $pagination['next_page'];?>','<?php echo $ppr;?>','<?php echo $date_from;?>','<?php echo $date_end;?>','<?php echo $search_text;?>','')" class="nextArrow3"><img style="margin-top:-6px;" src="<?php echo base_url();?>images/leftactive.jpg" alt="" /></a>
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
 <li><a href="javascript:void(0)"  onclick="SearchResult('<?php echo base_url();?>admin/','1','<?php echo $ppr;?>','<?php echo $date_from;?>','<?php echo $date_end;?>','<?php echo $search_text;?>','')" <?php if($cp == $start){?> class="active" <?php } ?>> &lt;&lt; </a></li>
 <?php }?>
    <?php if(($start >= 10) ){
		$prevset = $start-7;
		if($prevset < 1)$prevset =1;
		?>
 <li><a href="javascript:void(0)"  onclick="SearchResult('<?php echo base_url();?>admin/','<?php echo $prevset;?>','<?php echo $ppr;?>','<?php echo $date_from;?>','<?php echo $date_end;?>','<?php echo $search_text;?>','')" <?php if($cp == $start){?> class="active" <?php } ?>> &lt; </a></li>
 <?php }?>
  <?php 
      /*** declaring the page numbering based on current page Edited by Bagyaraj on Jul 23, 2015*///

 for($start;$start<=$endpage;$start++){ ?>
       <li><a href="javascript:void(0)"  onclick="SearchResult('<?php echo base_url();?>admin/','<?php echo $start;?>','<?php echo $ppr;?>','<?php echo $date_from;?>','<?php echo $date_end;?>','<?php echo $search_text;?>','')" <?php if($cp == $start){?> class="active" <?php } ?>><?php echo $start;?></a></li>

<?php }  
   /*** declaring the page numbering ends*///
 ?>
    <?php if($pagination['total_page'] - $endpage >= 10){
		$nextset = $endpage +7;
		if($nextset > $pagination['total_page'])$nextset = $pagination['total_page'];
		?>
 <li><a href="javascript:void(0)"  onclick="SearchResult('<?php echo base_url();?>admin/','<?php echo $nextset;?>','<?php echo $ppr;?>','<?php echo $date_from;?>','<?php echo $date_end;?>','<?php echo $search_text;?>','')" <?php if($cp == $start){?> class="active" <?php } ?>> &gt; </a></li>
 <?php }?>

    <?php if($endpage < ($pagination['total_page'])){?>
 <li><a href="javascript:void(0)"  onclick="SearchResult('<?php echo base_url();?>admin/','<?php echo $pagination['total_page'];?>','<?php echo $ppr;?>','<?php echo $date_from;?>','<?php echo $date_end;?>','<?php echo $search_text;?>','')" <?php if($cp == $start){?> class="active" <?php } ?>> &gt;&gt; </a></li>
 <?php }?>
  </ul>
 </div>
 <?php
 }
 ?> 
  
</div>
  <?php } 
  else echo "<p> No fixture available.</p>";?>