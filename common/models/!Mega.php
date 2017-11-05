<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 15.08.2017
 * Time: 23:56
 */

namespace common\models;

use SoapClient;
use SoapFault;
use app\models\Customer;
use yii\base\Model;

class Mega extends Model
{
    public $buf;
    var $host;
    var $username;
    var $password;
    public $id;
    public $d;
    public $data;


    function __construct()
    {
        parent::init();
        $this->host = "http://emexonline.com:3000/MaximaWS/service.wsdl";
        $this->username = "QKHR";
        $this->password = "fisaorg";
        $this->buf = array();
        $this->id = 0;
        $this->data=[];
    }

    public function getPrice( $detailnum )
    {
        try
        {
            $client = new SoapClient( $this->host, array( 'timeout' => 10 ) );
            $customer = new Customer();
            $customer->UserName = $this->username;
            $customer->Password = $this->password;

            $params = array( "Customer" => $customer, "DetailNum" => $detailnum,"ShowSubsts" => true );

            $resSearchPart = $client->SearchPart( $params );

            if ( isset( $resSearchPart->SearchPartResult->FindByNumber ) && count( $resSearchPart->
                SearchPartResult->FindByNumber ) == 1 )
                $this->buf = $resSearchPart->SearchPartResult;
            else
                $this->buf = $resSearchPart->SearchPartResult->FindByNumber;

            return $this->put2array();

        }
        catch ( SoapFault $exception )
        {
            echo '<pre>' . print_r( $exception->getMessage() ) . '</pre>';
            die();
        }
    }

    public function Put2array()
    {
        try
        {
            $koeff = (Usr::getKoeff(\Yii::$app->User->getID()));
            $i= 0;
            $i=0;
            foreach ($this->buf as $row)
            {
                if (!empty($row->DetailNum) /*&& strpos($resf[$i]->signature, 'PACK') <= 0*/ )
                {
                    $this->data['uae']['detail'][$i]['dummy'] = 1;
                    $this->data['uae']['detail'][$i]['make'] = $row->MakeName;
                    $this->data['uae']['detail'][$i]['code'] = $row->DetailNum;
                    $this->data['uae']['detail'][$i]['name'] = $row->PartNameRus;
                    $this->data['uae']['detail'][$i]['price'] = $row->Price*$koeff->uae;
                    $this->data['uae']['detail'][$i]['quan'] = $row->AvailAble;
                    $this->data['uae']['detail'][$i]['currency'] = 'USD';
                    $this->data['uae']['detail'][$i]['deliveryMin'] = 1;
                    $this->data['uae']['detail'][$i]['region'] = $row->PriceLogo;
                    $this->data['uae']['detail'][$i]['weight'] = $row->WeightGr;
                    $this->data['uae']['detail'][$i]['pack'] = $row->Packing;
                    $this->data['uae']['detail'][$i]['vol'] = $row->VolumeAdd;
                    $this->data['uae']['detail'][$i]['percent'] = $row->PercentSupped;
               }
                $i++;
            }
        }
        catch ( \Exception $ex )
        {

        }
        return $this->data;
    }

    function destruct()
    {

        $this->host = nil;
        $this->username = nil;
        $this->password = nil;
        $this->buf = nil;

    }

    function SearchInHistory_Log( $detailnum )
    {
        try
        {
            $client = new SoapClient( $this->host );
            $customer = new Customer();
            $customer->UserName = $this->username;
            $customer->Password = $this->password;
            $params = array( "Customer" => $customer, "Parameter" => $detailnum, "Type" => 0 );
            $resSearchPart = $client->SearchInHistory_Log( $params );
            $this->buf = $resSearchPart->SearchInHistory_LogResult->Movement;
            return $this->buf;
        }
        catch ( SoapFault $exception )
        {
            echo $exception;
        }
    }


}