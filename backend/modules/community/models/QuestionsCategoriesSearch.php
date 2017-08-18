<?php

namespace backend\modules\community\models;


use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\modules\community\models\QuestionsCategories;

/**
 * QuestionsCategoriesSearch represents the model behind the search form of `common\modules\community\models\QuestionsCategories`.
 */
class QuestionsCategoriesSearch extends QuestionsCategories
{
    public $created_at;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category_id', 'sort', 'sub_status', 'parent_category_id'], 'integer'],
            [['name','created_at'], 'safe'],
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
        $query = QuestionsCategories::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['sort' => SORT_ASC]]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        if(isset($this->created_at) && !empty($this->created_at)) {
            $start = strtotime('-1 day', strtotime($this->created_at));
            $end = strtotime('+1 day', strtotime($this->created_at));
            $start = date('Y-m-d H:i:s', $start);
            $end   = date('Y-m-d H:i:s', $end);
            $query->andFilterWhere(['between', 'questions_categories.created_at', $start, $end]);
        }
        // grid filtering conditions
        $query->andFilterWhere([
            'category_id' => $this->category_id,
            'sort' => $this->sort,
            'sub_status' => $this->sub_status,
            'parent_category_id' => $this->parent_category_id,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }
}
