<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\Modal;
use yii\bootstrap\ActiveForm;


$this->registerJsFile('/js/editcall.js',
    ['depends' => [\yii\web\JqueryAsset::className()]]);

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Dvad';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mapping-country-id-dvad-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="panel panel-default">
        <ul class="list-group">
            <li class="list-group-item">
                <span class="badge"><?= $country_count_dvad ?></span>
                Страны
            </li>
        </ul>
        <div class="panel-footer panel-callcenter">
            <p>
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

                <?= $this->render('_form', [
                    'modelCountry' => $modelCountry,
                ]) ?>
                <?php Modal::end(); ?>
            </div>
            </p>
            <?php Modal::begin([
                'header' => 'Редактирование',
                'id' => 'modal_update_country',
            ]);  ?>
            <?= $this->render('update', [
                'modelCountry' => $modelCountry,
            ]);
            ?>
            <?php Modal::end(); ?>
            <?= GridView::widget([
                'dataProvider' => $dataProviderCountry,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    'order_delivery_address_countryIso',
                    'sp_so_country',

                    [
                        'class' => 'yii\grid\ActionColumn',
                        'headerOptions' => ['width' => '60'],
                        'template' => '{update} {delete}',
                        'buttons' => [
                            'update' => function ($url, $modelCountry) {
                                $options = [
                                    'title' => Yii::t('yii', 'Изменить'),
                                    'aria-label' => Yii::t('yii', 'Изменить'),
                                    'data-toggle' => Yii::t('yii', 'modal'),
                                    'data-target' => Yii::t('yii', '#modal_update_country'),
                                ];
                                return Html::a(
                                    '<i class="material-icons button edit">edit</i>',
                                     $url, $options, $modelCountry);
                            },
                            'delete' => function ($url, $modelCountry) {
                                $options = [
                                    'title' => Yii::t('yii', 'Удалить'),
                                    'aria-label' => Yii::t('yii', 'Удалить'),
                                    'data-confirm' => Yii::t('yii', 'Вы уверены что хотите удалить?'),
                                    'data-method' => 'post',
                                    'data-pjax' => '0',
                                ];
                                return Html::a(
                                    '<i class="material-icons button delete">delete</i>',
                                    $url, $options, $modelCountry);
                            },
                        ],
                    ],

                ],
            ]); ?>
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
            <p>
            <div>
                <?php Modal::begin([
                    'header' => '<h2>Сервисы</h2>',
                    'toggleButton' => [
                        'label' => 'Добавить',
                        'tag' => 'button',
                        'class' => 'btn btn-success btn-edit',
                    ],
                    'footer' => 'Описание',
                ]); ?>

                <?= $this->render('service_form', [
                    'model' => $model,
                ]) ?>
                <?php Modal::end(); ?>
            </div>
            </p>
            <?php Modal::begin([
                'header' => 'Редактирование',
                'id' => 'modal_update_service',
            ]);  ?>
            <?= $this->render('update', [
                'model' => $model,
            ]);
            ?>
            <?php Modal::end(); ?>
            <?= GridView::widget([
                'dataProvider' => $dataProviderService,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    'order_delivery_code',
                    'sp_delivery_service',
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'headerOptions' => ['width' => '60'],
                        'template' => '{update} {delete}',
                        'buttons' => [
                            'update' => function ($url, $model) {
                                $options = [
                                    'title' => Yii::t('yii', 'Изменить'),
                                    'aria-label' => Yii::t('yii', 'Изменить'),
                                    'data-toggle' => Yii::t('yii', 'modal'),
                                    'data-target' => Yii::t('yii', '#modal_update_service'),
                                ];
                                return Html::a(
                                    '<i class="material-icons button edit">edit</i>',
                                    $url, $options, $model);
                            },
                            'delete' => function ($url, $model) {
                                $options = [
                                    'title' => Yii::t('yii', 'Удалить'),
                                    'aria-label' => Yii::t('yii', 'Удалить'),
                                    'data-confirm' => Yii::t('yii', 'Вы уверены что хотите удалить?'),
                                    'data-method' => 'post',
                                    'data-pjax' => '0',
                                ];
                                return Html::a(
                                    '<i class="material-icons button delete">delete</i>',
                                    $url, $options, $model);
                            },
                        ],
                    ],

                ],
            ]); ?>
        </div>
    </div>


</div>
