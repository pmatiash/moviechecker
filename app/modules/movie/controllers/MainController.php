<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ltm
 * Date: 2/26/14
 * Time: 11:47 PM
 * To change this template use File | Settings | File Templates.
 */

class MainController extends EController
{


    public function filters(){
        return array(
            'accessControl',
        );
    }

    public function accessRules(){
        return array(
            array(
                'allow',
                'users'=>array('@'),
            ),
            array(
                'deny',
                'users'=>array('*'),
            ),
        );
    }

    public function actionIndex()
    {
        $this->render('/index');
    }

    public function actionList()
    {
        $this->render('/list', array('movies' => $this->getMoviesArray()));
    }

    public function actionCheckout() {
        $this->saveData(ApiConnector::getMovieList());
        Yii::app()->user->setFlash('notice', 'Movie list has been updated.');
        # @TODO: if will be more records need to limitation load (e.g. by 100 at once)
        $this->renderPartial( '/_list', array('movies' => $this->getMoviesArray()) );
    }

    /**
     * @param $mList
     */
    protected function saveData($mList) {
        if ($mList):

            $uSession = null;
            $allMovies = CHtml::listData( Movie::model()->findAll(array("select"=>"id,name")), 'id', 'name');

        foreach ( $mList as $item ) {
            preg_match('#(.*?\/)(\w*\.\w{3,4})(\?.*[^\d]*)#', $item->aurl, $matches);

            if ( isset($matches[1]) && $matches[2] && $matches[3] ) {
                $mUrl = $matches[1];
                $mName = $matches[2];

                // save all session parameters to user's model
                if (!$uSession)
                    User::model()->updateByPk( Yii::app()->user->id, array('session' => $matches[3]) );

                // because we're not getting any unique id from api, need to compare by name
                if ( !in_array($mName, $allMovies) ) {
                    $movie = new Movie();
                    $movie->name = $mName;
                    $movie->url = $mUrl;
                    $movie->artist = $item->artist;
                    $movie->genre = $item->genre;
                    $movie->title = $item->title;
                    $movie->save();
                }
            } else {
                // something went wrong with current url, so move next
                continue;
            }

        }
        endif;
    }

    public function getMoviesArray(){
        return CHtml::listData( Movie::model()->findAll(), 'id', 'attributes');
    }

    public function actionView($id = 0) {
        if($id) {
            $movie = Movie::model()->findByPk($id);
        }

        if(!$movie){
            throw new Exception('404');
        }

        $uSession = User::model()->findByPk(Yii::app()->user->id, array('select' => 'session'));
        $this->render('/view', array('movie' => $movie, 'session' => $uSession->session));
    }

}