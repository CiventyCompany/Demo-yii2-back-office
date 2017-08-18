<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\modules\app_interface\models\SiteSettings */

$this->title = Yii::t('app', 'Create Site Setting');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Site Settings'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-settings-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
