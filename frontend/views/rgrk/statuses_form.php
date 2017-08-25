<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $modelStatuses common\models\MappingStatusesKazeco */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mapping-country-id-dvad-form">

    <?php $form = ActiveForm::begin(); ?>
    <?php if($modelStatuses): ?>

        <?= $form->field($modelStatuses, 'sostatus')->textInput(['maxlength' => true]) ?>

        <?= $form->field($modelStatuses, 'status')->textInput(['maxlength' => true]) ?>

        <?= $form->field($modelStatuses, 'status_name')->textInput(['maxlength' => true]) ?>

        <div class="form-group">
            <?= Html::submitButton($modelStatuses->isNewRecord ? 'Добавить' : 'Обновить', ['class' => $modelStatuses->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    <?php endif; ?>
    <?php ActiveForm::end(); ?>

</div>
