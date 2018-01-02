<?php

namespace backend\controllers;

use backend\models\User;
use yii\data\ActiveDataProvider;
use yii\data\ArrayDataProvider;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

class UserController extends \yii\web\Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['index','edit'],
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
        $query  = 'select user.*,usersregions.id as rid from user
            left Join usersmetadata on user.id = usersmetadata.userid
            left Join usersregions on usersmetadata.regionid = usersregions.id';

        $user = \Yii::$app->db->createCommand($query)->queryAll();

        $provider = new ArrayDataProvider([

        'allModels' => $user,
        'pagination' => [
                'pageSize' => 10,
            ],

        ]);

        return $this->render('index',['provider' => $provider]);
    }

    public function actionDelete($id)
    {

    }

    public function actionEdit($id)
    {
        $user = User::findOne($id);
        $data = $user->getUsersmetadatas();
        $orders = $user->getOrders();
        //echo '<pre>';print_r($data);die('</pre>');
        $provider = new ActiveDataProvider([

        'query' => $data,

        ]);
        if(!$data)
        {
            $data = [];
        }
        return $this->render('edit',['user'=>$user,'data'=>$provider,'orders'=>$orders]);
    }
}
