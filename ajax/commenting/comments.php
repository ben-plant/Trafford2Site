<?php

    include '/include/keys.php';

	if (($mysqli = genVideoSQL()) == null)
    {
        return 107;
    }
	
	$allcomments = mysqli_query($mysqli, "SELECT * FROM comments");
	
	$json_array = array();

    while ($row = mysqli_fetch_array($allcomments))
    {
            $json_array['returned_comments'][] = array (
                'comment_id' => $row['comment_id'],
                'comment_video_id' => $row['comment_video_id'],
                'comment_author' => $row['comment_author'],
                'comment_text' => $row['comment_text'],
                'comment_timestamp' => $row['comment_timestamp'],
                'comment_uuid' => $row['comment_uuid'],
                'comment_parent_uuid' => $row['comment_parent_uuid']
            );

    }

    echo json_encode($json_array);
?>