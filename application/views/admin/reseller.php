<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <title>sportshub</title>
    <link rel="icon" type="images/favicon" href="images/favicon.ico" />
    <link href="<?php echo base_url();?>css/admin/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>css/admin/bootstrap-theme.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>css/jquery-confirm.css" rel="stylesheet">
    <link href="<?php echo base_url();?>css/admin/style.css" rel="stylesheet">
    <link href="<?php echo base_url();?>css/establishment/style.css" rel="stylesheet">
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
        <?php $this->load->view('admin/left');?>
        </section>
        <!-- /.sidebar -->
      </aside>
    
    <div id="content">
       <div class="container">
            <a href="<?php echo base_url();?>admin/addreseller" class="add-new-event" >Add Reseller</a> 
            <div class="events">
                   <h2 class="title2">Reseller</h2> </br>
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
                      <span class="box1"><span class="checkbox-box3"><input type="radio" name="filter" class="filter" value='0' id="check-1" /><label for="check-1"></label></span>ACTIVE</span>
                        <span class="box1"><span class="checkbox-box3"><input type="radio" name="filter" class="filter" value='1' id="check-2" /><label for="check-2"></label></span>BLOCKED</span>
                   </div>
                 	<?php $this->load->view('admin/reseller_display');?>
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
    <script type="text/javascript" src="<?php echo base_url();?>js/jquery-confirm.min.js"></script>
 	<script type="text/javascript" src="<?php echo base_url();?>js/admin/bootbox.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>js/admin/ajax.js"></script>	
    <script type="text/javascript" src="<?php echo base_url();?>js/admin/zebra_datepicker.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>js/admin/core.js"></script>

    <script src="<?php echo base_url();?>js/admin/app.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url();?>js/admin/cta.js"></script>
    <!-- <script src="<?php echo base_url();?>js/establishment/cta.js"></script>-->
    <script type="text/javascript" src="<?php echo base_url();?>js/establishment/customInput.jquery.js"></script>
  <script type="text/javascript">
  // Run the script on DOM ready:
   $(document).ready(function() {
		default_reseller_load_function();
		var PATH = '<?php echo base_url();?>admin/';
		delete_reseller_function(PATH);
   });
  
  $(function(){
    $('input').customInput();
  });
  
  </script>
  
  <script src="<?php echo base_url();?>js/establishment/cta.js"></script>
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
    });
</script>
  </body>
</html>