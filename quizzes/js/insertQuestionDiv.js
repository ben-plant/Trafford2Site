function parseQuestionQuantity()
{
    var params = window.location.search;
    var tmp = params.split("&");
    var qq = tmp[1].split("=");
    return qq[1];
}

function printQuestions()
{
    var qq = parseQuestionQuantity();
    for (var i = 0; i < qq; i++)
    {
        insertQuestion(i);
    }
}

function insertQuestion(input)
{   
    var div = document.createElement('div');
    document.getElementById('quizpanel').appendChild(div);
    div.className = 'question';
    div.innerHTML = input;
}
