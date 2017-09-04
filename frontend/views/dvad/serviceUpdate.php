<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $modelService common\models\MappingDeliveryServiceDvad */

$this->params['breadcrumbs'][] = ['label' => 'Колл-центр DvaD', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Изменить';
?>
<div class="mapping-country-id-dvad-update">
    <?php if($modelService): ?>
        <?= $this->render('service_form', [
            'modelService' => $modelService,
        ]) ?>
    <?php endif; ?>
</div>
