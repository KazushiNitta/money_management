<?php

require_once __DIR__ . '/lib/mysqli.php';

function deleteIncome($link, $income)
{
    $sql = "DELETE FROM income WHERE id = {$income['id']};";
    $result = mysqli_query($link, $sql);
    if (!$result) {
        error_log('Error: fail to register income');
        error_log('Debugging Error: ' . mysqli_error($link));
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $income = [
        'id' => trim($_POST['id']),
    ];

    $link = dbConnect();
    deleteIncome($link, $income);
    mysqli_close($link);
    header("Location: index.php");
}
