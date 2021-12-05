<?php

require_once __DIR__ . '/lib/Utils.php';
require_once __DIR__ . '/lib/Database.php';

function getIncomes($link)
{
    $incomes = [];
    $sql = 'SELECT id, date, account, text, money FROM income ORDER BY date ASC;';
    $result = mysqli_query($link, $sql);

    while ($income = mysqli_fetch_assoc($result)) {
        $incomes[] = $income;
    }

    mysqli_free_result($result);
    return $incomes;
}

function getExpense($link)
{
    $expenses = [];
    $sql = 'SELECT id, date, account, text, money FROM expense;';
    $result = mysqli_query($link, $sql);

    while ($expense = mysqli_fetch_assoc($result)) {
        $expenses[] = $expense;
    }

    mysqli_free_result($result);
    return $expenses;
}

function getSumIncome($link)
{
    $sql = 'SELECT SUM(money) FROM income;';
    $result = mysqli_query($link, $sql);
    $sumIncome = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    return (int) $sumIncome['SUM(money)'];
}

function getSumExpense($link)
{
    $sql = 'SELECT SUM(money) FROM expense;';
    $result = mysqli_query($link, $sql);
    $sumExpense = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    return (int) $sumExpense['SUM(money)'];
}

$link = Database::Connect();
$incomes = getIncomes($link);
$expenses = getExpense($link);
$sumIncome = getSumIncome($link);
$sumExpense = getSumExpense($link);
$profit = $sumIncome - $sumExpense;

$title = '家計簿アプリ';
$content = __DIR__ . '/views/index.php';
include 'views/layout.php';
