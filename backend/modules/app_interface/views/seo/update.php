<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $seo common\modules\app_interface\models\Seo */
/* @var $seoData common\modules\app_interface\models\SeoData */

$this->title = Yii::t('app', 'Update Setting: '). (!is_null($seoData) ? $seoData->title : $seo->url);
$this->params['breadcrumbs'][] = ['label' => 'SEO', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => (!is_null($seoData) ? $seoData->title : $seo->url), 'url' => ['index']];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="seo-update">

    <?= $this->render('_form', [
        'seo' => $seo,
        'seoData' => $seoData,
    ]) ?>

</div>
