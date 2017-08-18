<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use mihaildev\ckeditor\CKEditor;
use kartik\datetime\DateTimePicker;

/* @var $this yii\web\View */
/* @var $model backend\modules\news\models\News */
/* @var $form yii\widgets\ActiveForm */
if(!$model->isNewRecord){
    $model->user_id = $model->user_id = $model->user->id . ' - ' . implode(' ', [$model->user->profile->firstname, $model->user->profile->lastname, $model->user->profile->midlename]);
}
?>

<div class="news-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'category_id')->dropDownList( \backend\modules\news\models\NewsCategory::getCategoriesTree() ) ?>

    <?= $form->field($model, 'type_id')->dropDownList( $model->getTypes() ) ?>

    <?= $form->field($model, 'published_at')->widget(DateTimePicker::className(), [
            'name' => 'published',
            'convertFormat' => true,
            'pluginOptions' => [
                'format' => 'yyyy-MM-dd hh:i',
            ]
    ]); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->widget(CKEditor::className(),[
        'editorOptions' => [
            'preset' => 'full',
            'inline' => false,
        ],
    ]); ?>

    <?= $form->field($model, 'short_description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'alias')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->radioList($model->getStatusArray()) ?>

    <?= $form->field($model, 'icon')->widget(\mihaildev\elfinder\InputFile::className(), [
        'language'      => 'ru',
        'controller'    => 'elfinder', // вставляем название контроллера, по умолчанию равен elfinder
        'filter'        => 'image',    // фильтр файлов, можно задать массив фильтров https://github.com/Studio-42/elFinder/wiki/Client-configuration-options#wiki-onlyMimes
        'template'      => '<div class="input-group">{input}<span class="input-group-btn">{button}</span></div>',
        'options'       => ['class' => 'form-control'],
        'buttonOptions' => ['class' => 'btn btn-default'],
        'multiple'      => false,       // возможность выбора нескольких файлов
        'buttonName' => Yii::t('app', 'Browse')
    ]); ?>

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

    <?= $form->field($model, 'background_image')->widget(\mihaildev\elfinder\InputFile::className(), [
        'language'      => 'ru',
        'controller'    => 'elfinder', // вставляем название контроллера, по умолчанию равен elfinder
        'filter'        => 'image',    // фильтр файлов, можно задать массив фильтров https://github.com/Studio-42/elFinder/wiki/Client-configuration-options#wiki-onlyMimes
        'template'      => '<div class="input-group">{input}<span class="input-group-btn">{button}</span></div>',
        'options'       => ['class' => 'form-control'],
        'buttonOptions' => ['class' => 'btn btn-default'],
        'multiple'      => false,       // возможность выбора нескольких файлов
        'buttonName' => Yii::t('app', 'Browse')
    ]); ?>

    <?= $form->field($model, 'credit_product_type_ids')->dropDownList( $model->getAllCreditProductTypes(), ['class' => 'form-control', 'multiple'=>'multiple']) ?>

    <?= $form->field($model, 'credit_product_category_ids')->dropDownList( $model->getGroupsTrees(), ['class' => 'form-control', 'multiple'=>'multiple']) ?>

    <?= $form->field($model, 'user_id')->widget(\yii\jui\AutoComplete::classname(), [
        'clientOptions' => [
            'source' => '/user/ajax/auto-complete',
        ],
        'options' => [
            'class' => 'form-control'
        ],
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Cancel'), ['/news/default/index'], ['class' => 'btn btn-danger']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
