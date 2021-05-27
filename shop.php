<!--change version to 7.4-->
<?php
//delete cookie
if (isset($_GET['name'])) {
    $cok = $_GET['name'];
    setcookie($cok, "", time() - 100000);
}
$expire_date = time() + 60 * 60 * 24;
$mydate = date("Y:m:d-H:i");
setcookie($mydate, $expire_date);
if (count($_COOKIE) == 0) {
    echo "<br>Cookies are empty!" . "<br><br>";
} else {
    echo '<br><b>Total times: ' . (count($_COOKIE) - 1) . '</b><br>';
    echo "<br><b>Time</b><br>";
    foreach ($_COOKIE as $key => $value) {
        echo '<a href="shop.php?name=' . $key . '">Delete</a>' . $key . "<br>";
    }
}
