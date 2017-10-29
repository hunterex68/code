<?php

namespace app\components;

use yii\base\Component;
use SoapClient;
class lanaBr extends Component {

    public function getBrands($oem)
    {

        $client = new SoapClient(\Yii::$app->params['lanaHost_Brands']);
        $res = null;
            $params = array( "num" => $oem);
            $res = $client->GetBrands( $params );
            if ( !is_array( $res->GetBrandsResult->string ) )
                $str[0] = $res->GetBrandsResult->string;
            else
                $str = $res->GetBrandsResult->string;
            /*if (count($str)>0)
            {
                foreach ( $str as $key => $val ) {

                    $arr = explode(":", $val);
                    $array[] = ['brand'=>$arr[0],'oem'=>$arr[1]];
                }
            }*/
        return $str;
    }

}