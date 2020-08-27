<?php
/* Tugas 1
membuat enskripsi sederhana untuk menyembunyikan password user, buatlah 2 function,
untuk mengekripsi password dan deskripsi password (algoritma bebas)

algoritma mencari karakter a,i,u,e,o,A,I,U,E,O dalam suatu input (string)
menjadi digit angka 1,2,3,4,5,6,7,8,9,0 (encrypt) dan sebaliknya (decrypt)
*/

$key = array(
    'a' => '1','i' => '2','u' => '3','e' => '4','o' => '5',
    'A' => '6','I' => '7','U' => '8','E' => '9','O' => '0'
   );

function encrypt($input, $keys)
{
    // merubah input string
    $output = str_replace(array_keys($keys), $keys, $input);
    echo $output;
}

function decrypt($input, $keys)
{
    $output = str_replace($keys, array_keys($keys), $input);
    echo $output;
}

echo "Encrypt : ";
encrypt("Lucinta luna", $key);
echo "<br/>Decrypt : ";
decrypt("L3c2nt1 l3n1", $key);
?>