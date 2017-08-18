<?php
$this->title = Yii::t('app', 'Update') . ' ' . $model->title;
$this->params['breadcrumbs'][] = $this->title;
?>

<?= $this->render('_form', ['model' => $model]); ?>