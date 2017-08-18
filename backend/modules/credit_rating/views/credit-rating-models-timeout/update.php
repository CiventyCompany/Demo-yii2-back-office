<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\modules\credit_rating\models\CreditRatingModelsTimeout */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Credit Rating Models Timeout',
]) . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Credit Rating Models Timeouts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="credit-rating-models-timeout-update">

    <?= $this->render('_form', [
        'model' => $model,
        'models' => $models,
        'activeModels' => $activeModels,
    ]) ?>

</div>
