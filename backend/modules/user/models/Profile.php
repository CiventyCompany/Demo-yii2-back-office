<?php
namespace backend\modules\user\models;

use Yii;

class Profile extends \common\modules\user\models\Profile
{
    public function rules()
    {
        $rules = parent::rules();

        $rules['dates']   = [['birthday', 'passport_date'], 'date','format' => 'yyyy-MM-dd'];
        $rules['gender']   = ['gender', 'string', 'length' => 1];

        return $rules;
    }
    public function attributeLabels()
    {
        return [
            'fullName'          => Yii::t('app', 'Full name'),
            'lastname'          => Yii::t('app', 'Lastname'),
            'midlename'         => Yii::t('app', 'Midlename'),
            'firstname'         => Yii::t('app', 'Firstname'),
            'birthday'          => Yii::t('app', 'Birthday'),
            'passport_series'   => Yii::t('app', 'Passport series'),
            'passport_number'   => Yii::t('app', 'Passport number'),
            'passport_date'     => Yii::t('app', 'Passport date'),
            'gender'            => Yii::t('app', 'Gender'),
            'avatar'            => Yii::t('app', 'Profile Avatar'),
            'snils'             => Yii::t('app','SNILS')
        ];
    }

    public function getFullName()
    {
        return $this->lastname . ' ' . $this->firstname . ' ' . $this->midlename;
    }

    public static function getSnils($userId)
    {
        $model = Profile::findOne(['user_id' => $userId]);
        if(!$model){
            return '-';
        }
        return $model->snils;
    }

    public static function getUserFullName($userId, $full = true)
    {
        $profile = Profile::findOne(['user_id' => $userId]);
        if(!$profile){
            return '-';
        }
        if($full){
            return $profile->lastname . ' ' . $profile->firstname . ' ' . $profile->midlename;
        }else{
            return $profile->lastname . ' ' . $profile->firstname;
        }

    }

    public static function getUserAvatar($userId)
    {
        $profile = Profile::findOne(['user_id' => $userId]);
        if(!$profile){
            return '-';
        }
        if(is_object($profile->avatar)){
            return $profile->avatar->avatar;
        }

        return '-';
    }
}
