<?php
$key = array(
    'a' => '1','i' => '2','u' => '3','e' => '4','o' => '5',
    'A' => '6','I' => '7','U' => '8','E' => '9','O' => '0'
   );

function encrypt($input, $key)
{
    // merubah input string
    $output = str_replace(array_keys($key), $key, $input);
    echo $output;
}

function decrypt($input, $key)
{
    $output = str_replace($key, array_keys($key), $input);
    echo $output;
}

echo "Encrypt : ";
encrypt("Lucinta luna", $key);
echo "<br/>Decrypt : ";
decrypt("L3c2nt1 l3n1", $key);
?>