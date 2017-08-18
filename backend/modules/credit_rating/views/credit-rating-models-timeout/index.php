<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Credit Rating Models Timeouts');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="credit-rating-models-timeout-index">
    <?php if($dataProvider->getTotalCount() < count($models)): ?>
    <p>
        <?= Html::a(Yii::t('app', 'Create Credit Rating Models Timeout'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php endif; ?>
    <?php Pjax::begin(); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'model',
            'timeout',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
