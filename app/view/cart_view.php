	<!-- SHOP CONTENT -->
	<section id="content">
		<div class="content-blog">
			<div class="container">
				<div class="row">
					<div class="col-md-12">

<table class="cart-table table table-bordered">
				<thead>
					<tr>
						<th>&nbsp;</th>
						<th>&nbsp;</th>
						<th>Product</th>
						<th>Price</th>
						<th>Quantity</th>
						<th>Total</th>
					</tr>
				</thead>
				<tbody>
				<?php
				$cartTotal = 0;
				$cartCount = count($cartProductData);
				if($cartCount == 0)
				{
					?><tr><td colspan="6"><?php echo NO_CART_PRODUCTS;?></td></tr><?php
				}
				else 
				{
				foreach ($cartProductData as $cartKey => $cartValue) 
				{
				$cartProductQuantity = "";
				$cartProductQuantity = $cartData[$cartValue['id']]['productQuantity'];
				?>
					<tr>
						<td>
							<a class="remove" href="<?php echo getPageUrl("deleteCart");?>/<?php echo $cartValue['id']; ?>"><i class="fa fa-times"></i></a>
						</td>
						<td>
							<a href="<?php echo getPageUrl("productDetail",$cartValue['sef_url']); ?>"><img src="<?php echo $cartValue['thumb']; ?>" alt="" height="90" width="90"></a>					
						</td>
						<td>
							<a href="<?php echo getPageUrl("productDetail",$cartValue['sef_url']); ?>"><?php echo $cartValue['name']; ?></a>					
						</td>
						<td>
							<span class="amount"><?php echo CURRENCY." " .$cartValue['price']; ?>/-</span>					
						</td>
						<td>
							<div class="quantity"><?php echo $cartData[$cartValue['id']]['productQuantity']; ?></div>
						</td>
						<td>
							<span class="amount"><?php echo CURRENCY." " .($cartValue['price']*$cartProductQuantity); ?>/-</span>					
						</td>
					</tr>
				<?php 
					$cartTotal = $cartTotal + ($cartValue['price']*$cartProductQuantity);
				} ?>
					<tr>
						<td colspan="6" class="actions">
							<div class="col-md-6">
							<!--	<div class="coupon">
									<label>Coupon:</label><br>
									<input placeholder="Coupon code" type="text"> <button type="submit">Apply</button>
								</div> -->
							</div>
							<div class="col-md-6">
								<div class="cart-btn">
									<!-- <button class="button btn-md" type="submit">Update Cart</button> -->
									<a href="<?php echo getPageUrl("checkoutCart");?>" class="button btn-md" >Checkout</a>
								</div>
							</div>
						</td>
					</tr>
				<?php } ?>
				</tbody>
			</table>		
			<?php 
			if($cartCount > 0)
			{
			?>
			<div class="cart_totals">
				<div class="col-md-6 push-md-6 no-padding">
					<h4 class="heading">Cart Totals</h4>
					<table class="table table-bordered col-md-6">
						<tbody>
							<tr>
								<th>Cart Subtotal</th>
								<td><span class="amount"> <?php echo CURRENCY." " .$cartTotal; ?>/-</span></td>
							</tr>
							<tr>
								<th>Shipping and Handling</th>
								<td>
									Free Shipping				
								</td>
							</tr>
							<tr>
								<th>Order Total</th>
								<td><strong><span class="amount"> <?php echo CURRENCY." " .$cartTotal; ?>/-</span></strong> </td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>			
			<?php } ?>				
					</div>
				</div>
			</div>
		</div>
	</section>
