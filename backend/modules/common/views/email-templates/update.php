<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\modules\common\models\EmailTemplates */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Email Templates',
]) . $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Email Templates'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="email-templates-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
