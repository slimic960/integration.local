<?php

use yii\helpers\Html;
$this->registerJsFile('/js/editcall.js',
    ['depends' => [\yii\web\JqueryAsset::className()]]
);
/* @var $this yii\web\View */
/* @var $modelStatuses common\models\MappingStatuses2K */

$this->params['breadcrumbs'][] = ['label' => 'Колл-центр 2K', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Изменить';
?>
<div class="mapping-country-id-dvad-update">
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <br>
    <?php if($modelStatuses): ?>
        <?= $this->render('statuses_form', [
            'modelStatuses' => $modelStatuses,
        ]) ?>
    <?php endif; ?>
        </div>
    </nav>
</div>
