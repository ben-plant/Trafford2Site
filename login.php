<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="apple-touch-icon" href="touch-icon-iphone.png"/>
<link href="//fonts.googleapis.com/css?family=Lobster:400" rel="stylesheet" type="text/css">
<link href='http://fonts.googleapis.com/css?family=Alegreya+Sans+SC:100' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Codystar' rel='stylesheet' type='text/css'>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Trafford L51</title>
<link rel="stylesheet" type="text/css" href="/css/main.css" />
<link rel="icon" href="favicon.ico">

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="http://crypto-js.googlecode.com/svn/tags/3.1.2/build/rollups/sha3.js"></script>
<script src="javascript/modifyCSS.js"></script>
<script src="javascript/cookie.js"></script>

<script language="javascript">
	function encrypt()
	{
		var username = document.getElementById('username').value;
		var hash = CryptoJS.SHA3(document.getElementById('password1').value, { outputLength: 512 });
		$.ajax({
				url: 'rebuilt_login.php',
				type: 'POST',
				dataType: 'json',
				data: 'username=' + username + '&password=' + hash,
				success: function(data)
				{
					var response = data.login_response[0].response;
					switch (response) //replace for compat. with json, or augment
					{
						case 200:
							setCookie("username", data.login_response[0].username, 7);
							window.location = "index.php";
							break;
						case 101:
							alert("Your credentials have not yet been authorised. Please consult the admins.");
							break;
						case 107:
							alert("There's a problem with the server.");
							break;
						case 403:
							alert("Wrong username/password! Access denied.");
							highlightField('#password1'); 
							break;
						default:
							alert("Please try again! Something went wrong.");
							break; //add in field highlighting from registration form
					}
				}
		});
	}
	
	function loadRegistration()
	{
		window.location = "register-user.php";
	}
</script>

</head>
<body>
<div id="loginbox">
	<div class="largeheading" id="maintitle">
		Trafford L51
	</div>
	<br>
	Username: <input label="Username:" type="text" id="username" onkeypress="resetFieldCSS('#username')"><br>
	Password: <input type="password" id="password1" onkeypress="resetFieldCSS('#password1')"><br>
		<button type="button" class="execute" onclick="encrypt()">Log me in!</button>
		<button type="button" class="execute" onclick="loadRegistration()">Sign me up!</button>
</div>
</body>
</html>