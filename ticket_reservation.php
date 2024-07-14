<?php
    $title = "Ticket Reservation and Management";
    include('dependencies/header.php');
?>

<style>
    <?php include('css/ticket_reservation.css');?>
    <?php include('css/header.css');?>
    <?php include('css/footer.css');?>
</style>

<!-- content -->
<div class="content">
    <!-- first row -->
    <div class="content-header">
        <h1>Welcome to the Ticket Reservation Page!</h1>
    </div>

    <!-- second row -->
    <div class="content-events">
        <form action="ticket_booking.php" method="get">
            <span>Ticket Booking<span>
            <button type="submit">
                <img class="event-image" src="images/PLACEHOLDER.png">
            </button>
        </form>

        <form action="booking_management.php" method="get">
            <span>Booking Management</span>    
            <button type="submit">
                <img class="event-image" src="images/PLACEHOLDER.png">
            </button>
        </form>
    </div>

    <!-- third row -->
    <div class="content-footer">
        <div class="first-column">
        </div>

        <div class="second-column">
        </div>

        <div class="third-column">
            <form action="main_menu.php" method="get">
                <button>Return to Previous Page</button>
            </form> 
        </div>
    </div>
<!-- end of content -->

<?php
    include('dependencies/footer.php');
?>