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
     <div id="banner51">
     	  <div class="layer">
          	   <div class="container">
                    	 <div class="slider_text5">
                         <h2><?php echo $profiledetails['title'];?></h2>
                         <br/>
                         <?php if(count($schedules) > 0){?>
                          <h4><span class="yellow"><?php echo $schedules[0]['team1'];?> vs. <?php echo $schedules[0]['team2'];?></span>
                         <br /><span class="yellow">
                         <?php echo $schedules[0]['date_time'];?>-<?php echo $schedules[0]['competition_name'];?></span></h4>
                         <?php } ?>
                    </div>
               </div>
          </div>
           <!-- add section start-->
              <div class="add"><script type="text/javascript" src="http://sportshub365.com/spotway/adb.php?tag=48057065d9be7478543&width=728&height=90"></script></div>
           <!-- add section end-->
          <div class="banner_bottom">
          	   <div class="container">
               		<span class="prev"><a href="<?php echo base_url();?>venue">BARS</a></span>
                    <span class="next"><a href="<?php echo base_url();?>sportsfans">SPORTS LOVERS</a></span>
               </div>
          </div><!--close banner_bottom-->
     </div><!--close banner-->
     
     <div id="content">
     <div class="section8">
          	   <div class="container">
               		<div class="address1">
                    	 <h4>ADDRESS</h4>
                         <p>
						<?php if(isset($profiledetails['address']))echo $profiledetails['address'];?><br/>
                        <?php if(isset($profiledetails['city']))echo $profiledetails['city'].",";?><br/>
                        <?php if(isset($profiledetails['zip']))echo $profiledetails['zip'];?><br/>
                        </p>
						<?php if(isset($profiledetails['geo_lat']) && isset($profiledetails['geo_lang'])){ ?>
                         <a href="http://maps.google.com/?q=<?php echo $profiledetails['geo_lat'];?>,<?php echo $profiledetails['geo_lang'];?>" target="_blank"><span class="yellow1">GET DIRECTIONS></span>
                         </a>
                         <?php } ?>
                    </div>
                    
                    <div class="address2">
                    <h4>ABOUT</h4>
                    <?php //print_r($profiledetails);?>
                    <?php if(isset($profiledetails['short_description'])){?>
                    <p>"<?php echo $profiledetails['short_description'];?>"</p>
                    <?php } 
					else{
						?>
                    
                    <p>"At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti 
                    atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique 
                    sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum 
                    facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit 
                    quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. 
                    Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates 
                    repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut 
                    reiciendis voluptatibus maiores”. </p>
				<?php } ?>

                    <h4>Contact </h4>
                    <p>Phone:           +45 33456787<br/>
                    Mail:                info@thestandardsportsbar.com <br/>
                    Website:       www.thestandardsportsbar.com</p>
                    </div>
               </div><!--close container-->
          </div>
     
     


     
        <div class="section7">
            <div class="container" id="barmatches">
            	<h2>UPCOMING FIXTURES</h2>
                <div class="sec_menu">
                <?php $today =  date('Y-m-d',time());
				$tomorrow = date("Y-m-d", strtotime("+1 day"));
				$third = date("Y-m-d", strtotime("+2 days"));
				$fourth = date("Y-m-d", strtotime("+3 days"));
				$fifth = date("Y-m-d", strtotime("+4 days"));
				$sixth = date("Y-m-d", strtotime("+5 days"));
				$seventh = date("Y-m-d", strtotime("+6 days"));
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
                    <div class="blog blogtab1" >
                        <div class="blog-4">
                            <h4><?php echo $schedule['sport_name'];?></h4>
                            <p><?php echo $schedule['competition_name'];?></p>
                        </div>
                        <div class="blog-8">
                            <span class="yellow"><?php echo $schedule['team1'];?>   vs.   <?php echo $schedule['team2'];?></span>
                            <p><?php echo $schedule['date_time'];?></p>
                        </div>
                        <div class="blog-41"><a href="#">MORE ></a></div>
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
					if($schedule['dateonly'] == $today){
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
                        <div class="blog-41"><a href="#">MORE ></a></div>
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
					if($schedule['dateonly'] == $tomorrow){
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
                        <div class="blog-41"><a href="#">MORE ></a></div>
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
					if($schedule['dateonly'] == $third){
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
                        <div class="blog-41"><a href="#">MORE ></a></div>
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
					if($schedule['dateonly'] == $fourth){
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
                        <div class="blog-41"><a href="#">MORE ></a></div>
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
					if($schedule['dateonly'] == $fifth){
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
                        <div class="blog-41"><a href="#">MORE ></a></div>
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
					if($schedule['dateonly'] == $sixth){
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
                        <div class="blog-41"><a href="#">MORE ></a></div>
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
					if($schedule['dateonly'] == $seventh){
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
                        <div class="blog-41"><a href="#">MORE ></a></div>
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
     
     <?php //print_r($happyhours); ?>
        <div class="section8 sec_hours">
            <div class="container">
                <div class="facil">
                    <h4>Facilities</h4>
                    <ul>
						<?php foreach($facilities as $facility){?>
                            <li><span class="<?php echo $facility['icon'];?>"></span> <?php echo $facility['name'];?>
                            </li>
                            <?php if(($facility['type']=='text') && ($facility['type']!='')){?>
                            	<li class="listtext"><input type="text" name="text" value="<?php echo $facility['value'];?>"  disabled="disabled" /></li>
                            <?php }?>
                        <?php }?>
                    </ul>
                </div> 
            
                <div class="address1">                  
                   <h4> Opening hours</h4>
                    <?php 
						foreach($openinghours as $openinghour){?>                    
						<?php
							if(($openinghour['from_time'] !='') && ($openinghour['to_time'] !='')){
							?>
							<li> 
								<div class="days"><?php echo substr($openinghour['name'],0,3);?>:</div>
                                <div class="days"><?php echo $openinghour['from_time'];?> - <?php echo $openinghour['to_time'];?></div>
							</li>
							<?php
							}?>
                    <?php 
						}?>
                </div>

                <div class="address2">
                    <h4>Happy hours</h4>
                    <?php foreach($happyhours as $happyhour){?>                    
						<?php
                        if(($happyhour['from_time'] !='') && ($happyhour['to_time'] !='') && ($happyhour['is_active']==1)){
                        ?>
                        <li> 
							<div class="days"><?php echo substr($happyhour['name'],0,3);?>:</div>
                            <div class="days"><?php echo $happyhour['from_time'];?> - <?php echo $happyhour['to_time'];?> </div>
                        </li>
                        <?php }?>
                    <?php }?>
                </div>                  
            </div><!--close container-->
        </div><!--close section1-->
        <div class="section9">
            <div class="container">
            <?php //print_r($offers);?>
                <div class="address1">
                	<h4>offers</h4>
					<?php foreach($offers as $offer){?>
                    <h3><span class="yellow"><?php echo $offer['title'];?></span> </h3>
                    <p>- <?php echo $offer['description']?></p>
                    <?php } ?>
                </div>
                <div class="address2">
                    <h4>Events</h4>
                    <?php foreach($events as $event){?>
                    <h3><span class="yellow"><?php echo $event['title'];?></span> </h3>
                    <p>- The <?php echo $event['date']?> at <?php echo $event['time']?></p>
                    <?php } ?>
                </div>
            
            </div><!--close container-->
        </div><!--close section7-->
     
     <div class="section5">
          	   <div class="container">
               		<span class="prev2"><a href="<?php echo base_url();?>venue">VENUES</a></span>
                    <span class="next2"><a href="<?php echo base_url();?>sportsfans">Sports Fans</a></span>
               </div>
          </div>
     </div><!--close content-->
     
<?php $this->load->view('promotion/footer');?>
</div><!--close wrapper-->
<?php $this->load->view('promotion/footer_includes');?>
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
    })
});
</script>
</body>
</html>
