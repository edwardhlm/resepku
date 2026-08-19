<?php

class Mobil{
    public $nama = 'Mr.Gio';

    public $umur;

    public function jalan1(){
        echo "Jalan ke depan";
    }
    public function jalan2(){
        echo "Jalan ke depan";
    }
    public function tampil($luar){
        $this->umur = $luar;
        echo "Nama = ". $this->nama;
        echo "<br>";
        echo 'Umur = '. $this->umur;
    }
}

// $this itu mengakses properti di dalam kelas
$move = new Mobil;
$move->tampil(100);

?>