<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\jui\DatePicker;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $searchModel \backend\modules\news\models\NewsSearch */
/* @var $model \backend\modules\news\models\News */

$this->title = Yii::t('app', 'What\'s New');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="news-index">
    <p>
        <?= Html::a(Yii::t('app', 'Create News'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
        <?= GridView::widget([
            'filterModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'options' => [
                'overflow' =>  'auto'
            ],
            'columns' => [
                'id',
                'title',
                [
                    'attribute' => 'category_id',
                    'value' => function($model){
                        return $model->getCategories()[$model->category_id];
                    }
                ],
                [
                    'attribute' => 'created_at',
                    'value' => 'created_at',
                    'filter' => DatePicker::widget([
                        'model'      => $searchModel,
                        'attribute'  => 'created_at',
                        'dateFormat' => 'php:Y-m-d',
                        'options' => [
                            'class' => 'form-control',
                        ],
                    ]),
                ],
                [
                    'attribute' => 'published_at',
                    'value' => 'published_at',
                    'filter' => DatePicker::widget([
                        'model'      => $searchModel,
                        'attribute'  => 'published_at',
                        'dateFormat' => 'php:Y-m-d',
                        'options' => [
                            'class' => 'form-control',
                        ],
                    ]),
                ],
                // 'description:ntext',
                // 'short_description:ntext',
                // 'alias',
                // 'status',

                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]); ?>
    <?php Pjax::end(); ?>
</div>
