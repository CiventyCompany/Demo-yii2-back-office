<?php
use yii\helpers\Html;
use backend\modules\app_interface\models\Notifications;

/* @var $this \yii\web\View */
/* @var $content string */
?>

<header class="main-header">

    <?= Html::a('<span class="logo-mini">APP</span><span class="logo-lg">' . Yii::$app->name . '</span>', Yii::$app->homeUrl, ['class' => 'logo']) ?>

    <nav class="navbar navbar-static-top" role="navigation">

        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">

            <ul class="nav navbar-nav">

                <?= \backend\modules\app_interface\widgets\HeaderNotifications::widget(); ?>


                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="<?= Yii::$app->params['frontURL'] .\backend\modules\user\models\Profile::getUserAvatar(Yii::$app->user->id) ?>" class="user-image" alt="User Image"/>
                        <span class="hidden-xs"><?= \backend\modules\user\models\Profile::getUserFullName(Yii::$app->user->id, false); ?></span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <img src="<?= Yii::$app->params['frontURL'] .\backend\modules\user\models\Profile::getUserAvatar(Yii::$app->user->id) ?>" class="img-circle"
                                 alt="User Image"/>

                            <p>
                                <?= \backend\modules\user\models\Profile::getUserFullName(Yii::$app->user->id); ?>
                            </p>
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
<!--                                <a href="#" class="btn btn-default btn-flat">Profile</a>-->
                            </div>
                            <div class="pull-right">
                                <?= Html::a( Yii::$app->user->isGuest ? Yii::t('app','Sign in') : Yii::t('app','Sign out'),
                                    Yii::$app->user->isGuest ? ['/user/security/login'] : ['/user/security/logout'],
                                    ['data-method' => Yii::$app->user->isGuest ? 'get' : 'post', 'class' => 'btn btn-default btn-flat']
                                ) ?>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>
