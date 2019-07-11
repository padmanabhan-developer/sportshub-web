<?php
//echo $free_days_left;
$check_array = array(20, 15,10,9,8,7,6,5,4,3,2,1);
      if(($subscription == 0) && (($free_days_left == 0) || (in_array($free_days_left, $check_array)) ))
      {
        
        ?>
  <!-- jQuery Popup Overlay --><span class="slide_open" ></span>
<script src="<?php echo base_url();?>js/establishment/jquery.popupoverlay.js"></script>
<div id="slide" class="well" style="text-align: center;">
<h4>Sportshub365.com Subscription</h4><span class="slide_close popup-button-small1"></span>
<pre class="prettyprint">
<code>

<?php if($free_days_left == 0){?>
<em>Your free trial is over. Please upgrade your account.</em>
<?php } 
else if(in_array($free_days_left, $check_array)){?>
<em><?php echo $free_days_left;?> days left of the free trial, before downgrading to basic!</em>
<?php } ?>
<strong>Get more clients!</strong>
<li>-Top visibility on web and app</li>
<li>-Full tv listings, instead of 24H</li>
<li>-Create offers in your bar</li>
<li>-Create events and send notifications to app users in your area</li>
<li>-Full access to the system...!</li>
</code>
</pre>
  
  <a href="<?php echo base_url();?>establishment/profile_settings" class="popup-button-small"> Proceed to payment </a>  
</div>

<script>
$(document).ready(function () {
//alert('');
    $('#slide').popup({
        focusdelay: 400,
        outline: true,
        vertical: 'topedge'
    });
$('.slide_open').click();
});
</script>
<?php }?>