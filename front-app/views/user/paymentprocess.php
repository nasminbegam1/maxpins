
<div class="verify-container">
	<span style="color:#00349a;">
		<i class="fa fa-spinner fa-spin" style="font-size:80px;"></i>
		<br/>
		Please wait, you are redirecting to paypal interface for payment.
	</span>
</div>

<form id = "paypal_checkout" action="<?php echo $url ;?>" method="post">
		    <!--<input type="hidden" name="cmd" value="_xclick">-->
		    <input name = "cmd" value = "_cart" type = "hidden">
		    <input name = "upload" value = "1" type = "hidden">
		    <input name = "no_note" value = "0" type = "hidden">
		    <input name = "bn" value = "PP-BuyNowBF" type = "hidden">
		    <input name = "tax" value = "<?php echo $shipping_price; ?>" type = "hidden">
		    <input name = "rm" value = "2" type = "hidden">
		    <input type="hidden" name="business" value="<?php echo $business_email_id ?>" >
		    <input name = "handling_cart" value = "0" type = "hidden">
		    <input name = "discount_amount_cart" value = "<?php echo $discount; ?>" type = "hidden">
		    <?php foreach($items as $index=>$item){ ?>
		    <div id = "item_<?php echo $index ?>" class = "itemwrap">
					<input name = "item_name_<?php echo $index ?>" value = "<?php echo $item['item_name']; ; ?>" type = "hidden">
					<input name = "quantity_<?php echo $index ?>" value = "<?php echo $item['item_qty']; ; ?>" type = "hidden">
					<input name = "amount_<?php echo $index ?>" value = "<?php echo  number_format($item['item_price'],2); ; ?>" type = "hidden">
					<?php if($index==1){ ?>
					<input name = "shipping_1" value = "<?php echo number_format($shipping_price,2); ?>" type = "hidden">
					<?php }else{ ?>
					<input name = "shipping_<?php echo $index ?>" value = "0" type = "hidden">
					<?php } ?>
		    </div>
		    <?php } ?>
		    
		   
		    <input type="hidden" name="currency_code" value="USD">
		    <!--<input type="hidden" name="currency_code" value="TRY">-->
		    <!--<input type="hidden" name="undefined_quantity" value="1">-->
		    <input name = "return" value = "<?php echo $return_url ;?>" type = "hidden">
		    <input name = "cbt" value = "Return to My Site" type = "hidden">
		    <input name = "cancel_return" value = "<?php echo $cancel_url ; ?>" type = "hidden">
		    <input name = "custom" value = "<?php //echo $records['cart_id']?>" type = "hidden">
		    <input type="hidden" name="notify_url" value="<?php echo $notification_url ?>">
		    <input type="hidden" name="custom" value="<?php echo $wholesaler_id; ?>"> 
</form>			
			

<!-- END PAGE CONTENT -->
<script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
<script>

     
    $(document).ready(function() {   
  	
	$('#paypal_checkout').submit();

    });


</script>