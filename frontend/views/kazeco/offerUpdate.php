<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $modelOffer common\models\MappingOfferKazeco*/

$this->params['breadcrumbs'][] = ['label' => 'Колл-центр BY', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Изменить';
?>
<div class="mapping-country-id-dvad-update">
    <?php if($modelOffer): ?>
    <?= $this->render('offer_form', [
        'modelOffer' => $modelOffer,
    ]) ?>
    <?php endif; ?>
</div>
