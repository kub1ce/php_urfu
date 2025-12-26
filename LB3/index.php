<?php
require 'vendor/autoload.php';

use App\MagicClass;

echo "=== Демонстрация магических методов PHP ===\n\n";

// 1. создание объекта, вызовет __construct
echo "1. __construct:\n";
$obj = new MagicClass();
echo "   Объект создан\n\n";

// 2. установление и получение свойств, вызовет __set и __get соответственно
echo "2. __set и __get:\n";
$obj->dynamicProperty = 'test value'; // вызовет __set
echo "   Значение: " . $obj->dynamicProperty . "\n\n"; // вызовет __get

// 3. использование isset() и unset() на недоступном свойстве, вызовет __isset и __unset соответственно
echo "3. __isset и __unset:\n";
echo "   isset(dynamicProperty): " . (isset($obj->dynamicProperty) ? 'true' : 'false') . "\n";
unset($obj->dynamicProperty);
echo "   После unset isset(dynamicProperty): " . (isset($obj->dynamicProperty) ? 'true' : 'false') . "\n\n";

// 4. вызов несуществующего метода вызовет __call
echo "4. __call:\n";
$result = $obj->undefinedMethod('param1', 'param2');
echo "   Результат: $result\n\n";

// 5. вызов несуществующего статического метода вызовет __callStatic
echo "5. __callStatic:\n";
$result = MagicClass::undefinedStaticMethod();
echo "   Результат: $result\n\n";

// 6. Преобразование объекта в строку, __toString
echo "6. __toString:\n";
echo "   " . $obj . "\n\n";

// 7. вызов объекта как функции, __invoke
echo "7. __invoke:\n";
$result = $obj('параметр');
echo "   Результат: $result\n\n";

// 8. __sleep и __wakeup (сериализация)
echo "8. Сериализация (__sleep, __wakeup):\n";
$serialized = serialize($obj);
echo "   Объект сериализован\n";
$unserialized = unserialize($serialized);
echo "   Объект десериализован\n\n";

// 9. Клонирование объекта, __clone
echo "9. __clone:\n";
$clone = clone $obj;
echo "   Объект склонирован\n\n";

// 10. вывод через var_dump -> __debugInfo
echo "10. __debugInfo:\n";
var_dump($obj);
echo "\n";

// 11. var_export -> __set_state
echo "11. __set_state:\n";
$exported = var_export($obj, true);
echo "   Объект экспортирован\n";
eval('\$newObj = ' . $exported . ';');

// 12. __destruct будет вызван завершении скрипта
echo "\nСкрипт завершается, сейчас вызовется __destruct...\n";

// ====== ====== ======

use App\Point;
use App\Vector;

echo "=== Реализуем геометрию в ООП ===\n\n";

// 1. Создаем точку T1 с произвольными координатами
echo "1. Создаем точку T1 с произвольными координатами\n";
$T1 = new Point(3, 4);
echo "   $T1\n\n";

// 2. Создаем произвольный вектор V1
echo "2. Произвольный вектор V1:\n";
$V1 = new Vector(5, 2);
echo "   $V1\n\n";

// 3. Создаем нулевой вектор V2
echo "3. Создаем нулевой вектор V2:\n";
$V2 = Vector::zero();
echo "   $V2\n\n";

// 4. Создаем вектор V3, перпендикулярный V1
echo "4. Создаем вектор V3, перпендикулярный V1:\n";
$V3 = $V1->getPerpendicular();
echo "   $V3\n\n";

// 5. Длины векторов
echo "5. Длины векторов:\n";
echo "|_ Длина V1: " . number_format($V1->length(), 4) . "\n";
echo "|_ Длина V2: " . number_format($V2->length(), 4) . "\n";
echo "|_ Длина V3: " . number_format($V3->length(), 4) . "\n\n";

// 6. Проверка перпендикулярности V3 и V1
echo "6. Проверка перпендикулярности V3 и V1:\n";
if ($V1->isPerpendicularTo($V3)) {
    echo "   + Векторы V1 и V3 перпендикулярны\n";
} else {
    echo "   Х Векторы V1 и V3 НЕ перпендикулярны\n";
}

// Проверка V2 на нулевой вектор
echo "   Проверка V2 на нулевой вектор:\n";
if ($V2->isZero()) {
    echo "   + V2 является нулевым вектором\n";
} else {
    echo "   Х V2 НЕ является нулевым вектором\n";
}
echo "\n";

// 7. Переносим точку T1 на вектор V1
echo "7. Переносим точку T1 на вектор V1\n";
echo "   Исходная точка Т1: $T1\n";
echo "   Вектор переноса V1: $V1\n";

$T1->translateByVector($V1);
echo "   Точка T1 после переноса: $T1\n\n";


// Проверка различных векторов на перпендикулярность
echo "Проверка различных векторов на перпендикулярность:\n";

$testVectors = [
    [new Vector(1, 0), new Vector(0, 1), "Вертикальный и горизонтальный"],
    [new Vector(2, 3), new Vector(-3, 2), "Произвольные"],
    [new Vector(1, 2), new Vector(2, -1), "Еще один пример"],
];

foreach ($testVectors as $i => [$v1, $v2, $description]) {
    $result = $v1->isPerpendicularTo($v2) ? "+ перпендикулярны" : "X НЕ перпендикулярны";
    echo sprintf("  %d. %s: $result\n", $i + 1, $description);
    echo sprintf("     v1 = %s, v2 = %s, скалярное произведение = %.2f\n", 
        $v1, $v2, $v1->getX() * $v2->getX() + $v1->getY() * $v2->getY());
}
