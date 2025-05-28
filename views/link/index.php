<?php
use yii\helpers\Html;
use yii\web\View;

$this->title = 'Сервис коротких ссылок + QR';
?>

<div class="url-form">
    <h1 class="text-center mb-4"><?= Html::encode($this->title) ?></h1>

    <div class="input-group mb-3">
        <input type="text" class="form-control" id="url-input" placeholder="Введите URL" aria-label="URL">
        <button class="btn btn-primary" type="button" id="check-url-btn">ОК</button>
    </div>

    <div id="result" class="text-center"></div>
</div>
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="/js/qrcode.min.js"></script>
<?php

$this->registerJsFile('/js/main.js', ['position' => View::POS_END]);
?>

