<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $modelService common\models\MappingDeliveryServiceKazeco */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mapping-country-id-dvad-form">

    <?php $form = ActiveForm::begin(); ?>
    <?php if($modelService): ?>

        <?= $form->field($modelService, 'sp_delivery_service')->textInput(['maxlength' => true]) ?>

        <?= $form->field($modelService, 'kz_delivery')->textInput(['maxlength' => true]) ?>

        <?= $form->field($modelService, 'kz_delivery_name')->textInput(['maxlength' => true]) ?>

        <div class="form-group">
            <?= Html::submitButton($modelService->isNewRecord ? 'Добавить' : 'Обновить', ['class' => $modelService->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    <?php endif; ?>
    <?php ActiveForm::end(); ?>

</div>