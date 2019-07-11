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
    <link href="<?php echo base_url();?>css/jquery-confirm.css" rel="stylesheet">
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
  <div class="wrapper barwrapper">
	<?php $this->load->view('establishment/header');?>    
    <?php $this->load->view('establishment/left-menu');?>    
    <div id="content" class="barcontent">
       <div class="container">
<?php if($maxcount <3){?>
            <a href="javascript:void(0)" class="add-new-event" data-cta-target=".js-dialog"  title="Click here to Add" onclick="javascript:OpenAddOfferForm('<?php echo base_url();?>establishment/','0');"><!--<a href="javascript:void(0)" title="Click here to edit" data-cta-target=".js-dialog" onclick="javascript:OpenAddOfferForm('<?php echo base_url();?>establishment/','0');">-->add offer</a>
              <div class="js-dialog  modal  dialog" style="text-align: center;">
      <span class="modal-close-btn"></span>
     <div id="open_offer">
     <?php $this->load->view('establishment/add-offer');?>
   </div>
    </div> <?php }?>
            <div class="offers">
              <?php 
			  $count= 1;
			  foreach($all_offers as $offer)
              {
                ?>
                   <div class="offer <?php if($offer['isactive']=='0')   echo 'inactive';?>">
                      <h2 class="title">offer <?php echo $count;?>  <span class="<?php if($offer['isactive']=='1') echo 'active'; else echo 'inactive';?>-span"><?php if($offer['isactive']=='1') echo 'active'; else echo 'inactive';?>

                        
</span>
                      </h2>
                        <div class="offer-inner">
                           <div class="offer-row">
                                <div class="offer_left">
                                       <label>Title:</label>
                                       <input name="" type="text" class="offer-input1" value="<?php echo $offer['title'];?>" onfocus="if (this.value == '<?php echo $offer['title'];?>') {this.value = '';}" onblur="if (this.value == '') {this.value = '<?php echo $offer['title'];?>';}" disabled>
                                  </div>
                                  
                                  <div class="offer_right">
                                       <label>price / discount:</label>
                                       <input name="" type="text" class="offer-input2" value="<?php echo $offer['price_or_discount'];?>" onfocus="if (this.value == '<?php echo $offer['price_or_discount'];?>') {this.value = '';}" onblur="if (this.value == '') {this.value = '<?php echo $offer['price_or_discount'];?>';}" disabled>

                                  </div>
								<div class="offer_right">
                                       <label>promo code:</label>
                                       <input name="" type="text" class="offer-input2" value="<?php echo $offer['promo_code'];?>" onfocus="if (this.value == '<?php echo $offer['promo_code'];?>') {this.value = '';}" onblur="if (this.value == '') {this.value = '<?php echo $offer['promo_code'];?>';}" disabled>

                                  </div>


                             </div><!-- close offer-row -->
                             
                             <div class="offer-row">
                                <div class="offer_left">
                                       <label>description:</label>
                                       <input name="" type="text" class="offer-input3" value="<?php echo $offer['description'];?>" onfocus="if (this.value == '<?php echo $offer['description'];?>') {this.value = '';}" onblur="if (this.value == '') {this.value = '<?php echo $offer['description'];?>';}" disabled>
                                  </div>
                             </div>

<span style="float:right;">
                             <a href="javascript:void(0);" data-offerid="<?php echo $offer['id'];?>" style="padding-left:20px;" id="del-offer" class="del-cnfrm"> 
<img src="<?php echo base_url();?>images/delete-icon.png"></a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a href="javascript:void(0)" title="Click here to edit" data-cta-target=".js-dialog" onclick="javascript:OpenAddOfferForm('<?php echo base_url();?>establishment/','<?php echo $offer['id'];?>');">Edit</a>

</span>

<!-- close offer-row -->
                        </div><!-- close offer-inner -->
                   </div><!-- close offer -->
                   
                   <?php $count++;} ?>
                  
              </div><!-- close offers -->
              <div class="add"><script type="text/javascript" src="http://sportshub365.com/spotway/adb.php?tag=8255706607fc613d355&width=728&height=90"></script></div>
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
  <script type="text/javascript" src="<?php echo base_url();?>js/jquery-confirm.min.js"></script>
<script type="text/javascript">
$('.del-cnfrm').on('click', function () {
	var offerid = $(this).attr('data-offerid');
	$.confirm({
		title: 'Please confirm!',
		content: 'Are you sure you want to delete this offer?',
		confirm: function(){
			window.location = "<?php echo base_url();?>establishment_offers/delete/"+offerid;
		},
		cancel: function(){
		}
	});
});
</script>
<?php $this->load->view('establishment/cookie_include');?>
 <?php //include('info_links.php')?> </body>
</html>