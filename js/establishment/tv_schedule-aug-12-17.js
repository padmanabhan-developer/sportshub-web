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
$('.preloader').show();
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

function SearchResult(PATH,cp,ppr,date_from,date_end,search_text,sport_id)
  { 
  $('.preloader').show();
   xmlHttp=GetXmlHttpObject();
   if(xmlHttp==null)
   {
    alert ("Your browser does not support AJAX!");
    return;
   }
 // alert(sport_id);
  
   xmlHttp.onreadystatechange=stateChangedSearchResult;
   var url=PATH+"display_search_my_tv_fixture?cp="+cp+"&ppr="+ppr+"&date_from="+date_from+"&date_end="+date_end+"&search_text="+search_text+"&sport_id="+sport_id;
   //alert(url);
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
	$('.preloader').hide();
    //document.getElementById("question12").value=order_by;
   }
  }

function myFunction() {
    var x;
    if (confirm("Press a button!") == true) {
        x = "You pressed OK!";
    } else {
        x = "You pressed Cancel!";
    }
    document.getElementById("demo").innerHTML = x;
}

function SendFixtureInfo(PATH,cp,ppr,fixture_id,sport_id,date_from,date_end,search_text,me){
	if(confirm("Are you sure want to unschedule"))
   {
	$('.preloader').show();
	var action ='remove';
	//if($('#fixture_'+rowid).attr('checked')) { action ='add';}else{  action ='remove';}
	resetCustomInput();
	$.ajax({
    url: PATH+"establishment_my_tv_schedule/make_fixture_schedule",
    type: "GET",
    data: {cp:cp, ppr:ppr, fixture_id:fixture_id, sport_id:sport_id, date_from:date_from, date_end:date_end, search_text:search_text },
    success: function(data){
		document.getElementById("show_fixture").innerHTML=data;
		$('.preloader').hide();
		resetCustomInput();
		}
	});  
   }else{var checkboxid = me.id;
			document.getElementById(checkboxid).checked= true;	
			return false;}
}

function SendFixtureInfo_old(PATH,cp,ppr,fixture_id,sport_id,date_from,date_end,search_text,me)
  { 


   
   xmlHttp=GetXmlHttpObject();
   if(xmlHttp==null)
   {
    alert ("Your browser does not support AJAX!");
    return;
   }
 resetCustomInput();
  //confirm= confirm("Are you sure want to unschedule");
   if(confirm("Are you sure want to unschedule"))
   {
     xmlHttp.onreadystatechange=stateChangedFixture;
     var url=PATH+"establishment_my_tv_schedule/make_fixture_schedule?cp="+cp+"&ppr="+ppr+"&fixture_id="+fixture_id+"&sport_id="+sport_id+"&date_from="+date_from+"&date_end="+date_end+"&search_text="+search_text;
     
     xmlHttp.open("GET",url,true);
     xmlHttp.send(null);
     //window.location.reload();
   }
  else   { 
  			var checkboxid = me.id;
			document.getElementById(checkboxid).checked= true;	
			return false;}

  }
  function stateChangedFixture()
  { 
   if (xmlHttp.readyState==4 || xmlHttp.readyState=='Completed')
   { 
	resetCustomInput();
	 resetCustomInput();
    var msg = xmlHttp.responseText;
    document.getElementById("show_fixture").innerHTML=msg;
	 resetCustomInput();
     window.location.reload(true);
	 resetCustomInput();
    //document.getElementById("question12").value=order_by;
   }
  }
