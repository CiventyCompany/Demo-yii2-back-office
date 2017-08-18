<?php
namespace backend\modules\user\models;

use Yii;

class UserRecoveryLog extends \common\modules\user\models\UserRecoveryLog
{
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserRecoveryLogData()
    {
        return $this->hasMany(UserRecoveryLogData::className(), ['user_recovery_log_id' => 'id']);
    }

    /**
     * @return array
     */
    public function getStatusText( $action = '' )
    {
        if($action == 'completed'){
            return [
                self::STATUS_MODERATION_COMPLETED => Yii::t('app', 'Moderation completed'),
                self::STATUS_COMPLETED => Yii::t('app', 'Agreed'),
            ];
        } else if($action == 'moderation') {
            return [
                self::STATUS_MODERATION => Yii::t('app', 'Moderation'),
                self::STATUS_MODERATION_IN_PROCESS => Yii::t('app', 'In processing support'),
                self::STATUS_MODERATION_FAIL => Yii::t('app', 'Moderation fail'),
                self::STATUS_MODERATION_COMPLETED => Yii::t('app', 'Moderation completed')
            ];
        } else {
            return [
                self::STATUS_NEW => Yii::t('app', 'In process'),
                self::STATUS_NOT_FOUND => Yii::t('app', 'Not Found'),
                self::STATUS_BLOCKED => Yii::t('app', 'Blocked'),
                self::STATUS_MODERATION => Yii::t('app', 'Moderation'),
                self::STATUS_MODERATION_IN_PROCESS => Yii::t('app', 'In processing support'),
                self::STATUS_MODERATION_FAIL => Yii::t('app', 'Moderation fail'),
                self::STATUS_MODERATION_COMPLETED => Yii::t('app', 'Moderation completed'),
                self::STATUS_COMPLETED => Yii::t('app', 'Agreed'),
            ];
        }

    }

    /**
     * @return string
     */
    public function getStatusLabel()
    {
        if($this->status == self::STATUS_COMPLETED || $this->status == self::STATUS_MODERATION_COMPLETED){
            return '<div class="label label-success">' . $this->getStatusText()[ $this->status ] . '</div>';
        } elseif ($this->status == self::STATUS_MODERATION_FAIL || $this->status == self::STATUS_NOT_FOUND || $this->status == self::STATUS_BLOCKED){
            return '<div class="label label-danger">' . $this->getStatusText()[ $this->status ] . '</div>';
        } else {
            return '<div class="label label-warning">' . $this->getStatusText()[ $this->status ] . '</div>';
        }
    }

    /**
     * @return array|null|\yii\db\ActiveRecord
     */
    public function getUser()
    {
        if(isset($this->data['snils']) && isset($this->data['username'])){
            return User::find()
                ->alias('u')
                ->leftJoin( Profile::tableName() . ' p', 'u.id = p.user_id' )
                ->where(['u.username' => $this->data['username'], 'p.snils' => $this->data['snils']])
                ->one();
        }
    }

    /**
     * @return \common\modules\user\models\UserRecoveryLogData[]
     */
    public function getSortFields()
    {
        $logData = $this->userRecoveryLogData;
        usort( $logData, [$this, 'cmp'] );
        return $logData;
    }

    public function getDataLabel( $key )
    {
        return key_exists( $key, $this->getDataLabels() ) ? $this->getDataLabels()[$key] : $key;
    }

    public function getDataLabels()
    {
        return [
            'PASSWORD' => 'Восстановление пароля',
            'RECOVERY' => 'Восстановление аккаунта',
            'SNILS' => 'СНИЛС',
            'CHOOSE_ACTION' => 'Какая у Вас проблема?',
            'SNILS' => 'Ваш СНИЛС, который вы использовали при регистрации',
            'PASSPORT' => 'Три последние цифры Вашего паспорта',
            'USER_BLOCKED' => 'Ваш аккаунт заблокирован',
            'USER_NOT_FOUNDED' => 'Похоже, что пользователя с такими данными у нас никогда не было',
            'IS_YOU' => 'Это Вы?',
            'MAYBE_PASSWORD' => 'НЕ нашли Вас среди удаленных аккаунтов, Может Вы забыли пароль к аккаунту?',
            'MAYBE_RECOVERY' => 'Мы нашли Вас среди удаленных аккаунтов, Может Вы хотели восстановить аккаунт?',
            'COME_BACK_SOON' => 'Тогда хорошего Вам дня:) Возвращайтесь когда будете готовы',
            'INCORECT_INPUT' => 'Может Вы ошиблись при вводе данных?',
            'USER_NOT_REGISTERED' => 'Мы не смогли найти Вас, т.к. Вы не регистировались на Скорим. Хотите пройти регистрацию?',
            'USER_NOT_EXIST' => 'Мы не смогли найти Вас по указанным данным. Хотите пройти регистрацию?',
            'CONTROL_QUESTION' => 'Чтобы нам удостовериться, что это действительно Вы, ответьте, плз, на контрольный вопрос',
            'USER_HAVE_PHONE_AND_MAIL' => 'Супер! Мы помним Ваши следующие телефон и почту. Что Вам удобнее?',
            'USER_HAVE_PHONE' => 'Супер! Мы помним Ваш следующий телефон.',
            'USER_HAVE_MAIL' => 'Супер! Мы помним Вашу следующую почту.',
            'SUPPORT_EMAIL_REQUIRE' => 'Тогда процесс восстановления займет немного дольше:) По какому Имейл мы можем с Вами связаться?',
            'SUPPORT_NO_DATA_EMAIL_REQUIRE' => 'У нас нет данных о вашем телефоне и почте. Поэтому процесс восстановления займет немного дольше:) По какому Имейл мы можем с Вами связаться?',
            'SUPPORT_QUESTION_FAIL_EMAIL_REQUIRE' => 'Вы не ответили на контрольный вопрос :( Поэтому процесс восстановления займет немного дольше:) По какому Имейл мы можем с Вами связаться?',
            'SUPPORT_WILL_CONTACT_YOU' => 'Служба поддержки свяжется с Вми по указанному адресу в ближайшее время',
            'CHOOSE_PHONE_CONFIRM_METHOD' => 'Выберите способ подтверждения',
            'IS_CALL_RECIEVED' => 'Вам поступил звонок?',
            'IS_SMS_RECIEVED' => 'Вам пришла СМС?',
            'IS_MAIL_RECIEVED' => 'Вам пришло Письмо?',
            'PHONE_CODE' => 'Какой код пришел Вам на телефон?',
            'EMAIL_CODE' => 'Какой код был в письме?',
            'WELLCOME_BACK' => 'Добро пожаловать назад на Скори :)',
        ];
    }

    /**
     * @param $a
     * @param $b
     * @return int
     */
    private function cmp($a, $b)
    {
        $keys = array_keys( UserRecoveryLogData::getLabels() );
        $aIndex = array_search( $a->key, $keys );
        $bIndex = array_search( $b->key, $keys );

        if ($aIndex == $bIndex) {
            return 0;
        }
        return ($aIndex < $bIndex) ? -1 : 1;
    }
}