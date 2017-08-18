<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\modules\credit_product\models\CreditProductReferenceValues */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="credit-product-reference-values-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'credit_product_reference_id')->dropDownList( \yii\helpers\ArrayHelper::map($model->getReferences(), 'id', 'title') ) ?>

    <?= $form->field($model, 'value')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'image')->widget(\mihaildev\elfinder\InputFile::className(), [
        'language'      => 'ru',
        'controller'    => 'elfinder', // вставляем название контроллера, по умолчанию равен elfinder
        'filter'        => 'image',    // фильтр файлов, можно задать массив фильтров https://github.com/Studio-42/elFinder/wiki/Client-configuration-options#wiki-onlyMimes
        'template'      => '<div class="input-group">{input}<span class="input-group-btn">{button}</span></div>',
        'options'       => ['class' => 'form-control'],
        'buttonOptions' => ['class' => 'btn btn-default'],
        'multiple'      => false,       // возможность выбора нескольких файлов
        'buttonName' => Yii::t('app', 'Browse')
    ]); ?>

    <?= $form->field($model, 'sort')->input('number', ['value' => $model->isNewRecord ? 0 : $model->sort]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
