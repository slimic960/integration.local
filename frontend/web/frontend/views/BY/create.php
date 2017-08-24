<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\MappingOffersBY */

$this->title = 'Create Mapping Offers By';
$this->params['breadcrumbs'][] = ['label' => 'Mapping Offers Bies', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mapping-offers-by-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
