<?php

require_once __DIR__ . '/lib/Income.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $income = [
        'id' => trim($_POST['id']),
    ];

    Income::delete($income);
    header("Location: index.php");
}
