<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $modelStatuses common\models\MappingStatusesKazeco */

$this->params['breadcrumbs'][] = ['label' => 'Колл-центр BY', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Изменить';
?>
<div class="mapping-country-id-dvad-update">
    <?php if($modelStatuses): ?>
        <?= $this->render('statuses_form', [
            'modelStatuses' => $modelStatuses,
        ]) ?>
    <?php endif; ?>
</div>
