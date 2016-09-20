<?php

namespace Xu42\Qznjw2014;

/**
 * 考试安排
 * Class ExamsInfo
 * @package Xu42\Qznjw2014
 */
class ExamsInfo extends ToolCrawl
{
    public function __construct($cookie)
    {
        parent::__construct($cookie);
        $this->url = Config::$config['url_login'] . Config::$config['url_exams_info'];
    }

    /**
     * 获取考生考试安排信息
     * @param $semester  string   学年学期, e.g. 2015-2016-1
     * @param $category  string   考试类别, 1 => 期初, 2 => 期中, 3 => 期末
     * @return mixed     array    考试安排的数组列表
     */
    public function get($semester, $category = '3')
    {
        $postdata = 'xnxqid=' . $semester . '&xqlb=' . $category;
        $content = $this->myCurl($this->url, $this->cookie, $postdata);
        if(is_null($content)){
            return null;
        }
        return $this->re($content);
    }

    /**
     * 正则解析网页
     * @param $content  string   待解析的网页源码
     * @return mixed    array    考试安排的数组列表
     */
    protected function re($content)
    {
        preg_match_all('/<tr>(.*?)<\/tr>/s', $content, $temp_tr);
        $data = null;
        for ($i = 1; $i < count($temp_tr[1]); $i++) {
            preg_match_all('/>(.*?)<\/t/', $temp_tr[1][$i], $temp_td);
            $data[$i-1] = $temp_td[1];
            unset($data[$i-1][7]);
        }
        return $data;
    }
}
