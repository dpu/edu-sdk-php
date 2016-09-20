# 强智教学一体化服务平台 成绩课表等部分信息查询接口

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Total Downloads][ico-downloads]][link-downloads]



## Install

Via Composer

``` bash
$ composer require xu42/qznjw2014
```

## Usage

``` php
    require_once './vendor/autoload.php';
    $qznjw2014 = new \Xu42\Qznjw2014\Qznjw2014('yourUsername', 'yourPassword');
    

    /**
     * 课程成绩
     * @param string $kksj 开课时间即查询某学期的成绩 默认为空查询所有学期 查询格式为 2014-2015-2(2014-2015学年第二学期)
     * @param string $kcxz 课程性质 默认为空查询所有
     * @param string $kcmc 课程名称 默认为空查询所有 指定某一课程名称进行查询
     * @param string $xsfs 查询结果显示方式，已知有 all(显示全部成绩)和 max(显示最好成绩)，并没有区别
     * @return mixed
     */
    $qznjw2014->coursesScores($kksj='', $kcxz='', $kcmc='', $xsfs='all');
    

    /**
     * 考试安排
     * @param string $semester 学年学期, e.g. 2015-2016-1
     * @param string $category 考试类别, 1 => 期初, 2 => 期中, 3 => 期末
     * @return mixed
     */
    $qznjw2014->examsinfo($semester, $category = '3');
    

    /**
     * 等级考试成绩
     * @return array
     */
    $qznjw2014->levelScores();
    

    /**
     * 已收公告
     * @return array|mixed
     */
    $qznjw2014->notice();


    /**
     * 密码重置
     * @param string $username 学号
     * @param string $idCard   密码
     * @return bool
     */
    $qznjw2014->passwordReset($username, $idCard);


    /**
     * 密码更新
     * @param string $oldPassword   旧密码
     * @param string $newPassword   新密码
     * @return mixed
     */
    $qznjw2014->passwordUpdate($oldPassword, $newPassword);


    /**
     * 学期理论课表
     * @param string $semester    学期
     * @param string $week        周次
     * @return array
     */
    $qznjw2014->timetable($semester, $week = '');


    /**
     * 培养方案
     * @return array
     */
    $qznjw2014->trainingScheme();


    /**
     * 学籍卡片
     * @return array
     */
    $qznjw2014->userinfo();
    
    
    /**
     * 当前周次
     * @return string
     */
    $qznjw2014->currentWeek();

```

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Testing

Tests unavailable.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security

If you discover any security related issues, please using the issue tracker.

## Credits

- [Xu42](https://github.com/xu42)
- [All Contributors](https://github.com/xu42/qznjw2014/contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/xu42/qznjw2014.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/xu42/qznjw2014.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/xu42/qznjw2014
[link-travis]: https://travis-ci.org/xu42/qznjw2014
[link-scrutinizer]: https://scrutinizer-ci.com/g/xu42/qznjw2014/code-structure
[link-code-quality]: https://scrutinizer-ci.com/g/xu42/qznjw2014
[link-downloads]: https://packagist.org/packages/xu42/qznjw2014
[link-author]: https://github.com/xu42
[link-contributors]: ../../contributors
