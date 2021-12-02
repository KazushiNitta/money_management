<h2>収入編集ページ</h2>
<form action="update_income_process.php" method="POST">
    <?php if (count($errors)) : ?>
        <ul>
            <?php foreach ($errors as $error) : ?>
                <li><?= $error; ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <input type="hidden" name="id" value="<?= $income['id']; ?>">
    <div>
        <label for="date">日付</label>
        <input type="date" id="date" name="date" value="<?= $income['date']; ?>">
    </div>
    <div>
        <label for="account">科目</label>
        <input type="text" id="account" name="account" value="<?= $income['account']; ?>">
    </div>
    <div>
        <label for="text">摘要</label>
        <textarea name="text" id="text" cols="" rows=""><?= $income['text']; ?></textarea>
    </div>
    <div>
        <label for="money">金額</label>
        <input type="number" id="money" name="money" value="<?= $income['money']; ?>">
    </div>
    <button type="submit">編集する</button>
</form>
<a href="index.php">戻る</a>
