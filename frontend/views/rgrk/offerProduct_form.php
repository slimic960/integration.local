<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $modelOfferProduct common\models\MappingOfferProductKazeco */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mapping-country-id-dvad-form">

    <?php $form = ActiveForm::begin(); ?>
    <?php if($modelOfferProduct): ?>
        <?= $form->field($modelOfferProduct, 'sp_offer')->textInput(['maxlength' => true]) ?>

        <?= $form->field($modelOfferProduct, 'good_id')->textInput(['maxlength' => true]) ?>

        <?= $form->field($modelOfferProduct, 'productid')->textInput(['maxlength' => true]) ?>

        <?= $form->field($modelOfferProduct, 'product_name')->textInput(['maxlength' => true]) ?>

        <?=$form->field($modelOfferProduct, 'gift')->checkbox(array('value'=>1, 'uncheckValue'=>0)) ?>

        <div class="form-group">
            <?= Html::submitButton($modelOfferProduct->isNewRecord ? 'Добавить' : 'Обновить', ['class' => $modelOfferProduct->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    <?php endif; ?>
    <?php ActiveForm::end(); ?>

</div>
