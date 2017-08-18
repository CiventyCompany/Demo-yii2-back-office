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

class RegisteredController extends AdminController
{
    public function actionIndex()
    {
        //Yii::$app->user->login( User::findOne(1) );
        Url::remember('', 'actions-redirect');
        $searchModel  = Yii::createObject(UserSearch::className());
        $dataProvider = $searchModel->search(Yii::$app->request->get());

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel'  => $searchModel,
        ]);
    }

    public function actionView($id)
    {
        $model = User::findOne($id);

        if($model->in_archive){
            return $this->redirect(['/user/archive/view', 'id' => $id]);
        }

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

            $UserArchiveRelations  = new UserSearch();
            $UserArchiveRelationsDataProvider = $UserArchiveRelations
                ->search(Yii::$app->request->get('UserSearch'), true, $model);

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
                'UserArchiveRelations'                  => $UserArchiveRelations,
                'UserArchiveRelationsDataProvider'      => $UserArchiveRelationsDataProvider,
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

    public function actionBlock($id)
    {
        $model = User::find()->where(['id' => $id])->one();

        if($model){
            $model->blocked_at = time();
            if(!$model->save(false)){
                Yii::$app->session->setFlash('error', Yii::t('app', 'Record not saved'));
            }
        }else{
            Yii::$app->session->setFlash('error', Yii::t('app', 'Record not found'));
        }

        return $this->redirect('index');
    }

    public function actionDelete($id)
    {
        $model = User::find()->where(['id' => $id])->one();

        if($model){
            $model->delete();
        }

        return $this->redirect('index');
    }

    public function actionEndAllSessions( $id )
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        return [
            'status' => 'ok',
            'updated' => User::updateAll(['available_ip' => '[]'], ['id' => $id]),
        ];
    }

    /**
     * Updates an existing Questions model.
     * If update is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException
     */
    public function actionUpdate($id)
    {
        $user = User::findOne($id);
        if (!$user) {
            throw new NotFoundHttpException("The user was not found.");
        }

        $profile = Profile::findOne(['user_id' => $id]);
        if (!$profile) {
            throw new NotFoundHttpException("The user has no profile.");
        }


        if ($user->load(Yii::$app->request->post()) && $profile->load(Yii::$app->request->post())) {
            $isValid = $user->validate();
            $isValid = $profile->validate() && $isValid;
            if ($isValid) {
                $user->save(false);
                $profile->save(false);
                return $this->redirect(['view', 'id' => $id]);
            }
        }

        return $this->render('update', [
            'user'    => $user,
            'profile' => $profile,
        ]);
    }
}
