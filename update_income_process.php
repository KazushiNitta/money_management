<?php

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
    if (!strlen($income['money']) || ((int) $income['money'] === 0)) {
        $errors['money'] = '金額を入力してください。';
    } elseif (!is_int((int) $income['money'])) {
        $errors['money'] = '金額は半角数字で入力してください。';
    }

    return $errors;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $income = [
        'id' => trim($_POST['id']),
        'date' => trim($_POST['date']),
        'account' => trim($_POST['account']),
        'text' => trim($_POST['text']),
        'money' => trim($_POST['money']),
    ];

    $errors = validate($income);
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
