<?php

$expense = [
    'date' => "",
    'account' => "",
    'text' => "",
    'money' => 0,
];
$errors = [];
$title = '支出登録ページ';
$content = __DIR__ . '/views/register_expense.php';
include 'views/layout.php';
