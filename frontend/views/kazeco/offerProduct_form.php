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
        <?= $form->field($modelOfferProduct, 'productid')->textInput(['maxlength' => '45']) ?>

        <?= $form->field($modelOfferProduct, 'product_name')->textInput(['maxlength' => '45']) ?>

        <?= $form->field($modelOfferProduct, 'product_kazeco')->textInput(['maxlength' => '45']) ?>

        <?= $form->field($modelOfferProduct, 'sp_offer')->textInput(['maxlength' => '45']) ?>

        <?=$form->field($modelOfferProduct, 'gift')->checkbox(array('value'=>1, 'uncheckValue'=>0)) ?>

        <div class="form-group">
            <?= Html::submitButton($modelOfferProduct->isNewRecord ? 'Добавить' : 'Обновить', ['class' => $modelOfferProduct->isNewRecord ? 'btn btn-success' : 'btn btn-primary',            'data-loading-text' => 'Подождите...', 'autocomplete'=>"off"]) ?>
        </div>
    <?php endif; ?>
    <?php ActiveForm::end(); ?>

</div>
