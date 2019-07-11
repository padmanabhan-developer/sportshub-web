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
   
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
     <script type="text/javascript" src="<?php echo base_url();?>js/admin/jquery.min.js"></script>
     <script type="text/javascript" src="<?php echo base_url();?>js/admin/ajax.js"></script>
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
            <a href="#" class="add-new-event">new match</a>
            <div class="events">
                   <h2 class="title2">matches</h2>
                 
                     
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

                              <?php echo form_submit($attribute_search['submit']);?>
                        </span>
                        <input type="hidden" id="path" value="<?php echo base_url();?>admin/">
                       
                   </div><!-- close event-form -->
<div class="event_row2">
                            <ul>
                            <input id="total_sports" type="hidden" value="<?php echo count($sport_list);?>" name="total_sports">    
                            <?php
                            $j=5;
                            $s=0;
                             $checked_sport_arr=explode("~",$sport_id);
                           // print_r($checked_sport_arr);
                            foreach($sport_list as $sport)
                            {
                              $j++;
                              $s++;
                              ?> 
                                <li>
                                   <span class="checkbox-box2">
                                  <input id="sport_<?=$s?>" class="checkBox"  <?php if(in_array($sport['id'], $checked_sport_arr)) echo "checked='checked'";?> type="checkbox" 
                                   onclick="ShowSportFixture('<?php echo base_url();?>admin/')"
                                    value="<?php echo $sport['id'];?>" name="sport_<?=$s?>" style="">
                                   <label for="sport_<?=$s?>"><?=$sport['sport_name']?></label></span>

                                  </li>
                            <?php
                            }
                            ?>
                                
                            </ul>
                       </div><!-- close event_row -->
 <?php echo form_close();?>
                    <div class="events-inner" id="show_fixture">
                 <?php $this->load->view('admin/display-fixture');?>                       
               </div>
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
  </body>
</html>