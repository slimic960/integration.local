<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $modelOffers common\models\MappingOffersBY */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mapping-country-id-dvad-form">

    <?php $form = ActiveForm::begin(); ?>
    <?php if($modelOffers): ?>

        <?= $form->field($modelOffers, 'sp_offer')->textInput(['maxlength' => true]) ?>

        <?= $form->field($modelOffers, 'by_offer')->textInput(['maxlength' => true]) ?>

        <?= $form->field($modelOffers, 'productid')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($modelOffers->isNewRecord ? 'Добавить' : 'Обновить', ['class' => $modelOffers->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    <?php endif; ?>
    <?php ActiveForm::end(); ?>

</div>
