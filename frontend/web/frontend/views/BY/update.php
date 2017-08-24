<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\MappingOffersBY */

$this->title = 'Update Mapping Offers By: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Mapping Offers Bies', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="mapping-offers-by-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
