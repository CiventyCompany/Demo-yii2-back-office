<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\modules\credit_product\models\search\CreditProductReviewCommentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Credit Product Review Comments');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="credit-product-review-comment-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Credit Product Review Comment'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php Pjax::begin(); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [

            //'id',
            'text:ntext',
            [
                'attribute' => 'user_id',
                'filter' => Html::activeTextInput($searchModel, 'user_id', ['class' => 'form-control', 'prompt' => Yii::t('app', 'All')]),
                'value' => function($model){
                    return $model->profile->getName( true );
                }
            ],
            [
                'attribute' => 'credit_product_review_id',
                'filter' => Html::activeDropDownList($searchModel, 'credit_product_review_id', $searchModel->getAvailableReviews(), ['class' => 'form-control', 'prompt' => Yii::t('app', 'All')]),
                'value' => function($model){
                    return $model->creditProductReview->title;
                }
            ],
            'likes_count',
            'dislikes_count',
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
