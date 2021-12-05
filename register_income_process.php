<?php

require_once __DIR__ . '/lib/Utils.php';
require_once __DIR__ . '/lib/Database.php';

function registerIncome($link, $income)
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
    $result = mysqli_query($link, $sql);
    if (!$result) {
        error_log('Error: fail to register income');
        error_log('Debugging Error: ' . mysqli_error($link));
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $income = [
        'date' => trim($_POST['date']),
        'account' => trim($_POST['account']),
        'text' => trim($_POST['text']),
        'money' => trim($_POST['money']),
    ];

    $errors = Utils::validate($income);
    if (!count($errors)) {
        $link = Database::Connect();
        registerIncome($link, $income);
        mysqli_close($link);
        header("Location: index.php");
    }
}

$title = '収入登録ページ';
$content = __DIR__ . '/views/register_income.php';
include 'views/layout.php';
