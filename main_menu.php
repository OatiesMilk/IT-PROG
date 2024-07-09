<?php
    $title = "Main Menu";
    $css = "/IT-PROG/MP/css/main_menu.css"; // Path to the specific CSS for this page
    include('dependencies/header.php');
?>

    <!-- content -->
    <div class="header">
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