<?php

namespace backend\modules\community\controllers;

use common\modules\community\models\QComments;
use Faker\Provider\en_US\PaymentTest;
use Yii;
use common\modules\community\models\Questions;
use backend\modules\community\models\QuestionsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * QuestionsController implements the CRUD actions for Questions model.
 */
class QuestionsController extends Controller
{
    /**
     * Lists all Questions models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new QuestionsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new Questions model.
     * If creation is successful, the browser will be redirected to the 'index' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Questions();
        $category = Yii::$app->request->post('categories');

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if($category){

            }
            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Questions model.
     * If update is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $category = Yii::$app->request->post('categories');

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if($category){

            }
            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Questions model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $commentsObj = QComments::find()->where(['entity_id' => $id, 'entity' => Questions::className()])->all();

        $comments = QComments::find()->select('commentary_id AS parent_id')->where(['entity_id' => $id, 'entity' => Questions::className()])->asArray()->all();
        $subComments = QComments::find()->where(['entity' => Questions::className()])->andWhere(['in','parent_id', $comments])->all();

        foreach ($subComments as $subComment){
            $subComment->delete();
        }
        foreach ($commentsObj as $comment){
            $comment->delete();
        }
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Questions model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Questions the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Questions::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
