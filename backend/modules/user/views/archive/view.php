<?php

use yii\bootstrap\Tabs;

/* @var $this yii\web\View */
/* @var $model \backend\modules\user\models\User */
/* @var $repostsSearchModel \backend\modules\social\models\SocialShareSearch */
/* @var $repostsDataProvider \backend\modules\social\models\SocialShare */
/* @var $activitySearchModel \backend\modules\user\models\UserAccessLogSearch */
/* @var $activityDataProvider \backend\modules\user\models\UserAccessLog */


$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Deleted users'), 'url' => ['/user/archive/index']];
$this->params['breadcrumbs'][] = $this->title;
?>


<div class="source-message-view">

    <?= Tabs::widget([
        'items' => [
            [
                'label' => Yii::t('app', 'Detail'),
                'content' =>  $this->render('@backend/modules/user/views/registered/_detail', [
                    'model' => $model,
                ]),
                'active' => true
            ],
            [
                'label' => Yii::t('app', 'Balance'),
                'content' =>  $this->render('@backend/modules/user/views/registered/_bonus', [
                    'balanceSearchModel' => $balanceSearchModel,
                    'balanceDataProvider' => $balanceDataProvider,
                ]),
            ],
            [
                'label' => Yii::t('app', 'Actions'),
                'content' => $this->render('@backend/modules/user/views/registered/_activity', [
                    'activitySearchModel' => $activitySearchModel,
                    'activityDataProvider' => $activityDataProvider
                ])
            ],
            [
                'label' => Yii::t('app', 'Activity history'),
                'content' => $this->render('_activity_history', [
                    'UserAccessLogSearch' => $UserAccessLogSearch,
                    'UserAccessLogSearchDataProvider' => $UserAccessLogSearchDataProvider,
                    'model' => $model,
                ])
            ],
            [
                'label' => Yii::t('app', 'Invites'),
                'content' => $this->render('@backend/modules/user/views/registered/_invites', [
                    'UserInvitationEmailSearchModel' => $UserInvitationEmailSearchModel,
                    'UserInvitationEmailDataProvider' => $UserInvitationEmailDataProvider,
                    'model' => $model,
                ])
            ],
            [
                'label' => Yii::t('app', 'Reposts'),
                'content' => $this->render('@backend/modules/user/views/registered/_reposts', [
                    'repostsSearchModel' => $repostsSearchModel,
                    'repostsDataProvider' => $repostsDataProvider
                ])
            ],
            [
                'label' => Yii::t('app', 'User secret questions'),
                'content' => $this->render('@backend/modules/user/views/registered/_secret_questions', [
                    'secretQuestionsSearchModel' => $secretQuestionsSearchModel,
                    'secretQuestionsDataProvider' => $secretQuestionsDataProvider
                ])
            ],
        ],
    ]);?>



</div>
