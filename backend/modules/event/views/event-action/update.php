<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\modules\event\models\EventAction */
/* @var $eventHandler \backend\modules\event\models\EventHandler */

$this->title = Yii::t('app', 'Update Event Action for: ') . $eventHandler->getTitle($model->getModelPath(), $model->event_name);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Event Actions'), 'url' => ['/event/event/index']];
$this->params['breadcrumbs'][] = ['label' => $eventHandler->getTitle($model->getModelPath(), $model->event_name), 'url' => ['/event/event/update', 'model' => $model->model, 'event_name' => $model->event_name]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="event-action-update">

    <?= \yii\bootstrap\Tabs::widget([
        'items' => [
            [
                'label' => Yii::t('app', 'General information'),
                'content' => $this->render('_form', [
                    'model' => $model,
                    'eventHandler' => $eventHandler,
                ])
            ],
            [
                'label' => Yii::t('app', 'Conditions'),
                'url' => ['/event/event-action-condition/index', 'event_action_id' => $model->id]
            ],
        ]
    ]) ?>

</div>
