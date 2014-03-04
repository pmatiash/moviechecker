<?php if (Yii::app()->user->isGuest) : ?>
<div id="main">
    <?php
    echo CHtml::form('login', 'post', array('id' => 'loginForm'));
    echo CHtml::label('Please Login', 'loginForm', array('class' => 'bolder'));
    echo CHtml::textField('login');
    echo CHtml::passwordField('password');
    echo CHtml::checkBox('new', false);
    echo CHtml::label('Create new user', 'new');
    echo CHtml::submitButton('Login');
    echo CHtml::endForm();

    else :
        echo 'Hello mr.'.Yii::app()->user->name.'<br>';
        echo CHtml::link('Movies list', Yii::app()->createAbsoluteUrl('/list')).'<br>';
        echo CHtml::link('Logout', Yii::app()->createAbsoluteUrl('/site/logout'));
    endif;
    ?>
</div>

