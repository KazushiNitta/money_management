<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $income = [
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
$title = '収入編集ページ';
$content = __DIR__ . '/views/update_income.php';
include 'views/layout.php';
