<?php

namespace backend\modules\app_interface\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\modules\app_interface\models\Seo;

/**
 * SeoSearch represents the model behind the search form of `\common\modules\app_interface\models\Seo`.
 */
class SeoSearch extends Seo
{
    public $seoTitle, $seoH1, $seoDescription, $seoKeywords;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'type'], 'integer'],
            [['url', 'seoTitle'], 'safe'],
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
        $query = Seo::find()
            ->joinWith('data');

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->setSort([
            'attributes'=>[
                'id'=>[
                    'asc'=>['id' => SORT_ASC],
                    'desc'=>['id' => SORT_DESC],
                ],
                'type' => [
                    'asc'=>['type' => SORT_ASC],
                    'desc'=>['type' => SORT_DESC],
                ],
                'url' => [
                    'asc'=>['url' => SORT_ASC],
                    'desc'=>['url' => SORT_DESC],
                ],
                'data.title' => [
                    'asc' => ['data.title' => SORT_ASC],
                    'desc' => ['data.title' => SORT_DESC],
                ],
                'data.h1' => [
                    'asc' => ['data.h1' => SORT_ASC],
                    'desc' => ['data.h1' => SORT_DESC],
                ],
                'data.description' => [
                    'asc' => ['data.description' => SORT_ASC],
                    'desc' => ['data.description' => SORT_DESC],
                ],
                'data.keywords' => [
                    'asc' => ['data.keywords' => SORT_ASC],
                    'desc' => ['data.keywords' => SORT_DESC],
                ]
            ],
            'defaultOrder' => ['id' => SORT_ASC]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'type' => $this->type,
        ]);

        $query->andFilterWhere(['like', 'url', $this->url]);

        return $dataProvider;
    }
}
