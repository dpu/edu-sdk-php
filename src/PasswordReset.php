<?php

namespace Xu42\Qznjw2014;

/**
 * 密码重置
 * Class PasswordReset
 * @package Xu42\Qznjw2014
 */
class PasswordReset extends ToolCrawl
{

    public function __construct($cookie)
    {
        parent::__construct($cookie);
        $this->url = Config::$config['url_login'] . Config::$config['url_password_reset'];
    }

    /**
     * 重置密码
     * @param $username     string 学号
     * @param $idCard      string 身份证号
     * @return bool         重置结果 True for success, False for failed
     */
    public function set($username, $idCard)
    {
        $postdata = 'account='.$username.'&sfzjh='.$idCard;
        $content = $this->myCurl($this->url, '', $postdata);
        if (is_null($content)) {
            return null;
        }
        $resetResult = $this->re($content);
        return $this->isResetSuccess($resetResult);
    }

    /**
     * @param $content string 网页源码
     * @return mixed
     */
    protected function re($content)
    {
        preg_match_all('/alert\(\'(.*?)\'\);/', $content, $data);
        return $data[1][0];
    }

    /**
     * 检测重置密码是否成功
     * "密码已重置为身份证号的后六位" 该字符串在UTF8编码下占42字节
     * @param $resetResult string 重置结果(经过正则之后)
     * @return bool True for success, False for failed
     */
    private function isResetSuccess($resetResult)
    {
        if (strlen($resetResult) == 42) {
            return true;
        }
        return false;
    }
}
