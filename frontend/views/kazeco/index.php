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

$this->title = 'Колл-центр Kazeco';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mapping-country-id-dvad-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="panel panel-default">
        <ul class="list-group">
            <li class="list-group-item">
                <span class="badge"><?= $country_count_kazeco ?></span>
                Страны
            </li>
        </ul>
        <div class="panel-footer panel-callcenter">
            <p>
            <div>
                <?php  if (Yii::$app->user->can('editIndexKazeco') || Yii::$app->user->can('admin')): ?>
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
                <?php endif ?>
            </div>
            </p>
            <?php Pjax::begin(); ?>
            <?= GridView::widget([
                'dataProvider' => $dataProviderCountry,
                'filterModel' => $searchModelCountry,
                'summary'=>'',
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    'sp_country',
                    'country_kazeco',
                    'sp_so_country',
                    'currency_id',
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
                                  if (Yii::$app->user->can('editIndexKazeco') || Yii::$app->user->can('admin')) {
                                      return Html::a(
                                          '<i class="material-icons button edit">edit</i>',
                                          $url, $options, $modelCountry);
                                  }
                            },
                            'delete-country' => function ($url, $modelCountry) {
                                $options = [
                                    'title' => Yii::t('yii', 'Удалить'),
                                    'aria-label' => Yii::t('yii', 'Удалить'),
                                    'data-confirm' => Yii::t('yii', 'Вы уверены что хотите удалить  ('.$modelCountry->sp_so_country.') ?'),
                                    'data-method' => 'post',
                                    'data-pjax' => '0',
                                ];
                                  if (Yii::$app->user->can('editIndexKazeco') || Yii::$app->user->can('admin')) {
                                      return $modelCountry->status_active == 1 ? Html::a('
                                    <i class="material-icons button delete">delete</i>', $url, $options) : '';
                                  }
                            },
                            'redelete-country' => function ($url, $modelCountry) {
                                $options = [
                                    'title' => Yii::t('yii', 'Удалить'),
                                    'aria-label' => Yii::t('yii', 'Удалить'),
                                    'data-confirm' => Yii::t('yii', 'Вы уверены что хотите восстановить   ('.$modelCountry->sp_so_country.') ?'),
                                    'data-method' => 'post',
                                    'data-pjax' => '0',
                                ];
                                if (Yii::$app->user->can('editIndexKazeco') || Yii::$app->user->can('admin')) {
                                    return $modelCountry->status_active == 0 ? Html::a('
                                    <i class="material-icons button redelete">undo</i>', $url, $options, ['title' => Yii::t('app', 'Восстановить')]) : '';
                                }
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
                <span class="badge"><?= $service_count_kazeco ?></span>
                Сервисы доставки
            </li>
        </ul>
        <div class="panel-footer panel-callcenter">
            <p>
            <div>
                <?php  if (Yii::$app->user->can('editIndexKazeco') || Yii::$app->user->can('admin')): ?>
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
                <?php endif ?>
            </div>
            </p>
            <?php Pjax::begin(); ?>
            <?= GridView::widget([
                'dataProvider' => $dataProviderService,
                'filterModel' => $searchModelService,
                'summary'=>'',
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    'sp_delivery_service',
                    'kz_delivery',
                    'kz_delivery_name',
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
                            'service-update' => function ($url, $modelService) {
                                $options = [
                                    'title' => Yii::t('yii', 'Изменить'),
                                    'aria-label' => Yii::t('yii', 'Изменить'),
                                ];
                                 if (Yii::$app->user->can('editIndexKazeco') || Yii::$app->user->can('admin')) {
                                     return Html::a(
                                         '<i class="material-icons button edit">edit</i>',
                                         $url, $options, $modelService);
                                 }
                            },
                            'delete-service' => function ($url, $modelService) {
                                $options = [
                                    'title' => Yii::t('yii', 'Удалить'),
                                    'aria-label' => Yii::t('yii', 'Удалить'),
                                    'data-confirm' => Yii::t('yii', 'Вы уверены что хотите удалить ('.$modelService->sp_delivery_service.') ?'),
                                    'data-method' => 'post',
                                    'data-pjax' => '0',
                                ];
                               if (Yii::$app->user->can('editIndexKazeco') || Yii::$app->user->can('admin')) {
                                   return $modelService->status_active == 1 ? Html::a('
                                    <i class="material-icons button delete">delete</i>', $url, $options) : '';
                               }
                            },
                            'redelete-service' => function ($url, $modelService) {
                                $options = [
                                    'title' => Yii::t('yii', 'Удалить'),
                                    'aria-label' => Yii::t('yii', 'Удалить'),
                                    'data-confirm' => Yii::t('yii', 'Вы уверены что хотите восстановить ('.$modelService->sp_delivery_service.') ?'),
                                    'data-method' => 'post',
                                    'data-pjax' => '0',
                                ];
                                 if (Yii::$app->user->can('editIndexKazeco') || Yii::$app->user->can('admin')) {
                                     return $modelService->status_active == 0 ? Html::a('
                                    <i class="material-icons button redelete">undo</i>', $url, $options, ['title' => Yii::t('app', 'Восстановить')]) : '';
                                 }
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
                <span class="badge"><?= $offer_count_kazeco ?></span>
                Офферы
            </li>
        </ul>
        <div class="panel-footer panel-callcenter">
            <p>
            <div>
                <?php  if (Yii::$app->user->can('editIndexKazeco') || Yii::$app->user->can('admin')): ?>
                <?php Modal::begin([
                    'header' => '<h2>Добавить оффер</h2>',
                    'toggleButton' => [
                        'label' => 'Добавить',
                        'tag' => 'button',
                        'class' => 'btn btn-success btn-edit',
                    ],
                    'footer' => 'Описание',
                ]); ?>

                <?= $this->render('offer_form', [
                    'modelOffer' => $modelOffer,
                ]) ?>
                <?php Modal::end(); ?>
                <?php endif ?>
            </div>
            </p>
            <?php Pjax::begin(); ?>
            <?= GridView::widget([
                'dataProvider' => $dataProviderOffer,
                'filterModel' => $searchModelOffer,
                'summary'=>'',
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    'sp_offer',
                    'kazeco_offer',
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
                        'template' => '{offer-update} {delete-offer} {redelete-offer}',
                        'buttons' => [
                            'offer-update' => function ($url, $modelOffer) {
                                $options = [
                                    'title' => Yii::t('yii', 'Изменить'),
                                    'aria-label' => Yii::t('yii', 'Изменить'),
                                ];
                                  if (Yii::$app->user->can('editIndexKazeco') || Yii::$app->user->can('admin')) {
                                      return Html::a(
                                          '<i class="material-icons button edit">edit</i>',
                                          $url, $options, $modelOffer);
                                  }
                            },
                            'delete-offer' => function ($url, $modelOffer) {
                                $options = [
                                    'title' => Yii::t('yii', 'Удалить'),
                                    'aria-label' => Yii::t('yii', 'Удалить'),
                                    'data-confirm' => Yii::t('yii', 'Вы уверены что хотите удалить ('.$modelOffer->kazeco_offer.') ?'),
                                    'data-method' => 'post',
                                    'data-pjax' => '0',
                                ];
                                if (Yii::$app->user->can('editIndexKazeco') || Yii::$app->user->can('admin')) {
                                    return $modelOffer->active == 1 ? Html::a('
                                    <i class="material-icons button delete">delete</i>', $url, $options) : '';
                                }
                            },
                            'redelete-offer' => function ($url, $modelOffer) {
                                $options = [
                                    'title' => Yii::t('yii', 'Удалить'),
                                    'aria-label' => Yii::t('yii', 'Удалить'),
                                    'data-confirm' => Yii::t('yii', 'Вы уверены что хотите восстановить ('.$modelOffer->kazeco_offer.') ?'),
                                    'data-method' => 'post',
                                    'data-pjax' => '0',
                                ];
                                if (Yii::$app->user->can('editIndexKazeco') || Yii::$app->user->can('admin')) {
                                    return $modelOffer->active == 0 ? Html::a('
                                    <i class="material-icons button redelete">undo</i>', $url, $options, ['title' => Yii::t('app', 'Восстановить')]) : '';
                                }
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
                <span class="badge"><?= $offer_product_count_kazeco ?></span>
                Продукты
            </li>
        </ul>
        <div class="panel-footer panel-callcenter">
            <p>
            <div>
                <?php  if (Yii::$app->user->can('editIndexKazeco') || Yii::$app->user->can('admin')): ?>
                <?php Modal::begin([
                    'header' => '<h2>Добавить продукт</h2>',
                    'toggleButton' => [
                        'label' => 'Добавить',
                        'tag' => 'button',
                        'class' => 'btn btn-success btn-edit',
                    ],
                    'footer' => 'Описание',
                ]); ?>

                <?= $this->render('offerProduct_form', [
                    'modelOfferProduct' => $modelOfferProduct,
                ]) ?>
                <?php Modal::end(); ?>
                <?php endif ?>
            </div>
            </p>
            <?php Pjax::begin(); ?>
            <?= GridView::widget([
                'dataProvider' => $dataProviderOfferProduct,
                'filterModel' => $searchModelOfferProduct,
                'summary'=>'',
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    'productid',
                    'product_name',
                    'product_kazeco',
                    'sp_offer',
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
                        'attribute' => 'gift',
                        'headerOptions' => ['width' => '80'],
                        'format' => 'raw',
                        'filter' => [
                            0 => 'Продукт',
                            1 => 'Подарок',
                        ],
                        'headerOptions' => ['width' => '60'],
                        'filterInputOptions'=>['class'=>'select_status'],
                        'value' => function ($model, $key, $index, $column) {
                            $active = $model->{$column->attribute} === 1;
                            return \yii\helpers\Html::tag(
                                'span',
                                $active ? 'Подарок' : '',
                                [
                                    'class' => 'label label-' . ($active ? 'info' : 'danger'),
                                ]
                            );
                        },
                    ],
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'header'=>  Html::a('<i class="material-icons button refresh">settings_backup_restore</i>',['index'] , [ 'title' => Yii::t('app', 'Сбросить') ]),
                        'headerOptions' => ['width' => '60'],
                        'template' => '{offer-product-update} {delete-offer-product} {redelete-offer-product}',
                        'buttons' => [
                            'offer-product-update' => function ($url, $modelOfferProduct) {
                                $options = [
                                    'title' => Yii::t('yii', 'Изменить'),
                                    'aria-label' => Yii::t('yii', 'Изменить'),
                                ];
                                if (Yii::$app->user->can('editIndexKazeco') || Yii::$app->user->can('admin')) {
                                    return Html::a(
                                        '<i class="material-icons button edit">edit</i>',
                                        $url, $options, $modelOfferProduct);
                                }
                            },
                            'delete-offer-product' => function ($url, $modelOfferProduct) {
                                $options = [
                                    'title' => Yii::t('yii', 'Удалить'),
                                    'aria-label' => Yii::t('yii', 'Удалить'),
                                    'data-confirm' => Yii::t('yii', 'Вы уверены что хотите удалить ('.$modelOfferProduct->product_name.') ?'),
                                    'data-method' => 'post',
                                    'data-pjax' => '0',
                                ];
                                if (Yii::$app->user->can('editIndexKazeco') || Yii::$app->user->can('admin')) {
                                    return $modelOfferProduct->active == 1 ? Html::a('
                                        <i class="material-icons button delete">delete</i>', $url, $options) : '';
                                }
                            },
                            'redelete-offer-product' => function ($url, $modelOfferProduct) {
                                $options = [
                                    'title' => Yii::t('yii', 'Удалить'),
                                    'aria-label' => Yii::t('yii', 'Удалить'),
                                    'data-confirm' => Yii::t('yii', 'Вы уверены что хотите восстановить ('.$modelOfferProduct->product_name.') ?'),
                                    'data-method' => 'post',
                                    'data-pjax' => '0',
                                ];
                                 if (Yii::$app->user->can('editIndexKazeco') || Yii::$app->user->can('admin')) {
                                     return $modelOfferProduct->active == 0 ? Html::a('
                                    <i class="material-icons button redelete">undo</i>', $url, $options, ['title' => Yii::t('app', 'Восстановить')]) : '';
                                 }
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
                <span class="badge"><?= $statuses_count_kazeco ?></span>
                Статусы
            </li>
        </ul>
        <div class="panel-footer panel-callcenter">
            <p>
            <div>
                <?php  if (Yii::$app->user->can('editIndexKazeco') || Yii::$app->user->can('admin')): ?>
                <?php Modal::begin([
                    'header' => '<h2>Добавить статус</h2>',
                    'toggleButton' => [
                        'label' => 'Добавить',
                        'tag' => 'button',
                        'class' => 'btn btn-success btn-edit',
                    ],
                    'footer' => 'Описание',
                ]); ?>

                <?= $this->render('statuses_form', [
                    'modelStatuses' => $modelStatuses,
                ]) ?>
                <?php Modal::end(); ?>
                <?php endif ?>
            </div>
            </p>
            <?php Pjax::begin(); ?>
            <?= GridView::widget([
                'dataProvider' => $dataProviderStatuses,
                'filterModel' => $searchModelStatuses,
                'summary'=>'',
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    'sostatus',
                    'status',
                    'status_name',
                    [
                        'attribute' => 'status_terminal',
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
                        'template' => '{statuses-update} {delete-statuses} {redelete-statuses}',
                        'buttons' => [
                            'statuses-update' => function ($url, $modelStatuses) {
                                $options = [
                                    'title' => Yii::t('yii', 'Изменить'),
                                    'aria-label' => Yii::t('yii', 'Изменить'),
                                ];
                               if (Yii::$app->user->can('editIndexKazeco') || Yii::$app->user->can('admin')) {
                                   return Html::a(
                                       '<i class="material-icons button edit">edit</i>',
                                       $url, $options, $modelStatuses);
                               }
                            },
                            'delete-statuses' => function ($url, $modelStatuses) {
                                $options = [
                                    'title' => Yii::t('yii', 'Удалить'),
                                    'aria-label' => Yii::t('yii', 'Удалить'),
                                    'data-confirm' => Yii::t('yii', 'Вы уверены что хотите удалить ('.$modelStatuses->sostatus.') ?'),
                                    'data-method' => 'post',
                                    'data-pjax' => '0',
                                ];
                               if (Yii::$app->user->can('editIndexKazeco') || Yii::$app->user->can('admin')) {
                                   return $modelStatuses->status_terminal == 1 ? Html::a('
                                    <i class="material-icons button delete">delete</i>', $url, $options) : '';
                               }
                            },
                            'redelete-statuses' => function ($url, $modelStatuses) {
                                $options = [
                                    'title' => Yii::t('yii', 'Удалить'),
                                    'aria-label' => Yii::t('yii', 'Удалить'),
                                    'data-confirm' => Yii::t('yii', 'Вы уверены что хотите восстановить ('.$modelStatuses->sostatus.') ?'),
                                    'data-method' => 'post',
                                    'data-pjax' => '0',
                                ];
                                if (Yii::$app->user->can('editIndexKazeco') || Yii::$app->user->can('admin')) {
                                    return $modelStatuses->status_terminal == 0 ? Html::a('
                                    <i class="material-icons button redelete">undo</i>', $url, $options, ['title' => Yii::t('app', 'Восстановить')]) : '';
                                }
                            },
                        ],
                    ],

                ],
            ]); ?>
            <?php Pjax::end(); ?>
        </div>
    </div>

</div>
