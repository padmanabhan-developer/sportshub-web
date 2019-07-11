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
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
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
          <!-- Sidebar user panel -->
          <!--<div class="user-panel">
            <div class="pull-left image">
              <img src="./index_files/user2-160x160.jpg" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
              <p>Admin</p>

              <a href="http://onlydental.eu/dkready/admin/dashboard.php#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
          </div>-->
          <!-- search form -->
          <!--<form action="#" method="get" class="sidebar-form">
            <div class="input-group">
              <input type="text" name="q" class="form-control" placeholder="Search..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
          </form>-->
          <!-- /.search form -->
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <?php $this->load->view('admin/left');?>
        </section>
        <!-- /.sidebar -->
      </aside>
    
    
    <div id="content">
       <div class="container">
              
              
            <div class="events">
                   <h2 class="title2">users</h2>
                    <?php  echo form_open("",$attribute_search['form']);
                        echo form_hidden('caller','Search'); ?>
                   <div class="event-form">
                      <span class="event-form-box">
                              <?php echo form_input($attribute_search['date_from']);?>
                        </span>
                        
                        <span class="event-form-box">
                             <?php echo form_input($attribute_search['date_end']);?>
                        </span>
                        
                        <span class="event-form-box">
                              <?php echo form_input($attribute_search['search_text']);?>
                              <!--<input name="" type="button" class="search-button">-->
                              <?php echo form_submit($attribute_search['submit']);?>
                        </span>
                        <input type="hidden" id="path" value="<?php echo base_url();?>admin/">
                   </div><!-- close event-form -->
                   <?php echo form_close();?>
                   <div class="row3">
                      <span class="title3">Show only:</span>
                      <span class="box1"><span class="checkbox-box3"><input type="checkbox" name="genre" id="check-1" value="action" /><label for="check-1"></label></span>Men</span>
                        <span class="box1"><span class="checkbox-box3"><input type="checkbox" name="genre" id="check-2" value="action" /><label for="check-2"></label></span>Woman</span>
                   </div>
                   
                    <?php $this->load->view('admin/user_display.php');?>
                   
              </div><!-- close events -->
         </div><!-- close container -->
    </div><!-- close content -->
  </div>
  <!--close wrapper-->
<script src="<?php echo base_url();?>js/admin/jQuery-2.1.3.min.js"></script>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="<?php echo base_url();?>js/admin/bootstrap.min.js"></script>
    
    <script src="http://netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>js/admin/core.js"></script> 
    <script type="text/javascript" src="<?php echo base_url();?>js/admin/zebra_datepicker.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>js/jquery-confirm.min.js"></script>
 	<script type="text/javascript" src="<?php echo base_url();?>js/admin/bootbox.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>js/admin/ajax.js"></script>	
    <script type="text/javascript" src="<?php echo base_url();?>js/admin/customInput.jquery.js"></script>
    
  <script type="text/javascript">
  // Run the script on DOM ready:
  $(function(){
    $('input').customInput();
  });
  $(document).ready(function() {
		default_user_load_function();
  });
  </script>

<!-- jQuery 2.1.3 -->
    
    <!-- jQuery UI 1.11.2 -->
    
    <!-- AdminLTE App -->
    <script src="<?php echo base_url();?>js/admin/app.min.js" type="text/javascript"></script>
    <!-- common script-->
    
  <script type="text/javascript" src="<?php echo base_url();?>js/admin/customInput.jquery.js"></script>
    
  <script type="text/javascript">
  // Run the script on DOM ready:
  $(function(){
    $('input').customInput();
  });
  </script>
  <script>
        $(".close2").click(function(){  
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
					url: '<?php echo base_url();?>admin/delete_user_ajax',
					data: {"deleteid": deleteid, "caller" : "delete"},
					type: 'post',
					success: function(result) {
						//alert(result)
						//alert(result);return false;
						if(result){
								//$('#gallery_box_'+imageid).remove();
							window.location = '<?php echo base_url();?>admin/user';
							}
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
				url: '<?php echo base_url();?>admin/block_user_ajax',
				success: function(response){
					location.reload();
					}
			},"json");
			//Example.show("Hi <b>"+result+"</b>");                          
		  }
		}); 
	});
	
 $(".unblock").click(function(){  

    var unblockid = $(this).attr("data-unblockid");
    if(unblockid > 0) { 
		  $.confirm({
			  title: 'Please confirm!',
			  content: 'Are you sure you want to  un block this user ?',
			  confirm: function(){
				$.ajax
				({ 
				  url: '<?php echo base_url();?>admin/block_user_ajax',
				  data: {id: unblockid, type:'unblock'},
				  type: 'post',
				  success: function(result) {
					if(result){
						location.reload();
					  }
					}
				});
				},
			  cancel: function(){ }
		 });
     }
  });	

</script>
    
  </body>
</html>