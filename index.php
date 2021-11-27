<?php

require_once __DIR__ . '/lib/escape.php';
require_once __DIR__ . '/lib/mysqli.php';

function listIncomes($link)
{
    $incomes = [];
    $sql = 'SELECT date, account, text, money FROM income;';
    $result = mysqli_query($link, $sql);

    while ($income = mysqli_fetch_assoc($result)) {
        $incomes[] = $income;
    }

    mysqli_free_result($result);
    return $incomes;
}

function listExpense($link)
{
    $expenses = [];
    $sql = 'SELECT date, account, text, money FROM expense;';
    $result = mysqli_query($link, $sql);

    while ($expense = mysqli_fetch_assoc($result)) {
        $expenses[] = $expense;
    }

    mysqli_free_result($result);
    return $expenses;
}

$link = dbConnect();
$incomes = listIncomes($link);
$expenses = listExpense($link);

$title = '家計簿アプリ';
$content = __DIR__ . '/views/index.php';
include 'views/layout.php';
