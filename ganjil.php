<?php
function ganjil($jumlah)
{
    for($i = 1; $i <= $jumlah; $i++)
    {
        if($i % 2 != 0)
            echo $i, "<br/>";
    }
}
ganjil(10)
?>