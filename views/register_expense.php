<h2 class="sub_title expense">支出登録</h2>
<main class="form">
    <form action="register_expense_process.php" method="POST">
        <?php if (count($errors)) : ?>
            <ul>
                <?php foreach ($errors as $error) : ?>
                    <li><?= $error; ?></li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>

        <div class="part">
            <label for="date" class="label">日付</label>
            <input type="date" id="date" name="date" value="<?= $expense['date']; ?>" class="input">
        </div>
        <div class="part">
            <label for="account" class="label">科目</label>
            <input type="text" id="account" name="account" value="<?= $expense['account']; ?>" class="input">
        </div>
        <div class="part">
            <label for="text" class="label">摘要</label>
            <textarea name="text" id="text" class="text" cols="" rows=""><?= $expense['text']; ?></textarea>
        </div>
        <div class="part">
            <label for="money" class="label">金額</label>
            <input type="number" id="money" name="money" value="<?= $expense['money']; ?>" class="input">
        </div>
        <button type="submit" class="submit bg_expense">登録する</button>
    </form>
    <a href="index.php">戻る</a>
</main>
