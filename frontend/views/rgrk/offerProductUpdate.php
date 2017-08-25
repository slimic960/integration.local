<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $modelOfferProduct common\models\MappingOfferProductKazeco */

$this->params['breadcrumbs'][] = ['label' => 'Колл-центр DvaD', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Изменить';
?>
<div class="mapping-country-id-dvad-update">
    <?php if($modelOfferProduct): ?>
        <?= $this->render('offerProduct_form', [
            'modelOfferProduct' => $modelOfferProduct,
        ]) ?>
    <?php endif; ?>
</div>
