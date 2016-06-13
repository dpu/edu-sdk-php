<?php

require_once dirname(__DIR__).'/src/Config.php';
require_once dirname(__DIR__).'/src/ToolLogin.php';
require_once dirname(__DIR__).'/src/ToolCrawl.php';
require_once dirname(__DIR__).'/src/PasswordReset.php';

class PasswordResetTest extends PHPUnit_Framework_TestCase
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
//    public function testResetPasswordSuccess($cookie)
//    {
//        $passwordReset = new \Xu42\Qznjw2014\PasswordReset($cookie);
//        $this->assertTrue(@$passwordReset->set('1305040201', '123456199401011234'));
//    }
//
//    /**
//     * @depends testLoginAndReturnCookie
//     */
//    public function testResetPasswordFailed($cookie)
//    {
//        $passwordReset = new \Xu42\Qznjw2014\PasswordReset($cookie);
//        $this->assertFalse(@$passwordReset->set('1305040201', ''));
//    }
}
