<?php

namespace backend\controllers;

use common\models\User;
use common\models\Usersregions;
use yii\data\ActiveDataProvider;
use yii\data\ArrayDataProvider;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\oper;
use common\models\Orders;

use common\models\Log;

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

        $sql = "select concat(_cities.city_id,'-',data.userid) as pin,_cities.title_ru as city,address,groupid,carriers.name,recipient ";
        $sql .= "from usersmetadata as data ";
        $sql .= "inner join _cities on regionid=_cities.city_id ";
        //$sql .= "inner join usersgroup on groupid=usersgroup.id ";
        $sql .= "inner join carriers on carriers.id=carrierid ";
        $sql .= "where userid=".$id;

        $data = \Yii::$app->db->createCommand($sql)->queryOne();
        $orders = Orders::find()->where(['userid'=>$id]);
        $opers = Oper::find()
            ->select(['ordid','make','code','Name','region','quan','price','currency','koeff','container','minquan','pack'])
            ->where(['userid'=>$id])
            ->andWhere('ordid is null')
            ->asArray()->all();

        //var_dump($opers->prepare(\Yii::$app->db->queryBuilder)->createCommand()->rawSql);die;

        $orderProvider = new ActiveDataProvider([

            'query' => $orders,

        ]);
        $operProvider = new ArrayDataProvider([

            'allModels' => $opers,

        ]);
        return $this->render('edit',['user'=>$user,'data'=>$data,'orders'=>$orderProvider,'basket'=>$operProvider]);
    }
}
