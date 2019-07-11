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
    <link href="<?php echo base_url();?>css/admin/style.css" rel="stylesheet">
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
           <div class="logo"><a href="#"><img src="images/logo.png"></a></div>
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
                   <h2 class="title2">RATING / COMMENTS</h2>
                   <div class="event-form">
                      <span class="event-form-box">
                            <input id="datepicker-example3" class="date-input" type="text" value="Date from" onfocus="if (this.value == 'Date from') {this.value = '';}" onblur="if (this.value == '') {this.value = 'Date from';}">
                        </span>
                        
                        <span class="event-form-box">
                            <input id="datepicker-example4" class="date-input" type="text" value="Date end" onfocus="if (this.value == 'Date end') {this.value = '';}" onblur="if (this.value == '') {this.value = 'Date end';}">
                        </span>
                        
                        <span class="event-form-box">
                            <input name="" type="text" class="search-input" value="Search" onfocus="if (this.value == 'Search') {this.value = '';}" onblur="if (this.value == '') {this.value = 'Search';}"><input name="" type="button" class="search-button">
                        </span>
                   </div><!-- close event-form -->
                   <div class="row3">
                      <span class="title3">Show only:</span>
                      <span class="box1"><span class="checkbox-box3"><input type="checkbox" name="genre" id="check-1" value="action" /><label for="check-1"></label></span>ACTIVE</span>
                        <span class="box1"><span class="checkbox-box3"><input type="checkbox" name="genre" id="check-2" value="action" /><label for="check-2"></label></span>BLOCKED</span>
                   </div>
                   <div class="events-inner">
                      <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table2">
                          <thead>
                          <tr>
                            <th>DATE</th>
                            <th class="rating">RATING</th>
                            <th>ESTABLISTMENT</th>
                            <th>comment</th>
                            <th>actions</th>
                          </tr>
                          </thead>
                          <tbody>
                          <tr>
                            <td>10.10.2015</td>
                            <td class="rating">
                              <a href="#"><img src="images/star-active.png"></a>
                                <a href="#"><img src="images/star-active.png"></a>
                                <a href="#"><img src="images/star-active.png"></a>
                                <a href="#"><img src="images/star-active.png"></a>
                                <a href="#"><img src="images/star.png"></a>
                            </td>
                            <td>Bargrill inc.</td>
                            <td>we really love the experience that we...</td>
                            <td>
                                <a href="#"><img src="images/do-not-disturb.png"></a>
                                <a href="#"><img src="images/edit.png"></a>
                                <a href="#"><img src="images/delete-icon.png"></a>
                            </td>
                          </tr>
                          
                          <tr>
                            <td>10.10.2015</td>
                            <td class="rating">
                              <a href="#"><img src="images/star-active.png"></a>
                                <a href="#"><img src="images/star-active.png"></a>
                                <a href="#"><img src="images/star-active.png"></a>
                                <a href="#"><img src="images/star-active.png"></a>
                                <a href="#"><img src="images/star.png"></a>
                            </td>
                            <td>Bargrill inc.</td>
                            <td>we really love the experience that we...</td>
                            <td>
                                <a href="#"><img src="images/do-not-disturb.png"></a>
                                <a href="#"><img src="images/edit.png"></a>
                                <a href="#"><img src="images/delete-icon.png"></a>
                            </td>
                          </tr>
                          
                          <tr>
                            <td>10.10.2015</td>
                            <td class="rating">
                              <a href="#"><img src="images/star-active.png"></a>
                                <a href="#"><img src="images/star-active.png"></a>
                                <a href="#"><img src="images/star-active.png"></a>
                                <a href="#"><img src="images/star-active.png"></a>
                                <a href="#"><img src="images/star.png"></a>
                            </td>
                            <td>Bargrill inc.</td>
                            <td>we really love the experience that we...</td>
                            <td>
                                <a href="#"><img src="images/do-not-disturb.png"></a>
                                <a href="#"><img src="images/edit.png"></a>
                                <a href="#"><img src="images/delete-icon.png"></a>
                            </td>
                          </tr>
                          
                          <tr>
                            <td>10.10.2015</td>
                            <td class="rating">
                              <a href="#"><img src="images/star-active.png"></a>
                                <a href="#"><img src="images/star-active.png"></a>
                                <a href="#"><img src="images/star-active.png"></a>
                                <a href="#"><img src="images/star-active.png"></a>
                                <a href="#"><img src="images/star.png"></a>
                            </td>
                            <td>Bargrill inc.</td>
                            <td>we really love the experience that we...</td>
                            <td>
                                <a href="#"><img src="images/do-not-disturb.png"></a>
                                <a href="#"><img src="images/edit.png"></a>
                                <a href="#"><img src="images/delete-icon.png"></a>
                            </td>
                          </tr>
                          
                          <tr>
                            <td>10.10.2015</td>
                            <td class="rating">
                              <a href="#"><img src="images/star-active.png"></a>
                                <a href="#"><img src="images/star-active.png"></a>
                                <a href="#"><img src="images/star-active.png"></a>
                                <a href="#"><img src="images/star-active.png"></a>
                                <a href="#"><img src="images/star.png"></a>
                            </td>
                            <td>Bargrill inc.</td>
                            <td>we really love the experience that we...</td>
                            <td>
                                <a href="#"><img src="images/do-not-disturb.png"></a>
                                <a href="#"><img src="images/edit.png"></a>
                                <a href="#"><img src="images/delete-icon.png"></a>
                            </td>
                          </tr>
                          
                          <tr>
                            <td>10.10.2015</td>
                            <td class="rating">
                              <a href="#"><img src="images/star-active.png"></a>
                                <a href="#"><img src="images/star-active.png"></a>
                                <a href="#"><img src="images/star-active.png"></a>
                                <a href="#"><img src="images/star-active.png"></a>
                                <a href="#"><img src="images/star.png"></a>
                            </td>
                            <td>Bargrill inc.</td>
                            <td>we really love the experience that we...</td>
                            <td>
                                <a href="#"><img src="images/do-not-disturb.png"></a>
                                <a href="#"><img src="images/edit.png"></a>
                                <a href="#"><img src="images/delete-icon.png"></a>
                            </td>
                          </tr>
                          
                          <tr>
                            <td>10.10.2015</td>
                            <td class="rating">
                              <a href="#"><img src="images/star-active.png"></a>
                                <a href="#"><img src="images/star-active.png"></a>
                                <a href="#"><img src="images/star-active.png"></a>
                                <a href="#"><img src="images/star-active.png"></a>
                                <a href="#"><img src="images/star.png"></a>
                            </td>
                            <td>Bargrill inc.</td>
                            <td>we really love the experience that we...</td>
                            <td>
                                <a href="#"><img src="images/do-not-disturb.png"></a>
                                <a href="#"><img src="images/edit.png"></a>
                                <a href="#"><img src="images/delete-icon.png"></a>
                            </td>
                          </tr>
                          
                          <tr>
                            <td>10.10.2015</td>
                            <td class="rating">
                              <a href="#"><img src="images/star-active.png"></a>
                                <a href="#"><img src="images/star-active.png"></a>
                                <a href="#"><img src="images/star-active.png"></a>
                                <a href="#"><img src="images/star-active.png"></a>
                                <a href="#"><img src="images/star.png"></a>
                            </td>
                            <td>Bargrill inc.</td>
                            <td>we really love the experience that we...</td>
                            <td>
                                <a href="#"><img src="images/do-not-disturb.png"></a>
                                <a href="#"><img src="images/edit.png"></a>
                                <a href="#"><img src="images/delete-icon.png"></a>
                            </td>
                          </tr>
                          
                          </tbody>                        
                         </table>

                   </div><!-- close account-history-inner -->
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
    
    <script type="text/javascript" src="<?php echo base_url();?>js/admin/zebra_datepicker.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/admin/core.js"></script>

  <script type="text/javascript" src="<?php echo base_url();?>js/admin/customInput.jquery.js"></script>
    
  <script type="text/javascript">
  // Run the script on DOM ready:
  $(function(){
    $('input').customInput();
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