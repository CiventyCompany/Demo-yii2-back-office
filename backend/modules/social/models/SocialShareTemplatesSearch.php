<?php

namespace backend\modules\social\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

class SocialShareTemplatesSearch extends SocialShareTemplates
{
    public $social_id, $social_name, $is_active, $id, $url, $message;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['social_name', 'url', 'message'], 'string'],
            [['social_id', 'id', 'is_active'], 'integer']
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
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {

        $query = SocialShareTemplates::find()->joinWith('settings');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->setSort([
            'attributes'=>[
                'id'=>[
                    'asc'=>['id' => SORT_ASC],
                    'desc'=>['id' => SORT_DESC],
                ],
                'social_id'=>[
                    'asc'=>['social_id' => SORT_ASC],
                    'desc'=>['social_id' => SORT_DESC],
                ],
                'social_name' => [
                    'asc'=>['social_share_settings.social_name'=>SORT_ASC],
                    'desc'=>['social_share_settings.social_name'=>SORT_DESC],
                ],
                'is_active' => [
                    'asc'=>['is_active' => SORT_ASC],
                    'desc'=>['is_active' => SORT_DESC],
                ],
                'message' => [
                    'asc'=>['message' => SORT_ASC],
                    'desc'=>['message' => SORT_DESC],
                ],
                'url' => [
                    'asc'=>['url' => SORT_ASC],
                    'desc'=>['url' => SORT_DESC],
                ],
            ]
        ]);

        $this->load($params, '');

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere(['like', 'social_share_settings.social_name', $this->social_name])
            ->andFilterWhere(['like', 'social_share_templates.message', $this->message])
            ->andFilterWhere(['like', 'social_share_templates.url', $this->url])
            ->andFilterWhere(['social_share_templates.social_id' => $this->social_id])
            ->andFilterWhere(['social_share_templates.id' => $this->id])
            ->andFilterWhere(['social_share_templates.is_active' => $this->is_active]);


        return $dataProvider;
    }
}