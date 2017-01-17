<?php

namespace Xu42\Qznjw2014;

/**
 *  课程成绩
 * Class CoursesScores
 * @package Xu42\Qznjw2014
 */
class CoursesScores extends ToolCrawl
{
    public function __construct($cookie)
    {
        parent::__construct($cookie);
        $this->url = Config::$config['url_login'] . Config::$config['url_courses_scores'];
    }

    /**
     * @param string $kksj 开课时间即查询某学期的成绩 默认为空查询所有学期 查询格式为 2014-2015-2(2014-2015学年第二学期)
     * @param string $kcxz 课程性质 默认为空查询所有
     * @param string $kcmc 课程名称 默认为空查询所有 指定某一课程名称进行查询
     * @param string $xsfs 查询结果显示方式，已知有 all(显示全部成绩)和 max(显示最好成绩)，并没有区别
     * @return mixed FALSE for failed OR array for Course Grade(课程成绩)
     */
    public function get($kksj='', $kcxz='', $kcmc='', $xsfs='all')
    {
        $data[0][0] = empty($kksj)?'全部':$kksj;
        $postdata = "xsfs=$xsfs&kksj=$kksj&kcxz=$kcxz&kcmc=$kcmc";
        $content = $this->myCurl($this->url, $this->cookie, $postdata);
        if(is_null($content)){
            return null;
        }
        $result = $this->re($content);
        return $result;
    }

    /**
     * 正则解析成绩信息的网页 获得课程成绩信息
     * @param string $content 成绩信息的网页源码
     * @return mixd FALSE for failed OR array for Course Grade(课程成绩)
     */
    protected function re($content)
    {
        preg_match_all('/<tr>\s(.*?)<\/tr>/s', $content, $t1_grade_list);
        for ($i=0;$i<count($t1_grade_list[1]);$i++) {
            preg_match_all('/(td>|">)(.{0,66}?)<\//', $t1_grade_list[1][$i], $t2_grade_list);
            $data[$i] = $t2_grade_list[2];
        }
        return $data;
    }
}
