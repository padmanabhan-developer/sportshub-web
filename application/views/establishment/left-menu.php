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
                        <a target="_blank" href="http://liveonsat.com">
	                        <i class="menu-icon-los"></i> <span>Liveonsat mode</span> 
                        </a>
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
                      <a href="<?php echo base_url();?>establishment/terms_conditions">
                        <i class="menu-icon111"></i> <span>Terms of use</span> 
                      </a>
                    </li>
                    <li class="treeview">
                      <a href="<?php echo base_url();?>establishment/privacy_terms_conditions">
                        <i class="menu-icon112"></i> <span>Privacy T & C</span> 
                      </a>
                    </li>
                    <li class="treeview">
                      <a href="<?php echo base_url();?>establishment/logout">
                        <i class="menu-icon-logout"></i> <span>Logout</span> 
                      </a>
                    </li> 
                      <li class="treeview">
                        <center>

                          <!-- /32361281/DFP_BEHRENTZ_SPORTSHUB_300X250_1 -->
                          <div id='div-gpt-ad-1505826037322-3' style='height:250px; width:300px;'>
                          <script>
                          googletag.cmd.push(function() { googletag.display('div-gpt-ad-1505826037322-3'); });
                          </script>
                          </div>
                        </center>
                    </li>

                    </ul>
            <!--<div class="add_3"><script type="text/javascript" src="http://sportshub365.com/spotway/adb.php?tag=2525706606b05550842&width=250&height=250"></script></div>--> 
      </section>
</aside>
