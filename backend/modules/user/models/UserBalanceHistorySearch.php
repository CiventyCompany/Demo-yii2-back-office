<?php

namespace backend\modules\user\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use Yii;

class UserBalanceHistorySearch extends UserBalanceHistory
{
    public $ip, $fullName, $changeBalance, $balanceType, $created_at;

    public function attributeLabels()
    {
        $labels = [
            'fullName' => Yii::t('app', 'Full name'),
            'title' => Yii::t('app', 'Title balance'),
        ];
        return array_merge(parent::attributeLabels(), $labels);
    }

    public function rules()
    {
        return [
            [['ip', 'fullName', 'changeBalance', 'created_at', 'change_balance_external'], 'string'],
            [['balanceType'], 'integer']
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
     * @param $model object
     * @return ActiveDataProvider
     */
    public function search($params, $model = null)
    {

        if(isset($model)){
            $query = UserBalanceHistory::find()->where(['user_balance_history.user_id' => $model->id])
                ->joinWith('profile');
        }else {
            $query = UserBalanceHistory::find()
                ->joinWith('profile');
        }

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->setSort([
            'attributes'=>[
                'ip'=>[
                    'asc'=>['ip' => SORT_ASC],
                    'desc'=>['ip' => SORT_DESC],
                ],
                'changeBalance'=>[
                    'asc'=>['change_balance_local' => SORT_ASC],
                    'desc'=>['change_balance_local' => SORT_DESC],
                ],
                'change_balance_external'=>[
                    'asc'=>['change_balance_external' => SORT_ASC],
                    'desc'=>['change_balance_external' => SORT_DESC],
                ],
                'balanceType'=>[
                    'asc'=>['type' => SORT_ASC],
                    'desc'=>['type' => SORT_DESC],
                ],
                'created_at'=>[
                    'asc'=>['created_at' => SORT_ASC],
                    'desc'=>['created_at' => SORT_DESC],
                ],
                'fullName'=>[
                    'asc'=>['profile.midlename'=>SORT_ASC, 'profile.lastname'=>SORT_ASC, 'profile.firstname'=>SORT_ASC],
                    'desc'=>['profile.midlename'=>SORT_DESC, 'profile.lastname'=>SORT_DESC, 'profile.firstname'=>SORT_DESC],
                ],
//                'title'=>[
//                    'asc'=>['change_balance' => SORT_ASC],
//                    'desc'=>['change_balance' => SORT_DESC],
//                ],
            ],
            'defaultOrder'=> ['created_at' => SORT_DESC]
        ]);

        $this->load($params, '');

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }


        $query->andFilterWhere(['like', 'user_balance_history.ip', $this->ip])
            ->andFilterWhere(['>', 'user_balance_history.change_balance_local', $this->changeBalance])
            ->andFilterWhere(['>', 'user_balance_history.change_balance_external', $this->change_balance_external])
            ->andFilterWhere(['like', 'user_balance_history.created_at', $this->created_at])
            ->andFilterWhere(['user_balance_history.type' => $this->balanceType])
            ->andFilterWhere(['like', 'profile.midlename', $this->fullName])
            ->orFilterWhere(['like', 'profile.firstname', $this->fullName])
            ->orFilterWhere(['like', 'profile.lastname', $this->fullName]);



        return $dataProvider;
    }
}
