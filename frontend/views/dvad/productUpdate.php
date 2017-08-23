<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $modelProductId common\models\MappingProductIdDvad */

$this->params['breadcrumbs'][] = ['label' => 'Колл-центр DvaD', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Изменить';
?>
<div class="mapping-country-id-dvad-update">
    <?php if($modelProductId): ?>
        <?= $this->render('product_form', [
            'modelProductId' => $modelProductId,
        ]) ?>
    <?php endif; ?>
</div>
