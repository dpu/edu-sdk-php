<?php

require_once dirname(__DIR__).'/src/Config.php';
require_once dirname(__DIR__).'/src/ToolLogin.php';

class ToolLoginTest extends PHPUnit_Framework_TestCase
{
    public function testSetsUsernameWithConstructor()
    {
        $toolLogin = new \Xu42\Qznjw2014\ToolLogin('1305040000', '123456');
        $this->assertAttributeEquals('1305040000', 'username', $toolLogin);
    }

    public function testSetPasswordWithConstructor()
    {
        $toolLogin = new \Xu42\Qznjw2014\ToolLogin('1305040000', '123456');
        $this->assertAttributeEquals('123456', 'password', $toolLogin);
    }

    public function testLoginAndReturnFalse()
    {
        $toolLogin = new \Xu42\Qznjw2014\ToolLogin('1305040229', '123456');
        $this->assertFalse($toolLogin->getCookie());
    }

    public function testLoginAndReturnCookie()
    {
        $toolLogin = new \Xu42\Qznjw2014\ToolLogin('1305040201', '2905ryoma');
        $this->assertStringStartsWith('JSESSIONID=', $toolLogin->getCookie());
    }

}