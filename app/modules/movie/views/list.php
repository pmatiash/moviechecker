<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ltm
 * Date: 2/27/14
 * Time: 12:19 AM
 * To change this template use File | Settings | File Templates.
 */

echo '<h1>Movie List</h1>';

echo CHtml::ajaxLink(
    'Check Out Films',
    Yii::app()->createUrl('movie/main/checkout'),
    array (
        'type'=>'POST',
        'dataType'=>'html',
        'update'=> '#mlist'
    ),
    $htmlOptions=array ()
);

$this->renderPartial( '/_list', array('movies' => $movies) );


