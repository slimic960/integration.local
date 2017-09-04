<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $modelMenu common\models\Menu */

$this->params['breadcrumbs'][] = ['label' => 'Пользователи', 'url' => ['menu']];
$this->params['breadcrumbs'][] = 'Изменить';
?>
<div class="mapping-country-id-dvad-update">

    <?= $this->render('menu_form', [
        'modelMenu' => $modelMenu,
    ]) ?>


</div>
