<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\modules\credit_product\models\CreditProductReferenceValues */

$this->title = Yii::t('app', 'Create Credit Product Reference Values');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Credit Product Reference Values'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="credit-product-reference-values-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
