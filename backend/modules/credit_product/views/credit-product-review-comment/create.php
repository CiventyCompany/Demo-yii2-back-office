<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\modules\credit_product\models\CreditProductReviewComment */

$this->title = Yii::t('app', 'Create Credit Product Review Comment');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Credit Product Review Comments'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="credit-product-review-comment-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
