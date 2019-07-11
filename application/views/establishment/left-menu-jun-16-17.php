 <ul class="sidebar-menu">
            <!--<li class="header">MAIN NAVIGATION</li>-->
            <li class="treeview">
              <a href="<?php echo base_url();?>establishment/home">
                <i class="menu-icon1"></i> <span>Home</span> 
              </a>
            </li>
            <li class="treeview active">
              <a href="<?php echo base_url();?>establishment/profile_settings">
                <img src="/Sample/images/pro.jpg" style="margin-left: -15px;"> <span>Setup guide</span> 
              </a>
              <ul class="treeview-menu menu-open" style="margin-top: -25px">
                <li><a href="<?php echo base_url();?>establishment/profile_settings"></i> - Profile settings</a></li>
                <li><a href="<?php echo base_url();?>establishment/tv_provider_channel"></i>- Schedule</a></li>
              </ul>
            </li>
            <li class="treeview">
              <a href="<?php echo base_url();?>establishment/profile_settings">
                <i class="menu-icon2"></i> <span>Profile settings</span> 
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
              <img src="/Sample/images/ses.jpg">
			</center>
            </li> 
            </ul>
            <div class="add_3"><script type="text/javascript" src="http://sportshub365.com/spotway/adb.php?tag=2525706606b05550842&width=250&height=250"></script></div> 