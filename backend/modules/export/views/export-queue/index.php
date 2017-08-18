<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Export Queues');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="export-queue-index">

    <p>
        <?= Html::a(Yii::t('app', 'Create Export Queue'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                'id',
                [
                    'attribute' => 'created_at',
                    'filter' => '<div class="col-xs-6">' . \kartik\date\DatePicker::widget([
                            'language' => 'ru-RU',
                            'model' => $searchModel,
                            'attribute' => 'created_at_from',
                            'options' => ['placeholder' => Yii::t('app', 'From date:')],
                            'type' => \kartik\date\DatePicker::TYPE_INPUT,
                            'pluginOptions' => [
                                'autoclose' => true
                            ]
                        ]) . '</div><div class="col-xs-6">' . \kartik\date\DatePicker::widget([
                            'language' => 'ru-RU',
                            'model' => $searchModel,
                            'attribute' => 'created_at_to',
                            'options' => ['placeholder' => Yii::t('app', 'To date:')],
                            'type' => \kartik\date\DatePicker::TYPE_INPUT,
                            'pluginOptions' => [
                                'autoclose' => true
                            ]
                        ]) .'</div>',
                ],
                [
                    'attribute' => 'user_id',
                    'value' => function($model) {
                        return $model->user->getName(true);
                    },
                ],
                [
                    'attribute' => 'model',
                    'value' => function($model){
                        return $model::getModels()[ $model->model ];
                    },
                    'filter' => Html::activeDropDownList($searchModel, 'model', $searchModel::getModels(), ['class' => 'form-control', 'prompt' => Yii::t('app', 'All')])
                ],
                [
                    'attribute' => 'status',
                    'value' => function($model){
                        return $model::getStatuses()[ $model->status ];
                    },
                    'filter' => Html::activeDropDownList($searchModel, 'status', $searchModel::getStatuses(), ['class' => 'form-control', 'prompt' => Yii::t('app', 'All')])
                ],
                [
                    'attribute' => 'file_name',
                    'format' => 'raw',
                    'value' => function($model){
                        return $model->file_name ? Html::a(Yii::t('app', 'Download'), '#', ['data-link' => '/export/export-queue/download?id=' . $model->id]) : null;
                    },
                    'filter' => false
                ],
                [
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '{view} {delete}',
                ],
            ],
        ]); ?>
    <?php Pjax::end(); ?>
</div>
