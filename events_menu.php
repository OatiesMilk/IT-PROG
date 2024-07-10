<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Events Menu</title>
    <link rel="stylesheet" href="/IT-PROG/MP/css/events_menu.css">
</head>
<body>
    <?php
    // Start the session
    session_start();

    // Database connection
    $conn = mysqli_connect("localhost", "root", "", "machineproject");

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Fetch events based on filters
    $whereClauses = [];
    if (isset($_GET['price_range'])) {
        $priceRange = mysqli_real_escape_string($conn, $_GET['price_range']);
        $whereClauses[] = "price <= $priceRange";
    }
    if (isset($_GET['venue_type'])) {
        $venueType = mysqli_real_escape_string($conn, $_GET['venue_type']);
        $whereClauses[] = "venue_type = '$venueType'";
    }
    if (isset($_GET['event_kind'])) {
        $eventKind = mysqli_real_escape_string($conn, $_GET['event_kind']);
        $whereClauses[] = "event_kind = '$eventKind'";
    }

    $whereSql = !empty($whereClauses) ? 'WHERE ' . implode(' AND ', $whereClauses) : '';
    $eventsQuery = "SELECT * FROM events $whereSql";
    $eventsResult = mysqli_query($conn, $eventsQuery);

    // Close the database connection
    mysqli_close($conn);
    ?>

    <div class="container">
        <h2>Events Menu</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="GET">
            <label for="price_range">Price Range:</label>
            <input type="number" id="price_range" name="price_range" min="0">

            <label for="venue_type">Venue Type:</label>
            <input type="text" id="venue_type" name="venue_type">

            <label for="event_kind">Event Kind:</label>
            <input type="text" id="event_kind" name="event_kind">

            <input type="submit" value="Filter">
        </form>
        <div class="events">
            <?php
            while ($eventRow = mysqli_fetch_assoc($eventsResult)) {
                echo "<div class='event'>";
                echo "<h3>" . $eventRow['event_name'] . "</h3>";
                echo "<p>Price: $" . $eventRow['price'] . "</p>";
                echo "<p>Venue: " . $eventRow['venue_type'] . "</p>";
                echo "<p>Kind: " . $eventRow['event_kind'] . "</p>";
                echo "</div>";
            }
            ?>
        </div>
    </div>
</body>
</html>
