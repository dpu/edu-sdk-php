<?php

namespace Xu42\Qznjw2014;

/**
 * 密码修改
 * Class PasswordUpdate
 * @package Xu42\Qznjw2014
 */
class PasswordUpdate extends ToolCrawl
{
    public function __construct($cookie)
    {
        parent::__construct($cookie);
        $this->url = Config::$config['url_login'] . Config::$config['url_password_update'];
    }


    /**
     * 修改密码
     * @param $oldPasswd  string 旧密码
     * @param $newPasswd  string 新密码
     * @return mixed
     */
    public function set($oldPasswd, $newPasswd)
    {
        if (strlen($newPasswd) < 8) {
            return false;
        }
        $postdata = 'oldpassword=' . $oldPasswd . '&password1=' . $newPasswd . '&password2=' .$newPasswd .'&upt=1';
        $content = $this->myCurl($this->url, $this->cookie, $postdata);
        if (is_null($content)) {
            return false;
        }
        return true;
    }

}
