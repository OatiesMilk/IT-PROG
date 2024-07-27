<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create an Event</title>
    <link rel="stylesheet" href="css/event_creation.css">
</head>
<body>

<?php
    // Database connection
    include('config.php');
    $conn = mysqli_connect($localhost, "root", "", $database);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Collect and sanitize input data
        $event_name = mysqli_real_escape_string($conn, $_POST['event_name']);
        $description = mysqli_real_escape_string($conn, $_POST['description']); // Hash the password
        $date = mysqli_real_escape_string($conn, $_POST['date']);
        $time = mysqli_real_escape_string($conn, $_POST['time']);
        $venue = mysqli_real_escape_string($conn, $_POST['venue']);
        $capacity = mysqli_real_escape_string($conn, $_POST['capacity']);

        // Get the current max account_id
        $result = mysqli_query($conn, "SELECT MAX(event_id) AS max_id FROM events");
        $row = mysqli_fetch_assoc($result);
        $new_event_id = $row['max_id'] + 1;

        // Insert data into the database with the new account_id
        $sql = "INSERT INTO events (event_id, event_name, description, date, time, venue, capacity) 
                VALUES ('$new_event_id', '$event_name', '$description', '$date', '$time', '$venue', '$capacity')";

        if (mysqli_query($conn, $sql)) {
            echo "New event created successfully.";
            // Redirect to the login page after successful registration
            header("Location: event_management.php");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }

    // Close the database connection
    mysqli_close($conn);
?>

<div class="container">
    <h2>Create Event</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" id="register_form">
        <label for="event_name">Event Name:</label>
        <input type="text" id="event_name" name="event_name" required>

        <label for="description">Description:</label>
        <textarea id="description" name="description" required></textarea>

        <label for="date">Date:</label>
        <input type="date" id="date" name="date" required>

        <label for="time">Time:</label>
        <input type="time" id="time" name="time" value="12:00" required>

        <label for="venue">Venue:</label>
        <input type="text" id="venue" name="venue" required>

        <label for="capacity">Capacity:</label>
        <input type="number" id="capacity" name="capacity" required>

        <input type="submit" value="Create Event">
    </form>

    <form action="event_management.php" method="get">
        <button type="submit">
            Return to previous page
        </button>
    </form>
</div>

</body>
</html>