<?php

    $path = $_SERVER['DOCUMENT_ROOT'];
    $path .= '/include/keys.php';
    include_once($path);

	if (($mysqli = genVideoSQL()) == null)
    {
        return 107;
    }
	$username = $_POST["username"];
	$video_id = $_POST["video_id"];
	
	if ($mysqli->connect_errno) {
		echo "Failed to connect to MySQL to retrieve videos with error code:".$mysqli->connect_errno;
		echo "Server said:".$mysqli->connect_error;
	}
	
	if (!($update = $mysqli->prepare("INSERT INTO videos_watched(username, video_id) VALUES (?, ?)")))
	{
		echo "PREPARE STMT FAIL: " . $mysqli->errno . " WITH " . $mysqli->error;
	}
	$update->bind_param("ss", $username, $video_id);
	$update->execute();
	
	echo "THANKS FOR WATCHING!";
?>