<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ltm
 * Date: 2/28/14
 * Time: 2:40 PM
 * To change this template use File | Settings | File Templates.
 */

if ( $message = Yii::app()->user->getFlash('success') ) {
    echo '<div id="yw0"><div class="alert alert-error in alert-block fade"><a href="#" class="close" data-dismiss="alert" type="button">×</a>'.
        $message.
        '</div></div>';
}
?>
<div id="mlist">

<?php
foreach ($movies as $movie):?>
    <div class="mItem">
        <div><a href="movie/<?=$movie['id']?>" ><img src="<?=Yii::app()->getBaseUrl(true)?>/images/video-no-thumbnail.png"></a></div>
        <h3><a href="movie/<?=$movie['id']?>" ><?=$movie['title']?></a></h3>
        <span class="bolder">Artist: <?=$movie['artist']?></span>
        <span>Genre: <?=$movie['genre']?></span>

    </div>

<?php endforeach; ?>

</div>