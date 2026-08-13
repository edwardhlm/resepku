<?php
session_start();

if(!(isset($_SESSION['sesi']))){
    header ("Location: ../login.php?status=no_akun");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
</head>
<body>
    <h1>Masukan Resep</h1>
    <form action="" method="post">
        <label>Nama Resep : </label>
        <input type="text" name="Judul">
        <br>
        <label>Langkah-langkah : </label>
        <textarea name="Langka"></textarea>
        <br>
        <label>Pembuat : </label>
        <input type="text" name="Author">
        <br>
        <label>Resep</label>
        <br>
        <label>Sayur : </label>
        <select name="sayur">
            <option value="Bayam">Bayam</option>
            <option value="Wortel">Wortel</option>
            <option value="Buncis">Buncis</option>
        </select>
        <label>Buah : </label>
        <select name="buah">
            <option value="Pisang">Pisang</option>
            <option value="Apel">Apel</option>
            <option value="Semangka">Semangka</option>
        </select>
        <label>Bumbu : </label>
        <select name="bumbu">
            <option value="MSG">MSG</option>
            <option value="Jahe">Jahe</option>
            <option value="Baput">Baput</option>
        </select>
        <br>
        <br>
        <input type="submit" value="Buat Resep">
    </form>
    <hr>
    <?php
    include "../process.php";
    $bahan = cek_data_post("sayur").cek_data_post("buah").cek_data_post("bumbu");
    echo "Judul = ". cek_data_post("Judul"). "<br>";
    echo "Langkah = ". cek_data_post("Langkah"). "<br>";
    echo "Deskripsi = ". cek_data_post("Deskripsi"). "<br>";
    echo "Bahan = ". $bahan. "<br>";
    ?>
</body>
</html>