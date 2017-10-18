<!DOCTYPE html>
<head>
	<?php $title="Practice | CAM";?>
	<?php require_once "assets/php/script/extract.php";?>
	<?php require_once absolute_filename('website-head.php', $shared_f);?>
	<style type="text/css">
		.img-practice
		{
			width:100%;
			height:198px;
			padding:10px;

		}
		.practice-box
		{
			width:90%;
			height:200px;
			border:solid 2px #1a8cff;
			margin: 10px auto;
			border-right: solid 1px  #1a8cff;
			
		}

		a.btn-practice
		{
			width: 101%;
			margin-left:-2px;
			background-color: #1a8cff;
			border-color: #1a8cff;
			border-radius: 0;
		}
	</style>
</head>
<body>
	<div class="theme-layout">
		<?php require_once absolute_filename('website-header.php', $shared_f);?>

		<section>
			<div class="block" >
				<div class="container">

					<div class="row">
						<div class="col-md-2">
							<?php require_once absolute_filename('website-leader-board.php', $shared_f);?>
						</div>
						<div class="col-md-10">
							<h1 class="normal-text wow flipInX" data-wow-duration="3000ms" style="text-align: center; font-size: 60pt; margin-top:-40px">Practice</h1>
							<div class="row">
								<div class="col-md-4" style="margin-top: 50px">
									<div class="practice-box  wow flipInY" data-wow-duration="1900ms">
										<img src="<?=$virtual_root?>/assets/img/practice/pic2.jpg" class="img img-responsive img-practice wow flipInY"/>
										<a href="underconstruction" class="btn btn-primary btn-practice wow fadeIn"  data-wow-delay="2000ms">Read More</a>
									</div>
								</div>
								<div class="col-md-4" style="margin-top: 50px">
									<div class="practice-box  wow flipInY" data-wow-duration="1900ms">
										<img  src="<?=$virtual_root?>/assets/img/practice/pic3.jpg" class="img img-responsive img-practice  wow flipInY"/>
										<a href="underconstruction" class="btn btn-primary btn-practice wow fadeIn" data-wow-delay="2000ms">Read More</a>
									</div>
								</div>
								<div class="col-md-4" style="margin-top: 50px">
									<div class="practice-box  wow flipInY" data-wow-duration="1900ms">
										<img  src="<?=$virtual_root?>/assets/img/practice/pic1.jpg" class="img img-responsive img-practice  wow flipInY"/>
										<a href="underconstruction" class="btn btn-primary btn-practice wow fadeIn" data-wow-delay="2000ms">Read More</a>
									</div>
								</div>
							</div>
							
						</div>
					</div>
				</div>
			</div>
		</section>
	</div>
</body>
<?php require_once absolute_filename('website-modals.php', $shared_f);?>
</html>

