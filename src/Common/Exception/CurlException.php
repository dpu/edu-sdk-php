<?php

namespace Cn\Xu42\Qznjw2014\Common\Exception;

class CurlException extends BaseException
{
    public $message = '网络请求异常';

    public $code = '42101002';
}
