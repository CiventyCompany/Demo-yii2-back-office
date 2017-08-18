<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\modules\news\models\News */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'News'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="news-view">

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'attribute' => 'category_id',
                'value' => $model->getCategories()[$model->category_id]
            ],
            'created_at',
            'published_at',
            'title',
            [
                'attribute' => 'description',
                'format' => 'html',
                'value' => 'description'
            ],
            [
                'attribute' => 'short_description',
                'format' => 'html',
                'value' => 'short_description'
            ],
            'alias',
            [
                'attribute' => 'status',
                'value' => $model->getStatusArray()[$model->status]
            ],
        ],
    ]) ?>

</div>
