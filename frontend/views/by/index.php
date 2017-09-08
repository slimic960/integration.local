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

$this->title = 'Колл-центр BY';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mapping-country-id-dvad-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="panel panel-default">
        <ul class="list-group">
            <li class="list-group-item">
                <span class="badge"><?= $offer_count_by ?></span>
                Офферы
            </li>
        </ul>
        <div class="panel-footer panel-callcenter">
            <p>
            <div>
                <?php  if (Yii::$app->user->can('editIndexBy') || Yii::$app->user->can('admin')): ?>
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
                    'modelOffers' => $modelOffers,
                ]) ?>
                <?php Modal::end(); ?>
                <?php endif?>
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
                    'by_offer',
                    'productid',
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
                        'header'=>  Html::a('<i class="material-icons button refresh">settings_backup_restore</i>',['index'] ,
                            [ 'title' => Yii::t('app', 'Сбросить') ]),
                        'headerOptions' => ['width' => '60'],
                        'template' => '{offer-update} {delete-offer} {redelete-offer}',
                        'buttons' => [
                            'offer-update' => function ($url, $modelOffers) {
                                $options = [
                                    'title' => Yii::t('yii', 'Изменить'),
                                    'aria-label' => Yii::t('yii', 'Изменить'),
                                ];
                                if (Yii::$app->user->can('editIndexBy') || Yii::$app->user->can('admin')){
                                return Html::a(
                                    '<i class="material-icons button edit">edit</i>',
                                     $url, $options, $modelOffers);
                                }
                            },
                            'delete-offer' => function ($url, $modelOffers) {
                                $options = [
                                    'title' => Yii::t('yii', 'Удалить'),
                                    'aria-label' => Yii::t('yii', 'Удалить'),
                                    'data-confirm' => Yii::t('yii', 'Вы уверены что хотите удалить ('.$modelOffers->by_offer.') ?'),
                                    'data-method' => 'post',
                                    'data-pjax' => '0',
                                ];
                                  if (Yii::$app->user->can('editIndexBy') || Yii::$app->user->can('admin')) {
                                      return $modelOffers->active == 1 ? Html::a('
                                    <i class="material-icons button delete">delete</i>', $url, $options) : '';
                                  }
                            },
                            'redelete-offer' => function ($url, $modelOffers) {
                                $options = [
                                    'title' => Yii::t('yii', 'Удалить'),
                                    'aria-label' => Yii::t('yii', 'Удалить'),
                                    'data-confirm' => Yii::t('yii', 'Вы уверены что хотите восстановить ('.$modelOffers->by_offer.') ?'),
                                    'data-method' => 'post',
                                    'data-pjax' => '0',
                                ];
                                   if (Yii::$app->user->can('editIndexBy') || Yii::$app->user->can('admin')) {
                                       return $modelOffers->active == 0 ? Html::a('
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
                <span class="badge"><?= $statuses_count_by ?></span>
                Статусы
            </li>
        </ul>
        <div class="panel-footer panel-callcenter">
            <p>
            <div>
                <?php  if (Yii::$app->user->can('editIndexBy') || Yii::$app->user->can('admin')): ?>
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
                               if (Yii::$app->user->can('editIndexBy') || Yii::$app->user->can('admin')) {
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
                                 if (Yii::$app->user->can('editIndexBy') || Yii::$app->user->can('admin')) {
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
                                 if (Yii::$app->user->can('editIndexBy') || Yii::$app->user->can('admin')) {
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
