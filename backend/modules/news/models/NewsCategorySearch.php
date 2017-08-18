<?php

namespace backend\modules\news\models;

use Yii;
use yii\data\ActiveDataProvider;

/**
 * This is the model class for table "{{%news_category}}".
 *
 * @property integer $id
 * @property string $created_at
 * @property string $title
 * @property string $description
 * @property string $alias
 *
 * @property News[] $news
 */
class NewsCategorySearch extends NewsCategory
{
    public $description, $alias, $created_at, $title, $id;

    public function rules()
    {
        return [
            [['id', 'parent_id'], 'integer'],
            [['description'], 'string'],
            [['alias', 'created_at', 'title'], 'string', 'max' => 255],
        ];
    }

    public function behaviors()
    {
        return [];
    }

    public function search($params)
    {
        $query = NewsCategory::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params, '');

        if(!$this->validate()){
            return null;
        }

        $query
            ->andFilterWhere(['=', 'parent_id', $this->parent_id])
            ->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'alias', $this->alias])
            ->andFilterWhere(['like', 'created_at', $this->created_at])
            ->andFilterWhere(['id' => $this->id]);


        return $dataProvider;

    }
}
