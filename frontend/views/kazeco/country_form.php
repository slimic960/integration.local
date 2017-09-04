<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $modelCountry common\models\MappingCountryKazeco */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mapping-country-id-dvad-form">

    <?php $form = ActiveForm::begin(); ?>
    <?php if($modelCountry): ?>

        <?= $form->field($modelCountry, 'sp_country')->textInput(['maxlength' => true]) ?>

        <?= $form->field($modelCountry, 'country_kazeco')->textInput(['maxlength' => true]) ?>

        <?= $form->field($modelCountry, 'sp_so_country')->textInput(['maxlength' => true]) ?>

        <?= $form->field($modelCountry, 'currency_id')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($modelCountry->isNewRecord ? 'Добавить' : 'Обновить', ['class' => $modelCountry->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    <?php endif; ?>
    <?php ActiveForm::end(); ?>

</div>
