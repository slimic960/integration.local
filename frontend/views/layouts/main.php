<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
use frontend\assets\BootboxAsset;

AppAsset::register($this);
BootboxAsset::overrideSystemConfirm();
?>
<?php $this->beginPage() ?>

<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => Html::a(' <span class="logo"></span><i class="material-icons">wc</i>',['/'] , [ 'title' => Yii::t('app', 'Интеграция') ]),
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-integ navbar-fixed-top',
        ],
    ]);
    if (Yii::$app->user->can('admin')) {
    $menuItems[] = '<li class="admin-li">'
        . Html::a('<i class="material-icons admin-icons">settings</i>', Yii::$app->backendUrlManager->createUrl(['/']),
            ['title' => Yii::t('app', 'Админ-панель')])
        . '</li>';
    }
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'Регистрация', 'url' => ['/site/signup'],  'options' => [
            'class' => 'button_guest',
        ]];
        $menuItems[] = ['label' => 'Авторизация', 'url' => ['/site/login'],  'options' => [
            'class' => 'button_guest',
        ]];
    } else {
        $menuItems[] = '<li>'
            . Html::beginForm(['/site/logout'], 'post')
            . Html::submitButton(
                'exit_to_app',
                ['class' => 'btn btn-link logout material-icons admin-icons',  'title' => Yii::t('app', 'Выйти (' . Yii::$app->user->identity->username . ')')]
            )
            . Html::endForm()
            . '</li>';
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<!--кнопка вверх-->
<?= common\widgets\ScrollupWidget::widget() ?>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
