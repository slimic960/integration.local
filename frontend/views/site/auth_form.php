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

    <?php foreach ($modelMenuAuth as $k =>$t ): ?>
        <?php $item_name[] = $t->item_name ?>
    <?php endforeach; ?>
    <?php var_dump($item_name); ?>


    <?php Pjax::begin(); ?>
    <?php foreach (\common\models\AuthItem::find()->where(['name' => $item_name, 'type' => 1])->orderBy('name')->all() as $v ) : ?>
        <?= $form->field($t, 'user_id['.$v->name.']')->checkbox(['value' => $v->name, 'label' => $v->name,  'checked ' => ''] ) ?>
    <?php endforeach; ?>

    <?php foreach  (\common\models\AuthItem::find()->where(['type' => 1])->andWhere(['not in', 'name', $item_name])->orderBy('name')->all() as $v ) : ?>
        <?= $form->field($t, 'user_id['.$v->name.']')->checkbox(['value' => $v->name, 'label' => $v->name] ) ?>
    <?php endforeach; ?>

    <?php Pjax::end(); ?>

    <div class="form-group">
        <?= Html::submitButton($t->isNewRecord ? 'Добавить' : 'Обновить', ['class' => $t->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
