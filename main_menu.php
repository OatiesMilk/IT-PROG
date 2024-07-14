<?php
    $title = "Main Menu";
    include('dependencies/header.php');
?>

<style>
    <?php include('css/main_menu.css');?>
</style>

    <!-- content -->
    <div class="header">
        <div class="first-column">
            <h1>Welcome to MaxEvents!</h1>
        </div>

        <div class="second-column">
            hi
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

    <div class="container">
        <form action="events.html" method="get">
            <button type="submit">
                <img src="/IT-PROG/MP/images/EVENTS.png" width="350" height="200">
            </button>
        </form>
        <form action="ticket.html" method="get">
            <button type="submit">
                <img src="/IT-PROG/MP/images/Ticket.png" width="350" height="200">
            </button>
        </form>
        <form action="review.html" method="get">
            <button type="submit">
                <img src="/IT-PROG/MP/images/Review.png" width="350" height="200">
            </button>
        </form>
        <form action="about.html" method="get">
            <button type="submit">
                <img src="/IT-PROG/MP/images/About.png" width="350" height="200">
            </button>
        </form>
    </div>
    <!-- end of content -->

<?php
    include('dependencies/footer.php');
?>