<?php

namespace backend\modules\news\models;

use Yii;
use yii\data\ActiveDataProvider;

/**
 * This is the model class for table "{{%news}}".
 *
 * @property integer $id
 * @property integer $category_id
 * @property string $created_at
 * @property string $published_at
 * @property string $title
 * @property string $description
 * @property string $short_description
 * @property string $alias
 * @property integer $status
 *
 * @property NewsCategory $category
 */
class NewsSearch extends News
{
    public  $id, $category_id, $published_at, $created_at, $title;
    public function rules()
    {
        return [
            [['category_id', 'id'], 'integer'],
            [['title', 'created_at', 'published_at'], 'string', 'max' => 255],
        ];
    }

    public function behaviors()
    {
        return [];
    }

   public function search($params)
   {
       $query = News::find();

       $dataProvider = new ActiveDataProvider([
           'query' => $query,
       ]);

       $this->load($params, '');

       if(!$this->validate()){
           return null;
       }

       $query->andFilterWhere(['like', 'title', $this->title])
           ->andFilterWhere(['like', 'published_at', $this->published_at])
           ->andFilterWhere(['category_id' => $this->category_id])
           ->andFilterWhere(['like', 'created_at', $this->created_at])
           ->andFilterWhere(['id' => $this->id]);


       return $dataProvider;
   }
}
