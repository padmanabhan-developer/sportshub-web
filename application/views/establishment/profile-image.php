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
    <link href="<?php echo base_url();?>css/jquery-confirm.css" rel="stylesheet">
	<link href="<?php echo base_url();?>css/establishment/AdminLTE.min.css" rel="stylesheet" type="text/css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/establishment/jquery.timepicker.css" />
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
   <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
 <script src="<?php echo base_url();?>js/establishment/form_validation.js"></script>
     <script src="<?php echo base_url();?>js/establishment/jquery.timepicker.js"></script>
     <script src="http://jonthornton.github.io/Datepair.js/dist/datepair.js"></script>-->
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
        </section>
        <!-- /.sidebar -->
      </aside>
    
    
    <div id="content">
    	 <div class="container">
         	  <?php 
			  $default='';
			  if((is_array($profileGallery) > 0)){
			  foreach($profileGallery as $key => $profi){
				  if($profi['default_image']==1)$default=$profi['id'];
			  }}
			  ?>
         	  <div class="image_gallery">
              <form name="save-gallery" id="save-gallery" method="post" action="<?php echo base_url();?>establishment/profile_image">
              <input type="hidden" value="ProfileGallery" name="caller">
              <input type="hidden" name="totalimage" id="totalimage" value="<?php echo count($profileGallery); ?>">
              <input type="hidden" name="defaultimage" id="defaultimage" value="<?php echo $default;?>">
              	   <h2 class="title5">image gallery<a href="javascript:void(0);" class="add-new-event" id="save-profile-gallery">SAVE & return</a>
                   <div class="image_info" style="text-align:left; ">You can upload upto 5 images. We recommend 1600 x 775 px to get the best output. You can crop the image when you upload it.</div>
                   
                   <div class="error" style="text-align:center; display:none;">Please select a default profile image</div>
                   </h2>
                   </form>
              	   <div class="gallery_row">
                   		<div class="gallery_box">
                        	 <span class="upload_arrow" id="container_image1"><img src="<?php echo base_url();?>images/upload.png"></span>
                        </div> 
                       <div id="profile_img"> 
                   <?php 
				   	  if(is_array($profileGallery) > 0 ) {
						foreach($profileGallery as $key => $val ) {
						 ?>
                         <div class="gallery_box" id="gallery_box_<?php echo $val['id'];?>">
                        	 <a href="#" class="close2" data-imageid="<?php echo $val['id'];?>" ></a>
                        	 <span class="thumb"><img src="<?php echo base_url()."images/profile/".$val['picture'] ; ?>" width="167" height="94"></span>
                             <span class="span7"><span class="checkbox-box3"><input type="checkbox" name="checkbox" <?php if($profileGallery[$key]['default_image']==1){?> checked <?php } ?> id="<?php echo $val['id'];?>" value="action" /><label for="<?php echo $val['id'];?>" name="checkbox" ></label></span>Set as Main Image</span>
                        </div><!-- close gallery_box -->
                   <?php } 
				   	  }
				   ?>
                        </div>
                        </div><!-- close gallery_box -->
                   </div><!-- close gallery_row -->
              </div><!-- close image_gallery -->
         </div><!-- close container -->
    </div><!-- close content -->
 </div><!--close wrapper-->
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>-->
    <script type="text/javascript" src="<?php echo base_url();?>js/establishment/jquery-1.11.1.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="<?php echo base_url();?>js/establishment/bootstrap.min.js"></script>
    
    <script src="http://netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>js/establishment/customInput.jquery.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>js/establishment/jquery-ui.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>js/establishment/jquery.picture.cut.js"></script>
    
  <script type="text/javascript">
  // Run the script on DOM ready:
  $(function(){
   $('input').customInput();
   
		var totalimage = $('#totalimage').val()
		if(totalimage < 5) {
	           $("#container_image1").PictureCut({
                  InputOfImageDirectory       : "image",
                  PluginFolderOnServer        : "/image_upload/",
                  FolderOnServer              : "/images/profile/",
                  EnableCrop                  : true,
                  CropWindowStyle             : "Bootstrap"
              });
			}
  });
  
  $('input[name="checkbox"]').on('change', function() {	
	  
		var id = $(this).attr('id');
		
			$('input[name="checkbox"]').each(function(){
				$('input[name="checkbox"]').prop('checked', false);
				$('label[name="checkbox"]').removeClass('checked')
			});
			
			$('input[id="'+id+'"]').prop('checked', true);
			$('label[for="'+id+'"]').addClass('checked');
			$('#defaultimage').val(id);
  });
  $("span.upload_arrow").click(function() 
	{
		var totalimage = $('#totalimage').val()
		if(totalimage >= 5) { 
			$( "div.error" ).show().html('You cannot upload more than 5 images');
		}
	});
	
  /*$("span.thumb").click(function() 
	{
		var num = $(this).attr("data-num") 
		var totalimage = $('#totalimage').val()
		
		$.ajax
		({ 
			url: '<?php echo base_url();?>set_profile_value.php',
			data: {"curr_no": num},
			type: 'post',
			success: function(result) {}
		});
	});*/
	
	$("#save-profile-gallery").click(function(){
		 if($("#defaultimage").val() !=''){
			 $( "#save-gallery" ).submit();
		 }else{
			$( "div.error" ).show();
		 }
		})
	$("a.close2").click(function(){
		var imageid = $(this).attr("data-imageid");
		var imagerow = $(this).attr("data-rowid");
		var action ="delete";
		if(imageid > 0) {
			$.confirm({
			title: 'Please confirm!',
			content: 'Are you sure you want to remove this Gallery image?',
			confirm: function(){
				$.ajax
				({ 
					url: '<?php echo base_url();?>establishment_profile_image/remove_gallery_image',
					data: {"imageId": imageid, "caller" : action},
					type: 'post',
					success: function(result) {
						//alert(result);return false;
						if(result == 1){
								//$('#gallery_box_'+imageid).remove();
							window.location = 'http://sportshub365.com/establishment/profile_image';
							}
						}
				});
				},
			cancel: function(){
			}
		});
		}

	})
	
	$( document ).ready(function() {
		<?php 
		if((is_array($profileGallery) > 0)){
		foreach($profileGallery as $key => $profil){
			$profimag =  base_url()."images/profile/".$profil['picture'];
			?>
			//alert('<?php echo $profimag;?>')picture-element-image-directory
		//$('span#container_image'+'<?php echo $key?>'+' .picture-element-image').attr("src","<?php echo $profimag;?>");
		$('span#container_image'+'<?php echo $key?>'+' .picture-element-image-directory').val("<?php echo $profil['picture'];?>");
		<?php }
		}?>
		
	});
  </script>
  <script type="text/javascript" src="<?php echo base_url();?>js/jquery-confirm.min.js"></script>
    
   </body>
</html>