<?php
function cetak_gambar($jumlah)
{
    $char1 		 = '=';
    $char2 		 = '*';
    if($jumlah % 2 != 0) // mod = sisabagi
    { // Kondisi Ganjil
        for ($row = 1; $row <= $jumlah; $row++) // Loop baris
        {
            for ($col = 1; $col <= $jumlah; $col++)  // Loop kolom
            {
                if($row % 2 != 0) { $char = $col % 2 != 0 ? $char1 : $char2; }
                else { $char = $col % 2 != 0 ? $char2 : $char1; }
                echo $char, " &ensp; ";	
            }
            echo "<br/><br/>";  // Space
        }
    } 
    else
    {
        echo "Jumlah Harus Ganjil !!";
    }
}
cetak_gambar(5);
?>