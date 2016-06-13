<?php

namespace Xu42\Qznjw2014;

/**
 * 学籍卡片
 * Class Userinfo
 * @package Xu42\Qznjw2014
 */
class Userinfo extends ToolCrawl
{

    public function __construct($cookie)
    {
        parent::__construct($cookie);
        $this->url = Config::$config['url_login'] . Config::$config['url_userinfo'];
    }

    /**
     * 获取用户信息
     * @return array 用户信息
     */
    public function get()
    {
        $content = $this->myCurl($this->url, $this->cookie);
        $data = $this->re($content);
        return $data;
    }

    /**
     * @param $content string 网页源代码
     * @return array 用户信息
     */
    protected function re($content)
    {
        preg_match_all('/>(.+?)<\/td>/', $content, $match_data_table);

        $match_data_table_trim = null;
        foreach ($match_data_table[1] as $value) { //去除 数组元素中的 &nbsp;
            $match_data_table_trim[] = str_replace('&nbsp;', '', $value);
        }

        // 匹配出学号 $username[0]
        preg_match('/\d+/', $match_data_table_trim[6], $username);
        $match_data_table_trim[0] = $username[0];
        unset($match_data_table_trim[188]);
        return $match_data_table_trim;
    }
}
