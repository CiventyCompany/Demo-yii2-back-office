<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\jui\DatePicker;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $searchModel \backend\modules\identification\models\search\IdentificationHistorySearch */


$this->title = Yii::t('app', 'Identifications');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="news-index">

    <?php Pjax::begin(); ?>
    <?= GridView::widget([
        'filterModel' => $searchModel,
        'dataProvider' => $dataProvider,
        'options' => [
            'overflow' =>  'auto'
        ],
        'columns' => [
            'id',
            [
                'attribute' => 'user_id',
                'format' => 'raw',
                'value' => function($model){
                    return "<a data-pjax=\"0\" href='/user/registered/view?id=".$model->user_id."'>".$model->user->getName( true )."</a>" ;
                }
            ],
            [
                'attribute' => 'identification_method_id',
                'value' => function($model){
                    return $model->identificationMethod->product->title;
                },
                'filter' => Html::activeDropDownList( $searchModel, 'identification_method_id', $searchModel->getIdentificationMethods(), ['prompt' => '', 'class' => 'form-control'] )
            ],
            [
                'attribute' => 'status',
                'format' => 'raw',
                'value' => function($model){
                    return $model->getStatusText();
                },
                'filter' => Html::activeDropDownList( $searchModel, 'status', $searchModel->getStatuses(), ['prompt' => '', 'class' => 'form-control'] )
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
                'attribute' => 'closed_at',
                'filter' => DatePicker::widget([
                    'model'      => $searchModel,
                    'attribute'  => 'created_at',
                    'dateFormat' => 'php:Y-m-d',
                    'options' => [
                        'class' => 'form-control',
                    ],
                ]),
            ],

            ['class' => 'yii\grid\ActionColumn', 'template' => '{view}{update}'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
