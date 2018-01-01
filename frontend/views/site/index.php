<?php

/* @var $this yii\web\View */

$this->title = 'Автозапчасти на Ваш автомобиль';
if(Yii::$app->session->hasFlash('Error'))
{
    ?>

        <div class="row">
            <div class="col-md-8 col-md-offset-2">

                <div class="text-center bg-danger">
                    <h2 style="margin:50px 0;padding:20px 0;color:red">
                        <?php echo Yii::$app->session->getFlash('Error') ?>
                    </h2>
                </div>

            </div>
        </div>

    <?php
}
    ?>
    <div class="row">
        <div class="col-md-12 seo">
            <div class="jumbotron">
                <?php
                if (!empty($model['mainseotext'])) :?>

                    <h1>
                        <?php echo $model['mainseotext']->header; ?>
                    </h1>
                    <p class="lead">
                        <?php echo $model['mainseotext']->paragraph; ?>
                    </p>
                <?php else : ?>
                    <h1>SEO-текст</h1>
                    <p class="lead">You have successfully created your Yii-powered application.</p>
                <?php endif; ?>
                <p><a class="btn btn-lg btn-success" href="http://www.yiiframework.com">Get started with Yii</a></p>
            </div>
        </div>
    </div>
    <div class="row">
            <?php if (!empty($model['seotext'])) :?>
                <? $cnt = round(12/count($model['seotext'])); ?>
                <? foreach($model['seotext'] as $text): ?>
                    <div class="col-lg-<?echo $cnt;?>">
                        <h1>
                            <?php echo $text->header; ?>
                        </h1>
                        <p>

                            <?php echo $text->paragraph; ?>

                        </p>
                        <p>
                            <a class="btn btn-default" href="http://www.yiiframework.com/doc/">Yii
                                Documentation &raquo;</a>
                        </p>
                    </div>
                <? endforeach; ?>
            <?php else : ?>
                <div class="col-lg-4">
                    <h2>Heading</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut
                        labore et
                        dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut
                        aliquip
                        ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum
                        dolore eu
                        fugiat nulla pariatur.
                    </p>
                    <p>
                        <a class="btn btn-default" href="http://www.yiiframework.com/doc/">Yii Documentation &raquo;</a>
                    </p>
                </div>
                <div class="col-lg-4">
                    <h2>Heading</h2>

                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut
                        labore et
                        dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut
                        aliquip
                        ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum
                        dolore eu
                        fugiat nulla pariatur.</p>

                    <p><a class="btn btn-default" href="http://www.yiiframework.com/forum/">Yii Forum &raquo;</a></p>
                </div>
                <div class="col-lg-4">
                    <h2>Heading</h2>

                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut
                        labore et
                        dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut
                        aliquip
                        ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum
                        dolore eu
                        fugiat nulla pariatur.</p>

                    <p><a class="btn btn-default" href="http://www.yiiframework.com/extensions/">Yii
                            Extensions &raquo;</a></p>
                </div>
            <?php endif; ?>
    </div>
