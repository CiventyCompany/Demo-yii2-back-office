<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\modules\credit_product\models\search\CreditProductCategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Credit Product Categories');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="credit-product-category-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php Pjax::begin(); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [

            //'id',
            'sort',
            'title',
            [
                'attribute' => 'credit_product_category_group_id',
                'filter' => Html::activeDropDownList($searchModel, 'credit_product_category_group_id', \yii\helpers\ArrayHelper::map($searchModel->getGroups(), 'id', 'title'), ['class' => 'form-control', 'prompt' => Yii::t('app', 'All')]),
                'value' => function($model){
                    return $model->group->title;
                }
            ],
            'alias',
            /*
            [
                'attribute' => 'parent_id',
                'filter' => Html::activeDropDownList($searchModel, 'parent_id', $searchModel->getTreeListData(), ['class' => 'form-control', 'prompt' => Yii::t('app', 'All')]),
                'value' => function($model){
                    if($model->parent_id){
                        return $model->parent->title;
                    } else {
                        return Yii::t('app', 'No');
                    }
                }
            ],
            */
            [
                'attribute' => 'status',
                'format' => 'raw',
                'filter' => Html::activeDropDownList($searchModel, 'status', $searchModel::getAvailableStatuses(false), ['class' => 'form-control', 'prompt' => Yii::t('app', 'All')]),
                'value' => function($model){
                    return $model::getAvailableStatuses()[ $model->status ];
                }

            ],

            // 'status',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
