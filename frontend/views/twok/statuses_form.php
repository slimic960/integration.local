<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $modelStatuses common\models\MappingStatuses2K */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mapping-country-id-dvad-form">

    <?php $form = ActiveForm::begin(); ?>
    <?php if($modelStatuses): ?>

        <?= $form->field($modelStatuses, 'sostatus')->textInput(['maxlength' => '45']) ?>

        <?= $form->field($modelStatuses, 'main_status')->textInput(['maxlength' => '45']) ?>

        <div class="form-group">
            <?= Html::submitButton($modelStatuses->isNewRecord ? 'Добавить' : 'Обновить', ['class' => $modelStatuses->isNewRecord ? 'btn btn-success' : 'btn                        btn-primary', 'data-loading-text' => 'Подождите...', 'autocomplete'=>"off"]) ?>
        </div>
    <?php endif; ?>
    <?php ActiveForm::end(); ?>

</div>
