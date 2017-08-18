<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\MappingCountryIdDvad */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mapping-country-id-dvad-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'order_delivery_address_countryIso')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sp_so_country')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
