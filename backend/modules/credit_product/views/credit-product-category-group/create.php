<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\modules\credit_product\models\CreditProductCategoryGroup */

$this->title = Yii::t('app', 'Create Credit Product Category Group');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Credit Product Category Groups'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="credit-product-category-group-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
