<?php
include 'config.php';

// Handle form submissions
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['create-event'])) {
        // Create event logic
        $name = $_POST['event-name'];
        $description = $_POST['event-description'];
        $date = $_POST['event-date'];
        $time = $_POST['event-time'];
        $venue = $_POST['event-venue'];
        $capacity = $_POST['event-capacity'];
        $categories = $_POST['event-categories'];

        $sql = "INSERT INTO events (name, description, date, time, venue, capacity, categories)
                VALUES ('$name', '$description', '$date', '$time', '$venue', '$capacity', '$categories')";

        if ($conn->query($sql) === TRUE) {
            echo "New event created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } elseif (isset($_POST['edit-event'])) {
        // Edit event logic
        $id = $_POST['edit-event-id'];
        $name = $_POST['edit-event-name'];
        $description = $_POST['edit-event-description'];
        $date = $_POST['edit-event-date'];
        $time = $_POST['edit-event-time'];
        $venue = $_POST['edit-event-venue'];
        $capacity = $_POST['edit-event-capacity'];
        $categories = $_POST['edit-event-categories'];

        $sql = "UPDATE events SET 
                name='$name', 
                description='$description', 
                date='$date', 
                time='$time', 
                venue='$venue', 
                capacity='$capacity', 
                categories='$categories' 
                WHERE id=$id";

        if ($conn->query($sql) === TRUE) {
            echo "Event updated successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } elseif (isset($_POST['delete-event'])) {
        // Delete event logic
        $id = $_POST['delete-event-id'];

        $sql = "DELETE FROM events WHERE id=$id";

        if ($conn->query($sql) === TRUE) {
            echo "Event deleted successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } elseif (isset($_POST['schedule-event'])) {
        // Schedule event logic
        $id = $_POST['schedule-event-id'];
        $date = $_POST['schedule-event-date'];
        $time = $_POST['schedule-event-time'];

        $sql = "UPDATE events SET date='$date', time='$time' WHERE id=$id";

        if ($conn->query($sql) === TRUE) {
            echo "Event scheduled successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } elseif (isset($_POST['manage-categories'])) {
        // Manage categories logic
        $categories = $_POST['event-categories'];

        $sql = "UPDATE categories_table SET categories='$categories'";

        if ($conn->query($sql) === TRUE) {
            echo "Categories/Tags updated successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Management Page</title>
    <link rel="stylesheet" href="/IT-PROG/MP/css/main_menu.css">
</head>
<body>
    <h1>Event Management</h1>

    <!-- Create Event Form -->
    <h2>Create Event</h2>
    <form id="create-event-form" action="" method="POST">
        <label for="event-name">Name:</label><br>
        <input type="text" id="event-name" name="event-name" required><br>

        <label for="event-description">Description:</label><br>
        <textarea id="event-description" name="event-description" required></textarea><br>

        <label for="event-date">Date:</label><br>
        <input type="date" id="event-date" name="event-date" required><br>

        <label for="event-time">Time:</label><br>
        <input type="time" id="event-time" name="event-time" required><br>

        <label for="event-venue">Venue:</label><br>
        <input type="text" id="event-venue" name="event-venue" required><br>

        <label for="event-capacity">Capacity:</label><br>
        <input type="number" id="event-capacity" name="event-capacity" required><br>

        <label for="event-categories">Categories/Tags:</label><br>
        <input type="text" id="event-categories" name="event-categories" placeholder="Separate by commas" required><br><br>

        <input type="hidden" name="create-event" value="1">
        <button type="submit">Create Event</button>
    </form>

    <!-- Edit Event Form -->
    <h2>Edit Event</h2>
    <form id="edit-event-form" action="" method="POST">
        <label for="edit-event-id">Event ID:</label><br>
        <input type="text" id="edit-event-id" name="edit-event-id" required><br>

        <label for="edit-event-name">Name:</label><br>
        <input type="text" id="edit-event-name" name="edit-event-name"><br>

        <label for="edit-event-description">Description:</label><br>
        <textarea id="edit-event-description" name="edit-event-description"></textarea><br>

        <label for="edit-event-date">Date:</label><br>
        <input type="date" id="edit-event-date" name="edit-event-date"><br>

        <label for="edit-event-time">Time:</label><br>
        <input type="time" id="edit-event-time" name="edit-event-time"><br>

        <label for="edit-event-venue">Venue:</label><br>
        <input type="text" id="edit-event-venue" name="edit-event-venue"><br>

        <label for="edit-event-capacity">Capacity:</label><br>
        <input type="number" id="edit-event-capacity" name="edit-event-capacity"><br>

        <label for="edit-event-categories">Categories/Tags:</label><br>
        <input type="text" id="edit-event-categories" name="edit-event-categories" placeholder="Separate by commas"><br><br>

        <input type="hidden" name="edit-event" value="1">
        <button type="submit">Edit Event</button>
    </form>

    <!-- Delete Event Form -->
    <h2>Delete Event</h2>
    <form id="delete-event-form" action="" method="POST">
        <label for="delete-event-id">Event ID:</label><br>
        <input type="text" id="delete-event-id" name="delete-event-id" required><br><br>

        <input type="hidden" name="delete-event" value="1">
        <button type="submit">Delete Event</button>
    </form>

    <!-- Schedule Event Form -->
    <h2>Schedule Event</h2>
    <form id="schedule-event-form" action="" method="POST">
        <label for="schedule-event-id">Event ID:</label><br>
        <input type="text" id="schedule-event-id" name="schedule-event-id" required><br>

        <label for="schedule-event-date">Date:</label><br>
        <input type="date" id="schedule-event-date" name="schedule-event-date" required><br>

        <label for="schedule-event-time">Time:</label><br>
        <input type="time" id="schedule-event-time" name="schedule-event-time" required><br><br>

        <input type="hidden" name="schedule-event" value="1">
        <button type="submit">Schedule Event</button>
    </form>

    <!-- Manage Event Categories/Tags -->
    <h2>Manage Event Categories/Tags</h2>
    <form id="manage-categories-form" action="" method="POST">
        <label for="event-categories">Categories/Tags:</label><br>
        <input type="text" id="event-categories" name="event-categories" placeholder="Separate by commas" required><br><br>

        <input type="hidden" name="manage-categories" value="1">
        <button type="submit">Update Categories/Tags</button>
    </form>
</body>
</html>
