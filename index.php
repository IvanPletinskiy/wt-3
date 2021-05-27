<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <title>Regular and MySQL</title>
    <meta name="author">
</head>
<body>
<!--base 64
первичный внешний ключи
пароли http https
cookie session
что
get put post
ускорение http
daemons
agents-->
<a style="color: black; font-size: 30px;" href="index.php">Mailing</a>
<form method="post">
    <h1>Mail database</h1>
    <h2>Mail:
        <input type="text" name="mail" required>
    </h2>
    <input type="submit">
</form>
</body>
</html>

<?php

if (isset($_POST['mail'])) {
    $mail = $_POST['mail'];

    if (preg_match("#^[\w\.-]+@([\w-]+\.)+[\w-]{2,4}$#", $mail)) {
        $mysqli = new mysqli("127.0.0.1", "root", "root", "webtech");
        if (!$mysqli) {
            echo "Error: Unable to connect to MySQL." . PHP_EOL;
            exit;
        }
        $result = $mysqli->query("SELECT user_id FROM users WHERE email = '$mail'");
        if ($result->num_rows == 0) {
            $mysqli->query("INSERT INTO users(email) VALUES ('$mail')");
            echo "<h2>$mail added into database</h2>";
        } else {
            echo "<h2>$mail contains in database</h2>";
        }
        $mysqli->close();
    } else {
        echo "<h2>$mail is incorrect mail<h2>";
    }

} else {
    echo '<br>Enter mail please!';
}
?>

