<?php

namespace frontend\controllers;

use yii;
use yii\helpers\Url;
use app\models\UploadForm;
use app\models\Fileformat;
use yii\web\UploadedFile;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
class StockController extends \yii\web\Controller
{
    public $layout = 'stockLayout';


    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $fileFormat = (new Fileformat())->findOne(['UserId'=>\Yii::$app->user->identity->getId()]);

        $post = Yii::$app->request->post();
        if($post) {
            if ($fileFormat->load($post) && $fileFormat->save())
                return $this->redirect('index');
            else {
                print_r($fileFormat->getErrors());
                die;
            }
        }
        $this->view->registerCssFile('/css/longPage.css');
        $model = new UploadForm();


        if(count($fileFormat)==0) {

            $attr = $fileFormat->loadDefaultValues();
            $attr['UserId'] = \Yii::$app->user->identity->getId();
            $fileFormat->attributes = $attr;
            if($fileFormat->save())
                $fileFormat = (new Fileformat())->findOne(['UserId'=>\Yii::$app->user->identity->getId()]);

            else {
                print_r($fileFormat->getErrors());
                exit;
            }
        }

        else
            return $this->render("index", ['model' => $model,'format' => $fileFormat]);
    }

    public function actionUpl()
    {
        $mod = new UploadForm();
        $table='';
        $this->view->registerCssFile('/css/longPage.css');
        if (Yii::$app->request->isPost)
        {
            $mod->file = UploadedFile::getInstance($mod, 'file');

            //грузим файл
            if ($mod->upload())
            {
                //если чекбокс не установлен показывам для определения формата
                //если чекбокс установле - заливаем в базу
                $post = Yii::$app->request->post();
                $mode = $post['UploadForm']['save_format'];

                $format = [];
                if($mode == 1)
                {
                    $format = (new Fileformat())->findOne(['UserId'=>\Yii::$app->user->identity->getId()]);
                }

                $table = $mod->getData();
                $data = $mod->showData($table);
                //$provider = new ArrayDataProvider(['allModels' => $data, 'pagination' => ['pageSize' => 20, ], ]);
            }
        }

        return $this->render('preView', ['model' => $mod,'dataProvider' => $data,'format'=>$format,'table'=>$table,'delete_content'=>$post['delete_content']]);

    }

    public function actionAdd()
    {
        if (Yii::$app->request->isPost) {
            $this->view->registerCssFile('/css/longPage.css');
            $request = Yii::$app->request->post();

            $fields = array();
            $fields[$request['f1']] = 'f1';
            $fields[$request['f2']] = 'f2';
            $fields[$request['f3']] = 'f3';
            $fields[$request['f4']] = 'f4';
            $fields[$request['f5']] = 'f5';
            $fields[$request['f6']] = 'f6';

            if (count($fields) == 6) {
                $mod = new UploadForm();
                if($request['delete_content'])
                {
                    UploadForm::delStock();
                }
                if($mod->addStock($fields,$request['table'])) {
                    UploadForm::truncateTable();
                    $content = "<h1>Склад успешно залит!</h1>";
                }
            }
            return $this->redirect(Url::toRoute('price/index'));
        }

    }
}
