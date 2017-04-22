<?php

namespace Cn\Xu42\Qznjw2014\Common\Config;

class UrlConfig extends BaseConfig
{
    /**
     * 教务网站首页
     */
    const INDEX = 'http://jiaowu.dlpu.edu.cn/';

    /**
     * HOST
     */
    const HOST = 'http://210.30.62.8:8080';

    /**
     * 教务系统首页地址
     */
    const LOGIN = 'http://210.30.62.8:8080/jsxsd/';

    /**
     * 登陆时密码正确
     */
    const VERIFY = 'xk/LoginToXk';

    /**
     * 学籍卡片页地址
     */
    const SCHOOL_ROLL = 'grxx/xsxx';

    /**
     * 学期理论课表页地址
     */
    const TIMETABLE = 'xskb/xskb_list.do';

    /**
     * 课程成绩页地址
     */
    const SCORES_COURSES = 'kscj/cjcx_list';

    /**
     * 等级考试页地址
     */
    const SCORES_LEVEL = 'kscj/djkscj_list';

    /**
     * 考试安排信息页地址
     */
    const EXAM_INFO = 'xsks/xsksap_list';

    /**
     * 首页公告页地址
     */
    const NOTICE = 'ggly/ysgg_query';

    /**
     * 密码重置页地址
     */
    const PASSWORD_RESET = 'system/resetPasswd';

    /**
     * 密码修改页地址
     */
    const PASSWORD_UPDATE = 'grsz/grsz_xgmm';

    /**
     * 指导培养方案页地址
     */
    const TRAINING_SCHEME = 'pyfa/pyfazd_query';

}

