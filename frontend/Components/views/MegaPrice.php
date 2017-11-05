<?php
use yii\helpers\Html;

?>
<h1>Прайс по ОАЭ</h1>
<?php
if (count($data['uae']['orig']) > 0) {
    $id = rand(1, 1000);
    ?>
    <pre>Оригинал</pre>
    <div class="tablo">
    <table class="table table-hover table-striped" id="t<? echo $id ?>">
        <thead>
        <tr>
            <th>Производитель</th>
            <th>Код</th>
            <th class="hidden-xs hidden-sm">Наименование</th>
            <th>Вес</th>
            <th>Регион</th>
            <th>Доставка макс., дн.</th>
            <th>Цена</th>
            <th>Доступно</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        <?
        $i = 1;
        $mk = $cd = $nm = $w = '';
        foreach ($data['uae']['orig'] as $val) {
            if (!empty($val['price']) && $val['price'] != 0) {
                $pr = round($val['price'], 2);
                $pr .= '&nbsp;' . $val['currency'];

                $val['prc'] = $prc
                ?>
                <tr class="brands" data-type='orig' data-info='<?php echo base64_encode(json_encode($val)) ?>'>
                    <td>
                        <?php echo $val['make']; ?>
                    </td>
                    <td>
                        <?php echo $val['code']; ?>
                    </td>
                    <td class="hidden-xs">
                        <?php echo $val['name']; ?>
                    </td>
                    <td class="hidden-xs">
                        <?php echo $val['weight']; ?>
                    </td>
                    <td style="text-align: center"><? echo $val['region'] ?></td>
                    <td style="text-align: left;padding-left:3vw;">
                        <? echo $val['delivery'] !== 0 ? $val['delivery'] : '<span class="glyphicon glyphicon-earphone"></span>'; ?>
                    </td>
                    <td id='price' style="text-align: right;" class='tdPrice'><?php echo $pr ?></td>

                    <td id='quan' style="text-align: right;" class="hidden-xs"><? echo $val['quan']; ?></td>
                    <td>
                        <?php echo Html::a('<span class="glyphicon glyphicon-shopping-cart"></span>', "basketAdd", ["class" => "btn btn-success"]); ?>
                    </td>
                </tr>
                <?
            }
        }
        ?>
        </tbody>
    </table>
</div>
    <?}
if (count($data['uae']['analog']) > 0) {
    $id = rand(1, 1000);
    ?>
    <pre>Аналоги</pre>
    <div class="tablo">
        <table class="table table-hover table-striped" id="t<? echo $id ?>">
            <thead>
            <tr>
                <th>Производитель</th>
                <th>Код</th>
                <th class="hidden-xs hidden-sm">Наименование</th>
                <th>Вес</th>
                <th>Регион</th>
                <th>Доставка макс., дн.</th>
                <th>Цена</th>
                <th>Доступно</th>
                <th></th>
            </tr>
            </thead>
            <tbody id="analogList">
            <?
            $i = 1;
            foreach ($data['uae']['analog'] as $val) {

                if (!empty($val['price']) && $val['price'] != 0) {
                    $pr = round($val['price'], 2);
                    $pr .= '&nbsp;' . $val['currency'];

                    $val['prc'] = $prc;
                    ?>
                    <tr class="brands" data-make='<? echo $val['make']; ?>' data-type='analogs'
                        data-info='<?php echo base64_encode(json_encode($val)) ?>'>
                        <td><? echo $val['make']; ?></td>
                        <td><? echo $val['code'] ?></td>
                        <td class="hidden-xs"><? echo $val['name'] ?></td>
                        <td class="hidden-xs"><? echo $val['weight'] ?></td>
                        <td style="text-align: center"><? echo $val['region'] ?></td>
                        <td style="text-align: left;padding-left:3vw;">
                            <? echo $val['delivery'] !== 0 ? $val['delivery'] : '<span class="glyphicon glyphicon-earphone"></span>'; ?>
                        </td>
                        <td id='price' style="text-align: right;" class='tdPrice'><?php echo $pr ?></td>

                        <td id='quan' style="text-align: right;" class="hidden-xs"><? echo $val['quan']; ?></td>
                        <td>
                            <?php echo Html::a('<span class="glyphicon glyphicon-shopping-cart"></span>', "basketAdd", ["class" => "btn btn-success"]); ?>
                        </td>
                    </tr>
                    <?
                }
            }
            ?>
            </tbody>
        </table>
    </div>
    <?}?>
