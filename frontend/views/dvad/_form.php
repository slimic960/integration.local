<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\MappingCountryIdDvad */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mapping-country-id-dvad-form">

    <?php $form = ActiveForm::begin(); ?>
    <?php if($modelCountry): ?>
    <?= $form->field($modelCountry, 'order_delivery_address_countryIso')->textInput(['maxlength' => true]) ?>

    <?= $form->field($modelCountry, 'sp_so_country')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($modelCountry->isNewRecord ? 'Create' : 'Update', ['class' => $modelCountry->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    <?php endif; ?>
    <?php ActiveForm::end(); ?>

</div>
