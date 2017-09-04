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

        <?= $form->field($modelService, 'sp_delivery_service')->textInput(['maxlength' => '45']) ?>

        <?= $form->field($modelService, 'kz_delivery')->textInput(['maxlength' => '45']) ?>

        <?= $form->field($modelService, 'kz_delivery_name')->textInput(['maxlength' => '45']) ?>

        <div class="form-group">
            <?= Html::submitButton($modelService->isNewRecord ? 'Добавить' : 'Обновить', ['class' => $modelService->isNewRecord ? 'btn btn-success' : 'btn btn-primary',            'data-loading-text' => 'Подождите...', 'autocomplete'=>"off"]) ?>
        </div>
    <?php endif; ?>
    <?php ActiveForm::end(); ?>

</div>
