<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\community\models\QuestionsCategoriesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app','Categories');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="questions-categories-index">

    <p>
        <?= Html::a(Yii::t('app','Create Category'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'attribute' => 'sort',
                'filter' => false,
            ],
            'name',
            [
                'format' => 'raw',
                'attribute' => 'parent_category_id',
                'value' => function($model){
                    return \common\modules\community\models\QuestionsCategories::getCategoryTitle($model->parent_category_id);
                },
                'filter' => false
            ],
            [
                'attribute' => 'created_at',
                'format' => ['date', 'php:d-m-Y'],
                'filter' => \yii\jui\DatePicker::widget([
                    'model'      => $searchModel,
                    'attribute'  => 'created_at',
                    'dateFormat' => 'php:d-m-Y',
                    'options' => [
                        'class' => 'form-control',
                    ],
                ]),
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update} {delete}'
            ],
        ],
    ]); ?>
</div>
