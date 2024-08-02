<?php
$servername = "localhost";
$username = "root"; // your database username
$password = ""; // your database password
$dbname = "feedback_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to get feedback data
$sql = "SELECT product_name, AVG(rating) AS average_rating, COUNT(*) AS total_reviews FROM feedback GROUP BY product_name ORDER BY average_rating DESC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Display the data in a table
    echo "<table border='1'>
            <tr>
                <th>Product Name</th>
                <th>Average Rating</th>
                <th>Total Reviews</th>
            </tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row["product_name"] . "</td>
                <td>" . round($row["average_rating"], 2) . "</td>
                <td>" . $row["total_reviews"] . "</td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}

$conn->close();
?>