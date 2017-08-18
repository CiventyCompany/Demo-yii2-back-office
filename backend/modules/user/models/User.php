<?php
namespace backend\modules\user\models;

use backend\modules\social\models\SocialShare;
use common\modules\shop\models\Order;
use common\modules\user\models\AuthAssignment;
use common\modules\user\models\UserAccessLog;
use common\modules\user\models\UserAvatar;
use common\modules\user\models\UserBalance;
use common\modules\user\models\UserBalanceHistory;
use common\modules\user\models\UserSettings;
use dektrium\user\models\Token;
use Yii;
use yii\helpers\ArrayHelper;

class User extends \common\modules\user\models\User
{
    public $deleteTables;
    public $avatar;
    public $role;

    const EVENT_EMAIL_CONFIRMED = 'email_confirmed_admin';
    const EVENT_PHONE_CONFIRMED = 'phone_confirmed_admin';

    /**
     * @return array
     */
    public function rules()
    {
        return [
            'usernameRequired' => ['username', 'required', 'on' => ['register', 'create', 'connect', 'update']],
            'usernameLength'   => ['username', 'string', 'min' => 3, 'max' => 255],
            [['email_confirm', 'phone_confirm'], 'integer'],
            [['email'], 'email'],
        ];
    }

    /**
     * @return array
     */
    public function attributeLabels()
    {
        return [
            'id'                => Yii::t('app', 'User ID'),
            'phone_confirm'     => Yii::t('app', 'Phone confirm'),
            'email_confirm'     => Yii::t('app', 'Email confirm'),
            'fullName'          => Yii::t('app', 'Full name'),
            'phones'            => Yii::t('app', 'Phone'),
            'passport'          => Yii::t('app', 'Passport'),
            'email'             => Yii::t('app', 'Email'),
            'last_activity_ip'  => Yii::t('app', 'Last activity ip'),
            'last_activity_at'  => Yii::t('app', 'Last activity at'),
            'created_at'        => Yii::t('app', 'Created at'),
            'hear'              => Yii::t('app', 'Hear'),
            'blocked_at'        => Yii::t('app', 'Blocked At'),
            'deleted_at'        => Yii::t('app', 'Deleted At'),
            'verified_status'   => Yii::t('app', 'Verified Status'),
            'role'              => Yii::t('app', 'Role'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProfile()
    {
        return $this->hasOne(Profile::className(), ['user_id' => 'id']);
    }

    /**
     * @param null $index
     * @return mixed
     */
    public function getHearMethod($index = null)
    {
        return [
            Yii::t( 'app', 'Tell a Friend'),
            Yii::t( 'app', 'I learned in social networks'),
            Yii::t( 'app', 'I saw ads on the site'),
            Yii::t( 'app', 'I looked on YouTube'),
        ][isset($index) ? $index : $this->hear];
    }

    /**
     * @param null $index
     * @return mixed
     */
    public static function getHearText($index)
    {
        if($index){
            return [
                Yii::t( 'app', 'Tell a Friend'),
                Yii::t( 'app', 'I learned in social networks'),
                Yii::t( 'app', 'I saw ads on the site'),
                Yii::t( 'app', 'I looked on YouTube'),
            ][$index];
        }

        return '-';
    }

    /**
     * @return array
     */
    protected function deleteTables()
    {
        return $this->deleteTables = [
            UserAccessLog::className() => 'user_id',
//            Notice::className() => 'user_id',
            Order::className() => 'user_id',
            Token::className() => 'user_id',
            Profile::className() => 'user_id',
            SocialShare::className() => 'user_id',
            UserBalance::className() => 'user_id',
            UserBalanceHistory::className() => 'user_id',
            UserInvitationEmail::className() => 'user_id',
            UserPhones::className() => 'user_id',
            UserRegisterLog::className() => 'user_id',
            \common\modules\user\models\UserSecretQuestion::className() => 'user_id',
            UserSettings::className() => 'user_id'

        ];
    }

    /**
     *
     */
    public function deleteInform()
    {
        try {
            $models = $this->deleteTables();

            foreach ($models as $model => $attr) {
                $records = $model::deleteAll([$attr => $this->id]);
            }

            User::delete(['user_id' => $this->id]);
        }catch(\Exception $e){
            var_dump($e);
        }
    }

    /**
     * @return string
     */
    public function getBlockedTime()
    {
        return $this->blocked_at ? '<span class="text-danger">' . date('d-m-Y', $this->blocked_at) . '</span>' : '-';
    }

    /**
     * @return string
     */
    public function getDeletedTime()
    {
        return $this->deleted_at ? '<span class="text-danger">' . date('d-m-Y', $this->deleted_at) . '</span>' : '-';
    }

    public function getFrozenTime()
    {
        return $this->frozen > 0 ? '<span class="text-danger">' . date('d-m-Y', $this->frozen) . '</span>' : '-';
    }

    /**
     * @return string
     */
    public function getIdentificationText()
    {
        switch ($this->verified_status){
            case self::IDENTIFIED_IN_PROCESS:
                return '<span class="label label-warning">' . Yii::t('app', 'In Process') . '</span>';
                break;
            case self::IDENTIFIED_YES:
                return '<span class="label label-success">' . Yii::t('app', 'Passed') . '</span>';
                break;
            case self::IDENTIFIED_OVERDUE:
                return '<span class="label label-danger">' . Yii::t('app', 'Overdue') . '</span>';
                break;
            default:
                return '<span class="label label-danger">' . Yii::t('app', 'Not passed') . '</span>';
                break;
        }
    }

    /**
     * @param $model User
     * @return int
     */
    public static function getModerationStatus($model)
    {
        if($model->frozen == 0 && $model->isBlocked == 0 && $model->deleted_at == 0 && $model->in_archive == 0){
            return self::M_STATUS_ACTIVE;
        }
        if($model->isBlocked == 1){
            return self::M_STATUS_BLOCKED;
        }
        if($model->frozen > 0 && $model->isBlocked ==0 && $model->deleted_at ==0){
            return self::M_STATUS_FROZEN;
        }
        if($model->deleted_at > 0){
            return self::M_STATUS_DELETED;
        }
        if($model->in_archive == 1){
            return self::M_STATUS_ARCHIVE;
        }

        return 666;
    }

    /**
     * @param $status
     * @return string
     */
    public static function getModerationText($status)
    {
        switch ($status){
            case self::M_STATUS_ACTIVE:
                return '<span class="label label-success">' . Yii::t('app', 'Active') . '</span>';
                break;
            case self::M_STATUS_BLOCKED:
                return '<span class="label label-danger">' . Yii::t('app', 'Blocked') . '</span>';
                break;
            case self::M_STATUS_FROZEN:
                return '<span class="label label-warning">' . Yii::t('app', 'Frozen') . '</span>';
                break;
            case self::M_STATUS_DELETED:
                return '<span class="label label-danger">' . Yii::t('app', 'Deleted') . '</span>';
                break;
            case self::M_STATUS_ARCHIVE:
                return '<span class="label label-danger">' . Yii::t('app', 'In archive') . '</span>';
                break;
            default:
                return '<span class="label label-danger">' . Yii::t('app', '-') . '</span>';
                break;
        }
    }


    /**
     * @param bool $insert
     * @return bool
     */
    public function beforeSave($insert)
    {
        if(!$this->isNewRecord){
            if($role = Yii::$app->request->post('User')['role']){
                $model = AuthAssignment::findOne(['user_id' => $this->id]);
                if($model){
                    $model->delete();
                }
                if($role !== 'user'){
                    $newModel = new AuthAssignment();
                    $newModel->item_name = $role;
                    $newModel->user_id = $this->id;
                    $newModel->created_at = time();
                    $newModel->save(false);
                }
            }
            if(isset(Yii::$app->request->post('User')['phone'])){
                $phone = Yii::$app->request->post('User')['phone'];
                $phoneData = self::prepare($phone);
                $model = UserPhones::findOne(['user_id' => $this->id]);
                if($model){
                    $model->prefix = $phoneData['prefix'];
                    $model->code   = $phoneData['code'];
                    $model->number = $phoneData['number'];
                    $model->update();
                }
            }
            if(isset(Yii::$app->request->post('User')['avatar'])){
                $avatar = Yii::$app->request->post('User')['avatar'];
                $curAvatar = UserAvatar::find()
                    ->where(['user_id' => $this->id])
                    ->andWhere(['status' => UserAvatar::STATUS_ACTIVE])
                    ->one();
                if(isset($curAvatar) && $curAvatar->avatar !== $avatar){
                    $curAvatar->status = UserAvatar::STATUS_NOT_ACTIVE;
                    $curAvatar->save();
                    $newAvatar = new UserAvatar();
                    $newAvatar->user_id = $this->id;
                    $newAvatar->avatar  = $avatar;
                    $newAvatar->old_avatar_id = $curAvatar->id;
                    $newAvatar->status = UserAvatar::STATUS_ACTIVE;
                    $newAvatar->save();
                }else{
                    $newAvatar = new UserAvatar();
                    $newAvatar->user_id = $this->id;
                    $newAvatar->avatar  = $avatar;
//                    $newAvatar->old_avatar_id = $curAvatar->id;
                    $newAvatar->status = UserAvatar::STATUS_ACTIVE;
                    $newAvatar->save();
                }
            }
        }

        return parent::beforeSave($insert);
    }

    /**
     * @param bool $insert
     * @param array $changedAttributes
     * @return bool
     */
    public function afterSave($insert, $changedAttributes)
    {
        if($role = Yii::$app->request->post('User')['role']){
            $model = AuthAssignment::findOne(['user_id' => $this->id]);
            if($model){
                $model->delete();
            }
            if($role !== 'user'){
                $newModel = new AuthAssignment();
                $newModel->item_name = $role;
                $newModel->user_id = $this->id;
                $newModel->created_at = time();
                $newModel->save(false);
            }

            if( isset($changedAttributes['email_confirm']) && $changedAttributes['email_confirm'] == 0 && $this->email_confirm ){
                $this->trigger( self::EVENT_EMAIL_CONFIRMED );
            }

            if( isset($changedAttributes['phone_confirm']) && $changedAttributes['phone_confirm'] == 0 && $this->phone_confirm ){
                $this->trigger( self::EVENT_PHONE_CONFIRMED );
            }
        }
        return parent::afterSave($insert, $changedAttributes);
    }

    /**
     * This function prepare phone Data for record in user_phones table
     * @param $phone
     * @return array
     */
    private static function prepare($phone )
    {
        //+7(906)969-6660
        $phone = str_replace(['+', ' '], ['',''], $phone);
        $codeBefore = mb_strrpos($phone, '(');
        $codeAfter = mb_strrpos($phone, ')');

        if($codeBefore === FALSE || $codeAfter === FALSE){
            throw new \RuntimeException( Yii::t('app', 'Bad phone format') );
        }

        $prefix = mb_substr($phone, 0, $codeBefore);
        $code = mb_substr($phone, $codeBefore + 1 , $codeAfter - $codeBefore - 1);
        $number = str_replace('-', '', mb_substr($phone, $codeAfter + 1 ));

        return [
            'prefix'  => $prefix,
            'code'   => $code,
            'number' => $number
        ];
    }

    public static function isAdmin($userId)
    {
        $model = AuthAssignment::findOne(['user_id' => $userId]);
        if(!$model){
            return false;
        }
        return true;
    }

    public static function getUserRole($userId)
    {
        $model = AuthAssignment::findOne(['user_id' => $userId]);
        if(!$model){
            return Yii::t('app','User');
        }
        return Yii::t('app',ucfirst($model->item_name));
    }

    public function getRole()
    {
        $model = AuthAssignment::findOne(['user_id' => $this->id]);
        if(!$model){
            return 'user';
        }
        return 'admin';
    }

    public static function autoComplete( $term )
    {
        $out = [];
        $users = self::find()
            ->alias('u')
            ->select(['u.id', 'CONCAT_WS(" ", u.id, " - ", p.firstname, p.lastname, p.midlename) AS fio'])
            ->leftJoin(Profile::tableName() . ' p', 'u.id = p.user_id')
            ->where(['like', 'CONCAT_WS(" ", u.id, " - ", p.firstname, p.lastname, p.midlename)', $term])
            ->limit(10)
            ->asArray()
            ->all();
        foreach ($users as $user){
            $out[] = [
                'id' => $user['id'],
                'value' => $user['fio'],
                'label' => $user['fio'],
            ];
        }
        return $out;
    }
}
