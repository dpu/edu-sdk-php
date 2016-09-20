<?php

namespace Xu42\Qznjw2014;

/**
 * 工具 网页抓取
 * Class ToolCrawl
 * @package Xu42\Qznjw2014
 */
class ToolCrawl
{
    /**
     * @var null Cookie
     */
    protected $cookie = null;

    /**
     * @var null Url
     */
    protected $url = null;

    /**
     * @param $cookie string Cookie
     */
    public function __construct($cookie)
    {
        $this->cookie = $cookie;
    }

    /**
     * 对外暴露的唯一方法
     * 获取资源
     * @return mixed 格式化后(正则解析)的数据
     */
    public function get()
    {
        $content = $this->myCurl($this->url, $this->cookie);
        return $this->re($content);
    }

    /**
     * 一个简单的封装CURL网络请求的函数
     * @param $url      string Url
     * @param $cookie   string Cookie
     * @return mixed    网页源代码
     */
    protected function myCurl($url, $cookie, $postdata = '')
    {
        $headers = array('Content-Length:'.strlen($postdata), 'Referer:'.Config::$config['url_login'], 'User-Agent: Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.80 Safari/537.36');
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_COOKIE, $cookie);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $content = curl_exec($ch);
        if (curl_errno($ch)){
            return null;
        }
        curl_close($ch);
        return $content;
    }

    /**
     * 正则解析网页
     * @param $content
     * @return mixed
     */
    protected function re($content)
    {
        return $content;
    }
}
