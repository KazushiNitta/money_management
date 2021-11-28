<h2>支出登録ページ</h2>
<form action="expense.php" method="POST">
    <?php if (count($errors)) : ?>
        <ul>
            <?php foreach ($errors as $error) : ?>
                <li><?php echo $error; ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <div>
        <label for="date">日付</label>
        <input type="date" id="date" name="date" value="<?php echo $expense['date']; ?>">
    </div>
    <div>
        <label for="account">科目</label>
        <input type="text" id="account" name="account" value="<?php echo $expense['account']; ?>">
    </div>
    <div>
        <label for="text">摘要</label>
        <textarea name="text" id="text" cols="" rows=""><?php echo $expense['text']; ?></textarea>
    </div>
    <div>
        <label for="money">金額</label>
        <input type="number" id="money" name="money" value="<?php echo $expense['money']; ?>">
    </div>
    <button type="submit">登録する</button>
</form>
<a href="index.php">戻る</a>
