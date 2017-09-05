<?php
use yii\helpers\Html;
use yii\helpers\Url;
use nirvana\showloading\ShowLoadingAsset;
use yii\grid\GridView;
ShowLoadingAsset::register($this);
/* @var $this yii\web\View */
$this->registerJsFile('/js/site.js',
    ['depends' => [\yii\web\JqueryAsset::className()]]
);
$this->title = 'Интеграция';
?>
<div class="site-index">
    <br>
    <div class="row">
            <div class="col-sm-6 col-md-6">
                <a href="<?= yii\helpers\Url::to(['/permit/access/role'])?>">
                    <div class="thumbnail color-block">
                        <div class="caption">
                            <h3>Роли</h3>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-sm-6 col-md-6">
                <a href="<?= yii\helpers\Url::to(['/permit/access/permission'])?>">
                    <div class="thumbnail color-block">
                        <div class="caption">
                            <h3>Правила доступа</h3>
                        </div>
                    </div>
                </a>
            </div>
    </div>
    <div class="panel panel-default">
        <ul class="list-group">
            <li class="list-group-item">
                Пользователи
            </li>
        </ul>
        <div class="panel-footer">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'summary'=>'',
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                'username',
                'email:email',

                ['class' => 'yii\grid\ActionColumn',
                    'template' => '{permit} {delete-user} {redelete-user}',
                    'headerOptions' => ['width' => '30'],
                    'buttons' =>
                        [
                            'permit' => function ($url, $model) {
                                return Html::a('<i class="material-icons button redelete">build</i>', Url::to(['/permit/user/view', 'id' => $model->id]), [
                                    'title' => Yii::t('yii', 'Изменить роль пользователя')
                                ]); },

                            'delete-user' => function ($url, $model) {
                                $options = [
                                    'title' => Yii::t('yii', 'Удалить'),
                                    'aria-label' => Yii::t('yii', 'Удалить'),
                                    'data-confirm' => Yii::t('yii', 'Вы уверены что хотите удалить?'),
                                    'data-method' => 'post',
                                    'data-pjax' => '0',
                                ];
                                return $model->status == 10 ? Html::a('
                                    <i class="material-icons button delete">delete</i>', $url, $options) : '';
                            },
                            'redelete-user' => function ($url, $modelOffers) {
                                return $modelOffers->status == 0 ? Html::a('
                                    <i class="material-icons button redelete">undo</i>', $url, [ 'title' => Yii::t('app', 'Восстановить') ]) : '';
                            },
                        ]
                ],
            ],
        ]);
        ?>
        </div>

</div>
