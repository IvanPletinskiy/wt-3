<?php
/**IS USER IS NEW
 * OTHERWISE DONT COUNT OPERATION SYSTEM
 * php seventh.1
 */
//connection
$mysqli = new mysqli('127.0.0.1', 'root', 'root', 'webtech');
if (!$mysqli) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    exit;
}
//get OS
$userOS = getOS();
$result = $mysqli->query("SELECT count FROM os_table WHERE os = '$userOS'");
if ($result->num_rows == 0) {
    $mysqli->query("INSERT INTO os_table(os,count) VALUES ('$userOS',1)");
    echo "<h2>$userOS added into database</h2>";
} else {
    $count = intval(mysqli_fetch_row($result)[0]) + 1;
    $mysqli->query("UPDATE os_table SET count = '$count' where os='$userOS'");
}
//select all
$query = "SELECT * FROM os_table ORDER BY count DESC";
$data = $mysqli->query($query);

echo "<table style='border: 1px solid black'>"; // start a table tag in the HTML

while ($row = mysqli_fetch_array($data)) {//Creates a loop to loop through results
    echo "<tr><td>" . $row['os'] . "</td><td>" . $row['count'] . "</td></tr>";  //$row['index'] the index here is a field name
}

echo "</table>"; //Close the table in HTML

$mysqli->close();

function getOS()
{
    $user_agent = $_SERVER['HTTP_USER_AGENT'];

    $os_platform = "Unknown OS Platform";

    $os_array = array(
        '/windows nt 10/i' => 'Windows 10',
        '/windows nt 6.3/i' => 'Windows 8.1',
        '/windows nt 6.2/i' => 'Windows 8',
        '/windows nt 6.1/i' => 'Windows seventh',
        '/windows nt 6.0/i' => 'Windows Vista',
        '/windows nt 5.2/i' => 'Windows Server 2003/XP x64',
        '/windows nt 5.1/i' => 'Windows XP',
        '/windows xp/i' => 'Windows XP',
        '/windows nt 5.0/i' => 'Windows 2000',
        '/windows me/i' => 'Windows ME',
        '/win98/i' => 'Windows 98',
        '/win95/i' => 'Windows 95',
        '/win16/i' => 'Windows 3.11',
        '/macintosh|mac os x/i' => 'Mac OS X',
        '/mac_powerpc/i' => 'Mac OS 9',
        '/linux/i' => 'Linux',
        '/ubuntu/i' => 'Ubuntu',
        '/iphone/i' => 'iPhone',
        '/ipod/i' => 'iPod',
        '/ipad/i' => 'iPad',
        '/android/i' => 'Android',
        '/blackberry/i' => 'BlackBerry',
        '/webos/i' => 'Mobile'
    );

    foreach ($os_array as $regex => $value)
        if (preg_match($regex, $user_agent))
            $os_platform = $value;

    return $os_platform;
}