<?php

    $user_name = $_POST["username"];
    $password = $_POST["password"];

    // This function checks authentication (checks username and password
    // against username and password stored in the system).
    // Returns true if $user_name and $password
    // are in $userAndPassword
    //
    // Parameters:
    //  $userAndPassword:  example:  "dany 1234"
    //  $user_name: example: "dany"
    //  $password: example "1234"
    function isValidUserAndPassword($userAndPassword, $user_name, $password)
    {
        $token = strtok($userAndPassword, " ");

        $user_name_from_file = '';
        $password_from_file = '';
        if ($token !== false) 
        {
            $user_name_from_file = $token;
            $token = strtok(" ");
            if ($token !== false)
            {
                $password_from_file = $token;
            }
        }  

        if ( (trim($user_name)==trim($user_name_from_file)) && 
             (trim($password)==trim($password_from_file)) )
        {
            return TRUE;            
        }

        return FALSE;
    }

    $was_users_file_found = true;

    $handle = fopen("../users.txt", "r"); //Open file for read
    //$handle contains a number.  In PHP:  0=FALSE  else: TRUE
    if ($handle) //if file can be opened
    { 
        $was_user_found = FALSE;
        
        // Note:   $line == FALSE if line is empty.            
        //         $line !== FALSE is line is empty (because type is checked too).
        // Exmples:  
        //   if $line is "a" then $line == TRUE but $line === FALSE 
        //   if $line is "" then $line == FALSE but $line !== FALSE ($line is NOT boolean)
        while ( ($line = fgets($handle)) !== false) 
        { 
            if( isValidUserAndPassword($line, $user_name, $password) )
            {
                $was_user_found = TRUE;
                break;
            }
        } 
        fclose($handle); 
    } 
    else 
    { 
        //echo("לא נמצא קובץ משתמשים");
        $was_users_file_found = false;
    }
?>

    <div dir="rtl" style="margin:45px;">

<?php
    if (!$was_users_file_found)
    {
        echo("לא נמצא קובץ משתמשים");
    }
    else if($was_user_found && $user_name=='eli@gmail.com')
    {
        echo('ברוך הבא מנהל האתר');
    }
    else if($was_user_found)
    {
        echo("{$user_name} ברוך הבא");
        echo("<br/>");
?>

    <h2>קנייה</h2>
    <form action="controller/buy_controller.php" method="POST">
        <input type="checkbox" id="camera" name="camera"/>
        <label for="camera">מצלמה</label>
        <br/>
        <input type="checkbox" id="toaster" name="toaster"/>
        <label for="toaster">טוסטר</label>
        <br/>
        <input type="checkbox" id="laptop" name="laptop"/>
        <label for="laptop">מחשב נייד</label>
        <br/>
        <input type="text" name="remark" placeholder="הערה"/>
        <br/>
        <br/>
        <button type="submit">שלח</button>
    </form>  

<?php
    }
    else
    {
        echo("<H1>Wrong user or password!</H1><br/>");
    }
?>

</div>


<?php


?>