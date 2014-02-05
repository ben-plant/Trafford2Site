function checkAdminRights()
{
	$.ajax({
		url: 'ajax/usermanagement/checkadminrights.php',
		type: 'POST',
		dataType: 'json',
		data: 'username=' + readCookie('username'),
		success: function(data) {
				var response = data.login_response[0].response;
				switch (response)
				{
					case 200:
						window.location = "admindashboard.php";
						break;
					case 101:
						alert("You're not an administrator! You shouldn't be able to do this! Back to the homepage with you!");
						window.location = "/index.php";
						break; //actually report it
					case 107:
						alert("There's a problem with the administration check server. Tell Ben.");
						break;
					default:
						alert("There's been a problem checking your credentials.");
						break;
				}
			}	
	})
}