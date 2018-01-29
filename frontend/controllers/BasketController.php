<?php

namespace frontend\controllers;

use common\components\BaseUtilites;
use common\models\Log;
use common\models\Usersmetadata;
use common\models\Userspersonal;
use yii;
use common\models\Oper;
use yii\data\ArrayDataProvider;

class BasketController extends \yii\web\Controller
{

    public $layout = 'priceLayout';
    public $transaction = null;
    public function actionIndex()
    {
        $this->view->registerCssFile('/css/shortPage.css');

        $opers = Oper::find()
            ->select(['id','ordid','make','code','Name','region','quan','price','currency','koeff','container','minquan','pack'])
            ->where(['userid'=>Yii::$app->user->id])
            ->andWhere('ordid is null')
            ->asArray()->all();
        $operProvider = new ArrayDataProvider([

            'allModels' => $opers,

        ]);
        return $this->render('index',['basket'=>$operProvider]);
    }
    public function actionBasketWindow()
    {
        $post = \Yii::$app->request->post();
        if(array_key_exists('info',$post) && $post['info']!='undefined') {

            $user = empty(\Yii::$app->user->id) ? 0 : \Yii::$app->user->id;
            if ($user > 0)
                return $this->renderPartial('Add2Basket', ['model' => $post['info']]);
            else
                return $this->renderPartial('retailAdd2Basket', ['model' => $post['info']]);
        }
        else
            return $this->renderPartial('error');
    }
    public function registerRetailClient($post)
    {
        $user = new Usersmetadata();
        $user->loadDefaultValues();
        $user->name = $post->name;
        if($user->save())
        {
            $errors = $user->getErrors();
            foreach ($errors as $error) {

                if (!is_array($error))
                    log::toFile(date('Y-m-d H:m:s') . '\t' . $error, true, 'basket.log');
                else
                    foreach ($error as $val) {
                        echo $val . '===';
                        try {
                            log::toFile(date('Y-m-d H:m:s') . '\t' . $val, true, 'basket.log');
                        } catch (\Exception $e) {
                            die($e->getMessage());
                        }
                    }
            }
            $result['success'] = false;
            return false;
        }
        $contacts = new Userspersonal();
        $contacts->loadDefaultValues();
        $contacts->MetaDataID = $user->id;
        $contacts->Phone = $post->tel;
        if($contacts->save())
        {
            $errors = $user->getErrors();
            foreach ($errors as $error) {

                if (!is_array($error))
                    log::toFile(date('Y-m-d H:m:s') . '\t' . $error, true, 'basket.log');
                else
                    foreach ($error as $val) {
                        echo $val . '===';
                        try {
                            log::toFile(date('Y-m-d H:m:s') . '\t' . $val, true, 'basket.log');
                        } catch (\Exception $e) {
                            die($e->getMessage());
                        }
                    }
            }
            $result['success'] = false;
            return false;
        }
        return true;
    }
    public function actionAdd()
    {
        try {
            $result = ['success' => true];
            $post = Yii::$app->request->post();
            $extra = base64_decode($post['extradata']);
            $extradata = json_decode($extra);

            $this->transaction = Yii::$app->db->beginTransaction();
            if(!$this->registerRetailClient($extradata))
            {
                $this->transaction->rollBack();
            }

            $oper = new Oper();
            $oper->loadDefaultValues();
            $oper->updated_at = date('Y-m-d H:m:s');
            $oper->userid = isset(Yii::$app->user->id) ? Yii::$app->user->id : 0;
            $oper->make = $extradata->make;
            $oper->code = $extradata->code;
            $oper->name = $extradata->name;
            $oper->supplierprice = $extradata->suplierPrice;
            $oper->currency = $extradata->currency;
            $oper->stock = $extradata->dummy;
            $oper->region = $extradata->region;
            $oper->price = $extradata->price;
            $oper->quan = $post['quan'];
            $oper->dpc = $post['dpc'];
            $oper->weightGr = $extradata->weight;
            $oper->wait = array_key_exists('wait', $post) && $post['wait'] == 1 ? true : false;
            $oper->container = array_key_exists('container', $post) && $post['container'] == 1 ? true : false;
            $oper->brand = array_key_exists('brand', $post) && $post['brand'] == 1 ? true : false;
            $oper->pack = array_key_exists('pack', $post) && !empty($post['pack']) != '' ? $post['pack'] : '';
            $oper->supplierid = $extradata->dummy;
            if(Yii::$app->user->id == 0) {
                $oper->hash = BaseUtilites::getCookies();
            }
            if (!$oper->save()) {

                $errors = $oper->getErrors();
                foreach ($errors as $error) {

                    if (!is_array($error))
                        log::toFile(date('Y-m-d H:m:s') . '\t' . $error, true, 'basket.log');
                    else
                        foreach ($error as $val) {
                            echo $val . '===';
                            try {
                                log::toFile(date('Y-m-d H:m:s') . '\t' . $val, true, 'basket.log');
                            } catch (\Exception $e) {
                                die($e->getMessage());
                            }
                        }
                }
                $result['success'] = false;

            }
            $this->transaction->commit();
            return json_encode($result);
        }
        catch(\Exception $ex)
        {
            $this->transaction->rollBack();
            $result['success'] = false;
            $result['message'] = $ex->getMessage();
            return json_encode($result);
        }
    }
}
