<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\modules\credit_product\models\CreditProductWidget */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Credit Product Widget',
]) . $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Credit Product Widgets'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="credit-product-widget-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
