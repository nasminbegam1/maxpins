<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td align="left"><img src="images/MaxPins.png" alt="logo" class="logo-default" width="414" height="100"> <br/><br/>
            <font size="8" color="#333333" face="Arial, Helvetica, sans-serif"><strong><?php echo nl2br(stripslashes($setting['sitesettings_value']));?></strong></font></td>
          <td align="right" valign="top" width="45%"><font size="9" color="#333333" face="Arial, Helvetica, sans-serif"><strong>Invoice : # MX-<?php echo $data['id'];  ?></strong></font><br>
            <font size="9" color="#333333" face="Arial, Helvetica, sans-serif"><strong>Order Date : <?php echo date('m-d-Y',strtotime($data['added_on']));  ?></strong></font></td>
        </tr>
        <tr><td></td></tr>
        <tr>
          <td align="left" valign="top" colspan="2" style="padding:0;margin:0;"><table style="padding:0;margin:0;" width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td align="left" valign="top" style="padding:0;margin:0;"><table width="100%" cellpadding="0" cellspacing="0">
                    <tr>
                      <td colspan="2" align="left" valign="top" style="padding:0;margin:0;"><font size="9" color="#333333" face="Arial, Helvetica, sans-serif"><strong>Wholesaler Information:</strong></font></td>
                    </tr>
                    <tr>
                      <td align="left" valign="top" style="padding:0;margin:0;"><font size="7" color="#333333" face="Arial, Helvetica, sans-serif"><strong>Wholesaler Name:</strong> </font></td>
                      <td align="left" valign="top" style="padding:0;margin:0;"><font size="7" color="#333333" face="Arial, Helvetica, sans-serif"><?php echo $data['wholesaler_name'];?></font></td>
                    </tr>
                    <tr>
                      <td align="left" valign="top" style="padding:0;margin:0;"><font size="7" color="#333333" face="Arial, Helvetica, sans-serif"><strong>Payment Amount:</strong> </font></td>
                      <td align="left" valign="top" style="padding:0;margin:0;"><font size="7" color="#333333" face="Arial, Helvetica, sans-serif">$<?php echo number_format($data['total_price'],2);?></font></td>
                    </tr>
                    <tr>
                      <td align="left" valign="top" style="padding:0;margin:0;"><font size="7" color="#333333" face="Arial, Helvetica, sans-serif"><strong>Billing Address:</strong></font></td>
                      <td align="left" valign="top" style="padding:0;margin:0;"><font size="7" color="#333333" face="Arial, Helvetica, sans-serif"><?php echo $data['wholesaler_billing_address'].'<br/><br/>'.$data['wholesaler_billing_city'].', '.$data['wholesaler_billing_state'].' '.$data['wholesaler_billing_zip'].'<br/><br/>'.$data['billing_country_name'];?></font></td>
                    </tr>
                  </table></td>
                <td align="left" valign="top" style="padding:0;margin:0;"><table width="100%" cellpadding="0" cellspacing="0">
                    <tr>
                      <td colspan="2" align="left" valign="top"><font size="9" color="#333333" face="Arial, Helvetica, sans-serif"><strong>Payment Details:</strong></font></td>
                    </tr>
                    <tr>
                      <td align="left" valign="top"><font size="7" color="#333333" face="Arial, Helvetica, sans-serif"><strong>Payment Amount:</strong></font></td>
                      <td align="left" valign="top"><font size="7" color="#333333" face="Arial, Helvetica, sans-serif">$<?php echo number_format($data['total_price'],2);?></font></td>
                    </tr>
                    <tr>
                      <td align="left" valign="top"><font size="7" color="#333333" face="Arial, Helvetica, sans-serif"><strong>Payment Status:</strong></font></td>
                      <td align="left" valign="top"><font size="7" color="#333333" face="Arial, Helvetica, sans-serif"><?php echo ($data['payment_status']=='Success')? 'Paid':$data['payment_status'];?></font></td>
                    </tr>
                  </table></td>
                <td align="left" valign="top" style="padding:0;margin:0;"><table width="100%" cellpadding="0" cellspacing="0">
                    <tr>
                      <td colspan="2" align="left" valign="top"><font size="9" color="#333333" face="Arial, Helvetica, sans-serif"><strong>Shipping Details:</strong></font></td>
                    </tr>
                    <tr>
                      <td align="left" valign="top"><font size="7" color="#333333" face="Arial, Helvetica, sans-serif"><strong>Order Status:</strong></font></td>
                      <td align="left" valign="top"><font size="7" color="#333333" face="Arial, Helvetica, sans-serif"><?php echo $data['shipping_status'];?></font></td>
                    </tr>
                    <tr>
                      <td align="left" valign="top"><font size="7" color="#333333" face="Arial, Helvetica, sans-serif"><strong>Shipping Method:</strong></font></td>
                      <td align="left" valign="top"><font size="7" color="#333333" face="Arial, Helvetica, sans-serif"><?php echo $data['shipping_method'];?></font></td>
                    </tr>
                    <tr>
                      <td align="left" valign="top"><font size="7" color="#333333" face="Arial, Helvetica, sans-serif"><strong>Shipping Cost:</strong></font></td>
                      <td align="left" valign="top"><font size="7" color="#333333" face="Arial, Helvetica, sans-serif">$<?php echo number_format($data['shipping_cost'],2);?></font></td>
                    </tr>
                  </table></td>
              </tr>
            </table></td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td align="left" valign="top"><font size="7" color="#333333" face="Arial, Helvetica, sans-serif"><strong>Product Details:</strong></font></td>
  </tr>
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="5%" align="left" valign="top" scope="col"><font size="8" color="#333333" face="Arial, Helvetica, sans-serif"><strong>#</strong></font></td>
          <td width="40%" align="left" valign="top" scope="col"><font size="8" color="#333333" face="Arial, Helvetica, sans-serif"><strong>Product Name</strong></font></td>
          <td width="13%" align="left" valign="top" scope="col"><font size="8" color="#333333" face="Arial, Helvetica, sans-serif"><strong>Product SKU</strong></font></td>
          <td width="13%" align="left" valign="top" scope="col"><font size="8" color="#333333" face="Arial, Helvetica, sans-serif"><strong>Quantity</strong></font></td>
          <td width="13%" align="left" valign="top" scope="col"><font size="8" color="#333333" face="Arial, Helvetica, sans-serif"><strong>Unit Cost</strong></font></td>
          <td width="13%" align="left" valign="top" scope="col"><font size="8" color="#333333" face="Arial, Helvetica, sans-serif"><strong>Total</strong></font></td>
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
          <td align="left" width="5%"  valign="top"><font size="8" color="#333333" face="Arial, Helvetica, sans-serif"><?php echo $i;?></font></td>
          <td align="left" width="40%" valign="top"><font size="8" color="#333333" face="Arial, Helvetica, sans-serif"><?php echo stripslashes($val['product_name']);?></font></td>
          <td align="left" width="13%" valign="top"><font size="8" color="#333333" face="Arial, Helvetica, sans-serif"><?php echo $val['product_sku'];?></font></td>
          <td align="left" width="13%" valign="top"><font size="8" color="#333333" face="Arial, Helvetica, sans-serif"><?php echo $val['product_quantity'];?></font></td>
          <td align="left" width="13%" valign="top"><font size="8" color="#333333" face="Arial, Helvetica, sans-serif">$<?php echo number_format($val['product_price'],2);?></font></td>
          <td align="left" width="13%"  valign="top"><font size="8" color="#333333" face="Arial, Helvetica, sans-serif">$<?php echo $val['total_price'] ;?></font></td>
        </tr>
        <?php } ?>
        <tr>
          <td colspan="6"><hr></td>
        </tr>
        <tr>
        	<td colspan="2"></td>
          <td width="13%" align="left" valign="top"><font size="8" color="#333333" face="Arial, Helvetica, sans-serif"><strong>Total Qty</strong></font></td>
          <td width="13%" align="left" valign="top"><font size="8" color="#333333" face="Arial, Helvetica, sans-serif"><strong><?php echo $total_qty ;?></strong></font></td>
          <td  width="13%" align="left" valign="top"><font size="8" color="#333333" face="Arial, Helvetica, sans-serif"><strong>Total</strong></font></td>
          <td width="13%" align="left" valign="top"><font size="8" color="#333333" face="Arial, Helvetica, sans-serif"><strong>$<?php echo number_format($sub_total,2);?></strong></font></td>
        </tr>
        <tr>
        	<td colspan="4"></td>
          <td colspan="1"  align="left" valign="top"><font size="8" color="#333333" face="Arial, Helvetica, sans-serif"><strong>Shipping</strong></font></td>
          <td width="13%"  align="left" valign="top"><font size="8" color="#333333" face="Arial, Helvetica, sans-serif"><strong>$<?php echo number_format($data['shipping_cost'],2);?></strong></font></td>
        </tr>
        <!--<tr>
					<td colspan="4" width="70%" valign="middle"  align="right" valign="top"><font size="7" color="#333333" face="Arial, Helvetica, sans-serif"><strong>Sub Total</strong></font></td>
					
					<td colspan="2"  valign="middle"  align="center" valign="top"><font size="7" color="#333333" face="Arial, Helvetica, sans-serif"><strong>$<?php echo number_format(($sub_total+$data['shipping_cost']),2);?></strong></font></td>
				</tr>-->
        <?php if($data['discount']> 0){ ?>
        <tr>
        	<td colspan="4"></td>
          <td colspan="1"  align="left" valign="top"><font size="8" color="#333333" face="Arial, Helvetica, sans-serif"><strong>Discount</strong></font></td>
          <td width="13%" align="left" valign="top"><font size="8" color="#333333" face="Arial, Helvetica, sans-serif"><strong>$<?php echo number_format($data['discount'],2);?></strong></font></td>
        </tr>
        <?php } ?>
        <tr>
        	<td colspan="4"></td>
          <td colspan="1"  align="left" valign="top"><font size="8" color="#333333" face="Arial, Helvetica, sans-serif"><strong>Order Total</strong></font></td>
          <td width="13%" align="left" valign="top"><font size="8" color="#333333" face="Arial, Helvetica, sans-serif"><strong>$<?php echo number_format($data['total_price'],2);?></strong></font></td>
        </tr>
      </table></td>
  </tr>
</table>
