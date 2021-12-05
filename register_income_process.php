<?php

require_once __DIR__ . '/lib/Utils.php';
require_once __DIR__ . '/lib/Income.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $income = [
        'date' => trim($_POST['date']),
        'account' => trim($_POST['account']),
        'text' => trim($_POST['text']),
        'money' => trim($_POST['money']),
    ];

    $errors = Utils::validate($income);
    if (!count($errors)) {
        Income::register($income);
        header("Location: index.php");
    }
}

$title = '収入登録ページ';
$content = __DIR__ . '/views/register_income.php';
include 'views/layout.php';
