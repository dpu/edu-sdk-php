<?php

namespace Cn\Xu42\Qznjw2014\Common\Utils;

use Cn\Xu42\Qznjw2014\Common\Config\MonologConfig;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class LogUtils extends BaseUtils
{
    public static function info($e, $message = '')
    {
        $log = new Logger(MonologConfig::$name);
        $stream = new StreamHandler(MonologConfig::$logFilePath, MonologConfig::$level);
        $log->pushHandler($stream);
        $log->info($message, [$e->getMessage(), $e->getCode(), $e->getTraceAsString()]);
    }
}
