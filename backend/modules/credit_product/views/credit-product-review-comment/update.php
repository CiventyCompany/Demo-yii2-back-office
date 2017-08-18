<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\modules\credit_product\models\CreditProductReviewComment */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Credit Product Review Comment',
]) . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Credit Product Review Comments'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="credit-product-review-comment-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
