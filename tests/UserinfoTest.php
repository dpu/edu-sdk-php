<?php

require_once dirname(__DIR__).'/src/Config.php';
require_once dirname(__DIR__).'/src/ToolLogin.php';
require_once dirname(__DIR__).'/src/ToolCrawl.php';
require_once dirname(__DIR__).'/src/Userinfo.php';

class UserinfoTest extends PHPUnit_Framework_TestCase
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
    public function testGetUserinfo($cookie)
    {
        $userinfo = new \Xu42\Qznjw2014\Userinfo($cookie);
        $this->assertInternalType('array', $userinfo->get());
    }
}
