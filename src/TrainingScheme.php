<?php

namespace Xu42\Qznjw2014;

/**
 * 指导培养方案
 * Class TrainingScheme
 * @package Xu42\Qznjw2014
 */
class TrainingScheme extends ToolCrawl
{
    public function __construct($cookie)
    {
        parent::__construct($cookie);
        $this->url = Config::$config['url_login'] . Config::$config['url_training_scheme'];
    }

    /**
     * 获取指导培养方案
     * @return array
     */
    public function get()
    {
        $content = $this->myCurl($this->url, $this->cookie);
        $data = $this->re($content);
        return $data;
    }

    /**
     * @param $content string     网页源代码
     * @return array
     */
    protected function re($content)
    {
        preg_match_all('/Nsb_r_list Nsb_table(.*?)table>/s', $content, $table);
        preg_match_all('/<tr>(.*?)<\/tr/s', $table[1][0], $tr);

        $data = null;
        for ($i=0; $i < count($tr[1]); $i++) {
            preg_match_all('/">(.*?)<\//', $tr[1][$i], $td);
            $data[] = $td[1];
        }
        return $data;
    }
}
