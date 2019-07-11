
<div style="float:right; padding-right: 15px;" id="step_1_tooltips" data-toggle="tooltip" data-placement="top" title="<span style='cursor: pointer;' class='hidetooltip pull-right'>x</span><b>STEP 1 </b> <br> <span style='text-transform: uppercase;'>Select the Games and fixtures you wish to show at your venue.</span>">
	<span style="color: #1f1f1f;font-family: 'LatoBla';font-size: 16px; margin: 0 13px 0 0;">Select All </span>
    <span class="checkbox-box ">
        <input name="select_all" id="select_all" value="217418" onclick="selectAllFixture('<?php echo base_url();?>')" class="checkbox" type="checkbox" <?php if($total_records == $total_schedule) { ?> checked="checked" <?php } ?> >
        <label for="select_all" class="checked"></label>
    </span>
</div>
        
<input type="hidden" value="<?php echo $channel_id;?>" id="total_channel_ids" >
<div class="events-inner" id="show_fixture">
	<?php $this->load->view('establishment/display-fixture');?>                       
</div> <!-- close events-inner -->


