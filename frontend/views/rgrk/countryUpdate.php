<?php

use yii\helpers\Html;
$this->registerJsFile('/js/editcall.js',
    ['depends' => [\yii\web\JqueryAsset::className()]]
);
/* @var $this yii\web\View */
/* @var $modelCountry common\models\MappingOfferProductRgrk */

$this->params['breadcrumbs'][] = ['label' => 'Колл-центр RGRK', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Изменить';
?>
<div class="mapping-country-id-dvad-update">
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <br>
    <?php if($modelCountry): ?>
    <?= $this->render('country_form', [
        'modelCountry' => $modelCountry,
    ]) ?>
    <?php endif; ?>
        </div>
    </nav>
</div>
