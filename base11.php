<?php
class Calculate{
    public $num1, $num2, $op, $result = 0;
    
    function cek_data_get($jenis) {
        if (isset($_GET[$jenis])) {
            return $_GET[$jenis];
        } else {
            return 0;
        }
    }

    public function count(){
        switch($this->op){
            case '+': $this->result = $this->num1 + $this->num2; break;
            case '-': $this->result = $this->num1 - $this->num2; break;
            case '*': $this->result = $this->num1 * $this->num2; break;
            case '/': 
            $this->result = ($this->num2 != 0) ? $this->num1 / $this->num2 : "Error: Cant divided by zero";
            default: $this->result = 0;
        }
    }
    
    public function show_result(){
        return "<h2>Result : ". $this->result ."</h2>";
    }
}

$cal = new Calculate;

$cal->num1 = $cal->cek_data_get('one');
$cal->num2 = $cal->cek_data_get('two');
$cal->op = $cal->cek_data_get('op');

if($cal->cek_data_get('dor')){
    $cal->count();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculator</title>
</head>
<body>
    <form method="get">
        <label>First Number : </label>
        <input type="number" name="one" value="<?php echo $cal->num1; ?>">
        <br>
        <label>Operator : </label>
        <select name="op">
            <option value="+" <?php echo $cal->op == '+' ? 'selected' : ''; ?>>+</option>
            <option value="-" <?php echo $cal->op == '-' ? 'selected' : ''; ?>>-</option>
            <option value="*" <?php echo $cal->op == '*' ? 'selected' : ''; ?>>*</option>
            <option value="/" <?php echo $cal->op == '/' ? 'selected' : ''; ?>>/</option>
        </select>
        <br>
        <label>Second number : </label>
        <input type="number" name="two" value="<?php echo $cal->num2; ?>">
        <br>
        <input type="submit" name="dor" value="Submit">
    </form>
    <hr>
    <?php echo $cal->show_result(); ?>
</body>
</html>