function loadCatalogue()
{
	window.location = "/catalogue.php";
}
function loadAdminPanel()
{
	window.location = "/admindashboard.php";
}
function loadIndex()
{
	window.location = "/index.php";
}
	
function logout()
{
	$.ajax({
		url: '../logout.php',
		type: 'POST',
		dataType: 'text',
		success: function(data) {
                window.location.reload(true);
		}	
	});
}

function loadQuizMaker()
{
    $.ajax({
	url: 'quizzes/quiz_formation_handler.php',
        type: 'POST',
        data: 'title=Hello', //modify
	dataType: 'json',
	success: function(data) {
            if (data.quiz_response[0].response === 200)
            {
                window.location = "quizzes/create_new_quiz.php?uuid=" + data.quiz_response[0].uuid;
            }
            else
            {
                alert("NO!");
            }
	}	
    });
}



