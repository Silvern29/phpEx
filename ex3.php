<?php

$square = "";
$num = "";
if($_SERVER['REQUEST_METHOD'] == "POST"){
    if(isset($_POST['num']) && filter_var($_POST['num'], FILTER_VALIDATE_INT)){
        $num = $_POST['num'];
        $square = $_POST['num']**2;
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Square your number</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="test.css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700&display=swap" rel="stylesheet">
</head>
<body>
<h1>The Square</h1>

<div class="total">
    <p>Your number <?= $num; ?></p>
    <h2>Squared <?= $square;?></h2>
</div>


<form method="post" action="">
    <label for="num">Your number</label>
    <input type="text" name="num">
    <button type="submit">Square</button>
</form>

</body>
</html>