<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\modules\credit_product\models\CreditProductCategory */

$this->title = Yii::t('app', 'Create Credit Product Category');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Credit Product Categories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="credit-product-category-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
