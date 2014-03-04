<?php
/**
 * Getting data from remote API.
 * Created by JetBrains PhpStorm.
 * User: ltm
 * Date: 2/27/14
 * Time: 12:17 AM
 * To change this template use File | Settings | File Templates.
 */

Yii::$classMap=array(
    'Zend_Http_Client' => Yii::app()->basePath.'/lib/vendor/Zend/Http/Client.php'
);

class ApiConnector
{

    /**
     * Getting token from remote api.
     * @param $userId
     * @param bool $isLogin
     * @param null $userName
     * @param null $password
     * @return mixed
     */
    public static function getToken($userId, $isLogin = false, $userName = null, $password = null)
    {
        if ( !Yii::app()->cache->get('auth_token_'.$userId) ):

            if ($isLogin) {
                $url = Yii::app()->params['api.server']."/auth/login?login=$userName&password=$password";
            } else {
                $url = Yii::app()->cache->get('auth_url_'.$userId);
            }

            $client = new Zend_Http_Client($url);
            $client->setMethod('GET');

            $response = json_decode( $client->request()->getBody() );
            # @TODO: error handler
            if ( isset($response->error) && $response->error == 0 && isset($response->token) && !empty($response->token) ) {
                Yii::app()->cache->set( 'auth_token_' .$userId, $response->token, 60*20 );
                Yii::app()->cache->set( 'auth_url_'. $userId, $url, 60*60*24 );
                return $response->token;
            }
            return false;
        endif;

        return Yii::app()->cache->get('auth_token_'.$userId);
    }

    public static function getMovieList() {

        $url = Yii::app()->params['api.server']."/media/list";
        $token = self::getToken(Yii::app()->user->id);
        $options = array();

        $headers = array(
            'Accept'            => 'text/html, application/xml;q=0.9, application/xhtml+xml, image/png, image/jpeg, image/gif, image/x-xbitmap, */*;q=0.1',
            'Accept-Language'   => 'ru-UA,ru;q=0.9,uk;q=0.8,en;q=0.7,eo;q=0.6',
            'Accept-Charset'    => 'utf-8, utf-16, windows-1251 *;q=0.1',
            'Accept-Encoding'   => 'deflate, gzip, x-gzip, identity, *;q=0',
            'Cache-Control'     => 'no-cache',
            'TE'                => 'deflate, gzip, chunked, identity, trailers',
            'X-Auth-Token' => $token,
        );

        $options = array_merge( array(
            'maxredirects'  => 10,
            'timeout'       => 30,
            'useragent'     => 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/536.5 (KHTML, like Gecko) Chrome/19.0.1084.52 Safari/536.5',
            'keepalive'     => TRUE,
            'referer'       => 'http://google.com/'
        ), $options );


        $client = new Zend_Http_Client($url, $options);
        $client->setHeaders($headers);
        $client->setMethod('GET');

        $response = json_decode($client->request()->getBody());

        if ( isset($response->error) && $response->error == 0 && isset($response->list) && !empty($response->list))
            return $response->list;

        return false;
    }
}