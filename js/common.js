$("#logout").on("click", function(){
		  $.ajax({
		    type: "POST",
		    url: './api/api-logout.php',
		    dataType: "json",
		    data: JSON.stringify( { "flag": 440} ),
		    success: function(dat) {
		        if (dat === 0) alert("Logout Failed");
		        window.location.replace("login.php");
		    }
		  });
		  return false;
    });

$('.forgot-pass').on("click",function(){
	$('.login-form').css('display','none');
	$('.form-header').text('Forgot Password');
	$('.forget-pass-form').css('display','block');
});
$('.resend-mail').on("click",function(){
	$('.login-form').css('display','none');
	$('.form-header').text('Resend Account Verification Link');
	$('.resend-mail-form').css('display','block');
});

$('.back-pass').on("click",function(){
	$('.forget-pass-form').css('display','none');
	$('.form-header').text('Log In');
	$('.login-form').css('display','block');
});
$('.back-resend').on("click",function(){
	$('.resend-mail-form').css('display','none');
	$('.form-header').text('Log In');
	$('.login-form').css('display','block');
});
$('.forget-pass-form').on("submit",function(ev){
	ev.preventDefault();
	$('#success-msg').text('');
	$('#error-msg').text('');
	if(!$('#email').val() || $('#email').val() == ''){
		$('#error-msg').text('Email is required');
		return;
	}
	$.ajax({
		type: "POST",
		url: './api/api-forget-pass.php',
		dataType: "json",
		data: { "email": $('#email').val()},
		success: function(dat) {
			if(dat.code == 0){
				$('#success-msg').text(dat.description);
				$('#error-msg').text('');
			}
			else{
				$('#error-msg').text(dat.description);
				$('#success-msg').text('');
			}
			$('#email').val('');
		}
	});
	return false;
});

$('.resend-mail-form').on("submit",function(ev){
	ev.preventDefault();
	$('#mail-success-msg').text('');
	$('#mail-error-msg').text('');
	if(!$('#resend-email').val() || $('#resend-email').val() == ''){
		$('#mail-error-msg').text('Email is required');
		return;
	}
	$.ajax({
		type: "POST",
		url: './api/api-resend-mail.php',
		dataType: "json",
		data: { "email": $('#resend-email').val()},
		success: function(dat) {
			if(dat.code == 0){
				$('#mail-success-msg').text(dat.description);
				$('#mail-error-msg').text('');
			}
			else{
				$('#mail-error-msg').text(dat.description);
				$('#mail-success-msg').text('');
			}
			$('#resend-email').val('');
		}
	});
	return false;
});

$('.login-form').on("submit",function(ev){
	ev.preventDefault();
	$('.resend-mail').css('display','none');
	//$('#success-msg').text('');
	$('#login-error-msg').text('');
	var userNameFlag = false;
	var passwordFlag = false;
	if(!$('#user_name').val() || $('#pass').val() == ''){
		userNameFlag = true;
	}
	if(!$('#pass').val() || $('#pass').val() == ''){
		passwordFlag = true;
	}
	if(userNameFlag){
		if(passwordFlag){
			$('#login-error-msg').text('Username & Password is required');
		}
		else{
			$('#login-error-msg').text('Username is required');
		}
	}
	else{
		if(passwordFlag){
			$('#login-error-msg').text('Password is required');
		}
		else{
			$.ajax({
				type: "POST",
				url: './api/api-login.php',
				dataType: "json",
				data: { 
					"user_name": $('#user_name').val(),
					"pass" : $('#pass').val()
				},
				success: function(dat) {
					//console.log(dat);
					if(dat.code == 0){
						//$('#success-msg').text(dat.description);
						$('#login-error-msg').text('');
						window.location.href = 'index.php';
					}
					else{
						$('#login-error-msg').text(dat.description);
						if(dat.code == -2)
							$('.resend-mail').css('display','block');
						//$('#success-msg').text('');
					}
					$('#user_name').val('');
					$('#pass').val('');
				}
			});
		}
	}
	
	return false;
});
$('.register-form').on("submit",function(ev){
	ev.preventDefault();
	$('#error-msg').text('');
	$('#success-msg').text('');
	if(!$('#user_name').val() || $('#user_name').val()=='' || !$('#email').val() || $('#email').val()=='' || !$('#pass').val() || $('#pass').val()=='' || !$('#mob_number').val() || $('#mob_number').val() == '')
		$('#error-msg').text('Form is incomplete');
	else{
		$.ajax({
				type: "POST",
				url: './api/api-register.php',
				dataType: "json",
				data: { 
					"user_name": $('#user_name').val(),
					"pass" : $('#pass').val(),
					"email" : $('#email').val(),
					"mob_number" : $('#mob_number').val()
				},
				success: function(dat) {
					if(dat.code == 0){
						$('#success-msg').text(dat.description);
						$('#error-msg').text('');
					}
					else{
						$('#error-msg').text(dat.description);
						//$('#success-msg').text('');
					}
					$('#user_name').val('');
					$('#pass').val('');
					$('#email').val('');
					$('#mob_number').val('');
				}
		});
	}
});

