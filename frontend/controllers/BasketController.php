<?php

namespace frontend\controllers;

use common\models\Log;
use yii;
use common\models\Oper;
use yii\data\ArrayDataProvider;

class BasketController extends \yii\web\Controller
{

    public $layout = 'priceLayout';

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
    public function actionAdd()
    {
        try {
            $result = ['success' => true];
            $post = Yii::$app->request->post();
            $extra = base64_decode($post['extradata']);
            $extradata = json_decode($extra);
            $oper = new Oper();
            $oper->loadDefaultValues();
            $oper->updated_at = date('Y-m-d H:m:s');
            $oper->userid = isset(Yii::$app->user->id)?Yii::$app->user->id:0;
            $oper->make = $extradata->make;
            $oper->code = $extradata->code;
            $oper->Name = $extradata->name;
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
            //echo '<pre>';print_r($post);print_r($extradata);die('</pre>');

            if (!$oper->save()) {            $oper->loadDefaultValues();
                $errors = $oper->getErrors();
                foreach ($errors as $error) {

                    if(!is_array($error))
                        log::toFile(date('Y-m-d H:m:s').'\t'.$error, true, 'basket.log');
                    else
                        foreach($error as $val)
                        {
                            echo $val.'===';
                            try {
                                log::toFile(date('Y-m-d H:m:s') . '\t' . $val, true, 'basket.log');
                            }
                            catch(\Exception $e)
                            {
                                die($e->getMessage());
                            }
                        }

                }
                $result['success'] = false;
            } else {

                return json_encode($result);
            }
        }
        catch(\Exception $ex)
        {
            $result['message'] = $ex->getMessage();
            return json_encode($result);
        }
    }
}
