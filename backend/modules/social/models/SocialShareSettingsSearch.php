<?php

namespace backend\modules\social\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

class SocialShareSettingsSearch extends SocialShareSettings
{
    public $social_id, $social_name, $status;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['social_name'], 'string'],
            [['social_id', 'status'], 'integer']
        ];
    }


    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     * @param $user \backend\modules\user\models\User
     *
     * @return ActiveDataProvider
     */
    public function search($params, $user = null)
    {

        $query = SocialShareSettings::find()->joinWith('templates');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->setSort([
            'attributes'=>[
                'social_id'=>[
                    'asc'=>['social_id' => SORT_ASC],
                    'desc'=>['social_id' => SORT_DESC],
                ],
                'social_name' => [
                    'asc'=>['social_name'=>SORT_ASC],
                    'desc'=>['social_name'=>SORT_DESC],
                ],
                'status' => [
                    'asc'=>['social_share_templates.is_active' => SORT_ASC],
                    'desc'=>['social_share_templates.is_active' => SORT_DESC],
                ],
            ]
        ]);

        $this->load($params, '');

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere(['like', 'social_name', $this->social_name])
            ->andFilterWhere(['social_id' => $this->social_id])
            ->andFilterWhere(['status' => $this->status]);


        return $dataProvider;
    }
}