<?php

//TODO
// 2. Дата рождения + кол-во дней из формы.
// 3. Определить год по восточному календарю.
if (isset($_POST["date"])) {
    $date = strtotime($_POST["date"]);
} else {
    $date = time();
}
$then = new DateTime(date('Y-m-d H:i:s', $date));
$now = new DateTime(date('Y-m-d H:i:s', time()));
$diff = $now->diff($then);
$difference_string = "Вам сейчас лет: " . $diff->y . ", месяцев: " . $diff->m . ", дней: " . $diff->d;

echo '<form action="/wt-3/wt3.php" method="post">
            <p>Введите текст: <input name="date" type="date" min="2000-01-01" max="2020-12-31"/></p>
            <p><input type="submit"/></p>
            <label>' . $difference_string. '</label>                     
        </form>';