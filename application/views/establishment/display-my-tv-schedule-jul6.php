<div class="events-inner">
                     <input type="hidden" value="<?php echo $sport_id;?>" id="total_sport_ids" >
                              <?php if(count($fixture_list)>0)
                              {
                                ?>
                              <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table2">
                              <tbody>
                                <?php 
                                $k=0;
                                //echo count($fixture_list);
                               //print_r($fixture_list);
                                foreach($fixture_list as $fixture)
                                {
                                  $k++;
                                  ?>
                                
                                <tr>
                                  <td><?php echo $fixture['gmt_date_time'];?></td>
                                  <td><?php echo $fixture['local_time_form'];?></td>
                                  <?php if($fixture['team1'] === $fixture['team2']) {?>
                                  <td colspan="3" align="center" style="text-align:center !important;"><?php echo $fixture['team1'];?></td>
                                  <?php }else{?>
                                  <td><?php echo $fixture['team1'];?></td>
                                  <td>vs.</td>
                                  <td><?php echo $fixture['team2'];?></td>
                                  <?php }?>
                                  <td><?php echo $fixture['sport_name'];?></td>
                                   <td><?php echo $fixture['channel_name'];?></td>
                                  <td><span class="checkbox-box">
                                    <input type="checkbox" name="fixture_<?=$k?>" id="fixture_<?=$k?>" 
                                    value="<?php echo $fixture['id'];?>"  
                                    onclick="return SendFixtureInfo('<?php echo base_url();?>',
                                    '<?php echo $cp;?>','<?php echo $ppr;?>','<?php echo $fixture['id'];?>',
                                    '<?php echo $sport_id;?>','<?php echo $date_from;?>','<?php echo $date_end;?>','<?php echo $search_text;?>',this);"
                                    class="checkbox" checked="checked"  />
                                    <label for="fixture_<?=$k?>"></label></span></td>
                                </tr>
                              <?php 
                            } 
                            ?>
                             
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
    onclick="SearchResult('<?php echo base_url();?>establishment/','<?php echo $pagination['previous_page'];?>','<?php echo $ppr;?>','<?php echo $date_from;?>','<?php echo $date_end;?>','<?php echo $search_text;?>','<?php echo $sport_id;?>')"
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
    <li><a href="javascript:void(0)"  onclick="SearchResult('<?php echo base_url();?>establishment/','1','<?php echo $ppr;?>','<?php echo $date_from;?>','<?php echo $date_end;?>','<?php echo $search_text;?>','<?php echo $sport_id;?>')" <?php if($cp == $start){?> class="active" <?php } ?>> &lt;&lt; </a></li>
    <?php }?>
    <?php if(($start >= 10) ){
		$prevset = $start-7;
		if($prevset < 1)$prevset =1;
		?>
    <li <?php if($cp == $start){?> class="active" <?php } ?> ><a href="javascript:void(0)"  onclick="SearchResult('<?php echo base_url();?>establishment/','<?php echo $prevset;?>','<?php echo $ppr;?>','<?php echo $date_from;?>','<?php echo $date_end;?>','<?php echo $search_text;?>','')" > &lt; </a></li>
    <?php }?>
    <?php 
      /*** declaring the page numbering based on current page Edited by Bagyaraj on Jul 23, 2015*///

 for($start;$start<=$endpage;$start++){ ?>
    <li <?php if($cp == $start){?> class="active" <?php } ?> ><a href="javascript:void(0)"  onclick="SearchResult('<?php echo base_url();?>establishment/','<?php echo $start;?>','<?php echo $ppr;?>','<?php echo $date_from;?>','<?php echo $date_end;?>','<?php echo $search_text;?>','<?php echo $sport_id;?>')" ><?php echo $start;?></a></li>
    <?php }  
   /*** declaring the page numbering ends*///
 ?>
    <?php if($pagination['total_page'] - $endpage >= 10){
		$nextset = $endpage +7;
		if($nextset > $pagination['total_page'])$nextset = $pagination['total_page'];
		?>
    <li><a href="javascript:void(0)"  onclick="SearchResult('<?php echo base_url();?>establishment/','<?php echo $nextset;?>','<?php echo $ppr;?>','<?php echo $date_from;?>','<?php echo $date_end;?>','<?php echo $search_text;?>','<?php echo $sport_id;?>')" <?php if($cp == $start){?> class="active" <?php } ?>> &gt; </a></li>
    <?php }?>
    <?php if($endpage < ($pagination['total_page'])){?>
    <li><a href="javascript:void(0)"  onclick="SearchResult('<?php echo base_url();?>establishment/','<?php echo $pagination['total_page'];?>','<?php echo $ppr;?>','<?php echo $date_from;?>','<?php echo $date_end;?>','<?php echo $search_text;?>','<?php echo $sport_id;?>')" <?php if($cp == $start){?> class="active" <?php } ?>> &gt;&gt; </a></li>
    <?php }?>
    <?php  
  if($pagination['next_page'] > 0)
  {
   ?>
    <li class="pagi_next"><a href="javascript:void(0)" onclick="SearchResult('<?php echo base_url();?>establishment/','<?php echo $pagination['next_page'];?>','<?php echo $ppr;?>','<?php echo $date_from;?>','<?php echo $date_end;?>','<?php echo $search_text;?>','<?php echo $sport_id;?>')" >Next</a></li>
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
 
  <?php } 
  else echo "<p> No fixture available.</p>";?>

                   </div><!-- close account-history-inner -->