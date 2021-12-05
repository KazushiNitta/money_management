<?php

require_once __DIR__ . '/lib/Utils.php';
require_once __DIR__ . '/lib/Database.php';

function registerExpense($link, $expense)
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
    $result = mysqli_query($link, $sql);
    if (!$result) {
        error_log('Error: fail to register income');
        error_log('Debugging Error: ' . mysqli_error($link));
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $expense = [
        'date' => trim($_POST['date']),
        'account' => trim($_POST['account']),
        'text' => trim($_POST['text']),
        'money' => trim($_POST['money']),
    ];

    $errors = Utils::validate($expense);
    if (!count($errors)) {
        $link = Database::Connect();
        registerExpense($link, $expense);
        mysqli_close($link);
        header("Location: index.php");
    }
}

$title = '支出登録ページ';
$content = __DIR__ . '/views/register_expense.php';
include 'views/layout.php';
