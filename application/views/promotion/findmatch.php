<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $profiledetails['title'];?> :: Sportshub</title>
<!--navigation-->
<?php $this->load->view('promotion/head');?>
<?php $this->load->view('promotion/google_analytics');?>
</head>

<body> 

<div id="wrapper">
<?php $this->load->view('promotion/header');?>	 
     <?php //print_r($happyhours)?>
     
    <div class="sticky" >
        <div class="col-12">
            <div class="container">
                <div class="row"> 
                <form name="findmatchfloat" id="findmatchfloat" method="get">
                    <input class="header_search21" id="header_search" name="header_search" placeholder="Search for teams, league or sports...  " type="text" value="<?php echo $banner_search?>">
                    <label for="name"  id="formsubmitheader"><!--<i class="fa fa-map-marker" aria-hidden="true"></i>-->SEARCH</label>
                    <input type="hidden" name="findval" id="findvalheader" value="<?php echo $findval?>" />
                    <input type="hidden" name="displayval" id="displayvalheader" value="<?php echo $displayval?>" />
                    <input type="hidden" name="findid" id="findidheader" value="<?php echo $typeid?>" />
                    <input type="hidden" name="findtype" id="findtypeheader" value="<?php echo $type?>" />
                    <input type="hidden" name="float" id="float" value="1" />
                    <input type="hidden" name="searchapi" id="searchapi" value="0" />
                 </form>
                </div>
            </div>
        </div>
    </div>
    <div id="banner61">
        <div class="layer">
            <div class="container">
                <div class="slider_text51">
                <h2> Find the match you want to watch</h2> 
                    <div class="col-sm-12" style="margin-top: 40px;" >
                        <div class="locationinput">
                                <div class="inputnew"> 
                                	<form name="findmatch" id="findmatch" method="get">
                                		<input class="banner_search"  id="banner_search" name="banner_search" placeholder="Search for teams, league or sports...  " type="text" value="<?php echo $banner_search?>"><label for="name"  id="formsubmit"><!--<i class="fa fa-map-marker" aria-hidden="true"></i>-->SEARCH</label> 
                                        <input type="hidden" name="findval" id="findval" value="<?php echo $findval?>" />
                                        <input type="hidden" name="displayval" id="displayval" value="<?php echo $displayval?>" />
                                        <input type="hidden" name="findid" id="findid" value="<?php echo $typeid?>" />
                                        <input type="hidden" name="findtype" id="findtype" value="<?php echo $type?>" />
                                        <input type="hidden" name="float" id="float1" value="0" />
                                        <input type="hidden" name="searchapi" id="searchapi1" value="0" />
                                    </form>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
        <!--<div class="banner_bottom" id="sticky-header">
            <div class="container">
                <span class="prev"><a href="<?php echo base_url();?>venue">VENUES</a></span>
                <span class="next"><a href="<?php echo base_url();?>sportsfans">SPORTSLOVERS</a></span>
            </div>
        </div>--><!--close banner_bottom-->
    </div><!--close banner-->
     <div id="content">
     
     <div class="section7">
            <div class="container" id="barmatches">
            	<h2 class="title_text">
                <?php if($banner_search!=''){
						echo 'Search results for "'.$banner_search.'"';}
					  else{
						echo 'Upcoming fixtures';}?>
                </h2>
                <div class="sec_menu" >
                <?php
			 	$today =  date("d-m-Y",time());
				$tomorrow = date("d-m-Y", strtotime("+1 day"));
				$third = date("d-m-Y", strtotime("+2 days"));
				$fourth = date("d-m-Y", strtotime("+3 days"));
				$fifth = date("d-m-Y", strtotime("+4 days"));
				$sixth = date("d-m-Y", strtotime("+5 days"));
				$seventh = date("d-m-Y", strtotime("+6 days"));
				?>
                    <ul>
                        <li><a href="#tabs-1" class="active">ALL</a></li>
                        <li><a href="#tabs-2">TODAY</a></li>
                        <li><a href="#tabs-3">TOMORROW</a></li>
                        <li><a href="#tabs-4"><?php echo date("D d", strtotime("+2 days"))?>.</a></li>
                        <li><a href="#tabs-5"><?php echo date("D d", strtotime("+3 days"))?>.</a></li>
                        <li><a href="#tabs-6"><?php echo date("D d", strtotime("+4 days"))?>.</a></li>
                        <li><a href="#tabs-7"><?php echo date("D d", strtotime("+5 days"))?>.</a></li>
                        <li><a href="#tabs-8"><?php echo date("D d", strtotime("+6 days"))?>.</a></li>
                    </ul>
                <?php //print_r($schedules);?>
              </div>
               <div id="tabs-1" class="tabcontent">
                <?php 
				$count =1;
				foreach($schedules as $schedule){
					//if($count==5)break;
				?>
                    <div class="blog blogtab1" data-gameid="<?php echo $schedule['id'];?>" data-actual="<?php echo $schedule['actualdate'];?>" data-timezone="<?php echo $schedule['current_timezone'];?>">
                        <div class="blog-4">
                            <h4><?php echo $schedule['sport_name'];?></h4>
                            <p><?php echo $schedule['competition_name'];?></p>
                        </div>
                        <div class="blog-8" data-timezone="<?php echo $schedule['curtimezone'];?>">
                            <span class="yellow"><?php echo $schedule['team1'];?>   vs.   <?php echo $schedule['team2'];?></span>
                            <p><?php echo $schedule['date_time'];?></p>
                        </div>
                        <div class="blog-41"><a href="<?php echo base_url();?>promotion/bars/<?php echo $schedule['id'];?>">FIND BARS</a><span class="spanmore"> ></span></div>
                    </div>
                    <?php $count++;}?>
                    <div class="section10">
                    <div class="col-12">
                        <div class="box_center">
                            <a id="loadMore1" href="javascript:;" class="button">LOAD MORE</a>
                            <div id="nomore1" class="nomore" style="display:none;" >NO MORE FIXTURES</div>
                        </div>
                    </div>
                    </div>
                </div> 
                <div id="tabs-2" class="tabcontent" style="display:none;">
                <?php 
				$count2 =1;
				foreach($schedules as $schedule){
					//if($count==5)break;
					//echo $schedule['actualdate'];
					if($schedule['actualdate'] == $today){
				?>
                    <div class="blog blogtab2" >
                        <div class="blog-4">
                            <h4><?php echo $schedule['sport_name'];?></h4>
                            <p><?php echo $schedule['competition_name'];?></p>
                        </div>
                        <div class="blog-8">
                            <span class="yellow"><?php echo $schedule['team1'];?>   vs.   <?php echo $schedule['team2'];?></span>
                            <p><?php echo $schedule['date_time'];?></p>
                        </div>
                        <div class="blog-41"><a href="<?php echo base_url();?>promotion/bars/<?php echo $schedule['id'];?>">FIND BARS</a><span class="spanmore"> ></span></div>
                    </div>
                    <?php $count2++;
					}
					}?>
                    <div class="section10">
                    <div class="col-12">
                        <div class="box_center">
                            <a id="loadMore2" href="javascript:;" class="button">LOAD MORE</a>
                            <div id="nomore2" class="nomore" style="display:none;" >NO MORE FIXTURES</div>
                        </div>
                    </div>
                    </div>
                </div>
                <div id="tabs-3" class="tabcontent" style="display:none;">
                <?php 
				$count3 =1;
				foreach($schedules as $schedule){
					//if($count==5)break;
				//	echo $schedule['dateonly'];
					if($schedule['actualdate'] == $tomorrow){
				?>
                    <div class="blog blogtab3" >
                        <div class="blog-4">
                            <h4><?php echo $schedule['sport_name'];?></h4>
                            <p><?php echo $schedule['competition_name'];?></p>
                        </div>
                        <div class="blog-8">
                            <span class="yellow"><?php echo $schedule['team1'];?>   vs.   <?php echo $schedule['team2'];?></span>
                            <p><?php echo $schedule['date_time'];?></p>
                        </div>
                        <div class="blog-41"><a href="<?php echo base_url();?>promotion/bars/<?php echo $schedule['id'];?>">FIND BARS</a><span class="spanmore"> ></span></div>
                    </div>
                    <?php $count3++;
					}
				}?>
                <div class="section10">
                    <div class="col-12">
                        <div class="box_center">
                            <a id="loadMore3" href="javascript:;" class="button">LOAD MORE</a>
                            <div id="nomore3" class="nomore" style="display:none;" >NO MORE FIXTURES</div>
                        </div>
                    </div>
                </div>
                </div>
                <div id="tabs-4" class="tabcontent" style="display:none;">
                <?php 
				$count4 =1;
				foreach($schedules as $schedule){
					//if($count==5)break;
					if($schedule['actualdate'] == $third){
				?>
                    <div class="blog blogtab4" >
                        <div class="blog-4">
                            <h4><?php echo $schedule['sport_name'];?></h4>
                            <p><?php echo $schedule['competition_name'];?></p>
                        </div>
                        <div class="blog-8">
                            <span class="yellow"><?php echo $schedule['team1'];?>   vs.   <?php echo $schedule['team2'];?></span>
                            <p><?php echo $schedule['date_time'];?></p>
                        </div>
                        <div class="blog-41"><a href="<?php echo base_url();?>promotion/bars/<?php echo $schedule['id'];?>">FIND BARS</a><span class="spanmore"> ></span></div>
                    </div>
                    <?php $count4++;
					}
				}?>
                    <div class="section10">
                    <div class="col-12">
                        <div class="box_center">
                            <a id="loadMore4" href="javascript:;" class="button">LOAD MORE</a>
                            <div id="nomore4" class="nomore" style="display:none;" >NO MORE FIXTURES</div>
                        </div>
                    </div>
                    </div>
                </div>
                <div id="tabs-5" class="tabcontent" style="display:none;">
                <?php 
				$count5 =1;
				foreach($schedules as $schedule){
					//if($count==5)break;
					if($schedule['actualdate'] == $fourth){
				?>
                    <div class="blog blogtab5" >
                        <div class="blog-4">
                            <h4><?php echo $schedule['sport_name'];?></h4>
                            <p><?php echo $schedule['competition_name'];?></p>
                        </div>
                        <div class="blog-8">
                            <span class="yellow"><?php echo $schedule['team1'];?>   vs.   <?php echo $schedule['team2'];?></span>
                            <p><?php echo $schedule['date_time'];?></p>
                        </div>
                        <div class="blog-41"><a href="<?php echo base_url();?>promotion/bars/<?php echo $schedule['id'];?>">FIND BARS</a><span class="spanmore"> ></span></div>
                    </div>
                    <?php $count5++;
					}
				}?>
                    <div class="section10">
                    <div class="col-12">
                        <div class="box_center">
                            <a id="loadMore5" href="javascript:;" class="button">LOAD MORE</a>
                            <div id="nomore5" class="nomore" style="display:none;" >NO MORE FIXTURES</div>
                        </div>
                    </div>
                    </div>
                </div>
                <div id="tabs-6" class="tabcontent" style="display:none;">
                <?php 
				$count6 =1;
				foreach($schedules as $schedule){
					//if($count==5)break;
					if($schedule['actualdate'] == $fifth){
				?>
                    <div class="blog blogtab6" >
                        <div class="blog-4">
                            <h4><?php echo $schedule['sport_name'];?></h4>
                            <p><?php echo $schedule['competition_name'];?></p>
                        </div>
                        <div class="blog-8">
                            <span class="yellow"><?php echo $schedule['team1'];?>   vs.   <?php echo $schedule['team2'];?></span>
                            <p><?php echo $schedule['date_time'];?></p>
                        </div>
                        <div class="blog-41"><a href="<?php echo base_url();?>promotion/bars/<?php echo $schedule['id'];?>">FIND BARS</a><span class="spanmore"> ></span></div>
                    </div>
                    <?php $count6++;
					}
				}?>
                   <div class="section10">
                    <div class="col-12">
                        <div class="box_center">
                            <a id="loadMore6" href="javascript:;" class="button">LOAD MORE</a>
                            <div id="nomore6" class="nomore" style="display:none;" >NO MORE FIXTURES</div>
                        </div>
                    </div>
                    </div>
                </div>
                <div id="tabs-7" class="tabcontent" style="display:none;">
                <?php 
				$count7 =1;
				foreach($schedules as $schedule){
					//if($count==5)break;
					if($schedule['actualdate'] == $sixth){
				?>
                    <div class="blog blogtab7" >
                        <div class="blog-4">
                            <h4><?php echo $schedule['sport_name'];?></h4>
                            <p><?php echo $schedule['competition_name'];?></p>
                        </div>
                        <div class="blog-8">
                            <span class="yellow"><?php echo $schedule['team1'];?>   vs.   <?php echo $schedule['team2'];?></span>
                            <p><?php echo $schedule['date_time'];?></p>
                        </div>
                        <div class="blog-41"><a href="<?php echo base_url();?>promotion/bars/<?php echo $schedule['id'];?>">FIND BARS</a><span class="spanmore"> ></span></div>
                    </div>
                    <?php $count7++;
					}
				}?>
                    <div class="section10">
                    <div class="col-12">
                        <div class="box_center">
                            <a id="loadMore7" href="javascript:;" class="button">LOAD MORE</a>
                            <div id="nomore7" class="nomore" style="display:none;" >NO MORE FIXTURES</div>
                        </div>
                    </div>
                   </div>
                </div>
                <div id="tabs-8" class="tabcontent" style="display:none;">
                <?php 
				$count8 =1;
				foreach($schedules as $schedule){
					//if($count==5)break;
					if($schedule['actualdate'] == $seventh){
				?>
                    <div class="blog blogtab8" >
                        <div class="blog-4">
                            <h4><?php echo $schedule['sport_name'];?></h4>
                            <p><?php echo $schedule['competition_name'];?></p>
                        </div>
                        <div class="blog-8">
                            <span class="yellow"><?php echo $schedule['team1'];?>   vs.   <?php echo $schedule['team2'];?></span>
                            <p><?php echo $schedule['date_time'];?></p>
                        </div>
                        <div class="blog-41"><a href="<?php echo base_url();?>promotion/bars/<?php echo $schedule['id'];?>">FIND BARS</a><span class="spanmore"> ></span></div>
                    </div>
                    <?php $count8++;
					}
				}?>
                   <div class="section10">
                    <div class="col-12">
                        <div class="box_center">
                            <a id="loadMore8" href="javascript:;" class="button">LOAD MORE</a>
                            <div id="nomore8" class="nomore" style="display:none;" >NO MORE FIXTURES</div>
                        </div>
                    </div>
                    </div>
                </div>

            </div><!--close container-->
        </div><!--close section7-->
     
     
     
     <div class="section5">
               		<span class="prev2"><a href="<?php echo base_url();?>venue">BARS</a></span>
                    <span class="next2"><a href="<?php echo base_url();?>sportsfans">SPORTS LOVERS</a></span>
          </div>
     </div><!--close content-->
     <!--<span id="latlon"></span>-->
     
<?php $this->load->view('promotion/footer');?>
</div><!--close wrapper-->
<script>
/*function locationHandler(location)
{
    var lat = location.coords.latitude;
    var lng = location.coords.longitude;

    if(lat && lng)
    {
        $('#latlon').html(lat+' '+lng);
    }
}

if(typeof navigator.geolocation.getCurrentPosition == 'function')
{
    navigator.geolocation.getCurrentPosition(locationHandler);
}*/
</script>
<script>
$.widget( "custom.catcomplete", $.ui.autocomplete, {
    
     _create: function() {
        this._super();
        this.widget().menu( "option", "items", "> :not(.ui-autocomplete-category)" );
    },
     _renderMenu: function( ul, items ) {
         var that = this,
        currentCategory = "";
         $.each( items, function( index, item ) {
            var li;
            if ( item.category != currentCategory ) {
                ul.append( "<li class='ui-autocomplete-category " + item.category + "'>" + item.category + "</li>" );
                currentCategory = item.category;
            }
            li = that._renderItemData( ul, item );
            /*if ( item.category ) {
                li.attr( "aria-label", item.category + " : " + item.label );
            }*/
        });
    },
     
     _renderItem: function( ul, item ) {
		var regexp = new RegExp('(' + this.term + ')', 'gi'),
            classString = this.options.highlightClass ?  ' class="' + this.options.highlightClass + '"' : '',
            label = item.label.replace(regexp, '<span' + classString + '>$1</span>');

        return $('<li><a href="#">' + label + '</a></li>').appendTo(ul);
	}
});
			
$(function() {
			
			$("#banner_search").catcomplete({
				source: '<?php echo base_url();?>promotion/availablelists',
				minLength: 3,
				focus: function(event, ui) {
					// prevent autocomplete from updating the textbox
					event.preventDefault();
					// manually update the textbox
					$(this).val(ui.item.labeloriginal);
					if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
						$("#findval").val(ui.item.labeloriginal);
						$("#displayval").val(ui.item.label);
						$("#findid").val(ui.item.value);
						$("#findtype").val(ui.item.category);
						$("#searchapi1").val('1');
						$('#findmatch').submit();
					}
				},select: function(event, ui) {
					// prevent autocomplete from updating the textbox
					event.preventDefault();
					// manually update the textbox and hidden field
					$(this).val(ui.item.labeloriginal);
					//alert(ui.item.label);
						$("#findval").val(ui.item.labeloriginal);
						$("#displayval").val(ui.item.label);
						$("#findid").val(ui.item.value);
						$("#findtype").val(ui.item.category);
						$("#searchapi1").val('1');
						$('#findmatch').submit();
				},
				highlightClass: 'ui-autocomplete-hightlight'
			});
			$("#header_search").catcomplete({
				source: '<?php echo base_url();?>promotion/availablelists',
				minLength: 3,
				focus: function(event, ui) {
					// prevent autocomplete from updating the textbox
					event.preventDefault();
					// manually update the textbox
					$(this).val(ui.item.labeloriginal);
					if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
						$("#findvalheader").val(ui.item.labeloriginal);
						$("#displayvalheader").val(ui.item.label);
						$("#findidheader").val(ui.item.value);
						$("#findtypeheader").val(ui.item.category);
						$("#searchapi").val('1');
						$('#findmatchfloat').submit();
					}
				},select: function(event, ui) {
					// prevent autocomplete from updating the textbox
					event.preventDefault();
					// manually update the textbox and hidden field
					$(this).val(ui.item.labeloriginal);
					$("#findvalheader").val(ui.item.labeloriginal);
					$("#displayvalheader").val(ui.item.label);
					$("#findidheader").val(ui.item.value);
					$("#findtypeheader").val(ui.item.category);
					$("#searchapi").val('1');
					$('#findmatchfloat').submit();
				},
				highlightClass: 'ui-autocomplete-hightlight'
			});
		});
	</script>
<script type="text/javascript">
$(document).ready(function () {
    size_li1 = $("#tabs-1 .blogtab1").size();
	//alert(size_li);
    x1=5;
		if(x1 >= size_li1){
			$('#loadMore1').hide();
			$('#nomore1').show();
		}
    $('#tabs-1 .blogtab1:lt('+x1+')').show();
    $('#loadMore1').click(function () {
        x1= (x1+5 <= size_li1) ? x1+5 : size_li1;
        $('#tabs-1 .blogtab1:lt('+x1+')').slideDown(1000);
		if(x1 >= size_li1){
			$('#loadMore1').hide();
			$('#nomore1').show();
		}
    });


    size_li2 = $("#tabs-2 .blogtab2").size();
	//alert(size_li);
    x2=5;
		if(x2 >= size_li2){
			$('#loadMore2').hide();
			$('#nomore2').show();
		}
    $('#tabs-2 .blogtab2:lt('+x2+')').show();
    $('#loadMore2').click(function () {
        x2= (x2+5 <= size_li2) ? x2+5 : size_li2;
        $('#tabs-2 .blogtab2:lt('+x2+')').slideDown(1000);
		if(x2 >= size_li2){
			$('#loadMore2').hide();
			$('#nomore2').show();
		}
    });


    size_li3 = $("#tabs-3 .blogtab3").size();
	//alert(size_li);
    x3=5;
		if(x3 >= size_li3){
			$('#loadMore3').hide();
			$('#nomore3').show();
		}
    $('#tabs-3 .blogtab3:lt('+x3+')').show();
    $('#loadMore3').click(function () {
        x3= (x3+5 <= size_li3) ? x3+5 : size_li3;
        $('#tabs-3 .blogtab3:lt('+x3+')').slideDown(1000);
		if(x3 >= size_li3){
			$('#loadMore3').hide();
			$('#nomore3').show();
		}
    });


    size_li4 = $("#tabs-4 .blogtab4").size();
	//alert(size_li);
    x4=5;
		if(x4 >= size_li4){
			$('#loadMore4').hide();
			$('#nomore4').show();
		}
    $('#tabs-4 .blogtab4:lt('+x4+')').show();
    $('#loadMore4').click(function () {
        x4= (x4+5 <= size_li4) ? x4+5 : size_li4;
        $('#tabs-4 .blogtab4:lt('+x4+')').slideDown(1000);
		if(x4 >= size_li4){
			$('#loadMore4').hide();
			$('#nomore4').show();
		}
    });


    size_li5 = $("#tabs-5 .blogtab5").size();
	//alert(size_li);
   x5=5;
 		if(x5 >= size_li5){
			$('#loadMore5').hide();
			$('#nomore5').show();
		}
    $('#tabs-5 .blogtab5:lt('+x5+')').show();
    $('#loadMore5').click(function () {
        x5= (x5+5 <= size_li5) ? x5+5 : size_li5;
        $('#tabs-5 .blogtab5:lt('+x5+')').slideDown(1000);
		if(x5 >= size_li5){
			$('#loadMore5').hide();
			$('#nomore5').show();
		}
    });


    size_li6 = $("#tabs-6 .blogtab6").size();
	//alert(size_li);
    x6=5;
		if(x6 >= size_li6){
			$('#loadMore6').hide();
			$('#nomore6').show();
		}
    $('#tabs-6 .blogtab6:lt('+x6+')').show();
    $('#loadMore6').click(function () {
        x6= (x6+5 <= size_li6) ? x6+5 : size_li6;
        $('#tabs-6 .blogtab6:lt('+x6+')').slideDown(1000);
		if(x6 >= size_li6){
			$('#loadMore6').hide();
			$('#nomore6').show();
		}
    });


    size_li7 = $("#tabs-7 .blogtab7").size();
	//alert(size_li);
   x7=5;
 		if(x7 >= size_li7){
			$('#loadMore7').hide();
			$('#nomore7').show();
		}
    $('#tabs-7 .blogtab7:lt('+x7+')').show();
    $('#loadMore7').click(function () {
        x7= (x7+5 <= size_li7) ? x7+5 : size_li7;
        $('#tabs-7 .blogtab7:lt('+x7+')').slideDown(1000);
		if(x7 >= size_li7){
			$('#loadMore7').hide();
			$('#nomore7').show();
		}
    });


    size_li8 = $("#tabs-8 .blogtab8").size();
	//alert(size_li);
    x8=5;
		if(x8 >= size_li8){
			$('#loadMore8').hide();
			$('#nomore8').show();
		}
    $('#tabs-8 .blogtab8:lt('+x8+')').show();
    $('#loadMore8').click(function () {
        x8= (x8+5 <= size_li8) ? x8+5 : size_li8;
        $('#tabs-8 .blogtab8:lt('+x8+')').slideDown(1000);
		if(x8 >= size_li8){
			$('#loadMore8').hide();
			$('#nomore8').show();
		}
    });
});
$(document).ready(function(){
    $("#barmatches li a").click(function(e){
		$("#barmatches li a").removeClass('active');
        e.preventDefault();
        var showIt =  $(this).attr('href');
        $(".tabcontent").hide();
        $(showIt).show();
		$(this).addClass('active');          
    });
	$('#formsubmit').click(function(){
		//alert('dd');
		//if($('#banner_search').val()==''){
			$('#findval').val($('#banner_search').val());
			$('#displayval').val($('#banner_search').val());
			$('#findid').val('');
			$('#findtype').val('Search');
		//}
		$('#findmatch').submit();
	});
	$('#formsubmitheader').click(function(){
		//if($('#header_search').val()==''){
			$('#findvalheader').val($('#header_search').val());
			$('#displayvalheader').val($('#header_search').val());
			$('#findidheader').val('');
			$('#findtypeheader').val('Search');
		//}
		$('#findmatchfloat').submit();
	});
	

	$("#banner_search").keypress(function(event) {
    	if (event.which == 13) {
			event.preventDefault();
			$('#findval').val($('#banner_search').val());
			$('#displayval').val($('#banner_search').val());
			$('#findid').val('');
       		$('#findtype').val('Search');
	   		$('#findmatch').submit();
    }
	});

	$("#header_search").keypress(function(event) {
		if (event.which == 13) {
			event.preventDefault();
			$('#findvalheader').val($('#header_search').val());
			$('#displayvalheader').val($('#header_search').val());
			$('#findidheader').val('');
			$('#findtypeheader').val('Search');
			$('#findmatchfloat').submit();
		}
	});


});
</script>
<?php $this->load->view('promotion/footer_includes');?>

</body>
</html>
