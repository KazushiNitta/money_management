<h2>一覧画面</h2>
<a href="register_income.php">収入を登録する</a>
<a href="register_expense.php">支出を登録する</a>
<main class="container">
    <section>
        <p>収入 - 支出 = 利益</p>
    </section>

    <ul class="menu">
        <li><a href="#" class="active" data-id="income">収入</a></li>
        <li><a href="#" data-id="expense">支出</a></li>
    </ul>

    <section class="content active" id="income">
        <?php if (count($incomes) > 0) : ?>
            <table border="1" width="100%" frame="void">
                <tr>
                    <th>日付</th>
                    <th>科目</th>
                    <th>摘要</th>
                    <th>金額</th>
                </tr>
                <?php foreach ($incomes as $income) : ?>
                    <tr align="center">
                        <td><?php echo escape($income['date']); ?></td>
                        <td><?php echo escape($income['account']); ?></td>
                        <td><?php echo escape($income['text']); ?></td>
                        <td><?php echo escape($income['money']); ?></td>
                        <td><a href="">編集</a></td>
                        <td><a href="">削除</a></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php else : ?>
            <p>データがありません</p>
        <?php endif; ?>
    </section>

    <section class="content" id="expense">
        <?php if (count($expenses) > 0) : ?>
            <table border="1" width="100%" frame="void">
                <tr>
                    <th>日付</th>
                    <th>科目</th>
                    <th>摘要</th>
                    <th>金額</th>
                </tr>
                <?php foreach ($expenses as $expense) : ?>
                    <tr align="center">
                        <td><?php echo escape($expense['date']); ?></td>
                        <td><?php echo escape($expense['account']); ?></td>
                        <td><?php echo escape($expense['text']); ?></td>
                        <td><?php echo escape($expense['money']); ?></td>
                        <td><a href="">編集</a></td>
                        <td><a href="">削除</a></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php else : ?>
            <p>データがありません</p>
        <?php endif; ?>
    </section>
</main>
