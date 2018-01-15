<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 02.01.2018
 * Time: 22:46
 */

use yii\grid\GridView;

?>

<div class="row">
    <div class="col-md-12" style="background-color:white">
        <div class="home">

            <?php

            echo Gridview::widget([

                'dataProvider' => $basket,

            ]);

            ?>

        </div>
    </div>
</div>
