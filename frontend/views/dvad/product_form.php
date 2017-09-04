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
        <?= $form->field($modelProductId, 'order_items_productId')->textInput(['maxlength' => true]) ?>

        <?= $form->field($modelProductId, 'productid')->textInput(['maxlength' => true]) ?>

        <?= $form->field($modelProductId, 'product_name')->textInput(['maxlength' => true]) ?>

        <div class="form-group">
            <?= Html::submitButton($modelProductId->isNewRecord ? 'Добавить' : 'Обновить', ['class' => $modelProductId->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    <?php endif; ?>
    <?php ActiveForm::end(); ?>

</div>
