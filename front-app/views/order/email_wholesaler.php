Hello <?php echo $wholesaler_info['wholesaler_name'];?>,<br/><br/>
<em>Your order from Maxpins has been received.  Please see the order detail below</em><br/><br/>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td align="left" valign="top" style="padding-bottom:20px;">
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td colspan="3" align="left" valign="top" width="45%" style="padding-bottom:20px;">
				<font size="2" color="#333333" face="Arial, Helvetica, sans-serif"><strong><?php echo nl2br(stripslashes($setting['sitesettings_value']));?></strong></font>
				<br/><br/><br/>
				<font size="2" color="#333333" face="Arial, Helvetica, sans-serif"><strong>Invoice : # MX-<?php echo $data['id'];  ?></strong></font>
				<br/>
			<font size="2" color="#333333" face="Arial, Helvetica, sans-serif"><strong>Order Date : <?php echo date('m-d-Y',strtotime($data['added_on']));  ?></strong></font><br>
			</td>
			<!--<td colspan="3" align="right"> <img src="http://maxpins.com/images/logo.jpg" alt="logo" class="logo-default" width="414" height="100"></td>-->
		</tr>
				<tr>
					<td align="left" valign="top" width="45%">
						<font size="2" color="#333333" face="Arial, Helvetica, sans-serif"><strong>Wholesaler Name:</strong> <?php echo $wholesaler_info['wholesaler_name'];?></font><br />
						<font size="2" color="#333333" face="Arial, Helvetica, sans-serif"><strong>Wholesaler No#:</strong> <?php echo $wholesaler_info['wholesaler_customer_id'];?></font><br />
						<table><tr>
						<td width="30%">
						<font size="2" color="#333333" face="Arial, Helvetica, sans-serif"><strong>Billing Address:</strong></font></td><td><font size="2" color="#333333" face="Arial, Helvetica, sans-serif"><?php echo $wholesaler_info['wholesaler_billing_address'].'<br/>'.$wholesaler_info['wholesaler_billing_city'].', '.$wholesaler_info['wholesaler_billing_state'].' '.$wholesaler_info['wholesaler_billing_zip'].'<br/>'.$wholesaler_info['billing_country_name'];?></font></td>
						</tr></table>
						<table><tr>
						<td width="30%">
						<font size="2" color="#333333" face="Arial, Helvetica, sans-serif"><strong>Shipping Address:</strong></font></td><td><font size="2" color="#333333" face="Arial, Helvetica, sans-serif"><?php echo $wholesaler_info['wholesaler_shipping_address'].'<br/>'.$wholesaler_info['wholesaler_shipping_city'].', '.$wholesaler_info['wholesaler_shipping_state'].' '.$wholesaler_info['wholesaler_shipping_zip'].'<br/>'.$wholesaler_info['shipping_country_name'];?></font></td>
						</tr></table>
						<font size="2" color="#333333" face="Arial, Helvetica, sans-serif"><strong>Email:</strong> <?php echo $wholesaler_info['wholesaler_email'];?></font><br />
						<font size="2" color="#333333" face="Arial, Helvetica, sans-serif"><strong>Phone:</strong> <?php echo $wholesaler_info['wholesaler_phone'];?></font><br /></td>
					<td align="left" valign="top" width="30%"><font size="2.5" color="#333333" face="Arial, Helvetica, sans-serif">
						<font size="2" color="#333333" face="Arial, Helvetica, sans-serif"><strong>Payment Amout:</strong> $<?php echo number_format($data['total_price'],2);?></font><br />
						<font size="2" color="#333333" face="Arial, Helvetica, sans-serif"><strong>Transaction ID:</strong> <?php echo $data['transaction_id'];?></font><br />
						<font size="2" color="#333333" face="Arial, Helvetica, sans-serif"><strong>Payment Status:</strong> <?php echo ($data['payment_status'] == 'Success')? 'Paid':$data['payment_status'];?></font><br /></td>
					<td align="left" valign="top" width="25%">
						<font size="2" color="#333333" face="Arial, Helvetica, sans-serif"><strong>Order Status:</strong> <?php echo $data['shipping_status'];?></font><br />
						<font size="2" color="#333333" face="Arial, Helvetica, sans-serif"><strong>Shipping Method:</strong> <?php echo $data['shipping_method'];?></font><br />
						<font size="2" color="#333333" face="Arial, Helvetica, sans-serif"><strong>Shipping Cost:</strong> $<?php echo number_format($data['shipping_cost'],2);?></font><br /></td>
				</tr>
			</table></td>
	</tr>
	<tr>
		<td align="left" valign="top" style="padding-bottom:20px;"><font size="2.5" color="#333333" face="Arial, Helvetica, sans-serif"><strong>Product Details:</strong></font><br /></td>
	</tr>
	<tr>
		<td><table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<th align="left" valign="middle" width="5%" align="left" valign="top" scope="col"><font size="2" color="#333333" face="Arial, Helvetica, sans-serif"><strong>#</strong></font></th>
		<th align="left" valign="middle" width="23%" align="left" valign="top" scope="col"><font size="2" color="#333333" face="Arial, Helvetica, sans-serif"><strong>Product Name</strong></font></th>
		<th align="left" valign="middle" width="19%" align="left" valign="top" scope="col"><font size="2" color="#333333" face="Arial, Helvetica, sans-serif"><strong>Product SKU</strong></font></th>
		<th align="left" valign="middle" width="19%" align="left" valign="top" scope="col"><font size="2" color="#333333" face="Arial, Helvetica, sans-serif"><strong>Quantity</strong></font></th>
		<th align="left" valign="middle" width="19%" align="left" valign="top" scope="col"><font size="2" color="#333333" face="Arial, Helvetica, sans-serif"><strong>Unit Cost</strong></font></th>
		<th align="left" valign="middle" width="15%" align="left" valign="top" scope="col"><font size="2" color="#333333" face="Arial, Helvetica, sans-serif"><strong>Total</strong></font></th>
	</tr>
	<tr>
		<td colspan="7"><hr /></td>
	</tr>
	<?php
          $i=0;
	  $sub_total = 0;$total_qty = 0;
          foreach($order_details as $val){
          $i+=1;
	  $sub_total	= $sub_total + $val['total_price'];
	  $total_qty 	+= $val['product_quantity'];
            ?>
				<tr>
					<td align="left" valign="middle" width="5%"  valign="top"><font size="2" color="#333333" face="Arial, Helvetica, sans-serif"><?php echo $i;?></font></td>
					<td align="left" valign="middle" width="23%"  valign="top"><font size="2" color="#333333" face="Arial, Helvetica, sans-serif"><?php echo $val['product_name'];?></font></td>
					<td align="left" valign="middle" width="19%" valign="top"><font size="2" color="#333333" face="Arial, Helvetica, sans-serif"><?php echo $val['product_sku'];?></font></td>
					<td align="left" valign="middle" width="19%" valign="top"><font size="2" color="#333333" face="Arial, Helvetica, sans-serif"><?php echo $val['product_quantity'];?></font></td>
					<td align="left" valign="middle" width="19%"  valign="top"><font size="2" color="#333333" face="Arial, Helvetica, sans-serif">$<?php echo number_format($val['product_price'],2);?></font></td>
					<td align="left" valign="middle" width="15%"  valign="top"><font size="2" color="#333333" face="Arial, Helvetica, sans-serif">$<?php echo number_format($val['total_price'],2);?></font></td>
				</tr>
				<?php } ?>
				<tr>
					<td colspan="6"><hr></td>
				</tr>
				<tr>
					<td width="5%">&nbsp;</td>
					<td width="23%">&nbsp;</td>
					<td width="19%" align="right" valign="top"><font size="2" color="#333333" face="Arial, Helvetica, sans-serif"><strong>Total Qty</strong></font></td>
					<td width="19%" align="center" valign="top"><font size="2" color="#333333" face="Arial, Helvetica, sans-serif"><strong><?php echo $total_qty ;?></strong></font></td>
					<td width="19%" valign="middle"  align="right" valign="top"><font size="2" color="#333333" face="Arial, Helvetica, sans-serif"><strong>Total</strong></font></td>					
					<td width="15%" valign="middle" align="center" valign="top"><font size="2" color="#333333" face="Arial, Helvetica, sans-serif"><strong>$<?php echo number_format($sub_total,2);?></strong></font></td>
				</tr>
				<tr>
					<td colspan="5" width="85%" valign="middle" align="right" valign="top"><font size="2" color="#333333" face="Arial, Helvetica, sans-serif"><strong>Shipping</strong></font></td>
					
					<td colspan="1" width="15%" valign="middle"  align="center" valign="top"><font size="2" color="#333333" face="Arial, Helvetica, sans-serif"><strong>$<?php echo number_format($data['shipping_cost'],2);?></strong></font></td>
				</tr>
				<!--<tr>
					<td colspan="4" width="70%" valign="middle"  align="right" valign="top"><font size="2" color="#333333" face="Arial, Helvetica, sans-serif"><strong>Sub Total</strong></font></td>
					
					<td colspan="2"  valign="middle"  align="center" valign="top"><font size="2" color="#333333" face="Arial, Helvetica, sans-serif"><strong>$<?php echo number_format(($sub_total+$data['shipping_cost']),2);?></strong></font></td>
				</tr>-->
				<?php if($data['discount']> 0){ ?>
				<tr> 
					<td colspan="5" width="85%" valign="middle"  align="right" valign="top"><font size="2" color="#333333" face="Arial, Helvetica, sans-serif"><strong>Discount</strong></font></td>
					
					<td colspan="1" width="15%" valign="middle"  align="center" valign="top"><font size="2" color="#333333" face="Arial, Helvetica, sans-serif"><strong>$<?php echo number_format($data['discount'],2);?></strong></font></td>
				</tr>
				<?php } ?>
				<tr>
					<td colspan="5" width="85%" valign="middle"  align="right" valign="top"><font size="2" color="#333333" face="Arial, Helvetica, sans-serif"><strong>Order Total</strong></font></td>
					
					<td colspan="1" width="15%" valign="middle"  align="center" valign="top"><font size="2" color="#333333" face="Arial, Helvetica, sans-serif"><strong>$<?php echo number_format($data['total_price'],2);?></strong></font></td>
				</tr>
			</table></td>
	</tr>
</table>