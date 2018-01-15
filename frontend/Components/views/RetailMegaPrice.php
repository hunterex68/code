
<?php
use yii\helpers\Html;
use yii\helpers\Url;

?>
<h1>Прайс по ОАЭ</h1>
<?php

\yii\bootstrap\Modal::begin([
    'id'=>'bskt',
    'options'=>['style'=>'z-index:99999'],
    'header'=>'<h1>Форма заказа</h1><input type="hidden" id="data">',
    'footer'=>$this->render('ajax\footerModal'),
]);?>


<?php \yii\bootstrap\Modal::end();

if(count($data['uae']['orig'])>0)
{
    $id = rand(1, 1000);
    ?>
    <pre>Оригинал</pre>
    <div class="tablo">
        <table class="table table-hover table-striped" id="orig<? echo $id ?>">
            <col width="150px" valign="middle">
            <col width="100px" valign="middle">
            <col width="250px" valign="middle">
            <col width="50px" valign="middle">
            <col width="50px" valign="middle">
            <col width="50px" valign="middle">
            <col width="50px" valign="middle">
            <thead>
                <tr>
                    <th>Производитель</th>
                    <th>Код</th>
                    <th class="hidden-xs hidden-sm">Наименование</th>
                    <th>Доставка макс., дн.</th>
                    <th>Цена</th>
                    <th>Вероятность закупки</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?
                    $i=1;$mk=$cd=$nm=$w='';
                    foreach ($data['uae']['orig'] as $val) {
                        if (!empty($val['price']) && $val['price'] != 0) {
                            $pr = round($val['price'], 2);
                            $pr .= '&nbsp;'.$val['currency'];

                            $val['prc'] = $prc
                            ?>
                            <tr class="brands" data-type='orig'>
                                <td>
                                    <?php echo $val['make'];?>
                                </td>
                                <td>
                                    <?php echo $val['code'];?>
                                </td>
                                <td class="hidden-xs">
                                    <?php echo $val['name'];?>
                                </td>

                                <td style="text-align: left;padding-left:3vw;">
                                    <? echo $val['delivery'] !== 0 ? $val['delivery'] : '<span class="glyphicon glyphicon-earphone"></span>'; ?>
                                </td>
                                <td id='price' style="text-align: right;" class='tdPrice'><?php echo $pr ?></td>

                                <td id='percent'  style="text-align: left;padding-left:3vw;" class="hidden-xs"><? echo $val['percent']; ?></td>
                                <td>
                                    <?php echo Html::button('<span class="glyphicon glyphicon-shopping-cart"></span>', ["class" => "btn btn-success basket",'data-url'=>Url::toRoute('basket/basket-window'), 'data-info'=> base64_encode(json_encode($val))]); ?>
                                </td>
                            </tr>
                            <?
                        }
                    }
                ?>
            </tbody>
        </table>
    </div>
<?
}
if(count($data['uae']['analog'])>0)
{
    $id = rand(1, 1000);
    ?>
    <pre>Аналоги</pre>
    <div class="tablo">
    <table class="table table-hover table-striped" id="t<? echo $id ?>">
        <col width="150px" valign="middle">
        <col width="100px" valign="middle">
        <col width="250px" valign="middle">
        <col width="50px" valign="middle">
        <col width="50px" valign="middle">
        <col width="50px" valign="middle">
        <col width="50px" valign="middle">
        <thead>
            <tr>
                <th>Производитель</th>
                <th>Код</th>
                <th class="hidden-xs hidden-sm">Наименование</th>
                <th>Доставка макс., дн.</th>
                <th>Цена</th>
                <th>Вероятность закупки</th>
                <th></th>
            </tr>
        </thead>
        <tbody id="analogList">
        <?
        $i=1;
        foreach ($data['uae']['analog'] as $val) {
//print_r($val);die;
            if (!empty($val['price']) && $val['price'] != 0) {
                $pr = round($val['price'], 2);
                $pr .= '&nbsp;'.$val['currency'];

                $val['prc'] = $prc;
                ?>
                <tr class="brands" data-make = '<? echo $val['make']; ?>' data-type='analogs'>
                    <td><? echo $val['make']; ?></td>
                    <td><? echo $val['code'] ?></td>
                    <td class="hidden-xs"><? echo $val['name'] ?></td>

                    <td style="text-align: left;padding-left:3vw;">
                        <? echo $val['delivery'] !== 0 ? $val['delivery'] : '<span class="glyphicon glyphicon-earphone"></span>'; ?>
                    </td>
                    <td id='price' style="text-align: right;" class='tdPrice'><?php echo $pr ?></td>

                    <td id='percent' style="text-align: left; padding-left: 3vw" class="hidden-xs"><? echo $val['percent']; ?></td>
                    <td>
                        <?php echo Html::button('<span class="glyphicon glyphicon-shopping-cart"></span>', ["class" => "btn btn-success basket",'data-url'=>Url::toRoute('basket/basket-window'),'data-info'=>base64_encode(json_encode($val))]); ?>
                    </td>
                </tr>
                <?
            }        }
        ?>
        </tbody>
    </table>
</div>

    <?
}
?>
