<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\modules\credit_product\models\CreditProductType */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Credit Product Type',
]) . $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Credit Product Types'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="credit-product-type-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
