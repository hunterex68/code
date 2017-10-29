<?php
namespace app\components;

/**
 * Utils
 * 
 * @package   
 * @author AlexHunt
 * @copyright PartCom
 * @version 2017
 * @access public
 
 */

class Utilites
{
    function printSel($cnt, $format)
    { //print_r($format);die;
        echo "<thead>
                  <tr>";
        for($i=1;$i<=$cnt;$i++)
        {
            echo "<th> <select id='f$i' name='f$i' class='form-control'>";
            //for($i=1;$i<5;$i++)
            {

                echo "<option value='0' ".($format["f$i"]==0?"selected":"").">Пропустить</option>
                      <option value='1' ".($format["f$i"]==1?"selected":"").">Производитель</option>
                      <option value='2' ".($format["f$i"]==2?"selected":"").">Код</option>
                      <option value='3' ".($format["f$i"]==3?"selected":"").">Описание</option>
                      <option value='4' ".($format["f$i"]==4?"selected":"").">Количество</option>
                      <option value='5' ".($format["f$i"]==5?"selected":"").">Цена</option>";
            }
            echo "</select></th>";
        }
        echo "</tr></thead>";
    }

}