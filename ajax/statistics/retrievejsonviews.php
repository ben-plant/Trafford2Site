<?php
	include '/include/keys.php';

	if (($mysqli = genVideoSQL()) == null)
    {
        return 107;
    }
	
	$allviews = mysqli_query($mysqli, "SELECT * FROM videos_watched");
	$allusers	 = mysqli_query($mysqli, "SELECT username FROM users");
	
	$json_array = array();
	
	while ($userrow = mysqli_fetch_array($allusers))
	{
		$tempviews = mysqli_query($mysqli, 'SELECT * FROM videos_watched WHERE username = "'.$userrow['username'].'"');
		while ($temprow = mysqli_fetch_array($tempviews))
		{
            $json_array['returned_views'][] = array (
                'username' => $temprow['username'],
				'video_id' => $temprow['video_id'],
				'timestamp' => $temprow['timestamp']
            );
		}
	}	
	echo json_encode($json_array);

?>