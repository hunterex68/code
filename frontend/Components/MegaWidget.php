<?
namespace app\components;

use yii\base\Widget;
use SoapClient;
use SoapFault;
use app\models\Customer;
use frontend\models\Usersmetadata;



class MegaWidget extends Widget
{
    public $number;
    public $brand;
    public $buf;
    public $host;
    public $username;
    public $password;
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

    public function init()
    {

    }

    public function run()
    {

         $this->getPrice();

        $id = \Yii::$app->user->id;
        if($id>0)
            return $this->render('MegaPrice',['data'=>$this->data]);
        else
            return $this->render('RetailMegaPrice',['data'=>$this->data]);

    }
    public function getPrice(  )
    {
        try
        {
            $client = new SoapClient( $this->host, array( 'timeout' => 10 ) );
            $customer = new Customer();
            $customer->UserName = $this->username;
            $customer->Password = $this->password;
            $params = array( "Customer" => $customer, "DetailNum" => $this->number,"ShowSubsts" => true );

            $resSearchPart = $client->SearchPart($params);
            //die("1111111");

            if ( isset( $resSearchPart->SearchPartResult->FindByNumber ) && count( $resSearchPart->
                SearchPartResult->FindByNumber ) == 1 )
                $this->buf = $resSearchPart->SearchPartResult;
            else
                $this->buf = $resSearchPart->SearchPartResult->FindByNumber;

            $this->put2array();

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
            $id = \Yii::$app->user->id;
            if(empty($id))
                $id=0;
            $koeff = Usersmetadata::getKoeff($id);
            $i=0;$j=0;
            if($id>0)//опт
            {
                foreach ($this->buf as $row) {
                    if (!empty($row->DetailNum) && (strtolower($row->MakeName) == strtolower($this->brand) && strtolower($row->DetailNum) == strtolower($this->number))) {//print_r($row);die;
                        $this->data['uae']['orig'][$i]['dummy'] = 1;
                        $this->data['uae']['orig'][$i]['make'] = $row->MakeName;
                        $this->data['uae']['orig'][$i]['code'] = $row->DetailNum;
                        $this->data['uae']['orig'][$i]['name'] = $row->PartNameRus;
                        $this->data['uae']['orig'][$i]['price'] = round($row->Price * (1 + $koeff->kUAE / 100), 2);
                        $this->data['uae']['orig'][$i]['quan'] = $row->Available;
                        $this->data['uae']['orig'][$i]['currency'] = 'USD';
                        $this->data['uae']['orig'][$i]['delivery'] = $row->GuaranteedDay + 5;
                        $this->data['uae']['orig'][$i]['region'] = $row->PriceLogo;
                        $this->data['uae']['orig'][$i]['weight'] = $row->WeightGr;
                        $this->data['uae']['orig'][$i]['pack'] = $row->Packing;
                        $this->data['uae']['orig'][$i]['vol'] = $row->VolumeAdd;
                        $this->data['uae']['orig'][$i++]['percent'] = $row->PercentSupped;
                    } else {
                        $this->data['uae']['analog'][$j]['dummy'] = 1;
                        $this->data['uae']['analog'][$j]['make'] = $row->MakeName;
                        $this->data['uae']['analog'][$j]['code'] = $row->DetailNum;
                        $this->data['uae']['analog'][$j]['name'] = $row->PartNameRus;
                        $this->data['uae']['analog'][$j]['price'] = round($row->Price * (1 + $koeff->kUAE / 100), 2);
                        $this->data['uae']['analog'][$j]['quan'] = $row->Available;
                        $this->data['uae']['analog'][$j]['currency'] = 'USD';
                        $this->data['uae']['analog'][$j]['delivery'] = $row->GuaranteedDay + 5;
                        $this->data['uae']['analog'][$j]['region'] = $row->PriceLogo;
                        $this->data['uae']['analog'][$j]['weight'] = $row->WeightGr;
                        $this->data['uae']['analog'][$j]['pack'] = $row->Packing;
                        $this->data['uae']['analog'][$j]['vol'] = $row->VolumeAdd;
                        $this->data['uae']['analog'][$j++]['percent'] = $row->PercentSupped;
                    }
                }
            }
            else//розница
            {
                foreach ($this->buf as $row) {
                    if (!empty($row->DetailNum) && (strtolower($row->MakeName) == strtolower($this->brand) && strtolower($row->DetailNum) == strtolower($this->number))) {//print_r($row);die;
                        //echo "Оригинал ".strtolower($row->MakeName)."==". strtolower($this->brand)." && ". strtolower($row->DetailNum)." == ". strtolower($this->number)."<br/>";
                        $this->data['uae']['orig'][$i]['dummy'] = 1;
                        $this->data['uae']['orig'][$i]['make'] = $row->MakeName;
                        $this->data['uae']['orig'][$i]['code'] = $row->DetailNum;
                        $this->data['uae']['orig'][$i]['name'] = $row->PartNameRus;
                        $this->data['uae']['orig'][$i]['price'] = round($row->Price * (1 + $koeff->kUAE / 100) + ($row->WeightGr / 1000) * 11 * 26/*$cource*/, 2);

                        $this->data['uae']['orig'][$i]['currency'] = 'грн.';
                        $this->data['uae']['orig'][$i]['delivery'] = $row->GuaranteedDay + 16;
                        $this->data['uae']['orig'][$i]['pack'] = $row->Packing;
                        $this->data['uae']['orig'][$j]['vol'] = $row->VolumeAdd;
                        $this->data['uae']['orig'][$i++]['percent'] = $row->PercentSupped;


                        $this->data['uae']['orig'][$i]['dummy'] = 1;
                        $this->data['uae']['orig'][$i]['make'] = $row->MakeName;
                        $this->data['uae']['orig'][$i]['code'] = $row->DetailNum;
                        $this->data['uae']['orig'][$i]['name'] = $row->PartNameRus;
                        $this->data['uae']['orig'][$i]['price'] = round($row->Price * (1 + $koeff->kUAE / 100) + ($row->WeightGr / 1000) * 6 * /*$cource*/26    , 2);

                        $this->data['uae']['orig'][$i]['currency'] = 'грн.';
                        $this->data['uae']['orig'][$i]['delivery'] = $row->GuaranteedDay + 30;
                        $this->data['uae']['orig'][$i]['pack'] = $row->Packing;
                        $this->data['uae']['orig'][$j]['vol'] = $row->VolumeAdd;
                        $this->data['uae']['orig'][$i++]['percent'] = $row->PercentSupped;
                    } else {
                        //echo "Неоригинал ".strtolower($row->MakeName)."==". strtolower($this->brand)." && ". strtolower($row->DetailNum)." == ". strtolower($this->number)."<br/>";
                        $this->data['uae']['analog'][$j]['dummy'] = 1;
                        $this->data['uae']['analog'][$j]['make'] = $row->MakeName;
                        $this->data['uae']['analog'][$j]['code'] = $row->DetailNum;
                        $this->data['uae']['analog'][$j]['name'] = $row->PartNameRus;
                        $this->data['uae']['analog'][$j]['price'] = round($row->Price * (1 + $koeff->kUAE / 100) + ($row->WeightGr / 1000) * 11 * $cource, 2);

                        $this->data['uae']['analog'][$j]['currency'] = 'грн.';
                        $this->data['uae']['analog'][$j]['delivery'] = $row->GuaranteedDay + 16;
                        $this->data['uae']['analog'][$j]['pack'] = $row->Packing;
                        $this->data['uae']['analog'][$j]['vol'] = $row->VolumeAdd;
                        $this->data['uae']['analog'][$j++]['percent'] = $row->PercentSupped;

                        $this->data['uae']['analog'][$i]['dummy'] = 1;
                        $this->data['uae']['analog'][$i]['make'] = $row->MakeName;
                        $this->data['uae']['analog'][$i]['code'] = $row->DetailNum;
                        $this->data['uae']['analog'][$i]['name'] = $row->PartNameRus;
                        $this->data['uae']['analog'][$i]['price'] = round($row->Price * (1 + $koeff->kUAE / 100) + ($row->WeightGr / 1000) * 6 * $cource, 2);

                        $this->data['uae']['analog'][$i]['currency'] = 'грн.';
                        $this->data['uae']['analog'][$i]['delivery'] = $row->GuaranteedDay + 30;
                        $this->data['uae']['analog'][$i]['pack'] = $row->Packing;
                        $this->data['uae']['analog'][$j]['vol'] = $row->VolumeAdd;
                        $this->data['uae']['analog'][$i++]['percent'] = $row->PercentSupped;
                    }

                }
            }
        }
        catch ( \Exception $ex )
        {
            print_r($ex->getMessage());die;
        }

}

}