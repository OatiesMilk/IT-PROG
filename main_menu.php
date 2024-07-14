<?php
    $title = "Main Menu";
    include('dependencies/header.php');
?>

<style>
    <?php include('css/main_menu.css');?>
    <?php include('css/header.css');?>
    <?php include('css/footer.css');?>
</style>

    <!-- content -->
    
    <!-- ADMIN SHIT -->
    <!-- <div class="container">
        <div class="topleft">
            <form action="ticket_management.php" method="get">
                <button type="submit">
                    Ticket Management
                </button>
            </form>
            <form action="event_management.php" method="get">
                <button type="submit">
                    Event Management
                </button>
            </form>
            <form action="report_management.php" method="get">
                <button type="submit">
                    Report Management
                </button>
            </form>
        </div>
    </div> -->

    <div class="container">
        <form action="events.php" method="get">
            <button type="submit">
                <img src="images/EVENTS.png">
            </button>
        </form>
        <form action="ticket_reservation.php" method="get">
            <button type="submit">
                <img src="images/Ticket.png">
            </button>
        </form>
        <form action="review.html" method="get">
            <button type="submit">
                <img src="images/Review.png">
            </button>
        </form>
        <form action="about.html" method="get">
            <button type="submit">
                <img src="images/About.png">
            </button>
        </form>
    </div>
    <!-- end of content -->

<?php
    include('dependencies/footer.php');
?>