<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
        //    table, th, td {
        //   border: 1px solid black;
        //    border-collapse: collapse;
        //} 
        table {
            border-collapse: collapse;
            margin: 25px 0;
            font-size: 0.9em;
            font-family: sans-serif;
            min-width: 400px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
        }
        table thead tr {
            background-color: #009879;
            color: #ffffff;
            text-align: left;
        }
        table th,
        table td {
            padding: 12px 15px;
        }
        table tbody tr {
            border-bottom: 1px solid #dddddd;
            text-align: right;
        }
        table tbody tr:nth-of-type(even) {
            background-color: #9EDEEB;
        }
        table tbody tr:last-of-type {
            border-bottom: 2px solid #009879;
        }
        table tbody tr.active-row {
            font-weight: bold;
            color: #009879;
        }
        tr:hover {background-color:#aaffaa;}
    </style>
</head>
<body dir="rtl">


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
    echo "Failed to get rows from database: " . $mysqli->error;
    die();
}

if ($result->num_rows > 0)
{
?>

<table>
    <tr>
        <th>שם</th>
        <th>מייל</th> 
        <th>סיסמא</th>
    </tr>

<?php


    // Display all rows from the users table
    
    // Gets next row from result (row in the table users)
    // as an associative array
    // row is an associative array
    $row = $result->fetch_assoc();
    
    
    // While there is a new row
    while($row)
    {
        echo "<tr>\n";
            echo "<td>" . $row["name"] . "</td>\n";
            echo "<td>" . $row["mail"] . "</td>\n";
            echo "<td>" . $row["password"] . "</td>\n";
        echo "</tr>\n";        

        // Gets next row from result (row in the table users)
        $row = $result->fetch_assoc();
    }

    echo '</table>';
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

