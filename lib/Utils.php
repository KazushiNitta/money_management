<?php

class Utils {

    public static function escape($string)
    {
        return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
    }

    public static function validate($input)
    {
        $errors = [];

        // 日付
        $dates = explode("-", $input['date']);
        if (!strlen($input['date'])) {
            $errors['date'] = "日付を入力してください。";
        } elseif (count($dates) !== 3) {
            $errors['date'] = "正しい形式で日付を入力してください。";
        } elseif (!checkdate($dates[1], $dates[2], $dates[0])) {
            $errors['date'] = '正しい形式で日付を入力してください。';
        }

        // 科目
        if (!strlen($input['account'])) {
            $errors['account'] = "科目を入力してください。";
        } elseif (strlen($input['account']) > 100) {
            $errors['account'] = '科目は100文字以内で入力してください。';
        }

        // 摘要
        if (!strlen($input['text'])) {
            $errors['text'] = "摘要を入力してください。";
        } elseif (strlen($input['text']) > 255) {
            $errors['text'] = '科目は255文字以内で入力してください。';
        }

        // 金額
        if (!strlen($input['money']) || ((int) $input['money'] === 0)) {
            $errors['money'] = '金額を入力してください。';
        } elseif (!is_int((int) $input['money'])) {
            $errors['money'] = '金額は半角数字で入力してください。';
        }

        return $errors;
    }
}
