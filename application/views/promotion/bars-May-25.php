<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $gamedetails['team1name'];?> Vs <?php echo $gamedetails['team2name'];?> :: Sportshub</title>
<!--navigation-->
<?php $this->load->view('promotion/head');?>
<?php $this->load->view('promotion/google_analytics');?>
</head>

<body> 

<div id="wrapper">
<?php $this->load->view('promotion/header');?>	 
     <?php //print_r($happyhours)?>
     <div id="banner6">
     	  <div class="layer">
          	   <div class="container">
                    	 <div class="slider_text6">
                         <h2><?php echo $gamedetails['team1name'];?> <span class="vs">vs.</span> <?php echo $gamedetails['team2name'];?></h2> 
						 <h4><?php echo $gamedetails['date_time'];?> - <?php echo $gamedetails['cname'];?>  </h4> 
                        
                    </div>
               </div>
          </div>
          
          <div class="banner_bottom">
          	   <div class="container">
               		<span class="prev"><a href="<?php echo base_url();?>venue">BARS</a></span>
                    <span class="next"><a href="<?php echo base_url();?>sportsfans">SPORTSLOVERS</a></span>
               </div>
          </div><!--close banner_bottom-->
     </div><!--close banner-->
     
     
     <div id="content">
     	  <div class="sectionmain">
          	   <div class="container">
               		<div class="row" id="bargrid">
                        <div class="col-sm-12 ">
                            <div class="locationinput">
                                <div class="inputnew"><input class="basic-slide" id="name" type="text" placeholder="Type your location... " />
                                <label for="name"><i class="fa fa-map-marker" aria-hidden="true"></i><span class="loc"></span>  Bars near you</label>
                                <div class="loc-dropdown" style="display:none;">
                                <option>The standard sportsbar</option>
                                <option>The standard sportsbar</option>
                                <option>The standard sportsbar</option>
                                <option>The standard sportsbar</option>
                                <option>The standard sportsbar</option>
                                </div>
                                
                                </div>
                            </div>
                        </div>
                      
                        <div class="col-sm-12">
                            <div class="filter" style="cursor:pointer;"><h4>Filter<img src="<?php echo base_url();?>images/drop.png" /></h4></div>
                            <div class="dropdown"><?php // print_r($allfacilities);?>
                              <form name="filter_bars" id="filter_bar" method="get" action="">
                                <div class="facil3">
                                   
                                    <?php /*foreach($allfacilities as $allfacilitie) {?>
                                    	<li><input id="checkbox<?php echo $allfacilitie['id'];?>" type="checkbox" name="checkbox" value="<?php echo $allfacilitie['id'];?>"  >
                                        <label for="checkbox<?php echo $allfacilitie['id'];?>"><span class="<?php echo $allfacilitie['icon'];?>"></span> <?php echo $allfacilitie['name'];?></label></li>
                                    <?php }*/?>
                                      <?php 
									  $sortarr=array();
									  if(isset($sortby) && is_array($sortby)){
									  foreach($sortby as $sort){
										  $sortarr[$sort]=$sort;
									  	}
										}
										  ?>  
                                    <ul>
                                        <li>
                                            <input id="checkbox1" class="filter_facil" <?php if((count($sortarr) > 0) && (isset($sortarr['1']))){?> checked="checked" <?php } ?> name="filteropt[]" value="1" type="checkbox">
                                            <label for="checkbox1">
                                            <span class="left-icon1"></span>
                                            Free Wifi
                                            </label>
                                        </li>
                                        <li>
                                            <input id="checkbox5" class="filter_facil" name="filteropt[]" <?php if((count($sortarr) > 0) && (isset($sortarr['5']))){?> checked="checked" <?php } ?>  value="5" type="checkbox">
                                            <label for="checkbox5">
                                            <span class="left-icon5"></span>
                                            Screen size S
                                            </label>
                                        </li>
                                         <li>
                                            <input id="checkbox7" class="filter_facil" <?php if((count($sortarr) > 0) && (isset($sortarr['7']))){?> checked="checked" <?php } ?>  name="filteropt[]" value="7" type="checkbox">
                                            <label for="checkbox7">
                                            <span class="left-icon7"></span>
                                            Screen size M
                                            </label>
                                        </li>
                                        <li>
                                            <input id="checkbox9" class="filter_facil" <?php if((count($sortarr) > 0) && (isset($sortarr['9']))){?> checked="checked" <?php } ?>  name="filteropt[]" value="9" type="checkbox">
                                            <label for="checkbox9">
                                            <span class="left-icon9"></span>
                                            Screen size L
                                            </label>
                                        </li>
                                        <li>
                                            <input id="checkbox12" class="filter_facil" <?php if((count($sortarr) > 0) && (isset($sortarr['12']))){?> checked="checked" <?php } ?>  name="filteropt[]" value="12" type="checkbox">
                                            <label for="checkbox12">
                                            <span class="left-icon12"></span>
                                            Alcohol
                                            </label>
                                        </li>
                                        <li>
                                            <input id="checkbox4" class="filter_facil" <?php if((count($sortarr) > 0) && (isset($sortarr['4']))){?> checked="checked" <?php } ?>  name="filteropt[]" value="4" type="checkbox">
                                            <label for="checkbox4">
                                            <span class="left-icon4"></span>
                                            Smoking zone
                                            </label>
                                        </li>
                                        <li>
                                            <input id="checkbox8" class="filter_facil" <?php if((count($sortarr) > 0) && (isset($sortarr['8']))){?> checked="checked" <?php } ?>  name="filteropt[]" value="8" type="checkbox">
                                            <label for="checkbox8">
                                            <span class="left-icon8"></span>
                                            Reservations
                                            </label>
                                        </li>
                                        <li>
                                            <input id="checkbox17" class="filter_facil" <?php if((count($sortarr) > 0) && (isset($sortarr['17']))){?> checked="checked" <?php } ?>  name="filteropt[]" value="17" type="checkbox">
                                            <label for="checkbox17">
                                            <span class="left-icon17"></span>
                                            Dart
                                            </label>
                                        </li>
                                        <li>
                                            <input id="checkbox15" class="filter_facil" <?php if((count($sortarr) > 0) && (isset($sortarr['15']))){?> checked="checked" <?php } ?>  name="filteropt[]" value="15" type="checkbox">
                                            <label for="checkbox15">
                                            <span class="left-icon15"></span>
                                            Pool
                                            </label>
                                        </li>
                                        <li>
                                            <input id="checkbox11" class="filter_facil" <?php if((count($sortarr) > 0) && (isset($sortarr['11']))){?> checked="checked" <?php } ?>  name="filteropt[]" value="11" type="checkbox">
                                            <label for="checkbox11">
                                            <span class="left-icon11"></span>
                                            Food
                                            </label>
                                        </li>
                                       <li>
                                            <input id="checkbox2" class="filter_facil" <?php if((count($sortarr) > 0) && (isset($sortarr['2']))){?> checked="checked" <?php } ?>  name="filteropt[]" value="2" type="checkbox">
                                            <label for="checkbox2">
                                            <span class="left-icon2"></span>
                                            Cash only
                                            </label>
                                        </li>
                                        <li>
                                            <input id="checkbox6" class="filter_facil" <?php if((count($sortarr) > 0) && (isset($sortarr['6']))){?> checked="checked" <?php } ?>  name="filteropt[]" value="6" type="checkbox">
                                            <label for="checkbox6">
                                            <span class="left-icon6"></span>
                                            Aircon
                                        </label>
                                        </li>
                                        <li>
                                            <input id="checkbox14" class="filter_facil" <?php if((count($sortarr) > 0) && (isset($sortarr['14']))){?> checked="checked" <?php } ?>  name="filteropt[]" value="14" type="checkbox">
                                            <label for="checkbox14">
                                            <span class="left-icon14"></span>
                                            Near public station
                                            </label>
                                        </li>
                                        <li>
                                            <input id="checkbox19" class="filter_facil" <?php if((count($sortarr) > 0) && (isset($sortarr['19']))){?> checked="checked" <?php } ?>  name="filteropt[]" value="19" type="checkbox">
                                            <label for="checkbox19">
                                            <span class="left-icon19"></span>
                                            Family friendly
                                            </label>
                                        </li>
                                    </ul>
                                </div> 
                                </form>
                            </div>
                        </div> 
				<?php 
				if(count($profiles) > 0){
					foreach($profiles as $profile){
						
				?>  
                        <div class="barlist col-xs-12 col-sm-4">
                            <div class="carbox">
                            	<a class="img-carbox" href="<?php echo base_url();?>promotion/bar/<?php echo $profile['id']?>">
                                    <div class="overlay">
                                    <img src="<?php echo base_url();?>images/bar-img-1.jpg" height="153" />
                                    <div class="title4" ><?php echo $profile['title']?></div>
                                    </div>
                           		</a>
                            <div class="carbox-content">
                                <h4 class="carbox-title">
                                    <a class="bar_title"  href="<?php echo base_url();?>promotion/bar/<?php echo $profile['id']?>" >
                                    <?php if(trim($profile['address']) !='') echo $profile['address'];
                                    else echo 'Address currently not available'?>
                                    <!--<br />
                                    <?php //echo $profile['zip']?> <?php echo $profile['city']?>-->
                                    </a>
                                <a href="http://maps.google.com/?q=<?php echo $profile['latitude'];?>,<?php echo $profile['longitude'];?>" target="_blank"><img src="<?php echo base_url();?>images/map.png" /> </a>
                                </h4>
                            	<p >
                                    <div class="col-md-12 post-header-line facil2 ">
                                    <?php //echo ($profile['facilities']);
                                    if($profile['facilities']){
                                    ?>  <ul>
                                    <?php
                                    $barfacilities = explode(',',$profile['facilities']);
                                    //print_r($barfacilities);
                                    $fac_count =0;
										foreach($barfacilities as $barfacility){
											if($fac_count>=6){break;}
												$barfac = explode('/',$barfacility);
												$facid = (int)trim($barfac[0]);
												$facval = trim($barfac[1]);
												if(count($sortarr) == 0){
												if(($facid ==3) || ($facid ==5) || ($facid ==7) || ($facid ==14) || ($facid ==4)|| ($facid ==19)){}
												else{
												?>
                                                    <li><span class="<?php echo $allfacilities[$facid]['icon']?>"></span><a href="#">
                                                    <?php echo $allfacilities[$facid]['name']?></a> </li>
                                                    <?php /*if($facval){?>
                                                    <li class="listtext"><input type="text" name="text" value="<?php echo $facval;?>"  disabled="disabled" /></li>
                                                    <?php }*/ ?>              
												<?php
												$fac_count++;
											}
												}
												else{
													?>
                                                     <li><span class="<?php echo $allfacilities[$facid]['icon']?>"></span><a href="#">
                                                    <?php echo $allfacilities[$facid]['name']?></a> </li>
                                                    <?php
												}
										
										}
                                    ?>
                                    </ul>
                                    <?php
                                    }
                                    ?>
                                    
                                    <!--<li><span class="left-icon1"></span><a href="#">Free Wifi</a> </li> 
                                    <li> <span class="left-icon13"></span><a href="#">Screen</a></li>
                                    <li><input name="text" value="" style="border: 1px solid #ccc;width: 25px;height: 25px; margin-right: 5px;" type="text"></li> 
                                    <li><span class="left-icon15"></span><a href="#">Pool</a> </li>
                                    <li><span class="left-icon9"></span><a href="#">Screen Size L</a></li>  
                                    <li> <span class="left-icon11"></span><a href="#">Food</a> </li>
                                    <li> <span class="left-icon17"></span><a href="#">Dart</a></li>-->
                                    </div>
                           		</p>
                            </div>
                            <div class="btn"><a href="<?php echo base_url();?>promotion/bar/<?php echo $profile['id']?>" class="detailbtn">Details ></a></div>
                            
                            </div>
                        </div>
				<?php 
					}
				}?>	
					
					<div class="col-sm-12 ">
					<div class="btn"><a href="javascript:;" id="loadmorebars" class="button3">Load More</a></div>
					</div>
                </div>
               </div><!--close container-->
          </div><!--close section1-->
          
        
          
          <div class="section5">
          	   <div class="container">
               		<span class="prev2"><a href="#">BARS</a></span>
                    <span class="next2"><a href="#">SPORTSLOVERS</a></span>
               </div>
          </div><!--close section5-->
     </div><!--close content-->
     
     
<?php $this->load->view('promotion/footer');?>
</div><!--close wrapper-->
<?php $this->load->view('promotion/footer_includes');?>
<script type="text/javascript">
$(document).ready(function () {
    size_li1 = $("#bargrid .barlist").size();
	//alert(size_li);
    x1=9;
		if(x1 >= size_li1){
			$('#loadmorebars').hide();
			$('#nomorebars').show();
		}
    $('#bargrid .barlist:lt('+x1+')').show();
    $('#loadmorebars').click(function () {
        x1= (x1+9 <= size_li1) ? x1+9 : size_li1;
        $('#bargrid .barlist:lt('+x1+')').slideDown(100);
		if(x1 >= size_li1){
			$('#loadmorebars').hide();
			$('#nomorebars').show();
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
    })
});
</script>
 <script type="text/javascript">
 $('document').ready(function() {
    $('.filter').click(function(){
		$('.dropdown').slideToggle("slow");
	});
	
	    $('.basic-slide').click(function(){
		$('.loc-dropdown').toggle("slow");
	});
});
 
 </script>       
<script type="text/javascript">  
       $('document').ready(function() {
         $('.filter_facil').on('change',function(){
            $('#filter_bar').submit();
            });
		<?php if(count($sortarr) > 0){
		?>
		$('.dropdown').show(); 
		<?php 
		}
		?>
        });
    </script>
</body>
</html>
