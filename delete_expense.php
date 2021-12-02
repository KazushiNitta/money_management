<?php

require_once __DIR__ . '/lib/mysqli.php';

function deleteExpense($link, $expense)
{
    $sql = "DELETE FROM expense WHERE id = {$expense['id']};";
    $result = mysqli_query($link, $sql);
    if (!$result) {
        error_log('Error: fail to register income');
        error_log('Debugging Error: ' . mysqli_error($link));
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $expense = [
        'id' => trim($_POST['id']),
    ];

    $link = dbConnect();
    deleteExpense($link, $expense);
    mysqli_close($link);
    header("Location: index.php");
}
