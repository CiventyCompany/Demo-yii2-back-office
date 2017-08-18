<?php
/**
 * @var \yii\db\ActiveRecord[] $models
 * @var \yii\web\View $this
 * @var array $relations
 */
$relatedModels = [];
?>
<table class="table table-striped table-hover">
    <tr>
        <?php
        foreach ($models[0]->getAttributes() as $attribute => $value){
        ?>
            <th><?= $models[0]->getAttributeLabel( $attribute ) ?></th>
        <?php } ?>
    </tr>
    <?php
    foreach ($models as $model){
        ?>
        <tr>
            <?php
            foreach ($model->getAttributes() as $attribute => $value){
                ?>
                <td><?= $model->getAttributeValue( $attribute ) ?></td>
                <?php
            }
            ?>
        </tr>
        <?php if( is_array($relations) && count($relations) ){ ?>

            <?php $showMoreLink = false; ?>
            <?php foreach ($relations as $relation => $info){
                $relatedModels = $model->{$relation};
                if( count($relatedModels) ){
                    $showMoreLink = true;
                    break;
                }
            } ?>

            <?php if($showMoreLink){ ?>
                <tr><td colspan="<?= count($model->getAttributes()) ?>"><a href="#" class="show-related"><span class="glyphicon glyphicon-plus"></span> Показать/скрыть вложенные данные</a></td></tr>
                <?php foreach ($relations as $relation => $info){ ?>
                    <tr class="hidden">
                        <td colspan="<?= count($model->getAttributes()) ?>">
                            <?php
                            $relatedModels = $model->{$relation};
                            $items = [];
                            if ( count($relatedModels) ){
                                $items[] = [
                                    'label' => $info['label'],
                                    'content' => $this->render('_view_content_table', [
                                        'models' => $relatedModels,
                                        'relations' => isset($info['relations']) ? $info['relations'] : []
                                    ]),
                                ];
                            }
                            ?>
                            <?= \yii\bootstrap\Collapse::widget([
                                'items' => $items,
                            ]);?>
                        </td>
                    </tr>
                <?php } ?>
            <?php } ?>

        <?php } ?>
        <?php
    } ?>
</table>