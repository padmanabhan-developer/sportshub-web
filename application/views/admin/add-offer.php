 <script type="text/javascript" src="<?php echo base_url();?>js/admin/form_validation.js"></script>
 <div class="popup-box" >

                   <h2>add new offer</h2> <div id="errorDiv_offer" style="float:left; width:268px; background:#f4f3f3; color:#e60000; border:dotted 1px #c12e1e; font-family: 'open_sansregular'; margin-top:2px; margin-bottom:8px; padding:5px;font-size:13px; display:none;">       </div>
                    <?php  
					//echo "action-".$form_action."".$offer_id;
					if($form_action=="insert"){ echo form_open(base_url()."admin/display_offer",$attribute_offer['form']);}
                    else {
                      echo form_open(base_url()."admin/display_offer",$attribute_offer['form']);
                      echo  form_hidden('offer_id',$offer_id); 
                    }
                   echo form_hidden('caller','Offer'); ?>
                   
                   <span class="popup-form"><?php echo form_input($attribute_offer['title']);?></span>
                   
                   <span class="popup-form">
                   <?php echo form_input($attribute_offer['description']);?></span>
                   <span class="popup-form">
                   <span class="form-box2"> <?php echo form_input($attribute_offer['price_or_discount']);?></span>
                   <span class="form-box2"> <?php echo form_input($attribute_offer['promo_code']);?></span>
                   <span class="popup-checkbox">
                      <span class="checkbox-box2">
                      <div class="custom-checkbox">
                      <div class="custom-checkbox">
                      <input type="checkbox" value="1" id="check-14" 
                            name="isactive" 
                            class="checkedFocus" <?php if(isset($isactive) && $isactive==1) {?>checked="checked" <?php } ?> onclick="checkfuntion();">
                      <label class="<?php if(isset($isactive) && $isactive==1) {?>checked<?php } ?>" for="check-14" name="chk14"></label>
                      </div>
                      </div>

                      </span>
                      Is Active?</span>
                      </span>
                    
                    
                   <span class="button-row"><?php  if($form_action=="insert"){echo form_submit($attribute_offer['submit']); }
                   else echo form_submit($attribute_offer['update']);?></span>
                  <?php echo form_close();?>
              </div><!-- close popup-box -->
<!-- <script src="<?php //echo base_url();?>js/establishment/jQuery-2.1.3.min.js"></script>-->
  <script type="text/javascript" src="<?php echo base_url();?>js/establishment/customInput.jquery.js"></script>
  <script type="text/javascript">
  // Run the script on DOM ready:
  $(function(){
    $('input').customInput();
  });
    function checkfuntion(){
		
		if($("#check-14").is(':checked') == true)
			{$('label[for="check-14"]').addClass('checked');}
		else 
		{$('label[for="check-14"]').removeClass('checked');}
    }                 
  


  </script>
