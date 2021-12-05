<?php

require_once __DIR__ . '/lib/Utils.php';
require_once __DIR__ . '/lib/Expense.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $expense = [
        'date' => trim($_POST['date']),
        'account' => trim($_POST['account']),
        'text' => trim($_POST['text']),
        'money' => trim($_POST['money']),
    ];

    $errors = Utils::validate($expense);
    if (!count($errors)) {
        Expense::register($expense);
        header("Location: index.php");
    }
}

$title = '支出登録ページ';
$content = __DIR__ . '/views/register_expense.php';
include 'views/layout.php';
