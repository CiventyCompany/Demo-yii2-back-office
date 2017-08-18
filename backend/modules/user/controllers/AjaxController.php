<?php
namespace backend\modules\user\controllers;

use backend\modules\user\models\User;
use common\helpers\traits\AjaxControllerTrait;
use common\modules\user\models\UserAdminCauses;
use common\modules\user\models\UserAdminTokens;
use common\modules\user\models\UserBalance;
use backend\modules\user\models\UserBalanceHistory;
use yii\base\Controller;
use yii\base\ErrorException;
use yii\base\InvalidParamException;

/**
 * Class AjaxController
 * @package backend\modules\user\controllers
 */
class AjaxController extends Controller
{
    use AjaxControllerTrait;

    /**
     * Freeze and unfreeze user (freeze wit message from modal)
     * @return array
     */
    public function actionFrozenUser()
    {
        if ($data = \Yii::$app->request->post('data')) {
            parse_str($data, $parsedData);
            $userId = $parsedData['ModalForm']['userId'];
            $status = $parsedData['ModalForm']['status'];
            $cause = $parsedData['ModalForm']['cause'];
        } else {
            $userId = \Yii::$app->request->post('userId');
            $status = \Yii::$app->request->post('status');
        }
        $model = User::findOne(['id' => $userId]);

        $res = [
            'res' => 'fail',
            'message' => \Yii::t('app', 'Error')
        ];

        if ($status == 'true') { //unfreeze
            $model->frozen = 0;
            if ($model->save()) {
                UserAdminCauses::removeCause($userId, UserAdminCauses::TYPE_FREEZE);
                $res = [
                    'res' => 'ok',
                    'message' => \Yii::t('app', 'User successfully unfrozen')
                ];
            }
        } elseif ($status == 'false') { //freeze
            $model->frozen = time();
            if ($model->save()) {
                if (isset($cause)) {
                    UserAdminCauses::addNewCause($userId, $cause, UserAdminCauses::TYPE_FREEZE);
                }
                $res = [
                    'res' => 'ok',
                    'message' => \Yii::t('app', 'User frozen')
                ];
            }
        }

        return $res;
    }

    /**
     * Set and remove deleted status from user (set with message from modal)
     * @return array
     */
    public function actionDeleteStatusUser()
    {
        if ($data = \Yii::$app->request->post('data')) {
            parse_str($data, $parsedData);
            $userId = $parsedData['ModalForm']['userId'];
            $status = $parsedData['ModalForm']['status'];
            $cause = $parsedData['ModalForm']['cause'];
        } else {
            $userId = \Yii::$app->request->post('userId');
            $status = \Yii::$app->request->post('status');
        }
        $model = User::findOne(['id' => $userId]);

        $res = [
            'res' => 'fail',
            'message' => \Yii::t('app', 'Error')
        ];

        if ($status == 'true') { //remove Del status
            $model->deleted_at = 0;
            if ($model->update(false)) {
                UserAdminCauses::removeCause($userId, UserAdminCauses::TYPE_DELETE_STATUS);
                $res = [
                    'res' => 'ok',
                    'message' => \Yii::t('app', 'User delete status removed')
                ];
            }
        } elseif ($status == 'false') { //set Del status
            $model->deleted_at = time();
            if ($model->save()) {
                if (isset($cause)) {
                    UserAdminCauses::addNewCause($userId, $cause, UserAdminCauses::TYPE_DELETE_STATUS);
                }
                $res = [
                    'res' => 'ok',
                    'message' => \Yii::t('app', 'User deleted status set')
                ];
            }
        }

        return $res;
    }

    /**
     * Block or unblock user (block with message from modal)
     * @return array
     */
    public function actionBlockedUser()
    {
        if ($data = \Yii::$app->request->post('data')) {
            parse_str($data, $parsedData);
            $userId = $parsedData['ModalForm']['userId'];
            $status = $parsedData['ModalForm']['status'];
            $cause  = $parsedData['ModalForm']['cause'];
        } else {
            $userId = \Yii::$app->request->post('userId');
            $status = \Yii::$app->request->post('status');
        }

        $model = User::findOne(['id' => $userId]);

        $res = [
            'res' => 'fail',
            'message' => \Yii::t('app', 'Error')
        ];

        if ($status == 'true') { //unblock
            $model->blocked_at = null;
            if ($model->save()) {
                UserAdminCauses::removeCause($userId, UserAdminCauses::TYPE_BLOCK);
                $res = [
                    'res' => 'ok',
                    'message' => \Yii::t('app', 'User successfully unblocked')
                ];
            }
        } elseif ($status == 'false') { //block
            $model->blocked_at = time();
            if ($model->save()) {
                if (isset($cause)) {
                    UserAdminCauses::addNewCause($userId, $cause, UserAdminCauses::TYPE_BLOCK);
                }
                $res = [
                    'res' => 'ok',
                    'message' => \Yii::t('app', 'User blocked')
                ];
            }
        }

        return $res;
    }

    /**
     * Log in admin by selected user and redirect to users cabinet
     * @return array|InvalidParamException
     */
    public function actionLogOnFrontend()
    {
        if (!$userId = \Yii::$app->request->post('userId')) {
            throw new InvalidParamException();
        }

        $tokenModel = UserAdminTokens::findOne(['user_id' => $userId]);

        if (!$tokenModel) {
            $tokenModel = new UserAdminTokens();
            $tokenModel->user_id = $userId;
            $tokenModel->generateToken();
        }

        $token = $tokenModel->token;
        $url = $this->getPreparedFrontUrl($token);

        return [
            'res' => 'ok',
            'url' => $url
        ];
    }

    /**
     * Change user bonuses
     * @return array
     * @throws ErrorException
     */
    public function actionRefillBalance()
    {
        $data = \Yii::$app->request->post('data');
        if(!$data){
            throw new ErrorException();
        }

        parse_str($data, $parsedData);
        $userId = ( isset($parsedData['UserBalance']) && isset($parsedData['UserBalance']['user_id']) )
            ? $parsedData['UserBalance']['user_id'] : null;
        if(!$userId) {
            throw new InvalidParamException();
        }

        $model  = UserBalance::findOne(['user_id' => $userId]);

        if ($model->load($parsedData)) {
            $this->updateUserBalanceHistory($model);

            if ($model->update()) {
                return [
                    'res' => 'ok',
                    'message' => \Yii::t('app', 'Balance refill successfully')
                ];
            }
        }

        return [
            'res' => 'fail',
            'message' => $model->getErrors()
        ];
    }

    public function actionChangePass()
    {
        $newPass = \Yii::$app->request->post('pass');
        $userId  = \Yii::$app->request->post('user_id');
        $updatePassword = \Yii::$app->security->generatePasswordHash($newPass);

        $userModel = User::findOne(['id' => $userId]);
        $userModel->password_hash = $updatePassword;

        if($userModel->save()){
            return [
                'res' => 'ok',
                'message' => \Yii::t('app','Password changed successfully')
            ];
        }
    }

    public function actionAutoComplete()
    {
        return User::autoComplete( \Yii::$app->request->get('term') );
    }

    /**
     * Prepare url to login admin as user
     * @param $token
     * @return string
     */
    public function getPreparedFrontUrl($token)
    {
        return $this->getFrontUrl() . '/user/admin-security/log-from-back?token=' . $token;
    }

    /**
     * Get frontend url
     * @return string
     */
    private function getFrontUrl()
    {
        return \Yii::$app->params['frontURL'];
    }

    /**
     * Add new log to user_balance_history table
     * @param $balanceModel UserBalance
     */
    private function updateUserBalanceHistory($balanceModel)
    {
        $oldLocal       = $balanceModel->getOldAttribute('local');
        $oldExternal    = $balanceModel->getOldAttribute('external');
        $newLocal       = $balanceModel->local;
        $newExternal    = $balanceModel->external;
        $changeLocal    = 0;
        $changeExternal = 0;

        if($newLocal > $oldLocal){
            $changeLocal = $newLocal - $oldLocal;
        }elseif($newLocal < $oldLocal){
            $changeLocal = '-'. ($oldLocal - $newLocal);
        }

        if($newExternal > $oldExternal){
            $changeExternal = $newExternal - $oldExternal;
        }elseif($newExternal < $oldExternal){
            $changeExternal = '-'.($oldExternal - $newExternal);
        }

        $balanceHistory = new UserBalanceHistory();
        $balanceHistory->user_id = $balanceModel->user_id;
        $balanceHistory->ip = \Yii::$app->request->userIP;
        $balanceHistory->created_at = date('Y-m-d H:i:s');
        $balanceHistory->change_balance_local = $changeLocal;
        $balanceHistory->change_balance_external = $changeExternal;
        $balanceHistory->type = $balanceHistory::TYPE_ADMIN;
        $balanceHistory->entity_id = 0;

        $balanceHistory->save();
    }
}