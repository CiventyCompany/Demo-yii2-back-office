<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\api\models\Partners */
/* @var $link_app */
/* @var $link_partners */

$this->title = Yii::t('app', 'API');
$this->params['breadcrumbs'][] = $this->title;
$this->registerCss("
.content-header{
display:none;
}
");
?>
<div class="container">
    <div class="jumbotron">
        <h1>API Скорим</h1>
        <p>Ниже представленны ссылки на документацию <strong><span class="text text-success"><a href="https://ru.wikipedia.org/wiki/API" target="_blank" title="Что это??">API</a></span></strong> приложения.</p>
    </div>

    <div class="col-lg-12 col-md-12" style="text-align: center">
        <a href="<?= $link_partners; ?>" target="_blank" class="btn-lg btn-success" style="margin-right: 15px;">
            <i class="fa fa-users" aria-hidden="true"></i> API для партнёров
        </a>
        <a href="<?= $link_app?>" target="_blank" class="btn-lg btn-success" style="margin-left: 15px;">
            API для приложений <i class="fa fa-american-sign-language-interpreting" aria-hidden="true"></i>
        </a>
    </div>
</div>