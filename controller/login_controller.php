<?php

    $email = $_POST["email"];
    $password = $_POST["password"];

    // This function checks authentication (checks username and password
    // against username and password stored in the database).
    // Returns true if $email and $password exist in DB
    function isValidUserAndPassword($email, $password)
    {
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
            //echo "Error: failed connecting to DB: " . $conn->connect_error;
            //die();
        }
        else
        {
            //echo "<p>" . "מחובר לבסיס הנתונים" . "</p>";
        }
        
        $sql = "SELECT COUNT(mail) AS count_users FROM users " .
               "WHERE mail='{$email}' AND password='{$password}'"; 

        // Sends the sql query to the database
        // result gets rows from the database
        $result = $conn->query($sql);
        
        $valid_user = false;
        if ($result->num_rows > 0)
        {
            // Gets next row from result (row in the table users)
            // as an associative array
            // row is an associative array
            $row = $result->fetch_assoc();
            $valid_user = ($row["count_users"] == 1);
        }
        
        $conn->close();
        
        return $valid_user;
    }



?>

<div dir="rtl" style="margin:45px;">

<?php
    if ( isValidUserAndPassword($email, $password) )
    {
        echo("<H1>ברוך הבא</H1><br/>");
    }
    else
    {
        echo("<H1>משתמש או סיסמא לא חוקיים</H1><br/>");
    }
?>

</div>


<?php


?>
