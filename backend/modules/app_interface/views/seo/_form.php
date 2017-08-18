<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $seo common\modules\app_interface\models\Seo */
/* @var $seoData common\modules\app_interface\models\SeoData */

?>
<div class="seo-form row" style="max-height: 75vh; overflow: auto">
    <div class="col-md-5 col-lg-5">
        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($seo,'url')->textInput(['maxlength' => true, 'readonly' => 'readonly']); ?>

        <?= $form->field($seoData, 'title')->textInput(['maxlength' => true]); ?>

        <?= $form->field($seoData, 'h1')->textInput(['maxlength' => true]); ?>

        <?= $form->field($seoData, 'description')->textarea(['maxlength' => true, 'rows' => 6]); ?>

        <?= $form->field($seoData, 'keywords')->textInput(['maxlength' => true]); ?>

        <?= $form->field($seoData, 'page_text')->textarea(['maxlength' => true, 'rows' => 10]); ?>

        <div class="form-group">
            <?= Html::submitButton(Yii::t('app', 'Update') , ['class' => 'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>

    <div class="col-md-7 col-lg-7">
        <blockquote>
            <?= Yii::t('app', 'The following templates are available:'); ?>
            <ul>
                <li><?= Yii::t('app', '[title] - title of the page, post, question etc.'); ?></li>
                <li><?= Yii::t('app', '[h1] - h1 of the page, post, question etc.'); ?></li>
                <li><?= Yii::t('app', '[keywords] - tags of the page or record'); ?></li>
                <li><?= Yii::t('app', '[description] - short description'); ?></li>
            </ul>
            <small>
                <?= Yii::t('app', 'Template - is a special character which will overwrite the dynamic information in the output.<br> They works only on dynamic pages.'); ?>
            </small>
            <br>
            <p class="text text-primary"> Используемые поля на страницах: </p>
            <div class="col-lg-6 col-md-6">
                <div style="font-size: small">
                    Главная ( / )
                    <ul>
                        <li>Тайтл страницы</li>
                        <li>Ключевые слова</li>
                        <li>Описание страницы</li>
                    </ul>
                    Советы - главная ( /advices )
                    <ul>
                        <li>Все поля</li>
                    </ul>
                    Советы - страница категории ( /advices/alias )
                    <ul>
                        <li>Все поля</li>
                    </ul>
                    Советы - страница вопроса ( /question/alias )
                    <ul>
                        <li>Все поля</li>
                    </ul>
                    Советы - добавление вопроса ( /question/add-question )
                    <ul>
                        <li>Все поля</li>
                    </ul>
                    Статьи - главная ( /articles )
                    <ul>
                        <li>Тайтл страницы</li>
                        <li>Заголовок h1</li>
                        <li>Ключевые слова</li>
                        <li>Описание страницы</li>
                    </ul>
                    Статьи - страница статьи|раздела ( /articles/alias )
                    <ul>
                        <li>Тайтл страницы</li>
                        <li>Заголовок h1</li>
                        <li>Ключевые слова</li>
                        <li>Описание страницы</li>
                    </ul>
                    Карты - главная ( /cards )
                    <ul>
                        <li>Тайтл страницы</li>
                        <li>Заголовок h1</li>
                        <li>Ключевые слова</li>
                        <li>Описание страницы</li>
                    </ul>
                    Карты - страница карты|категории ( /cards/alias )
                    <ul>
                        <li>Тайтл страницы</li>
                        <li>Заголовок h1</li>
                        <li>Ключевые слова</li>
                        <li>Описание страницы</li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <div style="font-size: small">
                    Кредиты - главная ( /credits )
                    <ul>
                        <li>Все поля</li>
                    </ul>
                    Кредиты - страница кредита ( /credits/alias )
                    <ul>
                        <li>Тайтл страницы</li>
                        <li>Заголовок h1</li>
                        <li>Ключевые слова</li>
                        <li>Описание страницы</li>
                    </ul>
                    Займы - главная ( /loans )
                    <ul>
                        <li>Все поля</li>
                    </ul>
                    Займы - страница займа ( /loans/alias )
                    <ul>
                        <li>Все поля</li>
                    </ul>
                    Логин ( /login )
                    <ul>
                        <li>Тайтл страницы</li>
                        <li>Заголовок h1</li>
                        <li>Ключевые слова</li>
                        <li>Описание страницы</li>
                    </ul>
                    Регистрация ( /registration )
                    <ul>
                        <li>Тайтл страницы</li>
                        <li>Ключевые слова</li>
                        <li>Описание страницы</li>
                    </ul>
                    Восстановление доступа ( /restore )
                    <ul>
                        <li>Тайтл страницы</li>
                        <li>Ключевые слова</li>
                        <li>Описание страницы</li>
                    </ul>
                </div>
            </div>

        </blockquote>
    </div>
</div>
