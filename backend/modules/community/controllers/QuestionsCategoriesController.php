<?php

namespace backend\modules\community\controllers;

use common\modules\community\models\Questions;
use Yii;
use common\modules\community\models\QuestionsCategories;
use backend\modules\community\models\QuestionsCategoriesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * QuestionsCategoriesController implements the CRUD actions for QuestionsCategories model.
 */
class QuestionsCategoriesController extends Controller
{
    /**
     * Lists all QuestionsCategories models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new QuestionsCategoriesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new QuestionsCategories model.
     * If creation is successful, the browser will be redirected to the 'index' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new QuestionsCategories();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing QuestionsCategories model.
     * If update is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing QuestionsCategories model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        var_dump('TODO:: Что делать если удаляют категорию? Удалять все подвязанные к ней вопросы???');die;
        $questions = Questions::findAll(['category_id' => $id]);
        foreach ($questions as $question){
            $question->delete();
        }
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the QuestionsCategories model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return QuestionsCategories the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = QuestionsCategories::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
