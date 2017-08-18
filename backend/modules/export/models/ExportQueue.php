<?php
namespace backend\modules\export\models;

use common\modules\identification\models\IdentificationHistory;
use common\modules\user\models\User;
use common\modules\user\models\UserRegisterLog;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;
use yii\helpers\FileHelper;

/**
 * This is the model class for table "{{%export_queue}}".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $model
 * @property string $settings
 * @property string $created_at
 * @property integer $status
 * @property string $file_name
 *
 * @property User $user
 */
class ExportQueue extends \yii\db\ActiveRecord
{
    const STATUS_NEW = 0;
    const STATUS_COMPLETED = 1;
    const STATUS_DOWNLOADED = 2;
    const STATUS_REMOVED_FILE = 9;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%export_queue}}';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'created_at',
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => 'created_at',
                ],
                'value' => new Expression('NOW()'),
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['model'], 'required'],
            [['status', 'user_id'], 'integer'],
            [['model', 'file_name'], 'string', 'max' => 255],
            [['created_at', 'settings'], 'safe'],
            [['status'], 'default', 'value' => '0'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'model' => Yii::t('app', 'Model'),
            'user_id' => Yii::t('app', 'User Id'),
            'created_at' => Yii::t('app', 'Created At'),
            'status' => Yii::t('app', 'Status'),
            'file_name' => Yii::t('app', 'File Name'),
        ];
    }

    /**
     * @param bool $insert
     * @return bool
     */
    public function beforeSave($insert)
    {
        if( $insert ){
            $this->user_id = Yii::$app->user->getId();
            $this->settings = json_encode( $this->settings );
        }
        return parent::beforeSave($insert);
    }

    /**
     * @return bool
     */
    public function beforeDelete()
    {
        if( in_array($this->settings, [self::STATUS_COMPLETED, self::STATUS_DOWNLOADED]) ){
            @unlink( $this->getFilePath() );
        }
        return parent::beforeDelete();
    }

    public function removeFile()
    {
        $this->updateAttributes(['file_name' => '', 'status' => ExportQueue::STATUS_REMOVED_FILE]);
        @unlink( $this->getFilePath() );
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return array
     */
    public static function getModels()
    {
        return [
            User::className() => Yii::t('app', 'User'),
            UserRegisterLog::className() => Yii::t('app', 'Questionnaires'),
            IdentificationHistory::className() => Yii::t('app', 'Identifications'),
        ];
    }

    public static function getStatuses()
    {
        return [
            self::STATUS_NEW => Yii::t('app', 'New'),
            self::STATUS_COMPLETED => Yii::t('app', 'File Created'),
            self::STATUS_DOWNLOADED => Yii::t('app', 'Downloaded'),
            self::STATUS_REMOVED_FILE => Yii::t('app', 'File removed'),
        ];
    }

    /**
     * @return array
     */
    public function getSymbols()
    {
        return [
            'A',
            'B',
            'C',
            'D',
            'E',
            'F',
            'G',
            'H',
            'I',
            'J',
            'K',
            'L',
            'M',
            'N',
            'O',
            'P',
            'Q',
            'R',
            'S',
            'T',
            'U',
            'V',
            'W',
            'X',
            'Y',
            'Z',
            'AA',
            'AB',
            //....
        ];
    }

    /**
     * @param array $data
     * @param $title
     * @param $fileName
     * @return bool
     */
    public function generateXLS( array $data, $title, $fileName)
    {
        $symbols = $this->getSymbols();
        $objPHPExcel = new \PHPExcel();

        $objPHPExcel->getProperties()
            ->setCreator('Административная панель сайта test')
            ->setLastModifiedBy('Административная панель сайта test')
            ->setTitle("$title test")
            ->setSubject("$title test");

        $objPHPExcel->setActiveSheetIndex(0);

        foreach($data[0] as $key => $item ){
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue( $symbols[$key] . '1', $data[0][$key]);
        }

        for ($i = 1; $i < count($data); $i++)
        {
            foreach($data[$i] as $key => $item ){
                $objPHPExcel->setActiveSheetIndex(0)->setCellValue( $symbols[$key] . ($i+1), $data[$i][$key]);
            }
        }
        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $filePath = $this->getDirPath() . '/' . $fileName;

        try{
            $objWriter->save($filePath);
            @chmod($filePath, 0777);
            return true;
        } catch (\Exception $exception) {
            return false;
        }
    }

    public function getDirPath()
    {
        $dir = Yii::getAlias('@backend') . '/runtime/export';
        if( !file_exists( $dir ) ){
            FileHelper::createDirectory( $dir );
        }
        return $dir;
    }

    public function getFilePath()
    {
        return $this->getDirPath() . '/' . $this->file_name;
    }
}
