<?php
if (isset($_POST["birth_date"])) {
    $birth_date = $_POST["birth_date"];
    $time = strtotime($birth_date);
} else {
    $birth_date = "";
    $time = time();
}

if (isset($_POST["birth_date"]) && strlen((string)$_POST["birth_date"])) {
    $then = new DateTime(date('Y-m-d H:i:s', $time));
    $now = new DateTime(date('Y-m-d H:i:s', time()));
    $diff = $now->diff($then);
    $difference_string = "Вам сейчас лет: " . $diff->y . ", месяцев: " . $diff->m . ", дней: " . $diff->d;
    $birth_date_paragraph = "<p>" . $difference_string . "</p>";

    $year_names = ["Собака", "Свинья", "Крыса", "Бык", "Тигр", "Кролик", "Дракон", "Змея", "Лошадь", "Коза", "Обезьяна", "Петух"];
    $first_datetime = new DateTime("1/1/1970");
    $diff_2 = $then->diff($first_datetime);
    $years_diff = $diff_2->y;
    $year_name = $year_names[$years_diff % sizeof($year_names)];
    $east_year_name_paragraph = "<p>Ваш год рождения по восточному календарю: " . $year_name . "</p>";
} else {
    $birth_date_paragraph = "<p></p>";
    $east_year_name_paragraph = "<p></p>";
}

if (isset($_POST["days"]) && strlen((string)$_POST["days"]) > 0) {
    $days = $_POST["days"];
    $days_seconds = $days * 24 * 60 * 60;
    $result_time = $time + $days_seconds;
    $result_date = date("d-m-Y", $result_time);
    $result_date_paragraph = '<p>Дата вашего рождения + ' . $days . ' дней равно: ' . $result_date . '</p>';
} else {
    $result_date_paragraph = '<p></p>';
    $days = "";
}

echo '<div>
    <form action="/wt-3/wt3.php" method="post">
        <p>Введите дату вашего рождения: <input value="' . $birth_date . '" name="birth_date" type="date" min="1970-01-01" max="2020-12-31"/></p>
        <p>Вычислить дату, когда вам будет дней: <input value="' . $days . '" name="days" type="number" min="0"/></p>
        <p><input type="submit"/></p>
    </form>
    ' . $birth_date_paragraph . '
    ' . $result_date_paragraph . '
    ' . $east_year_name_paragraph . '
</div>
';