<?php

namespace Org\DLPU\EDU\Common\Exception;

class NotFoundException extends BaseException
{
    public $message = '未找到资源异常';

    public $code = '42101003';
}
