<h2 class="sub_title income">収入編集</h2>
<main class="form">
    <form action="update_income_process.php" method="POST">
        <?php if (count($errors)) : ?>
            <ul>
                <?php foreach ($errors as $error) : ?>
                    <li><?= $error; ?></li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>

        <input type="hidden" name="id" value="<?= $income['id']; ?>">
        <div class="part">
            <label for="date" class="label">日付</label>
            <input type="date" id="date" name="date" value="<?= $income['date']; ?>" class="input">
        </div>
        <div class="part">
            <label for="account" class="label">科目</label>
            <input type="text" id="account" name="account" value="<?= $income['account']; ?>" class="input">
        </div>
        <div class="part">
            <label for="text" class="label">摘要</label>
            <textarea name="text" id="text" class="text" cols="" rows=""><?= $income['text']; ?></textarea>
        </div>
        <div class="part">
            <label for="money" class="label">金額</label>
            <input type="number" id="money" name="money" value="<?= $income['money']; ?>" class="input">
        </div>
        <button type="submit" class="submit bg_income">編集する</button>
    </form>
    <a href="index.php">戻る</a>
</main>
