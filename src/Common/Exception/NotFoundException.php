<?php

namespace Cn\Xu42\Qznjw2014\Common\Exception;

class NotFoundException extends BaseException
{
    public $message = '未找到资源异常';

    public $code = '42101003';
}
