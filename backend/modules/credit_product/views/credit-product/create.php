<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\modules\credit_product\models\CreditProduct */

$this->title = Yii::t('app', 'Create Credit Product');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Credit Products'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="credit-product-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
