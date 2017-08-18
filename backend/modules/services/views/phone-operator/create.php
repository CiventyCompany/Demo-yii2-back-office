<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\services\models\PhoneOperator */

$this->title = Yii::t('app', 'Create Phone Operator');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Phone Operators'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="phone-operator-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
