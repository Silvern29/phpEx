<?php
session_start();

$total = 0;
$points1 = 0;
$points2 = 0;
$roll1 = "";
$roll2 = "";
unset($_SESSION['winner']);

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if ($_POST['action'] === 'roll1' || $_POST['action'] === 'roll2') {
        if (isset($_SESSION['player1'])) {
            $points1 = $_SESSION['player1']['points'];
            $roll1 = $_SESSION['player1']['roll'];
        }

        if (isset($_SESSION['player2'])) {
            $points2 = $_SESSION['player2']['points'];
            $roll2 = $_SESSION['player2']['roll'];
        }

        if ($_POST['player'] === 'Player 1') {
            $roll1 = rand(1, 6);
            $_SESSION['player1']['roll'] = $roll1;

            if (isset($_SESSION['player1']['points'])) {
                $_SESSION['player1']['points'] += $roll1;
            } else {
                $_SESSION['player1']['points'] = $roll1;
            }

            $points1 = $_SESSION['player1']['points'];

            if ($points1 >= 25) {
                $_SESSION['winner'] = 'player1';
            }

        } elseif ($_POST['player'] === 'Player 2') {
            $roll2 = rand(1, 6);
            $_SESSION['player2']['roll'] = $roll2;

            if (isset($_SESSION['player2']['points'])) {
                $_SESSION['player2']['points'] += $roll2;
            } else {
                $_SESSION['player2']['points'] = $roll2;
            }

            $points2 = $_SESSION['player2']['points'];

            if ($points2 >= 25) {
                $_SESSION['winner'] = 'player2';
            }
        }
    } elseif ($_POST['action'] === 'reset') {
        session_unset();
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dices</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="test9.css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700&display=swap" rel="stylesheet">
</head>
<body>
<div class="game">
    <h1>Roll the dices</h1>
    <?php if (isset($_SESSION['winner'])) {
        echo "<h2 id='winner-message'>" . $_POST['player'] . " wins!</h2>";
    } ?>

    <div class="player">
        <form action="" method="post" id="player1">
            <div class="points"><?= $points1; ?></div>
            <input name="player" value="Player 1" readonly>
            <span class="roll"><?= $roll1; ?></span><br>
            <button name="action" value="roll1" type="submit" <?php if (isset($_SESSION['winner'])) {
                echo "disabled";
            } ?>>Roll
            </button>
        </form>

        <form action="" method="post" id="player2">
            <div class="points"><?= $points2; ?></div>
            <span class="roll"><?= $roll2; ?></span>
            <input name="player" value="Player 2" readonly id="p2-input"><br>
            <button name="action" value="roll2" type="submit" <?php if (isset($_SESSION['winner'])) {
                echo "disabled";
            } ?>>Roll
            </button>
        </form>
    </div>

    <form method="post">
        <button type="submit" name="action" value="reset" id="reset-btn">Reset</button>
    </form>

</div>

</body>
</html>