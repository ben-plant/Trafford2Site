function setCookie(name, value, expiry)
{
	var expiryDate = new Date();
	expiryDate.setDate(expiryDate.getDate() + expiry);
	var c_value = escape(value) + ((expiry == null) ? "" : "; expires=" + expiryDate.toUTCString());
	document.cookie = name + "=" + c_value;
}

function readCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for(var i=0;i < ca.length;i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1,c.length);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
    }
    return null;
}