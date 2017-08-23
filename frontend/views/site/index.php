<?php
use yii\helpers\Html;
use yii\widgets\LinkPager;

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="site-index">


    <div class="body-content">
        <h1>Callcenter</h1>
        <div class="row">
            <?php foreach ($callcenter_name as $v): ?>
                <div class="panel panel-default">
                    <div class="panel-body">
                        <a href="<?= yii\helpers\Url::to(['/'.$v->callcenter_code.'/index'])?>"><?= Html::encode("{$v->callcenter_name}") ?>:</a>
                    </div>
                </div>
            <?php endforeach; ?>
            <?= LinkPager::widget(['pagination' => $pagination]) ?>
        </div>
    </div>

</div>
</div>
