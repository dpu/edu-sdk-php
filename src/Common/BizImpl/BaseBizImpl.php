<?php

namespace Cn\Xu42\Qznjw2014\Common\BizImpl;

use Cn\Xu42\Qznjw2014\Common\Exception\ArgumentException;
use Cn\Xu42\Qznjw2014\Common\Exception\CurlException;
use Cn\Xu42\Qznjw2014\Common\Utils\CrawlUtils;
use Cn\Xu42\Qznjw2014\Common\Utils\LogUtils;

class BaseBizImpl
{
    public function curlRequest($url, $postData, $token = '')
    {
        $crawlUtils = new CrawlUtils();
        $crawlUtils->setUrl($url);
        $crawlUtils->setToken($token);
        $crawlUtils->setPostData($postData);
        try {
            $curlResponse = $crawlUtils->post();
        } catch (\Throwable $throwable) {
            LogUtils::info($throwable);
            throw new CurlException();
        }
        return $curlResponse;
    }

    public function checkToken($token)
    {
        if (empty($token)) throw new ArgumentException('token不能为空');
        if (strlen($token) !== 43) throw new ArgumentException('token非法');
        if (strpos($token, 'JSESSIONID=') === false) throw new ArgumentException('token非法');
    }
}