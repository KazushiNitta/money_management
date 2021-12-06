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

    public static function get()
    {
        $expenses = [];
        $sql = 'SELECT id, date, account, text, money FROM expense;';
        $link = Expense::connect();
        $result = mysqli_query($link, $sql);

        while ($expense = mysqli_fetch_assoc($result)) {
            $expenses[] = $expense;
        }

        mysqli_free_result($result);
        mysqli_close($link);
        return $expenses;
    }

    public static function getSum()
    {
        $sql = 'SELECT SUM(money) FROM expense;';
        $link = Expense::connect();
        $result = mysqli_query($link, $sql);
        $sumExpense = mysqli_fetch_assoc($result);
        mysqli_free_result($result);
        mysqli_close($link);
        return (int) $sumExpense['SUM(money)'];
    }
}
