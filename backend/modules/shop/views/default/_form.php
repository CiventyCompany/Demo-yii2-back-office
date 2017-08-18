<?php
use yii\bootstrap\ActiveForm;
use \yii\helpers\Html;
?>

<?php $form = ActiveForm::begin() ?>

<?= $form->field($model, 'title')->textInput(); ?>

<?= $form->field($model, 'description')->textarea(); ?>

<?= $form->field($model, 'full_description')->widget(\mihaildev\ckeditor\CKEditor::className(),[
    'editorOptions' => [
        'preset' => 'full',
        'inline' => false,
    ],
]); ?>

<?= $form->field($model, 'price')->textInput(); ?>

<?= $form->field($model, 'link')->textInput(); ?>

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

<?= $form->field($model, 'image_width')->input('number') ?>

<?= $form->field($model, 'image_height')->input('number') ?>

<?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => 'btn btn-primary']) ?>

<?= Html::a(Yii::t('app', 'Cancel'), ['/shop/default/index'], ['class' => 'btn btn-danger']) ?>

<?php ActiveForm::end(); ?>