    <aside class="main-sidebar">
        <section class="sidebar">
         <ul class="sidebar-menu">
         <?php 
            $profilelevel = 1+$this->session->userdata('profile_step1')+ $this->session->userdata('profile_step2')+$this->session->userdata('profile_step3')+$this->session->userdata('profile_step4')+$this->session->userdata('profile_step5');
            $schedule_level = $this->session->userdata('schedule_step1') + $this->session->userdata('schedule_step2')+ $this->session->userdata('schedule_step3')
          ?>
                    <!--<li class="header">MAIN NAVIGATION</li>-->
                    <li class="treeview">
                      <a href="<?php echo base_url();?>establishment/home">
                        <i class="menu-icon1"></i> <span>Home</span> 
                      </a>
                    </li>
                    <li class="treeview active">
                      <a href="<?php echo base_url();?>establishment/profile_settings">
                        <img src="<?php echo base_url();?>/Sample/images/pro.jpg" style="margin-left: -15px;"> <span>Setup guide</span> 
                      </a>
                      <ul class="treeview-menu menu-open" style="margin-top: -25px">
                        <li><a href="<?php echo base_url();?>establishment/profile_settings"></i> - Profile settings  <img src="<?php echo base_url();?>/images/plevel<?php echo $profilelevel; ?>.png" /></a></li>
                        <li><a href="<?php echo base_url();?>establishment/tv_provider_channel"></i>- Schedule <img src="<?php echo base_url();?>/images/clevel<?php echo $schedule_level; ?>.png" /></a></li>
                      </ul>
                    </li>
                    <li class="treeview">
                      <a href="<?php echo base_url();?>establishment/profile_settings">
                        <i class="menu-icon2"></i><span>Profile settings</span> 
                      </a>
                    </li>
                    <li class="treeview">
                      <a href="<?php echo base_url();?>establishment/schedule">
                        <i class="menu-icon3"></i> <span>Schedule</span> 
                      </a>
                      <ul class="treeview-menu" style="display:<?php if(isset($active_schedule) && $active_schedule=='on'){ echo 'block';} else{echo 'none';}?>">
                        <li><a href="<?php echo base_url();?>establishment/tv_provider_channel"></i> - TV Providers & Channels</a></li>
                        <li><a href="<?php echo base_url();?>establishment/gotoschedule"></i>- All schedule</a></li>
                        <li><a href="<?php echo base_url();?>establishment/goto_my_tv_schedule"></i> - My tv schedule</a></li>
                      </ul>
                    </li>
                      <li class="treeview">
                      <a href="<?php echo base_url();?>establishment/events">
                        <i class="menu-icon4"></i> <span>Events</span> 
                      </a>
                    </li>
                    <li class="treeview">
                      <a href="<?php echo base_url();?>establishment/offers">
                        <i class="menu-icon5"></i> <span>Offers</span> 
                      </a>
                    </li>
                    <li class="treeview">
                      <a href="<?php echo base_url();?>establishment/logout">
                        <i class="menu-icon6"></i> <span>Logout</span> 
                      </a>
                    </li> 
                    <li class="treeview">
                        <center>
                        <?php 
                        $ad_random = rand(1,10);
                        ?>
                        <!--<a href="javascript:;"><img src="<?php echo base_url();?>/images/ads/300_250_<?php echo $ad_random?>.jpg"></a>-->
                        <!-- SH365_MRectangle -->
                        <ins class="adsbygoogle"
                             style="display:inline-block;width:300px;height:250px"
                             data-ad-client="ca-pub-9427943540446316"
                             data-ad-slot="5455797238"></ins>
                        <script>
                        (adsbygoogle = window.adsbygoogle || []).push({});
                        </script>
                        </center>
                    </li> 
                    </ul>
            <!--<div class="add_3"><script type="text/javascript" src="http://sportshub365.com/spotway/adb.php?tag=2525706606b05550842&width=250&height=250"></script></div>--> 
      </section>
</aside>
