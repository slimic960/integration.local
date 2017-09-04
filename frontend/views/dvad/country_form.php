<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $modelCountry common\models\MappingCountryIdDvad */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mapping-country-id-dvad-form">

    <?php $form = ActiveForm::begin(); ?>
    <?php if($modelCountry): ?>
    <?= $form->field($modelCountry, 'order_delivery_address_countryIso')->textInput(['maxlength' => '45']) ?>

    <?= $form->field($modelCountry, 'sp_so_country')->textInput(['maxlength' => '45']) ?>

    <div class="form-group">
        <?= Html::submitButton($modelCountry->isNewRecord ? 'Добавить' : 'Обновить', ['class' => $modelCountry->isNewRecord ? 'btn btn-success' : 'btn btn-primary',            'data-loading-text' => 'Подождите...', 'autocomplete'=>"off"]) ?>
    </div>
    <?php endif; ?>
    <?php ActiveForm::end(); ?>

</div>
