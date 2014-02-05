//INPUT: (youtube url || video_id) && user_id

var ytplayer;
	
function onytplayerStateChange(newState)
{
	if (newState == 0)
	{
		xmlhttp = new XMLHttpRequest();
		
		xmlhttp.onreadystatechange = function()
		{
			if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
			{
				document.getElementById('maintitle').innerHTML = xmlhttp.responseText;
			}
		}
		
		xmlhttp.open("POST", "ajax/logview.php", true);
		xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		xmlhttp.send("username=PERNUS"); //modify
	}
	else
	{
		document.getElementById('maintitle').innerHTML = newState;
	}
}
	
function onYouTubePlayerReady(playerId)
{		
	ytplayer = document.getElementById(playerId);
	ytplayer.addEventListener('onStateChange', 'onytplayerStateChange');
}
	
$(function() {
	var params = {
		allowScriptAccess: "always"
	};
		
	var atts = {
		id: "ytplayer1"
	};
		
	swfobject.embedSWF("http://www.youtube.com/v/Yg4GGjHFxZg?rel=0&autoplay=1&enablejsapi=1&playerapiid=ytplayer1","videoContainer",	"853", "505", "9", null, {}, params, atts);
});