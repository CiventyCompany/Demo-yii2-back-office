<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\jui\DatePicker;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $searchModel \backend\modules\news\models\NewsCategorySearch */

$this->title = Yii::t('app', 'News Categories');
$this->params['breadcrumbs'][] = $this->title;
$parentsTree = \backend\modules\news\models\NewsCategory::getCategoriesTree();
unset($parentsTree[0]);
?>
<div class="news-category-index" style="">

    <p>
        <?= Html::a(Yii::t('app', 'Create News Category'), ['create'], ['class' => 'btn btn-success']) ?>
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
                    'attribute' => 'parent_id',
                    'value' => function($model){
                        return $model->parent ? $model->parent->title : '-';
                    },
                    'filter' => Html::activeDropDownList( $searchModel, 'parent_id', $parentsTree, ['class' => 'form-control', 'prompt' => ''] )
                ],
                'alias',
                [
                    'attribute' => 'created_at',
                    'value' => 'created_at',
                    'format' => ['date', 'php:Y-m-d'],
                    'filter' => DatePicker::widget([
                        'model'      => $searchModel,
                        'attribute'  => 'created_at',
                        'dateFormat' => 'php:Y-m-d',
                        'options' => [
                            'class' => 'form-control',
                        ],
                    ]),
                ],

                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]); ?>

    <?php Pjax::end(); ?>
</div>
