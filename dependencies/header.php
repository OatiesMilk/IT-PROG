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
        <h1>Welcome to MaxEvents!</h1>
    </div>

    <div class="second-column">
        can add something
    </div>

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
</div>