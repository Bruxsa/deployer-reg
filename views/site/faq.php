<?php

/* @var $this yii\web\View */

use Yii;
use yii\helpers\Html;

$this->title = 'Частые вопросы';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>
    
    <p>
        <h3>Можно ли использовать FTP для выкладки проекта?</h3>
        <p>
            Нет, для выкладки мы используем только Git.
        </p>
    </p>
    
    <p>
        <h3>Как обновить код проекта?</h3>
        <p>
            Опубликуйте изменения на GitHub, изменения будут скачаны и установлены на сервер. Обычно это происходит в течение 10 минут.
        </p>
    </p>
    
    <p>
        <h3>При регистрации проекта получаю ошибку <code>Неверная ссылка на Git</code></h3>
        <p>
            Вероятно, вы вводите адрес страницы проекта на GitHub, а не адрес самого репозитория. Обратите внимание, что вам нужно указать HTTPS адрес репозитория.
            <img src="<?php echo Yii::$app->homeUrl ?>images/git-link.png"/>
        </p>
    </p>

    <p>
        <h3>Проект выложен, при открытии в браузере получаю ошибку <code>Uncaught Error: Call to undefined function mysql_connect</code></h3>
        <p>
            Вы используете устаревший способ подключения MySQL.
            Следуюет использовать расширение PHP MySQLi.
            См. <a href="http://php.net/manual/ru/book.mysqli.php">документацию</a> и <a href="http://php.net/manual/ru/mysqli.examples-basic.php">примеры</a> на сайте PHP,
            <?= Html::a('информацию по подключению', ['/site/mysql']) ?> MySQL на нашем сервере.
        </p>
    </p>
</div>
