<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Credit Product Widgets');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="credit-product-widget-index">

    <?php Pjax::begin(); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Credit Product Widget'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            //'id',
            'sort',
            'tab_title',
            'title',
            [
                'format' => 'raw',
                'attribute' => 'text',
                'value' => function($model){
                    return strip_tags($model->text);
                }
            ],
            'min',
            'max',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
