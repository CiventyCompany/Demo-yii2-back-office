<?php

namespace backend\modules\news\models;

use backend\behaviors\UploadFileBehavior;
use backend\modules\user\models\User;
use common\modules\credit_product\models\CreditProductCategoryGroup;
use common\modules\credit_product\models\CreditProductType;
use common\modules\news\models\NewsCreditProductCategoryRelation;
use common\modules\news\models\NewsCreditProductTypeRelation;
use common\modules\news\models\NewsType;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\behaviors\SluggableBehavior;
use yii\db\Expression;
use common\helpers\TextHelper;
use yii\helpers\ArrayHelper;

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
class News extends \common\modules\news\models\News
{
    private $categories;
    public $shortDescriptionLength = 50, $credit_product_type_ids = [], $credit_product_category_ids = [];
    public $statusArray = [];
    const STATUS_DISABLE = 0;
    const STATUS_ACTIVE = 1;

    public function init()
    {
        parent::init();
        $this->status = 0;
        if($this->isNewRecord){
            $this->user_id = Yii::$app->user->getId();
        }
    }

    public function afterFind()
    {
        parent::afterFind();
        foreach ($this->creditProductTypes as $type){
            $this->credit_product_type_ids[] = $type->id;
        }
        foreach ($this->creditProductCategories as $category){
            $this->credit_product_category_ids[] = $category->id;
        }
    }

    public function rules()
    {
        return [
            [['category_id', 'published_at', 'title', 'user_id', 'description'], 'required'],
            [['category_id', 'status'], 'integer'],
            [['created_at', 'published_at', 'icon', 'updated_at', 'credit_product_type_ids', 'credit_product_category_ids'], 'safe'],
            [['description', 'short_description', 'image'], 'string'],
            [['title', 'alias', 'background_image'], 'string', 'max' => 255],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => NewsCategory::className(), 'targetAttribute' => ['category_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    public static function getParentCommentTitle($parentId)
    {
        $model = News::findOne(['id' => $parentId]);
        if(!$model){
            return '-';
        }
        return $model->title;
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'created_at',
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => 'created_at',
                    ActiveRecord::EVENT_BEFORE_UPDATE => 'updated_at',
                ],
                'value' => new Expression('NOW()'),
            ],
            [
                'class' => SluggableBehavior::className(),
                'attribute' => 'title',
                'slugAttribute' => 'alias',
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'category_id' => Yii::t('app', 'News Category'),
            'created_at' => Yii::t('app', 'Created At'),
            'published_at' => Yii::t('app', 'Published At'),
            'title' => Yii::t('app', 'Title'),
            'description' => Yii::t('app', 'Description'),
            'short_description' => Yii::t('app', 'Short Description'),
            'alias' => Yii::t('app', 'Alias'),
            'status' => Yii::t('app', 'Status'),
            'type_id' => Yii::t('app', 'Type'),
            'user_id' => Yii::t('app', 'User'),
            'credit_product_type_ids' => Yii::t('app', 'Credit Product Type Ids'),
            'credit_product_category_ids' => Yii::t('app', 'Credit Product Category Ids'),
            'image' => Yii::t('app', 'Image'),
            'icon' => Yii::t('app', 'Icon'),
            'background_image' => Yii::t('app', 'Background Image'),
        ];
    }

    public function getStatusArray()
    {
        return [self::STATUS_DISABLE => Yii::t('app', 'Disable'), self::STATUS_ACTIVE => Yii::t('app', 'Active')];
    }

    public function getCategories()
    {
        if(!empty($this->categories)){
            return $this->categories;
        }

        $this->categories = NewsCategory::getCategories();

        return $this->categories;
    }

    public function getTypes()
    {
        return NewsType::getTypes();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(NewsCategory::className(), ['id' => 'category_id']);
    }

    public function getAllCreditProductTypes()
    {
        return ArrayHelper::map(CreditProductType::getAll(), 'id', 'title');
    }

    public function getGroupsTrees()
    {
        $results = [];
        $groups = CreditProductCategoryGroup::find()->orderBy(['sort' => SORT_ASC])->all();
        foreach ($groups as $group)
        {
            $key = $group->title;
            $categoryClass = \common\modules\credit_product\models\CreditProductCategory::className();
            $results[ $key ] = \common\helpers\TreeHelper::getTreeListData( $categoryClass, 0, ['id', 'title'], ['sort' => SORT_ASC], ['credit_product_category_group_id' => $group->id]);
        }
        return $results;
    }

    /**
     * @inheritdoc
     * @return \common\modules\news\models\query\NewsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \backend\modules\news\models\query\NewsQuery(get_called_class());
    }

    public function beforeValidate()
    {
        if( strlen($this->user_id) ){
            $this->user_id = intval($this->user_id);
        } else {
            $this->user_id = Yii::$app->user->getId();
        }

        if(empty($this->short_description)) {
            $this->short_description = TextHelper::getShortText($this->description, $this->shortDescriptionLength, $suffix = '...', $offset = 0);
        }

        return parent::beforeValidate();
    }

    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);
        NewsCreditProductCategoryRelation::saveRelations( $this->id, $this->credit_product_category_ids );
        NewsCreditProductTypeRelation::saveRelations( $this->id, $this->credit_product_type_ids );
    }

    public static function getPostTitle($id)
    {
        $model = News::findOne(['id' => $id]);
        if(!$model){
            return '-';
        }
        return $model->title;
    }
}
