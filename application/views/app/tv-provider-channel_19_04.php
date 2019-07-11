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
  </head>
  <body>
  <div class="wrapper">
    <header id="header"> <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button"> <span class="sr-only">Toggle navigation</span> </a>
      <div class="container">
        <div class="logo"><a href="#"><img src="<?php echo base_url();?>images/logo.png"></a></div>
      </div>
      <!-- close container --> 
    </header>
    <!-- close header -->
    
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
        <?php $this->load->view('app/left-menu');?>
      </section>
      <!-- /.sidebar --> 
    </aside>
    <div id="content">
      <div class="container"> <a href="<?php echo base_url();?>app/schedule" class="add-new-event">Go to  tv schedule</a>
        <div class="tvprovider">
          <h2 class="title2">tv providers & channels</h2>
          <div class="tvprovider_box">
            <h2>1. Choose your TV Providers</h2>
            <ul class="provider_ul">
              <?php
						$total_count = count($provider_list);
						$total_row = round(($total_count /3), 0);
						//if(($total_count%3) > 0){$total_row = $total_row +1;}
						$cnt =0;
						
						foreach($provider_list as $key => $val) { 
						
						if(($cnt > 1) && (($cnt % $total_row) == 0)) { ?>
            </ul>
            <ul class="provider_ul">
              <?php }
						
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
              <li><span class="checkbox-box2">
                <input type="checkbox"  <?php //echo $checked; ?> name="provider" id="<?php echo $val['id']; ?>" value="<?php echo $val['provider_name']; ?>" />
                <label for="<?php echo $val['id']; ?>" name="provider" ></label>
                </span><?php echo $val['provider_name']; ?> ( <span id="channel_count_<?php echo $val['id']; ?>" ><?php echo $count; ?></span> )</li>
              <?php $cnt++; } ?>
            </ul>
          </div>
          <!-- close tvprovider_box -->
          
          <div class="tvprovider_box white"> 
            <!--<h2>2. Choose your Channels <small>(All channels are automaticly choosen, please deselect the ones you don´t have)</small></h2>-->
            
            <div id="provider_channel">
              <?php //$this->load->view('establishment/display-provider-channel');?>
              <span class="tvprovider_title" id="tvprovider-error" style="display:block">Please select your tv provider to add channels or view  selected channels </span> </div>
            <!--<span class="tvprovider_title" id="tvprovider-error" style="display:none">Please select your tv provider to add or view  selected channels </span>-->
            
            <div class="button_row"><a class="save_button" onClick="save_provider_channel()">SAVE</a></div>
          </div>
          <!-- close tvprovider_box --> 
        </div>
        <!-- close tvprovider -->
        <div class="add"><img src="<?php echo base_url();?>images/add.png"></div>
      </div>
      <!-- close container --> 
    </div>
    <!-- close content --> 
    
  </div>
  <!--close wrapper--> 

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
			url: '<?php echo base_url();?>app_tv_provider_channel/display_channel_provider',
			type: "POST",
			data: {providerid:providrId, provider:provider},
			beforeSend: function(data){
				 $('input').customInput();
				},
			success: function(data){
				//$('#provider_channel').html(data);
				$('#provider_channel').html(data);
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
						url: '<?php echo base_url();?>app_tv_provider_channel/save_provider_channel',
						type: "POST",
						data: {providerid:providrId, channelid:'', check:check, type:'all'},
						beforeSend: function(data){
							// $('input').customInput();
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
						url: '<?php echo base_url();?>app_tv_provider_channel/save_provider_channel',
						type: "POST",
						data: {providerid:providrId, channelid:channelid, check:check, type:'single'},
						beforeSend: function(data){
							// $('input').customInput();
							},
						success: function(data){
							//$('#provider_channel').html(data);
						}
					}); 		
				});	
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
			//alert(prochannid)
			$.ajax({
				url: '<?php echo base_url();?>app_tv_provider_channel/save_channel',
				type: "POST",
				data: {providerid:providerid},
				beforeSend: function(data){
					 //$('input').customInput();
					},
				success: function(data){
					$('#tvprovider-success').show().html('Selected channel(s) saved successfully.');
					//window.location = '<?php echo base_url().'app/tv_provider_channel'; ?>'
					
				}
			}); 
		}
	}
  function SearchProviderChannelResult(PATH,cp,ppr,search_text,provider_id){
	//var channel_id=$('#total_channel_ids').val();
	//resetCustomInput();
	$.ajax({
    url: '<?php echo base_url();?>app_tv_provider_channel/display_search_provider_channel',
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
						url: '<?php echo base_url();?>app_tv_provider_channel/save_provider_channel',
						type: "POST",
						data: {providerid:provider_id, channelid:'', check:check, type:'all'},
						beforeSend: function(data){
							// $('input').customInput();
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
						url: '<?php echo base_url();?>app_tv_provider_channel/save_provider_channel',
						type: "POST",
						data: {providerid:provider_id, channelid:channelid, check:check, type:'single'},
						beforeSend: function(data){
							// $('input').customInput();
							},
						success: function(data){
							//$('#provider_channel').html(data);
						}
					}); 		
			});	
		}
	});  
 }
 
 function SearchOtherChannel(search_text, providerid){
	
	$.ajax({
    url: '<?php echo base_url();?>app_tv_provider_channel/display_search_other_provider_channel',
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
						url: '<?php echo base_url();?>app_tv_provider_channel/save_provider_channel',
						type: "POST",
						data: {providerid:providerid, channelid:channelid, check:check, type:'single'},
						beforeSend: function(data){
							// $('input').customInput();
							},
						success: function(data){
							//$('#provider_channel').html(data);
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