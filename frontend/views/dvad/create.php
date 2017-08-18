<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\MappingCountryIdDvad */

$this->title = 'Create Mapping Country Id Dvad';
$this->params['breadcrumbs'][] = ['label' => 'Mapping Country Id Dvads', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mapping-country-id-dvad-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
