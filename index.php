<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<?
	session_start();
	
	if (empty($_SESSION['username']) || empty($_SESSION['password']))
	{
		header("location:login.php");
	}
	if (!(empty($_SESSION['adminkey'])))
	{
		$admin = true;
	}
?>

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
<script src="/javascript/navigation.js"></script>
<script src="/javascript/admincheck.js"></script>
<script src="/javascript/cookie.js"></script>

<script type="text/javascript">
    var tag = document.createElement('script');

    tag.src = "https://www.youtube.com/iframe_api";
    var firstScriptTag = document.getElementsByTagName('script')[0];
    firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

    var player;

    function onYouTubeIframeAPIReady() {
        player = new YT.Player('player', {
            // height: '390',
            // width: '640',
            videoId: 'HgzQPxYjm8E', //put PHP back!!!
            events: {
                'onReady': onPlayerReady,
                'onStateChange': onPlayerStateChange
            }
        });
    }

    function onPlayerReady(event) //some cool little intro?
    {
        // event.target.playVideo();
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

    function loadMyOpinion()
    {
        $.ajax({
            url: '/quizzes/quiz_population_handler.php',
            type: 'POST',
            data: 'request=newest',
            dataType: 'json',
            success: function(data) {
                if (data.quiz_response[0].response === 200)
                {
                    window.location.href = "/quizzes/complete_quiz.php?uuid=" + data.quiz_response[0].uuid + "&qq=" + data.quiz_response[0].q_quantity;
                }
                
                
                
            }
        });
    }
</script>

<div id="topbar" class="crossbar">
	<div id="videosbutton" class="topbarbutton" onclick="loadCatalogue()">
		<div class="buttontext">
			Catalogue
		</div>
	</div>
	<div id="logoutbutton" class="topbarbutton" onclick="logout()">
		<div class="logoutbuttontext">
			Log Out
		</div>
	</div>
	<?php //dynamically shown admin button - showing it doesn't bypass the admin check in js
	if ($admin)
	{
		echo '<div id="adminbutton" class="topbarbutton" onclick="checkAdminRights()">';
		echo	'<div class="buttontext">';
		echo		'Admin';
		echo	'</div>';
		echo '</div>';
	}
	echo '<div id="quizbutton" class="topbarbutton" onclick="loadMyOpinion()">';
	echo	'<div class="buttontext">';
	echo		'Quiz';
	echo	'</div>';
	echo '</div>';
	?>
	<div id="titlestrip" class="longstrip">
		<div class="largeheading" id="titlestrip">
			Welcome to Trafford L51
		</div>
	</div>
</div>

</head>
<body>
    <div id="indexpanel" class="panel">
        
    </div>
    <div id="sidepanel" class="panel">
        <div id="awardspanel" class="subpanel">
            <div class="listcontainer">
                <div class="award" id="award_star">
                    star
                </div>
                <div class="award" id="award_mvp">
                    mvp
                </div>
            </div>
        </div>
    </div>
</body>
</html>