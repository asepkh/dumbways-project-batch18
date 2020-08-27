<?php
/* Tugas 1
memvalidasi field input sebuah form (true or false)
Format username:​ merupakan kombinasi dari huruf kecil, huruf besar dan angka dengan panjang 5-9 karakter.
                 Username tidak boleh diawali dengan angka / karakter special.

Format password:​ merupakan kombinasi dari huruf kecil, huruf besar minimal satu karakter,
                 angka minimal satu karakter, dan karakter spesial minimal satu karakter 
                 dan harus memiliki karakter simbol ‘@’ dan panjang minimal 8 karakter.
*/

function is_username_valid($input)
{
    /*
        ^\w{5,9} -> mencocokkan awal string / baris dengan word character (alphanumeric | huruf/angka)
        dengan panjang karakter antara 5 - 9, $ -> akhir string
    */
    if(preg_match("/^\w{5,9}$/", $input)) { return true; }
    else { return false; }
}
function is_password_valid($input)
{
    /*
      ^ -> mencocokkan awal string dengan kondisi berikut
      (?=.*\d) -> minimal 1 karakter digit (0 - 9)
      (?=.*[a-z]) -> minimal 1 karakter huruf kecil
      (?=.*[A-Z]) -> minimal 1 karakter huruf besar / kapital
      (?=.*[!#$%]) -> minimal 1 karakter spesial selain @ (terdapat dalam kurung siku)
      (?=.*[@]) -> minimal 1 karakter spesial @
      .{8,} -> panjang karakter harus lebih dari sama dengan 8, >= 8
    */

    if(preg_match("/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!#$%])(?=.*[@]).{8,}$/", $input)) { return true; }
    else { return false; }
}

$username_true = "Asepd1d";
$username_false = "@Asepdd"; // ada karakter spesial

$password_true = "p4ssw@r#D";
$password_false = "p4sswor#D"; // tanpa character @

echo "Username<br/>", $username_true, " : ", var_dump(is_username_valid($username_true)), "<br/>",
$username_false, " : ", var_dump(is_username_valid($username_false)), "<br/><br/>Password<br/>",
$password_true, " : ", var_dump(is_password_valid($password_true)), "<br/>",
$password_false, " : ", var_dump(is_password_valid($password_false)), "<br/>";
?>