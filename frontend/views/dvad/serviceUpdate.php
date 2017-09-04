<?php

use yii\helpers\Html;
$this->registerJsFile('/js/editcall.js',
    ['depends' => [\yii\web\JqueryAsset::className()]]
);
/* @var $this yii\web\View */
/* @var $modelService common\models\MappingDeliveryServiceDvad */

$this->params['breadcrumbs'][] = ['label' => 'Колл-центр DvaD', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Изменить';
?>
<div class="mapping-country-id-dvad-update">
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <br>
    <?php if($modelService): ?>
        <?= $this->render('service_form', [
            'modelService' => $modelService,
        ]) ?>
    <?php endif; ?>
        </div>
    </nav>
</div>
