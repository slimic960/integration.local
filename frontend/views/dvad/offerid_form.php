<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $modelOfferId common\models\MappingOfferProductIdDvad */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mapping-country-id-dvad-form">

    <?php $form = ActiveForm::begin(); ?>
    <?php if($modelOfferId): ?>
        <?= $form->field($modelOfferId, 'offer')->textInput(['maxlength' => '45']) ?>

        <?= $form->field($modelOfferId, 'order_items_productId')->textInput(['maxlength' => '45']) ?>

        <div class="form-group">
            <?= Html::submitButton($modelOfferId->isNewRecord ? 'Добавить' : 'Обновить', ['class' => $modelOfferId->isNewRecord ? 'btn btn-success' : 'btn btn-primary',            'data-loading-text' => 'Подождите...', 'autocomplete'=>"off"]) ?>
        </div>
    <?php endif; ?>
    <?php ActiveForm::end(); ?>

</div>
