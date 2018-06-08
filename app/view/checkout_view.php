	<!-- SHOP CONTENT -->
	<section id="content">
		<div class="content-blog">
<form method="post" action="<?php echo getPageUrl("transactionOrder");?>">
<div class="container">
			
			<div class="space30"></div>
			<h4 class="heading">Your order</h4>
			
			<table class="table table-bordered extra-padding">
				<tbody>
					<tr>
						<th>Cart Subtotal</th>
						<td><span class="amount"><?php echo CURRENCY." " .$orderData['cartTotalAmount']?></span></td>
					</tr>
					<tr>
						<th>Shipping and Handling</th>
						<td>
							Free Shipping				
						</td>
					</tr>
					<tr>
						<th>Order Total</th>
						<td><strong><span class="amount"><?php echo CURRENCY." " .$orderData['cartTotalAmount']?></span></strong> </td>
					</tr>
				</tbody>
			</table>
			<div class="row">
				<div class="col-md-6 col-md-offset-3">
					<div class="billing-details">
						<h3 class="uppercase">Billing Details</h3>
						<div class="space30"></div>
							<label class="">Country </label>
							<select name="country" class="form-control">
								<option value="">Select Country</option>
								<option value="1" selected="selected">India</option>
							</select>
							<div class="clearfix space20"></div>
							<div class="row">
								<div class="col-md-6">
									<label>Full Name </label>
									<input name="fname" class="form-control" placeholder="" value="<?php if(!empty($userData['name'])){ echo $userData['name']; }  ?>" type="text" required>
								</div>
							</div>
							<div class="clearfix space20"></div>
							<label>Address </label>
							<input name="address1" class="form-control" placeholder="Street address" value="<?php if(!empty($userData['address'])){ echo $userData['address']; }  ?>" type="text" required>
							<div class="clearfix space20"></div>
							<div class="row">
							<div class="col-md-4">
									<label>Postcode </label>
									<input name="zipcode" class="form-control" placeholder="Postcode / Zip" value="<?php if(!empty($userData['zipcode'])){ echo $userData['zipcode']; }  ?>" type="text" required>
								</div>
							</div>
							<div class="clearfix space20"></div>
							<label>Mobile </label>
							<input name="phone" class="form-control" id="billing_phone" placeholder="" value="<?php if(!empty($userData['mobile'])){ echo $userData['mobile']; }  ?>" type="text" required>
						
					</div>
				</div>
				
			</div>
			
			
			<div class="clearfix space30"></div>
			<h4 class="heading">Payment Method</h4>
			<div class="clearfix space20"></div>
			
			<div class="payment-method">
				<div class="row">
					
						<div class="col-md-4">
							<input name="payment" id="radio1" class="css-checkbox" type="radio" value="cod"><span>Cash On Delivery</span>
							<div class="space20"></div>
							<p>Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order won't be shipped until the funds have cleared in our account.</p>
						</div>
						
						<div class="col-md-4">
							<input name="payment" id="radio3" class="css-checkbox" type="radio" checked="checked" value="paypal"><span value="paypal">Paypal</span>
							<div class="space20"></div>
							<p>Pay via PayPal; you can pay with your credit card if you don't have a PayPal account</p>
						</div>
					
				</div>
				<div class="space30"></div>
				
					<input name="agree" id="checkboxG2" class="css-checkbox" type="checkbox" checked="checked" value="true" ><span>I've read and accept the <a href="#">terms &amp; conditions</a></span>
				
				<div class="space30"></div>
				<input type="submit" class="button btn-lg" value="Pay Now">
			</div>
		</div>		
</form>		
		</div>
	</section>
