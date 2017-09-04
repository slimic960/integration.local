<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $modelOffer common\models\MappingOfferKazeco */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mapping-country-id-dvad-form">

    <?php $form = ActiveForm::begin(); ?>
    <?php if($modelOffer): ?>

        <?= $form->field($modelOffer, 'sp_offer')->textInput(['maxlength' => true]) ?>

        <?= $form->field($modelOffer, 'kazeco_offer')->textInput(['maxlength' => true]) ?>


    <div class="form-group">
        <?= Html::submitButton($modelOffer->isNewRecord ? 'Добавить' : 'Обновить', ['class' => $modelOffer->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    <?php endif; ?>
    <?php ActiveForm::end(); ?>

</div>
