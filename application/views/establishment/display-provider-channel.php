<?php 
 if(count($provider_all_channel) > 0) { ?>
  <?php      
	foreach ( $provider_all_channel as $pkey => $pval ) { 
		if(in_array($pval['id'], $selected_channel_ids)){$checkvalue = 'checked';} else{$checkvalue = '';}
	?>
    	<ul class="provider_ul" data-provider="<?php echo $pval['provider_id'];?>" >
            <li><span class="checkbox-box2"><input type="checkbox" <?php echo $checkvalue;?>  name="provider_channel" id="<?php echo $pval['provider_id'].'_'.$pval['id']; ?>"  value="action" /><label for="<?php echo $pval['provider_id'].'_'.$pval['id']; ?>" ></label></span><?php echo $pval['channel_name_dp']; ?></li>
   	   </ul>
<?php 
	}	
  } 
  else { ?>
 
 
 <?php } ?>
 
 
