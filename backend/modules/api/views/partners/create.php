<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\api\models\Partners */

$this->title = Yii::t('app','Add partner');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app','Partners'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="partners-create">

    <?= $this->render('_form', [
        'partner' => $partner,
        'user'    => $user,
        'fields'  => $fields
    ]) ?>

</div>
