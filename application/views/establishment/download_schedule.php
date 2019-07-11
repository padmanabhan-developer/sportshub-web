<!DOCTYPE html>
<html lang="en">
  <body>
  <div class="wrapper">
   	<header id="headers">
        <div class="container">
           <div class="logo"><a href="#"><img src="<?php echo base_url();?>images/logo_email.png"></a></div>
        </div><!-- close container -->
    </header><!-- close header -->
    
   	<div id="content">
         <div class="container">
         	<h2 class="title6">Email: <?php echo $email; ?></h2>
            <h2 class="title6">Establishment Name: <?php echo $est_name; ?></h2>
            
            <div class="events">
                   <h2 class="title2">My TV schedule:</h2>
                    <div class="events-inner" id="show_fixture">
                        <div class="events-inner">
                     <input type="hidden" value="<?php echo $sport_id;?>" id="total_sport_ids" >
                              <?php if(count($fixture_list)>0)
                              {
                                ?>
                              <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table2">
                              <thead>
                              <tr>
                                <th>DATE</th>
                                <th>TIME </th>
                                <th>EVENT DESCRIPTION </th>
                                <th>Sports </th>
                                <th>Channels</th>
                              </tr>
                            
                             </thead>
                              <tbody>
                                <?php 
                                $k=0;
                                //echo count($fixture_list);
                               //print_r($fixture_list);
                                foreach($fixture_list as $fixture)
                                {
                                  $k++;
                                  ?>
                                
                                <tr>
                                  <td><?php echo $fixture['gmt_date_time'];?></td>
                                  <td><?php echo $fixture['local_time_form'];?></td>
                                  <?php if($fixture['team1'] === $fixture['team2']) {?>
                                  <td ><?php echo $fixture['team1'];?></td>
                                  <?php }else{?>
                                  <td><?php echo $fixture['team1'];?> <span class="vs">vs.</span>  <?php echo $fixture['team2'];?></td>
                                  <?php }?>
                                  <td><?php echo $fixture['sport_name'];?></td>
                                  <td><?php echo $fixture['channel_name'];?></td>
                                </tr>
                              <?php 
                            } 
                            ?>
                             
                              </tbody>                        
                             </table>
  <?php } 
  else echo "<p> No fixture available.</p>";?>

                   </div><!-- close account-history-inner -->
 </div> <!-- close events-inner -->
              </div><!-- close events -->
         </div><!-- close container -->
    </div><!-- close content -->
  </div><!--close wrapper-->
    <!-- common script-->
  </body>
</html>