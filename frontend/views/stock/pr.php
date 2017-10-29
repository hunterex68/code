<?

use app\assets\StockAsset;


StockAsset::register($this);


?>
<h1>Результат</h1>

<?= $this->render('_form', [
        'model' => $model,
        'file' => $file,
    ]) ?>

