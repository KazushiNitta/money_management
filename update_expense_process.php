<?php

require_once __DIR__ . '/lib/mysqli.php';

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

function validate($expense)
{
    $errors = [];

    // 日付
    $dates = explode("-", $expense['date']);
    if (!strlen($expense['date'])) {
        $errors['date'] = '日付を入力してください。';
    } elseif (count($dates) !== 3) {
        $errors['date'] = '正しい形式で日付を入力してください。';
    } elseif (!checkdate($dates[1], $dates[2], $dates[0])) {
        $errors['date'] = '正しい形式で日付を入力してください。';
    }

    // 科目
    if (!strlen($expense['account'])) {
        $errors['account'] = '科目を入力してください。';
    } elseif (strlen($expense['account']) > 100) {
        $errors['account'] = '科目は100文字以内で入力してください。';
    }

    // 摘要
    if (!strlen($expense['text'])) {
        $errors['text'] = '摘要を入力してください。';
    } elseif (strlen($expense['text']) > 255) {
        $errors['text'] = '摘要は255文字以内で入力してください。';
    }

    // 金額
    if (!strlen($expense['money']) || ((int) $expense['money'] === 0)) {
        $errors['money'] = '金額を入力してください。';
    } elseif (!is_int((int) $expense['money'])) {
        $errors['money'] = '金額は半角数字で入力してください。';
    }

    return $errors;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $expense = [
        'id' => trim($_POST['id']),
        'date' => trim($_POST['date']),
        'account' => trim($_POST['account']),
        'text' => trim($_POST['text']),
        'money' => trim($_POST['money']),
    ];

    $errors = validate($expense);
    if (!count($errors)) {
        $link = dbConnect();
        updateExpense($link, $expense);
        mysqli_close($link);
        header("Location: index.php");
    }
}

$title = '支出編集ページ';
$content = __DIR__ . '/views/update_expense.php';
include 'views/layout.php';
