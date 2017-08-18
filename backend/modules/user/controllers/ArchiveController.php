<?php
namespace backend\modules\user\controllers;

use backend\modules\credit_rating\models\search\CreditRatingHistorySearch;
use backend\modules\social\models\SocialShareSearch;
use backend\modules\user\models\ModalForm;
use backend\modules\user\models\Profile;
use backend\modules\user\models\User;
use backend\modules\user\models\UserAccessLogSearch;
use backend\modules\user\models\UserAvatarSearch;
use backend\modules\user\models\UserBalanceHistorySearch;
use backend\modules\user\models\UserInvitationEmailSearch;
use backend\modules\user\models\UserSecretQuestionSearch;
use backend\modules\user\models\UserSettingsSearch;
use common\modules\user\models\UserBalance;
use Yii;
use backend\modules\user\models\UserSearch;
use yii\helpers\Url;
use backend\modules\user\models\UserBalanceSearch;
use yii\web\NotFoundHttpException;
use yii\web\Response;

class ArchiveController extends AdminController
{
    public function actionIndex()
    {
        Url::remember('', 'actions-redirect');
        $searchModel  = Yii::createObject(UserSearch::className());
        $dataProvider = $searchModel->search(Yii::$app->request->get(), true);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel'  => $searchModel,
        ]);
    }

    public function actionView($id)
    {
        $model = User::findOne($id);
        $repostsSearchModel   = null;
        $repostsDataProvider  = null;
        $activitySearchModel  = null;
        $activityDataProvider = null;
        $secretQuestionsModel = null;

        if(isset($model)){
            $repostsSearchModel  = new SocialShareSearch();
            $repostsDataProvider = $repostsSearchModel
                ->search(Yii::$app->request->get('SocialShareSearch'), $model);

            $activitySearchModel = new UserBalanceHistorySearch();
            $activityDataProvider = $activitySearchModel
                ->search(Yii::$app->request->get('UserAccessLogSearch'), $model);

            $balanceSearchModel = new UserBalanceSearch();
            $balanceDataProvider = $balanceSearchModel
                ->search(Yii::$app->request->get('UserBalanceSearch'), $model);

            $secretQuestionsSearchModel = new UserSecretQuestionSearch();
            $secretQuestionsDataProvider = $secretQuestionsSearchModel
                ->search(Yii::$app->request->get('UserSecretQuestionSearch'), $model);

            $UserAccessLogSearch = new UserAccessLogSearch();
            $UserAccessLogSearchDataProvider = $UserAccessLogSearch
                ->search(Yii::$app->request->get('UserAccessLogSearch'), $model);

            $UserInvitationEmailSearchModel  = new UserInvitationEmailSearch();
            $UserInvitationEmailDataProvider = $UserInvitationEmailSearchModel
                ->search(Yii::$app->request->get('UserInvitationEmailSearch'), $model->id);

            $UserSettingsSearch = new UserSettingsSearch();
            $UserSettingsSearchDataProvider = $UserSettingsSearch
                ->search(Yii::$app->request->get('UserSearch'), $model);

            $creditRating = $model->creditRating;

            $CreditRatingHistorySearch = new CreditRatingHistorySearch();
            $CreditRatingHistorySearchDataProvider = $CreditRatingHistorySearch
                ->search(Yii::$app->request->get('CreditRatingHistorySearch'), $creditRating);

            $UserAvatarSearch = new UserAvatarSearch();
            $UserAvatarSearchDataProvider = $UserAvatarSearch
                ->search(Yii::$app->request->get('UserAvatarSearch'), $model->id);

            $modalForm = new ModalForm();
            $modalBalanceForm = UserBalance::findOne(['user_id' => $model->id]);

            $statuses = [];
            $statuses['frozen']     = $model->frozen > 0 ? true : false;
            $statuses['blocked']    = is_null($model->blocked_at) ? false : true;
            $statuses['delArchive'] = false;
            $statuses['delStatus']  = $model->deleted_at == 0 ? false : true;

            return $this->render('view', [
                'model'                                 => $model,
                'modalForm'                             => $modalForm,
                'modalBalanceForm'                      => $modalBalanceForm,
                'statuses'                              => $statuses,
                'repostsSearchModel'                    => $repostsSearchModel,
                'repostsDataProvider'                   => $repostsDataProvider,
                'activitySearchModel'                   => $activitySearchModel,
                'activityDataProvider'                  => $activityDataProvider,
                'balanceSearchModel'                    => $balanceSearchModel,
                'balanceDataProvider'                   => $balanceDataProvider,
                'secretQuestionsSearchModel'            => $secretQuestionsSearchModel,
                'secretQuestionsDataProvider'           => $secretQuestionsDataProvider,
                'UserAccessLogSearch'                   => $UserAccessLogSearch,
                'UserAccessLogSearchDataProvider'       => $UserAccessLogSearchDataProvider,
                'UserInvitationEmailDataProvider'       => $UserInvitationEmailDataProvider,
                'UserInvitationEmailSearchModel'        => $UserInvitationEmailSearchModel,
                'UserSettingsSearch'                    => $UserSettingsSearch,
                'UserSettingsSearchDataProvider'        => $UserSettingsSearchDataProvider,
                'creditRating'                          => $creditRating,
                'CreditRatingHistorySearch'             => $CreditRatingHistorySearch,
                'CreditRatingHistorySearchDataProvider' => $CreditRatingHistorySearchDataProvider,
                'UserAvatarSearch'                      => $UserAvatarSearch,
                'UserAvatarSearchDataProvider'          => $UserAvatarSearchDataProvider,
            ]);
        }else{
            return $this->redirect('index');
        }
    }
}
