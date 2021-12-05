<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GB PHP-BASIC lesson6</title>
</head>
<body>
    <form action="calculate.php" method = "post">
        <h3>Калькулятор задание 1</h3>
        <input type="number" name = "operand1" value = <?= $_GET['operand1']?>>
        <select name="operation" name = "operation">
            <option value="+">+</option>
            <option value="-">-</option>
            <option value="*">*</option>
            <option value="/">/</option>
        </select>
        <input type="number" name = "operand2" value = <?= $_GET['operand2']?>>
        <input type="submit" value = "=">
        <?php
            if ($_GET['result']) {
                echo $_GET['result'];
            }
        ?>
        <br>
        <a href="task1.php">Очистить все</a>
    </form>
</body>
</html>