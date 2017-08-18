<?php
namespace backend\modules\user\models;

use Yii;

class UserRecoveryLogData extends \common\modules\user\models\UserRecoveryLogData
{
    public static function getLabels()
    {
        return [
            'type' => Yii::t('app', 'Type'),
            'snils' => Yii::t('app', 'Snils'),
            'username' => Yii::t('app', 'Username'),
            'question_id' => Yii::t('app', 'Control question'),
            'question' => Yii::t('app', 'Answer'),
            'email_code' => Yii::t('app', 'Email Code'),
            'phone_code' => Yii::t('app', 'Phone Code'),
            'send_email' => Yii::t('app', 'Send Email'),
            'send_call' => Yii::t('app', 'Send Call'),
            'send_sms' => Yii::t('app', 'Send Sms'),
            'support_email' => Yii::t('app', 'Support Email'),
            'support_email_no_data' => Yii::t('app', 'Support Email No Data'),
            'support_email_question' => Yii::t('app', 'Support Email No Data'),
        ];
    }

    public function getLabel()
    {
        return key_exists( $this->key, $this->getLabels() ) ? $this->getLabels()[ $this->key ] : $this->key;
    }

    public function getValidLabel()
    {
        if( $this->valid ){
            return '<div class="label label-success">' . Yii::t('app', 'Valid Passed') . '</div>';
        } else {
            return '<div class="label label-danger">' . Yii::t('app', 'Valid Not Passed') . '</div>';
        }
    }

    public function getValue()
    {
        switch ($this->key){
            case 'question_id':
                $question = UserSecretQuestionList::findOne( $this->value );
                if($question){
                    return $question->title;
                }
                return $this->value;
                break;
            case 'send_email':
                return $this->userRecoveryLog->user->email;
                break;
            case 'send_call':
                return $this->userRecoveryLog->user->getPhone();
                break;
            case 'send_sms':
                return $this->userRecoveryLog->user->getPhone();
                break;
            default:
                return $this->value;
                break;
        }
    }

}