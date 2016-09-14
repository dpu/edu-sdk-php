<?php

namespace Xu42\Qznjw2014;

/**
 * 考试安排
 * Class ExamsInfo
 * @package Xu42\Qznjw2014
 */
class CurrentWeek extends ToolCrawl
{
    public function __construct($cookie)
    {
        parent::__construct($cookie);
        $this->url = Config::$config['url_index'];
    }

    /**
     * 获取当前周次
     * @return mixed
     */
    public function get()
    {
        $res_data = $this->myCurl($this->url, $this->cookie);
        $data = $this->re($res_data);
        return $data;
    }

    /**
     * 正则解析网页
     * @param $content  string   待解析的网页源码
     * @return mixed    array    考试安排的数组列表
     */
    protected function re($content)
    {
        preg_match('/xiaoli_c\">第 (\d+) 周</', iconv('GBK', 'UTF-8', $content), $weeks);
        return $weeks[1];
    }
}
