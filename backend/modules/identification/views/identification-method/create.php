<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\modules\identification\models\IdentificationMethod */

$this->title = Yii::t('app', 'Create Identification Method');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Identification Methods'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="identification-method-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
