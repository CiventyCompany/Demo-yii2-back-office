<?php
/**
 * @var \yii\db\ActiveRecord[] $models
 * @var \yii\web\View $this
 * @var array $relations
 */
?>
<div class="panel panel-default">
<?php if( count($models) ){ ?>
    <?= $this->render('_view_content_table', [
        'models' => $models,
        'relations' => $relations
    ]) ?>
<?php } else { ?>
    <table class="table table-striped table-bordered"><thead>
        <tbody>
        <tr><td colspan="5"><div class="empty">Ничего не найдено.</div></td></tr>
        </tbody>
    </table>
<?php } ?>
</div>