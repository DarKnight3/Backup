
<!DOCTYPE html>
<head>
	<?php $title="CAM | Tutorials";?>
	<?php require_once "assets/php/script/extract.php";?>
	<?php require_once absolute_filename('website-head.php', $shared_f);?>
</head>
<body>
	<div class="container theme-layout">
		<?php require_once absolute_filename('website-header.php', $shared_f);?>
		<section>
			<div class="block" style="margin-top: -80px">
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<div class="title wow flipInX" data-wow-duration="8500ms" >
								<h1 class="wow bounceInDown title"><text style="color:#1a8cff; font-size: 40pt;">T</text>UTORIALS</h1><hr/>
								<span class="wow bounceInDown normal-text">Have some fun with cam</span><hr/>
								<p class="wow bounceInDown normal-text">Please click on any icon below to start having some mathematics fun. The practice section is for you to learn how to use cam and to prepare for the challanges.</p>
							</div>

							<div class="easyedu-services">
								<div class="row">
									<div class="col-md-4  wow bounce">
										<div class="edu-service wow bounce">
											<a href="practice"><img src="assets/img/resource/service1.png" alt="" class="wow swing"  data-wow-iteration="infinite" data-wow-duration="3500ms"/></a>
											<h3 class="wow bounceInDown">Practice</h3>
											<p class="wow bounceInDown normal-text" >Come to this section if you have never used cam before. Practice killing our challenges. </p>
										</div><!-- Edu Service -->
									</div>
									<div class="col-md-4  wow bounce">
										<div class="edu-service wow bounce">
											<a href="challenges"><img src="assets/img/resource/service2.png" alt="" class="wow jello"  data-wow-iteration="infinite" data-wow-duration="9500ms" /></a>
											<h3 class="wow bounceInDown">CHALLENGES</h3>
											<p class="wow bounceInDown normal-text">Prove how smart you are by attempting our killer challenges for mathematical geniuses.</p>
										</div><!-- Edu Service -->
									</div>
									<div class="col-md-4  wow bounce" >
										<div class="edu-service wow bounce">
											<a href="underconstruction"><img src="assets/img/resource/service3.png" alt="" class="wow pulse" data-wow-iteration="infinite" data-wow-duration="500ms"/></a>
											<h3 class="wow bounceInDown">Books And Past Papers</h3>
											<p class="wow bounceInDown normal-text">If you are just looking for past papers and free mathematical books, come in. </p>
										</div><!-- Edu Service -->
									</div>
								</div>
							</div><!-- Edu Services -->
							<div class="button-set wow tada" data-wow-duration="5500ms">
								<div class="row">
									<!-- <div class="col-md-2"></div> -->
									<!-- <div class="col-md-4" style="margin-left:50px"> -->
										<!-- <center><a class="button center-btn btn btn-magick btn-lg btn3d center-block wow tada" data-wow-duration="5500ms" href="#" title="">START Today's Math Challenge</a></center> -->
									<!-- </div> -->
									<!-- <div class="col-md-4"></div> -->
									<a href="challenges" class="button active wow tada" data-wow-duration="5500ms" href="#" title="">START Today's Math Challenge</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<?php require_once absolute_filename('website-footer.php', $shared_f);?>
	</div>
</body>
<?php require_once absolute_filename('website-modals.php', $shared_f);?>
</html>

