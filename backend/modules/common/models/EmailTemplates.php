<?php
namespace backend\modules\common\models;

use Yii;
use yii\behaviors\SluggableBehavior;

class EmailTemplates extends \common\modules\common\models\EmailTemplates
{
    /**
     * @return array
     */
    public function behaviors()
    {
        return [
            [
                'class' => SluggableBehavior::className(),
                'attribute' => 'title',
                'slugAttribute' => 'alias',
            ],
        ];
    }

    /**
     * @param bool $insert
     * @param array $changedAttributes
     */
    public function afterSave($insert, $changedAttributes)
    {
        $layoutFileContent = str_replace([
            '[beginPage]',
            '[charset]',
            '[head]',
            '[beginBody]',
            '[content]',
            '[endBody]',
            '[endPage]'
        ], [
            '<?php $this->beginPage() ?>',
            '<?= Yii::$app->charset ?>',
            '<?php $this->head() ?>',
            '<?php $this->beginBody() ?>',
            '<?= $content ?>',
            '<?php $this->endBody() ?>',
            '<?php $this->endPage() ?>'
        ], $this->header . '[content]' . $this->footer);
        file_put_contents( Yii::getAlias('@common') . '/mail/layouts/' . $this->alias . '.php', $layoutFileContent );
        parent::afterSave($insert, $changedAttributes);
    }
}