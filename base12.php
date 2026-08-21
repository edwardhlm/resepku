<?php 
class Framework { 
    public $Att, $Def, $Spd, $Special; 
    
    public function show($a, $b, $c, $d) { 
        $this->Att = $a; 
        $this->Def = $b; 
        $this->Spd = $c; 
        $this->Special = $d; 
        
        echo "| Attack = " . $this->Att . " |<br>"; 
        echo "| Defense = " . $this->Def . " |<br>"; 
        echo "| Speed = " . $this->Spd . " |<br>"; 
        echo "| Special = " . $this->Special . " |<br>"; 
    } 
    
    public function cek_data_get($jenis) { 
        if (isset($_GET[$jenis])) { 
            return $_GET[$jenis]; 
        } else { 
            return 0; 
        } 
    } 
} 

class Hero extends Framework { 
    public function hero() { 
        $current_def = $this->cek_data_get('current_def');
        if ($current_def == 0 || $this->cek_data_get('reset') == "Reset") {
            $current_def = 100;
        }
        if ($this->cek_data_get('dor') == "Fight") { 
            $current_def = $current_def - 5; 
        } 
        $this->show(10, $current_def, 5, 5); 
        
        return $current_def;
    } 
} 

$b = new Hero(); 
?> 
<html> 
<head> 
    <title>Pokemon Demo</title> 
</head> 
<body> 
    <form action="" method="get"> 
        <?php 
        $current_def = $b->hero(); 
        ?>
        <br>
        <input type="hidden" name="current_def" value="<?php echo $current_def; ?>">
        
        <input type="submit" name="dor" value="Fight"> 
        <input type="submit" name="reset" value="Reset"> 
    </form> 
</body> 
</html>