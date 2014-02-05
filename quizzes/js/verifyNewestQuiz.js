function verifyQuizIsNewest(uuid)
{
    $.ajax({
	url: 'quiz_date_handler.php',
        type: 'GET',
        data: 'uuid=' + uuid,
	dataType: 'json',
	success: function(data) {
            if (data.quiz_response[0].response === '200')
            {
                alert("Success!");
            }
            else
            {
                alert("NO!");
            }
	}	
    });
}