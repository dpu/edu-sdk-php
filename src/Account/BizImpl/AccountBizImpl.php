<?php

namespace Cn\Xu42\Qznjw2014\Account\BizImpl;

use Cn\Xu42\Qznjw2014\Account\Exception\LoginException;
use Cn\Xu42\Qznjw2014\Common\BizImpl\BaseBizImpl;
use Cn\Xu42\Qznjw2014\Common\Config\UrlConfig;
use Cn\Xu42\Qznjw2014\Common\Exception\ArgumentException;
use Cn\Xu42\Qznjw2014\Common\Utils\LogUtils;

class AccountBizImpl extends BaseBizImpl
{
    public function getToken($username, $password)
    {
        if (strlen($username) !== 10 || empty($password)) throw new ArgumentException('学号或密码格式错误');

        $postData = "USERNAME=$username&PASSWORD=$password";
        $url = UrlConfig::LOGIN . UrlConfig::VERIFY;

        $curlResponse = $this->curlRequest($url, $postData);

        preg_match('/Location:\s(.*?)\sContent/', $curlResponse, $matches);

        if (count($matches) != 2) {
            $e = new LoginException();
            LogUtils::info($e);
            throw $e;
        }

        preg_match('/Set-Cookie:\s(.*?);/', $curlResponse, $cookie);

        return trim($cookie[1]);
    }

    public function updatePassword($token, $oldPassword, $newPassword)
    {
        $this->checkToken($token);

        if ($oldPassword === $newPassword) throw new ArgumentException('新旧密码不能相同');
        if (empty($oldPassword) || strlen($newPassword) < 6) throw new ArgumentException('新旧密码不能为空且新密码不能小于6位');

        $postData = 'oldpassword=' . $oldPassword . '&password1=' . $newPassword . '&password2=' . $newPassword . '&upt=1';
        $url = UrlConfig::LOGIN . UrlConfig::PASSWORD_UPDATE;

        $curlResponse = $this->curlRequest($url, $postData, $token);

        return $curlResponse ? true : false;
    }

    public function resetPassword($username, $idCard)
    {
        if (strlen($username) !== 10 || strlen($idCard) !== 18) throw new ArgumentException('学号或身份证号格式错误');

        $postData = 'account=' . $username . '&sfzjh=' . $idCard;
        $url = UrlConfig::LOGIN . UrlConfig::PASSWORD_RESET;

        $curlResponse = $this->curlRequest($url, $postData);

        return (strlen($curlResponse) === 42) ? true : false;
    }

}
