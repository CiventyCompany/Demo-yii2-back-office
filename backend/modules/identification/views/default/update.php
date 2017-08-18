<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\modules\identification\models\IdentificationHistory */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Identification',
]) . $model->identificationMethod->product->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Identification'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->identificationMethod->product->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="identification-method-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
