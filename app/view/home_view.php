<?php
$colorFilter = getColorFilter();
?>
	<!-- SHOP CONTENT -->
	<section id="content">
		<div class="content-blog">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<div class="row">
							<div class="shop-mason-4col" style="margin-left:15px; margin-bottom:10px;">
									Choose Color: <select name="colorFilter" onchange="homeFilter(this.value);">
									<option value="">Select Color</option>
									<?php foreach($colorFilter as $color)
									{
										echo $selected = ($color['color'] == $colorSelected) ? "selected" : "";
										echo "<option value='".$color['color']."' ".$selected." >".$color['color']."</option>";
									}
									?>
									</select>
							</div>
							<div id="shop-mason" class="shop-mason-4col">

							<?php 
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
<script type="text/javascript">
function homeFilter(filter)
{
	var queryParam = "";
	if(filter.length > 0)
		queryParam = "filter-"+filter;
	
	window.location.href="<?php echo getPageUrl("home"); ?>"+queryParam;
}
</script>