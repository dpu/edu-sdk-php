<?php

namespace Xu42\Qznjw2014;

/**
 * 等级考试成绩
 * Class LevelScores
 * @package Xu42\Qznjw2014
 */
class LevelScores extends ToolCrawl
{

    public function __construct($cookie)
    {
        parent::__construct($cookie);
        $this->url = Config::$config['url_login'] . Config::$config['url_level_scores'];
    }

    /**
     * 获取等级考试成绩
     * @return array
     */
    public function get()
    {
        $content = $this->myCurl($this->url, $this->cookie);
        $data = $this->re($content);
        return $data;
    }

    /**
     * @param $content  string   网页源代码
     * @return array        等级考试成绩
     */
    protected function re($content)
    {
        preg_match_all('/Nsb_r_list Nsb_table(.*?)table>/s', $content, $table);
        preg_match_all('/<tr>(.*?)<\/tr/s', $table[1][0], $tr);

        $data = null;
        for ($i=0; $i < count($tr[1]); $i++) {
            preg_match_all('/>(.*?)<\/t/', $tr[1][$i], $td);
            $data[] = $td[1];
        }

        $data[1] = [
            $data[0][0],
            $data[0][1],
            $data[0][2].$data[1][0],
            $data[0][2].$data[1][1],
            $data[0][2].$data[1][2],
            $data[0][3].$data[1][0],
            $data[0][3].$data[1][1],
            $data[0][3].$data[1][2],
            $data[0][4]
        ];

        unset($data[0]);
        $res = null;
        foreach ($data as $value) {
            $res[] = $value;
        }
        return $res;
    }
}
