<?php
    session_start();

    if (isset($_SESSION['username'])) {
        $username = $_SESSION['username'];
    } else {
        $username = 'Guest';
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($title) ? $title : 'Default Title'; ?></title>
</head>
<body>

<div class="header">
    <div class="first-column">
        <h1>Hello <?php echo htmlspecialchars($username); ?>!</h1>
    </div>

    <div class="second-column">
    </div>

    <?php if (is_null($username)) { ?>
    <div class="third-column">
        <form action="account_login.php" method="get">
            <button type="submit">
                Login
            </button>
        </form>
        <form action="account_creation.php" method="get">
            <button type="submit">
                Sign up
            </button>
        </form>
    </div>
    <?php } else { ?>
    
    <div class="third-column">
        <form action="account_login.php" method="get">
            <button type="submit">
                Logout
            </button>
        </form>
    </div>

    <?php
    } 
    ?>
</div>