<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    
    
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    
   
    <link href="<?php echo base_url();?>css/admin/style.css" rel="stylesheet">
    

  
    
</head>
<div style="background-color: white">
    <div class="invoice-box">
        <table cellpadding="0" cellspacing="0">
            <tr class="top">
                <td colspan="2">
                    <table>
                        <tr>
                            <td class="title1">
                                <img src="http://dev.sportshub365.com/images/logo.png" style="width:100%; max-width:180px;">
                            </td>
                            
                            <td>

                            <b><?php   $yrdata= strtotime($invoicedate);  echo date('F d, Y', $yrdata); ?></b><br>
                                Invoice #:  <?php echo 1000 + $invoiceid; ?><br>
                                
                              
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            
            <tr class="information">
                <td colspan="2">
                    <table>
                        <tr>
                            <td>
                                20-22 Wenlock Road, N1 7GU<br>
                                London, England<br>
                                info@sportshub365.com<br>
								www.sportshub365.com<br>
                                P: +44 208 705 0525
                            </td>
                            
                            <td style="width:200px;">
                               <span style="font-weight: bold;"> BILL TO </span> <br>


                                  <span class=""><?php echo $title;?></span> <br>
                                <?php echo nl2br($address);?>
                                <?php echo $estbemail;?>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            
            <!-- <tr class="heading">
                <td>
                    Payment Method
                </td>
                
                <td>
                    Transaction ID
                </td>
            </tr>
            
            <tr class="details">
                <td>
                    Stripe Online Payment

                </td>
                
                <td>
                     <?php //echo $subscription_id; ?>
                </td>
            </tr> -->
            
            <tr class="heading">
                <td>
                    Item
                </td>
                
                <td>
                    Price
                </td>
            </tr>
            
            <tr class="item">
                <td>
                    <?php if($subscription_plan == 'standard_monthly_plan') { echo "Monthly Subscription"; }elseif($subscription_plan == 'standard_yearly_plan') { echo "Yearly Premium subscription 50% discount"; }; ?>
                </td>
                
                <td>
                   &euro;<?php echo $subscription_amount/100; ?>
                </td>
            </tr>
            
            <tr class="item">
                <td>
                    &nbsp;
                </td>
                
                <td>
                    &nbsp;
                </td>
            </tr>
             <tr class="item">
                <td>
                    &nbsp;
                </td>
                
                <td>
                    &nbsp;
                </td>
            </tr>
             <tr class="item">
                <td>
                    &nbsp;
                </td>
                
                <td>
                    &nbsp;
                </td>
            </tr>
            
            <tr class="item last">
                <td>
                    &nbsp;
                </td>
                
                <td>
                    &nbsp;
                </td>
            </tr>
            
            <tr class="total">
                <td></td>
                
                <td>
                    Total &euro;<?php echo $subscription_amount/100; ?>
                </td>
            </tr>
        </table>
        <br><br>

        <p style="text-align: center;"> Thank you for your business!</p> 
        <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
    </div>
    </div>

</html>
