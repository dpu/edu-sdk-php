<?php

namespace Xu42\Qznjw2014;

/**
 * 配置文件
 *
 * 所有配置参数均在本文件进行定义
 */

class Config
{
    public static $config = [
        'url_index'           => '',         			       // 教务网站首页
        'url_host'            => '',            		       // HOST
        'url_login'           => '',                                   // 教务系统首页地址
        'url_login_verify'    => 'xk/LoginToXk',                       // 登陆时密码正确
        'url_courses_scores'  => 'kscj/cjcx_list',                     // 课程成绩页地址
        'url_exams_info'      => 'xsks/xsksap_list',                   // 考试安排信息页地址
        'url_userinfo'        => 'grxx/xsxx',                          // 学籍卡片页地址
        'url_level_scores'    => 'kscj/djkscj_list',                   // 等级考试页地址
        'url_notice'          => 'ggly/ysgg_query',                    // 首页公告页地址
        'url_password_reset'  => 'system/resetPasswd',                 // 密码重置页地址
        'url_password_update' => 'grsz/grsz_xgmm',                     // 密码修改页地址
        'url_timetable'       => 'xskb/xskb_list.do',                  // 学期理论课表页地址
        'url_training_scheme' => 'pyfa/pyfazd_query',                  // 指导培养方案页地址
    ];

}
