<html>
<head>
<?
	session_start();
	
	if (empty($_SESSION['username']) || empty($_SESSION['password']))
	{
		header("location:login.php");
	}
	if (empty($_SESSION['adminkey']))
	{
		header("location:index.php");
	}
?>

<link rel="apple-touch-icon" href="touch-icon-iphone.png"/>
<link href="//fonts.googleapis.com/css?family=Lobster:400" rel="stylesheet" type="text/css">
<link href='http://fonts.googleapis.com/css?family=Alegreya+Sans+SC:100' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Codystar' rel='stylesheet' type='text/css'>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Trafford L51</title>
<link rel="stylesheet" type="text/css" href="/css/main.css" />
<link rel="stylesheet" type="text/css" href="/css/adminpanel.css" />
<link rel="icon" href="favicon.ico">

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="http://crypto-js.googlecode.com/svn/tags/3.1.2/build/rollups/sha3.js"></script>
<script src="javascript/admincheck.js"></script>
<script src="javascript/navigation.js"></script>
<script src="javascript/modifyCSS.js"></script>
<script src="javascript/cookie.js"></script>

<script language="javascript" type="text/javascript">
	function getViewCounts()
	{
		$.ajax({
		url: 'ajax/statistics/retrievejsonviewcounts.php',
		dataType: 'json',
		success: function(data) {

			}	
		});
	}
	function getUnauthUsers()
	{
		$.ajax({
		url: 'ajax/usermanagement/retrieveunauthusers.php',
		dataType: 'json',
		success: function(data) {

			}	
		});
	}
</script>
<noscript>
Sorry! This portal requires JavaScript to function. Sad face.
</noscript>
</head>
<body>
<div id="topbar" class="crossbar">
	<div id="videosbutton" class="topbarbutton" onclick="loadIndex()">
		<div class="buttontext">
			Homepage
		</div>
	</div>
	<div id="titlestrip" class="longstrip">
		<div class="largeheading" id="titlestrip">
			Administration
		</div>
	</div>
</div>
<div id="mainpanel" class="panel">
	<div id="makequiz" class="adminpanelbutton" onclick="loadQuizMaker()">
		Build a Quiz
	</div>
</div>
</body>
</html>
