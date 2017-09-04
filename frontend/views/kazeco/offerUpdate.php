<?php

use yii\helpers\Html;
$this->registerJsFile('/js/editcall.js',
    ['depends' => [\yii\web\JqueryAsset::className()]]
);
/* @var $this yii\web\View */
/* @var $modelOffer common\models\MappingOfferKazeco*/

$this->params['breadcrumbs'][] = ['label' => 'Колл-центр BY', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Изменить';
?>
<div class="mapping-country-id-dvad-update">
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <br>
    <?php if($modelOffer): ?>
    <?= $this->render('offer_form', [
        'modelOffer' => $modelOffer,
    ]) ?>
    <?php endif; ?>
        </div>
    </nav>
</div>
