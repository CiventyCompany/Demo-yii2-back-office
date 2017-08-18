<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\modules\credit_rating\models\advanced\search\CreditRatingAdvancedRequestSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Credit Rating Advanced Requests');
$this->params['breadcrumbs'][] = $this->title;
$models = [];
foreach ($searchModel->getModels() as $name => $model){
    $models[ $name ] = $searchModel->modelsTranslate()[$name];
}
?>
<div class="credit-rating-advanced-request-index">

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [

            'id',
            [
                'attribute' => 'user_id',
                'value' => function( $model ){
                    return $model->user->getName( true );
                },

            ],
            [
                'attribute' => 'model',
                'filter' => Html::activeDropDownList( $searchModel, 'model', $models, ['prompt' => '', 'class' => 'form-control'] ),
                'value' => function($model){
                    return $model->modelsTranslate()[$model->model];
                }
            ],
            [
                'attribute' => 'order_id',
                //'filter' => Html::activeTextInput( $searchModel, 'model', ['class' => 'form-control'] ),
                'format' => 'raw',
                'value' => function($model){
                    if($model->order){
                        $products = [];
                        foreach ($model->order->orderItems as $item){
                            $products[] = $item->product->title . '(' . $model->order->id . ')';
                        };
                        return implode(' ', $products);
                    }
                }
            ],
            [
                'attribute' => 'status',
                'filter' => Html::activeDropDownList( $searchModel, 'status', $searchModel->getStatuses(), ['prompt' => '', 'class' => 'form-control'] ),
                'value' => function( $model ){
                    return $model->getStatuses()[ $model->status ];
                }
            ],
            // 'base_file_name',
            'created_at',
            'completed_at',
            [
                'label' => '',
                'value' => function( $model ){
                    $out = '';
                    if( $model->status == $model::STATUS_COMPLETED ){
                        $out .= Html::a('<span class="glyphicon glyphicon-eye-open"></span>', ['/credit_rating/advanced/credit-rating-advanced-request/view', 'id' => $model->id]);
                    } else if( $model->status == $model::STATUS_PARSER_ERROR ){
                        $out .= Html::a('<span class="glyphicon glyphicon-refresh"></span>', [
                            '/credit_rating/advanced/credit-rating-advanced-request/refresh', 'id' => $model->id
                        ], [
                            'class' => 'ajax-link',
                            'data' => [
                                'success' => 'remove'
                            ]
                        ]);
                    }
                    return $out;
                },
                'format' => 'raw',
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
