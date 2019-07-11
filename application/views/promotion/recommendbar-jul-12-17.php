<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Sportshub</title>
<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
<link rel="icon" type="<?php echo base_url();?>images/favicon" href="images/favicon.ico" />
<link href="<?php echo base_url();?>css/style.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url();?>css/responsive.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url();?>css/jquery-confirm.css" rel="stylesheet">

<!--navigation-->
<link rel="stylesheet" href="<?php echo base_url();?>css/responsive-nav.css" />
<script type="text/javascript" src="<?php echo base_url();?>js/jquery.js"></script>
<script src="<?php echo base_url();?>js/responsive-nav.js" type="text/javascript"></script>
<!--navigation-->
<?php include('google_analytics.php')?>
</head>

<body>
<div id="wrapper">
  <div id="header">
     	  <div class="container">
          	   <div class="logo"><a href="<?php echo base_url();?>"><img src="<?php echo base_url();?>images/logo.png" /></a></div>
               <div class="header_right">
               <span class="nav_title">SPORTSLOVERS:</span>
               <div class="menu">
                    <div class="nav-1 nav-collapse">
                      <ul id="main-menu" class="sm sm-blue">
                      	<li><a href="<?php echo base_url();?>promotion/findmatch"  >Find Bars</a></li>
                        <li><a href="<?php echo base_url();?>app" >Personal planner</a></li>
                        <!--<li><a href="<?php echo base_url();?>recommendbar" >Recommend a Bar</a></li>-->
                        <li><a href="<?php echo base_url();?>quiz" >Quiz</a></li>
                        <li class="devider"></li>
                        <li><a href="<?php echo base_url();?>app/signup">signup</a>
                        </li>
                        <li><a href="<?php echo base_url();?>app/login">login</a> </li>
                        <li><div class="bartab"><a href="<?php echo base_url();?>establishment/signup" >Are You a bar?</a></div> </li>
                        
                      </ul>
                      </div>
                    </div>
               </div><!--close header_right-->
          </div><!--close container-->
     </div>
     
  <!--close header-->
  
  <div id="banner3">
    <div class="layer">
      <div class="container">
        <div class="slider_text">
          <h1>Recommend a bar</h1>
          <!--<h4>PLAN YOUR SPORTS TV SCHEDULE ONLINE</h4>-->
          <p>Recommend a bar and participate in the monthly <br />
          quiz where you can win a Ipad Air. The more bars <br />
		   you recommend, the bigger chances to win! 
</p>
          <div class="box_center single-page-nav"> <a href="#signup" class="button">Recommend a bar</a> </div>
        </div>
      </div>
    </div>
    <!-- add section start-->
    <div class="add"><script type="text/javascript" src="http://sportshub365.com/spotway/adb.php?tag=76957065f8ab18a2395&width=728&height=90"></script></div>
    <!-- add section end-->
    <!--<div class="banner_bottom">
      <div class="container"> 
      		<span class="prev"><a href="<?php echo base_url();?>venue">VENUES</a></span>
             <span class="next"><a href="<?php echo base_url();?>sportsfans">Sports Fans</a></span> 
        </div>
    </div>-->
    <!--close banner_bottom--> 
  </div>
  <!--close banner-->
  
  <div id="content">
    <div class="section1">
      <div class="container">
        <div class="row">
          <!--<div class="feature_text">
            <h2>what is it?</h2>
            <h6>The Personal Planner is a online tool for sportsfans. Here you can make your own sports tv shedule and share it with your friends. We have the complete sports tv schedule so you can find out on what channel your match is showing. </h6>
            <ul class="feature_text_ul2">
              <li>Step 1: Signup or login with your sportshub365 account</li>
              <li>Step 2: Add your tv provider & channels</li>
              <li>Step 3: Pick the sportevents you want to watch and add to your schedule</li>
              <li>Step 4: Share with your friends and invite them over for matches</li>
              <li>Step 5:  Get reminders before a game so you don´t miss the speciel moments</li>
            </ul>
          </div>
-->          <div class="feature_image feature_image3 recommend_bar">
            <div id="signup" class="signup_box">
              <h2>Recommend A Bar</h2>
              <?php echo form_open('',$attribute['form']); ?>
              <span class="mailspn"> <span class="form_box">
              	<?php echo form_input($attribute['barname']);?>
                <div class="error" id="error_barname"></div>
              </span> </span> 
              <span class="mailspn"> <span class="form_box">
              	<?php echo form_input($attribute['baraddress']);?>
              </span>
              <div class="error"></div>
              </span>
              <span class="mailspn"> <span class="form_box">
				<?php echo form_input($attribute['baremail']);?>
                <div class="error" id="error_baremail"></div>
              </span>
              <div class="error"></div>
              </span>
              <span class="mailspn"> <span class="form_box">
	           <?php echo form_input($attribute['barphone']);?>
              </span>
              <div class="error"></div>
              </span>
              <span class="mailspn"> <span class="form_box">
              <?php echo form_input($attribute['useremail']);?>
              <div class="error" id="error_useremail"></div>
              </span>
              <div class="error"></div>
              </span>
              <span class="mailspn"> <span class="form_box">
              <?php echo form_input($attribute['userphone']);?>
              <div class="error" id="error_userphone"></div>
              </span>
              <div class="error"></div>
              </span>
              <?php echo form_input($attribute['submit']);?>
              <div class="error" id="error_sucess"></div>
              <?php echo form_close();?>
            </div>
            <p class="term">Click <a href="<?php echo base_url();?>terms" target="_blank">here</a> to read our Terms and Conditions</p>
          </div>
        </div>
      </div>
      <!--close container--> 
    </div>
    <!--close section1-->
    
    <!--<div class="section7 section8">
      <div class="container">
        <h2>try it now- <span class="yellow">works on both COMPUTERS & MOBILE DEVICES</span> </h2>
        <div class="box_center"> <a href="<?php echo base_url();?>app/signup" class="button">TRY PERSONAL PLANNER</a> 
          <!--<h6><a href="<?php //echo base_url();?>app/signup">sign up here for a free account</a></h6>--> 
        </div>
      </div>
      <!--close container--> 
      <!-- add section start-->
      <div class="add"><script type="text/javascript" src="http://sportshub365.com/spotway/adb.php?tag=64857065fb7752e9872&width=728&height=90"></script></div>
      <!-- add section end--> 
    </div>
    <!--close section7-->
    <div class="section5">
      <div class="container"> <span class="prev2"><a href="<?php echo base_url();?>venue">BARS</a></span> <span class="next2"><a href="<?php echo base_url();?>sportsfans">Sports Fans</a></span> </div>
    </div>
    <!--close section5--> 
  </div>
  <!--close content-->
  
  <div id="footer">
    <div class="container">
      <div class="logo_footer"><a href="<?php echo base_url();?>"><img src="images/logo.png" /></a></div>
      <p>contact us at <a href="#">info@sportshub365.com</a><span style="white-space:nowrap;">&nbsp;&nbsp;<img src="<?php echo base_url();?>images/phone.png" width="20px" height="20px" />&nbsp;+44 208 705 0525</span></p>
    </div>
    <!--close container--> 
  </div>
  <!--close footer--> 
  
</div>
<!--close wrapper--> 
<script type="text/javascript" src="<?php echo base_url();?>js/jquery-confirm.min.js"></script> 
<!--<script type="text/javascript">
	$('.apple_alert').on('click', function () {
		$.alert({
			title: 'Download App!',
			content: 'App will coming soon!',
			confirm: function () {
			}		});
	});
</script>--> 

<script type="text/javascript" src="<?php echo base_url();?>js/jquery.smartmenus.js"></script> 
<script type="text/javascript">
$(function() {
$('#main-menu').smartmenus({
subMenusSubOffsetX: 1,
subMenusSubOffsetY: -8
});
});
</script>
<link href="<?php echo base_url();?>css/sm-core-css.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url();?>css/sm-blue.css" rel="stylesheet" type="text/css" />
<!--menu--> 
<script src="<?php echo base_url();?>js/jquery.singlePageNav.min.js"></script>
<script>

	// Prevent console.log from generating errors in IE for the purposes of the demo
	if ( ! window.console ) console = { log: function(){} };

	// The actual plugin
	$('.single-page-nav').singlePageNav({
		offset: $('.single-page-nav').outerHeight(),
		filter: ':not(.external)',
		updateHash: true,
		beforeStart: function() {
			console.log('begin scrolling');
		},
		onComplete: function() {
			console.log('done scrolling');
		}
	});
</script>
<script type="text/javascript">
var navigation1 = responsiveNav(".nav-1");
/*$("#recommendbar_frm").submit(function(e){
    return false;
});
*/
$('#recommendbar_frm').on("submit", function(event){
	event.preventDefault();
	var barname = $('#barname').val();
	var baraddress = $('#baraddress').val();
	var baremail = $('#baremail').val();
	var barphone = $('#barphone').val();
	var useremail = $('#useremail').val();
	var userphone = $('#userphone').val();
	
	if(barname == '' || barname == 'Bar name'){
		$('.error').hide();
		$('#error_barname').html('Please enter the bar name').show();
		$('#barname').focus();
		return false;
	}
	
	if(baremail == '' || baremail == 'Bar e-mail'){
		$('.error').hide();
		$('#error_baremail').html('Please enter the bar email').show();
		$('#baremail').focus();
		return false;
	}
	
	if (!isValidEmailAddress(baremail)) { 
		$('.error').hide();
		$('#error_baremail').html('Please enter valid bar email').show();
		$('#baremail').focus();
		return false;
	}
	
	if(useremail == '' || useremail == 'Your e-mail'){
		$('.error').hide();
		$('#error_useremail').html('Please enter your email').show();
		$('#useremail').focus();
		return false;
	}
	if (!isValidEmailAddress(useremail)) { 
		$('.error').hide();
		$('#error_useremail').html('Please enter your valid email').show();
		$('#useremail').focus();
		return false;
	}
	if(baraddress == '' || baraddress == 'Bar address') {
		baraddress = ''
	}
	if(barphone == '' || barphone == 'Bar phone') {
		barphone = ''
	}
	if(userphone == '' || userphone == 'Your phone') {
		userphone = ''
	}
	/*if(userphone == '' || userphone == 'Your phone'){
		$('.error').hide();
		$('#error_userphone').html('Please enter your phone').show();
		$('#userphone').focus();
		return false;
	}*/
	var parameter = 'barname='+barname+'&baraddress='+baraddress+'&baremail='+baremail+'&barphone='+barphone+'&useremail='+useremail+'&userphone='+userphone;
	
	$.ajax({
        type: "POST",
        url: "<?php echo base_url();?>promotion/addrecommend",
		data: parameter,
        success: function(data) {
			if(data>0) {
				$('#recommendbar_frm')[0].reset();
				$('.error').hide();
				$('#error_sucess').html('Your message has been successfully sent!').show();
				/*setTimeout(function(){ 
        				location.reload(); }, 1000);*/
			}
        }
    });
	
});

function isValidEmailAddress(emailAddress) {
            var pattern = new RegExp(/^(("[\w-+\s]+")|([\w-+]+(?:\.[\w-+]+)*)|("[\w-+\s]+")([\w-+]+(?:\.[\w-+]+)*))(@((?:[\w-+]+\.)*\w[\w-+]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][\d]\.|1[\d]{2}\.|[\d]{1,2}\.))((25[0-5]|2[0-4][\d]|1[\d]{2}|[\d]{1,2})\.){2}(25[0-5]|2[0-4][\d]|1[\d]{2}|[\d]{1,2})\]?$)/i);
            return pattern.test(emailAddress);
};
</script>
</body>
</html>
