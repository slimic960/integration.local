<?php

use yii\helpers\Html;

$this->registerJsFile('/js/editcall.js',
    ['depends' => [\yii\web\JqueryAsset::className()]]
);
/* @var $this yii\web\View */
/* @var $modelCountry common\models\MappingCountryIdDvad */

$this->params['breadcrumbs'][] = ['label' => 'Колл-центр DvaD', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Изменить';
?>
<div class="mapping-country-id-dvad-update">
    <?php if($modelCountry): ?>
    <?= $this->render('country_form', [
        'modelCountry' => $modelCountry,
    ]) ?>
    <?php endif; ?>
</div>
