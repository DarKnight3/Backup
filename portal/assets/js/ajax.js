$('document').ready(function()
{ 

width = 0;
intr=1000;
mark_results="";
sub_questions_array=[];


  // Let's check if the browser supports notifications
  if (!("Notification" in window)) {
    alert("This browser does not support desktop notification");
  }

  // Let's check whether notification permissions have already been granted
  else if (Notification.permission === "granted") {
    // If it's okay let's create a notification
  }

  // Otherwise, we need to ask the user for permission
  else if (Notification.permission !== "denied") {
    Notification.requestPermission(function (permission) {
      // If the user accepts, let's create a notification
      
    });
  }

  // At last, if the user has denied notifications, and you 
  // want to be respectful there is no need to bother them any more.


$(".img-try").on("hover", function(){
	$(this).css('width', '250px');
}, function(){
	$(this).css('width', '150px');
});

 $("#total_number_of_questions").on("change", function(){
 	$("#new_memo_btn").removeClass("disabled");
 	$("#sub_questions").empty();
 	var number_of_questions=$(this).val();
 	for (var i = 0 ; i <number_of_questions; i++)
 	{
 		$("#sub_questions").append("<div class='form-group'><label for='question_sub_ "+(i+1)+"'>Question "+(i+1)+"</label><input id='question_sub_ "+(i+1)+"' placeholder='Total number of sub questions' type='number' name='question_"+(i+1)+"' class='form-control placeholder-no-fix sub-question-number'/></div>");
 	}
 });
$("#sub_questions").on("change","[id^='question_sub_']" ,function(e){
	sub_questions_array.push($(this).val());
	// alert(sub_questions_array[sub_questions_array.length-1]);
});
$(".page-refresh").on("click", function()
{
	location.reload();
});
$('.modal-close-refresh').on('hidden.bs.modal', function () {
 location.reload();
});
$('.modal').on('hidden.bs.modal', function () {
 location.reload();
});
$("#new_memo").on("submit", function(e)
{
	e.preventDefault();
	$("#sub_questions").empty();
	var tmp='';
	for (var i = sub_questions_array.length - 1; i >= 0; i--) 
	{
		if(i>=1)
		{
			tmp=tmp+sub_questions_array[i]+",";
		}
		else
		{
			tmp=tmp+sub_questions_array[i]
		}
	}
	$("#sub_question_count").val(tmp);
	//alert(tmp);
	file_upload("#new_memo");
	//sub_questions_array.removeData();
})
function move() {
	var elem = document.getElementById("myBar"); 
	
	var id = setInterval(frame, intr);
	function frame() {
	    if (width >= 100) {
	        clearInterval(id);
	        $("#mark-results").html(mark_results);

	    } else {
	        width++; 
	        elem.style.width = width + '%'; 
	        elem.innerHTML = width * 1 + '%';
	    }
	}
}



	function hideLoad() {
	  document.getElementById("myProgress").style.display = "none";
	  // document.getElementById("assesment-table").style.display = "block";
	 
	}

	function ShowLoad() {
	  document.getElementById("myProgress").style.display = "block";
	  // document.getElementById("assesment-table").style.display = "none";
	}

	var counter=0;
	var ques
	var sub
	$('#add_sub_question').prop('disabled', true);
	$('#add_step').prop('disabled', true);
	$('#done').prop('disabled', true);
	$("#add_question").on("click", function(e)
	{
		$('#add_sub_question').prop('disabled', false);
		$('#add_step').prop('disabled', false);
		$('#done').prop('disabled', false);
		e.preventDefault();
		counter++;
		//alert("sad");
		$("div#paper").append("<div class='row'><div class='col-md-4'><input type='number' name='main_"+counter+"' placeholder='Question number'  class='form-control placeholder-no-fix'><br/></div><div class='col-md-8'><input type='text' name='no_papers_uploaded' placeholder='Description'  class='form-control placeholder-no-fix'><br/></div></div>");
	});
	$("#add_sub_question").on("click", function(e)
	{
		e.preventDefault();
		counter++;
		//alert("sad");
		$("div#paper").append('<div class="sub-question"><div class="row"><div class="col-md-4"><input type="number" name="sub_'+counter+'" placeholder="Sub question number"  class="form-control placeholder-no-fix"><br/></div><div class="col-md-8"><input type="text" name="no_papers_uploaded" placeholder="Description"  class="form-control placeholder-no-fix"><br/></div></div></div>');
	});
	$("#add_step").on("click", function(e)
	{
		e.preventDefault();
		counter++;
		//alert("sad2");
		$("div#paper").append('<div class="row"><div class="col-md-4"></div><div class="col-md-6"><textarea name="step_'+counter+'" class=" form-control placeholder-no-fix"></textarea></div><div class="col-md-2"><input type="number" name="mark_'+counter+'" placeholder="mark"  class="form-control placeholder-no-fix"></div></div><br/>');
	});


	
	
	/*end of custom functions*/
	$(".delete-btn").on("click", function(e)
	{
	
		e.preventDefault();
		
		if(confirm("Note : The selected item will be permanetly deleted"))
		{
			// location.href=$(this).attr("href");
			deleteItem(this);
		}
		
		

	});
	function deleteItem(id)
   	{				    			
		$.ajax({
		type : 'GET',
		url  :$(id).attr("href"),
		success :  function(response)
		{	
			$(id).parent().parent().fadeOut();
		},
		error : function() 
		{
			alert("unable to delete sorry");
		}
		});
		return false;
	}
	$(document).on("click",".mark-btn", function(e)
	{
	
		e.preventDefault();
		
		if(confirm("Do you want to start marking"))
		{
			// location.href=$(this).attr("href");
			
			// move();
			mark(this);
		}
		
		

	});

	$("#mark-scripts").on("submit", function(e)
	{
		
		$(".submit-btn").hide();
	});

	function mark(id)
   	{		   		    			
		$.ajax({
		type : 'GET',
		url  :$(id).attr("href"),
		beforeSend : function()
		{
			$("#mark-results").html(" ");
			ShowLoad();
		},
		success :  function(response)
		{	

			// if(response.includes("Finished"))
			// {
				hideLoad();
				$("#mark-results").html(response);
			// }
			// else if(response.includes("Traceback"))
			// {
			// 	hideLoad();
			// 	$("#mark-results").html("<div class='alert alert-danger' style='text-align:center'>I am unable to mark the uploaded scripts please contact the admin for assistance</div>");
			// }
			// else
			// {
			// 	hideLoad();
			// 	$("#mark-results").html("<div class='alert alert-warning' style='text-align:center'><h4>One of the following errors occured</h4><ul><li>- I might have been unable to read your handwriting</li><li>- The paper might have not been scanned correctly</li><li>- The answering format may have not followed</li><li>- Your connection to the internet might be too slow for me to mark</li></ul></div>");
			// }

		},
		error : function() 
		{
			alert("unable to start marking sorry");
		}
		});
		return false;
	}
	$("form#activate").on("submit",function(e){

		e.preventDefault();
		activate();
	});

	function activate()
   	{				    
		var data = $("#activate").serialize();
			
		$.ajax({
			
		type : 'POST',
		url  :$("#activate").attr("action"),
		data : data,
		beforeSend: function()
		{	
			$(".error").fadeOut();
			$("#submit-btn").html('<span class="glyphicon glyphicon-transfer"></span> &nbsp; Checking email ...');
		},
		success :  function(response)
		   {			

				if(response.includes("SUC0000000"))
				{	
					$(".error").html("<div class='alert alert-success'><CENTER>Email found you are now being redirected</CENTER></div>").fadeIn(200000);
					$("#submit-btn").html('<i class="fa fa-circle-o-notch fa-spin"></i>&nbsp; Redirecting...');
					location.href="activate";
					
				}
				else if(response.includes("SUC0000001"))
				{	
					$(".error").html("<div class='alert alert-success'><CENTER>Email found you are now being redirected</CENTER></div>").fadeIn(10000);
					$("#submit-btn").html('<i class="fa fa-circle-o-notch fa-spin"></i>&nbsp; Redirecting...');
					location.href="activate";
					
				}
				else
				{
					$("#submit-btn").html('ACTIVATE');
					$(".error").html("<div class='alert alert-danger'><CENTER>"+response+"</CENTER></div>").fadeIn(1000);
				}
		  }
		});
			return false;
	}

	
	$("#login_").on("submit",function(e){

		e.preventDefault();
		login();
	});

	function login()
   	{				    
		var data = $("#login_").serialize();
		var btn_data = $("#submit-btn").html();
		$.ajax({
			
		type : 'POST',
		url  :$("#login_").attr("action"),
		data : data,
		beforeSend: function()
		{	
			$("#error").fadeOut();
			$("#submit-btn").html('<span class="glyphicon glyphicon-transfer"></span> ');
		},
		success :  function(response)
		   {			

				if(response.includes("SUC0000000"))
				{	
					$("#error").html("<div class='alert alert-success'><center>Login successfull you are now being redirected</center></div>").fadeIn(200000);
					$("#submit-btn").html('<i class="fa fa-circle-o-notch fa-spin"></i>');
					location.href="dashboard";
					
				}
				else if(response.includes("SUC0000001"))
				{	
					$("#error").html("<div class='alert alert-success'><center>Login successfull you are now being redirected</center></div>").fadeIn(10000);
					$("#submit-btn").html('<i class="fa fa-circle-o-notch fa-spin"></i>');
					location.href="dashboard";
					
				}
				else
				{
					$("#submit-btn").html(btn_data);
					$("#error").html("<div class='alert alert-danger'><center>"+response+"</center></div>").fadeIn(1000);
				}
		  }
		});
			return false;
	}

	$("#lock").on("submit",function(e){

		e.preventDefault();
		lock();
	});

	function lock()
   	{				    
		var data = $("#lock").serialize();
			
		$.ajax({
			
		type : 'POST',
		url  :$("#lock").attr("action"),
		data : data,
		beforeSend: function()
		{	
			$("#error").fadeOut();
			$("#submit-btn").html('<span class="glyphicon glyphicon-transfer"></span> &nbsp; Checking details ...');
		},
		success :  function(response)
		   {			

				if(response.includes("SUC0000000"))
				{	
					$("#error").html("<div class='alert alert-success'>Login successfull you are now being redirected</div>").fadeIn(1000);
					location.href="home";
					
				}
				else if(response.includes("SUC0000001"))
				{	
					$("#error").html("<div class='alert alert-success'> Login successfull you are now being redirected</div>").fadeIn(1000);
					location.href="home";
					
				}
				else
				{
					$("#submit-btn").html('Login');
					$("#error").html("<div class='alert alert-danger'>"+response+"</div>").fadeIn(1000);
					
				}
		  }
		});
			return false;
	}

	$("form.general").on("submit",function(e){
		e.preventDefault();
		
		submit("#"+$(this).attr("id"));
		
			
	});
	function submit(id)
   	{		
		
		var data = new FormData($(id)[0]);
		var btno = $(id+" .submit-btn").html();
		
		$.ajax(
		{
			type : 'POST',
			url  : $(id).attr("action"),
			data : data,
			processData:false,
			contentType:false,
			cache:false,
		beforeSend: function()
		{	
			$(id+" .alert").fadeOut();
			$(id+" .submit-btn").html('<span class="glyphicon glyphicon-transfer"></span> &nbsp; please wait ...');
		},
		success :  function(response)
		   {			

				if(response.includes("SUC0000000"))
				{	
					if($(id+" .submit-btn").attr('data-state')=="true")
					{
						location.reload();
					}
					$(id+" .alert").html("<center><div class='alert alert-success'>"+response+"</div></center>").fadeIn(1000);
					$(id+" .submit-btn").html(btno);
					if($(id+" .alert").html()==null && $(id+".alert").html()==null)
					{
						alert("Task successfully completed");
						alert("Refresh to view changes");
					}
					if( $(id+".alert").html())
					{
						$(id+".alert").html("<center><div class='alert alert-success'>"+response+"</div></center>").fadeIn(1000);
					}
				}
				else
				{
					
					$(id+" .submit-btn").html(btno);
					$(id+" .alert").html("<center><div class='alert alert-danger' >"+response+"</div></center>").fadeIn(1000);
				}
		  }
		});
			return false;
	}
	$("form.file").on("submit", function(e)
	{
		
		setTimeout(function(){
			$(".alert").fadeOut(2000);
		},15000000000000000000000)
		e.preventDefault();
		file_upload("#"+$(this).attr("id"));
		
	});

	function file_upload(id)
	{		
		var data = new FormData($(id)[0]);
		
		$.ajax(
		{
			type : 'POST',
			url  : $(id).attr("action"),
			data : data,
			processData:false,
			contentType:false,
			cache:false,
			beforeSend: function()
			{	
				// $(id+".alert").fadeOut();
				$(id+" .alert").html('<span class="glyphicon glyphicon-transfer"></span> &nbsp; Saving ...');
			},
			success :  function(response)
			{						
				
					$(id+" .alert").fadeIn(1000, function()
					{				
						$(id+" .submit-btn").html('Submit');		
						$(id+" .alert").html(response);						
						
					});

			}
		});
		return false;
	}
	
	
	$("form#edit_profile").on("submit", function(e)
	{

		setTimeout(function(){
			$("#alert").fadeOut(2000);
		},15000)
		e.preventDefault();
		profile();
		
	});

	function profile()
	{		
		var data = new FormData($("form#edit_profile")[0]);
		id="form#edit_profile";
		$.ajax(
		{
			type : 'POST',
			url  : $(id).attr("action"),
			data : data,
			processData:false,
			contentType:false,
			cache:false,
			beforeSend: function()
			{	
				$(id+" .alert").fadeOut();
				$(id+" .submit-btn").html('<span class="glyphicon glyphicon-transfer"></span> &nbsp; Saving ...');
			},
			success :  function(response)
			{						
				if(response.includes("_profile_pictures") && !response.includes("ADJHSABD893284239"))
				{
					$(id+" .alert").fadeIn(1000, function()
					{				
						$(id+" .submit-btn").html('Save');		
						$(id+" .alert").html('<div class="alert alert-success" style="text-align:center">Profile updated successfully<br><b>Note</b> :please refresh to view changes</div>');
						if(response.includes("_profile_pictures"))
						{
							$('.user-image-i').attr("src",response);
						}
						
					});
					if($(id+" .alert")==null)
					{
						alert("Profile edited susscessfully please refresh to view changes");
					}
				}
				else if(response.includes("SB1223892198NSA"))
				{
					$(id+" .alert").fadeIn(1000, function()
					{				
						$(id+" .submit-btn").html('Save');		
						$(id+" .alert").html('<div class="alert alert-success" style="text-align:center">Profile updated successfully<br><b>Note</b> :please refresh to view changes</div>');
						
						
					});
					if($(id+" .alert")==null)
					{
						alert("Profile edited susscessfully please refresh to view changes");
					}
				
				}
				else
				{			
					$(id+" .alert").fadeIn(4000, function(){
						$(id+" .alert").html('<div class="alert alert-danger">'+response+'</div>');
						$(id+" .submit-btn").html('Save');
					});
					if($(id+" .alert")==null)
					{
						alert(response);
					}
				}
			}
		});
		return false;
	}

});