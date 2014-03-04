<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ltm
 * Date: 2/28/14
 * Time: 2:40 PM
 * To change this template use File | Settings | File Templates.
 */
?>
<div id="mlist">

<?php
//echo $result = "<a href='".."' target='_blank'>".$movie->title."</a><br>";

foreach ($movies as $movie):?>
    <div class="mItem">
        <div><a href="movie/<?=$movie['id']?>" ><img src="<?=Yii::app()->getBaseUrl(true)?>/images/video-no-thumbnail.png"></a></div>
        <h3><a href="movie/<?=$movie['id']?>" ><?=$movie['title']?></a></h3>
        <span class="bolder">Artist: <?=$movie['artist']?></span>
        <span>Genre: <?=$movie['genre']?></span>

    </div>

<?php endforeach; ?>

</div>