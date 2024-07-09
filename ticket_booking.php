    <?php
    $title = "Ticket Booking";
    $css = "/IT-PROG/MP/css/ticket_booking.css"; // Path to the specific CSS for this page
    include('dependencies/header.php');
    
    // Start the session
    session_start();

    // Database connection
    include('config.php');
    $conn = mysqli_connect($localhost, "root", "", $database);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Fetch events from the database
    $eventsQuery = "SELECT * FROM events";
    $eventsResult = mysqli_query($conn, $eventsQuery);

    // Fetch addons from the database
    $addonsQuery = "SELECT * FROM addons";
    $addonsResult = mysqli_query($conn, $addonsQuery);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Collect and sanitize input data
        $event_id = mysqli_real_escape_string($conn, $_POST['event']);
        $addons = isset($_POST['addons']) ? $_POST['addons'] : [];
        $combo_package = isset($_POST['combo_package']) ? 1 : 0;
        $username = $_SESSION['username'];
        
        // Fetch user account_id
        $userQuery = "SELECT account_id FROM accounts WHERE username='$username'";
        $userResult = mysqli_query($conn, $userQuery);
        $userRow = mysqli_fetch_assoc($userResult);
        $account_id = $userRow['account_id'];

        // Insert booking into the database
        $sql = "INSERT INTO bookings (account_id, event_id, combo_package) VALUES ('$account_id', '$event_id', '$combo_package')";
        if (mysqli_query($conn, $sql)) {
            $booking_id = mysqli_insert_id($conn);
            foreach ($addons as $addon_id) {
                $addonSql = "INSERT INTO booking_addons (booking_id, addon_id) VALUES ('$booking_id', '$addon_id')";
                mysqli_query($conn, $addonSql);
            }
            echo "Booking successful.";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }

    // Close the database connection
    mysqli_close($conn);
    ?>

    <div class="container">
        <h2>Book Your Ticket</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" id="booking_form">
            <label for="event">Select Event:</label>
            <select id="event" name="event" required>
                <?php
                while ($eventRow = mysqli_fetch_assoc($eventsResult)) {
                    echo "<option value='" . $eventRow['event_id'] . "'>" . $eventRow['event_name'] . "</option>";
                }
                ?>
            </select>

            <label for="addons">Select Addons:</label>
            <select id="addons" name="addons[]" multiple>
                <?php
                while ($addonRow = mysqli_fetch_assoc($addonsResult)) {
                    echo "<option value='" . $addonRow['addon_id'] . "'>" . $addonRow['addon_name'] . "</option>";
                }
                ?>
            </select>

            <label for="combo_package">Combo Package:</label>
            <input type="checkbox" id="combo_package" name="combo_package">

            <input type="submit" value="Book Ticket">
        </form>
    </div>

<?php
include('dependencies/footer.php');
?>