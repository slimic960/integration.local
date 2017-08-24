<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\MappingOffersBY */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mapping-offers-by-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'sp_offer')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'by_offer')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'productid')->textInput() ?>

    <?= $form->field($model, 'active')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
