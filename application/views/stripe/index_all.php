	<div class="popup-box" id="payment_popup_all">
    <h2>SH365 Subscription</h2><br/>
    <h4><?php echo $free_days_left;?>Subscribe now to get your full weekly tv listing! Promote your bar with a higher placement on our Sport finder App and web.  Here you can create events and Special offers, which will send out notifications to users in your area.</h4>
    <div id="payment_form_all">
		<form action="/your-charge-code" method="POST" id="payment-form-all" class="form-inline">
		<span class="payment-errors"></span>
		<span class="popup-form">
			<div class="plan_div"><input type="radio" class="subscribe_plan" value="standard_monthly_plan" name="plan" data-amount="1000" /><h3>€10 / Month &nbsp;&nbsp;</h3></div>
            <div class="plan_div"><input type="radio" class="subscribe_plan" value="standard_yearly_plan" name="plan" checked="checked"  data-amount="6000"/><h3>€60 / Year</h3></div> 
		</span>
		<span class="popup-form">
			<input type="text" pattern="\d+" size="20" minlength="16" maxlength="16" class="popup-input1" data-stripe="number" placeholder="Card Number" required>
		</span>
		 <span class="popup-form">
       <span class="form-box21">
         	<span class="form-box2">
            <input type="text" size="2" class="popup-input-1" data-stripe="exp_month" placeholder="Exp. month (MM)" required>
            <span class="small_devider"> / </span>
            <input type="text" size="2" class="popup-input-1" data-stripe="exp_year"placeholder="Exp. Year (YY)" required>
            </span>
            <span class="devider"></span>
            </span>
            <span class="form-box22">
            	<input type="text" size="4" class="popup-input1" data-stripe="cvc" placeholder="CVC" required>
            </span>
            </span>
         <span class="button-row">
         
         <input type="submit" class="submit popup-button" value="Submit Payment">
         </span>
         <span class="stripe-logo button-row">
         <img src="<?php echo base_url('img'); ?>/stripe_cc_powered_logo.png" >
         </span>
			
	</form>
   </div>
   <div id="payment_update_all" style="display: none;">
      <h3 id="payment_update_text_all"></h2>
      <a class="change-now"> href="<?php echo base_url('establishment/profile_settings'); ?>">CLOSE</a>
   </div>

	</div>
