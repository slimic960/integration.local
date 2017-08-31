<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use nirvana\showloading\ShowLoadingAsset;
ShowLoadingAsset::register($this);

$this->title = 'Пользователи';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-contact">

    <div class="mapping-country-id-dvad-index">

        <h1><?= Html::encode($this->title) ?></h1>

        <div class="panel panel-default">
            <div class="panel-footer">
                <?php Pjax::begin(); ?>
                <?= GridView::widget([
                    'dataProvider' => $dataProviderMenu,
                    'filterModel' => $searchModelMenu,
                    'summary'=>'',
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],
                        'username',
                        'email',
                        [
                            'header' => 'Колл-центры',
                            'value' => function($modelMenu)
                            {
                                return implode(', ', \yii\helpers\ArrayHelper::map($modelMenu->userId, 'item_name', 'item_name'));

                            }
                        ],
                        [
                            'attribute' => 'status',
                            'format' => 'raw',
                            'filter' => [
                                ''=> 'Показать всё',
                                0 => 'Удалена',
                                10 => 'Активна',
                            ],
                            'headerOptions' => ['width' => '60'],
                            'filterInputOptions'=>['class'=>'select_status'],
                            'value' => function ($model, $key, $index, $column) {
                                $active = $model->{$column->attribute} === 10;
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
                            'template' => '{menu-update} {auth-update} {delete-user} {redelete-user}',
                            'buttons' => [
                                'menu-update' => function ($url, $modelMenu) {
                                    $options = [
                                        'title' => Yii::t('yii', 'Изменить'),
                                        'aria-label' => Yii::t('yii', 'Изменить'),
                                    ];
                                    return Html::a(
                                        '<i class="material-icons button edit">edit</i>',
                                        $url, $options, $modelMenu);
                                },
                                'auth-update' => function ($url, $modelMenuAuth) {
                                    $options = [
                                        'title' => Yii::t('yii', 'Изменить'),
                                        'aria-label' => Yii::t('yii', 'Изменить'),
                                    ];
                                    return Html::a(
                                        '<i class="material-icons button edit">edit</i>',
                                        $url, $options, $modelMenuAuth);
                                },
                                'delete-user' => function ($url, $modelMenu) {
                                    $options = [
                                        'title' => Yii::t('yii', 'Удалить'),
                                        'aria-label' => Yii::t('yii', 'Удалить'),
                                        'data-confirm' => Yii::t('yii', 'Вы уверены что хотите удалить?'),
                                        'data-method' => 'post',
                                        'data-pjax' => '0',
                                    ];
                                    return $modelMenu->status == 10 ? Html::a('
                                    <i class="material-icons button delete">delete</i>', $url, $options) : '';
                                },
                                'redelete-user' => function ($url, $modelMenu) {
                                    return $modelMenu->status == 0 ? Html::a('
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

</div>
