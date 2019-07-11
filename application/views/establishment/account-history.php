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
           <?php $this->load->view('establishment/left-menu');?>
        </section>
        <!-- /.sidebar -->
      </aside>
    
    
    <div id="content">
    	 <div class="container">
         	  <div class="account-history">
              	   <h2 class="title">Account history</h2>
                  
                   <div class="account-history-inner">
                   		<?php if(count($account_history)>0)
						{
							?>
                        <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table1">
                          <thead>
                          <tr>
                            <th>Date</th>
                            <th>Title</th>
                            <th>amount</th>
                            <th>document</th>
                          </tr>
                          </thead>
                          <tbody>
                          <?php foreach($account_history as $list)
						  {
							  ?>
                          <tr>
                            <td><?php echo $list['payment_date'];?></td>
                            <td><?php echo $list['product'];?> account</td>
                            <td><?php echo number_format($list['amount'],2);?> <?php echo $list['currency'];?></td>
                            <td><img src="<?php echo base_url();?>images/pdf-icon.png"></td>
                          </tr>
                          <?php } ?>
                         
                                                   </tbody>                        
                         </table>
                         <?php }
						 else echo "<p>No records found </p>"; ?>

                   </div><!-- close account-history-inner -->
              </div><!-- close account-history -->
         </div><!-- close container -->
    </div><!-- close content -->
    
    
    
    
    
    
  </div><!--close wrapper-->

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    
    <script src="http://netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>

<!-- jQuery 2.1.3 -->
    <script src="<?php echo base_url();?>js/establishment/jQuery-2.1.3.min.js"></script>
    <!-- jQuery UI 1.11.2 -->
    
    <!-- AdminLTE App -->
    <script src="<?php echo base_url();?>js/establishment/app.min.js" type="text/javascript"></script>
	<!-- common script-->
<?php //include('info_links.php')?>  </body>
</html>