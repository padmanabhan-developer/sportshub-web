	<div class="popup-box" id="payment_popup">
    <h2>SH365 Subscription</h2><br/>
    
		<form action="/your-charge-code" method="POST" id="payment-form" class="form-inline">
		<span class="payment-errors"></span>
		<span class="popup-form">
			<div class="plan_div"><input type="radio" class="subscribe_plan" value="1" name="plan" data-amount="1000" /><h3>€10 / Month &nbsp;&nbsp;</h3></div>
            <div class="plan_div"><input type="radio" class="subscribe_plan" value="2" name="plan" checked="checked"  data-amount="6000"/><h3>€60 / Year</h3></div> 
		</span>
		<span class="popup-form">
			<input type="text" size="20" class="popup-input1" data-stripe="number" placeholder="Card Number" required>
		</span>
		 <span class="popup-form">
         	<span class="form-box2">
            <input type="text" size="2" class="popup-input-1" data-stripe="exp_month" placeholder="Exp. month (MM)" required>
            <span class="small_devider"> / </span>
            <input type="text" size="2" class="popup-input-1" data-stripe="exp_year"placeholder="Exp. Year (YY)" required>
            </span>
            <span class="devider"></span>
            <span class="form-box2">
            	<input type="text" size="4" class="popup-input1" data-stripe="cvc" placeholder="CVC" required>
            </span>
            <span class="devider"></span>
            <span class="form-box2">
            	<input type="text" size="6" class="popup-input1" data-stripe="address_zip" placeholder="Billing Zip" required>
            </span>
         </span>
         <span class="button-row">
         <input type="hidden" name="subscribe_amount" id="subscribe_amount" value="6000" />
         <input type="submit" class="submit popup-button" value="Submit Payment">
         </span>
			
	</form>
	</div>
