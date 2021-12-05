<?php

require_once __DIR__ . '/lib/Expense.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $expense = [
        'id' => trim($_POST['id']),
    ];

    Expense::delete($expense);
    header("Location: index.php");
}
