<?php

require_once __DIR__ . '/Database.php';

class Expense extends Database
{
    public static function register($expense)
    {
        $sql = <<<EOT
        INSERT INTO expense (
            date,
            account,
            text,
            money
        ) VALUES (
            "{$expense['date']}",
            "{$expense['account']}",
            "{$expense['text']}",
            "{$expense['money']}"
        )
        EOT;
        $link = Expense::connect();
        $result = mysqli_query($link, $sql);
        if (!$result) {
            error_log('Error: fail to register income');
            error_log('Debugging Error: ' . mysqli_error($link));
        }
        mysqli_close($link);
    }

    public static function update($expense)
    {
        $sql = <<<EOT
        UPDATE expense
        SET date = "{$expense['date']}", account = "{$expense['account']}", text = "{$expense['text']}", money = "{$expense['money']}"
        WHERE id = "{$expense['id']}"
        EOT;
        $link = Expense::connect();
        $result = mysqli_query($link, $sql);
        if (!$result) {
            error_log('Error: fail to register income');
            error_log('Debugging Error: ' . mysqli_error($link));
        }
        mysqli_close($link);
    }

    public static function delete($expense)
    {
        $sql = "DELETE FROM expense WHERE id = {$expense['id']};";
        $link = Expense::connect();
        $result = mysqli_query($link, $sql);
        if (!$result) {
            error_log('Error: fail to register income');
            error_log('Debugging Error: ' . mysqli_error($link));
        }
        mysqli_close($link);
    }
}
