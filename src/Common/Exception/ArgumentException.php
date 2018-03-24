<?php

namespace Org\DLPU\EDU\Common\Exception;

class ArgumentException extends BaseException
{
    public $message = '参数格式异常';

    public $code = '42101001';
}
