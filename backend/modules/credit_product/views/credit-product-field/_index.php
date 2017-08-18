<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\modules\credit_product\models\search\CreditProductFieldSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Credit Product Fields');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="credit-product-field-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php Pjax::begin(); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [

            //'id',
            'sort',
            'name',
            'suffix',
            /*[
                'attribute' => 'credit_product_type_id',
                'filter' => Html::activeDropDownList($searchModel, 'credit_product_type_id', \yii\helpers\ArrayHelper::map($searchModel->getTypes(), 'id', 'title'), ['class' => 'form-control', 'prompt' => Yii::t('app', 'All')]),
                'value' => function($model){
                    return $model->creditProductType->title;
                }
            ],*/
            [
                'attribute' => 'show_in',
                'filter' => Html::activeDropDownList($searchModel, 'show_in', $searchModel->showInList(), ['class' => 'form-control', 'prompt' => Yii::t('app', 'All')]),
                'value' => function($model){
                    return $model->showInList()[ $model->show_in ];
                }
            ],
            [
                'attribute' => 'show_place',
                'filter' => Html::activeDropDownList($searchModel, 'show_place', $searchModel->showPlaceList(), ['class' => 'form-control', 'prompt' => Yii::t('app', 'All')]),
                'value' => function($model){
                    return $model->showPlaceList()[ $model->show_place ];
                }
            ],
            [
                'attribute' => 'type',
                'filter' => Html::activeDropDownList($searchModel, 'type', $searchModel->getAvailableTypes(), ['class' => 'form-control', 'prompt' => Yii::t('app', 'All')]),
                'value' => function($model){
                    return $model->getAvailableTypes()[ $model->type ];
                }
            ],
            /*
            [
                'attribute' => 'multiple',
                'filter' => Html::activeDropDownList($searchModel, 'type', $searchModel->multipleList(), ['class' => 'form-control', 'prompt' => Yii::t('app', 'All')]),
                'value' => function($model){
                    return $model->multipleList()[ $model->multiple ];
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
            // 'multiple',
            // 'multiple_count',
            // 'show_place',
            // 'sort',
            // 'alias',
            // 'status',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
