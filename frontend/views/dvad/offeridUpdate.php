<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $modelOfferId common\models\MappingOfferProductIdDvad */

$this->title = 'Update Mapping Country Id Dvad: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Колл-центр DvaD', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Изменить';
?>
<div class="mapping-country-id-dvad-update">
    <?php if($modelOfferId): ?>
        <?= $this->render('offerid_form', [
            'modelOfferId' => $modelOfferId,
        ]) ?>
    <?php endif; ?>
</div>
