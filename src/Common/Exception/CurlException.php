<?php

namespace Org\DLPU\EDU\Common\Exception;

class CurlException extends BaseException
{
    public $message = '网络请求异常';

    public $code = '42101002';
}
