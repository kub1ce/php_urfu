<?php

namespace App;

class MagicClass
{
    private $data = []; // для хранения динамических свойств
    private $privateProperty = 'private value'; // приватное свойство. Доступно только внутри класса
    protected $protectedProperty = 'protected value'; // защищенное свойство. Доступно внутри класса и в наследниках
    public $publicProperty = 'public value'; // публичное свойство. Доступно везде
    
    private static $staticPrivate = 'static private'; // приватное статическое свойство. static от обычного отличается областью видимости
    protected static $staticProtected = 'static protected'; // защищенное статическое свойство
    public static $staticPublic = 'static public'; // публичное статическое свойство

    // вызывается при создании объекта
    public function __construct($param = null) {
        echo "__construct вызван" . PHP_EOL;
        $this->data['created_at'] = date('Y-m-d H:i:s');
    }

    // вызывается при удалении объекта
    public function __destruct() {
        echo "__destruct вызван" . PHP_EOL;
    }

    // вызывается при вызове недоступного метода
    public function __call($name, $arguments) {
        echo "__call вызван для метода: $name" . PHP_EOL;
        return "Результат вызова $name";
    }

    // вызывается при вызове недоступного статического метода
    public static function __callStatic($name, $arguments) {
        echo "__callStatic вызван для статического метода: $name" . PHP_EOL;
        return "Результат статического вызова $name";
    }

    // вызывается при чтении недоступного свойства
    public function __get($name) {
        echo "__get вызван для свойства: $name" . PHP_EOL;
        return isset($this->data[$name]) ? $this->data[$name] : null;
    }

    // вызывается при записи в недоступное свойство
    public function __set($name, $value) {
        echo "__set вызван для свойства: $name = $value" . PHP_EOL;
        $this->data[$name] = $value;
    }

    // вызывается при использовании isset() или empty() на недоступном свойстве
    public function __isset($name) {
        echo "__isset вызван для свойства: $name" . PHP_EOL;
        return isset($this->data[$name]);
    }

    // вызывается при использовании unset() на недоступном свойстве
    public function __unset($name) {
        echo "__unset вызван для свойства: $name" . PHP_EOL;
        unset($this->data[$name]);
    }

    // вызывается перед сериализацией
    public function __sleep() {
        echo "__sleep вызван" . PHP_EOL;
        return ['data', 'publicProperty'];
    }

    // вызывается после десериализации
    public function __wakeup() {
        echo "__wakeup вызван" . PHP_EOL;
    }

    // вызывается при сериализации (объект в строку, которую можно сохранить в базе данных)
    public function __serialize(): array
    {
        echo "__serialize вызван" . PHP_EOL;
        return [
            'data' => $this->data,
            'public' => $this->publicProperty
        ];
    }

    // вызывается при десериализации
    public function __unserialize(array $data): void
    {
        echo "__unserialize вызван" . PHP_EOL;
        $this->data = $data['data'] ?? [];
        $this->publicProperty = $data['public'] ?? '';
    }

    // вызывается при попытке преобразовать объект в строку
    public function __toString(): string
    {
        echo "__toString вызван" . PHP_EOL;
        return "MagicClass object";
    }

    // вызывается при попытке вызвать объект как функцию
    public function __invoke($param = null) {
        echo "__invoke вызван с параметром: " . ($param ?? 'null') . PHP_EOL;
        return "Объект вызван как функция";
    }

    // вызывается для var_export() - превращение объекта в строку валидного кода
    public static function __set_state($properties) {
        echo "__set_state вызван" . PHP_EOL;
        $obj = new self();
        foreach ($properties as $key => $value) {
            $obj->$key = $value;
        }
        return $obj;
    }

    // вызывается при клонировании объекта
    public function __clone() {
        echo "__clone вызван" . PHP_EOL;
        $this->data['cloned_at'] = date('Y-m-d H:i:s');
    }

    // вызывается функцией var_dump()
    public function __debugInfo(): array
    {
        echo "__debugInfo вызван" . PHP_EOL;
        return [
            'data_summary' => 'Массив данных: ' . count($this->data) . ' элементов',
            'publicProperty' => $this->publicProperty,
            'note' => 'Это упрощенное отображение для отладки'
        ];
    }
}
