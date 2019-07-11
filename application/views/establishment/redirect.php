<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width; initial-scale=1.0" />
<title>totalbliss</title>
 <link href="<?php echo base_url();?>css/establishment/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>css/establishment/bootstrap-theme.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>css/establishment/style.css" rel="stylesheet">
<link href="<?php echo base_url();?>css/establishment/AdminLTE.min.css" rel="stylesheet" type="text/css">

<?php include('google_analytics.php')?>

<!-- script for menu -->
<script language="javascript">
 setTimeout('RedirectToPayment()',0)
 function RedirectToPayment()
 {
  window.open('payment','_parent'); 
  Shadowbox.close();
  /* using javascript *
   window.opener.location.href="payment.php"; 
   self.close();
   */
 }
</script>

</head>
<body>
    
    

 <div id="content">
       <div class="container">
            <div class="profile-setting">
                   
          	 <div class="darkblue-box">
                     <h2>Please wait till the transaction is completed.</h2><br/>
                        <span style="float:left;color: #fff; float: left;font-size: 16px;">You will now be redirected to our payment processor from stripe.<br />
Once your payment is processed, please do not close the window will you have been redirected back to our website.</span>
                                               
              </div><!-- close darkblue-box -->
          </div>
      </div>
  </div>

     
   
        
      
    
 
    
   <?php //include('info_links.php')?> 
</body>
</html>
