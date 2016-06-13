<?php

namespace Xu42\Qznjw2014;

/**
 * 已收公告
 * 注：获取到的公告Url必须添加cookie才可以打开
 * Class Notice
 * @package Xu42\Qznjw2014
 */
class Notice extends ToolCrawl
{
    public function __construct($cookie)
    {
        parent::__construct($cookie);
        $this->url = Config::$config['url_login'] . Config::$config['url_notice'];
    }

    /**
     * 获取公告信息
     */
    public function get()
    {
        $content = $this->myCurl($this->url, $this->cookie);
        return $this->re($content);
    }

    /**
     * @param $content string 网页源代码
     * @return array 用户信息
     */
    protected function re($content)
    {
        preg_match_all('/<tr>(.|\n)*?<\/tr>/', $content, $announcement_tr);

        $data = null;
        for ($i=1; $i<=count($announcement_tr[0])-2; $i++) {
            preg_match_all('/">((.|\n)*?)<\/t/', $announcement_tr[0][$i+1], $list_temp);
            preg_match('/\'(.*?)\'/', $list_temp[1][4], $list_temp_a);
            $list_temp[1][4] = Config::$config['url_host'] . $list_temp_a[1];
            $data[$i-1] = $list_temp[1];
        }
        return $data;
    }
}
