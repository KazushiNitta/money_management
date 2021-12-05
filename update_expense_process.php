<?php

require_once __DIR__ . '/lib/Utils.php';
require_once __DIR__ . '/lib/Database.php';

function updateExpense($link, $expense)
{
    $sql = <<<EOT
    UPDATE expense
    SET date = "{$expense['date']}", account = "{$expense['account']}", text = "{$expense['text']}", money = "{$expense['money']}"
    WHERE id = "{$expense['id']}"
    EOT;
    $result = mysqli_query($link, $sql);
    if (!$result) {
        error_log('Error: fail to register income');
        error_log('Debugging Error: ' . mysqli_error($link));
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $expense = [
        'id' => trim($_POST['id']),
        'date' => trim($_POST['date']),
        'account' => trim($_POST['account']),
        'text' => trim($_POST['text']),
        'money' => trim($_POST['money']),
    ];

    $errors = Utils::validate($expense);
    if (!count($errors)) {
        $link = Database::Connect();
        updateExpense($link, $expense);
        mysqli_close($link);
        header("Location: index.php");
    }
}

$title = '支出編集ページ';
$content = __DIR__ . '/views/update_expense.php';
include 'views/layout.php';
