<?php

require_once __DIR__ . '/lib/mysqli.php';

function registerExpense($link, $expense)
{
    $sql = <<<EOT
    INSERT INTO expense (
        date,
        account,
        text,
        money
    ) VALUES (
        "{$expense['date']}",
        "{$expense['account']}",
        "{$expense['text']}",
        "{$expense['money']}"
    )
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
        $errors['date'] = "日付を入力してください。";
    } elseif (count($dates) !== 3) {
        $errors['date'] = "正しい形式で日付を入力してください。";
    } elseif (!checkdate($dates[1], $dates[2], $dates[0])) {
        $errors['date'] = '正しい形式で日付を入力してください。';
    }

    // 科目
    if (!strlen($expense['account'])) {
        $errors['account'] = "科目を入力してください。";
    } elseif (strlen($expense['account']) > 100) {
        $errors['account'] = '科目は100文字以内で入力してください。';
    }

    // 摘要
    if (!strlen($expense['text'])) {
        $errors['text'] = "摘要を入力してください。";
    } elseif (strlen($expense['text']) > 255) {
        $errors['text'] = '科目は255文字以内で入力してください。';
    }

    // 金額
    if (!strlen($expense['money'])) {
        $errors['money'] = '金額を入力してください。';
    } elseif (!is_int((int) $expense['money'])) {
        $errors['money'] = '金額は半角数字で入力してください。';
    }

    return $errors;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $expense = [
        'date' => $_POST['date'],
        'account' => $_POST['account'],
        'text' => $_POST['text'],
        'money' => $_POST['money'],
    ];

    $errors = validate($expense);
    if (!count($errors)) {
        $link = dbConnect();
        registerExpense($link, $expense);
        mysqli_close($link);
        header("Location: index.php");
    }
}

include 'views/register_expense.php';
