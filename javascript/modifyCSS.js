function highlightField(field)
{
	$(field).css({
		'border-color' 		 : 'red',
		'border-style'		 : 'solid',
		'border-width'		 : '1px',
		'background-color'	 : '#F78181',
	});
	$(field).val(null);
}

function resetFieldCSS(field)
{
	$(field).css({
		'border-color' 		 : '#999',
		'border-style'		 : 'solid',
		'border-width'		 : '1px',
		'background-color'	 : '#FFF'
	});
}

function handle200() //ALL OKAY
{
	alert("User created successfully!");
	window.location = "login.php";
}

function handle101() //ILLEGAL USERNAME
{
	highlightField('#username');
}

function handle102() //USERNAME EXISTS
{
	highlightField('#username');
}

function handle103() //ILLEGAL FORENAME
{
	highlightField('#firstname');
}

function handle104() //ILLEGAL SURNAME
{
	highlightField('#surname');
}

function handle105() //PASSWORDS DIDN'T MATCH
{
	highlightField('#password1');
	highlightField('#password2');
	alert("Your passwords didn't match! Please try again.");
}

function handle106() //ILLEGAL PASSWORD (BLANK?)
{
	highlightField('#password1');
	highlightField('#password2');
}

function handle107() //GENERIC ERROR
{
	alert("There's a problem with the backend. Get Ben. Also panic. You should definitely be panicking. Ben will be. This is a very scary error message.");
}
	
function handle108() //EBIE SPECIFIC ERROR
{
}	
	
function handle999() //UNKNOWN ERROR - CONSULT LOG
{
}	
	