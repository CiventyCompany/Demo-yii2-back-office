<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\services\models\PostService */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Post Services'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-service-view">

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
            'name',
            'title',
            'link',
            [
                'attribute' => 'icon',
                'format' => 'raw',
                'value' => Html::img( Yii::$app->params['frontURL'] . \frontend\helpers\ImageHelper::thumbnail( $model->icon, 30, 30 ) ),
            ],
            'created_at',
        ],
    ]) ?>

</div>
