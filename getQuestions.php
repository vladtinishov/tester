<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, PUT");
header('Access-Control-Allow-Headers: *');

if (isset($_GET['lesson'])) {
    getQuestions($_GET['lesson']);
}

function getQuestions($lesson)
{
    $fd = fopen("questions/$lesson", 'r');
    $question = [];
    $questions = [];
    while(!feof($fd)) {
        $str = htmlentities(fgets($fd));
        if (!ctype_space($str)) {
            $question[] = trim(preg_replace("/^\S+\s/", '', $str));
        } else {
            if (count($question)) {
                $questions[] = parsedQuestion($question, count($questions) + 1);
            }
            $question = [];
        }
    }
    echo json_encode($questions, JSON_UNESCAPED_UNICODE);
    fclose($fd);
}

function parsedQuestion($question, $num)
{
    $parsedQuestion = [];
    $parsedQuestion['question'] = $question[0];
    $parsedQuestion['num'] = $num;
    for ($i=1; $i < count($question) - 1; $i++) {
        if ($i === 1) {
            $parsedQuestion['answers'][] = [
                'answerText' => $question[$i],
                'isRight' => true
            ];
        }
        else {
            $parsedQuestion['answers'][] = [
                'answerText' => $question[$i],
                'isRight' => false
            ];
        }
    }
    return $parsedQuestion;
}