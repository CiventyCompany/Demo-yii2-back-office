<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model \backend\modules\export\models\ExportQueue */

$this->title = Yii::t('app', 'Export') . ': ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Export Queues'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="export-queue-view">
    <p>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Remove request?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'created_at',
            [
                'attribute' => 'user_id',
                'value' => $model->user->getName( true )
            ],
            [
                'attribute' => 'model',
                'value' => $model::getModels()[ $model->model ],
            ],
            [
                'attribute' => 'status',
                'value' => $model::getStatuses()[ $model->status ],
            ],
            [
                'attribute' => 'file_name',
                'format' => 'raw',
                'value' => strlen($model->file_name) ? Html::a(Yii::t('app', 'Download'), ['/export/export-queue/download', 'id' => $model->id]) : '<i class="glyphicon glyphicon-repeat export-waiting loader" data-id="' . $model->id . '"><i>',
            ],
        ],
    ]) ?>

</div>
