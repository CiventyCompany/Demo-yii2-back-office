<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\modules\credit_rating\models\CreditRatingLineSettings */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Credit Rating Line Settings',
]) . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Credit Rating Line Settings'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="credit-rating-line-settings-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
