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
      <script type="text/javascript" src="<?php echo base_url();?>js/establishment/jquery.min.js"></script>
      <script type="text/javascript" src="<?php echo base_url();?>js/establishment/tv_schedule.js"></script>
<script src="<?php echo base_url();?>js/establishment/jQuery-2.1.3.min.js"></script>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="<?php echo base_url();?>js/establishment/bootstrap.min.js"></script>
    
    <script src="http://netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
    
    <script type="text/javascript" src="<?php echo base_url();?>js/establishment/zebra_datepicker.js"></script>
  <script type="text/javascript" src="<?php echo base_url();?>js/establishment/core.js"></script>
    
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
            <a href="<?php echo base_url();?>establishment/schedule" class="add-new-event">Go to  tv schedule</a>
            <div class="events">
                   <h2 class="title2">My TV schedule:</h2>
                    <?php  echo form_open("",$attribute_search['form']);
                        echo form_hidden('caller','Search'); ?>
                       <div class="event-form tv-event-form">
                   
                           
                      <span class="event-form-box">
                      <input id="datepicker-tvschedule-from" class="date-input" type="text" placeholder="Date From" tabindex="1" value="<?php echo $date_from;?>" name="date_from" readonly >
                           <?php //echo form_input($attribute_search['date_from']);?>
                        </span>
                        
                        <span class="event-form-box">
                        <input id="datepicker-tvschedule-to" class="date-input" type="text" placeholder="Date To" tabindex="1" value="<?php echo $date_end;?>" name="date_end" readonly >
                           <?php //echo form_input($attribute_search['date_end']);?>
                        </span>
                        
                        <span class="event-form-box">
                        <input id="search_text_tvschedule" class="date-input" type="text" value="<?php echo $search_text;?>"  placeholder="Search" name="search_text">
                             <?php //echo form_input($attribute_search['search_text']);?>
						<input class="search-button" id="search-button-tvschedule" type="button" >
                              <?php //echo form_submit($attribute_search['submit']);?>
                        </span>
                        <input type="hidden" id="path" value="<?php echo base_url();?>establishment/">
                       
                   </div><!-- close event-form -->
                   
                   <div class="event_row">
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
                                   onclick="ShowSportFixture('<?php echo base_url();?>establishment/')"
                                    value="<?php echo $sport['id'];?>" name="sport_<?=$s?>" style="">
                                   <label for="sport_<?=$s?>"><?=$sport['sport_name']?></label></span>

                                  </li>
                            <?php
                            }
                            ?>
                                
                            </ul>
                   </div><!-- close event_row -->
                   
                    <div class="events-inner" id="show_fixture">
                        <?php $this->load->view('establishment/display-my-tv-schedule');
                       
                        ?>    

 </div> <!-- close events-inner -->

              </div><!-- close events -->
              <?php if(count($fixture_list)>0) { ?>
               <div class="button_div">
                  <a href="<?php echo base_url();?>establishment/downloadpdf" target="_blank" class="butoon_print">Print</a>
                  <a class="butoon_email" id="email_send">Email</a>
             </div>
             <div class="tvprovider_title" id="error" style="display:none; text-align:right">Please Check your registered email!</div>
             
             <?php } ?> 
            <div class="add"><img src="<?php echo base_url();?>images/add.png"></div> 
         </div><!-- close container -->
         
    </div><!-- close content -->
  </div><!--close wrapper-->
    
    <!-- jQuery 2.1.3 -->
    
    <!-- jQuery UI 1.11.2 -->
  	<script type="text/javascript">
    $('#datepicker-tvschedule-from').Zebra_DatePicker({
		format: 'd/m/Y',
		onSelect: function(view, elements) {
			var pathval = $('#path').val();
			var from_date = $('#datepicker-tvschedule-from').val();
			var to_date = $('#datepicker-tvschedule-to').val();
			var search_text = $('#search_text_tvschedule').val();
			SearchResult(pathval, '1', '20', from_date, to_date, search_text,'');
		}
	});
	$('#datepicker-tvschedule-to').Zebra_DatePicker({format: 'd/m/Y',
			onSelect: function(view, elements) {
			var pathval = $('#path').val();
			var from_date = $('#datepicker-tvschedule-from').val();
			var to_date = $('#datepicker-tvschedule-to').val();
			var search_text = $('#search_text_tvschedule').val();
			SearchResult(pathval, '1', '20', from_date, to_date, search_text,'');
		}

	});
	$('.dp_clear').click(function() {
			var pathval = $('#path').val();
			var from_date = $('#datepicker-tvschedule-from').val();
			var to_date = $('#datepicker-tvschedule-to').val();
			var search_text = $('#search_text_tvschedule').val();
			SearchResult(pathval, '1', '20', from_date, to_date, search_text,'');
		
	});
	$( "#search_text_tvschedule" ).keyup(function(event) {
		if(event.which == 13){
			var pathval = $('#path').val();
			var from_date = $('#datepicker-tvschedule-from').val();
			var to_date = $('#datepicker-tvschedule-to').val();
			var search_text = $('#search_text_tvschedule').val();
			SearchResult(pathval, '1', '20', from_date, to_date, search_text,'');
		}
	});
	$('#search-button-tvschedule').click(function() {
			var pathval = $('#path').val();
			var from_date = $('#datepicker-tvschedule-from').val();
			var to_date = $('#datepicker-tvschedule-to').val();
			var search_text = $('#search_text_tvschedule').val();
			SearchResult(pathval, '1', '20', from_date, to_date, search_text,'');
		
	});
	
	$('#email_send').click(function() {
		
		$.ajax({
			url: '<?php echo base_url();?>establishment/emailpdf',
			type: "GET",
			data: {},
			success: function(data){
					if(data) {
						$('#error').show();
					}
				}
			});  
	});
  </script>
    <!-- AdminLTE App -->
    <script src="<?php echo base_url();?>js/establishment/app.min.js" type="text/javascript"></script>
  <!-- common script-->
  </body>
</html>