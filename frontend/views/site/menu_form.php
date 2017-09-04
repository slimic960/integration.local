<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $modelMenu common\models\Menu */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mapping-country-id-dvad-form">

    <?php $form = ActiveForm::begin(); ?>


        <?= $form->field($modelMenu, 'username')->textInput(['maxlength' => true]) ?>

        <?= $form->field($modelMenu, 'email')->textInput(['maxlength' => true]) ?>

        <div class="form-group">
        <?= Html::submitButton($modelMenu->isNewRecord ? 'Добавить' : 'Обновить', ['class' => $modelMenu->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
