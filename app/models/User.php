<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ltm
 * Date: 2/27/14
 * Time: 9:50 AM
 *
 * @property integer $id
 * @property string $name
 * @property string $password
 * @property string $salt
 *
 * To change this template use File | Settings | File Templates.
 */

class User extends ParentModel {

    private static $_saltPref = 'goweb';

    public static function model($className=__CLASS__) {
        return parent::model($className);
    }

    public function tableName() {
        return 'users';
    }

    /**
     * Generates a salt that can be used to generate a password hash.
     * @return string the salt
     */
    public static function generateSalt() {
        return uniqid('', true);
    }

    public function setPassword($password = null){
        $this->salt = self::generateSalt();
        if($password == null){
            $password = $this->password;
        }
        $this->password = md5(self::$_saltPref . $this->salt . $password . $this->salt);
    }

    /**
     * Checks if the given password is correct.
     * @param string the password to be validated
     * @return boolean whether the password is valid
     */
    public function validatePassword($password) {
        return self::hashPassword($password, $this->salt) === $this->password;
    }

    /**
     * Generates the password hash.
     * @param string password
     * @param string salt
     * @return string hash
     */
    public static function hashPassword($password, $salt) {
        return md5(self::$_saltPref . $salt . $password . $salt);
    }

    /**
     * @param bool $isLogin
     * @param null $username
     * @param null $password
     * @return mixed
     */
    public function getToken( $isLogin = false, $username = null, $password = null ) {
        $connector = new ApiConnector();
        return $connector->getToken($this->id, $isLogin, $username, $password);
    }

}