<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\modules\app_interface\models\SiteSettings */

$this->title = Yii::t('app','Update Site Setting: '). $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app','Site Settings'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->setting_id]];
$this->params['breadcrumbs'][] = Yii::t('app','Update');
?>
<div class="site-settings-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
