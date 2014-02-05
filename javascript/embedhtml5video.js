var tag = document.createElement('script');

tag.src = "https://www.youtube.com/iframe_api";
var firstScriptTag = document.getElementsByTagName('script')[0];
firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

var player;

function onYouTubeIframeAPIReady() {
	player = new YT.Player('player', {
		height: '390',
		width: '640',
		videoId: 'pc0NHsRLef8',
		events: {
			'onReady': onPlayerReady,
			'onStateChange': onPlayerStateChange
		}
	});
}

function onPlayerReady(event) //some cool little intro?
{
	event.target.playVideo();
}

function onPlayerStateChange(event)
{
	if (event.data == YT.PlayerState.ENDED)
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
		document.getElementById('maintitle').innerHTML = event.data;
	}
}