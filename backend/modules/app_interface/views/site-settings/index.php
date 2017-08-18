<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\modules\app_interface\models\SiteSettings;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\app_interface\models\SiteSettingsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app','Site Settings');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-settings-index">


    <p>
        <?= Html::a(Yii::t('app','Create Site Setting'), ['create'], ['class' => 'btn btn-success']); ?>
        <?= Html::a(Yii::t('app','Clear cache'), ['clear-cache'], ['class' => 'btn btn-warning']); ?>
    </p>

    <?php \yii\widgets\Pjax::begin(); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [

            'setting_id',
            'title',
            'key',
            'value',
//            [
//                'attribute' => 'type',
//                'format' => 'raw',
//                'value' => function($model){
//                    return SiteSettings::getTypeTitle($model->type);
//                },
//                'filter' => Html::activeDropDownList($searchModel, 'type', SiteSettings::getTypesDropDown(),
//                    ['prompt' => '', 'class' => 'form-control'])
//            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php \yii\widgets\Pjax::end(); ?>
</div>
