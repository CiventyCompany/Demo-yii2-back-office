<?php
namespace backend\modules\user\models\search;

use backend\modules\user\models\Profile;
use backend\modules\user\models\User;
use backend\modules\user\models\UserRecoveryLog;
use backend\modules\user\models\UserRecoveryLogData;
use Yii;
use yii\data\ActiveDataProvider;


class UserRecoveryLogSearch extends UserRecoveryLog
{
    public $user, $type, $username, $snils;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['created_at', 'updated_at', 'status', 'user', 'type', 'username', 'snils'], 'safe'],
            [['session_id'], 'string', 'max' => 40],
            [['ip'], 'string', 'max' => 20],
        ];
    }

    /**
     * @param $params
     * @return ActiveDataProvider
     */
   public function search( $params, $status = [] )
   {
       $query = self::find()
           ->alias('l')
           ->leftJoin( UserRecoveryLogData::tableName() . ' tp', 'tp.user_recovery_log_id = l.id AND tp.key = "type"'  )
           ->leftJoin( UserRecoveryLogData::tableName() . ' sn', 'sn.user_recovery_log_id = l.id AND sn.key = "snils"'  )
           ->leftJoin( UserRecoveryLogData::tableName() . ' un', 'un.user_recovery_log_id = l.id AND un.key = "username"'  )
           ->leftJoin( Profile::tableName() . ' p', 'p.snils = sn.value' )
           ->leftJoin( User::tableName() . ' u', 'u.username = un.value' )
           ->groupBy('l.id');

       if( count($status) ){
            $query->andWhere(['in', 'l.status', $status]);
       }

       $dataProvider = new ActiveDataProvider([
           'query' => $query,
           'sort' => [
                'defaultOrder' => [
                    'created_at' => SORT_DESC
                ]
           ],
       ]);

       $this->load($params);

       if (!$this->validate()) {
           // uncomment the following line if you do not want to return any records when validation fails
           // $query->where('0=1');
           return $dataProvider;
       }

       $query
           ->andFilterWhere(['like', 'session_id', $this->session_id])
           ->andFilterWhere(['like', 'ip', $this->ip])
           ->andFilterWhere(['status' => $this->status]);

       if($this->type){
            $query->andWhere(['like', 'tp.value', $this->type]);
       }

       if($this->username){
           $query->andWhere(['like', 'un.value', $this->username]);
       }

       if($this->snils){
           $query->andWhere(['like', 'sn.value', $this->snils]);
       }

       if($this->user){
           $query->andWhere(['like', 'CONCAT_WS(" ", u.id, p.firstname, p.midlename, p.lastname)', $this->user]);
       }

       if(isset($this->created_at) && !empty($this->created_at)) {
           $start = strtotime('-1 day', strtotime($this->created_at));
           $end = strtotime('+1 day', strtotime($this->created_at));
           $query->andFilterWhere(['between', 'created_at', $start, $end]);
       }

       if(isset($this->updated_at) && !empty($this->updated_at)) {
           $start = strtotime('-1 day', strtotime($this->updated_at));
           $end = strtotime('+1 day', strtotime($this->updated_at));
           $query->andFilterWhere(['between', 'updated_at', $start, $end]);
       }

       return $dataProvider;
   }

}
