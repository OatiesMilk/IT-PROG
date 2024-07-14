<?php
    $title = "Manage Your Booking";
    include('dependencies/header.php');
?>

<style>
    <?php include('css/booking_management.css'); ?>
</style>

<?php
    // Start the session
    session_start();

    // Database connection
    include('config.php');
    $conn = mysqli_connect($localhost, "root", "", $database);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $username = $_SESSION['username'];

    // Fetch user account_id
    $userQuery = "SELECT account_id FROM accounts WHERE username='$username'";
    $userResult = mysqli_query($conn, $userQuery);
    $userRow = mysqli_fetch_assoc($userResult);
    $account_id = $userRow['account_id'];

    // Fetch user bookings
    $bookingsQuery = "SELECT * FROM bookings WHERE account_id='$account_id'";
    $bookingsResult = mysqli_query($conn, $bookingsQuery);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $booking_id = mysqli_real_escape_string($conn, $_POST['booking_id']);
        if (isset($_POST['cancel'])) {
            // Cancel the booking
            $deleteSql = "DELETE FROM bookings WHERE booking_id='$booking_id'";
            mysqli_query($conn, $deleteSql);
            $deleteAddonsSql = "DELETE FROM booking_addons WHERE booking_id='$booking_id'";
            mysqli_query($conn, $deleteAddonsSql);
            echo "Booking cancelled successfully.";
        } else if (isset($_POST['update'])) {
            // Update the booking
            $addons = isset($_POST['addons']) ? $_POST['addons'] : [];
            $combo_package = isset($_POST['combo_package']) ? 1 : 0;
            $updateSql = "UPDATE bookings SET combo_package='$combo_package' WHERE booking_id='$booking_id'";
            mysqli_query($conn, $updateSql);
            $deleteAddonsSql = "DELETE FROM booking_addons WHERE booking_id='$booking_id'";
            mysqli_query($conn, $deleteAddonsSql);
            foreach ($addons as $addon_id) {
                $addonSql = "INSERT INTO booking_addons (booking_id, addon_id) VALUES ('$booking_id', '$addon_id')";
                mysqli_query($conn, $addonSql);
            }
            echo "Booking updated successfully.";
        }
    }

    // Close the database connection
    mysqli_close($conn);
?>

    <div class="container">
        <h2>Manage Your Bookings</h2>
        <?php
        while ($bookingRow = mysqli_fetch_assoc($bookingsResult)) {
            echo "<div class='booking'>";
            echo "<p>Event ID: " . $bookingRow['event_id'] . "</p>";
            echo "<p>Combo Package: " . ($bookingRow['combo_package'] ? 'Yes' : 'No') . "</p>";

            // Fetch addons for the booking
            $booking_id = $bookingRow['booking_id'];
            $addonsQuery = "SELECT * FROM booking_addons WHERE booking_id='$booking_id'";
            $addonsResult = mysqli_query($conn, $addonsQuery);
            echo "<p>Addons: ";
            while ($addonRow = mysqli_fetch_assoc($addonsResult)) {
                echo $addonRow['addon_id'] . " ";
            }
            echo "</p>";

            echo "<form action='" . htmlspecialchars($_SERVER["PHP_SELF"]) . "' method='POST'>";
            echo "<input type='hidden' name='booking_id' value='" . $booking_id . "'>";
            echo "<label for='addons'>Select Addons:</label>";
            echo "<select id='addons' name='addons[]' multiple>";
            // Fetch addons options from the database
            $allAddonsResult = mysqli_query($conn, "SELECT * FROM addons");
            while ($allAddonRow = mysqli_fetch_assoc($allAddonsResult)) {
                echo "<option value='" . $allAddonRow['addon_id'] . "'>" . $allAddonRow['addon_name'] . "</option>";
            }
            echo "</select>";
            echo "<label for='combo_package'>Combo Package:</label>";
            echo "<input type='checkbox' id='combo_package' name='combo_package'" . ($bookingRow['combo_package'] ? ' checked' : '') . ">";
            echo "<input type='submit' name='update' value='Update Booking'>";
            echo "<input type='submit' name='cancel' value='Cancel Booking'>";
            echo "</form>";
            echo "</div>";
        }
        ?>
    </div>

<?php
    include('dependencies/footer.php');
?>