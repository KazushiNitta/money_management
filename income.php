<?php

require_once __DIR__ . '/lib/mysqli.php';

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

function validate($income)
{
    $errors = [];

    // 日付
    $dates = explode("-", $income['date']);
    if (!strlen($income['date'])) {
        $errors['date'] = '日付を入力してください。';
    } elseif (count($dates) !== 3) {
        $errors['date'] = '正しい形式で日付を入力してください。';
    } elseif (!checkdate($dates[1], $dates[2], $dates[0])) {
        $errors['date'] = '正しい形式で日付を入力してください。';
    }

    // 科目
    if (!strlen($income['account'])) {
        $errors['account'] = '科目を入力してください。';
    } elseif (strlen($income['account']) > 100) {
        $errors['account'] = '科目は100文字以内で入力してください。';
    }

    // 摘要
    if (!strlen($income['text'])) {
        $errors['text'] = '摘要を入力してください。';
    } elseif (strlen($income['text']) > 255) {
        $errors['text'] = '摘要は255文字以内で入力してください。';
    }

    // 金額
    if (!strlen($income['money'])) {
        $errors['money'] = '金額を入力してください。';
    } elseif (!is_int((int) $income['money'])) {
        $errors['money'] = '金額は半角数字で入力してください。';
    }

    return $errors;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $income = [
        'date' => $_POST['date'],
        'account' => $_POST['account'],
        'text' => $_POST['text'],
        'money' => $_POST['money'],
    ];

    $errors = validate($income);
    if (!count($errors)) {
        $link = dbConnect();
        registerIncome($link, $income);
        mysqli_close($link);
        header("Location: index.php");
    }
}

include 'views/register_income.php';
