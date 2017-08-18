<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\MappingCountryIdDvad */

//$this->title = 'Update Mapping Country Id Dvad: ' . $model->id;
//$this->params['breadcrumbs'][] = ['label' => 'Mapping Country Id Dvads', 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
//$this->params['breadcrumbs'][] = 'Update';
?>
<div class="mapping-country-id-dvad-update">
    <?php if($modelCountry): ?>
    <?= $this->render('_form', [
        'modelCountry' => $modelCountry,
    ]) ?>
    <?php endif; ?>
    <?php if($model): ?>
        <?= $this->render('service_form', [
            'model' => $model,
        ]) ?>
    <?php endif; ?>
</div>
