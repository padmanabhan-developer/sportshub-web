
//validate expiry year
function validateMonth(month)
{
	
	current_month = new Date().getUTCMonth() + 1;
	if(month < current_month || month > 12)
	{
		return false;
	}
}
function validateYear(year)
{
	 current_year= new Date().getFullYear();
	
	if(year < current_year || year.length !=4)
	{
		return false;
	}
}
function validateMonthYear(year,month)
{
	current_year= new Date().getFullYear();
	current_month = new Date().getUTCMonth() + 1;
	if(year != current_year || monthcurrent_month)
	{
		return false;
	}
}
//validate date function 
function validateDate(date_value){
    var dat = date_value;
    var pattern1 =/^([0-9]{2})-([0-9]{2})-([0-9]{4})$/; // dd-dd-yyyy
	var pattern2 =/^([0-9]{2})\/([0-9]{2})\/([0-9]{4})$/; // dd/dd/yyyy
    if (dat == null || dat == "" || (!pattern1.test(dat) && !pattern2.test(dat)))
    {
       
        return false;
    }
    else{
        return true;
    }
}

function validateTime(time_value)
{
    var time = time_value;
  //alert(time_value);
	//var pattern1 =/^([0-9]{2})\:[0-9]\d( (am|pm))?$/i // hh:mmam
	var pattern1 = /^[0-1]?\d:[0-5]\d( (am|pm))$/i;
    if (time == null || time == "" || (!pattern1.test(time)))
    {
       
        return false;
    }
    else{
        return true;
    }
}

function validateRailwayTime(time_value)
{
    var time = time_value;
  //alert(time_value);
	var pattern1 =/^([0-1]?[0-9]|2[0-4]):([0-5][0-9])(:[0-5][0-9])?$/ // hh:mmam
	//var pattern1 = /^[0-1]?\d:[0-5]\d($/i;
    if (time == null || time == "" || (!pattern1.test(time)))
    {
       
        return false;
    }
    else{
        return true;
    }
}

function ValidateEstablishmentForm(){
	
    var title = document.getElementById('title').value;
    var email = document.getElementById('email').value;
    var password = document.getElementById('password').value;

	if(title=='' || title == "Title:") {
		document.getElementById('errorDiv1').style.display='inline';

        document.getElementById('errorDiv1').innerHTML="Please enter title.";
					
		document.getElementById('title').focus();

		var target_offset = $("#errorDiv1").offset();
		var target_top = target_offset.top;

		//$('html, body').animate({scrollTop:target_top}, 500);
						
		return false;
	};

	if(email=='' || email == "Email:") {
		document.getElementById('errorDiv1').style.display='inline';

        document.getElementById('errorDiv1').innerHTML="Please enter email.";
					
		document.getElementById('email').focus();

		var target_offset = $("#errorDiv1").offset();
		
		//$('html, body').animate({scrollTop:target_top}, 500);
						
		return false;
	};
	
 var emailvalid = ValidateEmail(email) 
 
 if(emailvalid == false) {
		document.getElementById('errorDiv1').style.display='inline';

        document.getElementById('errorDiv1').innerHTML="Please enter valid email.";
					
		document.getElementById('email').focus();

		var target_offset = $("#errorDiv1").offset();
		
		//$('html, body').animate({scrollTop:target_top}, 500);
						
		return false;
 };
	
 if(password=='' || password == "Password:") {
		document.getElementById('errorDiv1').style.display='inline';

        document.getElementById('errorDiv1').innerHTML="Please enter password.";
					
		document.getElementById('password').focus();

		var target_offset = $("#errorDiv1").offset();
		var target_top = target_offset.top;

		//$('html, body').animate({scrollTop:target_top}, 500);
						
		return false;
	};
	 
  var emailcheck = Emailexist(email)
  // var email_check = document.getElementById('erroremail').value;
  //alert (emailcheck)
  //alert(emailcheck)	
 
  if(emailcheck == 1) {
		document.getElementById('errorDiv1').style.display='inline';

        document.getElementById('errorDiv1').innerHTML="Email already exists.";
					
		document.getElementById('email').focus();

		var target_offset = $("#errorDiv1").offset();
		
		//$('html, body').animate({scrollTop:target_top}, 500);
						
		return false;
 };	
	
  return true;
}

function ValidateAdminUserForm(){
	
    var email = document.getElementById('email').value;
    var password = document.getElementById('password').value;

	if(email=='' || email == "Email:") {
		document.getElementById('errorDiv1').style.display='inline';

        document.getElementById('errorDiv1').innerHTML="Please enter email.";
					
		document.getElementById('email').focus();

		var target_offset = $("#errorDiv1").offset();
		
		//$('html, body').animate({scrollTop:target_top}, 500);
						
		return false;
	};
	
 var emailvalid = ValidateEmail(email) 
 
 if(emailvalid == false) {
		document.getElementById('errorDiv1').style.display='inline';

        document.getElementById('errorDiv1').innerHTML="Please enter valid email.";
					
		document.getElementById('email').focus();

		var target_offset = $("#errorDiv1").offset();
		
		//$('html, body').animate({scrollTop:target_top}, 500);
						
		return false;
 };
	
 if(password=='' || password == "Password:") {
		document.getElementById('errorDiv1').style.display='inline';

        document.getElementById('errorDiv1').innerHTML="Please enter password.";
					
		document.getElementById('password').focus();

		var target_offset = $("#errorDiv1").offset();
		var target_top = target_offset.top;

		//$('html, body').animate({scrollTop:target_top}, 500);
						
		return false;
	};
	 
  var emailcheck_admin = EmailexistAdmin(email)
  // var email_check = document.getElementById('erroremail').value;
  //alert (emailcheck)
  //alert(emailcheck)	
 
  if(emailcheck_admin == 1) {
		document.getElementById('errorDiv1').style.display='inline';

        document.getElementById('errorDiv1').innerHTML="Email already exists.";
					
		document.getElementById('email').focus();

		var target_offset = $("#errorDiv1").offset();
		
		//$('html, body').animate({scrollTop:target_top}, 500);
						
		return false;
 };	
	
  return true;
}

function ValidateEmail(mail)   
{  
 if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(mail))  
  {  
	return (true)  
  }  
	return (false)  
}  

function Emailexist(email)
{
  var PATH = 'http://sportshub365.com/admin/'
  var email_status = null;
  $.ajax({
    url: PATH+"check_email",
    type: "POST",
    data: {email:email},
	dataType: 'html',
	async: false,
    success: function(data){
 		email_status =  data;  
    }
  });
  
  return email_status
}

function EmailexistAdmin(email)
{
  //var PATH = 'http://sportshub365.com/admin/'
  var PATH = 'http://sportshub365.com/admin/'
  var email_status = null;
  $.ajax({
    url: PATH+"check_email_admin",
    type: "POST",
    data: {email:email},
	dataType: 'html',
	async: false,
    success: function(data){
 		email_status =  data;  
    }
  });
  
  return email_status
}

function ValidateOfferForm(){
	
    var title = document.getElementById('title_offer').value;
    var description = document.getElementById('description').value;
    var price_or_discount = document.getElementById('price_or_discount').value;
	if(title=='' || title == "Title:") {
		document.getElementById('errorDiv_offer').style.display='inline';

        document.getElementById('errorDiv_offer').innerHTML="Please enter title.";
					
		document.getElementById('title').focus();

		var target_offset = $("#errorDiv_offer").offset();
		var target_top = target_offset.top;

		//$('html, body').animate({scrollTop:target_top}, 500);
						
		return false;
	};

		/*if(description=='' || description == "Description:") {
		document.getElementById('errorDiv1').style.display='inline';

        document.getElementById('errorDiv1').innerHTML="Please enter description.";
					
		document.getElementById('description').focus();

		var target_offset = $("#errorDiv1").offset();
		

		//$('html, body').animate({scrollTop:target_top}, 500);
						
		return false;
	};*/

if(price_or_discount=='' || price_or_discount == "Price or discount:") {
		document.getElementById('errorDiv_offer').style.display='inline';

        document.getElementById('errorDiv_offer').innerHTML="Please enter Price or discount.";
					
		document.getElementById('price_or_discount').focus();

		var target_offset = $("#errorDiv_offer").offset();
		var target_top = target_offset.top;

		//$('html, body').animate({scrollTop:target_top}, 500);
						
		return false;
	};

  return true;
}	
// end offer form validation here


function ValidateUpgradeCardForm(){
	
    var first_name = document.getElementById('upgrade_first_name').value;
    var card_number = document.getElementById('upgrade_card_number').value;
    var exp_month = document.getElementById('upgrade_exp_month').value;
    var exp_year = document.getElementById('upgrade_exp_year').value;
    var code = document.getElementById('upgrade_code').value;
 	var current_year= new Date().getFullYear();

	if(first_name=='' || first_name == "First Name:") {
		document.getElementById('errorDiv').style.display='inline';

        document.getElementById('errorDiv').innerHTML="Please enter first name.";
					
		document.getElementById('upgrade_first_name').focus();

		var target_offset = $("#errorDiv").offset();
		var target_top = target_offset.top;

		//$('html, body').animate({scrollTop:target_top}, 500);
						
		return false;
	};

		if( card_number=='' || isNaN(card_number) == true || card_number.length != 16 ) {
		document.getElementById('errorDiv').style.display='inline';

        document.getElementById('errorDiv').innerHTML="Please enter card number  16 digit as numeric .";
					
		document.getElementById('upgrade_card_number').focus();

		var target_offset = $("#errorDiv").offset();
		

		//$('html, body').animate({scrollTop:target_top}, 500);
						
		return false;
	};

		if(exp_month=='' || isNaN(exp_month) == true) {
		document.getElementById('errorDiv').style.display='inline';

        document.getElementById('errorDiv').innerHTML="Please enter expiries month as number.";
					
		document.getElementById('upgrade_exp_month').focus();

		var target_offset = $("#errorDiv").offset();
		var target_top = target_offset.top;

		//$('html, body').animate({scrollTop:target_top}, 500);
						
		return false;
	};
	

if(exp_year=='' || isNaN(exp_year) == true) {
		document.getElementById('errorDiv').style.display='inline';

        document.getElementById('errorDiv').innerHTML="Please enter expiries year as number.";
					
		document.getElementById('upgrade_exp_year').focus();

		var target_offset = $("#errorDiv").offset();
		var target_top = target_offset.top;

		//$('html, body').animate({scrollTop:target_top}, 500);
						
		return false;
	};
if(validateYear(exp_year)==false)
	 {
		document.getElementById('errorDiv').style.display='inline';

        document.getElementById('errorDiv').innerHTML="Expiries year shuld be either cureent year or after this year.";
					
		document.getElementById('upgrade_exp_year').focus();

		var target_offset = $("#errorDiv").offset();
		var target_top = target_offset.top;

		//$('html, body').animate({scrollTop:target_top}, 500);
						
		return false;
	};
if(exp_year==current_year)
{
if(validateMonth(exp_month) == false)
		{
		document.getElementById('errorDiv').style.display='inline';

        document.getElementById('errorDiv').innerHTML="Expiries month shuld be either cureent month or after this month.";
					
		document.getElementById('upgrade_exp_month').focus();

		var target_offset = $("#errorDiv").offset();
		var target_top = target_offset.top;

		//$('html, body').animate({scrollTop:target_top}, 500);
						
		return false;
	}
	};
if( code=='' || isNaN(code) == true || code.length != 3 ) {
		document.getElementById('errorDiv').style.display='inline';

        document.getElementById('errorDiv').innerHTML="Please enter code as 3 digit number.";
					
		document.getElementById('upgrade_code').focus();

		var target_offset = $("#errorDiv").offset();
		var target_top = target_offset.top;

		//$('html, body').animate({scrollTop:target_top}, 500);
						
		return false;
	};

  return true;
}

function ValidateCardForm(){
	
	
    var first_name = document.getElementById('first_name').value;
    var card_number = document.getElementById('card_number').value;
    var exp_month = document.getElementById('exp_month').value;
    var exp_year = document.getElementById('exp_year').value;
     var code = document.getElementById('code').value;

	if(first_name=='' || first_name == "First Name:") {
		document.getElementById('errorDiv').style.display='inline';

        document.getElementById('errorDiv').innerHTML="Please enter first name.";
					
		document.getElementById('first_name').focus();

		var target_offset = $("#errorDiv").offset();
		var target_top = target_offset.top;

		//$('html, body').animate({scrollTop:target_top}, 500);
						
		return false;
	};

		if( card_number=='' || isNaN(card_number) == true || card_number.length != 16 ) {
		document.getElementById('errorDiv').style.display='inline';

        document.getElementById('errorDiv').innerHTML="Please enter card number  16 digit as numeric .";
					
		document.getElementById('card_number').focus();

		var target_offset = $("#errorDiv").offset();
		

		//$('html, body').animate({scrollTop:target_top}, 500);
						
		return false;
	};

		if(exp_month=='' || isNaN(exp_month) == true) {
		document.getElementById('errorDiv').style.display='inline';

        document.getElementById('errorDiv').innerHTML="Please enter expiries month as number.";
					
		document.getElementById('exp_month').focus();

		var target_offset = $("#errorDiv").offset();
		var target_top = target_offset.top;

		//$('html, body').animate({scrollTop:target_top}, 500);
						
		return false;
	};
	if(validateMonth(exp_month) == false)
		{
		document.getElementById('errorDiv').style.display='inline';

        document.getElementById('errorDiv').innerHTML="Expiries month shuld be either cureent month or after this month.";
					
		document.getElementById('exp_month').focus();

		var target_offset = $("#errorDiv").offset();
		var target_top = target_offset.top;

		//$('html, body').animate({scrollTop:target_top}, 500);
						
		return false;
	};

if(exp_year=='' || isNaN(exp_year) == true) {
		document.getElementById('errorDiv').style.display='inline';

        document.getElementById('errorDiv').innerHTML="Please enter expiries year as number.";
					
		document.getElementById('exp_year').focus();

		var target_offset = $("#errorDiv").offset();
		var target_top = target_offset.top;

		//$('html, body').animate({scrollTop:target_top}, 500);
						
		return false;
	};
if(validateYear(exp_year)==false)
	 {
		document.getElementById('errorDiv').style.display='inline';

        document.getElementById('errorDiv').innerHTML="Expiries year shuld be either cureent year or after this year.";
					
		document.getElementById('exp_year').focus();

		var target_offset = $("#errorDiv").offset();
		var target_top = target_offset.top;

		//$('html, body').animate({scrollTop:target_top}, 500);
						
		return false;
	};

if( code=='' || isNaN(code) == true || code.length != 3 ) {
		document.getElementById('errorDiv').style.display='inline';

        document.getElementById('errorDiv').innerHTML="Please enter code as 3 digit number.";
					
		document.getElementById('code').focus();

		var target_offset = $("#errorDiv").offset();
		var target_top = target_offset.top;

		//$('html, body').animate({scrollTop:target_top}, 500);
						
		return false;
	};

  return true;
}


function ValidateEventForm()
{
    var title = document.getElementById('title_event').value;
    var event_date = document.getElementById('event_date').value;
    var event_time = document.getElementById('event_time').value;
    var duration = document.getElementById('duration').value;

	if(title=='' || title == "this is the event title / description")
	{
		document.getElementById('errorDiv_event').style.display='inline';

        document.getElementById('errorDiv_event').innerHTML="Please enter event title.";
					
		document.getElementById('title').focus();

		var target_offset = $("#errorDiv_event").offset();
		var target_top = target_offset.top;

		//$('html, body').animate({scrollTop:target_top}, 500);
						
		return false;
	};

	if(event_date=='' || event_date == "Date:dd-mm-yyy")
	{
		document.getElementById('errorDiv_event').style.display='inline';

        document.getElementById('errorDiv_event').innerHTML="Please enter event date.";
					
		document.getElementById('event_date').focus();

		var target_offset = $("#errorDiv_event").offset();
		var target_top = target_offset.top;
				
		return false;
	};

	if(validateDate(event_date)==false)
	{
			document.getElementById('errorDiv_event').style.display='inline';

	        document.getElementById('errorDiv_event').innerHTML="Please enter valid date.";
						
			document.getElementById('event_date').focus();

			var target_offset = $("#errorDiv_event").offset();
			var target_top = target_offset.top;

			
							
			return false;
	};


	if(event_time=='' || event_time == "Time:hh:mm am/pm")
	{
		document.getElementById('errorDiv_event').style.display='inline';

        document.getElementById('errorDiv_event').innerHTML="Please enter event time.";
					
		document.getElementById('event_time').focus();

		var target_offset = $("#errorDiv_event").offset();
		
		return false;
	};
		
	if(validateTime(event_time)==false)
		{
		document.getElementById('errorDiv_event').style.display='inline';

        document.getElementById('errorDiv_event').innerHTML="Please enter valid time.";
					
		document.getElementById('event_time').focus();

		var target_offset = $("#errorDiv_event").offset();
		
		return false;
	};

	if(duration=='' || duration == "Duration:hh" )
	{
		document.getElementById('errorDiv_event').style.display='inline';

        document.getElementById('errorDiv_event').innerHTML="Please enter duration.";
					
		document.getElementById('duration').focus();
					
		return false;
	};
	
	if(isNaN(duration)==true)
	{
		
		document.getElementById('errorDiv_event').style.display='inline';

        document.getElementById('errorDiv_event').innerHTML="Please enter duration as a number.";
					
		document.getElementById('duration').focus();
					
		return false;
	};


  return true;
}
