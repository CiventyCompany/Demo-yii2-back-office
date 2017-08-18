<?php
use common\modules\credit_product\models\CreditProductField;
/**
 * @var \common\modules\credit_product\models\CreditProductField $fields[]
 * @var \common\modules\credit_product\models\CreditProductFieldTextValues $fieldsValues[]
*/
$globalIdCounter = 100;
foreach ($fields as $field){
    $fieldName = $field->name;
    if($field->type == CreditProductField::TYPE_REFERENCE){
        $fieldName .= ' (' . $field->creditProductFieldReference->creditProductReference->title . ')';
    }
    $fieldExample = $field->valueModel->getField( $field );
?>
    <div class="form-group custom-field-wrap"
         data-multiple="<?= $field->multiple ?>"
         data-multiple_count="<?= $field->multiple_count ?>"
         data-type="<?= $field->type ?>"
    >
        <label class="control-label" for="custom-field-<?= $field->alias ?>">
            <?= $fieldName ?>
        </label>
        <div class="custom-field-list">
            <?php
            if( isset($fieldsValues[ $field->id ]) ){ // если есть значения полей то показываем их
                foreach ($fieldsValues[ $field->id ] as $key => $fieldsValue){
                    $fieldExampleLocal = str_replace('[example]', '[]', $fieldExample);
                    $dom = \keltstr\simplehtmldom\SimpleHTMLDom::str_get_html( $fieldExampleLocal );
                    $inputs = $dom->find('input');
                    if( count($inputs) == 1 ){ //значит 2е поле это селект
                        $select = $dom->find('select', 0);
                        if($select){
                            foreach ($select->find('option') as $option){
                                if($option->value == $fieldsValue->value){
                                    $option->setAttribute('selected', 'selected');
                                }
                            }
                            $select->setAttribute('id', 'w' . $globalIdCounter);
                        } else {
                            $textarea = $dom->find('textarea', 0);
                            $textarea->innertext = $fieldsValue->value;
                            $textarea->setAttribute('id', 'w' . $globalIdCounter);
                        }

                        $inputs[0]->value = $fieldsValue->suffix;
                    } else {
                        if($field->type == $field::TYPE_NUMBER){
                            $inputs[0]->value = explode('.', $fieldsValue->value)[0];
                        } else {
                            $inputs[0]->value = $fieldsValue->value;
                        }
                        $inputs[0]->setAttribute('id', 'w' . $globalIdCounter);

                        $inputs[1]->setAttribute('value', htmlspecialchars($fieldsValue->suffix) );
                    }

                    /**
                     * добавляем для кнопок elfinder уникальные айди
                     */
                    if($field->type == $field::TYPE_IMAGE){
                        $button = $dom->find('button', 0);
                        $button->setAttribute('id', 'w' . $globalIdCounter . '_button');
                    }

                    echo $dom;
                    $globalIdCounter++;
                }
            } else { // если нет значений тогда показываем екземпл предварительно почистив нейм
                $fieldExampleLocal = str_replace('[example]', '[]', $fieldExample);
                echo $fieldExampleLocal;
            }
            ?>
        </div>

        <div class="add-more-wrap<?php if(!$field->multiple || ($field->multiple && isset($fieldsValues[ $field->id ]) && count($fieldsValues[ $field->id ]) == $field->multiple_count)): ?> hidden<?php endif; ?>">
            <?= \yii\helpers\Html::a('<i class="fa fa-plus"></i> ' . Yii::t('app', 'Add value'), '#', ['class' => 'add-field-item']) ?>
        </div>
        <div class="hidden custom-field-example"><?= $fieldExample ?></div>
        <div class="help-block"></div>
    </div>
<?php } ?>
<!-- Modal -->
<div class="modal fade" id="icons" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="<?= Yii::t('app', 'Close') ?>"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel"><?= Yii::t('app', 'Add new icon') ?></h4>
            </div>
            <div class="modal-body">
                <div class="icons-list">
                    <?php foreach (CreditProductField::getAvailableIcons() as $availableIcon){ ?>
                        <a href="#" class="img-circle select-icon" data-class="<?= $availableIcon['class'] ?>"><i class="<?= $availableIcon['admin-icon-class'] ?>"></i></a>
                    <?php } ?>
                </div>
                <hr />
                <div class="icons-setting">
                    <label for="icon-title"><?= Yii::t('app', 'Title') ?></label>
                    <input type="text" name="icon-title" id="icon-title" class="form-control">
                    <br />
                    <label for="icon-link"><?= Yii::t('app', 'Icon Link') ?></label>
                    <input type="text" name="icon-link" id="icon-link" class="form-control">
                    <br />
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><?= Yii::t('app', 'Close') ?></button>
                <button type="button" class="btn btn-primary"><?= Yii::t('app', 'Add') ?></button>
            </div>
        </div>
    </div>
</div>