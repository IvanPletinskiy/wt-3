<body>
<a style="color: black; font-size: 30px;" href="index.php">Add mail form</a>
<h2>Mailing</h2>
<form method="post">
    Name:<br>
    <input type="text" name="name" required><br>
    Message:<br>
    <textarea rows="10" cols="45" name="message" required></textarea><br>
    <input type="submit" name="submit" value="Start mailing">
</form>
</body>

<?php
if (!isset($_POST['submit']))
    return;

//check connection
$mysqli = new mysqli("127.0.0.1", "root", "root", "webtech");
if (!$mysqli) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    exit;
}
//check if table is empty
$result = $mysqli->query("SELECT email FROM users");
if ($result->num_rows == 0) {
    return;
}

//sending
$server_mail = "webtechnologiesbsuir@gmail.com";
$subject = $_POST['name'];
$message = $_POST['message'];
$headers = "From: <$server_mail>\r\n";
$headers .= "Content-type: text/plain; charset=utf-8 \r\n";
$headers .= "Reply-To: $server_mail \r\n";
$headers .= 'X-Mailer: PHP/' . phpversion();

while ($row = mysqli_fetch_array($result)) {
    mail($row['email'], $subject, $message, $headers);
}



