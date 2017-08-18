<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\modules\credit_product\models\CreditProductWidget */

$this->title = Yii::t('app', 'Create Credit Product Widget');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Credit Product Widgets'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="credit-product-widget-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
