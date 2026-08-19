<?php
function multiply($x, $y) {
    return $x * $y;
}

function tampil($x, $y) {
    $hasil = multiply($x, $y);

    echo "$x multiplied by $y = $hasil";
}

tampil(10, 10);
?>