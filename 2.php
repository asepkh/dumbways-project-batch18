<?php
function is_username_valid($input)
{
    if(preg_match("/^[a-zA-Z]{5,9}$/", $input)) { return true; }
    else { return false; }
}
function is_password_valid($input)
{
    if(preg_match("/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!#$%])(?=.*[@]).{8,}$/", $input)) { return true; }
    else { return false; }
}

$username_true = "Asepddd";
$username_false = "@Asepdd"; // ada karakter spesial

$password_true = "p4ssw@r#D";
$password_false = "p4sswor#D"; // tanpa character @

echo "Username<br/>", $username_true, " : ", var_dump(is_username_valid($username_true)), "<br/>";
echo $username_false, " : ", var_dump(is_username_valid($username_false)), "<br/><br/>Password<br/>";
echo $password_true, " : ", var_dump(is_password_valid($password_true)), "<br/>";
echo $password_false, " : ", var_dump(is_password_valid($password_false)), "<br/>";
?>