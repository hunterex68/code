<?
namespace frontend\components;

use yii\base\Widget;
use common\models\Oper;

class basketIndicator extends Widget
{
    public function run()
    {


        return $this->render('basketind-icator', ['data' => $pos]);

    }

}