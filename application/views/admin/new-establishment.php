 <div class="popup-box" >

                   <h2>add new Establishment</h2> 
                   <div id="errorDiv1" style="float:left; width:268px; background:#f4f3f3; color:#e60000; border:dotted 1px #c12e1e; font-family: 'open_sansregular'; margin-top:2px; margin-bottom:8px; padding:5px;font-size:13px; display:none;"></div>
                   <div id="erroremail"></div>
                    <?php  
					
                   echo form_open(base_url()."admin/new_establishment",$attribute_newest['form']);
                   echo form_hidden('caller','new_est'); ?>
                   
                   <span class="popup-form"><?php echo form_input($attribute_newest['title']);?></span>
                   <!--<h4 style="color:red;"><?php //echo form_error('title', '<div class="error">', '</div>'); ?></h4>-->
                   <span class="popup-form"><?php echo form_input($attribute_newest['email']);?></span>
                   <!--<h4 style="color:red;"><?php //echo form_error('email', '<div class="error">', '</div>'); ?></h4>-->
                   <span class="popup-form"><?php echo form_input($attribute_newest['password']);?></span>
                   <!--<h4 style="color:red;"><?php //echo form_error('password', '<div class="error">', '</div>'); ?></h4>-->
                    
                   <span class="button-row"><?php echo form_submit($attribute_newest['submit']); ?></span>
                  <?php echo form_close();?>
              </div><!-- close popup-box -->
 <script src="<?php echo base_url();?>js/establishment/jQuery-2.1.3.min.js"></script>
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
 

	 
/* $(document).ready(function(e) {
	 // alert('dbvd')
    $("#title").click(function(data){  
	alert('test')
		var email = $(this).val();
		alert(email);
	});
 });*/
  </script>