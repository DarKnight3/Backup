<div aria-hidden="true" aria-labelledby="edit_profile" role="dialog" tabindex="-1" id="edit_profile" class="modal fade">
  <div class="modal-dialog">
	  <div class="modal-content">
		  <div class="modal-header">
			  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			  <h4 class="modal-title">Edit profile</h4>
		  </div>
		  <form method="post"   id="edit_profile" action="assets/php/script/update_files.php" enctype="multipart/form-data" >
		  <div class="modal-body">
				<!--<p style="text-align:center">Assesment date</p>
			  <input type="date" name="assesment_date"  class="form-control placeholder-no-fix"><br/>-->
			   <p class="centered"><img src="<?=$_SESSION['caracal_user']['picture']?>" class="user-image-i img-circle" width="150" height="200"></p>
			  <input type="text" name="firstname" placeholder="Name" class="form-control placeholder-no-fix" value="<?=$_SESSION['caracal_user']['firstname']?>"><br/>
			  <input type="text" name="lastname" placeholder="Surname" class="form-control placeholder-no-fix" value="<?=$_SESSION['caracal_user']['lastname']?>"><br/>
			  <input type="email" name="email" placeholder="Email" class="form-control placeholder-no-fix" value="<?=$_SESSION['caracal_user']['email']?>"><br/>
			  <select type="text" name="role" placeholder="Role" class="form-control placeholder-no-fix" >
				<?php if($_SESSION['caracal_user']['role']=="Admin"):?>
					<option value="Admin">Admin</option>
					<option value="Teacher">Teacher</option>
				<?php else:?>
				<option value="Teacher">Teacher</option>
				<option value="Admin">Admin</option>
					
				<?php endif?>
			  </select>
			  <br/>
			  <p>Date of birth</p>
			  <input type="date" name="date_of_birth" placeholder="DOB" class="form-control placeholder-no-fix" value="<?=$_SESSION['caracal_user']['date_of_birth']?>"><br/>
			  <input type="password" name="password" placeholder="Password" class="form-control placeholder-no-fix" value="<?=$_SESSION['caracal_user']['password']?>"><br/>
			  <p style="text-align:center">Profile picture</p>
			 
			  <input type="file" name="upload_file" placeholder="File" class="form-control placeholder-no-fix" ><br/>
			  <input type="hidden" name="user_id" value="<?=$_SESSION['caracal_user']['user_id']?>"/><br/>
			  <input type="hidden" name="id_name" value="user_id"/><br/>
			  <input type="hidden" name="table" value="user"/><br/>
			  <input type="hidden" name="directory" value="../../../Uploads/_profile_pictures"/><br/>
		  </div>
		  <div class="modal-footer">
			  <button data-dismiss="modal" class="btn btn-default" type="button">Cancel</button>
			  <button class="btn btn-theme submit-btn" type="submit">Submit</button><br/>
			  <div class="alert"></div>
		  </div>
		  </form>
	  </div>
  </div>
</div>
                  
    <!-- js placed at the end of the document so the pages load faster -->

    <script src="assets/js/bootstrap.min.js"></script>
	    <script src="assets/js/ajax.js"></script>
<script type='text/javascript' src='http://mathdox.org/formulaeditor/main.js'></script>
    <script class="include" type="text/javascript" src="assets/js/jquery.dcjqaccordion.2.7.js"></script>
    <script src="assets/js/jquery.scrollTo.min.js"></script>
    <script src="assets/js/jquery.nicescroll.js" type="text/javascript"></script>
    <script src="assets/js/jquery.sparkline.js"></script>


    <!--common script for all pages-->
    <script src="assets/js/common-scripts.js"></script>
    
    <script type="text/javascript" src="assets/js/gritter/js/jquery.gritter.js"></script>
    <script type="text/javascript" src="assets/js/gritter-conf.js"></script>

    <!--script for this page-->
    <script src="assets/js/sparkline-chart.js"></script>    
	<script src="assets/js/zabuto_calendar.js"></script>	
	
	<script type="text/javascript">
        // $(document).ready(function () {
        // var unique_id = $.gritter.add({
            // (string | mandatory) the heading of the notification
            // title: 'Welcome to CaracaL Marking System!',
            // (string | mandatory) the text inside the notification
            // text: 'Please make sure you understand how to use the system before attempting any further actions. ',
            // (string | optional) the image to display on the left
            // image: 'assets/img/ui-sam.jpg',
            // (bool | optional) if you want it to fade out on its own or just sit there
            // sticky: true,
            // (int | optional) the time you want it to be alive for before fading out
            // time: '',
            // (string | optional) the class name you want to apply to that specific message
            // class_name: 'my-sticky-class'
        // });

        // return false;
        // });
	</script>
	
	<script type="application/javascript">
        $(document).ready(function () {
            $("#date-popover").popover({html: true, trigger: "manual"});
            $("#date-popover").hide();
            $("#date-popover").click(function (e) {
                $(this).hide();
            });
        
            $("#my-calendar").zabuto_calendar({
                action: function () {
                    return myDateFunction(this.id, false);
                },
                action_nav: function () {
                    return myNavFunction(this.id);
                },
                ajax: {
                    url: "show_data.php?action=1",
                    modal: true
                },
                legend: [
                    {type: "text", label: "Special event", badge: "00"},
                    {type: "block", label: "Regular event", }
                ]
            });
        });
        
        
        function myNavFunction(id) {
            $("#date-popover").hide();
            var nav = $("#" + id).data("navigation");
            var to = $("#" + id).data("to");
            console.log('nav ' + nav + ' to: ' + to.month + '/' + to.year);
        }
    </script>
  
