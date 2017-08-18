<?php
namespace backend\modules\user\models;



class ModalForm extends User
{
    public $cause, $status, $userId;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cause'], 'string','min' => 15, 'max' => 1000],
            [['type','user_id'], 'safe'],
            [['cause'], 'required']
        ];
    }

    public function attributeLabels()
    {

        return[
            'cause' => \Yii::t('app','Cause')
        ];
    }
}
