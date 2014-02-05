<html>
<head>
Comment test system: click below to fire AJAX

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script language="javascript" type="text/javascript">
	function getComment()
	{
		$.ajax({
		url: 'ajax/commenting/comments.php',
		dataType: 'json', //jsonp if it's a cross-domain request
		success: function(data) {
			$('#name').html(data.returned_comments[0].comment_author);
			$('#comment').html(data.returned_comments[0].comment_text);
			$('#timestamp').html(data.returned_comments[0].comment_timestamp);
			}	
		});
	}		
</script>

</head>
<body>

<button onclick="getComment()">Get JSON!</button>

<div id="name">
	JSON output will be dumped here
</div>
<div id="comment">
	JSON output will be dumped here
</div>
<div id="timestamp">
	JSON output will be dumped here
</div>