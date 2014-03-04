<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ltm
 * Date: 2/26/14
 * Time: 11:13 PM
 * To change this template use File | Settings | File Templates.
 */

class UserIdentity extends CUserIdentity
{
    const ERROR_TOKEN_INVALID = 3;

    private $_id;

    /**
     * We can authenticate with success  only users with right token value, so new users must be included to allow list on api host.
     * @return bool|int
     */
    public function authenticate()
    {
        $user = User::model()->find('LOWER(name)=?', array(strtolower($this->username)));
        if ($user === null) {
                $this->errorCode = self::ERROR_USERNAME_INVALID;
                return 0;
        }

        if (!$user->validatePassword($this->password)) {
            $this->errorCode = self::ERROR_PASSWORD_INVALID;
            return 0;
        }

        if (!$user->getToken(true, $this->username, $this->password)) {
            $this->errorCode = self::ERROR_TOKEN_INVALID;
            return 0;
        }


        $this->_id = $user->id;
        $this->setState('id', $user->id);
        $this->setState('name', $user->name);

        $this->errorCode = self::ERROR_NONE;
        return $this->errorCode == self::ERROR_NONE;
    }

    public function getId()
    {
        return $this->_id;
    }


}