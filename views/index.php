<h2 class="sub_title profit">収支一覧</h2>
<main class="container">
    <section class="register">
        <a href="register_income.php" class="register_link bg_income">収入を登録する</a>
        <a href="register_expense.php" class="register_link bg_expense">支出を登録する</a>
    </section>

    <section class="sum">
        <table>
            <tr>
                <th class="income">収入</th>
                <th>-</th>
                <th class="expense">支出</th>
                <th>=</th>
                <th class="profit">収支</th>
            </tr>
            <tr>
                <td>¥<?= $sumIncome; ?></td>
                <td>-</td>
                <td>¥<?= $sumExpense; ?></td>
                <td>=</td>
                <td>¥<?= $profit; ?></td>
            </tr>
        </table>
    </section>

    <ul class="menu">
        <li><a href="#" class="active hover_income" data-id="income">収入</a></li>
        <li><a href="#" class="hover_expense" data-id="expense">支出</a></li>
    </ul>

    <section class="content active" id="income">
        <?php if (count($incomes) > 0) : ?>
            <table border="1" width="100%" frame="void" class="income_table">
                <tr class="bg_income">
                    <th width="200px">日付</th>
                    <th width="200px">科目</th>
                    <th>摘要</th>
                    <th width="200px">金額</th>
                    <th></th>
                    <th></th>
                </tr>
                <?php foreach ($incomes as $income) : ?>
                    <tr align="center">
                        <td><?= Utils::escape($income['date']); ?></td>
                        <td><?= Utils::escape($income['account']); ?></td>
                        <td><?= nl2br(Utils::escape($income['text'])); ?></td>
                        <td>¥<?= Utils::escape($income['money']); ?></td>
                        <td width="100px">
                            <form action="update_income.php" method="POST">
                                <input type="hidden" name="id" value="<?= $income['id']; ?>">
                                <input type="hidden" name="date" value="<?= $income['date']; ?>">
                                <input type="hidden" name="account" value="<?= $income['account']; ?>">
                                <input type="hidden" name="text" value="<?= $income['text']; ?>">
                                <input type="hidden" name="money" value="<?= $income['money']; ?>">
                                <button type="submit">編集</button>
                            </form>
                        </td>
                        <td width="100px">
                            <form action="delete_income.php" method="POST">
                                <input type="hidden" name="id" value="<?= $income['id']; ?>">
                                <button type="button" class="delete">削除</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php else : ?>
            <p>データが登録されていません</p>
        <?php endif; ?>
    </section>

    <section class="content" id="expense">
        <?php if (count($expenses) > 0) : ?>
            <table border="1" width="100%" frame="void" class="expense_table">
                <tr class="bg_expense">
                    <th width="200px">日付</th>
                    <th width="200px">科目</th>
                    <th>摘要</th>
                    <th width="200px">金額</th>
                    <th></th>
                    <th></th>
                </tr>
                <?php foreach ($expenses as $expense) : ?>
                    <tr align="center">
                        <td><?= Utils::escape($expense['date']); ?></td>
                        <td><?= Utils::escape($expense['account']); ?></td>
                        <td><?= nl2br(Utils::escape($expense['text'])); ?></td>
                        <td>¥<?= Utils::escape($expense['money']); ?></td>
                        <td width="100px">
                            <form action="update_expense.php" method="POST">
                                <input type="hidden" name="id" value="<?= $expense['id']; ?>">
                                <input type="hidden" name="date" value="<?= $expense['date']; ?>">
                                <input type="hidden" name="account" value="<?= $expense['account']; ?>">
                                <input type="hidden" name="text" value="<?= $expense['text']; ?>">
                                <input type="hidden" name="money" value="<?= $expense['money']; ?>">
                                <button type="submit">編集</button>
                            </form>
                        </td>
                        <td width="100px">
                            <form action="delete_expense.php" method="POST">
                                <input type="hidden" name="id" value="<?= $expense['id']; ?>">
                                <button type="button" class="delete">削除</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php else : ?>
            <p>データが登録されていません</p>
        <?php endif; ?>
    </section>
</main>
