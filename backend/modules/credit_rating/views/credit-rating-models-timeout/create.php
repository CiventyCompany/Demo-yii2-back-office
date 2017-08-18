<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\modules\credit_rating\models\CreditRatingModelsTimeout */

$this->title = Yii::t('app', 'Create Credit Rating Models Timeout');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Credit Rating Models Timeouts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="credit-rating-models-timeout-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'models' => $models,
        'activeModels' => $activeModels,
    ]) ?>

</div>
