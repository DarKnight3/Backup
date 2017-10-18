<!DOCTYPE html>
<head>
	<?php $title="Template";?>
	<?php require_once "assets/php/script/extract.php";?>
	<?php require_once absolute_filename('website-head.php', $shared_f);?>
</head>
<body>
	<div class="theme-layout">
		<?php require_once absolute_filename('website-header.php', $shared_f);?>
		<section>
			<div class="block" style="margin-top: -80px">
				<div class="container">
					<div class="row">
						<div class="col-md-12 wow flipInX"  data-wow-duration="5000ms">
							<!-- Remove  -->
							<h1 style="text-align: center" class="normal-text">CAM layout template page</h1>
							<!-- End remove -->
						</div>
					</div>
				</div>
			</div>
			<!-- Remove  -->
			<img src="assets/img/blog-bg.jpg" style="width: 100%; margin-bottom: 100px; margin-top: -50px" class="img img-responsive wow flipInY" data-wow-duration="5000ms" />
			<!-- End remove -->
		</section>
		<?php require_once absolute_filename('website-footer.php', $shared_f);?>
	</div>
</body>
<?php require_once absolute_filename('website-modals.php', $shared_f);?>
</html>

