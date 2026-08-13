<?php
session_start();
function connect(){
    $conn = mysqli_connect(
    "localhost", "root", "", "resepku");
    if ($conn -> connect_errno){
        echo "failed" . $conn -> connect_error;
    }else{
        return $conn;
    }
}

function cek_data_post($jenis){
    if(isset($_POST[$jenis])){
        return $_POST[$jenis];
    }else{
        return 0;
    }
}

function cek_data_get($jenis){
    if(isset($_GET[$jenis])){
        return $_GET[$jenis];
    }else{
        return 0;
    }
}

function register($a, $b, $c, $alert, $location){
    $query = "INSERT INTO pengguna VALUES(
    NULL,
    '$a',
    '$b',
    '$a',
    '$c',
    'rakyat')";
    mysqli_query(connect(), $query);
    ?>
    <script>
        alert("<?= $alert ?>");
        window.location.href = "<?= $location ?>";
    </script>
    <?php
}

function login($user, $pass) {
            session_start();
            $q_u = "SELECT * FROM pengguna WHERE username = '$user'";
            $qu = mysqli_query(connect(), $q_u);

            // echo mysqli_num_rows($qu);
            // echo "<br>";

            $q_p = "SELECT * FROM pengguna WHERE password = '$pass'";
            $qp = mysqli_query(connect(), $q_p);

            // echo mysqli_num_rows($qp);

            // $id = "SELECT id FROM pengguna where username='$user' && password='$pass'";
            // $q_i = mysqli_query(connect(), $id);

            if (mysqli_num_rows($qu) < 1) {
                header('Location:login.php?status=no_akun');
                return "Account doesn't Exist";
                } else{
                    $smw = 'SELECT * FROM pengguna';
                    $dat = mysqli_query(connect(), $smw);
                    foreach($dat as $i) {
                        if ($i['username'] == $user && $i['password'] == $pass) {
                            if ($i["role"] == "rakyat"){
                                $_SESSION['sesi'] = $i['id'];
                                header('Location:user/index.php?status=login');
                            }else{
                                $_SESSION['sesi'] = $i['id'];
                                header('Location:user/index.php?status=login');
                            }
                            // exit();
                        } 
                    }
                    header('Location:login.php?status=salah');
                    exit();
            // if ($qu == $user AND $qp == $pass) {
            //     header('Location: admin/index.php');
            // } else {
            //     ?>
                 <!-- <script>alert('Akun belum terdaftar atau salah!')</script> -->
                <?php
        }
    }
?>

<!-- 
else {
            echo "lau sape pruy";
        } -->

        <!-- if(cek_data_post($user) && cek_data_post($pass)) {} -->