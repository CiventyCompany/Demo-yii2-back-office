<?php

use yii\bootstrap\Tabs;
use backend\modules\user\models\Profile;

/* @var $this yii\web\View */
/* @var $model \backend\modules\user\models\User */
/* @var $repostsSearchModel \backend\modules\social\models\SocialShareSearch */
/* @var $repostsDataProvider \backend\modules\social\models\SocialShare */
/* @var $activitySearchModel \backend\modules\user\models\UserAccessLogSearch */
/* @var $activityDataProvider \backend\modules\user\models\UserAccessLog */
/* @var $modalForm \backend\modules\user\models\ModalForm */
/* @var $modalBalanceForm \common\modules\user\models\UserBalance */
/* @var $statuses ModerationStatuses Array */


$this->title = Profile::getUserFullName($model->id);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Registered users'), 'url' => ['/user/registered/index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="source-message-view">

    <?= $this->render("_buttons",[
        'userId'   => $model->id,
        'statuses' => $statuses]);
    ?>

    <?= $this->render("_modal-block",[
        'userId'    => $model->id,
        'modalForm' => $modalForm,
        'status'    => $statuses['blocked']
    ]); ?>

    <?= $this->render("_modal-freeze",[
        'userId'    => $model->id,
        'modalForm' => $modalForm,
        'status'    => $statuses['frozen']
    ]); ?>

    <?= $this->render("_modal-deleteStatus",[
        'userId'    => $model->id,
        'modalForm' => $modalForm,
        'status'    => $statuses['delStatus']
    ]); ?>

    <?= $this->render("_modal-deleteArchive",[
        'userId'    => $model->id,
        'modalForm' => $modalForm,
        'status'    => $statuses['delArchive']
    ]); ?>

    <?= $this->render("_modal-balance",[
        'userId'           => $model->id,
        'modalBalanceForm' => $modalBalanceForm
    ]); ?>

    <?= Tabs::widget([
        'items' => [
            [
                'label' => Yii::t('app', 'Detail'),
                'content' =>  $this->render('_detail', [
                    'model' => $model,
                ]),
                'active' => Yii::$app->request->get('tab') ? false : true
            ],
            [
                'label' => Yii::t('app', 'Credit rating data'),
                'content' => $this->render('_credit_rating', [
                    'model' => $creditRating->lastCreditRatingHistory,
                ])
            ],
            [
                'label' => Yii::t('app', 'Credit rating history'),
                'content' => $this->render('_credit_rating_history', [
                    'CreditRatingHistorySearch' => $CreditRatingHistorySearch,
                    'CreditRatingHistorySearchDataProvider' => $CreditRatingHistorySearchDataProvider,
                ])
            ],
            [
                'label' => Yii::t('app', 'Balance'),
                'content' =>  $this->render('_bonus', [
                    'balanceSearchModel' => $balanceSearchModel,
                    'balanceDataProvider' => $balanceDataProvider,
                ]),
            ],
            [
                'label' => Yii::t('app', 'Actions'),
                'content' => $this->render('_activity', [
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
                'content' => $this->render('_invites', [
                    'UserInvitationEmailSearchModel' => $UserInvitationEmailSearchModel,
                    'UserInvitationEmailDataProvider' => $UserInvitationEmailDataProvider,
                    'model' => $model,
                ])
            ],
            [
                'label' => Yii::t('app', 'Reposts'),
                'content' => $this->render('_reposts', [
                    'repostsSearchModel' => $repostsSearchModel,
                    'repostsDataProvider' => $repostsDataProvider
                ])
            ],
            [
                'label' => Yii::t('app', 'Subscribes'),
                'content' => $this->render('_subscribes', [
                    'UserSettingsSearch' => $UserSettingsSearch,
                    'UserSettingsSearchDataProvider' => $UserSettingsSearchDataProvider,
                ])
            ],
            [
                'label' => Yii::t('app', 'User secret questions'),
                'content' => $this->render('_secret_questions', [
                    'secretQuestionsSearchModel' => $secretQuestionsSearchModel,
                    'secretQuestionsDataProvider' => $secretQuestionsDataProvider
                ])
            ],
            [
                'label' => Yii::t('app', 'Archive relations') . ' (' . $UserArchiveRelationsDataProvider->getCount() . ')',
                'content' => $this->render('_relater_archive_users', [
                    'model' => $UserArchiveRelations,
                    'searchModel' => $UserArchiveRelationsDataProvider,
                ])
            ],
            [
                'label' => Yii::t('app', 'Avatars'),
                'content' => $this->render('_avatars', [
                    'UserAvatarSearch' => $UserAvatarSearch,
                    'UserAvatarSearchDataProvider' => $UserAvatarSearchDataProvider,
                ]),
                'active' => Yii::$app->request->get('tab') ? true : false
            ],
            [
                'label' => Yii::t('app', 'Password'),
                'content' => $this->render('_password', [
                    'model' => '',
                ])
            ],
        ],
    ]);?>
</div>
