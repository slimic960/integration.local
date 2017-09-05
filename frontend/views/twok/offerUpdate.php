<?php

use yii\helpers\Html;
$this->registerJsFile('/js/editcall.js',
    ['depends' => [\yii\web\JqueryAsset::className()]]
);
/* @var $this yii\web\View */
/* @var $modelOffers common\models\MappingOfferProductId2K */

$this->params['breadcrumbs'][] = ['label' => 'Колл-центр 2K', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Изменить';
?>
<div class="mapping-country-id-dvad-update">
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <br>
    <?php if($modelOffers): ?>
    <?= $this->render('offer_form', [
        'modelOffers' => $modelOffers,
    ]) ?>
    <?php endif; ?>
        </div>
    </nav>
</div>
