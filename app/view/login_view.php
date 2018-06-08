<!-- SHOP CONTENT -->
	<section id="content">
		<div class="content-blog">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
				<div class="row shop-login">
				<div class="col-md-6">
					<div class="box-content">
						<h3 class="heading text-center">I'm a Returning Customer</h3>
						<div class="clearfix space40"></div>
						<?php if(!empty($lmessage)){ 
								
							?><div class="alert alert-danger" role="alert"> <?php echo $lmessage; ?> </div>
							<?php }  ?>
						<form class="logregform" method="post" action="<?php echo getPageUrl("loginAuth");?>">
							<div class="row">
								<div class="form-group">
									<div class="col-md-12">
										<label>E-mail Address</label>
										<input type="email" name="email" value="" class="form-control" required>
									</div>
								</div>
							</div>
							<div class="clearfix space20"></div>
							<div class="row">
								<div class="form-group">
									<div class="col-md-12">
										<!-- <a class="pull-right" href="#">(Lost Password?)</a> -->
										<label>Password</label>
										<input type="password" name="password" pattern=".{6,20}" value="" class="form-control" required>
									</div>
								</div>
							</div>
							<div class="clearfix space20"></div>
							<div class="row">
								<div class="col-md-6">
									<!-- <span class="remember-box checkbox">
									<label for="rememberme">
									<input type="checkbox" id="rememberme" name="rememberme">Remember Me
									</label>
									</span> -->
								</div>
								<div class="col-md-6">
									<button type="submit" class="button btn-md pull-right">Login</button>
								</div>
							</div>
							<input type="hidden" name="redirect_page" value="<?php echo $redirectPage;?>" />
						</form>
					</div>
				</div>
				<div class="col-md-6">
					<div class="box-content">
						<h3 class="heading text-center">Register An Account</h3>
						<div class="clearfix space40"></div>
						<?php if(!empty($rmessage)){ 
								
							?><div class="alert alert-danger" role="alert"> <?php echo $rmessage; ?> </div>
							<?php }  ?>
						<form class="logregform" method="post" action="<?php echo getPageUrl("userRegister");?>">
							<div class="row">
								<div class="form-group">
									<div class="col-md-6">
										<label>Name *</label>
										<input type="text" name="name" value="" pattern=".{2,}" class="form-control" required>
									</div>
									<div class="col-md-6">
										<label>E-mail Address *</label>
										<input type="email" name="email" value="" class="form-control" required>
									</div>
								</div>
							</div>
							<div class="clearfix space20"></div>
							<div class="row">
								<div class="form-group">
									<div class="col-md-6">
										<label>Password *</label>
										<input type="password" name="password" value="" pattern=".{6,20}" class="form-control" required ><br /><label>Note: Min Length 6 characters</label>
									</div>
									<div class="col-md-6">
										<label>Re-enter Password *</label>
										<input type="password" name="passwordagain" value="" pattern=".{6,20}" class="form-control" required>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="space20"></div>
									<button type="submit" class="button btn-md pull-right">Register</button>
								</div>
							</div>
							<input type="hidden" name="redirect_page" value="<?php echo $redirectPage;?>" />
						</form>
					</div>
				</div>
			</div>


							
					</div>
				</div>
			</div>
		</div>
	</section>