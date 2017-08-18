<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model \common\modules\location\models\Region */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Region',
]) . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Region'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->region_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="location-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
