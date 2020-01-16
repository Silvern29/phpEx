<?php
session_start();

$total = 0;

if($_SERVER['REQUEST_METHOD'] == "POST"){
    if(isset($_POST['add']) && isset($_POST['item'])){
        if(filter_var($_POST['price'], FILTER_VALIDATE_INT)){
            $_SESSION['cart'][$_POST['item']] = $_POST['price'];
        }
    }

    if(isset($_POST['del'])){
        unset($_SESSION['cart'][$_POST['item']]);
    }

    if(isset($_SESSION['cart'])){
        foreach ($_SESSION['cart'] as $price){
            $total += $price;
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Shopping Calculator</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="test.css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700&display=swap" rel="stylesheet">
</head>
<body>
<h1>Shopping Cart List</h1>
<form action="" method="post">
    <ul>
        <?php if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_SESSION['cart'])){
            foreach($_SESSION['cart'] as $item=>$price):?>
                <li>
                    <input name="item" value=<?="$item";?> readonly>
                    <span><?="$price";?></span>
                    <button name="del" type="submit" id="del-btn">Delete</button>
                </li>
            <?php endforeach;
        }?>
    </ul>
</form>
<div class="total">
    <p>|| w/o tax € <?= number_format($total / 120 * 100, 2); ?></p>
    <p>|| tax 20% € <?= number_format($total / 120 * 20, 2); ?></p>
    <h2>TOTAL € <?= $total;?></h2>
</div>


<form method="post" action="">
    <label for="item">Name</label>
    <input type="text" name="item" id="item">
    <label for="price">Price</label>
    <input type="text" name="price" id="price">
    <button type="submit" name="add" id="add-btn">Add</button>
</form>

</body>
</html>