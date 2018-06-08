<?php
$userId = getUserId();
$categoryData = getAllCategories();
$cartData = getCartData();
$cartCount = (!empty($cartData)) ? count($cartData) : 0;
?>
			<div class="menu-wrap">
				<div id="mobnav-btn">Menu <i class="fa fa-bars"></i></div>
				<ul class="sf-menu">
					<li>
						<a href="<?php echo getPageUrl("home");?>">Home</a>
					</li>
					<li>
						<a href="#">Shop</a>
						<div class="mobnav-subarrow"><i class="fa fa-plus"></i></div>
						<ul>
						<?php foreach($categoryData[0] as $cData)
								{
							?>
							<li><a href="<?php echo getPageUrl("category",$cData['sef_url']);?>"><?php echo $cData['name']; ?></a></li>
						<?php 
								if(!empty($categoryData[$cData['id']]))
								{
									foreach($categoryData[$cData['id']] as $clData)
									{
									?>
									<li><a href="<?php echo getPageUrl("category",$clData['sef_url']);?>">&nbsp;&nbsp;&nbsp;&nbsp;>><?php echo $clData['name']; ?></a></li>
						<?php	
									}
								}
							} ?>
						</ul>
					</li>
					<?php if($userId > 0) { ?>
					<li>
						<a href="#">My Account</a>
						<div class="mobnav-subarrow"><i class="fa fa-plus"></i></div>
						<ul>
							<li><a href="<?php echo getPageUrl("logout");?>">Logout</a></li>
						</ul>
					</li>
					<?php } else { ?>
					<li>
						<a href="<?php echo getPageUrl("login");?>">Login</a>
					</li>
					<?php } ?>
					
				</ul>
				<div class="header-xtra">
					<div class="s-cart">
						<div class="sc-ico"><i class="fa fa-shopping-cart"></i><em><?php
								echo $cartCount; ?></em></div>

						<div class="cart-info">
							<small>You have <em class="highlight"><?php
								echo $cartCount; ?> item(s)</em> in your shopping bag</small>
							<br>
							<br>
							<?php if($cartCount > 0) { ?>
							<div class="cart-btn">
								<a href="<?php echo getPageUrl("cart");?>">View Bag</a>
								<a href="<?php echo getPageUrl("checkoutCart");?>">Checkout</a>
							</div>
							<?php } ?>
						</div>
					</div>
					
				</div>
			</div>
		</div>
	</header>