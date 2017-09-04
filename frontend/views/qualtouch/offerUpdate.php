<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $modelOffers common\models\MappingOfferQualtouch */

$this->params['breadcrumbs'][] = ['label' => 'Колл-центр Qualtouch', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Изменить';
?>
<div class="mapping-country-id-dvad-update">
    <?php if($modelOffers): ?>
    <?= $this->render('offer_form', [
        'modelOffers' => $modelOffers,
    ]) ?>
    <?php endif; ?>
</div>
