<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\modules\credit_product\models\CreditProductField */

$this->title = Yii::t('app', 'Create Credit Product Field');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Credit Product Fields'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="credit-product-field-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
