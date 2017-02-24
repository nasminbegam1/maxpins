<!-- BEGIN PAGE CONTENT INNER -->

<div class="portlet light">
  <div class="portlet-body">
    <div class="invoice">
      <div class="row">
        <div class="col-xs-8" style="padding-bottom:20px"> <strong style="font-size:28px;">Invoice #: {{order_id}}</strong> </div>
        <div class="col-xs-4">
		<div style="float: right;">
		<a href="<?php echo ADMIN_URL.'order/print_invoice/{{hidden_order_id}}';?>" target="_blank" class="btn btn-success" role="button" style="margin-right: 10px;">Print Invoice</a>
	<a href="<?php echo ADMIN_URL.'order/print_shipping_label/{{hidden_order_id}}';?>" target="_blank" class="btn btn-success pull-right" role="button">Print Shipping Label</a>
		</div>
	</div>
      </div>
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td align="left" valign="top" width="45%" style="padding-bottom:20px"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td colspan="2" align="left" valign="top" style="padding-bottom:10px;"><font  color="#333333" size="4" face="Arial, Helvetica, sans-serif"><strong>Wholesaler Information:</strong></font></td>
                    </tr>
                    <tr>
                      <td align="left" valign="top" style="padding-bottom:10px;"><font  color="#333333" face="Arial, Helvetica, sans-serif"><strong>Wholesaler Name:</strong> </font></td>
                      <td align="left" valign="top" style="padding-bottom:10px;"><font  color="#333333" face="Arial, Helvetica, sans-serif">{{wholesaler_name}}</font></td>
                    </tr>
                    <tr>
                      <td align="left" valign="top" style="padding-bottom:10px;"><font  color="#333333" face="Arial, Helvetica, sans-serif"><strong>Wholesaler No#:</strong> </font></td>
                      <td align="left" valign="top" style="padding-bottom:10px;"><font  color="#333333" face="Arial, Helvetica, sans-serif">{{wholesaler_customer_id}}</font></td>
                    </tr>
                    <tr>
                      <td width="30%" align="left" valign="top" style="padding-bottom:10px;"><font  color="#333333" face="Arial, Helvetica, sans-serif"><strong>Billing Address:</strong></font></td>
                      <td style="padding-bottom:10px;"><font  color="#333333" face="Arial, Helvetica, sans-serif" ng-bind-html="billing_info | to_trusted"></font></td>
                    </tr>
                    
                    <tr>
                      <td align="left" valign="top" style="padding-bottom:10px;"><font  color="#333333" face="Arial, Helvetica, sans-serif"><strong>Email:</strong> </font></td>
                      <td align="left" valign="top" style="padding-bottom:10px;"><font  color="#333333" face="Arial, Helvetica, sans-serif">{{wholesaler_email}}</font></td>
                    </tr>
                    <tr>
                      <td align="left" valign="top" style="padding-bottom:10px;"><font  color="#333333" face="Arial, Helvetica, sans-serif"><strong>Phone:</strong> </font></td>
                      <td align="left" valign="top" style="padding-bottom:10px;"><font  color="#333333" face="Arial, Helvetica, sans-serif">{{wholesaler_phone}}</font></td>
                    </tr>
                  </table></td>
                <td align="left" valign="top" width="30%" style="padding-bottom:10px;"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td align="left" valign="top" style="padding-bottom:10px;"><font size="4" color="#333333" face="Arial, Helvetica, sans-serif"><strong>Payment Details:</strong></font></td>
                    </tr>
                    <tr>
                      <td align="left" valign="top" style="padding-bottom:10px;"><font  color="#333333" face="Arial, Helvetica, sans-serif"><strong>Payment Amout:</strong> ${{total_amount | number:2}}</font></td>
                    </tr>
                   
                    <tr>
                      <td align="left" valign="top" style="padding-bottom:10px;"><font  color="#333333" face="Arial, Helvetica, sans-serif"><strong>Payment Status:</strong> {{(payment_status=='Success')? 'Paid':payment_status }}</font>
			<a href="" data-ng-click="changePayStatus()" class="{{(cp_view==1)?'ng-hide':'ng-show'}}">change?</a> <span class="{{(cp_view==1)?'ng-show':'ng-hide'}}">
			<br/>
			 <input type="hidden" name="hidden_order_id" data-ng-model="hidden_order_id">
		        <select name="pay_status" data-ng-model="pay_status" class="form-control input-inline input-small">
                          <option value="">Select...</option>
			  <option value="Net 30">Net 30</option>
                         <option value="Success">Paid</option>
			 <option value="Processing">Processing</option>
			 <option value="Failure">Failure</option>
                        </select>
 <button type="submit" data-ng-click="updatePayStatus()" class="btn green" title="Save"><i class="fa fa-check"></i></button>
                        <button type="button" class="btn red" data-ng-click="cancelPayStatus()" title="Cancel"><i class="fa fa-times"></i></button></span>
		      </td>
                    </tr>
		    <tr>
                      <td  align="left" valign="top" style="padding-bottom:10px;"><font  color="#333333" face="Arial, Helvetica, sans-serif"><strong>Shipping Address:</strong></font>
			<font  color="#333333" face="Arial, Helvetica, sans-serif" ng-bind-html="shipping_info | to_trusted"></font></td>
                    </tr>
                  </table></td>
                <td align="left" valign="top" width="25%"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td align="left" valign="top" style="padding-bottom:10px;" ><font size="4" color="#333333" face="Arial, Helvetica, sans-serif"><strong>Shipping Details:</strong></font></td>
                      <td align="left" valign="top" style="padding-bottom:10px;" >&nbsp;</td>
                    </tr>
                    <tr>
                      <td align="left" valign="top" style="padding-bottom:10px;"><font  color="#333333" face="Arial, Helvetica, sans-serif"><strong>Order Status:</strong> </font></td>
                      <td align="left" valign="top" style="padding-bottom:10px;" ><font  color="#333333" face="Arial, Helvetica, sans-serif"><span class="{{(dd_view!=1)?'ng-show':'ng-hide'}}">{{shipping_status}} <a href="" data-ng-click="changeShippingStatus()">change?</a></span> <span class="{{(dd_view==1)?'ng-show':'ng-hide'}}">
                        <input type="hidden" name="hidden_order_id" data-ng-model="hidden_order_id">
                        <select name="shipping" data-ng-model="shipping" class="form-control input-inline input-small">
                          <option value="">Select...</option>
                          <option data-ng-repeat="ssv in shipping_status_values" value="{{ssv.name}}" data-ng-selected="{{ssv.name == shipping_status}}">{{ssv.name}}</option>
                        </select>
                        &nbsp;
                        <button type="submit" data-ng-click="updateShippingStatus()" class="btn green" title="Save"><i class="fa fa-check"></i></button>
                        <button type="button" class="btn red" data-ng-click="cancelShippingStatus()" title="Cancel"><i class="fa fa-times"></i></button>
                        </span></font></td>
                    </tr>
                    <tr>
                      <td align="left" valign="top" style="padding-bottom:10px;" ><font  color="#333333" face="Arial, Helvetica, sans-serif"><strong>Shipping Method:</strong></font></td>
                      <td align="left" valign="top" style="padding-bottom:10px;" ><font  color="#333333" face="Arial, Helvetica, sans-serif">{{(shipping_method!='')? shipping_method:'N/A'}}</font></td>
                    </tr>
                    <tr>
                      <td align="left" valign="top" style="padding-bottom:10px;" ><font  color="#333333" face="Arial, Helvetica, sans-serif"><strong>Shipping Cost:</strong></font></td>
                      <td align="left" valign="top" style="padding-bottom:10px;" ><font  color="#333333" face="Arial, Helvetica, sans-serif">${{shipping_cost | number:2}}</font></td>
                    </tr>
                  </table></td>
              </tr>
            </table></td>
        </tr>
        <tr>
          <td align="left" valign="top" style="padding-bottom:10px;"><font size="4" color="#333333" face="Arial, Helvetica, sans-serif"><strong>Product Details:</strong></font><br /></td>
        </tr>
        <tr>
          <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <th align="left" valign="middle" width="5%" scope="col" style="padding-bottom:10px; border-bottom:1px solid #ddd;"> <font  color="#333333" face="Arial, Helvetica, sans-serif"><strong>#</strong></font> </th>
                <th align="left" valign="middle" width="23%" scope="col" style="padding-bottom:10px;border-bottom:1px solid #ddd;"> <font  color="#333333" face="Arial, Helvetica, sans-serif"><strong>Product Name</strong></font> </th>
                <th align="left" valign="middle" width="19%" scope="col" style="padding-bottom:10px;border-bottom:1px solid #ddd;"> <font  color="#333333" face="Arial, Helvetica, sans-serif"><strong>Product SKU</strong></font> </th>
                <th align="left" valign="middle" width="19%" scope="col" style="padding-bottom:10px;border-bottom:1px solid #ddd;"> <font  color="#333333" face="Arial, Helvetica, sans-serif"><strong>Quantity</strong></font> </th>
                <th align="left" valign="middle" width="19%" scope="col" style="padding-bottom:10px;border-bottom:1px solid #ddd;"> <font  color="#333333" face="Arial, Helvetica, sans-serif"><strong>Unit Cost</strong></font> </th>
                <th align="left" valign="middle" width="15%" scope="col" style="padding-bottom:10px;border-bottom:1px solid #ddd;"> <font  color="#333333" face="Arial, Helvetica, sans-serif"><strong>Total</strong></font> </th>
              </tr>
              <tr data-ng-repeat="od in orderDetailsList">
                <td align="left" valign="middle" width="5%" style="padding-bottom:10px;padding-top:10px;"><font  color="#333333" face="Arial, Helvetica, sans-serif">{{$index + 1}}</font></td>
                <td align="left" valign="middle" width="23%" style="padding-bottom:10px;padding-top:10px;"><font  color="#333333" face="Arial, Helvetica, sans-serif">{{od.product_name}}</font></td>
                <td align="left" valign="middle" width="19%" style="padding-bottom:10px;padding-top:10px;"><font  color="#333333" face="Arial, Helvetica, sans-serif">{{od.product_sku}}</font></td>
                <td align="left" valign="middle" width="19%" style="padding-bottom:10px;padding-top:10px;"><font  color="#333333" face="Arial, Helvetica, sans-serif">{{od.product_quantity}}</font></td>
                <td align="left" valign="middle" width="19%" style="padding-bottom:10px;padding-top:10px;"><font  color="#333333" face="Arial, Helvetica, sans-serif">${{od.product_price | number:2}}</font></td>
                <td align="left" valign="middle" width="15%" style="padding-bottom:10px;padding-top:10px;"><font  color="#333333" face="Arial, Helvetica, sans-serif">${{od.total_price}}</font></td>
              </tr>
              <tr>
		<td colspan="2" style="padding-bottom:10px;padding-top:10px; border-top:1px solid #ddd;">&nbsp;</td>
                <td colspan="1" style="padding-bottom:10px;padding-top:10px; border-top:1px solid #ddd;">
			<font  color="#333333" face="Arial, Helvetica, sans-serif"><strong>Total Qty</strong></font>
		</td>
		<td colspan="1" style="padding-bottom:10px;padding-top:10px; border-top:1px solid #ddd;">
			<font  color="#333333" face="Arial, Helvetica, sans-serif"><strong>{{total_qty}}</strong></font>
		</td>
                <td colspan="1" valign="middle"  align="left" style="padding-bottom:10px;padding-top:10px; border-top:1px solid #ddd;"><font  color="#333333" face="Arial, Helvetica, sans-serif"><strong>Total</strong></font></td>
                <td colspan="1"  valign="middle"  align="left" style="padding-bottom:10px;padding-top:10px; border-top:1px solid #ddd;"><font  color="#333333" face="Arial, Helvetica, sans-serif"><strong>${{sub_total | number:2}}</strong></font></td>
              </tr>
              <tr>
                <td colspan="4" style="padding-bottom:10px;">&nbsp;</td>
                <td colspan="1" valign="middle"  align="left" style="padding-bottom:10px;"><font  color="#333333" face="Arial, Helvetica, sans-serif"><strong>Shipping</strong></font></td>
                <td colspan="1"  valign="middle"  align="left" style="padding-bottom:10px;"><font  color="#333333" face="Arial, Helvetica, sans-serif"><strong>${{shipping_cost | number:2}}</strong></font></td>
              </tr>
	       <tr>
                <td colspan="4" style="padding-bottom:10px;">&nbsp;</td>
                <td colspan="1" valign="middle"  align="left" style="padding-bottom:10px;"><font  color="#333333" face="Arial, Helvetica, sans-serif"><strong>Sub Total</strong></font></td>
                <td colspan="1"  valign="middle"  align="left" style="padding-bottom:10px;"><font  color="#333333" face="Arial, Helvetica, sans-serif"><strong>${{sub_shipp_total | number:2}}</strong></font></td>
              </tr>
	<tr data-ng-class="(discount!='0.00')? 'ng-show':'ng-hide'">
                <td colspan="4" style="padding-bottom:10px;">&nbsp;</td>
                <td colspan="1" valign="middle"  align="left" style="padding-bottom:10px;"><font  color="#333333" face="Arial, Helvetica, sans-serif"><strong>Discount</strong></font></td>
                <td colspan="1"  valign="middle"  align="left" style="padding-bottom:10px;"><font  color="#333333" face="Arial, Helvetica, sans-serif"><strong>${{discount | number:2}}</strong></font></td>
              </tr>

              <tr>
                <td colspan="4" style="padding-bottom:10px;">&nbsp;</td>
                <td colspan="1" valign="middle"  align="left" style="padding-bottom:10px;"><font  color="#333333" face="Arial, Helvetica, sans-serif"><strong>Order Total</strong></font></td>
                <td colspan="1"  valign="middle"  align="left" style="padding-bottom:10px;"><font  color="#333333" face="Arial, Helvetica, sans-serif"><strong>${{total_amount | number:2}}</strong></font></td>
              </tr>
            </table></td>
        </tr>
      </table>
    </div>
  </div>
</div>
<!-- END PAGE CONTENT INNER -->