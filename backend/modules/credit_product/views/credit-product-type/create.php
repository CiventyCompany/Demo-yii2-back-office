<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\modules\credit_product\models\CreditProductType */

$this->title = Yii::t('app', 'Create Credit Product Type');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Credit Product Types'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="credit-product-type-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
