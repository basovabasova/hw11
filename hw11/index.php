<?php

require_once 'functions.php';

$skoda = new \hw11\classes\Car('white', 'SCODA Octavia II', 'auto', 450000, 1800);
if (!$skoda -> isHighSpeed()) echo 'Я не разбираюсь в машинах' . '<br>';
$skoda -> getFullDescription();
echo '<hr>';

$lg = new \hw11\classes\TV('LG 24LH451U', 'LED', 24, 12480, 15);
$lg -> getFullDescription();
$lg -> setYear(2017);
$arrLg = (array)$lg;
echo "{$arrLg['year']} год";
echo '<hr>';

$trueDuck = new \hw11\classes\Duck('true', 'Настоящая Утка', 2200, 2);
$homeDuck = new \hw11\classes\Duck('home', 'Домашняя Утка', 4500, 3);
$trueDuck -> getFullDescription();
$homeDuck -> getFullDescription();
$homeDuck -> getQuestion();
if ($homeDuck -> isAlive()) echo 'Живая!' . '<br>';
echo '<hr>';

$parker = new \hw11\classes\Pen('Parker Premier - Custom Tartan ST', 'black', 'a fountain pen', 45300, 0.04);
$waterman = new \hw11\classes\Pen('Waterman Carene - Contemporary White ST', 'red', 'ballpen', 21400, 0.05);
$parker -> getFullDescription();
$parker -> getNewPen();
$waterman -> getFullDescription();
$waterman -> getNewPen();
echo '<hr>';

$basket = new \hw11\classes\Basket();
$basket -> addProduct($skoda); 
$basket -> addProduct($lg); 
$basket -> addProduct($trueDuck); 
$basket -> addProduct($homeDuck); 
$basket -> addProduct($parker); 
$basket -> addProduct($parker); 
$basket -> addProduct($waterman);
$basket -> deleteOneProduct($parker);
//$basket -> showBasket();
echo '<hr>';

$order = new \hw11\classes\Order($basket);
$order -> getBasket();
echo '<hr>';
?>

<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <title>Пространства имен, перегрузка и встр.интерфейсы и классы</title>
</head>
<body>
  <p>Пространства имен. Например, есть два файла с одинаковым названием в разных папках. В начале файла нужно указать пространство имен как путь к файлу. Тогда все содержимое файла - классы, константы и функции - принадлежит указанному пространству имен. Если пространство имен не указано - принаддежит глобальному пространству имен.</p>
  <p>Исключения - метод обработки ошибок с помощью класса Exception. Объект наследуется от Exception. Блок try содержит код, генерирующий исключение с помощью оператора throw. Оператор catch ловит исключения. </p>
</body>
</html>