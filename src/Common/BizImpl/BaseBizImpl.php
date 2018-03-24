<?php

namespace Org\DLPU\EDU\Common\BizImpl;

use Org\DLPU\EDU\Common\Exception\ArgumentException;
use Org\DLPU\EDU\Common\Exception\CurlException;
use Org\DLPU\EDU\Common\Utils\CrawlUtils;
use Org\DLPU\EDU\Common\Utils\LogUtils;

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