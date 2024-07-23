<?php
    $title = "Review";
    include('dependencies/header.php');
?>

<style>
    <?php include('css/review_page.css'); ?>
    <?php include('css/header.css'); ?>
    <?php include('css/footer.css'); ?>
</style>

<?php
    // Database connection
    include('config.php');
    $conn = mysqli_connect($localhost, "root", "", $database);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Fetch all events from the database
    $eventsQuery = "SELECT * FROM events";
    $eventsResult = mysqli_query($conn, $eventsQuery);

    // Fetch reviews from the database
    $reviewsQuery = "SELECT * FROM reviews";
    $reviewsResult = mysqli_query($conn, $reviewsQuery);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $event_name = mysqli_real_escape_string($conn, $_POST['event_name']);
        $reviewer = mysqli_real_escape_string($conn, $_POST['reviewer']);
        $comment = mysqli_real_escape_string($conn, $_POST['comment']);
        
        // Insert data into the database
        $sql = "INSERT INTO reviews (event_name, reviewer, comment) 
                VALUES ('$event_name', '$reviewer', '$comment')";

        if (mysqli_query($conn, $sql)) {
            echo "Event review submitted successfully.";
            // Redirect to the main menu after successful review
            header("Location: main_menu.php");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }

    mysqli_close($conn);
?>

<!-- content -->
<div class="content">
    <div class="review-box">
        <div class="write-review">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" id="review_form" onsubmit="return setEventName()">
                <label for="event">Select Event:</label>
                <select id="event" name="event" required>
                    <?php
                        while ($eventRow = mysqli_fetch_assoc($eventsResult)) {
                            echo "<option value='" . htmlspecialchars($eventRow['event_name'], ENT_QUOTES) . "'>" . htmlspecialchars($eventRow['event_name'], ENT_QUOTES) . "</option>";
                        }
                    ?>
                </select><br><br>  
                <input type="hidden" id="event_name" name="event_name">

                <label for="reviewer">Name:</label><br>
                <input type="text" id="reviewer" name="reviewer" required><br><br>
                
                <label for="comment">Review:</label><br>
                <textarea id="comment" name="comment" required></textarea><br><br>
                
                <button type="submit">Submit Review</button>
            </form>
        </div>

        <div class="previous-reviews">
            <div class="prev-header">
                <h2>Previous Reviews</h2>
            </div>

            <div class="results-section">
            <?php
            if (mysqli_num_rows($reviewsResult) > 0) {
                while ($reviewRow = mysqli_fetch_assoc($reviewsResult)) {
                    echo "<div class='review'>";
                    echo "<h3>" . htmlspecialchars($reviewRow['event_name'], ENT_QUOTES) . "</h3>";
                    echo "<p><strong>Reviewer:</strong> " . htmlspecialchars($reviewRow['reviewer'], ENT_QUOTES) . "</p>";
                    echo "<p><strong>Comment:</strong> " . htmlspecialchars($reviewRow['comment'], ENT_QUOTES) . "</p>";
                    echo "</div>";
                }
            } else {
                echo "<p>No reviews available.</p>";
            }
            ?>
            </div>
        </div>
    </div>

    <form action="main_menu.php" method="get">
        <button>
            Return to Previous Page
        </button>
    </form> 
</div>
<!-- end of content -->

<script>
    function setEventName() {
        var eventSelect = document.getElementById("event");
        var eventNameInput = document.getElementById("event_name");
        eventNameInput.value = eventSelect.value;
        return true;
    }
</script>

<?php
    include('dependencies/footer.php');
?>