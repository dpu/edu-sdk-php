<?php

namespace Cn\Xu42\Qznjw2014\Common\Utils;

use Cn\Xu42\Qznjw2014\Common\Config\UrlConfig;

class CrawlUtils extends BaseUtils
{
    private $token = '';

    private $url = '';

    private $postData = '';


    public function post()
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HEADER, true);
        curl_setopt($ch, CURLOPT_COOKIE, $this->token);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $this->postData);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $this->setHeaders());
        $content = curl_exec($ch);
        curl_close($ch);
        return $content;
    }

    /**
     * @param string $token
     */
    public function setToken($token)
    {
        $this->token = $token;
    }

    /**
     * @param string $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }

    /**
     * @param string $postData
     */
    public function setPostData($postData)
    {
        $this->postData = $postData;
    }

    public function setHeaders()
    {
        return [
            'Content-Length:' . strlen($this->postData),
            'Referer:' . UrlConfig::LOGIN,
            'User-Agent: Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.80 Safari/537.36'
        ];
    }
}
