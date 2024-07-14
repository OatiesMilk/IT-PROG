<?php
    $title = "Events";
    include('dependencies/header.php');
?>

<style>
    <?php include('css/events.css');?>
    <?php include('css/header.css');?>
    <?php include('css/footer.css');?>
    <?php include('css/searchbar.css');?>
</style>

<!-- content -->
<div class="content">
    
    <!-- first row -->
    <div class="content-header">
        <div class="first-column">
            <h1>Ticket Reservation System</h1>
        </div>

        <div class="second-column">
    
        </div>

        <div class="third-column">
        </div>
    </div>

    <!-- second row -->
    <div class="content-events">
        <!-- Content: 1st Row -->
        <div class="searchbar">
            <input type="text" placeholder="Search Events" id="searchbar">
            <select id="sort-by">
                <option value="name">Sort By Name</option>
                <option value="rating">Sort By Rating</option>
            </select>

            <select id="order-by" value="Order">
                <option value="asc">Ascending</option>
                <option value="desc">Descending</option>
            </select>

            <button id="find">
                <img src="images/find-icon.png" alt="search icon here">
            </button>
        </div>
        
        <!-- Content: 2nd Row -->
        <div class="main-events">
            <form action="knights.html" method="get">
                <button type="submit">
                    <img src="images/KNIGHT.png" class="event-image">
                </button>
            </form>

            <form action="mask.html" method="get">
                <button type="submit">
                    <img src="images/Noble.png" class="event-image">
                </button>
            </form>

            <form action="comedy.html" method="get">
                <button type="submit">
                    <img src="images/Jester.png" class="event-image">
                </button>
            </form>
        </div>
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
</div>
<!-- end of content -->

<?php
    include('dependencies/footer.php');
?>