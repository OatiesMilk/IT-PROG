<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reviews and Feedback</title>
    <link rel="stylesheet" href="/IT-PROG/MP/css/reviews_feedback.css">
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

    if (!isset($_SESSION['username'])) {
        echo "Please log in to submit a review.";
        exit();
    }

    $username = $_SESSION['username'];

    // Fetch user account_id
    $userQuery = "SELECT account_id FROM accounts WHERE username='$username'";
    $userResult = mysqli_query($conn, $userQuery);
    $userRow = mysqli_fetch_assoc($userResult);
    $account_id = $userRow['account_id'];

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $event_id = mysqli_real_escape_string($conn, $_POST['event_id']);
        $rating = mysqli_real_escape_string($conn, $_POST['rating']);
        $feedback = mysqli_real_escape_string($conn, $_POST['feedback']);

        // Check if the user has attended the event
        $attendedQuery = "SELECT * FROM bookings WHERE account_id='$account_id' AND event_id='$event_id'";
        $attendedResult = mysqli_query($conn, $attendedQuery);

        if (mysqli_num_rows($attendedResult) > 0) {
            // Insert the review into the database
            $insertQuery = "INSERT INTO reviews (username, event_id, rating, feedback) VALUES ('$username', '$event_id', '$rating', '$feedback')";
            mysqli_query($conn, $insertQuery);
            echo "Review submitted successfully.";
        } else {
            echo "You can only review events you have attended.";
        }
    }

    // Fetch reviews and events (including historical/archived)
    $reviewsQuery = "SELECT r.*, e.event_name, e.date FROM reviews r JOIN events e ON r.event_id = e.event_id ORDER BY e.date DESC";
    $reviewsResult = mysqli_query($conn, $reviewsQuery);

    // Close the database connection
    mysqli_close($conn);
    ?>

    <div class="container">
        <h2>Reviews and Feedback</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <label for="event_id">Event ID:</label>
            <input type="number" id="event_id" name="event_id" required>

            <label for="rating">Rating (1-5):</label>
            <input type="number" id="rating" name="rating" min="1" max="5" required>

            <label for="feedback">Feedback:</label>
            <textarea id="feedback" name="feedback" required></textarea>

            <input type="submit" value="Submit Review">
        </form>
        <div class="reviews">
            <?php
            while ($reviewRow = mysqli_fetch_assoc($reviewsResult)) {
                echo "<div class='review'>";
                echo "<h3>Event: " . $reviewRow['event_name'] . " (Date: " . $reviewRow['date'] . ")</h3>";
                echo "<p>Rating: " . $reviewRow['rating'] . "</p>";
                echo "<p>Feedback: " . $reviewRow['feedback'] . "</p>";
                echo "</div>";
            }
            ?>
        </div>
    </div>
</body>
</html>
