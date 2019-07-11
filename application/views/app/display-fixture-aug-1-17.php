
                              <!--<thead>
                              <tr>
                                <th>DATE & TIME </th>
                                <th>eVENT DESCRIPTION</th>
                                <th>delete</th>
                              </tr>
                              </thead>-->
                              <input type="hidden" value="<?php echo $sport_id;?>" id="total_sport_ids" >
                              <?php if(count($fixture_list)>0)
                              {
                                ?>
                             
                             <div class="table-initial">  
                             
                                <?php 
                                $k=0;
                                //echo count($fixture_list);
                               // print_r($fixture_list);
                                foreach($fixture_list as $fixture)
                                {
                                  $k++;
                                 // $sport_id = $fixture['sport_id'];
								  ?>
                                
                                 <div class="table-inner">
                                 
                                   <div class="table-span1">
                                  <div class="date-td"><?php echo $fixture['gmt_date_time'];?> </div>
                                  <div class="time-td"> <?php echo $fixture['local_time_form'];?> </div>
                                  </div>
                                  
                                  <div class="table-span2">
                                  <?php if($fixture['team1'] === $fixture['team2']) {?>
                                 <div class="team-main"><div class="team-com"> <?php echo $fixture['team1'];?> </div></div>
                                  <?php }else{?>
                                   <div class="team-main"><div class="team1"> <?php echo $fixture['team1'];?> </div>
                                  <div class="seperator"> vs. </div>
                                   <div class="team2"><?php echo $fixture['team2'];?></div> </div>
                                  <?php }?>
                                  </div>
                                  
                                  <div class="table-span3">
                                   
                <div class="game"> <?php echo $fixture['sport_name'];?> </div>
                 <div class="game-icon">
                <img src="<?php echo base_url();?>images/sports/45x45/<?php echo $fixture['sport_icon'];?>" />
                </div>
        <div class="channel"></div>
                
                
                                  <div class="check-in"><span class="check-hide">Select</span> <span class="checkbox-box">
                                    <input type="checkbox" name="fixture_<?=$k?>" id="fixture_<?=$k?>" 
                                    value="<?php echo $fixture['id'];?>"  
                                    onclick="SendFixtureInfoAPP('<?php echo base_url();?>',
                                    '<?php echo $cp;?>','<?php echo $ppr;?>','<?php echo $fixture['id'];?>',
                                    '<?php echo $sport_id;?>','<?php echo $date_from;?>','<?php echo $date_end;?>','<?php echo $search_text;?>', '<?php echo $k;?>')"
                                    class="checkbox" <?php if($fixture['fixture_check']=='checked') echo "checked='checked'" ;?> />
                                    <label for="fixture_<?=$k?>"></label></span> </div>
                                
                              </div></div>
							  <?php 
                            } 
                            ?>
                             
                      </div>        
 
 
 
 
 
 
 
 
 
 
  <?php } else {?> No fixture available <?php  }	  ?>
  
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
    onclick="SearchResult('<?php echo base_url();?>app/','<?php echo $pagination['previous_page'];?>','<?php echo $ppr;?>','<?php echo $date_from;?>','<?php echo $date_end;?>','<?php echo $search_text;?>','<?php echo $sport_id;?>')"
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
    <li><a href="javascript:void(0)"  onclick="SearchResult('<?php echo base_url();?>app/','1','<?php echo $ppr;?>','<?php echo $date_from;?>','<?php echo $date_end;?>','<?php echo $search_text;?>','<?php echo $sport_id;?>')" <?php if($cp == $start){?> class="active" <?php } ?>> &lt;&lt; </a></li>
    <?php }?>
    <?php if(($start >= 10) ){
		$prevset = $start-7;
		if($prevset < 1)$prevset =1;
		?>
    <li <?php if($cp == $start){?> class="active" <?php } ?> ><a href="javascript:void(0)"  onclick="SearchResult('<?php echo base_url();?>app/','<?php echo $prevset;?>','<?php echo $ppr;?>','<?php echo $date_from;?>','<?php echo $date_end;?>','<?php echo $search_text;?>','')" > &lt; </a></li>
    <?php }?>
    <?php 
      /*** declaring the page numbering based on current page Edited by Bagyaraj on Jul 23, 2015*///

 for($start;$start<=$endpage;$start++){ ?>
    <li <?php if($cp == $start){?> class="active" <?php } ?> ><a href="javascript:void(0)"  onclick="SearchResult('<?php echo base_url();?>app/','<?php echo $start;?>','<?php echo $ppr;?>','<?php echo $date_from;?>','<?php echo $date_end;?>','<?php echo $search_text;?>','<?php echo $sport_id;?>')" ><?php echo $start;?></a></li>
    <?php }  
   /*** declaring the page numbering ends*///
 ?>
    <?php if($pagination['total_page'] - $endpage >= 10){
		$nextset = $endpage +7;
		if($nextset > $pagination['total_page'])$nextset = $pagination['total_page'];
		?>
    <li><a href="javascript:void(0)"  onclick="SearchResult('<?php echo base_url();?>app/','<?php echo $nextset;?>','<?php echo $ppr;?>','<?php echo $date_from;?>','<?php echo $date_end;?>','<?php echo $search_text;?>','<?php echo $sport_id;?>')" <?php if($cp == $start){?> class="active" <?php } ?>> &gt; </a></li>
    <?php }?>
    <?php if($endpage < ($pagination['total_page'])){?>
    <li><a href="javascript:void(0)"  onclick="SearchResult('<?php echo base_url();?>app/','<?php echo $pagination['total_page'];?>','<?php echo $ppr;?>','<?php echo $date_from;?>','<?php echo $date_end;?>','<?php echo $search_text;?>','<?php echo $sport_id;?>')" <?php if($cp == $start){?> class="active" <?php } ?>> &gt;&gt; </a></li>
    <?php }?>
    <?php  
  if($pagination['next_page'] > 0)
  {
   ?>
    <li class="pagi_next"><a href="javascript:void(0)" onclick="SearchResult('<?php echo base_url();?>app/','<?php echo $pagination['next_page'];?>','<?php echo $ppr;?>','<?php echo $date_from;?>','<?php echo $date_end;?>','<?php echo $search_text;?>','<?php echo $sport_id;?>')" >Next</a></li>
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
  
