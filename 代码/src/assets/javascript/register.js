document.getElementById("log_username").onblur = log_chkExistUname;

document.getElementById("reg_username").onchange = chkusername;
document.getElementById("reg_username").onblur = reg_chkExistUname;

document.getElementById("reg_fname").onchange = chkname;
document.getElementById("reg_lname").onchange = chkname;

document.getElementById("reg_passport").onchange = chkPassport;

document.getElementById("reg_telnum").onchange = chkTel;

document.getElementById("reg_email").onchange = chkemail;
document.getElementById("reg_email2").onchange = chkemail;

document.getElementById("reg_password").onchange = chkpasswd;
document.getElementById("reg_password2").onchange = chkpasswd;


$(document).ready(function() {

	//On click signup, hide login and show registration form
	$("#signup").click(function() {
		$("#first").slideUp("slow", function(){
			$("#second").slideDown("slow");
		});
	});

	//On click signup, hide registration and show login form
	$("#signin").click(function() {
		$("#second").slideUp("slow", function(){
			$("#first").slideDown("slow");
		});
	});


});