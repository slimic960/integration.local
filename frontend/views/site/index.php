<?php
use yii\helpers\Html;
use yii\widgets\LinkPager;
use nirvana\showloading\ShowLoadingAsset;
ShowLoadingAsset::register($this);
/* @var $this yii\web\View */

$this->title = 'My Yii Application';
$this->registerJsFile('/js/site.js',
    ['depends' => [\yii\web\JqueryAsset::className()]]
);
?>
<div class="site-index">
    <br>
    <div class="row">
            <?php foreach ($callcenter_name as $v): ?>
                <div class="col-sm-6 col-md-4">
                    <a href="<?= yii\helpers\Url::to(['/'.$v->callcenter_code.'/index'])?>">
                        <div class="thumbnail color-block">
                             <div class="caption">
                                 <h3><?= Html::encode("{$v->callcenter_name}") ?></h3>
                             </div>
                         </div>
            </a>
                </div>
            <?php endforeach; ?>
        <?= LinkPager::widget(['pagination' => $pagination]) ?>
    </div>

</div>
</div>
