<?php

namespace backend\modules\news\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use yii\db\ActiveRecord;
use yii\behaviors\SluggableBehavior;

/**
 * This is the model class for table "{{%news_category}}".
 *
 * @property integer $id
 * @property string $created_at
 * @property string $title
 * @property string $description
 * @property string $alias
 * @property integer $parent_id
 *
 * @property News[] $news
 */
class NewsCategory extends \common\modules\news\models\NewsCategory
{
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'created_at',
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => 'created_at',
                    ActiveRecord::EVENT_BEFORE_UPDATE => 'created_at',
                ],
                'value' => new Expression('NOW()'),
            ],
            [
                'class' => SluggableBehavior::className(),
                'attribute' => 'title',
                'slugAttribute' => 'alias',
            ]
        ];
    }

    public function rules()
    {
        $rules = parent::rules();
        $rules['required'] = [['title', 'description'], 'required'];
        return parent::rules();
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'created_at' => Yii::t('app', 'Created At'),
            'title' => Yii::t('app', 'Title'),
            'description' => Yii::t('app', 'Description'),
            'alias' => Yii::t('app', 'Alias'),
            'parent_id' => Yii::t('app', 'Parent Category')
        ];
    }

    public static function getCategories()
    {
        $categories = self::find()->all();
        $categoriesArray = [];

        if(!isset($categories) || empty($categories)){
            return null;
        }

        foreach($categories as $category){
            $categoriesArray[$category->id] = $category->title;
        }

        return $categoriesArray;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNews()
    {
        return $this->hasMany(News::className(), ['category_id' => 'id']);
    }

    public static function getCategoriesTree( $parent_id = 0, $level = 0 )
    {
        $categoriesArray = [
            0 => ''
        ];
        $parentCategories = self::find()->where(['parent_id' => $parent_id])->all();
        if($parentCategories){
            foreach($parentCategories as $parentCategory){
                $prefix = '';
                for ($i = 0; $i < $level; $i++){
                    $prefix .= '-';
                }
                $categoriesArray[$parentCategory->id] = $prefix . $parentCategory->title;
                $children = self::getCategoriesTree( $parentCategory->id, ($level + 1) );
                if(count($children)){
                    $categoriesArray = array_replace( $categoriesArray, $children );
                }
            }
        }
        return $categoriesArray;
    }

}
