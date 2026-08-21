<?php

class bmi {
    public $bb;
    public $tb;

    public function calc($a, $b) {
        $this->bb = $a;
        $this->tb = $b;
        if ($b <= 0) return 0;
        $b = $b / 100;
        return $a / ($b ** 2); 
    }

    public function cek_data_get($jenis) { 
        if (isset($_GET[$jenis])) { 
            return $_GET[$jenis]; 
        } else { 
            return 0; 
        } 
    } 
}

class ideal extends bmi {
    public function bi($x, $y) {
        if ($this->cek_data_get('dar') == "Submit") {
            $dat = $this->calc($x, $y); 
            echo number_format($dat, 2) . "<br>";
            if ($dat < 18.5){
                echo "Underweight";
            }elseif($dat >= 18.5 && $dat <= 22.9){
                echo "Ideal";
            }elseif($dat >= 23.0 && $dat <= 29.9){
                echo "Overweight";
            }else{
                echo "Obesitas";
            }
        }
    }
}

$a = new ideal;
$b = new bmi;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BMI Check</title>
</head>
<body>
    <form action="" method="get">
        <label>Berat Badan : </label>
        <input type="number" name="bb" required>
        <br><br>
        <label>Tinggi Badan : </label>
        <input type="number" name="tb" required>
        <br><br>
        <input type="submit" name="dar" value="Submit">
    </form>
    <hr>
    <h2><?php $a->bi($b->cek_data_get('bb'), $b->cek_data_get('tb')); ?></h2>
</body>
</html>