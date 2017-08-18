<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\modules\credit_product\models\search\CreditProductReviewSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Credit Product Reviews');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="credit-product-review-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <?php /*
    <p>
        <?= Html::a(Yii::t('app', 'Create Credit Product Review'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    */ ?>
    <?php Pjax::begin(); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [

            //'id',
            'title',
            'text:ntext',
            'rating',
            [
                'attribute' => 'credit_product_id',
                'filter' => Html::activeDropDownList($searchModel, 'credit_product_id', $searchModel->getAvailableProducts(), ['class' => 'form-control', 'prompt' => Yii::t('app', 'All')]),
                'value' => function($model){
                    return $model->creditProduct->title;
                }
            ],
            [
                'attribute' => 'user_id',
                'filter' => Html::activeDropDownList($searchModel, 'user_id', $searchModel->getAvailableUsers(), ['class' => 'form-control', 'prompt' => Yii::t('app', 'All')]),
                'value' => function($model){
                    return $model->profile->getName( true );
                }
            ],
            'likes_count',
            'dislikes_count',
            'comments_count',
            // 'created_at',
            [
                'attribute' => 'status',
                'format' => 'raw',
                'filter' => Html::activeDropDownList($searchModel, 'status', $searchModel->getAvailableStatuses(false), ['class' => 'form-control', 'prompt' => Yii::t('app', 'All')]),
                'value' => function($model){
                    return $model->getAvailableStatuses()[ $model->status ];
                }
            ],


            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
