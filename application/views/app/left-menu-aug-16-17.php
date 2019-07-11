   <aside class="main-sidebar"> 
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar" style="height: auto;"> 
        <ul class="sidebar-menu">
            <!--<li class="header">MAIN NAVIGATION</li>-->
            <li class="treeview">
            <a href="<?php echo base_url();?>app/home">
            <i class="menu-icon1"></i> <span>Home</span> 
            </a>
            </li>
            <li class="treeview">
            <a href="<?php echo base_url();?>app/profile_setting">
            <i class="menu-icon2"></i> <span>Profile settings</span> 
            </a>
            </li>
            
            <li class="treeview">
            <a href="<?php echo base_url();?>establishment/schedule">
            <i class="menu-icon3"></i> <span>Schedule</span> 
            </a>
            <ul class="treeview-menu" style="display:<?php if(isset($active_schedule) && $active_schedule=='on'){ echo 'block';} else{echo 'none';}?>">
            <li><a href="<?php echo base_url();?>app/tv_provider_channel"></i> - TV Providers & Channels</a></li>
            <li><a href="<?php echo base_url();?>app/schedule"></i>- My tv schedule</a></li>
            <!--<li><a href="<?php echo base_url();?>app/goto_my_tv_schedule"></i> - My tv schedule</a></li>-->
            </ul>
            </li>
            
            <!--<li class="treeview">
            <a href="<?php echo base_url();?>establishment/events">
            <i class="menu-icon4"></i> <span>Events</span> 
            </a>
            </li>
            
            <li class="treeview">
            <a href="<?php echo base_url();?>establishment/offers">
            <i class="menu-icon5"></i> <span>Offers</span> 
            </a>
            </li>-->
            
            <li class="treeview">
            <a href="<?php echo base_url();?>app/logout">
            <i class="menu-icon6"></i> <span>Logout</span> 
            </a>
            </li>  
            <li class="treeview">
            <center>
            <?php 
            $ad_random = rand(1,10);
            ?>
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
<!--           <div class="add_3"><script type="text/javascript" src="http://sportshub365.com/spotway/adb.php?tag=396570660d97abe7427&width=250&height=250"></script></div> 
-->               </section>
    <!-- /.sidebar --> 
  </aside>
