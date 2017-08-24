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
                <span class="badge"><?= $country_count_by ?></span>
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
                    'sp_country',
                    'country_kazeco',
                    'sp_so_country',
                    'currency_id',
            [
                'attribute' => 'status_active',
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
                                    'data-confirm' => Yii::t('yii', 'Вы уверены что хотите удалить?'),
                                    'data-method' => 'post',
                                    'data-pjax' => '0',
                                ];
                                 return $modelCountry->status_active == 1 ? Html::a('
                                    <i class="material-icons button delete">delete</i>', $url, $options) : '';
                            },
                            'redelete-country' => function ($url, $modelCountry) {
                                return $modelCountry->status_active == 0 ? Html::a('
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
