<?php

$total = 0;
$liter = 0;
$disc = 0;

if($_SERVER['REQUEST_METHOD'] == "POST"){
    if(isset($_POST['liter']) && filter_var($_POST['liter'], FILTER_VALIDATE_FLOAT)){
        $liter = number_format($_POST['liter'], 2);
        $total = number_format($_POST['price'] * $liter, 2);
        if($liter >= 100){
            $disc = number_format($total * 0.02, 2);
            $total -= $disc;
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Gas Price Calculator</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="test.css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700&display=swap" rel="stylesheet">
</head>
<body>
<h1>Gas Price Calculator</h1>

<div class="total">
    <p>|| Liter <?= $liter; ?> l</p>
    <p>|| price    <?= $_POST['price']; ?> €</p>
    <?php if($liter >= 100){

        echo "<p>|| 2% discount € $disc</p>";
    }?>
    <h2>TOTAL € <?= $total;?></h2>
</div>


<form method="post" action="">
    <label for="liter">Liter</label>
    <input type="text" id="liter-input" name="liter"><br>
    <label for="price">Price/l</label>
    <input type="radio" name="price" value="1.35" checked> Normal
    <input type="radio" name="price" value="1.40"> Super<br>
    <button type="submit" name="calc" id="calc-btn">Calculate</button>
</form>

</body>
</html>