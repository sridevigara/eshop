	<!-- SHOP CONTENT -->
	<section id="content">
		<div class="content-blog">
			<div class="container">
				<div class="row">
					
		<div class="col-md-10 col-md-offset-1" >
			<?php if(isset($fmsg)){ ?><div class="alert alert-danger" role="alert"> <?php echo $fmsg; ?> </div><?php } ?>
			<?php if(isset($smsg)){ ?><div class="alert alert-success" role="alert"> <?php echo $smsg; ?> </div><?php } ?>
					<div class="row" >
						<div class="col-md-5">
							<div class="gal-wrap">
								<div id="gal-slider" class="flexslider">
									<ul class="slides">
										<li><img src="<?php echo $productData['thumb']; ?>" class="img-responsive" alt=""/></li>
									</ul>
								</div>
								<ul class="gal-nav">
									<li>
										<div>
											<img src="<?php echo $productData['thumb']; ?>" class="img-responsive" alt=""/>
										</div>
									</li>
								</ul>
								<div class="clearfix"></div>
							
							</div>
						</div>
						<div class="col-md-7 product-single">
							<h2 class="product-single-title no-margin"><i><?php echo $productData['name']; ?></i></h2>
							<div><br /> <b>Product No </b>: <?php echo $productData['product_number']; ?></div>
							<div> <b>Color </b>: <?php echo $productData['color']; ?></div>
							<div class="space10"><?php echo $productData['description']; ?></div>
							<div class="product-meta">
								<span>Category: 
								<a href="<?php echo getPageUrl("category",$categoryData['sef_url']);?>"><?php echo $categoryData['name']; ?></a></span><br>
							</div>
							<div class="p-price"> <?php echo $productData['price']; ?></div>
							
							<form method="post" action="<?php echo getPageUrl("addtoCart");?>">
							<div class="product-quantity">
								<span>Quantity:</span> 
									<input type="hidden" name="productId" value="<?php echo $productData['id']; ?>">
									<input type="number" maxlength="1"  name="productQuantity" placeholder="1" value="1" required>
							</div>
							<div class="shop-btn-wrap">
								<input type="submit" class="button btn-small" value="Add to Cart">
							</div>
							</form>
							
						</div>
					</div>
					
					</div>
				</div>
			</div>
		</div>
	</section>
