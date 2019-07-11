function SendAllSportandFixture(PATH,channel_ids)
  { 
   xmlHttp=GetXmlHttpObject();
   if(xmlHttp==null)
   {
    alert ("Your browser does not support AJAX!");
    return;
   }
  
  //if(channel_ids == '') channel_ids ='??';
 // alert(channel_ids);
   xmlHttp.onreadystatechange=stateChangedChannel;
   var url=PATH+'establishment_schedule/display_schedule?channel_id='+channel_ids;
  //alert(url);
   xmlHttp.open("GET",url,true);
   xmlHttp.send(null);
  }
  function stateChangedChannel()
  { 
   if (xmlHttp.readyState==4 || xmlHttp.readyState=='Completed')
   { 
    var msg = xmlHttp.responseText;
    document.getElementById("show_channel").innerHTML=msg;
	resetCustomInput();
    //document.getElementById("question12").value=order_by;
   }
 }

//   function SendAllSportandFixture(path,channel_ids)
// {
//  $(document).ready(function(){
//  //$("#record_list").load(path+'user/ajax_record', {"cp":cp} ); // u can send mutiple argument as {"cp":cp,"name":name}
//  // Another method to implement ajax pagination using jquery
//  var param = {'channel_id':channel_ids}; // you can send multiple argument as {cp:cp,name:name}
//  // alert(path+" cp"+cp+" ppr "+ppr+" category_url "+category_url+" usage_id "+usage_ids+" brand_ids "+brand_ids);
//   $.ajax({
//     alert('ok2');
//     url: path+'establishment_schedule/display_schedule',
//   type:'POST', // You may use GET method also
//     data: param, 
//     beforeSend:function(data){
//       // $("#loading").text("Loading...");
//       // $('#loading').fadeIn(100);
      
//       // $('html, body').animate({
//       //   scrollTop: $(".wrapper").offset().top
//       // }, 1100);

//     },


//     success: function(result) { 
//        // alert(param);
//      $('#show_channel').html(result);
//     // $('#loading').fadeOut(800);   
//      window.addEvent("domready",function() {
//                 var lazyloader = new LazyLoad({
//                 /*
//                     onScroll: function() { console.warn("scroll!"); },
//                     onLoad: function(img) { console.warn("load!", img); },
//                     onComplete: function() { console.warn("complete!"); }
//                     */
//                 });
//             });    
//       } 
//      });
//    });
//   }



function SendChannelInfo(path)
{
  
 var total_channels=$("#total_channels").val();

 var checked_channels=Array();
 var checked_channels_string,is_checked_channel=false;
 if(total_channels > 0)
 {
  var j=0;
  for(i=1;i<=total_channels;i++)
  {
   if(document.getElementById('channel_'+i).checked == true)
   {   
    checked_channels[j]=document.getElementById('channel_'+i).value;
    is_checked_channel=true;
    j++;
   }
  }
 }
 if(is_checked_channel == true)
 {
  checked_channels_string=checked_channels.join('~');
 }
 else checked_channels_string='';
  	document.getElementById('total_channel_ids').value=checked_channels_string;
	SendAllSportandFixture(path,checked_channels_string)
	//$('#search-button-schedule').click();
	$('#datepicker-schedule-from').val('');
	$('#datepicker-schedule-to').val('');
	$('#search_text_schedule').val('');
	var tot_sport = $('#total_sports').val();
	for(var cnt = 1; cnt <= tot_sport; cnt++){
		$('#sport_'+cnt).removeAttr('checked');
		//$('label[for="' + id + '"]');
		$('#sport_'+cnt).next('label').removeClass("checked");
	}
	//$('#datepicker-schedule-from').val('');
	
} 



function SendFixtureInfo(PATH,cp,ppr,fixture_id,sport_id,date_from,date_end,search_text, rowid){
	var action ='add';
	if($('#fixture_'+rowid).attr('checked')) { action ='add';}else{  action ='remove';}
	resetCustomInput();
  	var channel_id=document.getElementById("total_channel_ids").value;
	$.ajax({
    url: PATH+"establishment_schedule/make_fixture_schedule",
    type: "GET",
    data: {cp:cp, ppr:ppr, fixture_id:fixture_id, sport_id:sport_id, channel_id:channel_id, date_from:date_from, date_end:date_end, search_text:search_text, action: action },
    success: function(data){
		//document.getElementById("show_fixture").innerHTML=data;
		resetCustomInput();
		}
	});  

}

function SendFixtureInfoAPP(PATH,cp,ppr,fixture_id,sport_id,date_from,date_end,search_text, rowid){
	var action ='add';
	if($('#fixture_'+rowid).attr('checked')) { action ='add';}else{  action ='remove';}
	resetCustomInput();
  	var channel_id=document.getElementById("total_channel_ids").value;
	$.ajax({
    url: PATH+"app_schedule/make_fixture_schedule",
    type: "GET",
    data: {cp:cp, ppr:ppr, fixture_id:fixture_id, sport_id:sport_id, channel_id:channel_id, date_from:date_from, date_end:date_end, search_text:search_text, action: action },
    success: function(data){
		//document.getElementById("show_fixture").innerHTML=data;
		resetCustomInput();
		}
	});  

}

function SendFixtureInfo_old(PATH,cp,ppr,fixture_id,sport_id,date_from,date_end,search_text)
  { 
//alert(sport_id);
   xmlHttp=GetXmlHttpObject();
   if(xmlHttp==null)
   {
    alert ("Your browser does not support AJAX!");
    return;
   }
  var channel_id=document.getElementById("total_channel_ids").value;
  //alert(channel_id);
   xmlHttp.onreadystatechange=stateChangedFixture;
   var url=PATH+"establishment_schedule/make_fixture_schedule?cp="+cp+"&ppr="+ppr+"&fixture_id="+fixture_id+"&sport_id="+sport_id+"&channel_id="+channel_id+"&date_from="+date_from+"&date_end="+date_end+"&search_text="+search_text;
  
   xmlHttp.open("GET",url,true);
   xmlHttp.send(null);
  }
  function stateChangedFixture()
  { 
   if (xmlHttp.readyState==4 || xmlHttp.readyState=='Completed')
   { 

    var msg = xmlHttp.responseText;
    document.getElementById("show_fixture").innerHTML=msg;
	
	resetCustomInput();
     window.location.reload();
	 resetCustomInput();
    //document.getElementById("question12").value=order_by;
   }
  }


