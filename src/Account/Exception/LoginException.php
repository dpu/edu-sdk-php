<?php

namespace Org\DLPU\EDU\Account\Exception;

use Org\DLPU\EDU\Common\Exception\BaseException;

class LoginException extends BaseException
{
    public $message = '登陆异常 学号或密码错误';

    public $code = '42101101';
}
