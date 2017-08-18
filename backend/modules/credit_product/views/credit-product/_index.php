<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\modules\credit_product\models\search\CreditProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Credit Products');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="credit-product-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php Pjax::begin(); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [

            'id',
            //'sort',
            [
                'attribute' => 'image',
                'filter' => false,
                'format' => 'raw',
                'value' => function($model){
                    return Html::img( Yii::$app->params['frontURL'] . \frontend\helpers\ImageHelper::thumbnail( $model->image, 100, 100 ) );
                },
            ],
            [
                'attribute' => 'title',
                'format' => 'raw',
                'contentOptions'=>['style'=>'max-width: 250px; overflow: hidden;']
            ],
            /*[
                'attribute' => 'type_id',
                'filter' => Html::activeDropDownList( $searchModel, 'type_id', \yii\helpers\ArrayHelper::map( \common\modules\credit_product\models\CreditProductType::getAll(), 'id', 'title' ), ['class' => 'form-control', 'prompt' => Yii::t('app', 'All')] ),
                'value' => function($model){
                    return $model->creditProductTypes[0]->title;
                }
            ],*/
            'alias',
            /*
            [
                'attribute' => 'text_short',
                'format' => 'raw',
                'contentOptions'=>['style'=>'max-width: 250px; overflow: hidden;']
            ],
            [
                'attribute' => 'text',
                'format' => 'raw',
                'contentOptions'=>['style'=>'max-width: 250px; overflow: hidden;']
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

            //'rating',
            // 'rating_reviews_count',
            // 'created_at',
            // 'sort',
            // 'status',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
