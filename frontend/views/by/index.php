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
                    ''=> 'Показать всё',
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
                        'header'=>  Html::a('<i class="material-icons button refresh">settings_backup_restore</i>',['index'] , [ 'title' => Yii::t('app', 'Сбросить') ]),
                        'headerOptions' => ['width' => '60'],
                        'template' => '{offer-update} {delete-offer} {redelete-offer}',
                        'buttons' => [
                            'offer-update' => function ($url, $modelOffers) {
                                $options = [
                                    'title' => Yii::t('yii', 'Изменить'),
                                    'aria-label' => Yii::t('yii', 'Изменить'),
                                ];
                                return Html::a(
                                    '<i class="material-icons button edit">edit</i>',
                                     $url, $options, $modelOffers);
                            },
                            'delete-offer' => function ($url, $modelOffers) {
                                $options = [
                                    'title' => Yii::t('yii', 'Удалить'),
                                    'aria-label' => Yii::t('yii', 'Удалить'),
                                    'data-confirm' => Yii::t('yii', 'Вы уверены что хотите удалить?'),
                                    'data-method' => 'post',
                                    'data-pjax' => '0',
                                ];
                                 return $modelOffers->active == 1 ? Html::a('
                                    <i class="material-icons button delete">delete</i>', $url, $options) : '';
                            },
                            'redelete-offer' => function ($url, $modelOffers) {
                                return $modelOffers->active == 0 ? Html::a('
                                    <i class="material-icons button redelete">undo</i>', $url, [ 'title' => Yii::t('app', 'Восстановить') ]) : '';
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
                            ''=> 'Показать всё',
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
                        'header'=>  Html::a('<i class="material-icons button refresh">settings_backup_restore</i>',['index'] , [ 'title' => Yii::t('app', 'Сбросить') ]),
                        'headerOptions' => ['width' => '60'],
                        'template' => '{offer-update} {delete-statuses} {redelete-statuses}',
                        'buttons' => [
                            'offer-update' => function ($url, $modelStatuses) {
                                $options = [
                                    'title' => Yii::t('yii', 'Изменить'),
                                    'aria-label' => Yii::t('yii', 'Изменить'),
                                ];
                                return Html::a(
                                    '<i class="material-icons button edit">edit</i>',
                                    $url, $options, $modelStatuses);
                            },
                            'delete-statuses' => function ($url, $modelStatuses) {
                                $options = [
                                    'title' => Yii::t('yii', 'Удалить'),
                                    'aria-label' => Yii::t('yii', 'Удалить'),
                                    'data-confirm' => Yii::t('yii', 'Вы уверены что хотите удалить?'),
                                    'data-method' => 'post',
                                    'data-pjax' => '0',
                                ];
                                return $modelStatuses->status_terminal == 1 ? Html::a('
                                    <i class="material-icons button delete">delete</i>', $url, $options) : '';
                            },
                            'redelete-statuses' => function ($url, $modelStatuses) {
                                return $modelStatuses->status_terminal == 0 ? Html::a('
                                    <i class="material-icons button redelete">undo</i>', $url, [ 'title' => Yii::t('app', 'Восстановить') ]) : '';
                            },
                        ],
                    ],

                ],
            ]); ?>
            <?php Pjax::end(); ?>
        </div>
    </div>

</div>
