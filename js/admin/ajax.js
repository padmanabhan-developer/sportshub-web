 
  function  GetXmlHttpObject() 
  {
	   var xmlHttp=null;
	   try
	   {
	    // Firefox, Opera 8.0+, Safari
	    xmlHttp=new XMLHttpRequest();
	   }
	   catch (e)
	   {
	    //Internet Explorer
	    try
	    { 
	     xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
	    }
	    catch (e)
	    {
	     xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
	    }
   }
    
   return xmlHttp;
  }
  

 
function ShowSportFixture(path)
{
 var total_sports=$("#total_sports").val();

 var checked_sports=Array();
 var checked_sports_string,is_checked_sport=false;
 if(total_sports > 0)
 {
  var j=0;
  for(i=1;i<=total_sports;i++)
  {
   if(document.getElementById('sport_'+i).checked == true)
   {   
    checked_sports[j]=document.getElementById('sport_'+i).value;
    is_checked_sport=true;
    j++;
   }
  }
 }
 if(is_checked_sport == true)
 {
  checked_sports_string=checked_sports.join('~');
 }
 else checked_sports_string='';
 date_from= document.forms["search_frm2"]["date_from"].value;
 date_end = document.forms["search_frm2"]["date_end"].value;
 search_text= document.forms["search_frm2"]["search_text"].value;
 //alert(date_from);
 SearchResult(path,'','',date_from,date_end,search_text,checked_sports_string)


}
function ShowSearchDetail()
{
 
 date_from= document.forms["search_frm2"]["date_from"].value;
 date_end = document.forms["search_frm2"]["date_end"].value;
 search_text= document.forms["search_frm2"]["search_text"].value;
 //alert(date_from);
 SearchResultAdmin(date_from,date_end,search_text)


}
 /* 
  function ShowFixture(PATH,sport_ids)
  { 
   xmlHttp=GetXmlHttpObject();
   if(xmlHttp==null)
   {
    alert ("Your browser does not support AJAX!");
    return;
   }
  
   xmlHttp.onreadystatechange=stateChangedFixture;

   var url=PATH+"display_fixture?sport_id="+sport_ids;

   xmlHttp.open("GET",url,true);
   xmlHttp.send(null);
  }
  function stateChangedFixture()
  { 
   if (xmlHttp.readyState==4 || xmlHttp.readyState=='Completed')
   { 
    var msg = xmlHttp.responseText;
    document.getElementById("show_fixture").innerHTML=msg;
    //document.getElementById("question12").value=order_by;
   }
  }
*/
// function for search fixture result 
function SearchResult(PATH,cp,ppr,date_from,date_end,search_text,sport_id)
  { 
   xmlHttp=GetXmlHttpObject();
   if(xmlHttp==null)
   {
    alert ("Your browser does not support AJAX!");
    return;
   }
   xmlHttp.onreadystatechange=stateChangedSearchResult;
   var url=PATH+"display_search_fixture?cp="+cp+"&ppr="+ppr+"&date_from="+date_from+"&date_end="+date_end+"&search_text="+search_text+"&sport_id="+sport_id;
  // alert(url);
   xmlHttp.open("GET",url,true);
   xmlHttp.send(null);
  }
  function stateChangedSearchResult()
  { 
   if (xmlHttp.readyState==4 || xmlHttp.readyState=='Completed')
   { 
    var msg = xmlHttp.responseText;
    document.getElementById("show_fixture").innerHTML=msg;

    //document.getElementById("question12").value=order_by;
   }
  }

/*function SearchResultAdmin(PATH,cp,ppr,date_from,date_end,search_text)
  { 
   xmlHttp=GetXmlHttpObject();
   if(xmlHttp==null)
   {
    alert ("Your browser does not support AJAX!");
    return;
   }
   xmlHttp.onreadystatechange=stateChangedSearchResult;
    
   var url=PATH+"show_admin_page?cp="+cp+"&ppr="+ppr+"&date_from="+date_from+"&date_end="+date_end+"&search_text="+search_text;
  // alert(url);
   xmlHttp.open("GET",url,true);
   xmlHttp.send(null);
  }
  function stateChangedSearchResult()
  { 
   if (xmlHttp.readyState==4 || xmlHttp.readyState=='Completed')
   { 
    var msg = xmlHttp.responseText;
    document.getElementById("admin_events_inner").innerHTML=msg;

    //document.getElementById("question12").value=order_by;
   }
  }*/

function SearchResultAdmin(PATH,cp,ppr,date_from,date_end,search_text,subscibed)
{
  //alert('a' + subscibed);
  $.ajax({
    url: PATH+"show_admin_page",
    type: "GET",
    data: {cp:cp, ppr:ppr, date_from:date_from, date_end:date_end, search_text:search_text,subscibed:subscibed },
    success: function(data){
    //alert(data);
    document.getElementById("admin_events_inner").innerHTML=data;
     delete_function();
   
    //$('#show_fixture').html('debug');
   
    }
  });  
}
function SearchResultAdmin1(PATH,cp,ppr)
{
  $.ajax({
    url: PATH+"show_admin_page1",
    type: "GET",
    data: {cp:cp, ppr:ppr },
    success: function(data){
    //alert(data);
    document.getElementById("admin_events_inner").innerHTML=data;
     delete_function();
   
    //$('#show_fixture').html('debug');
   
    }
  });  
}

function SearchResultChannel(PATH,cp,ppr,search_text)
{
  $.ajax({
    url: PATH+"show_admin_page_channel",
    type: "GET",
    data: {cp:cp, ppr:ppr, search_channel:search_text },
    success: function(data){
    //alert(data);
    document.getElementById("admin_events_inner").innerHTML=data;
     delete_function();
   
    //$('#show_fixture').html('debug');
   
    }
  });  
}
function SearchResultProvider(PATH,cp,ppr,search_text)
{
  $.ajax({
    url: PATH+"show_admin_page_provider",
    type: "GET",
    data: {cp:cp, ppr:ppr, search_provider:search_text },
    success: function(data){
    //alert(data);
    document.getElementById("admin_events_inner").innerHTML=data;
     delete_function();
   
    //$('#show_fixture').html('debug');
   
    }
  });  
}
function SearchResultProviderChannel(PATH,cp,ppr,search_text,provider)
{
  if(provider=='')
    provider = $('#provider_id').val();
  $.ajax({
    url: PATH+"show_admin_page_provider_channel",
    type: "GET",
    data: {cp:cp, ppr:ppr, search_text_provider:search_text, provider_id:provider },
    success: function(data){
    //alert(data);
    document.getElementById("admin_events_inner").innerHTML=data;
	setinput()
    // delete_function();
   
    //$('#show_fixture').html('debug');
   
    }
  });  
}
function SendProviderChannelInfo(PATH,provider, channelid)
{
 	if($("#check_channel_"+channelid).is(':checked'))
		var mode = 'select';
	else var mode = 'deselect';
  if(provider!='')
	// alert(mode);
	  $.ajax({
		url: PATH+"update_provider_channel_info",
		type: "POST",
		data: {provider:provider, channel:channelid,mode: mode},
		success: function(data){
		setinput()
	   
		}
  });  
}

function SearchResultUser(PATH,cp,ppr,date_from,date_end,search_text)
{
  $.ajax({
    url: PATH+"show_user",
    type: "GET",
    data: {cp:cp, ppr:ppr, date_from:date_from, date_end:date_end, search_text:search_text },
    success: function(data){
    document.getElementById("user_events_inner").innerHTML=data;
     delete_function();
   
    }
  });  
}

function SearchResultRating(PATH,cp,ppr,date_from,date_end,search_text,status)
{
  $.ajax({
    url: PATH+"show_rating",
    type: "GET",
    data: {cp:cp, ppr:ppr, date_from:date_from, date_end:date_end, search_text:search_text,status:status },
    success: function(data){
    document.getElementById("rating_events_inner").innerHTML=data;
     delete_function();
   
    }
  });  
}
function SearchResultQuestion(PATH,cp,ppr,date_from,date_end,search_text,status)
{
  $.ajax({
    url: PATH+"show_quiz",
    type: "GET",
    data: {cp:cp, ppr:ppr, date_from:date_from, date_end:date_end, search_text:search_text,status:status },
    success: function(data){
    document.getElementById("quiz_inner").innerHTML=data;
     delete_question_function(PATH);
    }
  });  
}

function SearchResultReseller(PATH,cp,ppr,date_from,date_end,search_text,status)
{
  $.ajax({
    url: PATH+"show_reseller",
    type: "GET",
    data: {cp:cp, ppr:ppr, date_from:date_from, date_end:date_end, search_text:search_text,status:status },
    success: function(data){
    document.getElementById("reseller_inner").innerHTML=data;
     delete_question_function(PATH);
    }
  });  
}

function SearchResultResellerEst(PATH,cp,ppr)
{
  $.ajax({
    url: PATH+"show_view_reseller",
    type: "GET",
    data: {cp:cp, ppr:ppr},
    success: function(data){
    document.getElementById("reseller_est_inner").innerHTML=data;
     delete_question_function(PATH);
    }
  });  
}

function SearchResultRecabar(PATH,cp,ppr,date_from,date_end,search_text)
{
  $.ajax({
    url: PATH+"show_recabar",
    type: "GET",
    data: {cp:cp, ppr:ppr, date_from:date_from, date_end:date_end, search_text:search_text},
    success: function(data){
    document.getElementById("recabar_inner").innerHTML=data;
     delete_recabar_function(PATH);
    }
  });  
}

// function for search fixture result 
function SearchChannel(PATH,channel_search_text)
  { 
   xmlHttp=GetXmlHttpObject();
   if(xmlHttp==null)
   {
    alert ("Your browser does not support AJAX!");
    return;
   }
  // alert(sport_id);
 
   xmlHttp.onreadystatechange=stateChangedchannelResult;
   var url=PATH+"display_search_channel?channel_search_text="+channel_search_text;
   alert(url);
   xmlHttp.open("GET",url,true);
   xmlHttp.send(null);
  }
  function stateChangedchannelResult()
  { 
   if (xmlHttp.readyState==4 || xmlHttp.readyState=='Completed')
   { 
    var msg = xmlHttp.responseText;
    document.getElementById("channel_search").innerHTML=msg;
    window.location.reload();
    //document.getElementById("question12").value=order_by;
   }
  }


function default_load_function()
{
  $('#datepicker-example7-start').Zebra_DatePicker({
    format: 'd/m/Y',
    pair: $('#datepicker-example7-end'),
    onSelect: function(view, elements) {
      var PATH = $('#path').val();
       var subscibed = $('.check-1:checked').val();
       
      var date_from = $('#datepicker-example7-start').val();
      var date_end = $('#datepicker-example7-end').val();
      var search_text = $('#search_text').val();
      SearchResultAdmin(PATH, '1', '20', date_from, date_end, search_text,subscibed);
    }
  });
  $('#datepicker-example7-end').Zebra_DatePicker({format: 'd/m/Y',direction: 1,
      onSelect: function(view, elements) {
         var subscibed = $('.check-1:checked').val();
      var PATH = $('#path').val();
      var date_from = $('#datepicker-example7-start').val();
      var date_end = $('#datepicker-example7-end').val();
      var search_text = $('#search_text').val();
      SearchResultAdmin(PATH, '1', '20', date_from, date_end, search_text,subscibed);
    }

  });
  $('.dp_clear').click(function() {
      var PATH = $('#path').val();
      var date_from = $('#datepicker-example7-start').val();
      var date_end = $('#datepicker-example7-end').val();
      var search_text = $('#search_text').val();
      SearchResultAdmin(PATH, '1', '20', date_from, date_end, search_text,'');
    
  });
  $('.check-1').click(function() {

   var subscibed = $('.check-1:checked').val();
    var search_text = $('#search_text').val();
   // if(event.which == 13){
      var PATH = $('#path').val();
      var date_from = $('#datepicker-example7-start').val();
      var date_end = $('#datepicker-example7-end').val();
      
      SearchResultAdmin(PATH, '1', '20', date_from, date_end, search_text,subscibed);
    //}
  });
  $( "#search_text" ).keyup(function(event) {
    var search_text = $('#search_text').val();
 var subscibed = $('.check-1:checked').val();


    if(event.which == 13){
      var PATH = $('#path').val();
      var date_from = $('#datepicker-example7-start').val();
      var date_end = $('#datepicker-example7-end').val();
      SearchResultAdmin(PATH, '1', '20', date_from, date_end, search_text,subscibed);
    }
  });
  $('#search-button-schedule').click(function() {

     var subscibed = $('.check-1:checked').val();
     alert(subscibed);
      var PATH = $('#path').val();
      var date_from = $('#datepicker-example7-start').val();
      var date_end = $('#datepicker-example7-end').val();
      var search_text = $('#search_text').val();
      SearchResultAdmin(PATH, '1', '20', date_from, date_end, search_text,subscibed);
    
  });
  $('#search-button-schedule1').click(function() {

     var subscibed = $('.check-1:checked').val();
     
      var PATH = $('#path').val();
      var date_from = $('#datepicker-example7-start').val();
      var date_end = $('#datepicker-example7-end').val();
      var search_text = $('#search_text').val();
      SearchResultAdmin(PATH, '1', '20', date_from, date_end, search_text,subscibed);
    
  });
}

function default_user_load_function()
{
  $('#datepicker-example7-start').Zebra_DatePicker({
    format: 'd/m/Y',
    pair: $('#datepicker-example7-end'),
    onSelect: function(view, elements) {
      var PATH = $('#path').val();
      var date_from = $('#datepicker-example7-start').val();
      var date_end = $('#datepicker-example7-end').val();
      var search_text = $('#search_text').val();
      SearchResultUser(PATH, '1', '20', date_from, date_end, search_text,'');
    }
  });
  $('#datepicker-example7-end').Zebra_DatePicker({format: 'd/m/Y',direction: 1,
      onSelect: function(view, elements) {
      var PATH = $('#path').val();
      var date_from = $('#datepicker-example7-start').val();
      var date_end = $('#datepicker-example7-end').val();
      var search_text = $('#search_text').val();
      SearchResultUser(PATH, '1', '20', date_from, date_end, search_text,'');
    }

  });
  $('.dp_clear').click(function() {
      var PATH = $('#path').val();
      var date_from = $('#datepicker-example7-start').val();
      var date_end = $('#datepicker-example7-end').val();
      var search_text = $('#search_text').val();
      SearchResultUser(PATH, '1', '20', date_from, date_end, search_text,'');
    
  });
  $( "#search_text" ).keyup(function(event) {
    var search_text = $('#search_text').val();

    if(event.which == 13){
      var PATH = $('#path').val();
      var date_from = $('#datepicker-example7-start').val();
      var date_end = $('#datepicker-example7-end').val();
      SearchResultUser(PATH, '1', '20', date_from, date_end, search_text,'');
    }
  });
  $('#search-button-schedule').click(function() {
      var PATH = $('#path').val();
      var date_from = $('#datepicker-example7-start').val();
      var date_end = $('#datepicker-example7-end').val();
      var search_text = $('#search_text').val();
      SearchResultUser(PATH, '1', '20', date_from, date_end, search_text,'');
    
  });
}

function default_rating_load_function()
{
  $('#datepicker-example7-start').Zebra_DatePicker({
    format: 'd/m/Y',
    pair: $('#datepicker-example7-end'),
    onSelect: function(view, elements) {
      var PATH = $('#path').val();
      var date_from = $('#datepicker-example7-start').val();
      var date_end = $('#datepicker-example7-end').val();
      var search_text = $('#search_text').val();
      SearchResultRating(PATH, '1', '20', date_from, date_end, search_text,'');
    }
  });
  $('#datepicker-example7-end').Zebra_DatePicker({format: 'd/m/Y',direction: 1,
      onSelect: function(view, elements) {
      var PATH = $('#path').val();
      var date_from = $('#datepicker-example7-start').val();
      var date_end = $('#datepicker-example7-end').val();
      var search_text = $('#search_text').val();
      SearchResultRating(PATH, '1', '20', date_from, date_end, search_text,'');
    }

  });
  $('.dp_clear').click(function() {
      var PATH = $('#path').val();
      var date_from = $('#datepicker-example7-start').val();
      var date_end = $('#datepicker-example7-end').val();
      var search_text = $('#search_text').val();
      SearchResultRating(PATH, '1', '20', date_from, date_end, search_text,'');
    
  });
  $( "#search_text" ).keyup(function(event) {
    var search_text = $('#search_text').val();

    if(event.which == 13){
      var PATH = $('#path').val();
      var date_from = $('#datepicker-example7-start').val();
      var date_end = $('#datepicker-example7-end').val();
      SearchResultRating(PATH, '1', '20', date_from, date_end, search_text,'');
    }
  });
  $('#search-button-schedule').click(function() {
      var PATH = $('#path').val();
      var date_from = $('#datepicker-example7-start').val();
      var date_end = $('#datepicker-example7-end').val();
      var search_text = $('#search_text').val();
      SearchResultRating(PATH, '1', '20', date_from, date_end, search_text,'');
    
  });
  
  $("input[name='filter']").click(function(){
	  var PATH = $('#path').val();
      var date_from = $('#datepicker-example7-start').val();
      var date_end = $('#datepicker-example7-end').val();
      var search_text = $('#search_text').val();
	  var res = Array();
	  
	  if($("input[id='check-1']").is(":checked")) {
		res[0] = $("input[id='check-1']").val();
	  }
	  if($("input[id='check-2']").is(":checked")) {
		res[1] = $("input[id='check-2']").val();
	  }
	  status = res.join(',');
	  status = status.replace(/^,|,$/g,'');
	  SearchResultRating(PATH, '1', '20', date_from, date_end, search_text,status);	
  });
}

function default_question_load_function()
{
	
  $('#datepicker-example7-start').Zebra_DatePicker({
    format: 'd/m/Y',
    pair: $('#datepicker-example7-end'),
    onSelect: function(view, elements) {
      var PATH = $('#path').val();
      var date_from = $('#datepicker-example7-start').val();
      var date_end = $('#datepicker-example7-end').val();
      var search_text = $('#search_text').val();
      SearchResultQuestion(PATH, '1', '20', date_from, date_end, search_text,'');
    }
  });
  $('#datepicker-example7-end').Zebra_DatePicker({format: 'd/m/Y',direction: 1,
      onSelect: function(view, elements) {
      var PATH = $('#path').val();
      var date_from = $('#datepicker-example7-start').val();
      var date_end = $('#datepicker-example7-end').val();
      var search_text = $('#search_text').val();
      SearchResultQuestion(PATH, '1', '20', date_from, date_end, search_text,'');
    }

  });
  $('.dp_clear').click(function() {
      var PATH = $('#path').val();
      var date_from = $('#datepicker-example7-start').val();
      var date_end = $('#datepicker-example7-end').val();
      var search_text = $('#search_text').val();
      SearchResultQuestion(PATH, '1', '20', date_from, date_end, search_text,'');
    
  });
  $( "#search_text" ).keyup(function(event) {
    var search_text = $('#search_text').val();

    if(event.which == 13){
      var PATH = $('#path').val();
      var date_from = $('#datepicker-example7-start').val();
      var date_end = $('#datepicker-example7-end').val();
      SearchResultQuestion(PATH, '1', '20', date_from, date_end, search_text,'');
    }
  });
  $('#search-button-schedule').click(function() {
      var PATH = $('#path').val();
      var date_from = $('#datepicker-example7-start').val();
      var date_end = $('#datepicker-example7-end').val();
      var search_text = $('#search_text').val();
      SearchResultQuestion(PATH, '1', '20', date_from, date_end, search_text,'');
    
  });
  
  $("input[name='filter']").click(function(){
	  var PATH = $('#path').val();
      var date_from = $('#datepicker-example7-start').val();
      var date_end = $('#datepicker-example7-end').val();
      var search_text = $('#search_text').val();
	  var res = Array();
	  
	  if($("input[id='check-1']").is(":checked")) {
		res[0] = $("input[id='check-1']").val();
	  }
	  if($("input[id='check-2']").is(":checked")) {
		res[1] = $("input[id='check-2']").val();
	  }
	  status = res.join(',');
	  status = status.replace(/^,|,$/g,'');
	  SearchResultQuestion(PATH, '1', '20', date_from, date_end, search_text,status);	
  });
}

function default_reseller_load_function()
{
	
  $('#datepicker-example7-start').Zebra_DatePicker({
    format: 'd/m/Y',
    pair: $('#datepicker-example7-end'),
    onSelect: function(view, elements) {
      var PATH = $('#path').val();
      var date_from = $('#datepicker-example7-start').val();
      var date_end = $('#datepicker-example7-end').val();
      var search_text = $('#search_text').val();
      SearchResultReseller(PATH, '1', '20', date_from, date_end, search_text,'');
    }
  });
  $('#datepicker-example7-end').Zebra_DatePicker({format: 'd/m/Y',direction: 1,
      onSelect: function(view, elements) {
      var PATH = $('#path').val();
      var date_from = $('#datepicker-example7-start').val();
      var date_end = $('#datepicker-example7-end').val();
      var search_text = $('#search_text').val();
      SearchResultReseller(PATH, '1', '20', date_from, date_end, search_text,'');
    }

  });
  $('.dp_clear').click(function() {
      var PATH = $('#path').val();
      var date_from = $('#datepicker-example7-start').val();
      var date_end = $('#datepicker-example7-end').val();
      var search_text = $('#search_text').val();
      SearchResultReseller(PATH, '1', '20', date_from, date_end, search_text,'');
    
  });
  $( "#search_text" ).keyup(function(event) {
    var search_text = $('#search_text').val();

    if(event.which == 13){
      var PATH = $('#path').val();
      var date_from = $('#datepicker-example7-start').val();
      var date_end = $('#datepicker-example7-end').val();
      SearchResultReseller(PATH, '1', '20', date_from, date_end, search_text,'');
    }
  });
  $('#search-button-schedule').click(function() {
      var PATH = $('#path').val();
      var date_from = $('#datepicker-example7-start').val();
      var date_end = $('#datepicker-example7-end').val();
      var search_text = $('#search_text').val();
      SearchResultReseller(PATH, '1', '20', date_from, date_end, search_text,'');
    
  });
  
  $("input[name='filter']").click(function(){
	  var PATH = $('#path').val();
      var date_from = $('#datepicker-example7-start').val();
      var date_end = $('#datepicker-example7-end').val();
      var search_text = $('#search_text').val();
	  var res = Array();
	  
	  if($("input[id='check-1']").is(":checked")) {
		res[0] = $("input[id='check-1']").val();
	  }
	  if($("input[id='check-2']").is(":checked")) {
		res[1] = $("input[id='check-2']").val();
	  }
	  status = res.join(',');
	  status = status.replace(/^,|,$/g,'');
	  SearchResultReseller(PATH, '1', '20', date_from, date_end, search_text,status);	
  });
}

function default_recabar_load_function()
{
	
  $('#datepicker-example7-start').Zebra_DatePicker({
    format: 'd/m/Y',
    pair: $('#datepicker-example7-end'),
    onSelect: function(view, elements) {
      var PATH = $('#path').val();
      var date_from = $('#datepicker-example7-start').val();
      var date_end = $('#datepicker-example7-end').val();
      var search_text = $('#search_text').val();
      SearchResultRecabar(PATH, '1', '20', date_from, date_end, search_text);
    }
  });
  $('#datepicker-example7-end').Zebra_DatePicker({format: 'd/m/Y',direction: 1,
      onSelect: function(view, elements) {
      var PATH = $('#path').val();
      var date_from = $('#datepicker-example7-start').val();
      var date_end = $('#datepicker-example7-end').val();
      var search_text = $('#search_text').val();
      SearchResultRecabar(PATH, '1', '20', date_from, date_end, search_text);
    }

  });
  $('.dp_clear').click(function() {
      var PATH = $('#path').val();
      var date_from = $('#datepicker-example7-start').val();
      var date_end = $('#datepicker-example7-end').val();
      var search_text = $('#search_text').val();
      SearchResultRecabar(PATH, '1', '20', date_from, date_end, search_text);
    
  });
  $( "#search_text" ).keyup(function(event) {
    var search_text = $('#search_text').val();

    if(event.which == 13){
      var PATH = $('#path').val();
      var date_from = $('#datepicker-example7-start').val();
      var date_end = $('#datepicker-example7-end').val();
      SearchResultRecabar(PATH, '1', '20', date_from, date_end, search_text,'');
    }
  });
  $('#search-button-schedule').click(function() {
      var PATH = $('#path').val();
      var date_from = $('#datepicker-example7-start').val();
      var date_end = $('#datepicker-example7-end').val();
      var search_text = $('#search_text').val();
      SearchResultRecabar(PATH, '1', '20', date_from, date_end, search_text);
    
  });
  
  /*$("input[name='filter']").click(function(){
	  var PATH = $('#path').val();
      var date_from = $('#datepicker-example7-start').val();
      var date_end = $('#datepicker-example7-end').val();
      var search_text = $('#search_text').val();
	  var res = Array();
	  
	  if($("input[id='check-1']").is(":checked")) {
		res[0] = $("input[id='check-1']").val();
	  }
	  if($("input[id='check-2']").is(":checked")) {
		res[1] = $("input[id='check-2']").val();
	  }
	  status = res.join(',');
	  status = status.replace(/^,|,$/g,'');
	  SearchResultReseller(PATH, '1', '20', date_from, date_end, search_text,status);	
  });*/
}


function OpenAddOfferForm(PATH,offer_id)
  { 

   xmlHttp=GetXmlHttpObject();
   if(xmlHttp==null)
   {
    alert ("Your browser does not support AJAX!");
    return;
   }
  
   xmlHttp.onreadystatechange=stateChangedOffer;
   var url=PATH+"display_offer?offer_id="+offer_id;
   xmlHttp.open("GET",url,true);
   xmlHttp.send(null);
 }
  
function stateChangedOffer()
  { 
   if (xmlHttp.readyState==4 || xmlHttp.readyState=='Completed')
   { 
    var msg = xmlHttp.responseText;
	 closeShowingModal();
    document.getElementById("open_offer").innerHTML=msg;
	 closeShowingModal();
    //document.getElementById("question12").value=order_by;
   }
}

function OpenAddEventForm(PATH,event_id)
  {
	$.ajax({
    url: PATH+"display_event",
    type: "GET",
    data: {event_id:event_id},
    success: function(data){
		$('#open_event').html(data);
		$('.eventcreatedate').Zebra_DatePicker({format: 'd-m-Y'});
		$('.eventstarttime').timepicker({ 'timeFormat': 'h:i A' });
		}
	});  
}

function NewEstablishmentForm(PATH)
  { 
   xmlHttp=GetXmlHttpObject();
   if(xmlHttp==null)
   {
    alert ("Your browser does not support AJAX!");
    return;
   }
   xmlHttp.onreadystatechange=stateChangedEsta;
   var url=PATH+"new_establishment";
   xmlHttp.open("POST",url,true);
   xmlHttp.send(null);
  }
  
  function stateChangedEsta()
  { 
   if (xmlHttp.readyState==4 || xmlHttp.readyState=='Completed')
   { 
    var msg = xmlHttp.responseText;
	 closeShowingModal();
    document.getElementById("new_est").innerHTML=msg;
	 closeShowingModal();
    //document.getElementById("question12").value=order_by;
   }
 }
  
 function NewAdminUserForm(PATH)
  { 
   xmlHttp=GetXmlHttpObject();
   if(xmlHttp==null)
   {
    alert ("Your browser does not support AJAX!");
    return;
   }
   xmlHttp.onreadystatechange = stateChangedAdminUser;
   var url=PATH+"new_adminuser";
   xmlHttp.open("POST",url,true);
   xmlHttp.send(null);
  }
  
  function stateChangedAdminUser()
  { 
   if (xmlHttp.readyState==4 || xmlHttp.readyState=='Completed')
   { 
    var msg = xmlHttp.responseText;
	 closeShowingModal();
    document.getElementById("new_adminuser").innerHTML=msg;
	 closeShowingModal();
    //document.getElementById("question12").value=order_by;
   }
 }  

function delete_function()
{
   $(".close2").click(function(){  
    //var imageid = $(this).attr("data-imageid");
    //var imagerow = $(this).attr("data-rowid");
    var deleteid = $(this).attr("data-deleteid");
    //alert(deleteid);
    //var action =delete;
    if(deleteid > 0) { 
    
      $.confirm({
      title: 'Please confirm!',
      content: 'Are you sure you want to Delete the  Record?',
      confirm: function(){
        $.ajax
        ({ 
          url: 'delete_ajax',
          data: {"deleteid": deleteid, "caller" : "delete"},
          type: 'post',
          success: function(result) {
           
            //alert(result)
            //alert(result);return false;
            if(result){
                //$('#gallery_box_'+imageid).remove();
              window.location = 'establishments';
              }
            }
        });
        },
      cancel: function(){
      }
    });
    }

  })
}

function delete_question_function(PATH){ 
	
$(".close2").click(function(){  
	var deleteid = $(this).attr("data-deleteid");
	if(deleteid > 0) { 
		$.confirm({
		title: 'Please confirm!',
		content: 'Are you sure you want to Delete this Question?',
		confirm: function(){
			$.ajax
			({ 
				url: PATH+'delete_question_ajax',
				data: {"deleteid": deleteid, "caller" : "delete"},
				type: 'post',
				success: function(result) {
						location.reload();
					}
			});
			},
		cancel: function(){
		}
	});
	}
});
 $(".unblock").click(function(){  

    var unblockid = $(this).attr("data-unblockid");
    if(unblockid > 0) { 
		  $.confirm({
			  title: 'Please confirm!',
			  content: 'Are you sure you want to un block this question ?',
			  confirm: function(){
				$.ajax
				({ 
				  url: PATH+'block_question_ajax',
				  data: {id: unblockid, type:'unblock'},
				  type: 'post',
				  success: function(result) {
					if(result){
						location.reload();
					  }
					}
				});
				},
			  cancel: function(){ }
		 });
     }
  });
  
  $(".block").click(function(){  

    var blockid = $(this).attr("data-blockid");
    if(blockid > 0) { 
		  $.confirm({
			  title: 'Please confirm!',
			  content: 'Are you sure you want to block this question ?',
			  confirm: function(){
				$.ajax
				({ 
				  url: PATH+'/block_question_ajax',
				  data: {id: blockid, type:'block'},
				  type: 'post',
				  success: function(result) {
					if(result){
						location.reload();
					  }
					}
				});
				},
			  cancel: function(){ }
		 });
     }
  });	
}

function delete_reseller_function(PATH){ 
	
 $(".unblock").click(function(){  
    var unblockid = $(this).attr("data-unblockid");
    if(unblockid > 0) { 
		  $.confirm({
			  title: 'Please confirm!',
			  content: 'Are you sure you want to un block this reseller ?',
			  confirm: function(){
				$.ajax
				({ 
				  url: PATH+'block_reseller_ajax',
				  data: {id: unblockid, type:'unblock'},
				  type: 'post',
				  success: function(result) {
					if(result){
						location.reload();
					  }
					}
				});
				},
			  cancel: function(){ }
		 });
     }
  });
  
  $(".block").click(function(){  

    var blockid = $(this).attr("data-blockid");
    if(blockid > 0) { 
		  $.confirm({
			  title: 'Please confirm!',
			  content: 'Are you sure you want to block this reseller ?',
			  confirm: function(){
				$.ajax
				({ 
				  url: PATH+'/block_reseller_ajax',
				  data: {id: blockid, type:'block'},
				  type: 'post',
				  success: function(result) {
					if(result){
						location.reload();
					  }
					}
				});
				},
			  cancel: function(){ }
		 });
     }
  });	
}

function delete_recabar_function(PATH){ 
	
 $(".close1").click(function(){  
	var deleteid = $(this).attr("data-deleteid");
	if(deleteid > 0) { 
		$.confirm({
		title: 'Please confirm!',
		content: 'Are you sure you want to Delete this record?',
		confirm: function(){
			$.ajax
			({ 
				url: PATH+'delete_recabar_ajax',
				data: {"deleteid": deleteid, "caller" : "delete"},
				type: 'post',
				success: function(result) {
						location.reload();
					}
			});
			},
		cancel: function(){
		}
	});
	}
});
}
  