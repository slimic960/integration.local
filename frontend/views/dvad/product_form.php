<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $modelProductId common\models\MappingProductIdDvad */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mapping-country-id-dvad-form">

    <?php $form = ActiveForm::begin(); ?>
    <?php if($modelProductId): ?>
        <?= $form->field($modelProductId, 'order_items_productId')->textInput(['maxlength' => '45']) ?>

        <?= $form->field($modelProductId, 'productid')->textInput(['maxlength' => '45']) ?>

        <?= $form->field($modelProductId, 'product_name')->textInput(['maxlength' => '45']) ?>

        <div class="form-group">
            <?= Html::submitButton($modelProductId->isNewRecord ? 'Добавить' : 'Обновить', ['class' => $modelProductId->isNewRecord ? 'btn btn-success' : 'btn btn-primary',            'data-loading-text' => 'Подождите...', 'autocomplete'=>"off"]) ?>
        </div>
    <?php endif; ?>
    <?php ActiveForm::end(); ?>

</div>
