<?php

namespace backend\modules\community\models;


use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\modules\community\models\Questions;

/**
 * QuestionsSearch represents the model behind the search form of `common\modules\community\models\Questions`.
 */
class QuestionsSearch extends Questions
{
    public $user_id, $category_id, $created_at;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['question_id', 'likes', 'dislikes', 'm_status'], 'integer'],
            [['title', 'body', 'created_at', 'user_id','category_id'], 'safe'],
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
        $query = Questions::find()->joinWith('profile')->joinWith('categories');

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['created_at'=>SORT_DESC]]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query
        ->andFilterWhere(['like', 'profile.midlename', $this->user_id])
        ->orFilterWhere(['like', 'profile.firstname', $this->user_id])
        ->orFilterWhere(['like', 'profile.lastname', $this->user_id])

        ->andFilterWhere(['like', 'questions_categories.title', $this->category_id]);
        if(isset($this->created_at) && !empty($this->created_at)) {
            $start = strtotime('-1 day', strtotime($this->created_at));
            $end = strtotime('+1 day', strtotime($this->created_at));
            $start = date('Y-m-d H:i:s', $start);
            $end   = date('Y-m-d H:i:s', $end);
            $query->andFilterWhere(['between', 'questions.created_at', $start, $end]);
        }
        // grid filtering conditions
        $query->andFilterWhere([
            'question_id' => $this->question_id,
            'likes'       => $this->likes,
            'dislikes'    => $this->dislikes,
            'm_status'    => $this->m_status,
        ]);

        $query->andFilterWhere(['like', 'questions.title', $this->title])
            ->andFilterWhere(['like', 'body', $this->body]);

        return $dataProvider;
    }
}
