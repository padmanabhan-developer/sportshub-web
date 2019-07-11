<!DOCTYPE html>
<html lang="en"><head>
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
 	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
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
    <script type="text/javascript" src="<?php echo base_url();?>js/establishment/ajax.js"></script>
    
    <script type="text/javascript" src="<?php echo base_url();?>js/establishment/customInput.jquery.js"></script>
    
  <script type="text/javascript">
  // Run the script on DOM ready:
  $(function(){
    $('input[name="provider"]').customInput();
	$('input[name="provider_channel"]').customInput();
  });
    /*function resetCustomInput()
  {
    $('input').customInput();
  }*/

  </script>

  <style type="text/css">

.tooltip.top .tooltip-arrow {
    bottom: -10px;
    left: 50%;
    margin-left: -5px;
    border-width: 20px 20px 0;
    border-top-color: #000;
}



.fa
{
	font-size: 15px;
}

.tooltip-inner {
    max-width: 400px;
    text-align: left;    box-shadow: 0px 0px 5px 0px #182847;
    background-color: #d5b421;    font-family: 'FjallaOneRegular';
}

.tooltip.left .tooltip-arrow {
    border-left-color: #d8ba36;
}

.tooltip.top .tooltip-arrow {
    border-top-color: #d8ba36;
}


.tooltip.top {
    padding: 5px 0;
    margin-top: 0px;
	margin-left: 94px;
}

.tooltip.left {
    padding: 0 5px;
      margin-left: -10px;
}

.tooltip.left .tooltip-arrow {
    top: 50%;
    right: -15px;
    margin-top: -15px;
    border-width: 15px 0 15px 25px;
}



.wizard {
    margin: 0px auto;
    background: #d5b522;
    color: white;
        font-family: 'FjallaOneRegular';
}

    .wizard .nav-tabs {
        position: relative;
        margin: 0px auto;
        margin-bottom: 0;
        border-bottom-color: #e0e0e0;
            padding-left: 30px;
    }

    .wizard > div.wizard-inner {
        position: relative;
    }

.connecting-line2 {
    height: 2px;
    background: #182847;
    position: absolute;
    width: 35%;
    margin: 0 auto;
    left: 22px;
    right: 0;
    top: 82%;
    z-index: 1;
}

.nav-tabs 
{
    border-bottom: 0px solid #ddd;
}

.wizard .nav-tabs > li.active > a, .wizard .nav-tabs > li.active > a:hover, .wizard .nav-tabs > li.active > a:focus {
    color: #555555;
    cursor: default;
    border: 0;
    border-bottom-color: transparent;
}

span.round-tab {
    width: 25px;
    height: 25px;
    line-height: 22px;
    display: inline-block;
    border-radius: 100px;
    background: #fff;
    border: 2px solid #e0e0e0;
    z-index: 2;
    position: absolute;
    left: 0;
    text-align: center;
    font-size: 15px;
}
span.round-tab i{
    color:#555555;
}
.wizard li.active span.round-tab {
    background: #fff;
    border: 1px solid #182847;
    
}
.wizard li.active span.round-tab i{
    color: #5bc0de;
}

span.round-tab:hover {
    color: #333;
    border: 2px solid #333;
}

.wizard .nav-tabs > li {
    width: 20%;
}

.wizard li:after {
    content: " ";
    position: absolute;
    transition: 0.1s ease-in-out;
}

.wizard li.active:after {
    content: " ";
    position: absolute;

    margin: 0 auto;

}

.wizard .nav-tabs > li a {
        width: 25px;
    height: 25px;
    margin: 10px auto;
    border-radius: 100%;
    padding: 0;
}

    .wizard .nav-tabs > li a:hover {
        background: transparent;
    }

.wizard .tab-pane {
    position: relative;
    padding-top: 15px;
}

.wizard h3 {
    margin-top: 0;
}
.tvprovider_box .tooltip-arrow {
    position: relative;
    border: none !important;
    left: 6px !important;
    bottom: 30px !important;
}

 .tool-addressdown .tooltip-arrow {
left: 188px !important;
top: 112px !important;
}
 .tool-addressdown  .tool-addressdown1 .tooltip-arrow {
left: 188px !important;
top: 71px !important;
}

.tool-addressdown .tooltip-arrow:after, .tool-addressdown .tooltip-arrow:before {
	top: 100% !important;
	left: 50% !important;
	border: solid transparent;
}
.tool-addressdown .tooltip-arrow:after {
	border-color: rgba(136, 183, 213, 0) !important;
	border-top-color:  #d5b421 !important;
	border-width: 19px !important;
	margin-top: 19px !important;
}
.tool-addressdown .tooltip-arrow:before {
	border-color: rgba(194, 225, 245, 0) !important;
	border-top-color: #000 !important;
	border-width: 19px !important;
	margin-top: 20px !important;
}
.tool-addressdown .tooltip.bottom {
    margin-top: 20px !important;
}


@media( max-width : 767px ) {
	.tvprovider_box .pagination_bottom ul li {
    list-style: none;
    padding: 0 0 0 0px !important;
    position: relative;
    line-height: 20px;
    color: #1f1f1f;
    font-size: 11px;
    text-transform: uppercase;
    font-family: 'LatoBol';
    margin: 0 0 0 0 !important;
    float: left;
    width: auto !important;
    box-sizing: border-box;
}
.tvprovider_box .pagination_bottom{
	padding: 0 9px !important;
	margin: 22px 0 22px 0 !important;
}
.tvprovider_box .pagination_bottom ul {
    margin: 0;
    padding: 0;
    float: left;
    width: 100% !important;
}
.side-search {
    width: 145px !important;

}
}
@media( max-width : 567px ) {
	.connecting-line2 {
    width: 56% !important;
    left: -15px !important;
    top: 70% !important;
}

    .wizard {
        width: 90%;
        height: auto !important;
    }
	.tvprovider .button_row {
    margin: 0px !important;
}
	.wizard .nav-tabs > li {
    width: 25%;
	margin-left: 20px !important;
}

    span.round-tab {
        font-size: 16px;
        width: 25px;
        height: 25px;
        line-height: 22px;
    }
	.tooltip.top {
    display: none !important;
}


    .wizard .nav-tabs > li a {
        width: 25px;
        height: 25px;
        line-height: 50px;
		border-color: #00000;
    }

    .wizard li.active:after {
        content: " ";
        position: absolute;
        left: 35%;
    }
	.tvprovider_box .pagination_bottom ul li {
    list-style: none;
    padding: 0 0 0 0px !important;
    position: relative;
    line-height: 20px;
    color: #1f1f1f;
    font-size: 11px;
    text-transform: uppercase;
    font-family: 'LatoBol';
    margin: 0 0 0 0 !important;
    float: left;
    width: auto !important;
    box-sizing: border-box;
}
.tvprovider_box .pagination_bottom{
	padding: 0 9px !important;
}
}

#ok
{
    color: white;
    background-color: #182847;
	border-color: #ffffff;
	font-size: 12px;
}

  </style>
  <?php include('google_analytics.php')?>
  </head>
  <body>
  <div class="preloader">
<div class="status"> </div>
</div>
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
    <script type="text/javascript">
    $(function () {
      $('#step_1_tooltips').tooltip({html: true, trigger: 'manual'}).tooltip('show');
      $('#step_2_tooltips').tooltip({html: true, trigger: 'manual'}).tooltip('hide');
      $('#step_3_tooltips').tooltip({html: true, trigger: 'manual'}).tooltip('hide');
      });

    $(function () {
      $('.hidetooltip').on('click', function () {
        $('#step_1_tooltips').tooltip('hide');
      });
    });
    </script>
    <div id="content">
       <div  class="col-md-10">

           <div class="wizard">
            <div class="wizard-inner">
                <div class="connecting-line2"></div>
                <ul class="nav nav-tabs" role="tablist" style="border: 1px solid #182847;">


                    <li role="presentation" class="active" style=" margin-left: 25%;">


                        <div class="tab-content">
                            <div class="tab-pane active" role="tabpanel" id="step1">
                                <h5 align="center" style="text-transform: uppercase;">Step 1</h5>
                                <p style="font-size: 13px; margin-top: 10px; text-transform: uppercase;" align="center">Choose TV Providers</p>
                            </div>
                        </div>

                        <a href="#step1" data-toggle="tab" aria-controls="step1" role="tab" title="Step 1">
                            
                             <span class="round-tab step1-wizard">
                                </span>
                        </a>
                    </li>

                    <li role="presentation" class="active">
                        
                        <div class="tab-content">
                            <div class="tab-pane active" role="tabpanel" id="step1">
                                <h5 align="center" style="text-transform: uppercase;">Step 2</h5>
                                <p style="font-size: 13px; margin-top: 10px; text-transform: uppercase;" align="center">Add Channels</p>
                            </div>
                        </div>

                        <a href="#step2" data-toggle="tab" aria-controls="step2" role="tab" title="Step 2">
                            <span class="round-tab step2-wizard">
                                </span>
                        </a>
                    </li>
                    <li role="presentation" class="active">
                        
                        <div class="tab-content">
                            <div class="tab-pane active" role="tabpanel" id="step1">
                                <h5 align="center" style="text-transform: uppercase;">Step 3</h5>
                                <p style="font-size: 13px; margin-top: 10px; text-transform: uppercase;" align="center">Go To TV Schedule</p>
                            </div>
                        </div>

                        <a href="#step3" data-toggle="tab" aria-controls="step3" role="tab" title="Step 3">
                            <span class="round-tab">
                                </span>
                        </a>
                    </li>		

                    
                </ul>
            </div>

 
        </div>


          <br>
          <br>

            <a id="step_3_tooltips" data-toggle="tooltip" data-placement="left" title="<span style='cursor: pointer;' class='hidetooltip2 pull-right'>x</span><b>STEP 3 </b> <br> <span style='text-transform: uppercase;'>Go to TV Channels and Select the Matches you will be showing in your venue.</span>" href="<?php echo base_url();?>establishment/schedule" class="add-new-event">Go to  tv schedule</a>
			<div class="tvprovider tool-addressdown">
              	  <h2 class="title2"><span id="step_1_tooltips" data-toggle="tooltip" data-placement="top" title="<span style='cursor: pointer;' class='hidetooltip pull-right'>x</span><b>STEP 1 </b> <br> <span style='text-transform: uppercase;'>Choose the TV Providers and the Channels, That are Available in your establishment.
              The Number of Channels chosen will to displayed next to the TV Provider, Please Note 
              that you only select TV Providers, One at a time.</span>">tv providers & channels</span></h2>
              	   <div class="tvprovider_box">
                   		<h2><span>1. Choose your TV Providers</span></h2>
                      <ul class="provider_ul">   
					  <?php
						$total_count = count($provider_list);
						$total_row = round(($total_count /3), 0);
						//if(($total_count%3) > 0){$total_row = $total_row +1;}
						$cnt =0;
						
						foreach($provider_list as $key => $val) { 
						
						if(($cnt > 1) && (($cnt % $total_row) == 0)) { ?> </ul><ul class="provider_ul"> <?php }
						
								if(count($provider_selected_list)>0) {
								foreach($provider_selected_list as $pskey => $psval) {
									if($val['id'] == $psval['id']) {
										$checked = 'checked';
										$count = $psval['channel_count'];
										break;
									 }
									 else {
										 $checked = '';
										 $count = 0;
									}
								}
								}
								else {$checked = '';$count = 0;}
						?>
                           <li><span class="checkbox-box2"><input type="checkbox"  <?php //echo $checked; ?> name="provider" id="<?php echo $val['id']; ?>" value="<?php echo $val['provider_name']; ?>" /><label for="<?php echo $val['id']; ?>" name="provider" ></label></span><?php echo $val['provider_name']; ?> ( <span id="channel_count_<?php echo $val['id']; ?>" ><?php echo $count; ?></span> )</li>
                              <?php $cnt++; } ?>  
					</ul>
                   </div><!-- close tvprovider_box -->

           <script type="text/javascript">
    

    $(function () {
      $(document).on('click', '.hidetooltip1', function () {
        $('#step_2_tooltips').tooltip('hide');
      });
    });

    $(function () {
      $(document).on('click', '.hidetooltip2', function () {
        $('#step_3_tooltips').tooltip('hide');
      });
    });
  </script>        
                   
                    <div class="tvprovider_box white tool-addressdown1 ">
                    <span id="step_2_tooltips" data-toggle="tooltip" data-placement="top" title="<span style='cursor: pointer;' class='hidetooltip1 pull-right'>x</span><b>STEP 2 </b> <br> <span style='text-transform: uppercase;'>Choose TV Channels that are available in your establishment please remember save.</span>"></span>
                   		<!--<h2>2. Choose your Channels <small>(All channels are automaticly choosen, please deselect the ones you don´t have)</small></h2>-->
                       
                        <div id="provider_channel"> 
                         <?php //$this->load->view('establishment/display-provider-channel');?>
                         <span class="tvprovider_title" id="tvprovider-error" style="display:block">Please select your tv provider to add channels or view  selected channels </span>
                        </div>
                        <!--<span class="tvprovider_title" id="tvprovider-error" style="display:none">Please select your tv provider to add or view  selected channels </span>-->
                        
						<div class="button_row"><a class="save_button" onClick="save_provider_channel()">SAVE</a></div>
                   </div><!-- close tvprovider_box -->
              </div><!-- close tvprovider -->
            <div class="add"><script type="text/javascript" src="http://sportshub365.com/spotway/adb.php?tag=8255706607fc613d355&width=728&height=90"></script></div>
         </div><!-- close container -->
         <div class="col-md-2 table-overflow">
              <div class="row">
                <div class="col-md-12 right-sidebar">&nbsp;</div>
              </div>
            </div>
            <div class="col-md-2 table-overflow">
      <div class="row">
        <div class="col-md-12 right-bar">&nbsp;</div>
        <div class="col-md-12 right-bar">&nbsp;</div>
        <div class="col-md-12 right-bar">&nbsp;</div>
        <div class="col-md-12 right-bar">&nbsp;</div>
        <div class="col-md-12 right-bar">&nbsp;</div>
        <div class="col-md-12 right-bar">&nbsp;</div>
      </div>
    </div>
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
	
	$('input[name="provider"]').change(function(){

		var providrId = $(this).attr('id'); 
		var provider = $(this).val(); 
		$('label[name="provider"]').each(function(){
			$('input[name="provider"]').attr('checked', false);
			$('label[name="provider"]').removeClass('checked')
		});
		
		var mode = '';
		
		$.ajax({
			url: '<?php echo base_url();?>establishment_tv_provider_channel/display_channel_provider',
			type: "POST",
			data: {providerid:providrId, provider:provider},
			beforeSend: function(data){
				 $('input').customInput();
				 $('.preloader').show();
				},
			success: function(data){
				//$('#provider_channel').html(data);
				$('#provider_channel').html(data);
				$('.step1-wizard').attr('id','ok');
				$('.step1-wizard').html('<i class="fa fa-check" id="ok"></i>');
				$('#step_1_tooltips').tooltip('hide');
				$('#step_2_tooltips').tooltip('show');
				var channel_count = $('#channel_count').val();

				$('#channel_count_'+providrId).html(channel_count);
				$('input[name="provider_channel"]').customInput();
				$('input[id="select_all"]').customInput();
				$('#tvprovider-error').hide();
				$('input[id='+providrId+']').attr('checked', true);
				$('label[for="'+providrId+'"]').addClass('checked'); 
				
				$('input[id="select_all"]').change(function(){ 
					
					var check = $(this).is(':checked');
					
					if($(this).prop('checked') == false) {
						
						$('input[name="provider_channel"]').attr('checked', false);
						$('label[name="provider_channel"]').removeClass('checked'); 
					}
					else {
						$('input[name="provider_channel"]').attr('checked', true);
						$('label[name="provider_channel"]').addClass('checked'); 
					}
					
					$.ajax({
						url: '<?php echo base_url();?>establishment_tv_provider_channel/save_provider_channel',
						type: "POST",
						data: {providerid:providrId, channelid:'', check:check, type:'all'},
						beforeSend: function(data){
							// $('input').customInput();
							$('.preloader').show();
							},
						success: function(data){
							if($(this).prop('checked') == false) { 
								var channel_count = $('#channel_count').val();
								$('#channel_count_'+providrId).html(data);
							}
							else {
								var channel_count = $('#channel_count').val();
								$('#channel_count_'+providrId).html(data);	
							}
							$('.preloader').hide();
						}
					}); 	
				});
				
				$('input[name="provider_channel"]').change(function(){
					var data = $(this).attr('id').split('_'); 
					var providrId = data[0];
					var channelid = data[1];
					var check = $(this).is(':checked');
					
					var channel_count = $('#channel_count_'+providrId).html();
					if(check == true) {
						var count = parseInt(channel_count) + 1
						$('#channel_count_'+providrId).html(count);
					}
					else {
						var count = parseInt(channel_count) - 1
						$('#channel_count_'+providrId).html(count);
					}
							
					$.ajax({
						url: '<?php echo base_url();?>establishment_tv_provider_channel/save_provider_channel',
						type: "POST",
						data: {providerid:providrId, channelid:channelid, check:check, type:'single'},
						beforeSend: function(data){
							// $('input').customInput();
							$('.preloader').show();
							},
						success: function(data){
							//$('#provider_channel').html(data);
							$('.preloader').hide();
						}
					}); 		
				});	
				$('.preloader').hide();
			}
		});  
	});
	
 function save_provider_channel() {
		
		var providerid = $('#provider_id').val();
		var channel_count = $('#channel_count_'+ providerid).html();
		
		if(channel_count == 0) {
			$('#tvprovider-success').show().html('Please select atleast one channel.');
			return false;
		}
		else {
			$.ajax({
				url: '<?php echo base_url();?>establishment_tv_provider_channel/save_channel',
				type: "POST",
				data: {providerid:providerid},
				beforeSend: function(data){
					 //$('input').customInput();
					 $('.preloader').show();
					},
				success: function(data){


        $('.step2-wizard').attr('id','ok');
        $('.step2-wizard').html('<i class="fa fa-check" id="ok"></i>');
				
        $('#step_1_tooltips').tooltip('hide');
        $('#step_2_tooltips').tooltip('hide');
        $('#step_3_tooltips').tooltip('show');

					$('#tvprovider-success').show().html('Selected channel(s) saved successfully.');
					$('.preloader').hide();
					//window.location = '<?php echo base_url().'establishment/tv_provider_channel'; ?>'
				}
			}); 
		}
	}
  function SearchProviderChannelResult(PATH,cp,ppr,search_text,provider_id){
	//var channel_id=$('#total_channel_ids').val();
	//resetCustomInput();
	$.ajax({
    url: '<?php echo base_url();?>establishment_tv_provider_channel/display_search_provider_channel',
    type: "POST",
    data: {cp:cp, ppr:ppr, search_text:search_text,providerid:provider_id},
    success: function(data){
			$('#provider_channel').html(data);
			$('input[name="provider_channel"]').customInput();
			$('input[id="select_all"]').customInput();
			
			$('input[id="select_all"]').change(function(){ 
					
					var check = $(this).is(':checked');
					
					if($(this).prop('checked') == false) {
						
						$('input[name="provider_channel"]').attr('checked', false);
						$('label[name="provider_channel"]').removeClass('checked'); 
					}
					else {
						$('input[name="provider_channel"]').attr('checked', true);
						$('label[name="provider_channel"]').addClass('checked'); 
					}
					
					$.ajax({
						url: '<?php echo base_url();?>establishment_tv_provider_channel/save_provider_channel',
						type: "POST",
						data: {providerid:provider_id, channelid:'', check:check, type:'all'},
						beforeSend: function(data){
							// $('input').customInput();
							$('.preloader').show();
							},
						success: function(data){
							if($(this).prop('checked') == false) { 
								var channel_count = $('#channel_count').val();
								$('#channel_count_'+provider_id).html(data);
							}
							else {
								var channel_count = $('#channel_count').val();
								$('#channel_count_'+provider_id).html(data);	
							}
						$('.preloader').hide();
						}
						
					}); 	
				});
				
			$('input[name="provider_channel"]').change(function(){
					var data = $(this).attr('id').split('_'); 
					var providrId = data[0];
					var channelid = data[1];
					var check = $(this).is(':checked');
					var channel_count = $('#channel_count_'+provider_id).html();
					if(check == true) {
						var count = parseInt(channel_count) + 1
						$('#channel_count_'+provider_id).html(count);
					}
					else {
						var count = parseInt(channel_count) - 1
						$('#channel_count_'+provider_id).html(count);
					}
					
					$.ajax({
						url: '<?php echo base_url();?>establishment_tv_provider_channel/save_provider_channel',
						type: "POST",
						data: {providerid:provider_id, channelid:channelid, check:check, type:'single'},
						beforeSend: function(data){
							// $('input').customInput();
							$('.preloader').show();
							},
						success: function(data){
							//$('#provider_channel').html(data);
							$('.preloader').hide();
						}
					}); 		
			});	
		}
	});  
 }
 
 function SearchOtherChannel(search_text, providerid){
	
	$.ajax({
    url: '<?php echo base_url();?>establishment_tv_provider_channel/display_search_other_provider_channel',
    type: "POST",
    data: {search_text:search_text,providerid:providerid},
    success: function(data){
			$('#other_channels').html(data);
			$('input[name="provider_channel"]').customInput();
			$('input[id="select_all"]').customInput();
			
			$('input[name="provider_channel"]').change(function(){
					var data = $(this).attr('id').split('_'); 
					var providrId = data[0];
					var channelid = data[1];
					var check = $(this).is(':checked');
					var channel_count = $('#channel_count_'+providerid).html();
					if(check == true) {
						var count = parseInt(channel_count) + 1
						$('#channel_count_'+providerid).html(count);
					}
					else {
						var count = parseInt(channel_count) - 1
						$('#channel_count_'+providerid).html(count);
					}
					
					$.ajax({
						url: '<?php echo base_url();?>establishment_tv_provider_channel/save_provider_channel',
						type: "POST",
						data: {providerid:providerid, channelid:channelid, check:check, type:'single'},
						beforeSend: function(data){
							// $('input').customInput();
							$('.preloader').show();
							},
						success: function(data){
							//$('#provider_channel').html(data);
							$('.preloader').hide();
						}
					}); 		
			});	
		}
	});  
}


  </script>
  
    <!-- AdminLTE App -->
    <script src="<?php echo base_url();?>js/establishment/app.min.js" type="text/javascript"></script>
  <!-- common script-->

  
  </body>
</html>