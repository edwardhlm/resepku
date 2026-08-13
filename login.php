<?php
include 'process.php';

if(cek_data_get("status") == 'salah'){
    echo "<script> alert('User atau Password Salah !') </script>";
}elseif(cek_data_get("status") == 'no_akun'){
    echo "<script> alert('Buatkan Akun Dulu !') </script>";
}elseif(cek_data_get("status") == 'kelar'){
    echo "<script> alert('BAY GANTENG !') </script>";
}


if (cek_data_post('dor') == "Log In"){
    login (
        cek_data_post('user'),
        cek_data_post('pass')
    );
};

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
         .form{
            width: 250px;
            height: 100px;
            margin: auto;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .user, .pass, .email {
            display: flex;
            width: 100%;
            justify-content: space-between;
        }
    </style>
</head>
<body>
    <form action="" method="post">
        <div class="form">

            <div class="user">
                <label for="">Username: </label>
                <input type="text" name="user" placeholder="e.g childhead">
            </div>

            <div class="pass">
                <label for="">Password: </label>
                <input type="password" name="pass" placeholder="***">
            </div>
            <input type="submit" name="dor" value="Log In">
        </div>
    </form>
</body>
</html>