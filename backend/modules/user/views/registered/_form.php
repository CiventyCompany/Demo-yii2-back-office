<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;
use yii\widgets\MaskedInput;
use mihaildev\elfinder\InputFile;

/* @var $this yii\web\View */
/* @var $user \backend\modules\user\models\User */
/* @var $profile \backend\modules\user\models\Profile */
/* @var $form yii\widgets\ActiveForm */


$avatar = is_object($profile->avatar) ? $profile->avatar->avatar : '';
$user->getPhone();
$user->role = $user->getRole();

?>

<div class="questions-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($profile, 'firstname')->textInput(['maxlength' => true]); ?>

    <?= $form->field($profile, 'midlename')->textInput(['maxlength' => true]); ?>

    <?= $form->field($profile, 'lastname')->textInput(['maxlength' => true]); ?>

    <?= $form->field($user, 'avatar')->widget(
        InputFile::className(), [
            'language'      => 'ru',
            'controller'    => 'elfinder',
            'filter'        => 'image',
            'template'      => '<div class="input-group">{input}<span class="input-group-btn">{button}</span></div>',
            'options'       => ['class' => 'form-control', 'value' => $avatar],
            'buttonOptions' => ['class' => 'btn btn-default'],
            'multiple'      => false,
            'buttonName'    => Yii::t('app', 'Browse')
        ])
        ->label(Yii::t('app','Avatar'));
    ?>

    <?= $form->field($user, 'email')->input('email',['maxlength' => true]); ?>

    <?= $form->field($user, 'email_confirm')->radioList([
        0 => Yii::t('app','Not confirmed'),
        1 => Yii::t('app','Confirmed')
    ]); ?>

    <?= $form->field($user,'phone')->widget(MaskedInput::className(),
        ['mask' => '+9 (999) 999 99 99'])
        ->label(Yii::t('app','Phone')); ?>
    <?= $form->field($user, 'phone_confirm')->radioList([
        0 => Yii::t('app','Not confirmed'),
        1 => Yii::t('app','Confirmed')
    ]); ?>

    <?= $form->field($profile,'gender')->dropDownList([
        'M' => Yii::t('app','Male'),
        'F' => Yii::t('app','Female')
    ]); ?>

    <?= $form->field($profile, 'passport_series')->textInput(['maxlength' => 4]); ?>

    <?= $form->field($profile, 'passport_number')->textInput(['maxlength' => 6]); ?>

    <?= $form->field($user, 'role')->dropDownList([
        'admin'     => Yii::t('app','Admin'),
        'user'      => Yii::t('app','User'),
        //'partner'   => Yii::t('app','Partner')
    ]); ?>

    <?= $form->field($profile, 'snils')->textInput(['maxlength' => 15]); ?>

    <?= $form->field($profile, 'birthday')->widget(DatePicker::className(),[
        'attribute'  => 'birthday',
        'dateFormat' => 'php:Y-m-d',
        'options'    => ['class' => 'form-control']
    ]); ?>

    <?= $form->field($profile, 'passport_date')->widget(DatePicker::className(),[
        'attribute'  => 'passport_date',
        'dateFormat' => 'php:Y-m-d',
        'options'    => ['class' => 'form-control']
    ]); ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app','Update'), ['class' =>  'btn btn-primary']); ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

