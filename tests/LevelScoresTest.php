<?php

require_once dirname(__DIR__).'/src/Config.php';
require_once dirname(__DIR__).'/src/ToolLogin.php';
require_once dirname(__DIR__).'/src/ToolCrawl.php';
require_once dirname(__DIR__).'/src/LevelScores.php';

class LevelScoresTest extends PHPUnit_Framework_TestCase
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
    public function testGetLevelScores($cookie)
    {
        $levelScores = new \Xu42\Qznjw2014\LevelScores($cookie);
        $this->assertInternalType('array', $levelScores->get());
    }
}