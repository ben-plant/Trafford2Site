<html>
<head>
This page tests the slider mechanism which reports back to a data handler by AJAX. Each employee will be represented by an obfuscated data value meaning the machine knows where to file data, but humans won't know who is who without detective work. The slider can be adjusted and synced with the server many times.
<noscript>
This page uses JavaScript. Enable it.
</noscript>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
<script src="../javascript/slider/js/simple-slider.js"></script>
<link href="../javascript/slider/css/simple-slider.css" rel="stylesheet" type="text/css" />
</head>
<body>
<input id="slider" type="text" data-slider="true" data-slider-range="0, 10" data-slider-snap="true" data-slider-step="1">

<div id="output">
	Slide the slider to set a value
</div>

<input type="button" value="Click to execute JS" onclick="sendAJAX()">
</body>
</html>

<script language="javascript">
	$("#slider").bind("slider:changed", function (event, data)
	{
		$('#output').text(data.value);
	});
	
	function sendAJAX()
	{
		
	}
</script>