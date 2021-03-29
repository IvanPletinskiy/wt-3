<?php

//TODO
// 3. Определить год по восточному календарю.
// 4. Сохранять значения в форме
// 5. Не показывать результат, если форма пуста.
if (isset($_POST["birth_date"])) {
    $time = strtotime($_POST["birth_date"]);
} else {
    $time = time();
}

$then = new DateTime(date('Y-m-d H:i:s', $time));
$now = new DateTime(date('Y-m-d H:i:s', time()));
$diff = $now->diff($then);
$difference_string = "Вам сейчас лет: " . $diff->y . ", месяцев: " . $diff->m . ", дней: " . $diff->d;

$days = $_POST["days"];
$days_seconds = $days * 24 * 60 * 60;
$result_time = $time + $days_seconds;
$result_date = date("Y-m-d", $result_time);

echo '<div>
    <form action="/wt-3/wt3.php" method="post">
        <p>Введите дату вашего рождения: <input name="birth_date" type="date" min="2000-01-01" max="2020-12-31"/></p>
        <p>Вычислить дату, когда вам будет дней: <input name="days" type="number" min="0"/></p>
        <p><input type="submit"/></p>
    </form>
    <p>' . $difference_string . '</p>
    <p>Дата вашего рождения + ' . $days . ' дней равно: ' . $result_date . '</p>
</div>
';