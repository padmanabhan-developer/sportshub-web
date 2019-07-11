
<?php 
 if(count($provider_channels) > 0) {
	 $provider_id = $provider_channels[0]['provider_id'];
	 if($provider_id!=10) {
	?>
	<h2>2. Choose your Channels <small>(All channels are automaticly choosen, please deselect the ones you don't have)</small></h2>
	<?php } else { ?>
	<h2>2. Choose your Channels <small>(Please select the channels you want)</small></h2>
	<?php } 

	 $checked = ($provider_channels[0]['provider_id']==10)?'':'checked';
	  ?>
 	<input type="hidden" value="<?php if(count($selected_channel_ids)==0 && $provider_id!=10) { echo $total_records; } else if($provider_id == 10 ){ echo count($selected_channel_ids); } else { echo count($selected_channel_ids); } ?>" id="channel_count" >
<?php  if(($provider_channels[0]['provider_id']!=10)) { ?>
	 <ul data-provider="" class="select_all">
            <li><span class="checkbox-box2"><div class="custom-checkbox"><input type="checkbox" <?php if(count($selected_channel_ids) == $total_records) { ?> checked="checked" <?php } ?> value="<?php ?>" id="select_all"><label for="select_all"></label></div></span>Select All</li>
    </ul>
 <?php } else { ?>
<ul data-provider="" class="select_all">
 <span class="side-search">
    <input type="hidden" name="caller" value="Channel_Search" >
    <input id="channel_search_text" class="search-input" type="text"  value="<?php echo $search_text; ?>" placeholder="Search" name="channel_search_text">
    <input class="search-button" type="button" name="chl_submit" onclick="SearchOtherChannel(channel_search_text.value, '<?php echo $provider_id; ?>')">
 </span>
</ul> 
                                     
<?php }		
	$total_count = count($provider_channels);
	$total_row = round(($total_count /3), 0);
	//if(($total_count%3) > 0){$total_row = $total_row +1;}
	$cnt =0;
	?>
    <div id="other_channels">
	<ul class="provider_ul">					   
    <?php 
	foreach ( $provider_channels as $pkey => $pval ) { 
	
	if(($cnt > 1) && (($cnt % $total_row) == 0)) { ?> </ul><ul class="provider_ul"> <?php }
	//print_r($selected_channel_ids); die;
	if(count($selected_channel_ids)!=0) {
		if(in_array($pval['id'], $selected_channel_ids)){$checkvalue = 'checked';} else{$checkvalue = '';}
	}
	else {
		$checkvalue = '';
		/*if($provider_id !=10) {
			$checkvalue = 'checked';
		}
		else {
			$checkvalue = '';
		}*/
	  }
	
	?>
    	
            <li><span class="checkbox-box2"><input type="checkbox" <?php echo $checkvalue ?> name="provider_channel" id="<?php echo $pval['provider_id'].'_'.$pval['id']; ?>"  value="action" /><label for="<?php echo $pval['provider_id'].'_'.$pval['id']; ?>" name="provider_channel" ></label></span><?php echo $pval['channel_name_dp']; ?></li>

<?php $cnt++; 
	}	?>
	 </ul>
<?php	
  } 
  else { ?>
 		<h2>No channels found.</h2>
	 
 <?php } ?>
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
    onclick="SearchProviderChannelResult('<?php echo base_url();?>app/','<?php echo $pagination['previous_page'];?>','<?php echo $ppr;?>','<?php echo $search_text;?>','<?php echo $provider_id;?>')"
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
    <li><a href="javascript:void(0)"  onclick="SearchProviderChannelResult('<?php echo base_url();?>establishment/','1','<?php echo $ppr;?>','<?php echo $search_text;?>','<?php echo $provider_id;?>')" <?php if($cp == $start){?> class="active" <?php } ?>> &lt;&lt; </a></li>
    <?php }?>
    <?php if(($start >= 10) ){
		$prevset = $start-7;
		if($prevset < 1)$prevset =1;
		?>
    <li <?php if($cp == $start){?> class="active" <?php } ?> ><a href="javascript:void(0)"  onclick="SearchProviderChannelResult('<?php echo base_url();?>app/','<?php echo $prevset;?>','<?php echo $ppr;?>','<?php echo $search_text;?>','')" > &lt; </a></li>
    <?php }?>
    <?php 
      /*** declaring the page numbering based on current page Edited by Bagyaraj on Jul 23, 2015*///

 for($start;$start<=$endpage;$start++){ ?>
    <li <?php if($cp == $start){?> class="active" <?php } ?> ><a href="javascript:void(0)"  onclick="SearchProviderChannelResult('<?php echo base_url();?>app/','<?php echo $start;?>','<?php echo $ppr;?>','<?php echo $search_text;?>','<?php echo $provider_id;?>')" ><?php echo $start;?></a></li>
    <?php }  
   /*** declaring the page numbering ends*///
 ?>
    <?php if($pagination['total_page'] - $endpage >= 10){
		$nextset = $endpage +7;
		if($nextset > $pagination['total_page'])$nextset = $pagination['total_page'];
		?>
    <li><a href="javascript:void(0)"  onclick="SearchProviderChannelResult('<?php echo base_url();?>app/','<?php echo $nextset;?>','<?php echo $ppr;?>','<?php echo $search_text;?>','<?php echo $provider_id;?>')" <?php if($cp == $start){?> class="active" <?php } ?>> &gt; </a></li>
    <?php }?>
    <?php if($endpage < ($pagination['total_page'])){?>
    <li><a href="javascript:void(0)"  onclick="SearchProviderChannelResult('<?php echo base_url();?>app/','<?php echo $pagination['total_page'];?>','<?php echo $ppr;?>','<?php echo $search_text;?>','<?php echo $provider_id;?>')" <?php if($cp == $start){?> class="active" <?php } ?>> &gt;&gt; </a></li>
    <?php }?>
    <?php  
  if($pagination['next_page'] > 0)
  {
   ?>
    <li class="pagi_next"><a href="javascript:void(0)" onclick="SearchProviderChannelResult('<?php echo base_url();?>app/','<?php echo $pagination['next_page'];?>','<?php echo $ppr;?>','<?php echo $search_text;?>','<?php echo $provider_id;?>')" >Next</a></li>
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
</div>

<?php
 }  
 ?>
<span class="tvprovider_title" id="tvprovider-success" style="display:none"></span>  

