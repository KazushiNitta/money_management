<?php

require_once __DIR__ . '/lib/Utils.php';
require_once __DIR__ . '/lib/Database.php';

function updateIncome($link, $income)
{
    $sql = <<<EOT
    UPDATE income
    SET date = "{$income['date']}", account = "{$income['account']}", text = "{$income['text']}", money = "{$income['money']}"
    WHERE id = "{$income['id']}"
    EOT;
    $result = mysqli_query($link, $sql);
    if (!$result) {
        error_log('Error: fail to register income');
        error_log('Debugging Error: ' . mysqli_error($link));
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $income = [
        'id' => trim($_POST['id']),
        'date' => trim($_POST['date']),
        'account' => trim($_POST['account']),
        'text' => trim($_POST['text']),
        'money' => trim($_POST['money']),
    ];

    $errors = Utils::validate($income);
    if (!count($errors)) {
        $link = Database::Connect();
        updateIncome($link, $income);
        mysqli_close($link);
        header("Location: index.php");
    }
}

$title = '収入編集ページ';
$content = __DIR__ . '/views/update_income.php';
include 'views/layout.php';
