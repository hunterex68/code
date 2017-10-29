<?php

namespace frontend\controllers;

class BasketController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionBasketWindow()
    {
        $post = \Yii::$app->request->post();
        if(array_key_exists('info',$post) && $post['info']!='undefined') {
            $info = base64_decode($post['info']);
            $info = json_decode($info);
            $user = empty(\Yii::$app->user->id) ? 0 : \Yii::$app->user->id;
            if ($user > 0)
                return $this->renderPartial('Add2Basket', ['model' => $info]);
            else
                return $this->renderPartial('retailAdd2Basket', ['model' => $info]);
        }
        else
            return $this->renderPartial('error');
    }
}
