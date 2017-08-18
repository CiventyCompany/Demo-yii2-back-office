<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\modules\identification\models\IdentificationMethod */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Identification Method',
]) . $model->product->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Identification Methods'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->product->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="identification-method-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

    <?php if($model->alias == 'courier'){
        echo $this->render('_method_city', ['model' => $model]);
    } ?>
</div>
