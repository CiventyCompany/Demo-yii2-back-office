<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\modules\event\models\search\EventActionSearch */
/* @var $dataProvider \yii\data\ActiveDataProvider */
/* @var $eventHandler \backend\modules\event\models\EventHandler */

$this->title = $eventHandler->getTitle($searchModel->getModelPath(), $searchModel->event_name);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Event Actions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="event-action-index">

    <p>
        <?= Html::a(Yii::t('app', 'Create Event Action'), ['/event/event-action/create', 'modelName' => \common\helpers\ClassHelper::getClassName( $searchModel->model ), 'eventName' => $searchModel->event_name], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'title',
            'description',
            [
                'label' => Yii::t('app', 'Availability of conditions'),
                'format' => 'raw',
                'filter' => Html::activeDropDownList( $searchModel, 'has_conditions', [
                    -1 => Yii::t('app', 'No'),
                    1 => Yii::t('app', 'Yes'),
                ], ['class' => 'form-control', 'prompt' => Yii::t('app', 'All')]),
                'value' => function($model){
                    $count = count($model->eventActionConditions);
                    $text = $count ? $count : '0';
                    return Html::a($text, ['/event/event-action-condition/index', 'event_action_id' => $model->id]);
                }
            ],
            [
                'label' => Yii::t('app', 'Delay period'),
                'value' => function($model){
                    $settings = json_decode( $model->settings, true );
                    $model = new $model->handler_model();
                    $model->load( $settings );
                    return $model->delay ? $model->delay : Yii::t('app', 'No');
                }
            ],
            [
                'attribute' => 'handler_model',
                'filter' => Html::activeDropDownList($searchModel, 'handler_model', $searchModel->getModels(), ['class' => 'form-control', 'prompt' => Yii::t('app', 'All')]),
                'value' => function($model){
                    return $model->getModels()[ $model->handler_model ];
                }
            ],
            [
                'attribute' => 'status',
                'filter' => Html::activeDropDownList($searchModel, 'status', $searchModel->getStatusList(), ['class' => 'form-control', 'prompt' => Yii::t('app', 'All')]),
                'value' => function($model){
                    return $model->getStatusList()[ $model->status ];
                }
            ],
            //'priority',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update} {delete}',
                'urlCreator' => function($action, $model, $key, $index){
                    return ['/event/event-action/' . $action, 'id' => $model->id];
                }
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
