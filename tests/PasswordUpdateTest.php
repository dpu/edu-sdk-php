<?php

require_once dirname(__DIR__).'/src/Config.php';
require_once dirname(__DIR__).'/src/ToolLogin.php';
require_once dirname(__DIR__).'/src/ToolCrawl.php';
require_once dirname(__DIR__).'/src/PasswordUpdate.php';

class PasswordUpdateTest extends PHPUnit_Framework_TestCase
{
//    public function testLoginAndReturnCookie()
//    {
//        $toolLogin = new \Xu42\Qznjw2014\ToolLogin('1305040201', '2905ryoma');
//        $this->assertStringStartsWith('JSESSIONID=', $cookie = $toolLogin->loginAndReturnCookieOrFalse());
//        return $cookie;
//    }
//
//    /**
//     * @depends testLoginAndReturnCookie
//     */
//    public function testUpdatePasswordSuccess($cookie)
//    {
//        $passwordUpdate = new \Xu42\Qznjw2014\PasswordUpdate($cookie);
//        $this->assertTrue(@$passwordUpdate->set('123456', '234567'));
//    }
//
//    /**
//     * @depends testLoginAndReturnCookie
//     */
//    public function testUpdatePasswordFailed($cookie)
//    {
//        $passwordUpdate = new \Xu42\Qznjw2014\PasswordUpdate($cookie);
//        $this->assertFalse(@$passwordUpdate->set('123456', '123456'));
//    }
}
