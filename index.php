<?php
// テーブル作成処理をクラスにまとめる

require_once __DIR__ . '/lib/Utils.php';
require_once __DIR__ . '/lib/Income.php';
require_once __DIR__ . '/lib/Expense.php';

$incomes = Income::get();
$expenses = Expense::get();
$sumIncome = Income::getSum();
$sumExpense = Expense::getSum();
$profit = $sumIncome - $sumExpense;

$title = '家計簿アプリ';
$content = __DIR__ . '/views/index.php';
include 'views/layout.php';
