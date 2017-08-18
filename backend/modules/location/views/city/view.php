<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model \common\modules\location\models\City */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'City'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="city-view">

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->city_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->city_id], [
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
            [
                'attribute' => 'city_id',
                'label' => Yii::t('app', 'City Id'),
            ],
            [
                'label' => Yii::t('app', 'Region'),
                'attribute' => 'region_id',
                'value' => $model->region->name
            ],
            'name',
        ],
    ]) ?>

</div>
