<?php 
include 'process.php';

function insert($name_file) {
    $x = fopen($name_file, 'r');
    while(($dat = fgets($x)) !== false) {
        $dat = trim($dat);
        if($dat !== ''){
             $q = "INSERT INTO bahan (nama) VALUES ('$dat')";
             mysqli_query(connect(), $q);
        }
    }
    fclose($x);
}

if(cek_data_get('dor') == "kirim") {
    insert('bumbu.md');
    insert('buah.md');
    insert('sayur.md');
}
// echo fread($sayur, filesize('sayur.md'));

// $buah = fopen('buah.md', 'r');
// echo fread($buah, filesize('buah.md'));

// $bumbu = fopen('bumbu.md', 'r');
// echo fread($bumbu, filesize('bumbu.md'));

// foreach($bumbu as $dat) {
//     echo $dat;
//     echo "<br>";
// }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <!-- Jika tidak ada method apapun secara default akan jadi get -->
    <form action="" method="get">
        <input type="submit" name="dor" value="kirim">
    </form>
</body>
</html>