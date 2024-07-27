<?php
    $title = "Event Management";
    include('dependencies/header.php');
?>

<style>
    <?php include('css/event_management.css');?>
    <?php include('css/header.css');?>
    <?php include('css/footer.css');?>
</style>

<!-- content -->
<?php if (isset($_SESSION['isadmin']) && $_SESSION['isadmin'] == 1) { ?>

<div class="container">
    <form action="event_creation.php" method="get">
        <button type="submit">
            Create an event
        </button>
    </form>
    <form action="event_editing.php" method="get">
        <button type="submit">
            Edit an existing event
        </button>
    </form>
    <form action="event_deletion.php" method="get">
        <button type="submit">
            Delete events
        </button>
    </form>
    <form action="main_menu.php" method="get">
        <button type="submit">
            Return to previous page
        </button>
    </form>
</div>

<?php } ?>
<!-- end of content -->

<?php
    include('dependencies/footer.php');
?>