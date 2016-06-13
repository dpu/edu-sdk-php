<?php

require_once dirname(__DIR__).'/src/Config.php';
require_once dirname(__DIR__).'/src/ToolLogin.php';
require_once dirname(__DIR__).'/src/ToolCrawl.php';
require_once dirname(__DIR__).'/src/Qznjw2014.php';
require_once dirname(__DIR__).'/src/CoursesScores.php';

class Qznjw2014Test extends PHPUnit_Framework_TestCase
{
    public function testCoursesScores()
    {
        $qznjw2014 = new \Xu42\Qznjw2014\Qznjw2014('1305040229', 'l994042O');
        $this->assertInternalType('array', $qznjw2014->coursesScores());
    }

}