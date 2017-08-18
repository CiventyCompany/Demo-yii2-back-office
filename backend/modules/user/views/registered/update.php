<?php

use backend\modules\user\models\Profile;

/* @var $this yii\web\View */
/* @var $profile \common\modules\user\models\Profile
 * @var $user \backend\modules\user\models\User
 */

$this->title = Yii::t('app','Update User: ').$profile->getName();
$this->params['breadcrumbs'][] = ['label' => Yii::t('app','Registrations'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $profile->getName(), 'url' => ['view', 'id' => $profile->user_id]];
$this->params['breadcrumbs'][] = Yii::t('app','Update');
?>
<div class="profile-update">

    <?= $this->render('_form', [
        'user'    => $user,
        'profile' => $profile,
    ]) ?>

</div>
