<style>
	#paypal_form{
		left: 50%;
		margin-left: -100px;
		position: fixed;
		text-align: center;
		top: 50%;
		width: 200px;
	}
</style>
<div class="verify-container">
	<span style="color:#00349a;">
		<i class="fa fa-spinner fa-spin" style="font-size:80px;"></i>
		<br/>
		Please wait, you are redirecting to paypal interface for payment.
	</span>
</div>

<form id = "paypal_checkout" action="<?php echo $url;?>" method="post">
		    
<input name = "cmd" value = "_cart" type = "hidden">
<input name = "upload" value = "1" type = "hidden">
<input name = "no_note" value = "0" type = "hidden">
<input name = "bn" value = "PP-BuyNowBF" type = "hidden">
<input name = "tax" value = "<?php echo $shipping_price; ?>" type = "hidden">
<input name = "rm" value = "2" type = "hidden">
<input type="hidden" name="business" value="<?php echo $business_email_id; ?>" >
<input name = "handling_cart" value = "0" type = "hidden">
		    
<?php
for($i=0, $j=1;$i<count($arr_product);$i++,$j++)
{
?>
	<input name = "item_name_<?php echo $j ?>" value = "<?php echo $arr_product[$i]['product_name']; ?>" type = "hidden">
	<input name = "quantity_<?php echo $j ?>" value = "<?php echo $arr_product_qty[$i]; ?>" type = "hidden">
	<input name = "amount_<?php echo $j ?>" value = "<?php echo  number_format($arr_product_price[$i],2); ; ?>" type = "hidden">
	<?php if($i==1){ ?>
	<input name = "shipping_1" value = "<?php echo number_format($shipping_price,2); ?>" type = "hidden">
	<?php }else{ ?>
	<input name = "shipping_<?php echo $j ?>" value = "0" type = "hidden">
	<?php } ?>

<?php } ?>

<input type="hidden" name="currency_code" value="USD">
<input name = "return" value = "<?php echo $return_url ;?>" type = "hidden">
<input name = "cbt" value = "Return to My Site" type = "hidden">
<input name = "cancel_return" value = "<?php echo $cancel_url ; ?>" type = "hidden">
<input name = "custom" value = "<?php echo $temp_order_master_id;?>" type = "hidden">
<input type="hidden" name="notify_url" value="<?php echo $notification_url ?>"> 
</form>			
			

<!-- END PAGE CONTENT -->
<script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
<script>

     
    $(document).ready(function() {   
  	
	$('#paypal_checkout').submit();

    });


</script>