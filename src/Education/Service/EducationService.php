<?php

namespace Cn\Xu42\Qznjw2014\Education\Service;

use Cn\Xu42\Qznjw2014\Common\Service\BaseService;
use Cn\Xu42\Qznjw2014\Education\BizImpl\EducationBizImpl;

class EducationService extends BaseService
{
    private $bizImpl = null;

    public function __construct()
    {
        $this->bizImpl = new EducationBizImpl();
    }

    /**
     * 获取学期理论课表
     *
     * @param string $token 用户身份令牌
     * @param string $semester 学年学期, e.g. 2015-2016-1
     * @param string $week 周次
     * @return array
     */
    public function getTimetable($token, $semester, $week = '')
    {
        return $this->bizImpl->getTimetable($token, $semester, $week);
    }

    /**
     * 获取通知公告
     *
     * @param string $token 用户身份令牌
     * @return array
     */
    public function getNotice($token)
    {
        return $this->bizImpl->getNotice($token);
    }

    /**
     * 获取当前周次
     *
     * @return int
     */
    public function getCurrentWeek()
    {
        return $this->bizImpl->getCurrentWeek();
    }

    /**
     * 获取学期成绩
     *
     * @param string $token 用户身份令牌
     * @param string $kksj 开课时间即查询某学期的成绩 默认为空查询所有学期 查询格式为 2014-2015-2(2014-2015学年第二学期)
     * @param string $kcxz 课程性质 默认为空查询所有
     * @param string $kcmc 课程名称 默认为空查询所有 指定某一课程名称进行查询
     * @param string $xsfs 查询结果显示方式，已知有 all(显示全部成绩)和 max(显示最好成绩)，并没有区别
     * @return array
     */
    public function getCoursesScores($token, $kksj = '', $kcxz = '', $kcmc = '', $xsfs = 'all')
    {
        return $this->bizImpl->getCoursesScores($token, $kksj, $kcxz, $kcmc, $xsfs);
    }

    /**
     * 获取等级考试成绩
     *
     * @param string $token 用户身份令牌
     * @return array|null
     */
    public function getLevelScores($token)
    {
        return $this->bizImpl->getLevelScores($token);
    }

    /**
     * 获取考试安排
     *
     * @param string $token 用户身份令牌
     * @param string $semester 学年学期, e.g. 2015-2016-1
     * @param string $category 考试类别, 1 => 期初, 2 => 期中, 3 => 期末
     * @return array
     */
    public function getExamInfo($token, $semester, $category = '3')
    {
        return $this->bizImpl->getExamInfo($token, $semester, $category);
    }

    /**
     * 获取培养方案
     *
     * @param string $token 用户身份令牌
     * @return array|null
     */
    public function getTrainingScheme($token)
    {
        return $this->bizImpl->getTrainingScheme($token);
    }

    /**
     * 获取学籍卡片资料
     *
     * @param string $token 用户身份令牌
     * @return array|null
     */
    public function getSchoolRoll($token)
    {
        return $this->bizImpl->getSchoolRoll($token);
    }
}
