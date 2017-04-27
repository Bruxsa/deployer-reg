<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'Работа с MySQL';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        Для подключения к MySQL необходимо знать хост для подключения, имя пользователя, пароль, имя базы данных. Эти данные будут созданы при выкладке вашего проекта.
        Параметры будут записаны в файл db_params.php в корне проекта.
    </p>
    
    <p>
        Пример файла db_params.php:
        <pre>
&lt;?php
return array(
    'type' => 'mysql',
    'host' => 'localhost:3306',
    'db' => 'db111',
    'user' => 'user111',
    'password' => '1234567890'
);
?&gt;</pre>
    </p>
    
    <p>
        Когда вы разрабатываете приложение локально на своем копьютере, создайте у себя аналогичный файл с параметрами подключения, но <strong>не добавляйте его в Git</strong>.
    </p>
    
    <p>
        Пример кода простейшего приложения:
        <pre>
&lt?php

$dbconfig = require('db_params.php');

$mysqli = new mysqli($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['db']);

if ($mysqli->connect_errno) {
    echo "Ошибка: Не удалсь создать соединение с базой MySQL и вот почему: \n";
    echo "Номер_ошибки: " . $mysqli->connect_errno . "\n";
    echo "Ошибка: " . $mysqli->connect_error . "\n";
    exit;
}

$sql = "SELECT * FROM records";
if (!$result = $mysqli->query($sql)) {
    echo "Ошибка: Наш запрос не удался и вот почему: \n";
    echo "Запрос: " . $sql . "\n";
    echo "Номер_ошибки: " . $mysqli->errno . "\n";
    echo "Ошибка: " . $mysqli->error . "\n";
    exit;
}

$record = $result->fetch_assoc();
echo $record['content'];</pre>
        См. также <a href="http://php.net/manual/ru/book.mysqli.php">более подробную</a> информацию по работе с расширением MySQLi.
    </p>
    
    <p>
        Для администрирования базы данных выложенного проекта вы можете использовать <a href="http://dbadmin.itstudent.nsuem.ru">веб-интерфейс</a>, но он доступен только из локальной сети университета.
        Для входа используйте имя пользователя и пароль MySQL, которые отправлены вам при выкладке проекта.
    </p>
</div>
