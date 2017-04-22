<?php

namespace Cn\Xu42\Qznjw2014\Education\BizImpl;

use Cn\Xu42\Qznjw2014\Common\BizImpl\BaseBizImpl;
use Cn\Xu42\Qznjw2014\Common\Config\UrlConfig;
use Cn\Xu42\Qznjw2014\Common\Exception\NotFoundException;
use Cn\Xu42\Qznjw2014\Common\Utils\LogUtils;

class EducationBizImpl extends BaseBizImpl
{
    public function getTimetable($token, $semester, $week = '')
    {
        $this->checkToken($token);

        $postData = 'xnxq01id=' . $semester . '&zc=' . $week . '&sfFD=1&demo=&cj0701id=';
        $url = UrlConfig::LOGIN . UrlConfig::TIMETABLE;

        $curlResponse = $this->curlRequest($url, $postData, $token);
        return $this->reTimetable($curlResponse);
    }

    public function getNotice($token)
    {
        $this->checkToken($token);

        $url = UrlConfig::LOGIN . UrlConfig::NOTICE;

        $curlResponse = $this->curlRequest($url, '', $token);
        return $this->reNotice($curlResponse);
    }

    public function getCurrentWeek()
    {
        $curlResponse = $this->curlRequest(UrlConfig::INDEX, '');
        return $this->reCurrentWeek($curlResponse);
    }

    public function getCoursesScores($token, $kksj = '', $kcxz = '', $kcmc = '', $xsfs = 'all')
    {
        $this->checkToken($token);

        $postData = "xsfs=$xsfs&kksj=$kksj&kcxz=$kcxz&kcmc=$kcmc";
        $url = UrlConfig::LOGIN . UrlConfig::SCORES_COURSES;

        $curlResponse = $this->curlRequest($url, $postData, $token);
        return $this->reCoursesScores($curlResponse);
    }

    public function getLevelScores($token)
    {
        $this->checkToken($token);

        $url = UrlConfig::LOGIN . UrlConfig::SCORES_LEVEL;

        $curlResponse = $this->curlRequest($url, '', $token);
        return $this->reLevelScores($curlResponse);
    }

    public function getExamInfo($token, $semester, $category = '3')
    {
        $this->checkToken($token);

        $postData = 'xnxqid=' . $semester . '&xqlb=' . $category;
        $url = UrlConfig::LOGIN . UrlConfig::EXAM_INFO;

        $curlResponse = $this->curlRequest($url, $postData, $token);
        return $this->reExamInfo($curlResponse);
    }

    public function getTrainingScheme($token)
    {
        $this->checkToken($token);

        $url = UrlConfig::LOGIN . UrlConfig::TRAINING_SCHEME;

        $curlResponse = $this->curlRequest($url, '', $token);
        return $this->reTrainingScheme($curlResponse);
    }

    public function getSchoolRoll($token)
    {
        $this->checkToken($token);

        $url = UrlConfig::LOGIN . UrlConfig::SCHOOL_ROLL;

        $curlResponse = $this->curlRequest($url, '', $token);
        return $this->reSchoolRoll($curlResponse);
    }

    private function reTimetable($content)
    {
        try {

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
                        $j += 7;
                    } elseif ($theory[$i][$j+3] == '----------------------') {
                        $table[$i-1][$k][0] = $theory[$i][$j] . '/' . $theory[$i][$j+4];
                        $table[$i-1][$k][1] = $theory[$i][$j+1] . '/' . $theory[$i][$j+14];
                        $table[$i-1][$k][2] = $theory[$i][$j+2] . '/' . $theory[$i][$j+15];
                        $table[$i-1][$k][3] = $theory[$i][$j+8] . '/' . $theory[$i][$j+13];
                        $j += 16;
                    } else {
                        $j += 2;
                    }
                    $k += 1;
                }
            }
            return $table;
        } catch (\Throwable $throwable) {
            LogUtils::info($throwable, '正则解析[Timetable]异常');
            throw new NotFoundException();
        }
    }

    private function reNotice($content)
    {
        try {
            preg_match_all('/<tr>(.|\n)*?<\/tr>/', $content, $announcement_tr);

            $notice = null;
            for ($i = 1; $i <= count($announcement_tr[0])-2; $i++) {
                preg_match_all('/">((.|\n)*?)<\/t/', $announcement_tr[0][$i+1], $list_temp);
                preg_match('/\'(.*?)\'/', $list_temp[1][4], $list_temp_a);
                $list_temp[1][4] = UrlConfig::HOST . $list_temp_a[1];
                $notice[$i-1] = $list_temp[1];
                return $notice;
            }
        } catch (\Throwable $throwable) {
            LogUtils::info($throwable, '正则解析[Notice]异常');
            throw new NotFoundException();
        }
    }

    private function reCurrentWeek($content)
    {
        try {
            preg_match('/xiaoli_c\">第 (\d+) 周</', iconv('GBK', 'UTF-8', $content), $matches);
            if (empty($matches[1])) {
                throw new NotFoundException();
            }
            return (int)trim($matches[1]);
        } catch (\Throwable $throwable) {
            LogUtils::info($throwable, '正则解析[CurrentWeek]异常');
            throw new NotFoundException();
        }
    }

    private function reCoursesScores($content)
    {
        try {
            preg_match_all('/<tr>\s(.*?)<\/tr>/s', $content, $t1_grade_list);
            $scores = [];
            for ($i = 0; $i < count($t1_grade_list[1]); $i++) {
                preg_match_all('/(td>|">)(.{0,66}?)<\//', $t1_grade_list[1][$i], $t2_grade_list);
                $scores[$i] = $t2_grade_list[2];
            }
            return $scores;
        } catch (\Throwable $throwable) {
            LogUtils::info($throwable, '正则解析[CoursesScores]异常');
            throw new NotFoundException();
        }
    }

    private function reLevelScores($content)
    {
        try {
            preg_match_all('/Nsb_r_list Nsb_table(.*?)table>/s', $content, $table);
            preg_match_all('/<tr>(.*?)<\/tr/s', $table[1][0], $tr);

            $data = null;
            for ($i = 0; $i < count($tr[1]); $i++) {
                preg_match_all('/>(.*?)<\/t/', $tr[1][$i], $td);
                $data[] = $td[1];
            }

            $data[1] = [
                $data[0][0],
                $data[0][1],
                $data[0][2] . $data[1][0],
                $data[0][2] . $data[1][1],
                $data[0][2] . $data[1][2],
                $data[0][3] . $data[1][0],
                $data[0][3] . $data[1][1],
                $data[0][3] . $data[1][2],
                $data[0][4]
            ];

            unset($data[0]);
            $scores = null;
            foreach ($data as $value) {
                $scores[] = $value;
            }
            return $scores;
        } catch (\Throwable $throwable) {
            LogUtils::info($throwable, '正则解析[LevelScores]异常');
            throw new NotFoundException();
        }
    }

    private function reExamInfo($content)
    {
        try {
            preg_match_all('/<tr>(.*?)<\/tr>/s', $content, $temp_tr);
            $examInfo = null;
            for ($i = 1; $i < count($temp_tr[1]); $i++) {
                preg_match_all('/>(.*?)<\/t/', $temp_tr[1][$i], $temp_td);
                $examInfo[$i-1] = $temp_td[1];
                unset($examInfo[$i-1][7]);
            }
            return $examInfo;
        } catch (\Throwable $throwable) {
            LogUtils::info($throwable, '正则解析[ExamInfo]异常');
            throw new NotFoundException();
        }
    }

    private function reTrainingScheme($content)
    {
        try {
            preg_match_all('/Nsb_r_list Nsb_table(.*?)table>/s', $content, $table);
            preg_match_all('/<tr>(.*?)<\/tr/s', $table[1][0], $tr);

            $trainingScheme = null;
            for ($i = 0; $i < count($tr[1]); $i++) {
                preg_match_all('/">(.*?)<\//', $tr[1][$i], $td);
                $trainingScheme[] = $td[1];
            }
            return $trainingScheme;
        } catch (\Throwable $throwable) {
            LogUtils::info($throwable, '正则解析[TrainingScheme]异常');
            throw new NotFoundException();
        }
    }

    private function reSchoolRoll($content)
    {
        try {
            preg_match_all('/>(.+?)<\/td>/', $content, $matches);

            $schoolRoll = null;
            foreach ($matches[1] as $value) { //去除 数组元素中的 &nbsp;
                $schoolRoll[] = str_replace('&nbsp;', '', $value);
            }

            // 匹配出学号 $username[0]
            preg_match('/\d+/', $schoolRoll[6], $username);
            $schoolRoll[0] = $username[0];
            unset($schoolRoll[188]);
            return $schoolRoll;
        } catch (\Throwable $throwable) {
            LogUtils::info($throwable, '正则解析[SchoolRoll]异常');
            throw new NotFoundException();
        }
    }
}
