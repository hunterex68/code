<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Usersmetadata;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\widgets\ActiveForm;

/**
 * UsersmetadataController implements the CRUD actions for Usersmetadata model.
 */
class UsersmetadataController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }
    public function actions()
    {
        return [
            'error' => [
                'class' => 'app\error\Errors',
            ],

        ];
    }
    /**
     * Lists all Usersmetadata models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Usersmetadata::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Usersmetadata model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Usersmetadata model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id)
    {
        $model = new Usersmetadata();
        $post = Yii::$app->request->post();
        $this->view->registerCssFile('/css/shortPage.css');
        //print_r($post);die;
        if(count($post)>0)
        {
            $post['Usersmetadata']['UserID'] = $id;
            $post['Usersmetadata']['GroupID'] = 0;
            if(Yii::$app->request->isAjax && $model->load($post))
            {
                Yii::$app->response->format='json';

                return ActiveForm::validate($model);
            }
            if($model->load($post) && $model->save())
                return $this->redirect('../site/login');
            else
                return $this->redirect('create?id='.$id);
        } else {
            return $this->render('create', [
                'model' => $model,'id'=>$id,
            ]);
        }
    }

    /**
     * Updates an existing Usersmetadata model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Usersmetadata model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Usersmetadata model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Usersmetadata the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Usersmetadata::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
