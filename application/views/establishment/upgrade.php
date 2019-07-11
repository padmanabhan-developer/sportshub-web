<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <title>sportshub</title>
    <link rel="icon" type="images/favicon" href="images/favicon.ico" />
    <!-- Bootstrap -->
    <link href="<?php echo base_url();?>css/establishment/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>css/establishment/bootstrap-theme.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>css/establishment/style.css" rel="stylesheet">
	<link href="<?php echo base_url();?>css/establishment/AdminLTE.min.css" rel="stylesheet" type="text/css">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script type="text/javascript" src="<?php echo base_url();?>js/establishment/ajax.js"></script>
   <script type="text/javascript" src="<?php echo base_url();?>js/establishment/form_validation.js"></script>
   <?php include('google_analytics.php')?>
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
          <!-- sidebar menu: : style can be found in sidebar.less -->
           <?php $this->load->view('establishment/left-menu');?>
        </section>
        </section>
        <!-- /.sidebar -->
      </aside>
    
    
    <div id="content">
    	 <div class="container">
         	  <div class="upgrade-account">
              	   <div class="row">
                   		<div class="col-lg-6 upgrade-account-left">
                        	 <div class="upgrade-account-box">
                             	  <h2>Free account</h2>
                                  <div class="upgrade-account-header yellow-box">
                                  	   <h3>0$ </h3>
                                       <h6>A free version of Sportshub</h6>
                                  </div>
                                  <div class="upgrade-account-content">
                                  	   <p>Sed sollicitudin urna eget condimentum ultricies. Donec in libero rhoncus, aliquet magna vitae, pharetra enim. Ut </p>
                                       <ul>
                                       		<li>Here is some USP's about the Sportshub</li>
                                            <li>Here is USP about the Sportshub</li>
                                            <li>about the USP's </li>
                                            <li>Here comes som more text</li>
                                       </ul>
                                  </div>
                                  <a href="#" class="your-choice">Your choice</a>
                             </div><!-- close upgrade-account-box -->
                        </div><!-- close col-lg-6 -->
                        
                        <div class="col-lg-6 upgrade-account-left">
                        	 <div class="upgrade-account-box">
                             	  <h2>Premium account</h2>
                                  <div class="upgrade-account-header blue-box">
                                  	   <h3>10$  </h3>
                                       <h6>Get visitors with Sportshub premium</h6>
                                  </div>
                                  <div class="upgrade-account-content">
                                  	   <p>Sed sollicitudin urna eget condimentum ultricies. Donec in libero rhoncus, aliquet magna vitae, pharetra enim. Ut </p>
                                       <ul>
                                       		<li>Here is some USP's about the Sportshub</li>
                                            <li>Here is USP about the Sportshub</li>
                                            <li>about the USP's </li>
                                            <li>Here comes som more text</li>
                                       </ul>
                                  </div>
                                 <a href="javascript:void(0);" class="your-choice upgrade-now" data-cta-target=".js-dialog">Upgrade now</a>
                                 <div class="js-dialog  modal  dialog" >
                              <span class="modal-close-btn"></span>
                             <?php $this->load->view('establishment/upgrade-popup');?>
                
                            </div>
                             </div><!-- close upgrade-account-box -->
                        </div><!-- close col-lg-6 -->
                   </div><!-- close row -->
              </div><!-- close upgrade-account -->
         </div><!-- close container -->
    </div><!-- close content -->
    
    
    
    
    
    
  </div><!--close wrapper-->

   <script src="<?php echo base_url();?>js/establishment/jQuery-2.1.3.min.js"></script>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="<?php echo base_url();?>js/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="<?php echo base_url();?>js/bootstrap.min.js"></script>
     <script type="text/javascript" src="<?php echo base_url();?>js/establishment/zebra_datepicker.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/establishment/core.js"></script>



<!-- jQuery 2.1.3 -->
   
    <!-- jQuery UI 1.11.2 -->
    
    <!-- AdminLTE App -->
    <script src="<?php echo base_url();?>js/establishment/app.min.js" type="text/javascript"></script>
  <!-- common script-->
    
    
    <script src="<?php echo base_url();?>js/establishment/cta.js"></script>
    <script>
    var closeFn;
    function closeShowingModal() {
      var showingModal = document.querySelector('.modal.show');
      if (!showingModal) return;
      showingModal.classList.remove('show');
      document.body.classList.remove('disable-mouse');
      if (closeFn) {
		 // alert('debug');
		  document.getElementById("signup_frm").reset();
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
     <script type="text/javascript" src="<?php echo base_url();?>js/establishment/customInput.jquery.js"></script>
    
  <script type="text/javascript">
  // Run the script on DOM ready:
  $(function(){
    $('input').customInput();
  });
      function resetCustomInput()
  {
    $('input').customInput();
  }
  </script>
  </body>
</html>