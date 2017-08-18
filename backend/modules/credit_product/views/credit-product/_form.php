<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use mihaildev\ckeditor\CKEditor;

/* @var $this yii\web\View */
/* @var $model common\modules\credit_product\models\CreditProduct */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="credit-product-form">

    <?php $form = ActiveForm::begin([
        'enableClientValidation' => false,
        'enableAjaxValidation' => true,
    ]); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?php if(!$model->isNewRecord){ ?>
    <?= $form->field($model, 'text')->widget(CKEditor::className(),[
        'editorOptions' => [
            'preset' => 'full',
            'inline' => false,
            'height' => 250
        ],
    ]); ?>

    <?= $form->field($model, 'text_short')->widget(CKEditor::className(),[
        'editorOptions' => [
            'preset' => 'full',
            'inline' => false,
            'height' => 250
        ],
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

    <?php } ?>

    <?php if($model->isNewRecord){ ?>

        <?= $form->field($model, 'type_id')->dropDownList(\yii\helpers\ArrayHelper::map($model->getTypes(), 'id', 'title'), ['prompt' => Yii::t('app', 'Select'), 'class' => 'form-control']) ?>

        <?= $form->field($model, 'credit_product_category_ids')->dropDownList( [], ['class' => 'form-control', 'multiple'=>'multiple']) ?>

    <?php } else { ?>

        <?= $form->field($model, 'type_id')->hiddenInput()->label(false) ?>

        <?= \backend\modules\credit_product\widgets\CustomFields::widget(['model' => $model]); ?>

        <?php
        $categories = [];
        foreach ( $model->getGroupsIds() as $groupsId )
        {

        }
        ?>
        <?= $form->field($model, 'credit_product_category_ids')->dropDownList( $model->getGroupsTrees(), ['class' => 'form-control', 'multiple'=>'multiple']) ?>

        <?= $form->field($model, 'relations')->dropDownList( \yii\helpers\ArrayHelper::map($model->getAvailableProducts(), 'id', 'title'), ['multiple' => 'multiple', 'prompt' => Yii::t('app', 'No')] ) ?>
    <?php } ?>

    <?= $form->field($model, 'sort')->input('number', ['value' => $model->isNewRecord ? 0 : $model->sort]) ?>

    <?= $form->field($model, 'alias')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->dropDownList( $model->getAvailableStatuses(false), ['value' => $model->isNewRecord ? 0 : $model->status] ) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
