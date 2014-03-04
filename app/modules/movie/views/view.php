<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ltm
 * Date: 3/3/14
 * Time: 9:54 AM
 * To change this template use File | Settings | File Templates.
 */

echo CHtml::link('Back To The List', array('list'));
?>

<h1><?=$movie->title?></h1>
<span class="bolder">Artist: <?=$movie->artist?></span>
<span>Genre: <?=$movie->genre?></span>
<div>
<object classid="" width="500" height="400">
        <param name="allowFullScreen" value="true" />
        <param name="allowscriptaccess" value="always" />
        <param name="src" value="<?=$movie->url.$movie->name.$session;?>" />
        <param name="autoplay" value="false" />
        <embed type="application/x-shockwave-flash" width="425" height="344" src="<?=$movie->url.$movie->name.$session;?>" allowscriptaccess="always" allowfullscreen="true">
        </embed>
    </object>
    <div>If you have a troubles with video just
    <?
    echo CHtml::ajaxLink(
        'Recheck Video',
        Yii::app()->createUrl('movie/main/checkout'),
        array (
            'type'=>'POST',
            'dataType'=>'html',
            'success' => "function(){location.reload();}"
        ),
        $htmlOptions=array ()
    );
    ?>
    </div>
</div>