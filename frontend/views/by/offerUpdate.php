<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $modelCountry common\models\MappingOffersBY */

$this->params['breadcrumbs'][] = ['label' => 'Колл-центр BY', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Изменить';
?>
<div class="mapping-country-id-dvad-update">
    <?php if($modelOffers): ?>
    <?= $this->render('offer_form', [
        'modelOffers' => $modelOffers,
    ]) ?>
    <?php endif; ?>
</div>
