<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\modules\event\models\search\EventActionConditionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $eventAction \backend\modules\event\models\EventAction */
/* @var $eventHandler \backend\modules\event\models\EventHandler */

$this->title = Yii::t('app', 'Event Action Conditions');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Event Actions'), 'url' => ['/event/event/index']];
$this->params['breadcrumbs'][] = ['label' => $eventHandler->getTitle($eventAction->getModelPath(), $eventAction->event_name), 'url' => ['/event/event/update', 'model' => $eventAction->model, 'event_name' => $eventAction->event_name]];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Action') . '№' . $searchModel->event_action_id, 'url' => ['/event/event-action/update', 'id' => $searchModel->event_action_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="event-action-condition-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Event Action Condition'), ['create', 'event_action_id' => $searchModel->event_action_id], ['class' => 'btn btn-success']) ?>
    </p>

    <?= \yii\bootstrap\Tabs::widget([
        'items' => [
            [
                'label' => Yii::t('app', 'General information'),
                'url' => ['/event/event-action/update', 'id' => $searchModel->event_action_id]
            ],
            [
                'label' => Yii::t('app', 'Conditions'),
                'active' => true,
                'content' => GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'columns' => [
                        'key',
                        'value',
                        /*[
                            'attribute' => 'operator',
                            'filter' => Html::activeDropDownList($searchModel, 'operator', $searchModel->getOperators(), ['class' => 'form-control', 'prompt' => Yii::t('app', 'All')]),
                            'value' => function($model){
                                return $model->getOperators()[$model->operator];
                            }
                        ],*/
                        [
                            'class' => 'yii\grid\ActionColumn',
                            'template' => '{update} {delete}'
                        ],
                    ],
                ])
            ],
        ]
    ]) ?>

</div>
