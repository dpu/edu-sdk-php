<?php

namespace Cn\Xu42\Qznjw2014\Account\Service;

use Cn\Xu42\Qznjw2014\Account\BizImpl\AccountBizImpl;
use Cn\Xu42\Qznjw2014\Common\Service\BaseService;

class AccountService extends BaseService
{
    private $bizImpl = null;

    public function __construct()
    {
        $this->bizImpl = new AccountBizImpl();
    }


    /**
     * 获取身份令牌
     *
     * @param string $username 用户名|学号
     * @param string $password 密码
     * @return string
     */
    public function getToken($username, $password)
    {
        return $this->bizImpl->getToken($username, $password);
    }

    /**
     * !!!不建议使用!!!
     * 更新密码
     *
     * @param string $token 用户身份令牌
     * @param string $oldPassword 旧密码
     * @param string $newPassword 新密码
     * @return bool
     */
    public function updatePassword($token, $oldPassword, $newPassword)
    {
        return $this->bizImpl->updatePassword($token, $oldPassword, $newPassword);
    }

    /**
     * !!!不建议使用!!!
     * 重置密码
     *
     * @param string $username 用户名|学号
     * @param string $idCard 身份证号
     * @return bool
     */
    public function resetPassword($username, $idCard)
    {
        return $this->bizImpl->resetPassword($username, $idCard);
    }
}
