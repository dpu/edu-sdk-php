<?php

namespace Xu42\Qznjw2014;

class Qznjw2014
{

    /**
     * @var string cookie
     */
    private $cookie;

    /**
     * Qznjw2014 constructor.
     */
    public function __construct($username, $password = '')
    {
        if (is_null($password) || strlen($password) === 0) {
            $this->cookie = '';
        } else {
            $toolLogin = new ToolLogin($username, $password);
            $this->cookie = $toolLogin->getCookie();
        }
    }

    /**
     * 课程成绩
     * @param string $kksj 开课时间即查询某学期的成绩 默认为空查询所有学期 查询格式为 2014-2015-2(2014-2015学年第二学期)
     * @param string $kcxz 课程性质 默认为空查询所有
     * @param string $kcmc 课程名称 默认为空查询所有 指定某一课程名称进行查询
     * @param string $xsfs 查询结果显示方式，已知有 all(显示全部成绩)和 max(显示最好成绩)，并没有区别
     * @return mixed
     */
    public function coursesScores($kksj='', $kcxz='', $kcmc='', $xsfs='all')
    {
        $coursesScores = new CoursesScores($this->cookie);
        return $coursesScores->get($kksj, $kcxz, $kcmc, $xsfs);
    }

    /**
     * 考试安排
     * @param string $semester 学年学期, e.g. 2015-2016-1
     * @param string $category 考试类别, 1 => 期初, 2 => 期中, 3 => 期末
     * @return mixed
     */
    public function examsinfo($semester, $category = '3')
    {
        $examsinfo = new ExamsInfo($this->cookie);
        return $examsinfo->get($semester, $category);
    }

    /**
     * 等级考试成绩
     * @return array
     */
    public function levelScores()
    {
        $levelScores = new LevelScores($this->cookie);
        return $levelScores->get();
    }

    /**
     * 已收公告
     * @return array|mixed
     */
    public function notice()
    {
        $notice = new Notice($this->cookie);
        return $notice->get();
    }

    /**
     * 密码重置
     * @param string $username 学号
     * @param string $idCard   密码
     * @return bool
     */
    public function passwordReset($username, $idCard)
    {
        $passwordReset = new PasswordReset($this->cookie);
        return $passwordReset->set($username, $idCard);
    }

    /**
     * 密码更新
     * @param string $oldPassword   旧密码
     * @param string $newPassword   新密码
     * @return mixed
     */
    public function passwordUpdate($oldPassword, $newPassword)
    {
        $passwordUpdate = new PasswordUpdate($this->cookie);
        return $passwordUpdate->set($oldPassword, $newPassword);
    }

    /**
     * 学期理论课表
     * @param string $semester    学期
     * @param string $week        周次
     * @return array
     */
    public function timetable($semester, $week = '')
    {
        $timetable = new Timetable($this->cookie);
        return $timetable->get($semester, $week);
    }

    /**
     * 培养方案
     * @return array
     */
    public function trainingScheme()
    {
        $trainingScheme = new TrainingScheme($this->cookie);
        return $trainingScheme->get();
    }

    /**
     * 学籍卡片
     * @return array
     */
    public function userinfo()
    {
        $userinfo = new Userinfo($this->cookie);
        return $userinfo->get();
    }

    /**
     * 当前周次
     * @return string
     */
    public function currentWeek()
    {
        $currentWeek = new CurrentWeek($this->cookie);
        return $currentWeek->get();
    }

    /**
     * 学号与密码是否正确
     * @return bool
     */
    public function isValid()
    {
        return $this->cookie ? true : false;
    }
}
