<?php
use yii\helpers\Html;
use yii\widgets\LinkPager;
use nirvana\showloading\ShowLoadingAsset;
ShowLoadingAsset::register($this);
/* @var $this yii\web\View */
$this->title = 'Интеграция';
//$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/png', 'href' => Url::to(['/favicon.png'])]);
$this->registerJsFile('/js/site.js',
    ['depends' => [\yii\web\JqueryAsset::className()]]
);
$i = 0;
?>
<div class="site-index">
    <br>
    <div class="row">
        <?php foreach ($callcenter_name as $v): ?>
            <?php if(Yii::$app->user->can('user'.ucfirst($v->callcenter_code)) || Yii::$app->user->can('admin')): ?>
                <?php $i++;?>
            <?php endif ?>
        <?php endforeach; ?>

            <?php foreach ($callcenter_name as $v): ?>
                <?php if(Yii::$app->user->can('user'.ucfirst($v->callcenter_code)) || Yii::$app->user->can('admin')): ?>
                <div class="col-sm-6 col-md-<?php if($i <= 1){echo 12;} elseif($i > 1 && $i < 10){echo 6;} elseif($i > 11){echo 4;} ?>">
                    <a href="<?= yii\helpers\Url::to(['/'.$v->callcenter_code.'/index'])?>">
                        <div class="thumbnail color-block">
                             <div class="caption">
                                 <h3><?= Html::encode("{$v->callcenter_name}") ?></h3>
                             </div>
                         </div>
                    </a>
                </div>
                <?php endif ?>
            <?php endforeach; ?>
        <?= LinkPager::widget(['pagination' => $pagination]) ?>
    </div>
</div>
</div>
