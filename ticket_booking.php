<?php
    $title = "Ticket Booking";
    include('dependencies/header.php');
?>

<style>
    <?php include('css/ticket_booking.css');?>
    <?php include('css/header.css');?>
    <?php include('css/footer.css');?>
</style>

<?php
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
    
    // Fetch user data
    $userQuery = "SELECT account_id, firstname, lastname, email, mobile_num FROM accounts WHERE username='$username'";
    $userResult = mysqli_query($conn, $userQuery);
    $userRow = mysqli_fetch_assoc($userResult);
    $account_id = $userRow['account_id'];
    $firstname = $userRow['firstname'];
    $lastname = $userRow['lastname'];
    $email = $userRow['email'];
    $mobile_num = $userRow['mobile_num'];

    // Generate a unique booking_id
    do {
        $booking_id = rand(1, 1000);
        $checkQuery = "SELECT * FROM bookings WHERE booking_id='$booking_id'";
        $checkResult = mysqli_query($conn, $checkQuery);
    } while (mysqli_num_rows($checkResult) > 0);

    // Insert booking into the database
    $sql = "INSERT INTO bookings (account_id, event_id, booking_id, username, firstname, lastname, email, mobile_num) 
            VALUES ('$account_id', '$event_id', '$booking_id', '$username', '$firstname', '$lastname', '$email', '$mobile_num')";
    if (mysqli_query($conn, $sql)) {
        $booking_id = mysqli_insert_id($conn);
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

        <label for="addons">Select an Add-on:</label>
        <select id="addons" name="addons[]" required>
            <option value="" selected>None</option>
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