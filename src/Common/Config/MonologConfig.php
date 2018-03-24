<?php

namespace Org\DLPU\EDU\Common\Config;

use Monolog\Logger;

class MonologConfig extends BaseConfig
{
    public static $level = Logger::DEBUG;

    public static $name = 'Qznjw2014';

    public static $logFilePath = '/tmp/qznjw2014.log';

}
