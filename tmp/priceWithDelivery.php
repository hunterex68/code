<?
session_start();
try
{
    $i = 0;
    $cond = "";
    $curs=$_SESSION['cource']!=null?$_SESSION['cource']:1;
    //if (!array_key_exists('pt', $_SESSION) || ($_SESSION['pt'] != 1))
    $cond = " and p.percentsupp>=75 and weight>0 ";
    //if ($_POST['check1'] != "on")
    if ( $check1 != 'true' && $check1 != 'on')
        $cond .= " and upper(p.code)='" . strtoupper($detailnum) . "'";
    $cond .= " and p.s=0 order by upper(p.make),upper(p.code),p.price,p.delivery";
    $q = '(select id,userid,upper(make) as make,upper(code) as code,name,case quantity when 0 then 1 else quantity end as quantity, price,weight, region,delivery,percentsupp,0 as s, 1 as strg,  "" as login,   "" as phone       from n_tmpbase p where userid="' .
        $_SESSION['userid'] . '" and sess_id='.$_SESSION['usersess'].'  ' . $cond . ')';

    //echo $q;

    //$q.= '  union (select p.id,userid,upper(make) as make,upper(code) as code,name,case strg     when 0 then quantity else sum(quantity) end as quantity,case strg when 0 then min(price) else max(price) end as price,"",case strg when 0 then region else "UKRN" end as region,3,       99,         s,strg,login,phone from n_tmpbase p inner join n_users on region=pin where userid="'.$_SESSION['userid'].'" and s=1 and case strg when 0 then p.price <= (select min(price)*1.1 from n_tmpbase where userid="'.$_SESSION['userid'].'" and upper(code) = upper(p.code) and upper(make)=upper(p.make) and strg=0 and region<>105322 group by upper(code),upper(make)) else p.price <= (select min(price)*1.1 from n_tmpbase where userid="'.$_SESSION['userid'].'" and upper(code) = upper(p.code) and upper(make)=upper(p.make) and strg=1 group by upper(code),upper(make)) end group by s,upper(make),upper(code))
    //      union (select p.id,userid,upper(make) as make,upper(code) as code,name,                                                             quantity,                                                        price,"",                                                "USTK",0,       99,         s,strg,login,phone from n_tmpbase p inner join n_users on region=pin where userid="'.$_SESSION['userid'].'" and s=1 and region=105322 group by s,upper(make),code) order by s,strg,make,code,delivery,price';
    $res = mysql_query($q) or die("РћС€РёР±РєР° в„–1<br>" . mysql_error() . "<br>" . $q);
    /*$c='select cource from n_course where currency="UAH"';
    $cres = mysql_query($c) or die("РћС€РёР±РєР° в„–22<br>");
    $cource = mysql_fetch_assoc($cres) or die("РћС€РёР±РєР° в„–22<br>");
    */
    $tmp_make = "";
    $i = 1;
    if (array_key_exists('logged', $_SESSION) && ($_SESSION['logged'] != ""))
        $u = 'on';
    else
        $u = 'off';

    $c = 'select usd from n_course where currency="UAH"';
    $cres = mysql_query($c) or die("РћС€РёР±РєР° в„–22<br>".mysql_error());
    $cource = mysql_fetch_assoc($cres) or die("РћС€РёР±РєР° в„–22<br>".mysql_error());
    $_SESSION['cource'] = $cource['usd'];
    $curr = 'UAH';
    //echo $_SESSION['cource'];
    $grid1="";
    while ($resf = mysql_fetch_array($res))
    {
        if ($i % 2 == 0)
            $class = "even";
        else
            $class = "odd";

        $grid1 = "<tr class='" . $class . "' >";

        $grid1 .= "<td style='border: 1px solid #FFF;padding:4px;vertical-align:middle;'>&nbsp;" . iconv('windows-1251','utf8',$resf["make"]) ."&nbsp;</td>";
        $grid1 .= "<td style='border: 1px solid #FFF;padding:4px;vertical-align:middle;'>&nbsp;" . $resf["code"] . "&nbsp;</td>";
        $grid1 .= "<td style='border: 1px solid #FFF;padding:4px;vertical-align:middle;'>&nbsp;" . $resf["name"] .  "&nbsp;(".$curr.")</td>";
        $numb[$k] = $resf["code"];
        $grid1 .= "<td align='right' style='border: 1px solid #FFF;vertical-align:middle;padding:4px 20px 4px 4px;'>" . $resf["quantity"] . "</td>";
        $pr1 = $resf["price"] * $_SESSION['cource'];
        $grid1 .= "<td align='right' style='border: 1px solid #FFF;vertical-align:middle;padding:4px 20px 4px 4px;'>" . round($pr1 * (1 + $_SESSION['koef'] / 100) + ($resf["weight"] / 1000) * 11 * $_SESSION['cource'], 2) . "</td><td>+</td>";
        $grid1 .= "<td style='border: 1px solid #FFF;padding:4px;vertical-align:middle;'>&nbsp;" . round($resf["delivery"] + 16, 2) . "&nbsp;</td>";
        $grid1 .= "<td style='border: 1px solid #FFF;padding:4px;vertical-align:middle;'>&nbsp;" . $resf["percentsupp"] .  "&nbsp;</td>";
        $grid1 .= '<td style="border: 1px solid #FFF;padding:4px;vertical-align:middle;"><a href="javascript:;" onclick="b(\'' .
            base64_encode($resf['id'] . "@" . $pr1 . "@" . $_SESSION['koef'] . "@11@" . $_SESSION['u'] .
                "@" . $curr . "@" . $_SESSION['pt']) . '\');"><img src="images/basket32.png" alt="Р’ РєРѕСЂР·РёРЅСѓ!"></a></td>';
        $grid1 .= "</tr>";
        //  die($grid1);
        $i++;
        if ($resf["s"] == 0)
        {
            if ($i % 2 == 0)
                $class = "even";
            else
                $class = "odd";
            $grid1 .= "<tr class='" . $class . "'>";
            $grid1 .= "<td style='border: 1px solid #FFF;padding:4px;vertical-align:middle;'>&nbsp;".$resf["make"]."&nbsp;</td>";
            $grid1 .= "<td style='border: 1px solid #FFF;padding:4px;vertical-align:middle;'>&nbsp;" . $resf["code"] .
                "&nbsp;</td>";
            $grid1 .= "<td style='border: 1px solid #FFF;padding:4px;vertical-align:middle;'>&nbsp;" . $resf["name"] .
                "&nbsp;(".$curr.")</td>";
            $numb[$k] = $resf["code"];
            $pr1 = $resf["price"] * $_SESSION['cource'];
            $grid1 .= "<td align='right' style='border: 1px solid #FFF;vertical-align:middle;padding:4px 20px; 4px 4px;'>" .
                $resf["quantity"] . "</td>";
            $p=round($pr1 * (1 + $_SESSION['koef'] / 100) + ($resf["weight"] / 1000) * 6 * $_SESSION['cource'], 2);
            $grid1 .= "<td align='right' style='border: 1px solid #FFF;vertical-align:middle;padding:4px 20px; 4px 4px;'>" .$p. "</td><td>+</td>";
            $grid1 .= "<td style='border: 1px solid #FFF;vertical-align:middle;padding:4px;'>" . round($resf["delivery"] +
                    30, 2) . "</td>";
            $grid1 .= "<td style='border: 1px solid #FFF;vertical-align:middle;padding:4px;'>" . $resf["percentsupp"] .
                "</td>";
            $grid1 .= '<td style="border: 1px solid #FFF;vertical-align:middle;padding:4px;"><a href="javascript:;" onclick="b(\'' .
                base64_encode($resf['id'] . "@" . $pr1 . "@" . $_SESSION['koef'] . "@6@" . $_SESSION['u'] .
                    "@" . $curr . "@" . $_SESSION['pt']) . '\');"><img src="images/basket32.png" alt="Р’ РєРѕСЂР·РёРЅСѓ!"></a></td>';
            $grid1 .= "</tr>";
            //echo $grid1."<br/>";
        }
        //echo $resf["code"]." - ".$detailnum."<br/>";
        if($resf["code"]==$detailnum)
        {//echo "3";
            $grid2.=$grid1;
        }
        else
        {//echo "4";
            $grid.=$grid1;
        }
        //$tmp_make = $resf["make"];
        $i++;
    }
}
catch (Exception $ex)
{}
?>