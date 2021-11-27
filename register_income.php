<?php

$income = [
    'date' => "",
    'account' => "",
    'text' => "",
    'money' => 0,
];
$errors = [];
$title = '収入登録ページ';
$content = __DIR__ . '/views/register_income.php';
include 'views/layout.php';
