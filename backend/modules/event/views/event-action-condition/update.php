<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\modules\event\models\EventActionCondition */
/* @var $eventAction common\modules\event\models\EventAction */
/* @var $eventAction \backend\modules\event\models\EventAction */
/* @var $eventHandler \backend\modules\event\models\EventHandler */

$this->title = Yii::t('app', 'Update Action Conditions');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Event Actions'), 'url' => ['/event/event/index']];
$this->params['breadcrumbs'][] = ['label' => $eventHandler->getTitle($eventAction->getModelPath(), $eventAction->event_name), 'url' => ['/event/event/update', 'model' => $eventAction->model, 'event_name' => $eventAction->event_name]];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Action') . '№' . $model->event_action_id, 'url' => ['/event/event-action/update', 'id' => $model->event_action_id]];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Event Action Conditions'), 'url' => ['/event/event-action-condition/index', 'event_action_id' => $model->event_action_id]];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="event-action-condition-update">

    <?= $this->render('_form', [
        'model' => $model,
        'eventAction' => $eventAction,
    ]) ?>

</div>
