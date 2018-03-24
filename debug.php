<?php

require 'vendor/autoload.php';

set_exception_handler('exception_handler');

function exception_handler($e)
{
    echo 'Uncaught:' . $e->getMessage();
}

$account = new \Org\DLPU\EDU\Account\Service\AccountService();
$token = $account->getToken('1305040333', 'myPassword');

$education = new \Org\DLPU\EDU\Education\Service\EducationService();

var_dump($education->getTimetable($token, '2016-2017-1'));
var_dump($education->getNotice($token));
var_dump($education->getCurrentWeek());
var_dump($education->getCoursesScores($token));
var_dump($education->getLevelScores($token));
var_dump($education->getExamInfo($token, '2016-2017-1'));
var_dump($education->getTrainingScheme($token));
var_dump($education->getSchoolRoll($token));
