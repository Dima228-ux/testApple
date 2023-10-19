<?php

use yii\bootstrap4\Html;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;
?>
<header>

    <?php
    NavBar::begin([
        'brandLabel' => "Apple",
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar navbar-expand-md navbar-dark bg-dark fixed-top',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav'],
        'items' => [
            ['label' => 'Home', 'url' => ['/site/index']],
            ['label' => 'Login', 'url' => ['/site/login']],
            ['label' => 'Register', 'url' => ['/site/registed']],

        ],
    ]);
    NavBar::end();
    ?>
</header>