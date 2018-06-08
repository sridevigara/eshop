<?php 
$productUrl = getPageUrl("addtoCart")."?productId=".$pData['id']; 
?>
<div class="sm-item isotope-item">
									<div class="product">
										<div class="product-thumb">
											<img src="<?php echo $pData['thumb']; ?>" class="img-responsive" width="250px" alt="">
											<div class="product-overlay">
												<span>
												<a href="<?php echo getPageUrl("productDetail",$pData['sef_url']); ?>" class="fa fa-link"></a>
												<a href="<?php echo $productUrl; ?>" class="fa fa-shopping-cart"></a>
												</span>					
											</div>
										</div>
										
										<h2 class="product-title"><a href="<?php echo getPageUrl("productDetail",$pData['sef_url']); ?>"><?php echo $pData['name']; ?></a></h2>
										<div class="product-price"> <?php echo CURRENCY." " .$pData['price']; ?>/-<span></span></div>
									</div>
								</div>