<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ltm
 * Date: 2/28/14
 * Time: 3:18 PM
 * To change this template use File | Settings | File Templates.
 */
?>

<object classid="" width="425" height="344">
    <param name="allowFullScreen" value="true" />
    <param name="allowscriptaccess" value="always" />
    <param name="src" value="<?=$movie->url.$movie->name.$session?>" />
    <param name="allowfullscreen" value="true" />
    <param name="autoplay" value="false" />
    <embed type="application/x-shockwave-flash" width="425" height="344" src="<?=$movie->url.$movie->name.$session?>" allowscriptaccess="always" allowfullscreen="true">
    </embed>
</object>