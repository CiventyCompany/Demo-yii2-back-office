<?php

/* @var $this yii\web\View */
/* @var $model common\modules\app_interface\models\Notifications */

$this->title = 'Update Notifications: ' . $model->value;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app','Notifications'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->value];
$this->params['breadcrumbs'][] = Yii::t('app','Update');
?>
<div class="notifications-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
