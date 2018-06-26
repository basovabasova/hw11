<?php

//__get($property); - вызывается при обращении к недоступному свойству
class TestClass
{
    public function __get($property) //С помощью данного метода мы можем разрешить обращаться к недоступному свойству
    {
        echo "обратились к недоступному свойству - $property" . '<br>';
    }
}
$test = new TestClass();
echo $test -> a;//аналогично вызову $test->__get('a')
echo $test -> __get('lalala');

class TestClass1
{
    private $privateProperty;
    protected $protectedProperty;

    public function __get($property)
    {
        echo "обратились к недоступному свойству - $property" . '<br>';
    }
}
$test1 = new TestClass1();
echo $test1 -> privateProperty;//аналогично вызову $test->__get('privateProperty')
echo $test1 -> __get('protectedProperty');

class TestClass2
{
    private $privateProperty = 10;
    protected $protectedProperty = 158;

    public function __get($property)
    {// лайфхак - так мы открываем доступ к обращению к приватным и защищенным свойствам
        if (isset($this -> $property))
            return $this -> $property;
    }
}
$test2 = new TestClass2();
echo $test2 -> privateProperty . '<br>';// выведет 10
echo $test2 -> __get('protectedProperty') . '<br>';// выведет 158
//На самом деле, так делать не надо, иначе мы теряем все преимущества
//областей видимости и можем столкнуться с неожидаемым поведением.
//Но при этом, это даёт нам возможность полного контроля доступа к
//свойствам, т.е. делает работу с объектами более гибкой.

class TestClass3
{
    public $property = 10;
    
    public function __get($property)
    {// лайфхак - так мы открываем доступ к обращению к приватным и защищенным свойствам
        if (isset($this -> $property))
            echo "вызвано недоступное свойство" . '<br>';
    }
}
$test3 = new TestClass3();
echo $test3 -> property . '<br>';//для public - __get не вызывается! 
echo '<hr>';
//   Мини-резюме по __get
//1. Единственный аргумент содержит название недоступного свойства в виде строки
//2. Должен быть объявлен, как public
//3. Вызывается при событии: обращение к недоступному свойству
//4. Не вызывается, для публичных свойств класса
//5. Вызывается для private и protected
//6. Может содержать внутри любую логику для разных свойств


//__set($property, $value); - вызывается при попытке дать значение недоступному свойству
class TestClass4
{
    private $privateProperty = 10;
    // $name - строка-название свойства, $value - значение для присвоения
    public function __set($name, $value)
    {// запретили менять значения недоступных свойств
        echo "Ошибка - попытка присвоения значения недоступному свойству" . '<br>';
    }
}
$test4 = new TestClass4();
$test4 -> privateProperty = 20;
$test4 -> __set('privateProperty', 158);
$test4 -> __set('privateProperty', 'jdghladjgb');

class TestClass5
{
    private $privateProperty = 10;
    public function __set($name, $value)
    { 
        $this -> $name = $value;
    }
}
$test5 = new TestClass5();
$test5 -> privateProperty = 20;
print_r($test5);
echo '<br>';
//Таким образом мы можем, например, разрешать доступ только к
//приватным переменным, или создавать динамические свойства, запрешая
//доступ к существующим, если они приватные или защищенные.

//АВТОМАТИЧЕСКИЕ ГЕТТЕРЫ И СЕТТЕРЫ
class TestClass6
{
    private $data = [];
    public function __set($name, $value)//данные присваиваем
    { 
        $this -> data[$name] = $value;
    }
    public function __get($name)//данные получаем
    { 
        if (isset($this -> data[$name])) {
            return $this -> data[$name];
        }
    }
}
$testArr = new TestClass6();
$testArr -> data = 158;
echo $testArr -> data . '<br>';
print_r($testArr);
echo '<hr>';
//   Мини-резюме по __set
//1. $name - строка , название свойства, $value - значение, которое нужно присвоить
//2. Должен быть объявлен, как public
//3. Вызывается при событии: присвоение значения недоступному свойству
//4. Не вызывается, для публичных свойств класса
//5. Вызывается для private и protected
//6. Может содержать внутри любую логику для разных свойств


// __isset($property); - вызывается при вызове isset() на недоступном свойстве
class TestClass7
{
    public $publicProperty = 954;
    protected $property = 10;
    // $property - строка-название свойства
    public function __isset($property) //__isset срабатывает при вызове isset нa несуществующем свойствe
    { 
        echo 'Ошибка - недоступное свойство' . '<br>';
    }
}
$test7 = new TestClass7();
isset($test7 -> property);
isset($test7 -> publicProperty);
print_r($test7);
echo '<hr>';

// __unset($property); - вызывается при вызове unset() на недоступномnсвойств
class TestClass8
{
    public $publicProperty = 954;
    private $property = 158;
    // $property - строка-название свойства
    public function __unset($property) //__unset вызывается при попытке удалить свойство. public-свойства - можно
    { 
        echo 'Ошибка - наши скрытые свойства удалять нельзя' . '<br>';
    }
}
$test8 = new TestClass8();
unset($test8 -> publicProperty);
unset($test8 -> property);
print_r($test8);
echo '<hr>';
//Мини-резюме по __unset и __isset
//1. $name - строка , название свойства
//2. Должны быть объявлен, как public
//3. Вызывается при событии: проверка свойства на существование (__isset) либо удаление свойства (__unset)
//4. Не вызывается, для публичных свойств класса
//5. Вызывается для private и protected
//6. Может содержать внутри любую логику для разных свойств

//Например, мы можем захотеть, чтобы ни одно наше свойство нельзя было заансетить.
//В этом случае можно объявить все свойства приватными или
//защищенными, прописать соответствующую ошибку в __unset, а в __get и
//__set прописать к каким свойствам можно обращаться

class TestClass9
{
    public function __call($methodName, $arguments) //__call вызывается для недоступных методов, первый аргумент - строка, название метода, а второй - массив аргументов
    { 
        echo 'Вызван метод - ' . $methodName . ' с параметрами: ' . '<br>';
        var_dump($arguments);
        echo '<br>';
    }
}
$test9 = new TestClass9();
$test9 -> someMethod(123, 234, 345);//__call('someMethod', [123, 234, 345])

class TestClass10
{
    public static function __callStatic($methodName, $arguments) //__call вызывается для недоступных статических методов, первый аргумент - строка, название метода, а второй - массив аргументов
    { 
        echo 'Вызван статический метод - ' . $methodName . ' с параметрами: ' . '<br>';
        var_dump($arguments);
    }
}
TestClass10::someMethod(123, 234, 345);//__call('someMethod', [123, 234, 345])
echo '<hr>';

// __CALLSTATIC И __CALL
//1. __callStatic должен быть объявлен как статический метод
//2. __callStatic вызывается, если мы обращаемся к методу класса
//3. __call вызывается, если мы обращаемся к методу объекта
//4. Все они должны быть объявлены, как public
//5. Первый аргумент - всегда строка, с названием метода к которому обращаемся
//6. Существующие публичные методы не вызывают срабатывания этих методов

// $className содержит название класса, который мы вызываем
function myAutoload($className)
{
    $filePath = './classes/' . $className . '.php';
    if (file_exists($filePath)) {
        include "$filePath";
    } //else {
        //die ('Класса $className не существует');
    //}
        //die мы убрали, т.к. предполагаем, что будут и иные автозагрузчики после
}

function coreAutoloader($className)
{ //прошлый искал классы в classes, этот берет из core
    $filePath = './core/' . $className . '.php';
    if (file_exists($filePath)) {
        include "$filePath";
    }//и тут без die 
}

spl_autoload_register('myAutoload');
spl_autoload_register('coreAutoloader');
$fun = new Fun(158);

// 1. Сперва TestClass11 будет искаться в myAutoload - myAutoload('TestClass');
// 2. Затем TestClass11 будет искаться в coreAutoloader - coreAutoloader('TestClass11');
// 3. Если класс не будет нигде найден - будет fatal
/*
spl_autoload_register(//Можно регистрировать автозагрузчики без создания функций:
    function ($className) {
        include $className . '.php';
    }
);*/
echo '<hr>';

//ПРОСТРАНСТВА ИМЁН 

function myAutoload1($classNameWithNamespace)
{//учитываем пространство имён
    $pathToFile = str_replace("/", DIRECTORY_SEPARATOR, $_SERVER['DOCUMENT_ROOT']) //ищем файлы начиная от document_root
    . DIRECTORY_SEPARATOR 
    . str_replace("/", DIRECTORY_SEPARATOR, $classNameWithNamespace) 
    . '.php'; //добавляем расширение
    if (file_exists($pathToFile)) {
        include "$pathToFile";
    } else {
        echo 'Ошибка';
    }
}//Данная функция будет работать, если namespace дублирует расположение файлов с классами в директориях. Охуеть функция ну
//echo "<pre>";
//print_r($_SERVER);
spl_autoload_register('myAutoload1');
//myAutoload('\Core\Test(158)');
$test = new \Hw11\lesson\Core\Test(158);
echo ' ' . \hw11\lesson\Core\MY_CONST . ' ' . \hw11\lesson\Core\myFunction() . ' ' . \hw11\lesson\Core\Test::class;
echo '<hr>';

/*interface ArrayAccess 
{    //проверяет, существует ли смещение (ключ)
    abstract public offsetExists ( mixed $offset )
    
    //получает значение с индексом
    abstract public offsetGet ( mixed $offset )
    
    //задает значение с соответствующим индексом
    abstract public offsetSet ( mixed $offset , mixed $value)
    
    //удаляет значение с соответствующим индексом
    abstract public offsetUnset ( mixed $offset )
}*/

class TestClass12 implements \ArrayAccess //в глобальном пространстве имён
{
    private $data = ['test', 'test2', 'test3'];
    public function offsetSet($index, $value) 
    {
        if (is_null($index)) {
            $this -> data[] = $value; //добавление значения без ключа
        } else {
            $this -> data[$index] = $value;
        }
    }

    public function offsetExists($index) 
    {
        return isset($this -> data[$index]);
    } 

    public function offsetUnset($index) 
    {
        unset($this -> data[$index]);
    } 

    public function offsetGet($index) 
    {
        return isset($this -> data[$index]) ? $this -> data[$index] : null;
    }
}

$test = new TestClass12();
$test[] = 'Новый элемент массива';//offsetSet
echo $test[] = 'Еще новый элемент массива' . '<br>';
echo $test[1] . '<br>'; //выведет test2 //offsetGet
//echo "<pre>";
//print_r($test);
if (isset($test[1])) echo 'true' . '<br>'; //true //offsetExists
unset($test[1]);//offsetUnset
if (!isset($test[1])) echo 'true'; //true
//print_r($test);
echo '<hr>';

// ИСКЛЮЧЕНИЯ

class MyException extends \Exception {}

try {
    throw new Exception('Какое-нибудь сообщение об ошибке'. '<br>');
} catch(Exception $e) {
    echo $e -> getMessage();
}

function throwMyException() //функция просто выбрасывает исключение
{
    throw new MyException('Деление на ноль!');
} 

try {
    throwMyException();
} catch (\MyException $e) {
    echo 'Отловлено моё исключение, но ничего страшного'. '<br>';
} 

function inverse($x) {
    if (!$x) {
        throw new Exception('Деление на ноль.');
    }
    return 1/$x;
}

try {
    echo inverse(5) . "\n";
    echo inverse(0) . "\n";
} catch (Exception $e) {
    echo 'Выброшено исключение: ',  $e -> getMessage();
}
echo '<hr>';