<!DOCTYPE HTML>
<!--
	TXT 2.0 by HTML5 UP
	html5up.net | @n33co
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
<head>
    <title>Sweby.co the Web Development Company</title>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="description" content="" />
    <meta name="keywords" content="" />

    <?php Yii::app()->bootstrap->register(); ?>

    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,700|Open+Sans+Condensed:700" rel="stylesheet" />
    <script src="<?=Yii::app()->getBaseUrl(true)?>/js/jquery.min.js"></script>
    <link rel="stylesheet" href="<?=Yii::app()->getBaseUrl(true)?>/css/style.css" />
    </noscript>


</head>
<body class="homepage">

<?php
$this->beginContent('//layouts/header');
$this->endContent();

$this->widget('bootstrap.widgets.TbAlert', array(
    'block'=>true
));

echo '<div id="container" class="container">'.$content.'</div>';

$this->beginContent('//layouts/footer');
$this->endContent();
?>

</body>
</html>