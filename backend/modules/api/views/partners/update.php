<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $partner backend\modules\api\models\Partners */

$this->title = Yii::t('app','Update Partner: ' ). $partner->getUserName();
$this->params['breadcrumbs'][] = ['label' => Yii::t('app','Partners'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $partner->getUserName(), 'url' => ['index']];
$this->params['breadcrumbs'][] = Yii::t('app','Update');
?>
<div class="partners-update">

    <?= $this->render('_form', [
        'partner' => $partner,
        'user'    => $user,
        'fields'  => $fields
    ]) ?>

</div>
