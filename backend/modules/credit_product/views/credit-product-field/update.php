<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\modules\credit_product\models\CreditProductField */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Credit Product Field',
]) . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Credit Product Fields'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="credit-product-field-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
