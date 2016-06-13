<?php

require_once dirname(__DIR__).'/src/Config.php';
require_once dirname(__DIR__).'/src/ToolLogin.php';
require_once dirname(__DIR__).'/src/ToolCrawl.php';
require_once dirname(__DIR__).'/src/ExamsInfo.php';

class ExamsInfoTest extends PHPUnit_Framework_TestCase
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
    public function testGetExamsInfo($cookie)
    {
        $examsInfo = new \Xu42\Qznjw2014\ExamsInfo($cookie);
        $this->assertInternalType('array', $examsInfo->get('2015-2016-2', '3'));
    }
}