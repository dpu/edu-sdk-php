<?php

require_once dirname(__DIR__).'/src/Config.php';
require_once dirname(__DIR__).'/src/ToolLogin.php';
require_once dirname(__DIR__).'/src/ToolCrawl.php';
require_once dirname(__DIR__).'/src/CoursesScores.php';

class CoursesScoresTest extends PHPUnit_Framework_TestCase
{
    public function testLoginAndReturnCookie()
    {
        $toolLogin = new \Xu42\Qznjw2014\ToolLogin('1305040201', '2905ryoma');
        $this->assertStringStartsWith('JSESSIONID=', $cookie = $toolLogin->getCookie());
        return $cookie;
    }

    /**
     * @depends testLoginAndReturnCookie
     */
    public function testGetCoursesScores($cookie)
    {
        $coursesScores = new \Xu42\Qznjw2014\CoursesScores($cookie);
        $this->assertInternalType('array', $coursesScores->get());
    }
}
