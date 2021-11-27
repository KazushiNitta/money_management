<?php

require_once __DIR__ . '/lib/mysqli.php';

function dropTable($link)
{
    $dropTableSql = 'DROP TABLE IF EXISTS income;';
    $result = mysqli_query($link, $dropTableSql);
    if ($result) {
        echo 'テーブルを削除しました。' . PHP_EOL;
    } else {
        echo 'テーブルの削除に失敗しました。' . PHP_EOL;
        echo 'Debugging error: ' . mysqli_connect_error() . PHP_EOL;
        exit;
    }
}

function createTable($link)
{
    $createTableSql = <<<EOT
    CREATE TABLE income (
        id INTEGER AUTO_INCREMENT NOT NULL PRIMARY KEY,
        date DATE,
        account VARCHAR(100),
        text VARCHAR(255),
        money INTEGER,
        created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
    ) DEFAULT CHARACTER SET=utf8mb4;
    EOT;
    $result = mysqli_query($link, $createTableSql);
    if ($result) {
        echo 'テーブルを作成しました。' . PHP_EOL;
    } else {
        echo 'テーブルの作成に失敗しました。' . PHP_EOL;
        echo 'Debugging error: ' . mysqli_connect_error() . PHP_EOL;
        exit;
    }
}

$link = dbConnect();
dropTable($link);
createTable($link);
mysqli_close($link);
