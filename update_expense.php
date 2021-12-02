<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $expense = [
        'id' => trim($_POST['id']),
        'date' => trim($_POST['date']),
        'account' => trim($_POST['account']),
        'text' => trim($_POST['text']),
        'money' => trim($_POST['money']),
    ];
} else {
    exit;
}
$errors = [];
$title = '支出編集ページ';
$content = __DIR__ . '/views/update_expense.php';
include 'views/layout.php';
