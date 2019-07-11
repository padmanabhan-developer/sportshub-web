<script type="text/javascript" src="<?php echo base_url();?>js/establishment/form_validation.js"></script>

<div class="offers">
               	 <h1>OFFERS</h1>
             <?php if($maxcount <3){?>
            <a href="javascript:void(0)" class="add-new-event" data-cta-target=".js-dialog1" id="popup2" title="Click here to Add" onclick="javascript:OpenAddOfferForm('<?php echo base_url();?>admin/','0');"><!--<a href="javascript:void(0)" title="Click here to edit" data-cta-target=".js-dialog" onclick="javascript:OpenAddOfferForm('<?php echo base_url();?>establishment/','0');">-->add offer</a>
       <div class="js-dialog1  modal  dialog" style="text-align: center;">
      <span class="modal-close-btn"></span>
     <div id="open_offer">
     <?php $this->load->view('admin/add-offer');?>
   </div>
    </div> <?php }?>
             	 <div class="offers">
              <?php 
			  $count= 1;
			  if($maxcount>0) {
			  foreach($all_offers as $offer)
              {
                ?>
                   <div class="offer <?php if($offer['isactive']=='0')   echo 'inactive';?>">
                      <h2 class="title">offer <?php echo $count;?>  <span class="<?php if($offer['isactive']=='1') echo 'active'; else echo 'inactive';?>-span"><?php if($offer['isactive']=='1') echo 'active'; else echo 'inactive';?>
                        
</span>
                      </h2>
                        <div class="offer-inner">
                           <div class="offer-row">
                                <div class="offer_left">
                                       <label>Title:</label>
                                       <input name="" type="text" class="offer-input1" value="<?php echo $offer['title'];?>" onfocus="if (this.value == '<?php echo $offer['title'];?>') {this.value = '';}" onblur="if (this.value == '') {this.value = '<?php echo $offer['title'];?>';}" disabled>
                                  </div>
                                  
                                  <div class="offer_right">
                                       <label>price / discount:</label>
                                       <input name="" type="text" class="offer-input2" value="<?php echo $offer['price_or_discount'];?>" onfocus="if (this.value == '<?php echo $offer['price_or_discount'];?>') {this.value = '';}" onblur="if (this.value == '') {this.value = '<?php echo $offer['price_or_discount'];?>';}" disabled>

                                  </div>
								<div class="offer_right">
                                       <label>promo code:</label>
                                       <input name="" type="text" class="offer-input2" value="<?php echo $offer['promo_code'];?>" onfocus="if (this.value == '<?php echo $offer['promo_code'];?>') {this.value = '';}" onblur="if (this.value == '') {this.value = '<?php echo $offer['promo_code'];?>';}" disabled>

                                  </div>


                             </div><!-- close offer-row -->
                             
                             <div class="offer-row">
                                <div class="offer_left">
                                       <label>description:</label>
                                       <input name="" type="text" class="offer-input3" value="<?php echo $offer['description'];?>" onfocus="if (this.value == '<?php echo $offer['description'];?>') {this.value = '';}" onblur="if (this.value == '') {this.value = '<?php echo $offer['description'];?>';}" disabled>
                                  </div>
                             </div>

<span style="float:right;">
                             <a href="javascript:void(0);" data-offerid="<?php echo $offer['id'];?>" style="padding-left:20px;" id="del-offer" class="del-cnfrm"> 
<img src="<?php echo base_url();?>images/delete-icon.png"></a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a href="javascript:void(0)" title="Click here to edit" data-cta-target=".js-dialog1" onclick="javascript:OpenAddOfferForm('<?php echo base_url();?>admin/','<?php echo $offer['id'];?>');">Edit</a>

</span>

<!-- close offer-row -->
                        </div><!-- close offer-inner -->
                   </div><!-- close offer -->
                   
                   <?php $count++;} 
			  }
				   ?>
                  
              </div>
              </div>
              