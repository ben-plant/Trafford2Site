<?php
	include '/include/keys.php';

	if (($mysqli = genVideoSQL()) == null)
    {
        return 107;
    }
	
	$allviews = mysqli_query($mysqli, "SELECT * FROM videos_watched");
	$allusers	 = mysqli_query($mysqli, "SELECT username, formatted_forename, formatted_surname FROM users");
	
	$json_array = array();
	
	while ($userrow = mysqli_fetch_array($allusers))
	{
		$tempviews = mysqli_query($mysqli, 'SELECT * FROM videos_watched WHERE username = "'.$userrow['username'].'"');
		$temprow = mysqli_fetch_array($tempviews);
        $json_array['returned_view_counts'][] = array (
                'username' 	  => $userrow['formatted_forename']." ".$userrow['formatted_surname'],
                'video_views' => $tempviews->num_rows,
            );
	}
	echo json_encode($json_array);

?>