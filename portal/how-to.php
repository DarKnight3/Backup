<!DOCTYPE html>
<head>
	<?php $title="How does it work | CAM";?>
	<?php require_once "assets/php/script/extract.php";?>
	<?php require_once absolute_filename('website-head.php', $shared_f);?>
</head>
<body>
	<div class="theme-layout">
		<?php require_once absolute_filename('website-header.php', $shared_f);?>

		<section>
			<div class="block" >
				<div class="container">
					<div class="row">
						<div class="col-md-1"></div>
						<div class="col-md-11 wow fadeIn ">
							<div class="">
					          <h2 class='writing' style="color:black">How does it work:</h2>
									<ul class='writing' style="font-size:13pt">
									<li>If you are an admin of your school, you must request access</li>
										<ul>
											<li>this will allow, the system to connect with your local school database</li>
											<li>The system will be able to retrieve your stuff's and student's details so that they do not to register when using our system</li>
											<li>The advantage of this is also to allow the system to directly save the students marks in your database.</li>
										</ul>
									<li>If you are a Teacher, this is what the allows you to do</li>
										<ul>
											<li>you can create an assessment which is linked with your class list </li>
											<li>if you do not feel like typing the memo, the system allows you to upload a scanned memo document for the current basement you are preparing.</li>
											<li>when your students log in, they will select the assessment you created you have their answer script marked with the correct memo</li>
											<li>A teacher also can upload a zipped file of the entire classes’ answer script to have them marked at once.</li>
										</ul>
									<li>If you are a student, the following are some of the things you can do</li>
										<ul>
											<li>For you to use the system, your teacher has to add you to a assessment before you can mark your script</li>
											<li>A student is only allowed to upload their own single answer script</li>
											<li>The system will give you your obtained mark and an option to download </li>
											<li>you will be able to even query a mark with your teacher through the system.</li>
										</ul>
										
									</ul>
									<p>So, go ahead, let Caracal simplify your life</p>
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

