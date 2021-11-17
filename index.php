<?php

    function sum($a, $b) {
        return $a+$b;
    }

    function sub($a, $b) {
        return $a-$b;
    }

    function mul($a, $b) {
        return $a*$b;
    }

    function div($a, $b) {
        return $a/$b;
    }

    function mathOperation($arg1, $arg2, $operation) {
        switch ($operation) {
            case '+':
                return sum($arg1, $arg2);
                break;
            case '-':
                return sub($arg1, $arg2);
                break;
            case '*':
                return mul($arg1, $arg2);
                break;
            case '/':
                return div($arg1, $arg2);
                break;
            default:
                return "Передан неизвестный символ арифметической операции $operation";
        }
    }

    function power($val, $pow) {
        if ((int)$pow <= 1 || !is_numeric($val)) {
            return "Error";
        }
        if ($pow === 2) $res = $val * $val;
        else $res = $val * power($val, $pow - 1);
    
        return $res;
    }

    function getStringValue($number, $strArr) {
//Здесь нет контроля входных значений, так как подразумевается, что функция не работает с пользовательским вводом
//а получает входные параметры из проверенной функции
        if ($number >= 11 && $number <= 19) {
            return $strArr[2];
        } elseif ($number % 10 == 1) {
            return $strArr[0];
        } elseif ($number % 10 >= 2 && $number % 10 <= 4) {
            return $strArr[1];
        } else {
            return $strArr[2];
        }
    }

    function returnTimeInString() {
        $hours = date('H');
        $minutes = date('i');
        $resStr = $hours.' '.getStringValue($hours, ['час', 'часа', 'часов']).' ';
        $resStr .= $minutes.' '.getStringValue($minutes, ['минута', 'минуты', 'минут']);
        return $resStr;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GB php-basic lesson2</title>
</head>
<body>
    <h1>Урок 2. Условные блоки, ветвление функции</h1>
    <h2>Задание1. Объявить две целочисленные переменные $a и $b и задать им произвольные начальные значения. Затем написать скрипт, который работает по следующему принципу:</h2>
    <ul>
        <li>если $a и $b положительные, вывести их разность;</li>
        <li>если $а и $b отрицательные, вывести их произведение;</li>
        <li>если $а и $b разных знаков, вывести их сумму;</li>
    </ul>
    <p>Ноль можно считать положительным числом.</p>

    <?php
        $a = rand(-50, 50);
        $b = rand(-30, 30);
    ?>
    <p>Сгенерили 2 числа: <?= $a ?> и <?= $b ?></p>
    <?php
        if ($a >= 0 && $b >= 0) {
            $res = mathOperation($a, $b, '-');
            echo "Оба числа положительные, выводим их разность. Результат: $res";
        } elseif ($a < 0 && $b < 0) {
            $res = mathOperation($a, $b, '*');
            echo "Оба числа отрицательные, выводим их произведение. Результат: $res";
        } else {
            $res = mathOperation($a, $b, '+');
            echo "Числа разных знаков, выводим их сумму. Результат: $res";
        }
    ?>
    <h2>Задание 2. Присвоить переменной $а значение в промежутке [0..15]. С помощью оператора switch организовать вывод чисел от $a до 15.</h2>
    <?php
        $a = rand(0, 15);
        switch ($a) {
            case 0:
                echo '0<br>';
            case 1:
                echo '1<br>';
            case 2:
                echo '2<br>';
            case 3:
                echo '3<br>';
            case 4:
                echo '4<br>';
            case 5:
                echo '5<br>';
            case 6:
                echo '6<br>';
            case 7:
                echo '7<br>';
            case 8:
                echo '8<br>';
            case 9:
                echo '9<br>';
            case 10:
                echo '10<br>';
            case 11:
                echo '11<br>';
            case 12:
                echo '12<br>';
            case 13:
                echo '13<br>';
            case 14:
                echo '14<br>';
            case 15:
                echo '15<br>';
                break;
            default:
                echo "Указанное число не входит в диапазон от 0 до 15";
                break;
        }
    ?>
    <h2>Задание 3. Реализовать основные 4 арифметические операции в виде функций с двумя параметрами. Обязательно использовать оператор return.</h2>
    <p>Сделал в решении к 1 заданию</p>
    <h2>Задание 4. Реализовать функцию с тремя параметрами: function mathOperation($arg1, $arg2, $operation), где $arg1, $arg2 – значения аргументов, $operation – строка с названием операции. В зависимости от переданного значения операции выполнить одну из арифметических операций (использовать функции из пункта 3) и вернуть полученное значение (использовать switch).</h2>
    <p>Сделал в решении к 1 заданию</p>
    <h2>Задание 6. *С помощью рекурсии организовать функцию возведения числа в степень. Формат: function power($val, $pow), где $val – заданное число, $pow – степень.</h2>
    <?php
        $power = $_GET['pow'];
        $value = $_GET['val'];
        $powRes = power($value, $power);
        echo "$value в степени $power будет $powRes";
    ?>
    <h2>Задание 7. *Написать функцию, которая вычисляет текущее время и возвращает его в формате с правильными склонениями, например:</h2>
    <ul>
        <li>22 часа 15 минут</li>
        <li>21 час 43 минуты</li>
    </ul>
    <?= returnTimeInString() ?>
</body>
</html>