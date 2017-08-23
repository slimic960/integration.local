<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\MappingDeliveryServiceDvad */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mapping-country-id-dvad-form">

    <?php $form = ActiveForm::begin(); ?>
    <?php if($modelOfferId): ?>
        <?= $form->field($modelOfferId, 'offer')->textInput(['maxlength' => true]) ?>

        <?= $form->field($modelOfferId, 'order_items_productId')->textInput(['maxlength' => true]) ?>

        <?= $form->field($modelOfferId, 'active')->textInput(['maxlength' => true]) ?>

        <div class="form-group">
            <?= Html::submitButton($modelOfferId->isNewRecord ? 'Create' : 'Update', ['class' => $modelOfferId->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    <?php endif; ?>
    <?php ActiveForm::end(); ?>

</div>
