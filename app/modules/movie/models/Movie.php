<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ltm
 * Date: 2/28/14
 * Time: 10:37 AM
 * To change this template use File | Settings | File Templates.
 *
 * @property integer $id
 * @property string $name
 * @property string $url
 * @property string $genre
 * @property string $artist
 * @property string $title
 */

class Movie extends ParentModel {

    public static function model($className=__CLASS__) {
        return parent::model($className);
    }

    public function tableName() {
        return 'movies';
    }
}