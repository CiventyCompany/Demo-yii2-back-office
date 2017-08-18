<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\modules\event\models\EventAction */
/* @var $eventHandler \backend\modules\event\models\EventHandler */

$this->title = Yii::t('app', 'Create Event Action for: ') . $eventHandler->getTitle($model->getModelPath(), $model->event_name);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Event Actions'), 'url' => ['/event/event/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="event-action-create">

    <?= $this->render('_form', [
        'model' => $model,
        'eventHandler' => $eventHandler,
    ]) ?>

</div>
