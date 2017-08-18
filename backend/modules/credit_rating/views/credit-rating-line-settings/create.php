<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\modules\credit_rating\models\CreditRatingLineSettings */

$this->title = Yii::t('app', 'Create Credit Rating Line Settings');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Credit Rating Line Settings'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="credit-rating-line-settings-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
