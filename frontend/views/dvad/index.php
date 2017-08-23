<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\Modal;
use yii\widgets\Pjax;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;

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
                    'header' => '<h2>Страны</h2>',
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
                'filterModel' => $searchModel,
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
                        'header'=>  Html::a('<i class="material-icons button refresh">settings_backup_restore</i>',['index']),
                        'headerOptions' => ['width' => '60'],
                        'template' => '{country-update} {delete}',
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
                    'header' => '<h2>Сервисы</h2>',
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
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    'order_delivery_code',
                    'sp_delivery_service',
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'headerOptions' => ['width' => '60'],
                        'template' => '{service-update} {delete}',
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
                            'delete' => function ($url, $modelService) {
                                $options = [
                                    'title' => Yii::t('yii', 'Удалить'),
                                    'aria-label' => Yii::t('yii', 'Удалить'),
                                    'data-confirm' => Yii::t('yii', 'Вы уверены что хотите удалить?'),
                                    'data-method' => 'post',
                                    'data-pjax' => '0',
                                ];
                                return Html::a(
                                    '<i class="material-icons button delete">delete</i>',
                                    $url, $options, $modelService);
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
                    'header' => '<h2>Сервисы</h2>',
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

<!--            --><?php //Modal::begin([
//                'header' => 'Редактирование',
//                'id' => 'modal_update_service',
//            ]);  ?>
<!--            --><?//= $this->render('serviceUpdate', [
//                'modelOfferId' => $modelOfferId,
//            ]);
//            ?>
<!--            --><?php //Modal::end(); ?>

            <?php Pjax::begin(); ?>
            <?= GridView::widget([
                'dataProvider' => $dataProviderOfferId,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    'offer',
                    'order_items_productId',
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'headerOptions' => ['width' => '60'],
                        'template' => '{offerid-update} {delete}',
                        'buttons' => [
                            'offerid-update' => function ($id, $modelOfferId) {
                                $options = [
                                    'title' => Yii::t('yii', 'Изменить'),
                                    'aria-label' => Yii::t('yii', 'Изменить'),
//                                    'data-toggle' => Yii::t('yii', 'modal'),
//                                    'data-target' => Yii::t('yii', '#modal_update_service'),
                                    'format'=> 'raw',
                                ];
                                return Html::a(
                                    '<i class="material-icons button edit">edit</i>',
                                    $id, $options, $modelOfferId);
                            },
                            'delete' => function ($url, $modelOfferId) {
                                $options = [
                                    'title' => Yii::t('yii', 'Удалить'),
                                    'aria-label' => Yii::t('yii', 'Удалить'),
                                    'data-confirm' => Yii::t('yii', 'Вы уверены что хотите удалить?'),
                                    'data-method' => 'post',
                                    'data-pjax' => '0',
                                ];
                                return Html::a(
                                    '<i class="material-icons button delete">delete</i>',
                                    $url, $options, $modelOfferId);
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
                    'header' => '<h2>Продукты</h2>',
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
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    'order_items_productId',
                    'productid',
                    'product_name',
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'headerOptions' => ['width' => '60'],
                        'template' => '{product-update} {delete}',
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
                            'delete' => function ($url, $modelProductId) {
                                $options = [
                                    'title' => Yii::t('yii', 'Удалить'),
                                    'aria-label' => Yii::t('yii', 'Удалить'),
                                    'data-confirm' => Yii::t('yii', 'Вы уверены что хотите удалить?'),
                                    'data-method' => 'post',
                                    'data-pjax' => '0',
                                ];
                                return Html::a(
                                    '<i class="material-icons button delete">delete</i>',
                                    $url, $options, $modelProductId);
                            },
                        ],

                    ],

                ],
            ]); ?>
            <?php Pjax::end(); ?>
        </div>
    </div>


</div>
