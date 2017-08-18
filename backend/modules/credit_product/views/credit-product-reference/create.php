<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\modules\credit_product\models\CreditProductReference */

$this->title = Yii::t('app', 'Create Credit Product Reference');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Credit Product References'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="credit-product-reference-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
