<?php
/**
 *
 * SiteController class
 *
 * @author Antonio Ramirez <amigo.cobos@gmail.com>
 * @link http://www.ramirezcobos.com/
 * @link http://www.2amigos.us/
 * @copyright 2013 2amigOS! Consultation Group LLC
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 */

class SiteController extends EController
{

	public function actionIndex()
	{
		$this->render('index');
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

    /**
     * Really light version of login + registration (without confirmation, access rules, restoring password etc)
     */
    public function actionLogin() {
        if (Yii::app()->request->isPostRequest):

            $username = Yii::app()->request->getParam('login');
            $password = Yii::app()->request->getParam('password');

            // If user checked "New user" Sign in him. Really light registration.
            if ( Yii::app()->request->getParam('new') ):

                $userExist = User::model()->findByAttributes(array('name' => $username));
                if ( !empty($username) && !$userExist ):
                    $user = new User();
                    $user->name = $username;
                    $user->password = $password;

                    if ( $user->validate() ):
                        $user->setPassword();
                        $user->save(false);
                        Yii::app()->user->setFlash(TbHtml::ALERT_COLOR_SUCCESS, 'New user has been added');
                    endif;
                else:
                    Yii::app()->user->setFlash(TbHtml::ALERT_COLOR_INFO, 'User already exist. Please login.');
                    $this->redirect(Yii::app()->baseUrl);
                endif;
            endif;

            $identity = new UserIdentity($username, $password);

            if($identity->authenticate()) {
                Yii::app()->user->login($identity, 3600);
                if ( Yii::app()->user->returnUrl != Yii::app()->baseUrl."/" )
                    $this->redirect(Yii::app()->user->returnUrl);
                else
                    $this->redirect(Yii::app()->createAbsoluteUrl('/list'));
            } else {
                switch ($identity->errorCode) {
                    case UserIdentity::ERROR_USERNAME_INVALID :
                        Yii::app()->user->setFlash(TbHtml::ALERT_COLOR_ERROR, 'Wrong username');
                        break;
                    case UserIdentity::ERROR_PASSWORD_INVALID :
                        Yii::app()->user->setFlash(TbHtml::ALERT_COLOR_ERROR, 'Wrong password');
                        break;
                    case UserIdentity::ERROR_TOKEN_INVALID :
                        //Yii::app()->user->setFlash(TbHtml::ALERT_COLOR_WARNING, "Wrong token. You're not allowed in getting movies");
                        Yii::app()->user->setFlash('warning', 'Wrong token. You\'re not allowed in getting movies');
                        break;
                }

                $this->redirect(Yii::app()->baseUrl);
            }
        endif;
    }

    public function actionLogout() {
        Yii::app()->user->logout();
        Yii::app()->user->setFlash('notice', 'Вы вышли из учетной записи');
        $this->redirect(Yii::app()->baseUrl);
    }
}