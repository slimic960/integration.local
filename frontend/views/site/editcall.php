<?php
use yii\helpers\Html;
use yii\bootstrap\Modal;
use yii\bootstrap\ActiveForm;
use yii\grid\GridView;


$this->title = 'Edit';
$this->registerJsFile('/js/editcall.js',
    ['depends' => [\yii\web\JqueryAsset::className()]]);
?>
<div class="site-index">

    <div class="body-content">
        <div class="row">
            <div class="panel-heading"><h1><?= $callcenter->callcenter_name ?></h1></div>
            <!-- Callcenter DVAD-->
            <?php if($callcenter->id == '3'): ?>

                        <div class="panel panel-default">
                            <ul class="list-group">
                                <li class="list-group-item">
                                    <span class="badge"><?= $country_count_dvad ?></span>
                                    Страны
                                </li>
                            </ul>
                            <div class="panel-footer panel-callcenter">
                                <table class="table table_edit_call">
                                <thead> <tr> <th>#</th> <th>Символьный код</th> <th>Страна</th><th></th> </tr> </thead>
                                <?php foreach ($country_dvad as $v): ?>
                                    <tbody>
                                    <tr>
                                        <td><?= Html::encode("{$v->id}") ?> </td>
                                        <td><?= Html::encode("{$v->order_delivery_address_countryIso}") ?></td>
                                        <td><?= Html::encode("{$v->sp_so_country}") ?></td>
                                        <div class="mapping-country-id-dvad-index">

                                        <h1><?= Html::encode($this->title) ?></h1>

                                        <p>
                                            <?= Html::a('Create Mapping Country Id Dvad', ['create'], ['class' => 'btn btn-success']) ?>
                                        </p>
                                        <?= GridView::widget([
                                            'dataProvider' => $dataProvider,
                                            'columns' => [
                                                ['class' => 'yii\grid\SerialColumn'],

                                                'id',
                                                'order_delivery_address_countryIso',
                                                'sp_so_country',

                                                ['class' => 'yii\grid\ActionColumn'],
                                            ],
                                        ]); ?>
                            </div>
                                        <td>
                                            <i class="material-icons button edit">edit</i>
                                            <i class="material-icons button delete">delete</i>
                                        </td>
                                    </tr>
                                    </tbody>
                                <?php endforeach; ?>
                                </table>
                                <div>
                                <?php Modal::begin([
                                    'header' => '<h2>Страны</h2>',
                                    'toggleButton' => [
                                        'label' => 'Добавить',
                                        'tag' => 'button',
                                        'class' => 'btn btn-success btn-edit',
                                    ],
                                    'footer' => 'Описание',
                                ]); ?>

                                <?php $form = ActiveForm::begin() ?>
                                <?= $form->field($model, 'fieldedit') ?>
                                <?= $form->field($model, 'callcenter') ?>
                                <div class="form-group">
                                    <div>
                                        <?= Html::submitButton('Добавить', ['class' => 'btn btn-success']) ?>
                                    </div>
                                </div>
                                <?php ActiveForm::end() ?>
                                <?php Modal::end(); ?>
                                </div>
                            </div>
                        </div>

                <div class="panel panel-default">
                    <ul class="list-group">
                        <li class="list-group-item">
                            <span class="badge"><?= $service_count_dvad ?></span>
                            Сервисы
                        </li>
                    </ul>
                    <div class="panel-footer panel-callcenter">
                        <?php foreach ($service_dvad as $v): ?>
                            <li class="list-group-item"><?= Html::encode("{$v->sp_delivery_service}") ?></li>
                        <?php endforeach; ?>
                        <div class="right">
                            <?php Modal::begin([
                                'header' => '<h2>Сервисы</h2>',
                                'toggleButton' => [
                                    'label' => 'Добавить',
                                    'tag' => 'button',
                                    'class' => 'btn btn-success btn-edit',
                                ],
                                'footer' => 'Описание',
                            ]); ?>

                            <?php $form = ActiveForm::begin() ?>
                            <?= $form->field($model, 'fieldedit') ?>
                            <?= $form->field($model, 'callcenter') ?>
                            <div class="form-group">
                                <div>
                                    <?= Html::submitButton('Добавить', ['class' => 'btn btn-success']) ?>
                                </div>
                            </div>
                            <?php ActiveForm::end() ?>
                            <?php Modal::end(); ?>
                        </div>
                    </div>
                </div>

                <div class="panel panel-default">
                    <ul class="list-group">
                        <li class="list-group-item">
                            <span class="badge"><?= $product_count_dvad ?></span>
                            Продукты
                        </li>
                    </ul>
                    <div class="panel-footer panel-callcenter">
                        <?php foreach ($product_dvad as $v): ?>
                            <li class="list-group-item"><?= Html::encode("{$v->product_name}") ?></li>
                        <?php endforeach; ?>
                        <div class="right">
                            <?php Modal::begin([
                                'header' => '<h2>Продукты</h2>',
                                'toggleButton' => [
                                    'label' => 'Добавить',
                                    'tag' => 'button',
                                    'class' => 'btn btn-success btn-edit',
                                ],
                                'footer' => 'Описание',
                            ]); ?>

                            <?php $form = ActiveForm::begin() ?>
                            <?= $form->field($model, 'fieldedit') ?>
                            <?= $form->field($model, 'callcenter') ?>
                            <div class="form-group">
                                <div>
                                    <?= Html::submitButton('Добавить', ['class' => 'btn btn-success']) ?>
                                </div>
                            </div>
                            <?php ActiveForm::end() ?>
                            <?php Modal::end(); ?>
                        </div>
                    </div>
                </div>
                    <?php endif; ?>

                </div>
        </div>
    </div>

</div>
