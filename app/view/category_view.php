	<!-- SHOP CONTENT -->
	<section id="content">
		<div class="content-blog">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<div class="row">
							<div id="shop-mason" class="shop-mason-4col">

							<?php 
								if(empty($productData) && count($productData) == 0)
								{
									echo "<center>".NO_CATEGORY_PRODUCTS."</center>";
								}
								foreach($productData as $pData)
								{
									$this->load->view('includes/product_element',array("pData"=>$pData));
								}
								?>

								
							</div>
						</div>
						
					</div>
				</div>
			</div>
		</div>
	</section>
