<?php
    if ($_POST['operand1'] === '' || $_POST['operand2'] === '') {
        $result = "Не указано одно из чисел";
    }
    switch($_POST['operation']) {
        case '+':
            $result = (float)$_POST['operand1'] + (float)$_POST['operand2'];
            break;
        case '-':
            $result = (float)$_POST['operand1'] - (float)$_POST['operand2'];
            break;
        case '*':
            $result = (float)$_POST['operand1'] * (float)$_POST['operand2'];
            break;
        case '/':
            if ((float)$_POST['operand2'] == 0) {
                $result = "На ноль делить нельзя!";
            } else {
                $result = round((float)$_POST['operand1'] / (float)$_POST['operand2'], 4);
            }
            break;
        default:
            $result = "Неизвестная математическая операция!";
    }
    header("Location: {$_SERVER['HTTP_REFERER']}?result=$result&operand1={$_POST['operand1']}&operand2={$_POST['operand2']}");

?>