<?php

    function translit($str) {
        $charsArray = [
            "а" => "a",
            "б" => "b",
            "в" => "v",
            "г" => "g",
            "д" => "d",
            "е" => "e",
            "ё" => "e",
            "ж" => "zh",
            "з" => "z",
            "и" => "i",
            "й" => "y",
            "к" => "k",
            "л" => "l",
            "м" => "m",
            "н" => "n",
            "о" => "o",
            "п" => "p",
            "р" => "r",
            "с" => "s",
            "т" => "t",
            "у" => "u",
            "ф" => "f",
            "х" => "kh",
            "ц" => "ts",
            "ч" => "ch",
            "ш" => "sh",
            "щ" => "shch",
            "ъ" => "",
            "ы" => "y",
            "ь" => "",
            "э" => "e",
            "ю" => "yu",
            "я" => "ya",
            "А" => "A",
            "Б" => "B",
            "В" => "V",
            "Г" => "G",
            "Д" => "D",
            "Е" => "E",
            "Ё" => "E",
            "Ж" => "Zh",
            "З" => "Z",
            "И" => "I",
            "Й" => "Y",
            "К" => "K",
            "Л" => "L",
            "М" => "M",
            "Н" => "N",
            "О" => "O",
            "П" => "P",
            "Р" => "R",
            "С" => "S",
            "Т" => "T",
            "У" => "U",
            "Ф" => "F",
            "Х" => "Kh",
            "Ц" => "Ts",
            "Ч" => "Ch",
            "Ш" => "Sh",
            "Щ" => "Shch",
            "Ы" => "Y",
            "Э" => "E",
            "Ю" => "Yu",
            "Я" => "Ya"
        ];
        foreach ($charsArray as $key => $value) {
            $str = str_replace($key, $value, $str);
        }
        return $str;
    }

    function replaceSpaces1($str) {
        $wordsArray = explode(" ", $str);
        return implode("_", $wordsArray);
    }

    function replaceSpaces2($str) {
        return str_replace(" ", "_", $str);
    }

    function getStringInLatinWithoutSpaces($str) {
        $formattedStr = translit($str);
        return replaceSpaces1($formattedStr);
    }
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GB php-basic lesson3</title>
</head>
<body>
    <h2>1. С помощью цикла while вывести все числа в промежутке от 0 до 100, которые делятся на 3 без остатка.</h2>
    <?php
        $i = 0;
        while ($i <= 100) {
            if ($i % 3 == 0) 
                echo $i."<br>";
            $i++;
        }
    ?>
    <h2>2. С помощью цикла do…while написать функцию для вывода чисел от 0 до 10, чтобы результат выглядел так:</h2>
    <p>0 – ноль.</p>
    <p>1 – нечетное число.</p>
    <p>2 – четное число.</p>
    <p>…</p>
    <p>10 – четное число.</p>

    <?php
        $i = 0;
        do {
            if ($i == 0) {
                echo "$i - ноль.<br>";
            }
            elseif ($i % 2 == 0) {
                echo "$i - четное число.<br>";
            }
            else {
                echo "$i - нечетное число.<br>";
            }
            $i++;
        } while ($i <= 10);
    ?>

    <h2>3. Объявить массив, в котором в качестве ключей будут использоваться названия областей, а в качестве значений – массивы с названиями городов из соответствующей области. Вывести в цикле значения массива</h2>

    <?php
        $regions = [
            "Калиниградская" => [
                "Балтийск",
                "Черняховск",
                "Краснолесье"
            ],
            "Свердловская" => [
                "Каменск-Уральский",
                "Верхотурье",
                "Невьянск"
            ],
            "Иркутская" => [
                "Братск",
                "Саянск",
                "Киренск"
            ]
        ];
        foreach($regions as $key => $value) {
            echo "$key область: <br>";
            echo implode(", ", $value)."<br>";
        }
    ?>

    <h2>4. Объявить массив, индексами которого являются буквы русского языка, а значениями – соответствующие латинские буквосочетания (‘а’=> ’a’, ‘б’ => ‘b’, ‘в’ => ‘v’, ‘г’ => ‘g’, …, ‘э’ => ‘e’, ‘ю’ => ‘yu’, ‘я’ => ‘ya’).
    Написать функцию транслитерации строк.</h2>

    <?php

        if (isset($_GET["text_cyr"])) 
            $strToFormat = $_GET["text_cyr"];
        else $strToFormat = "Съешь ещё этих мягких французских булок, да выпей чаю.";
        echo translit($strToFormat);
    ?>

    <h2>5. Написать функцию, которая заменяет в строке пробелы на подчеркивания и возвращает видоизмененную строчку.</h2>

    <?= replaceSpaces1($strToFormat)."<br>";
        replaceSpaces2($strToFormat);
    ?>

    <h2>7. *Вывести с помощью цикла for числа от 0 до 9, не используя тело цикла. Выглядеть должно так:</h2>
    <p>for (…){ // здесь пусто}</p>

    <?php
        for ($i = 0; $i <= 9; print $i++."<br>") {};
    ?>

    <h2>8. *Повторить третье задание, но вывести на экран только города, начинающиеся с буквы «К».</h2>

    <?php
        foreach($regions as $region => $cities) {
            echo "$region область: <br>";
            $citiesWithK = [];
            foreach($cities as $city) {
                if (strpos($city, "К") === 0 ) {
                    $citiesWithK[] = $city;
                }
            }
            echo implode(", ", $citiesWithK)."<br>";
        }
    ?>

    <h2>9. *Объединить две ранее написанные функции в одну, которая получает строку на русском языке, производит транслитерацию и замену пробелов на подчеркивания (аналогичная задача решается при конструировании url-адресов на основе названия статьи в блогах).</h2>

    <?php
        echo getStringInLatinWithoutSpaces($strToFormat);
    ?>
</body>
</html>
