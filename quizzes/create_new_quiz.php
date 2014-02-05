<html>
<head>
<link rel="stylesheet" type="text/css" href="/css/main.css" />
<link rel="stylesheet" type="text/css" href="/css/quizmaker.css" />
<link href='http://fonts.googleapis.com/css?family=Alegreya+Sans+SC:100' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Covered+By+Your+Grace' rel='stylesheet' type='text/css'>
<noscript>
Javascript is disabled! Without JavaScript, this page won't work. Enable JavaScript. If you don't know how to do this, consult your operations manual.
</noscript>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="../javascript/navigation.js"></script>;
<script language="javascript">
function verifyQuizIsNewest()
{
    $.ajax({
	url: 'quiz_date_handler.php',
    type: 'GET',
    data: 'uuid="<?php echo $_GET['uuid']?>"',
	dataType: 'json',
	success: function(data) {
            if (data.quiz_response[0].response === 200)
            {
                $.ajax({
                    url: 'quiz_filing_handler.php',
                        type: 'POST',
                        data: 'uuid=<?php echo $_GET['uuid']?>', //modify
                    dataType: 'json',
                    success: function(data) {
                            if (data.quiz_response[0].response === 200)
                            {
                                alert("Quiz ID " + data.quiz_response[0].uuid + " created successfully!");
                            }
                            else
                            {
                                switch (data.quiz_response[0].response)
                                {
                                    case 103:
                                        alert("CAUTION! The UUID loaded appears to relate to an existing quiz!");
                                        break;
                                    default:
                                        alert("Broke");
                                        break;
                                }
                            }
                    }	
                });
            }
            else
            {
                alert(data.quiz_response[0].response);
            }
        }	
    });
}
window.onload(verifyQuizIsNewest());
</script>
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
                Quiz Builder - Codename: 'Y U Do Dis?' (Alpha 0.1)
            </div>
        </div>
    </div>
    <div id="quizminorpanel" class="panel">
        <div id="quizminorleftsub" class="panelsubdivision">
             quiz renaming option goes here
        </div>
        <div id="quizminorrightsub" class="panelsubdivision">
             question quantity selector goes here
        </div>
    </div>
    <div id="quizmajorpanel" class="panel">
        <div class="quizquestion" id="1">
            <textarea id="textarea_1" rows="4" columns="50"></textarea>
            <select id="dropdown_1">
                <optgroup label="Y U Do Dis?">
                    <option value="freetext">Free text</option>
                    <option value="slider">Slider 1-10</option>
                </optgroup>
            </select>
        </div>
        <div class="quizquestion" id="2">
            <textarea id="textarea_2" rows="4" columns="50"></textarea>
            <select id="dropdown_2">
                <optgroup label="Y U Do Dis?">
                    <option value="freetext">Free text</option>
                    <option value="slider">Slider 1-10</option>
                </optgroup>
            </select>
        </div>
        <div class="quizquestion" id="3">
            <textarea id="textarea_3" rows="4" columns="50"></textarea>
            <select id="dropdown_3">
                <optgroup label="Y U Do Dis?">
                    <option value="freetext">Free text</option>
                    <option value="slider">Slider 1-10</option>
                </optgroup>
            </select>
        </div>
        <div class="quizquestion" id="4">
            <textarea id="textarea_4" rows="4" columns="50"></textarea>
            <select id="dropdown_4">
                <optgroup label="Y U Do Dis?">
                    <option value="freetext">Free text</option>
                    <option value="slider">Slider 1-10</option>
                </optgroup>
            </select>
        </div>
        <div class="quizquestion" id="5">
            <textarea id="textarea_5" rows="4" columns="50"></textarea>
            <select id="dropdown_5">
                <optgroup label="Y U Do Dis?">
                    <option value="freetext">Free text</option>
                    <option value="slider">Slider 1-10</option>
                </optgroup>
            </select>
        </div>
        <button value="submit" onclick="fileQuiz()">File quiz</button>
    </div>
</body>
<script language="javascript">
function fileQuiz()
{
    for (var i = 1; i <= 5; i++)
    {
        var thisQ = document.getElementById(i).children;
        submitQuestion(i, thisQ[0].value, thisQ[1].value);
    }  
}
function submitQuestion(qNumber, qText, qType)
{
    $.ajax({
        url: 'quiz_builder.php',
        type: 'POST',
        data: {
            'qUUID'   : '<?php echo $_GET['uuid']?>',
            'qNumber' : qNumber,
            'qText'   : qText,
            'qType'   : qType
        },
        dataType: 'json'
    });
} 
</script>
</html>