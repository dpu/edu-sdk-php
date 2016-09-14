<?php

namespace Xu42\Qznjw2014;

/**
 * 学期理论课表
 * Class Timetable
 * @package Xu42\Qznjw2014
 */
class Timetable extends ToolCrawl
{
    public function __construct($cookie)
    {
        parent::__construct($cookie);
        $this->url = Config::$config['url_login'] . Config::$config['url_timetable'];
    }


    /**
     * @param string $semester     学年学期 格式例如：2015-2016-1
     * @param string $week        周次 格式例如：1 (为空则获取本学期全部数据)
     * @return array    课表
     */
    public function get($semester, $week = '')
    {
        $postdata = 'xnxq01id=' . $semester . '&zc=' . $week . '&sfFD=1&demo=&cj0701id=';
        $content = $this->myCurl($this->url, $this->cookie, $postdata);
        return $this->re($content);
    }


    /**
     * @param string $content 待解析的网页源代码
     * @return array 课表
     */
    protected function re($content)
    {
        preg_match_all('/<table(.*?)<\/table/s', $content, $theory_table);
        preg_match_all('/<tr>(.*?)<\/tr/s', $theory_table[1][1], $theory_tr);

        $theory_trr = null;
        for ($i = 0; $i < count($theory_tr[1]); $i++) {
            preg_match_all('/>(.*?)</', $theory_tr[1][$i], $temp);
            $theory_trr[] = $temp[1];
        }

        $theory_empty = null;
        for ($i = 0; $i < count($theory_trr); $i++) {
            $theory_empty[] = array_filter($theory_trr[$i]); // 删除数组空元素
        }

        $theory = null;
        for ($i = 0; $i < count($theory_empty); $i++) {
            foreach ($theory_empty[$i] as $v) {
                $theory[$i][] = $v;
            }
        }

        $table = null;
        for ($i = 1; $i < count($theory)-4; $i++) {
            $k = 0;
            for ($j = 0; $j < count($theory[$i]);) {
                if ($theory[$i][$j] != "&nbsp;" && $theory[$i][$j+3] != '----------------------') {
                    $table[$i-1][$k][0] = $theory[$i][$j];
                    $table[$i-1][$k][1] = $theory[$i][$j+1];
                    $table[$i-1][$k][2] = $theory[$i][$j+2];
                    $table[$i-1][$k][3] = $theory[$i][$j+4];
                    $j+=7;
                } elseif ($theory[$i][$j+3] == '----------------------') {
                    $table[$i-1][$k][0] = $theory[$i][$j].'/'.$theory[$i][$j+4];
                    $table[$i-1][$k][1] = $theory[$i][$j+1].'/'.$theory[$i][$j+14];
                    $table[$i-1][$k][2] = $theory[$i][$j+2].'/'.$theory[$i][$j+15];
                    $table[$i-1][$k][3] = $theory[$i][$j+8].'/'.$theory[$i][$j+13];
                    $j+=16;
                } else {
                    $j+=2;
                }
                $k+=1;
            }
        }

        return $table;
    }
}
