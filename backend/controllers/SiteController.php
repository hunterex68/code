<?php
namespace backend\controllers;

use Yii;
use yii\base\Exception;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use backend\models\SignupForm;
use backend\models\LoginForm;
use backend\models\Log;
use backend\models\User;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error', 'index','signup'],
                        'allow' => true,
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

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            log::toFile($model->getErrors(),true,'site.log');
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionSignup()
    {

        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new User();
        $post = Yii::$app->request->post();

        if (count($post)>0) {
            try {
                $post['User']['status'] = 10;
                $post['User']['created_at'] = date('Y-m-d H:m:s');
                if ($model->load($post)) {
                    $model->setPassword($post['User']['password']);
                    $model->generateAuthKey();

                    if (!$model->save()) {
                        $error_code = rand(0,1000)*1000;
                        log::toFile("====================".$error_code."================", true, 'site.log');
                        log::toFile(date('Y-m-d H:m:s').'\tЛогин: '.$post['User']['username'], true, 'site.log');
                        log::toFile(date('Y-m-d H:m:s').'\tЛогин: '.$post['User']['password'], true, 'site.log');
                        log::toFile(date('Y-m-d H:m:s').'\tЛогин: '.$post['User']['email'], true, 'site.log');

                        $errors = $model->getErrors();
                        foreach ($errors as $error) {

                            log::toFile($error, true, 'site.log');

                        }
                        Yii::$app->session->setFlash('error','Ошибка регистрации. Обратитесь к администратору и сообщите код ошибки');

                    }
                }
                return $this->goHome();
            }
            catch(Exception $ex){
                log::toFile($ex->getMessage(), true, 'site.log');
            }
        }
        return $this->render('signup', compact('model'));

    }
}
