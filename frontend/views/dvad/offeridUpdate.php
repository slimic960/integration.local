<?php

use yii\helpers\Html;
$this->registerJsFile('/js/editcall.js',
    ['depends' => [\yii\web\JqueryAsset::className()]]
);
/* @var $this yii\web\View */
/* @var $modelOfferId common\models\MappingOfferProductIdDvad */

$this->title = 'Update Mapping Country Id Dvad: ';
$this->params['breadcrumbs'][] = ['label' => 'Колл-центр DvaD', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Изменить';
?>
<div class="mapping-country-id-dvad-update">
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <br>
    <?php if($modelOfferId): ?>
        <?= $this->render('offerid_form', [
            'modelOfferId' => $modelOfferId,
        ]) ?>
    <?php endif; ?>
        </div>
    </nav>
</div>
