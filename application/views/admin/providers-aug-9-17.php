<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <title>sportshub</title>
    <link rel="icon" type="images/favicon" href="images/favicon.ico" />
    <!-- Bootstrap -->
    <link href="<?php echo base_url();?>css/admin/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>css/admin/bootstrap-theme.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>css/admin/style.css" rel="stylesheet">
    <link href="<?php echo base_url();?>css/jquery-confirm.css" rel="stylesheet">
    <link href="<?php echo base_url();?>css/admin/AdminLTE.min.css" rel="stylesheet" type="text/css">
    <link href="<?php //echo base_url();?>css/establishment/style.css" rel="stylesheet">
   
    
  </head>
  <body>
  <div class="wrapper">
    <header id="header">
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
        
      <div class="container">
           <div class="logo"><a href="#"><img src="<?php echo base_url();?>images/logo.png"></a></div>
        </div><!-- close container -->
    </header><!-- close header -->
    
    
    <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar" style="height: auto;">
          <?php $this->load->view('admin/left');?>
        </section>
        <!-- /.sidebar -->
      </aside>
    
    <div id="content">
       <div class="container">
              <!--<a href="#" class="add-new-event" >new establishments</a>-->
              <a href="javascript:void(0)" class="add-new-event" data-cta-target=".js-dialog1" id="popup2" title="Click here to Add" onclick="javascript:NewChannelForm('<?php echo base_url();?>admin/');">New Provider</a>
              <div class="js-dialog1  modal  dialog" style="text-align: center;width:628px; min-height:369px; height:400px; margin:0;">
                 <span class="modal-close-btn"></span>
                 <div id="new_est">
                 <?php //$this->load->view('admin/new-channel');?>
           		</div>
              </div>
              
            <div class="events">
                   <h2 class="title2">Providers</h2>
                     <?php
					 	echo form_open("",$attribute_search['form']);
                        echo form_hidden('caller','Search'); ?>
                   <div class="event-form">
                         
                        <span class="event-form-box">
                        	<?php echo form_input($attribute_search['search_text']);?>
                        	<?php echo form_submit($attribute_search['submit']);?>
                        </span>
                        <input type="hidden" id="path" value="<?php echo base_url();?>admin/">

                   </div><!-- close event-form -->
                   <?php echo form_close();?>
                   <!--<div class="row3">
                      <span class="title3">Show only:</span>
                      <span class="box1 small-text"><span class="checkbox-box3"><input type="checkbox" name="genre" id="check-1" value="action" /><label for="check-1"></label></span>Active</span>
                        <span class="box1 small-text"><span class="checkbox-box3"><input type="checkbox" name="genre" id="check-2" value="action" /><label for="check-2"></label></span>Inactive</span>
                   </div>-->                  
				   <?php $this->load->view('admin/provider_display.php');?>
              </div><!-- close events -->
         </div><!-- close container -->
    </div><!-- close content -->
    
    
  </div><!--close wrapper-->
    <script src="<?php echo base_url();?>js/admin/jQuery-2.1.3.min.js"></script>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="<?php echo base_url();?>js/admin/bootstrap.min.js"></script>
    
    <script src="http://netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
    
  
    <script type="text/javascript" src="<?php echo base_url();?>js/admin/core.js"></script>

    <script type="text/javascript" src="<?php echo base_url();?>js/admin/customInput.jquery.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>js/establishment/ajax.js"></script>
    <script src="<?php echo base_url();?>js/admin/form_validation.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>js/admin/ajax.js"></script>
      <!-- AdminLTE App -->
    <script src="<?php echo base_url();?>js/admin/app.min.js" type="text/javascript"></script>
  <!-- common script-->
    
    <script src="http://netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>js/establishment/customInput.jquery.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>js/establishment/jquery-ui.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>js/establishment/jquery.picture.cut.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>js/jquery-confirm.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>js/admin/bootbox.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>js/admin/customInput.jquery.js"></script>
    
<script>
 $(function(){
    $('input').customInput();
  });  
 </script>

   <script type="text/javascript" src="<?php echo base_url();?>js/establishment/zebra_datepicker.js"></script>
  <script type="text/javascript" >
$(document).ready(function() {
default_load_function();
});
</script>

   <script>
        $(".close2_").click(function(){  
		//var imageid = $(this).attr("data-imageid");
		//var imagerow = $(this).attr("data-rowid");
		var deleteid = $(this).attr("data-deleteid");
		//var action =delete;
		if(deleteid > 0) { 
			$.confirm({
			title: 'Please confirm!',
			content: 'Are you sure you want to Delete the  Record?',
			confirm: function(){
				$.ajax
				({ 
					url: '<?php echo base_url();?>admin/delete_ajax',
					data: {"deleteid": deleteid, "caller" : "delete"},
					type: 'post',
					success: function(result) {
						//alert(result)
						//alert(result);return false;
						//if(result){
								//$('#gallery_box_'+imageid).remove();
							//window.location = '<?php echo base_url();?>admin/establishments';
						//}
						}
				});
				},
			cancel: function(){
			}
		});
		}
	});
	
   jQuery(document).on("click", ".block", function(e) {
			//var status = jQuery(this).data('status');
			var blockid = jQuery(this).attr('data-blockid');	
			//alert(status + userid);return false;
		bootbox.prompt("Write the reason to block?", function(result) {                
		if (result === null) {
													   
		} else {
			jQuery.ajax({
				type: 'POST',
				data: {id:blockid, reason:result,type:'block'},
				url: '<?php echo base_url();?>admin/block_ajax',
				success: function(response){
					location.reload();
					}
			},"json");
			//Example.show("Hi <b>"+result+"</b>");                          
		  }
		}); 
	});

 jQuery(document).on("click", ".unblock", function(e) {	
// $(".unblock").click(function(){  

    var unblockid = $(this).attr("data-unblockid");
    if(unblockid > 0) { 
		  $.confirm({
			  title: 'Please confirm!',
			  content: 'Are you sure you want to  un block this establishment ?',
			  confirm: function(){
				$.ajax
				({ 
				  url: '<?php echo base_url();?>admin/block_ajax',
				  data: {id: unblockid, type:'unblock'},
				  type: 'post',
				  success: function(result) {
					//if(result){
						location.reload();
					  //}
					}
				});
				},
			  cancel: function(){ }
		 });
     }
  });	

</script>
   
   
    <script src="<?php echo base_url();?>js/admin/cta.js"></script>
    <script>
    var closeFn;
    function closeShowingModal() {
      var showingModal = document.querySelector('.modal.show');
      if (!showingModal) return;
      showingModal.classList.remove('show');
      document.body.classList.remove('disable-mouse');
      if (closeFn) {
        closeFn();
        closeFn = null;
      }
    }
    document.addEventListener('click', function (e) {
      var target = e.target;
      if (target.dataset.ctaTarget) {
        closeFn = cta(target, document.querySelector(target.dataset.ctaTarget), { relativeToWindow: true }, function showModal(modal) {
          modal.classList.add('show');
          document.body.classList.add('disable-mouse');
        });
      }
      else if (target.classList.contains('modal-close-btn')) {
        closeShowingModal();
      }
    });
    document.addEventListener('keyup', function (e) {
      if (e.which === 27) {
        closeShowingModal();
      }
    })
    </script>
    
  </body>
</html>