<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>


<?php

$server = "localhost";
$db_user = "root";
$db_password = "";
$db_name = "ort_jerusalem";

// Connects to database
$conn = new mysqli($server,
                   $db_user,
                   $db_password,
                   $db_name );

if ($conn->connect_error)
{
    echo "<h2>לא הצלחנו להתחבר לבסיס הנתונים</h2>" .
            "<p>" . $conn->connect_error . "</p>";
    die();
}
else
{
    echo "<p>" . "מחובר לבסיס הנתונים" . "</p>";
}

$sql = "SELECT name, mail, password FROM users";

// Sends the sql query to the database
// result gets rows from the database
$result = $conn->query($sql);

if (!$result)
{
    echo "Failed to get rows from database: " . $conn->error;
    die();
}

if ($result->num_rows > 0)
{
    // Display all rows from the users table
    
    // Gets next row from result (row in the table users)
    // as an associative array
    // row is an associative array
    $row = $result->fetch_assoc();
    // While there is a new row
    while($row)
    {
        echo "<h3> User </h3>";
        echo "<p> Name: " . $row["name"] . "</p>";
        echo "<p> Mail: " . $row["mail"] . "</p>";
        echo "<p> Password: " . $row["password"] . "</p>";
        echo "<br/>";
        
        // Gets next row from result (row in the table users)
        $row = $result->fetch_assoc();
    }
}
else
{
    echo "<p>" . "לא נמצאו משתמשים בבסיס הנתונים" . "</p>";
}

echo "<p>" . "סוגר קשר אל בסיס הנתונים" . "</p>";
$conn->close();

?>

</body>
</html>

