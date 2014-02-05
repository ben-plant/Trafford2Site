<?php

    include '/include/keys.php';

	$thisvideo = $_POST["video_id"];

	$json_array = array();

	if (($mysqli = genVideoSQL()) == null)
    {
        return 107;
    }
	
	$allcomments = mysqli_query($mysqli, "SELECT * FROM comments WHERE comment_parent_id = 0 AND comment_video_id = ", $thisvideo);
	while ($row = mysqli_fetch_array($allcomments))
	{
		$row_array['comment_id'] = $row['comment_id'];
		$row_array['comment_video_id'] = $row['comment_video_id'];
		$row_array['comment_author'] = $row['comment_author'];
		$row_array['comment_text'] = $row['comment_text'];
		$row_array['comment_timestamp'] = $row['comment_timestamp'];
		$row_array['comment_uuid'] = $row['comment_uuid'];
		$row_array['comment_parent_uuid'] = $row['comment_parent_uuid'];
		
		array_push($json_array, $row_array);
	}
	
	echo json_encode($json_array);
?>