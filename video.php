<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<?php

    include 'include/keys.php';

	session_start();
	
	if (empty($_SESSION['username']) || empty($_SESSION['password']))
	{
		header("location:login.php");
	}
			
	if (($mysqli = genVideoSQL()) == null)
    {
        return 107;
    }
	
	if (!($queryresult = mysqli_query($mysqli, 'SELECT * FROM videos WHERE video_title="'.htmlspecialchars($_GET["videoid"]).'"')))
		{
			echo "PREPARE STMT FAIL: " . $mysqli->errno . " WITH " . $mysqli->error;
			echo "GET BEN";
		}
	$thisvideo = mysqli_fetch_array($queryresult);
?>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<link rel="apple-touch-icon" href="touch-icon-iphone.png"/>
	<link href="//fonts.googleapis.com/css?family=Lobster:400" rel="stylesheet" type="text/css">
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<title>Trafford L51</title>
	<link rel="stylesheet" type="text/css" href="css/video.css" />
	<link rel="icon" href="favicon.ico">
	<div class="centre">
		<div id="maintitle">
			<?php
				echo $thisvideo['video_title'];
			?>
		</div>
	</div>
	
	<script language="javascript" type="text/javascript">

	function onSubmitComment()
	{
		var commentSubmitted = document.getElementById('commentbox').value;
		
		if (!!commentSubmitted || commentSubmitted != "undefined")
		{
			$.ajax({
				url: 'ajax/commenting/filenewcomment.php',
				type: 'POST',
				dataType: 'text',
				data: 'username=<?php echo htmlspecialchars($_SESSION['username'])?>&comment_text=' + commentSubmitted,
				success: function(data) {
					alert(data);
				}
			});
		}
	}

	</script>
	
</head>

<!-- Prepares the video player and the AJAX to log a successful view -->
<script type="text/javascript">
	var tag = document.createElement('script');

	tag.src = "https://www.youtube.com/iframe_api";
	var firstScriptTag = document.getElementsByTagName('script')[0];
	firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

	var player;

	function onYouTubeIframeAPIReady() {
		player = new YT.Player('player', {
			height: '390',
			width: '640',
			videoId: '<?php echo $thisvideo['video_url'] ?>',
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
			$.ajax({
				url: 'ajax/commenting/logview.php',
				type: 'POST',
				dataType: 'text',
				data: 'username=<?php echo htmlspecialchars($_SESSION['username'])?>&video_id=<?php echo htmlspecialchars($_GET["videoid"])?>',
				success: function(data) {
					$('#maintitle').html(data);
					}
			});
		}
	}
</script>

<!-- Prepares the comments system by retrieving all comments associated with this video ID -->
<?php

	if (!($commentsresult = mysqli_query($mysqli, 'SELECT * FROM comments WHERE comment_video_id="'.$thisvideo['video_id'].'"')))
	{
		echo "PREPARE STMT FAIL: " . $mysqli->errno . " WITH " . $mysqli->error;
		echo "GET BEN";
	}

?>

<noscript>
	Sadly, your browser doesn't support JavaScript, so no videos for you. Or you could be using an iPhone, which bugs the site out in very major ways, unfortunately. Go use a computer or phone that supports JavaScript, like a good Android phone or something.
</noscript>

<body>
	<div id="player">
		Sadly, your browser doesn't support JavaScript, so no videos for you. Go use a computer or phone that supports JavaScript, like an Android phone or something.
	</div>
	<div id="commentboxdiv">
		<?php
			if (isset($_GET['alpha_on']) == TRUE)
			{
				echo '<textarea id="commentbox" rows="10" cols="30"></textarea>';
				echo '<button onclick="onSubmitComment()">Submit Comment</button>';
			}
		?>
	</form>
	</div>
	<div id="comments">
		<?php
			if (isset($_GET['alpha_on']) == TRUE)
			{
				while($row = mysqli_fetch_array($commentsresult)) //post values
				{
					echo '<div id="comment_author">';
						echo $row['comment_author']."<br>";
					echo '</div>';
					echo '<div id="comment_text">';
						echo $row['comment_text']."<br>";
					echo '</div>';
					echo '<div id="comment_timestamp">';
						echo $row['comment_timestamp']."<br>";
					echo '</div>';
					echo '<br>';
				}
			}
		?>
	</div>
</body>
</html>