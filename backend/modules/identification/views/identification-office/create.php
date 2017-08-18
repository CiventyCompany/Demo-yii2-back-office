<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\modules\identification\models\IdentificationMethod */

$this->title = Yii::t('app', 'Create Office');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Offices'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="identification-method-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
