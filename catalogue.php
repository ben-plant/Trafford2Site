<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<?php
	session_start();
	
	include 'include/keys.php';

	if (($mysqli = genVideoSQL()) == null)
    {
        return 107;
    }
	
	if (empty($_SESSION['username']) || empty($_SESSION['password']))
	{
		header("location:login.php");
	}
	

	
	// else
	// {
		// $admincheck = mysqli_query($mysqli, 'SELECT * FROM users WHERE username="'.$_SESSION['username'].'" and admin_rights="1"');
		// if (($admincheck->num_rows) == 1)
		// {
			// $_SESSION['admin'] = true;
		// }
	// }
				
	$allvideos = mysqli_query($mysqli, "SELECT * FROM videos");
?>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="apple-touch-icon" href="touch-icon-iphone.png"/>
<link href="//fonts.googleapis.com/css?family=Lobster:400" rel="stylesheet" type="text/css">
<link href='http://fonts.googleapis.com/css?family=Alegreya+Sans+SC:100' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Covered+By+Your+Grace' rel='stylesheet' type='text/css'>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Trafford L51</title>
<link rel="stylesheet" type="text/css" href="/css/main.css" />
<link rel="icon" href="favicon.ico">

<script src="javascript/navigation.js"></script>
<script src="javascript/admincheck.js"></script>

<div id="topbar" class="crossbar">
	<div id="videosbutton" class="topbarbutton" onclick="loadIndex()">
		<div class="buttontext">
			Homepage
		</div>
	</div>
	<div id="adminbutton" class="topbarbutton" onclick="loadAdminPanel()">
		<div class="buttontext">
			Admin
		</div>
	</div>
	<div id="titlestrip" class="longstrip">
		<div class="largeheading" id="titlestrip">
			Video Catalogue
		</div>
	</div>
</div>
</head>
<body>
<div id="mainpanel" class="panel">
<?php	
	if ($allvideos->num_rows == 0)
	{
		echo 'No videos yet!';
	}
	else
	{
		while($row = mysqli_fetch_array($allvideos)) //post values
		{
			echo '<a href="video.php?videoid='.$row[video_title].'">';
			echo '<img src="http://img.youtube.com/vi/'.$row[video_url].'/mqdefault.jpg">';
		}
	}
?>
</div>
</body>
</html>