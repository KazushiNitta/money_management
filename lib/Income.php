<?php

require_once __DIR__ . '/Database.php';

class Income extends Database
{
    public static function register($income)
    {
        $sql = <<<EOT
        INSERT INTO income (
            date,
            account,
            text,
            money
        ) VALUES (
            "{$income['date']}",
            "{$income['account']}",
            "{$income['text']}",
            "{$income['money']}"
        )
        EOT;
        $link = Income::connect();
        $result = mysqli_query($link, $sql);
        if (!$result) {
            error_log('Error: fail to register income');
            error_log('Debugging Error: ' . mysqli_error($link));
        }
        mysqli_close($link);
    }

    public static function update($income)
    {
        $sql = <<<EOT
        UPDATE income
        SET date = "{$income['date']}", account = "{$income['account']}", text = "{$income['text']}", money = "{$income['money']}"
        WHERE id = "{$income['id']}"
        EOT;
        $link = Income::connect();
        $result = mysqli_query($link, $sql);
        if (!$result) {
            error_log('Error: fail to register income');
            error_log('Debugging Error: ' . mysqli_error($link));
        }
        mysqli_close($link);
    }

    public static function delete($income)
    {
        $sql = "DELETE FROM income WHERE id = {$income['id']};";
        $link = Income::connect();
        $result = mysqli_query($link, $sql);
        if (!$result) {
            error_log('Error: fail to register income');
            error_log('Debugging Error: ' . mysqli_error($link));
        }
        mysqli_close($link);
    }
}
