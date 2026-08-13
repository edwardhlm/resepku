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
    <title>Document</title>
</head>
<body>
    <h1>Anjay</h1>
    <?php
    echo "Hi ".$_SESSION["sesi"];
    
    ?>
    <form action="../logout.php" method="post">
        <input type="submit" value="Log Out!">
    </form>
</body>
</html>