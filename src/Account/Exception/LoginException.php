<?php

namespace Cn\Xu42\Qznjw2014\Account\Exception;

use Cn\Xu42\Qznjw2014\Common\Exception\BaseException;

class LoginException extends BaseException
{
    public $message = '登陆异常 学号或密码错误';

    public $code = '42101101';
}
