<?php

namespace backend\modules\user\models;

use common\modules\user\models\UserRegisterLogData;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\user\models\UserRegisterLog;


class UserRegisterLogSearch extends UserRegisterLog
{
    public $session_id, $user_id, $user, $username, $created_at, $regStatus;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id'], 'integer'],
            [['created_at'], 'string'],
            [['updated_at'], 'string'],
            [['session_id', 'username'], 'string'],
            [['regStatus'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {

        $query = UserRegisterLog::find();
           // ->where(['user_id' => 0]);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->setSort([
            'attributes'=>[
                'session_id'=>[
                    'asc'  => ['session_id' => SORT_ASC],
                    'desc' => ['session_id' => SORT_DESC],
                ],
                'user_id'=>[
                    'asc'  => ['user_id' => SORT_ASC],
                    'desc' => ['user_id' => SORT_DESC],
                ],
            ]
        ]);
        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        if(isset($this->regStatus) && $this->regStatus !== ''){
            if($this->regStatus == 0){
                $query->where(['user_id' => 0]);
            }else{
                $query->where(['>','user_id', 0]);
            }
        }

        if(isset($this->created_at) && !empty($this->created_at)) {
            $start = strtotime('-1 day', strtotime($this->created_at));
            $end = strtotime('+1 day', strtotime($this->created_at));
            $start = date('Y-m-d H:i:s', $start);
            $end = date('Y-m-d H:i:s', $end);
            $query->andFilterWhere(['between', 'created_at', $start, $end]);
        }
        if(isset($this->updated_at) && !empty($this->updated_at)) {
            $start = strtotime('-1 day', strtotime($this->updated_at));
            $end = strtotime('+1 day', strtotime($this->updated_at));
            $start = date('Y-m-d H:i:s', $start);
            $end = date('Y-m-d H:i:s', $end);
            $query->andFilterWhere(['between', 'updated_at', $start, $end]);
        }

        if($this->username){
            $query->leftJoin( UserRegisterLogData::tableName() . ' AS fn', 'fn.user_register_log_id = ' . self::tableName() . '.id AND fn.key = "firstname"' );
            $query->leftJoin( UserRegisterLogData::tableName() . ' AS mn', 'mn.user_register_log_id = ' . self::tableName() . '.id AND mn.key = "midlename"' );
            $query->leftJoin( UserRegisterLogData::tableName() . ' AS ln', 'ln.user_register_log_id = ' . self::tableName() . '.id AND ln.key = "lastname"' );
            $query->andWhere("CONCAT_WS(' ', fn.value, mn.value, ln.value) LIKE '%{$this->username}%'");
            $query->groupBy( self::tableName() . '.id' );
        }

        $query->andFilterWhere(['like', 'user_register_log.session_id', $this->session_id]);


        return $dataProvider;
    }

    public static function getProgressStatus($logId)
    {
        $totalFields = 10;
        $countFields = self::getProgressFields($logId);
        $processText = Yii::t('app', 'In process') . "({$countFields} из {$totalFields})";
        $onePercent = $totalFields / 100;
        $percent = $countFields / $onePercent;

        if($countFields >= $totalFields){
            $processText = Yii::t('app', 'Completed');
        }


        $t = "{$processText}<br>
              <div class=\"progress\" style='border: 1px solid black; text-align: center'>
                  <div class=\"progress-bar progress-bar-success\" role=\"progressbar\" aria-valuenow=\"{$percent}\"
                  aria-valuemin=\"0\" aria-valuemax=\"100\" style=\"width:{$percent}%;color: black; \">
                  </div>
              </div>";
        return $t;
    }

    public static function getProgressFields($logId)
    {
        $fields = [
            'firstname',
            'midlename',
            'lastname',
            'birthday',
            'passport',
            'passport_date',
            'snils',
            'email',
            'phone',
            'hear'
        ];

        $passedFields = UserRegisterLogData::find()
            ->where(['user_register_log_id' => $logId])
            ->andWhere(['in', 'key', $fields])
            ->count();


        return $passedFields;
    }
}
