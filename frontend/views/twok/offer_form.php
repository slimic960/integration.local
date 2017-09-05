<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $modelOffers common\models\MappingOfferProductId2K */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mapping-country-id-dvad-form">

    <?php $form = ActiveForm::begin(); ?>
    <?php if($modelOffers): ?>

        <?= $form->field($modelOffers, 'sp_offer')->textInput(['maxlength' => '45']) ?>

        <?= $form->field($modelOffers, 'site')->textInput(['maxlength' => '45']) ?>

        <?= $form->field($modelOffers, 'product_name')->textInput(['maxlength' => '45']) ?>

    <div class="form-group">
        <?= Html::submitButton($modelOffers->isNewRecord ? 'Добавить' : 'Обновить', ['class' => $modelOffers->isNewRecord ? 'btn btn-success' : 'btn btn-primary',            'data-loading-text' => 'Подождите...', 'autocomplete'=>"off"]) ?>
    </div>
    <?php endif; ?>
    <?php ActiveForm::end(); ?>

</div>
