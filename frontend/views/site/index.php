<?php

/* @var $this yii\web\View */
use app\components\searchFormWidget;
$this->title = 'Автозапчасти на Ваш автомобиль';

?>

<?= searchFormWidget::widget([
    'header1'=>'Все, что Вам нужно находится здесь!',
    'header2'=>'любые запчасти на автомобиль.',
]);?>


<div class="seo">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
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
        <div class="body-content">
            <div class="row">
                <?php
                if (!empty($model['seotext'])) :?>
                    <? foreach ($model['seotext'] as $text): ?>
                        <div class="col-lg-4">
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
        </div>
    </div>
</div>
<!--div class="title" id="title">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <h2>У вас остались вопросы?</h2>
                <form role="form" action="feedback" method="post" class="form">

                    <input type="text" size="80px" name="name" value="" class="form-control" required
                           placeholder="Ваше имя">

                    <input type="email" size="80px" name="email" value="" class="form-control" required
                           placeholder="Ваш E-mail">

                    <input type="text" size="80px" name="subject" value="" class="form-control" placeholder="Тема">

                    <textarea title="Сообщение" name="message" cols="80" rows="10" class="form-control"></textarea>
                    <br/>
                    <input type="submit" value="Отправить" class=" btn btn-success">

                </form>
            </div>
        </div>
    </div>
</div>

<div class="otzyv">
    <div class="container">
        <div class="row">
            <div class="col-md-12 title">
                <h2>Отзывы наших клиентов</h2>
            </div>
        </div>

        <div class="row">
            <div class="feedback-box col-md-3">
                <div class="message">
                    Доволен чутким отношением к клиентам.
                </div>
                <div class="client">
                    <div class="quote red-text">
                        <i class="glyphicon glyphicon-user"></i>
                    </div>
                    <div class="client-info">
                        <a class="client-name" target="_blank">John Doe</a>
                    </div>
                </div>
            </div>
            <div class="feedback-box col-md-3">
                <div class="message">
                    Адекватные люди. Всегда перезванивают если видят, что у них на телефоне пропущенные вызовы!
                </div>
                <div class="client">
                    <div class="quote red-text">
                        <i class="glyphicon glyphicon-user"></i>
                    </div>
                    <div class="client-info">
                        <a class="client-name" target="_blank">Олег</a>
                        <a class="client-company">покупатель</a>
                    </div>
                </div>
            </div>
            <div class="feedback-box col-md-3">
                <div class="message">
                    Всегда помогают в подборе деталей, всегда вежливые, если обещали перезвонить, обязательно
                    перезванивают. Всегда оговаривают сроки доставки, знаешь на что расчитывать
                </div>
                <div class="client">
                    <div class="quote red-text">
                        <i class="glyphicon glyphicon-user"></i>
                    </div>

                    <div class="client-info">
                        <a class="client-name" target="_blank">PitStop</a>
                        <a class="client-company">менеджер</a>
                    </div>
                </div>
            </div>
        </div-->
    </div>
</div>
