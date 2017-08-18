<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\MappingDeliveryServiceDvad */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mapping-country-id-dvad-form">

    <?php $form = ActiveForm::begin(); ?>
    <?php if($model): ?>
            <?= $form->field($model, 'sp_delivery_service')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'order_delivery_code')->textInput(['maxlength' => true]) ?>

        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    <?php endif; ?>
    <?php ActiveForm::end(); ?>

</div>
