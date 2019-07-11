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
    <link href="<?php echo base_url();?>css/admin/AdminLTE.min.css" rel="stylesheet" type="text/css">
   
    
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
              <a href="#" class="add-new-event" >new establishments</a>
              
            <div class="events">
                   <h2 class="title2">establishments</h2>
                    <?php  echo form_open("",$attribute_search['form']);
                        echo form_hidden('caller','Search'); ?>
                   <div class="event-form">
                      <span class="event-form-box">
                              <?php echo form_input($attribute_search['city']);?>
                        </span>
                        
                        <span class="event-form-box">
                             <?php echo form_input($attribute_search['country']);?>
                        </span>
                        
                        <span class="event-form-box">
                              <?php echo form_input($attribute_search['search_text']);?>
                              <input name="" type="button" class="search-button">
                        </span>
                   </div><!-- close event-form -->
                   <?php echo form_close();?>
                   <div class="row3">
                      <span class="title3">Show only:</span>
                      <span class="box1 small-text"><span class="checkbox-box3"><input type="checkbox" name="genre" id="check-1" value="action" /><label for="check-1"></label></span>Free Account</span>
                        <span class="box1 small-text"><span class="checkbox-box3"><input type="checkbox" name="genre" id="check-2" value="action" /><label for="check-2"></label></span>Premium Account</span>
                   </div>
                   <div class="events-inner">
                    <?php if(count($establishment_list)>0)
                    {
                      ?>
                    
                      <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table2">
                          <thead>
                          <tr>
                            <th>NAME</th>
                            <th>ACCOUNT</th>
                            <th>ADDRESS</th>
                            <th>COUNTRY</th>
                            <th>actions</th>
                          </tr>
                          </thead>
                          <tbody>
                          <?php 
                        //  print_r($establishment_list);
                          foreach($establishment_list as $list)
                          {?>
                          <tr>
                            <td><?php echo $list['title'];?> </td>
                            <td><span <?php if(!empty($list['account'])){?>class="premium"<?php } else { ?> class="free1"<?php } ?>><?php if(!empty($list['account'])){?><?php echo $list['account'];} else echo "free";?></span></td>
                            <td><?php echo $list['address'];?></td>
                            <td><?php //echo $list['country'];?></td>
                            <td align="center" class="tdedit">
                              <a href="#"><img src="<?php echo base_url();?>images/icon20.png"></a>
                                <a href="#"><img src="<?php echo base_url();?>images/do-not-disturb.png"></a>
                                <a href="#"><img src="<?php echo base_url();?>images/edit.png"></a>
                                <a href="<?php echo base_url();?>admin/establishments/delete/<?php echo $list['id'];?>"><img src="<?php echo base_url();?>images/delete-icon.png"></a>
                            </td>
                          </tr>
                          <?php 
                          } 
                        ?>
                          
                         
                          
                          </tbody>                        
                         </table>
                         <?php }
                         else echo "No records found!"; ?>

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