 
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
  

 function OpenAddEventForm(PATH,event_id)
  {
	$.ajax({
    url: PATH+"display_open",
    type: "GET",
    data: {event_id:event_id},
    success: function(data){
		$('#open_event').html(data);
		$('.eventcreatedate').Zebra_DatePicker({format: 'd-m-Y'});
		$('.eventstarttime').timepicker({ 'timeFormat': 'h:i A' });
		}
	});  
	  }
 function filter_events(PATH,fromdate, todate, searchtext){
	$.ajax({
    url: PATH+"filter_events",
    type: "POST",
    data: {fromdate:fromdate, todate:todate, searchtext:searchtext },
    success: function(data){
		$('#events-inner').html(data);
		}
	});  
}

function OpenAddEventForm_(PATH,event_id)
  { 
   xmlHttp=GetXmlHttpObject();
   if(xmlHttp==null)
   {
    alert ("Your browser does not support AJAX!");
    return;
   }
  
   xmlHttp.onreadystatechange=stateChangedEvent;
   var url=PATH+"display_open?event_id="+event_id;
   
   xmlHttp.open("GET",url,true);
   xmlHttp.send(null);
  }
  function stateChangedEvent()
  { 
   if (xmlHttp.readyState==4 || xmlHttp.readyState=='Completed')
   { 
    var msg = xmlHttp.responseText;
    document.getElementById("open_event").innerHTML=msg;
    //document.getElementById("question12").value=order_by;
   }
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

  function OpenAddOfferFormNew(PATH)
  { 

   xmlHttp=GetXmlHttpObject();
   if(xmlHttp==null)
   {
    alert ("Your browser does not support AJAX!");
    return;
   }
  
   xmlHttp.onreadystatechange=stateChangeOfferNew;
   var url=PATH+"add_new_offer";
   xmlHttp.open("GET",url,true);
   xmlHttp.send(null);
  }
  function stateChangeOfferNew()
  { 
   if (xmlHttp.readyState==4 || xmlHttp.readyState=='Completed')
   { 
    var msg = xmlHttp.responseText;
    document.getElementById("open_offer").innerHTML=msg;
    //document.getElementById("question12").value=order_by;
   }
  }

function ShowTvSchedule(PATH,channel_id)
  { 

   xmlHttp=GetXmlHttpObject();
   if(xmlHttp==null)
   {
    alert ("Your browser does not support AJAX!");
    return;
   }
  
   xmlHttp.onreadystatechange=stateChangedSchedule;
   var url=PATH+"display_channel?channel_id="+channel_id;
  // alert(url);
   xmlHttp.open("POST",url,true);
   xmlHttp.send(null);
  }
  function stateChangedSchedule()
  { 
   if (xmlHttp.readyState==4 || xmlHttp.readyState=='Completed')
   { 
    var msg = xmlHttp.responseText;
    document.getElementById("show_channel").innerHTML=msg;
    //document.getElementById("question12").value=order_by;
	resetCustomInput();
   }
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
 date_from= document.forms["search_frm2"]["datepicker-schedule-from"].value;
 date_end = document.forms["search_frm2"]["datepicker-schedule-to"].value;
 search_text= document.forms["search_frm2"]["search_text_schedule"].value;
 //alert(date_from);
 SearchResult(path,'','',date_from,date_end,search_text,checked_sports_string)


}
// function for search fixture result 
/*  Changed in to Jquery Ajax method Editited by Bagyaraj Apr04, 2015*/
function SearchResult(PATH,cp,ppr,date_from,date_end,search_text,sport_id){
	var channel_id=$('#total_channel_ids').val();
	resetCustomInput();
	$.ajax({
    url: PATH+"display_search_fixture",
    type: "GET",
    data: {cp:cp, ppr:ppr, date_from:date_from, date_end:date_end, search_text:search_text, channel_id:channel_id, sport_id:sport_id },
    success: function(data){
		//alert(data);
		document.getElementById("show_fixture").innerHTML=data;
		//$('#show_fixture').html('debug');
		resetCustomInput();
		}
	});  

}


function SearchResult_old(PATH,cp,ppr,date_from,date_end,search_text,sport_id)
  { 
   xmlHttp=GetXmlHttpObject();
   if(xmlHttp==null)
   {
    alert ("Your browser does not support AJAX!");
    return;
   }
 // alert(sport_id);
  var channel_id=document.getElementById("total_channel_ids").value;
  //if(sport_id=="")  var sport_id=document.getElementById("total_sport_ids").value;
  //var sport_id=document.getElementById("total_sport_ids").value;
   xmlHttp.onreadystatechange=stateChangedSearchResult;
   var url=PATH+"display_search_fixture?cp="+cp+"&ppr="+ppr+"&date_from="+date_from+"&date_end="+date_end+"&search_text="+search_text+"&channel_id="+channel_id+"&sport_id="+sport_id;
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
	resetCustomInput();
    //document.getElementById("question12").value=order_by;
   }
  }

function SearchChannel(PATH,channel_search_text){
	resetCustomInput();
	$.ajax({
    url: PATH+"display_search_channel",
    type: "GET",
    data: {channel_search_text:channel_search_text },
    success: function(data){
		document.getElementById("channel_search").innerHTML=data;
		default_load_function();
		resetCustomInput();
		$('#view_all').click(function(e){
			e.preventDefault();
			//alert(elemHeight.top);
        	var hash = $(this).attr("href");
			$('#remain_channel').show();
			var totalh = $('#totheight').val();
			if(totalh > 300){
			var toppos = parseInt(totalh) + parseInt(350);
			$('.side').animate({ scrollTop: toppos }, 2000);
			}
			$('.onfocus1').focus();
			$('.hideremain_all').show();
			$('#view_all').hide();
		})
		$('.hideremain_all').click(function(data){
			$('#remain_channel').hide();
			$('#view_all').show();
			$('.hideremain_all').hide();
		}) 
		$( "#ch-lists" ).customScroll({ scrollbarWidth: 10 });
		
		}
	});  

}

// function for search fixture result 
function SearchChannel_old(PATH,channel_search_text)
  { 
   xmlHttp=GetXmlHttpObject();
   if(xmlHttp==null)
   {
    alert ("Your browser does not support AJAX!");
    return;
   }
  // alert(sport_id);
 resetCustomInput();
   xmlHttp.onreadystatechange=stateChangedchannelResult;
   var url=PATH+"display_search_channel?channel_search_text="+channel_search_text;
  // alert(url);
   xmlHttp.open("GET",url,true);
   xmlHttp.send(null);
  }
  function stateChangedchannelResult()
  { 
   if (xmlHttp.readyState==4 || xmlHttp.readyState=='Completed')
   { 
    var msg = xmlHttp.responseText;
	resetCustomInput();
    document.getElementById("channel_search").innerHTML=msg;
	resetCustomInput();
    window.location.reload();
    //document.getElementById("question12").value=order_by;
   }
  
  }
function default_load_function()
{
	$('#datepicker-schedule-from').Zebra_DatePicker({
		format: 'd/m/Y',
		onSelect: function(view, elements) {
			var pathval = $('#path').val();
			var from_date = $('#datepicker-schedule-from').val();
			var to_date = $('#datepicker-schedule-to').val();
			var search_text = $('#search_text_schedule').val();
			SearchResult(pathval, '1', '20', from_date, to_date, search_text,'');
		}
	});
	$('#datepicker-schedule-to').Zebra_DatePicker({format: 'd/m/Y',
			onSelect: function(view, elements) {
			var pathval = $('#path').val();
			var from_date = $('#datepicker-schedule-from').val();
			var to_date = $('#datepicker-schedule-to').val();
			var search_text = $('#search_text_schedule').val();
			SearchResult(pathval, '1', '20', from_date, to_date, search_text,'');
		}

	});
	$('.dp_clear').click(function() {
			var pathval = $('#path').val();
			var from_date = $('#datepicker-schedule-from').val();
			var to_date = $('#datepicker-schedule-to').val();
			var search_text = $('#search_text_schedule').val();
			SearchResult(pathval, '1', '20', from_date, to_date, search_text,'');
		
	});
	$( "#search_text_schedule" ).keyup(function(event) {
		var search_text = $('#search_text_schedule').val();

		if(event.which == 13){
			var pathval = $('#path').val();
			var from_date = $('#datepicker-schedule-from').val();
			var to_date = $('#datepicker-schedule-to').val();
			SearchResult(pathval, '1', '20', from_date, to_date, search_text,'');
		}
	});
	$('#search-button-schedule').click(function() {
			var pathval = $('#path').val();
			var from_date = $('#datepicker-schedule-from').val();
			var to_date = $('#datepicker-schedule-to').val();
			var search_text = $('#search_text_schedule').val();
			SearchResult(pathval, '1', '20', from_date, to_date, search_text,'');
		
	});
	$( "#channel_search_text" ).keyup(function(event) {
		var search_text = $('#channel_search_text').val();

		if(event.which == 13){
			var pathval = $('#path').val();
			SearchChannel(pathval, search_text);
		}
	});

}


