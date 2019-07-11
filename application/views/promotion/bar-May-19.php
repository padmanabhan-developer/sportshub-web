<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Sportshub</title>
<!--navigation-->
<?php $this->load->view('promotion/head');?>
<?php $this->load->view('promotion/google_analytics');?>
</head>

<body> 

<div id="wrapper">
<?php $this->load->view('promotion/header');?>	 
     <?php //print_r($happyhours)?>
     <div id="banner4">
     	  <div class="layer">
          	   <div class="container">
                    	 <div class="slider_text5">
                         <h2><?php echo $profiledetails['title'];?></h2>
                         <br/>
                          <h4><span class="yellow">MAN UNT vs. SWANSEE
                         <br />
                         12.00-30..4.2017-ENGLISH PREMIERE LEAGUE</span></h4>
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
            <div class="container">
            	<h2>UPCOMING FIXTURES</h2>
                <div class="sec_menu">
                    <ul>
                        <li>ALL</li>
                        <li>TODAY</li>
                        <li>TOMORROW</li>
                        <li>MON 01.</li>
                        <li>TUE 02.</li>
                        <li>WED 03.</li>
                        <li>THU 03.</li>
                        <li>THU 03.</li>
                    </ul>
                </div>
                <?php //print_r($schedules);?>
                
                <?php 
				$count =1;
				foreach($schedules as $schedule){
					if($count==5)break;
				?>
                <div class="blog">
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
                
            <!--<h2>get the app - <span class="yellow">works on both iphone, ipad &amp; android</span> </h2>-->
                <div class="col-12">
                    <div class="box_center">
                        <a href="#" class="button">LOAD MORE</a>
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
</body>
</html>
