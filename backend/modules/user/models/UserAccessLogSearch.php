<?php

namespace backend\modules\user\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

class UserAccessLogSearch extends UserAccessLog
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['device', 'is_mobile_app', 'id'], 'integer'],
            [['browser', 'ip', 'country', 'created_at', 'user_agent'], 'string']
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
     * @param $model UserAccessLog
     * @return ActiveDataProvider
     */
    public function search($params, $model = null)
    {

        $query = UserAccessLog::find()->where(['user_id' => $model->id]);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query
        ]);

        $dataProvider->setSort([
            'attributes'=>[
                'ip'=>[
                    'asc'=>['ip' => SORT_ASC],
                    'desc'=>['ip' => SORT_DESC],
                ],
                'browser'=>[
                    'asc'=>['browser' => SORT_ASC],
                    'desc'=>['browser' => SORT_DESC],
                ],
                'created_at'=>[
                    'asc'=>['created_at' => SORT_ASC],
                    'desc'=>['created_at' => SORT_DESC],
                ],
                'country'=>[
                    'asc'=>['country' => SORT_ASC],
                    'desc'=>['country' => SORT_DESC],
                ],
                'ip'=>[
                    'asc'=>['ip' => SORT_ASC],
                    'desc'=>['ip' => SORT_DESC],
                ],
            ],
            'defaultOrder' => [
                'created_at' => SORT_DESC,
            ],
        ]);

        $this->load($params, '');

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere(['device' => $this->device])
            ->andFilterWhere(['is_mobile_app' => $this->is_mobile_app])
            ->andFilterWhere(['id' => $this->id])
            ->andFilterWhere(['like', 'browser', $this->browser])
            ->andFilterWhere(['like', 'country', $this->country])
            ->andFilterWhere(['like', 'created_at', $this->created_at])
            ->andFilterWhere(['like', 'user_agent', $this->user_agent])
            ->andFilterWhere(['like', 'ip', $this->ip]);


        return $dataProvider;
    }
}