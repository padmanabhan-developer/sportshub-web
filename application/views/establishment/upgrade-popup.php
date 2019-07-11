 <div class="popup-box">
                   <h2>Please fill in the your <br>payment details to upgrade to premium</h2>
                   
        <?php
                      echo form_open(base_url()."establishment/profile_settings",$attribute_upgrade_card['form']);
                      echo form_hidden('caller','Upgrade Card');
                      echo form_hidden('establishment_id',$establishment_id);

                    ?>
                    <div id="errorDiv" style="float:left; width:268px; background:#f4f3f3; color:#e60000; border:dotted 1px #c12e1e; font-family: 'open_sansregular'; margin-top:2px; margin-bottom:8px; padding:5px;font-size:13px; <?php $errors=validation_errors(); if(empty($errors)){?>display:none;<?php } else{?> display:inline; <?php }?>"><?php echo validation_errors("<p style='color:#e60000;'>","</p>"); ?>       </div>
                   
                   <span class="popup-form">
                       <span class="form-box1"><?php echo form_input($attribute_upgrade_card['first_name']);?></span>
                       <span class="form-box1"><?php echo form_input($attribute_upgrade_card['last_name']);?></span>
                   </span>
                   
                   <span class="popup-form"><?php echo form_input($attribute_upgrade_card['card_number']);?></span>
                   
                   <span class="popup-form">
                       <span class="form-box2"><?php echo form_input($attribute_upgrade_card['exp_month']);?></span><span class="devider"></span>
                       <span class="form-box2"><?php echo form_input($attribute_upgrade_card['exp_year']);?></span><span class="devider"></span>
                       <span class="form-box2"><?php echo form_input($attribute_upgrade_card['code']);?></span>
                   </span>
                   <span class="button-row"><span class="visa"><img src="<?php echo base_url();?>images/visa.png"></span><?php echo form_submit($attribute_upgrade_card['submit']);?></span>
             <?php echo form_close();?>
              </div><!-- close popup-box -->