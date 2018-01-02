<?php

use yii\grid\GridView;

?>
<div class="row">
    <div class="col-md-12" style="background-color:white">
        <div class="home">

            <?php

            echo Gridview::widget([

                'dataProvider' => $data,

            ]);

            ?>

        </div>
    </div>
</div>