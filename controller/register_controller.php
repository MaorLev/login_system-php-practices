<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    

<?php
$user_name = $_POST["username"];
$password = $_POST["password"];

function isValidUserAndPassword($userAndPassword, $user_name)
{
    $token = strtok($userAndPassword, " ");

    $user_name_from_file = '';
   
    if ($token !== false) 
    {
        $user_name_from_file = $token;
    }  

    if ( trim($user_name) == trim($user_name_from_file) )
    {
        return TRUE;            
    }

    return FALSE;
}

$handle = fopen("../users.txt", "r"); //Open file for read
//$handle contains a number.  In PHP:  0=FALSE  else: TRUE
if ($handle) //if file can be opened
{ 
    $was_user_found = FALSE;
    while (($line = fgets($handle)) !== false) 
    { 
        if( isValidUserAndPassword($line, $user_name) )
        {
            $was_user_found = TRUE;
            break;
        }
    } 

    fclose($handle); 
} 
else 
{ 
    echo("לא נמצא קובץ משתמשים");
}


if($was_user_found)
{
    echo("user already exists");
}
else
{
    $credetionals = $user_name . " " . $password ;
    $credetionals_with_end_of_line = $credetionals . PHP_EOL;  // "\r\n"
    $fp = fopen('../users.txt', 'a');  //open file in append mode
    fwrite($fp, $credetionals_with_end_of_line);
    fclose($fp);
    echo "you have a new account";
    echo "<br/> <a href='../login.html'>התחבר </a>";
}

?>
<br/>
<br/>

<br/>
<br/>
<br/>
<a href="../index.html" >back to home page </a>
</body>
</html>