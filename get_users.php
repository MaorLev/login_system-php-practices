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
    echo "Error: failed connecting to DB: " . $conn->connect_error;
    die();
}
else
{
    //echo "<p>" . "מחובר לבסיס הנתונים" . "</p>";
}

$sql = "SELECT name, mail, password FROM users";

// Sends the sql query to the database
// result gets rows from the database
$result = $conn->query($sql);

if (!$result)
{
    echo "Failed to get rows from database: " . $mysqli->error;
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
        echo "Name: " . $row["name"] . "\n";
        echo "Mail: " . $row["mail"] . "\n";
        echo "Password: " . $row["password"] . "\n";
        echo "\n";
        
        // Gets next row from result (row in the table users)
        $row = $result->fetch_assoc();
    }
}
else
{
    echo "No users in DB\n";
}

//echo "<p>" . "סוגר קשר אל בסיס הנתונים" . "</p>";
$conn->close();

?>

