<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\Modal;
use yii\widgets\Pjax;
use nirvana\showloading\ShowLoadingAsset;
ShowLoadingAsset::register($this);


$this->registerJsFile('/js/jquery.cookie.js',
    ['depends' => [\yii\web\JqueryAsset::className()]]
);
$this->registerJsFile('/js/editcall.js',
    ['depends' => [\yii\web\JqueryAsset::className()]]
);

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Колл-центр DvaD';
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
                    'header' => '<h2>Добавить страну</h2>',
                    'toggleButton' => [
                        'label' => 'Добавить',
                        'tag' => 'button',
                        'class' => 'btn btn-success btn-edit',
                    ],
                    'footer' => 'Описание',
                ]); ?>

                <?= $this->render('country_form', [
                    'modelCountry' => $modelCountry,
                ]) ?>
                <?php Modal::end(); ?>
            </div>
            </p>
            <?php Pjax::begin(); ?>
            <?= GridView::widget([
                'dataProvider' => $dataProviderCountry,
                'filterModel' => $searchModelCountry,
                'summary'=>'',
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    'order_delivery_address_countryIso',
                    'sp_so_country',
            [
                'attribute' => 'status_active',
                'format' => 'raw',
                'filter' => [
                    0 => 'Удалена',
                    1 => 'Активна',
                ],
                'headerOptions' => ['width' => '60'],
                'filterInputOptions'=>['class'=>'select_status'],
                'value' => function ($model, $key, $index, $column) {
                    $active = $model->{$column->attribute} === 1;
                    return \yii\helpers\Html::tag(
                        'span',
                        $active ? 'Активна' : 'Удалена',
                        [
                            'class' => 'label label-' . ($active ? 'success' : 'danger'),
                        ]
                    );
                },
            ],
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'header'=>  Html::a('<i class="material-icons button refresh">settings_backup_restore</i>',['index'] , [ 'title' => Yii::t('app', 'Сбросить') ]),
                        'headerOptions' => ['width' => '60'],
                        'template' => '{country-update} {delete-country} {redelete-country}',
                        'buttons' => [
                            'country-update' => function ($url, $modelCountry) {
                                $options = [
                                    'title' => Yii::t('yii', 'Изменить'),
                                    'aria-label' => Yii::t('yii', 'Изменить'),
                                ];
                                return Html::a(
                                    '<i class="material-icons button edit">edit</i>',
                                     $url, $options, $modelCountry);
                            },
                            'delete-country' => function ($url, $modelCountry) {
                                $options = [
                                    'title' => Yii::t('yii', 'Удалить'),
                                    'aria-label' => Yii::t('yii', 'Удалить'),
                                    'data-confirm' => Yii::t('yii', 'Вы уверены что хотите удалить ('.$modelCountry->sp_so_country.') ?'),
                                    'data-method' => 'post',
                                    'data-pjax' => '0',
                                ];
                                 return $modelCountry->status_active == 1 ? Html::a('
                                    <i class="material-icons button delete">delete</i>', $url, $options) : '';
                            },
                            'redelete-country' => function ($url, $modelCountry) {
                                $options = [
                                    'title' => Yii::t('yii', 'Удалить'),
                                    'aria-label' => Yii::t('yii', 'Удалить'),
                                    'data-confirm' => Yii::t('yii', 'Вы уверены что хотите восстановить ('.$modelCountry->sp_so_country.') ?'),
                                    'data-method' => 'post',
                                    'data-pjax' => '0',
                                ];
                                return $modelCountry->status_active == 0 ? Html::a('
                                    <i class="material-icons button redelete">undo</i>', $url, $options, [ 'title' => Yii::t('app', 'Восстановить') ]) : '';
                            },
                        ],
                    ],

                ],
            ]); ?>
            <?php Pjax::end(); ?>
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
                    'header' => '<h2>Добавить сервис</h2>',
                    'toggleButton' => [
                        'label' => 'Добавить',
                        'tag' => 'button',
                        'class' => 'btn btn-success btn-edit',
                    ],
                    'footer' => 'Описание',
                ]); ?>

                <?= $this->render('service_form', [
                    'modelService' => $modelService,
                ]) ?>
                <?php Modal::end(); ?>
            </div>
            </p>
            <?php Pjax::begin(); ?>
            <?= GridView::widget([
                'dataProvider' => $dataProviderService,
                'filterModel' => $searchModelService,
                'summary'=>'',
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    'order_delivery_code',
                    'sp_delivery_service',
                    [
                        'attribute' => 'status_active',
                        'format' => 'raw',
                        'filter' => [
                            0 => 'Удалена',
                            1 => 'Активна',
                        ],
                        'headerOptions' => ['width' => '60'],
                        'filterInputOptions'=>['class'=>'select_status'],
                        'value' => function ($model, $key, $index, $column) {
                            $active = $model->{$column->attribute} === 1;
                            return \yii\helpers\Html::tag(
                                'span',
                                $active ? 'Активна' : 'Удалена',
                                [
                                    'class' => 'label label-' . ($active ? 'success' : 'danger'),
                                ]
                            );
                        },
                    ],
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'header'=>  Html::a('<i class="material-icons button refresh">settings_backup_restore</i>',['index'] , [ 'title' => Yii::t('app', 'Сбросить') ]),
                        'headerOptions' => ['width' => '60'],
                        'template' => '{service-update} {delete-service} {redelete-service}',
                        'buttons' => [
                            'service-update' => function ($id, $modelService) {
                                $options = [
                                    'title' => Yii::t('yii', 'Изменить'),
                                    'aria-label' => Yii::t('yii', 'Изменить'),
                                ];
                                return Html::a(
                                    '<i class="material-icons button edit">edit</i>',
                                     $id, $options, $modelService);
                            },
                            'delete-service' => function ($url, $modelService) {
                                $options = [
                                    'title' => Yii::t('yii', 'Удалить'),
                                    'aria-label' => Yii::t('yii', 'Удалить'),
                                    'data-confirm' => Yii::t('yii', 'Вы уверены что хотите удалить ('.$modelService->sp_delivery_service.') ?'),
                                    'data-method' => 'post',
                                    'data-pjax' => '0',
                                ];
                                return $modelService->status_active == 1 ? Html::a('
                                    <i class="material-icons button delete">delete</i>', $url, $options) : '';
                            },
                            'redelete-service' => function ($url, $modelService) {
                                $options = [
                                    'title' => Yii::t('yii', 'Удалить'),
                                    'aria-label' => Yii::t('yii', 'Удалить'),
                                    'data-confirm' => Yii::t('yii', 'Вы уверены что хотите восстановить ('.$modelService->sp_delivery_service.') ?'),
                                    'data-method' => 'post',
                                    'data-pjax' => '0',
                                ];
                                return $modelService->status_active == 0 ? Html::a('
                                    <i class="material-icons button redelete">undo</i>', $url, $options, [ 'title' => Yii::t('app', 'Восстановить') ]) : '';
                            },
                        ],

                    ],

                ],
            ]); ?>
            <?php Pjax::end(); ?>
        </div>
    </div>


    <div class="panel panel-default">
        <ul class="list-group">
            <li class="list-group-item">
                <span class="badge"><?=  $offer_count_dvad ?></span>
                Оффер
            </li>
        </ul>
        <div class="panel-footer panel-callcenter">
            <p>
            <div>
                <?php Modal::begin([
                    'header' => '<h2>Добавить оффер</h2>',
                    'toggleButton' => [
                        'label' => 'Добавить',
                        'tag' => 'button',
                        'class' => 'btn btn-success btn-edit',
                    ],
                    'footer' => 'Описание',
                ]); ?>

                <?= $this->render('offerid_form', [
                    'modelOfferId' => $modelOfferId,
                ]) ?>
                <?php Modal::end(); ?>
            </div>
            </p>
            <?php Pjax::begin(); ?>
            <?= GridView::widget([
                'dataProvider' => $dataProviderOfferId,
                'filterModel' => $searchModelOfferId,
                'summary'=>'',
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    'offer',
                    'order_items_productId',
                    [
                        'attribute' => 'active',
                        'format' => 'raw',
                        'filter' => [
                            0 => 'Удалена',
                            1 => 'Активна',
                        ],
                        'headerOptions' => ['width' => '60'],
                        'filterInputOptions'=>['class'=>'select_status'],
                        'value' => function ($model, $key, $index, $column) {
                            $active = $model->{$column->attribute} === 1;
                            return \yii\helpers\Html::tag(
                                'span',
                                $active ? 'Активна' : 'Удалена',
                                [
                                    'class' => 'label label-' . ($active ? 'success' : 'danger'),
                                ]
                            );
                        },
                    ],
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'header'=>  Html::a('<i class="material-icons button refresh">settings_backup_restore</i>',['index'] , [ 'title' => Yii::t('app', 'Сбросить') ]),
                        'headerOptions' => ['width' => '60'],
                        'template' => '{offerid-update} {delete-offerid} {redelete-offerid}',
                        'buttons' => [
                            'offerid-update' => function ($id, $modelOfferId) {
                                $options = [
                                    'title' => Yii::t('yii', 'Изменить'),
                                    'aria-label' => Yii::t('yii', 'Изменить'),
                                    'format'=> 'raw',
                                ];
                                return Html::a(
                                    '<i class="material-icons button edit">edit</i>',
                                    $id, $options, $modelOfferId);
                            },
                            'delete-offerid' => function ($url, $modelOfferId) {
                                $options = [
                                    'title' => Yii::t('yii', 'Удалить'),
                                    'aria-label' => Yii::t('yii', 'Удалить'),
                                    'data-confirm' => Yii::t('yii', 'Вы уверены что хотите удалить ('.$modelOfferId->offer.') ?'),
                                    'data-method' => 'post',
                                    'data-pjax' => '0',
                                ];
                                return $modelOfferId->active == 1 ? Html::a('
                                    <i class="material-icons button delete">delete</i>', $url, $options) : '';
                            },
                            'redelete-offerid' => function ($url, $modelOfferId) {
                                $options = [
                                    'title' => Yii::t('yii', 'Удалить'),
                                    'aria-label' => Yii::t('yii', 'Удалить'),
                                    'data-confirm' => Yii::t('yii', 'Вы уверены что хотите восстановить ('.$modelOfferId->offer.') ?'),
                                    'data-method' => 'post',
                                    'data-pjax' => '0',
                                ];
                                return $modelOfferId->active == 0 ? Html::a('
                                    <i class="material-icons button redelete">undo</i>', $url, $options, [ 'title' => Yii::t('app', 'Восстановить') ]) : '';
                            },
                        ],

                    ],

                ],
            ]); ?>
            <?php Pjax::end(); ?>
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
            <p>
            <div>
                <?php Modal::begin([
                    'header' => '<h2>Добавить продукт</h2>',
                    'toggleButton' => [
                        'label' => 'Добавить',
                        'tag' => 'button',
                        'class' => 'btn btn-success btn-edit',
                    ],
                    'footer' => 'Описание',
                ]); ?>

                <?= $this->render('product_form', [
                    'modelProductId' => $modelProductId,
                ]) ?>
                <?php Modal::end(); ?>
            </div>
            </p>
            <?php Pjax::begin(); ?>
            <?= GridView::widget([
                'dataProvider' => $dataProviderProductId,
                'filterModel' => $searchModelProductId,
                'summary'=>'',
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    'order_items_productId',
                    'productid',
                    'product_name',
                    [
                        'attribute' => 'status_active',
                        'format' => 'raw',
                        'filter' => [
                            0 => 'Удалена',
                            1 => 'Активна',
                        ],
                        'headerOptions' => ['width' => '60'],
                        'filterInputOptions'=>['class'=>'select_status'],
                        'value' => function ($model, $key, $index, $column) {
                            $active = $model->{$column->attribute} === 1;
                            return \yii\helpers\Html::tag(
                                'span',
                                $active ? 'Активна' : 'Удалена',
                                [
                                    'class' => 'label label-' . ($active ? 'success' : 'danger'),
                                ]
                            );
                        },
                    ],
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'header'=>  Html::a('<i class="material-icons button refresh">settings_backup_restore</i>',['index'] , [ 'title' => Yii::t('app', 'Сбросить') ]),
                        'headerOptions' => ['width' => '60'],
                        'template' => '{product-update} {delete-productid} {redelete-productid}',
                        'buttons' => [
                            'product-update' => function ($id, $modelProductId) {
                                $options = [
                                    'title' => Yii::t('yii', 'Изменить'),
                                    'aria-label' => Yii::t('yii', 'Изменить'),
                                ];
                                return Html::a(
                                    '<i class="material-icons button edit">edit</i>',
                                    $id, $options, $modelProductId);
                            },
                            'delete-productid' => function ($url, $modelProductId) {
                                $options = [
                                    'title' => Yii::t('yii', 'Удалить'),
                                    'aria-label' => Yii::t('yii', 'Удалить'),
                                    'data-confirm' => Yii::t('yii', 'Вы уверены что хотите удалить ('.$modelProductId->product_name.') ?'),
                                    'data-method' => 'post',
                                    'data-pjax' => '0',
                                ];
                                return $modelProductId->status_active == 1 ? Html::a('
                                    <i class="material-icons button delete">delete</i>', $url, $options) : '';
                            },
                            'redelete-productid' => function ($url, $modelProductId) {
                                $options = [
                                    'title' => Yii::t('yii', 'Удалить'),
                                    'aria-label' => Yii::t('yii', 'Удалить'),
                                    'data-confirm' => Yii::t('yii', 'Вы уверены что хотите восстановить ('.$modelProductId->product_name.') ?'),
                                    'data-method' => 'post',
                                    'data-pjax' => '0',
                                ];
                                return $modelProductId->status_active == 0 ? Html::a('
                                    <i class="material-icons button redelete">undo</i>', $url, $options, [ 'title' => Yii::t('app', 'Восстановить') ]) : '';
                            },
                        ],
                    ],

                ],
            ]); ?>
            <?php Pjax::end(); ?>
        </div>
    </div>


</div>
