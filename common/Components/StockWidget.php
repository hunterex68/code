<?
namespace app\components;


use yii\base\Widget;
use app\models\Stock;
use frontend\models\Usersmetadata;




class StockWidget extends Widget
{
    public $number;
    public $brand;
    public $buf;

    public $data;


    function __construct()
    {
    }

    public function init()
    {

    }

    public function run()
    {

        $this->getPrice();

        $id = \Yii::$app->user->id;
        //  print_r($this->data);die;
        if($id>0)
            return $this->render('StockPrice',['data'=>$this->data]);
        else
            return $this->render('RetailStockPrice',['data'=>$this->data]);

    }
    public function getPrice()
    {
        try
        {
            $analogs = Stock::Analogs($this->number,$this->brand);
            if(is_array($analogs) && strlen($analogs[0])>0)
                $this->buf = Stock::getPrice($analogs);
            else
                $this->buf = Stock::getPrice($this->brand.':'.$this->number);

            $this->put2array();
        }
        catch ( \SoapFault $exception )
        {
            echo '<pre>' . print_r( $exception->getMessage() ) . '</pre>';
            die();
        }
    }

    public function put2array()
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
                    if (!empty($row->code) && (strtolower($row->brand) == strtolower($this->brand) && strtolower($row->code) == strtolower($this->number))) {//print_r($row);die;
                        $this->data['ua']['orig'][$i]['dummy'] = 1;
                        $this->data['ua']['orig'][$i]['make'] = $row['brand'];
                        $this->data['ua']['orig'][$i]['code'] = $row['code'];
                        $this->data['ua']['orig'][$i]['name'] = $row['desiption'];
                        $this->data['ua']['orig'][$i]['price'] = round($row['price'] * (1 + $koeff->kUA / 100), 2);
                        $this->data['ua']['orig'][$i]['quan'] = $row['quan'];
                        $this->data['ua']['orig'][$i]['currency'] = 'USD';
                        $this->data['ua']['orig'][$i]['delivery'] = $row['term'] + 1;
                        $this->data['ua']['orig'][$i]['region'] = $row['client_id'];
                        $this->data['ua']['orig'][$i]['weight'] = 0;
                        $this->data['ua']['orig'][$i]['pack'] = 0;
                        $this->data['ua']['orig'][$i]['vol'] = 0;
                        $this->data['ua']['orig'][$i++]['percent'] = 100;
                    } else {
                        $this->data['ua']['analog'][$j]['dummy'] = 1;
                        $this->data['ua']['analog'][$j]['make'] = $row['brand'];
                        $this->data['ua']['analog'][$j]['code'] = $row['code'];
                        $this->data['ua']['analog'][$j]['name'] = $row['description'];
                        $this->data['ua']['analog'][$j]['price'] = round($row['price'] * (1 + $koeff->kUA / 100), 2);
                        $this->data['ua']['analog'][$j]['quan'] = $row['quan'];
                        $this->data['ua']['analog'][$j]['currency'] = 'USD';
                        $this->data['ua']['analog'][$j]['delivery'] = $row['term'] + 5;
                        $this->data['ua']['analog'][$j]['region'] = $row['client_id'];
                        $this->data['ua']['analog'][$j]['weight'] = 0;
                        $this->data['ua']['analog'][$j]['pack'] = 0;
                        $this->data['ua']['analog'][$j]['vol'] = 0;
                        $this->data['ua']['analog'][$j++]['percent'] = 100;
                    }
                }
            }
            else//розница
            {
                foreach ($this->buf as $row) {//print_r($row);die('-----------'.$row['brand']);
                    if (!empty($row->code) && (strtolower($row->brand) == strtolower($this->brand) && strtolower($row->code) == strtolower($this->number))) {//print_r($row);die;
                        //echo "Оригинал ".strtolower($row->MakeName)."==". strtolower($this->brand)." && ". strtolower($row->DetailNum)." == ". strtolower($this->number)."<br/>";
                        $this->data['ua']['orig'][$i]['dummy'] = 1;
                        $this->data['ua']['orig'][$i]['make'] = $row['brand'];
                        $this->data['ua']['orig'][$i]['code'] = $row['code'];
                        $this->data['ua']['orig'][$i]['name'] = $row['description'];
                        $this->data['ua']['orig'][$i]['price'] = round($row['price'] * (1 + $koeff->kUA / 100), 2);
                        $this->data['ua']['orig'][$i]['currency'] = 'грн.';
                        $this->data['ua']['orig'][$i]['delivery'] = $row['term']+1;
                        $this->data['ua']['orig'][$i]['pack'] = 1;
                        $this->data['ua']['orig'][$j]['vol'] = 0;
                        $this->data['ua']['orig'][$i++]['percent'] = 100;

                    } else {
                        //echo "Неоригинал ".strtolower($row->MakeName)."==". strtolower($this->brand)." && ". strtolower($row->DetailNum)." == ". strtolower($this->number)."<br/>";
                        $this->data['ua']['analog'][$j]['dummy'] = 1;
                        $this->data['ua']['analog'][$j]['make'] = $row['brand'];
                        $this->data['ua']['analog'][$j]['code'] = $row['code'];
                        $this->data['ua']['analog'][$j]['name'] = $row['description'];
                        $this->data['ua']['analog'][$j]['price'] = round($row['price'] * (1 + $koeff->kUA / 100), 2);

                        $this->data['ua']['analog'][$j]['currency'] = 'грн.';
                        $this->data['ua']['analog'][$j]['delivery'] = $row['term'] + 1;
                        $this->data['ua']['analog'][$j]['pack'] = 1;
                        $this->data['ua']['analog'][$j]['vol'] = 0;
                        $this->data['ua']['analog'][$j++]['percent'] = 100;
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