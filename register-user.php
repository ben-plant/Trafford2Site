<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="apple-touch-icon" href="touch-icon-iphone.png"/>
<link href="//fonts.googleapis.com/css?family=Lobster:400" rel="stylesheet" type="text/css">
<link href='http://fonts.googleapis.com/css?family=Covered+By+Your+Grace' rel='stylesheet' type='text/css'>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Trafford L51</title>
<link rel="stylesheet" type="text/css" href="main.css" />
<link rel="icon" href="favicon.ico">

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="http://crypto-js.googlecode.com/svn/tags/3.1.2/build/rollups/sha3.js"></script>
<script src="javascript/modifyCSS.js"></script>
<script language="javascript" type="text/javascript">
	
	var username;
	var forename;
	var surname;
	var password1;
	var password2;
	
	function submitRegistration()
	{		
		username = document.getElementById('username').value;
		forename  = document.getElementById('firstname').value;
		surname   = document.getElementById('surname').value;
		password1 = document.getElementById('password1').value;
		password2 = document.getElementById('password2').value;
		
		if (username.length >= 1 && forename.length >= 1 && surname.length >= 1)
		{
			if (password1.length >= 8 && password2.length >= 8)
			{
				sendAJAX();
			}
			else
			{
				highlightField('#password1');
				highlightField('#password2');
				
				alert("Your password choice needs to be min. 8 chars!");
			}
		}
		else
		{
			if (username.length == 0) { highlightField('#username'); };
			if (forename.length == 0) { highlightField('#firstname'); };
			if (surname.length == 0)  { highlightField('#surname');  };
			if ((password1.length == 0) || (password2.length == 0))  { highlightField('#password1'); highlightField('#password2'); };
			
			alert("You seem to have some empty boxes! All fields are mandatory! Please try again.");
		}		
	}
	
	function sendAJAX()
	{
		var temppass1 = CryptoJS.SHA3(password1, { outputLength: 512 });
		var temppass2 = CryptoJS.SHA3(password2, { outputLength: 512 });
	
		$.ajax({
			url: 'ajax/usermanagement/filenewuser.php',
			type: 'POST',
			dataType: 'text',
			data: 	'username='   + username  + //replace with JSON
					'&forename='  + forename  +
					'&surname='   + surname   +
					'&password1=' + temppass1 + 
					'&password2=' + temppass2,
			success: function(data) {
				/*STATUS CODES:
				200 = ALL OK
				101 = ILLEGAL USERNAME
				102 = USERNAME EXISTS
				103 = ILLEGAL FORENAME
				104 = ILLEGAL SURNAME
				105 = PASSWORDS DON'T MATCH
				106 = ILLEGAL PASSWORD
				107 = GENERIC ERROR
				108 = USER IS EBIE - FUCK ABOUT
				999 = DON'T KNOW
				*/
				switch (data) //Control codes
				{
					case '200':
						handle200();
						break;
					case '101':
						handle101();
						break;
					case '102':
						handle102();
						break;
					case '103':
						handle103();
						break;
					case '104':
						handle104();
						break;
					case '105':
						handle105();
						break;
					case '106':
						handle106();
						break;
					case '107':
						handle107();
						break;
					case '108':
						handle108();
						break;
					case '999':
						handle999();
						break;
					default:
						handle999();
						break;
				}
			}
		});
	}	
</script>

</head>
<body>
<div id="loginbox">
		<div class="widebox" id="topbox"> <!-- TITLEBAR -->
			<div class="largeheading" id="maintitle">
				Registration
			</div>
		</div>
		Username: <input type="text" id="username" onkeypress="resetFieldCSS('#username')"><br>
		First name: <input type="text" id="firstname" onkeypress="resetFieldCSS('#firstname')"><br>
		Surname: <input type="text" id="surname" onkeypress="resetFieldCSS('#surname')"><br>
		Password: <input type="password" id="password1" onkeypress="resetFieldCSS('#password1')"><br>
		Confirm password: <input type="password" id="password2"onkeypress="resetFieldCSS('#password2')"><br>
		<br>
		
		
		<button class="execute" onclick="submitRegistration()">Submit</button>
</div>
</body>
</html>