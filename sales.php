<?php
$servername = "localhost";
$username = "root"; // your database username
$password = ""; // your database password
$dbname = "sales_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to get sales data
$sql = "SELECT product_name, SUM(quantity) AS total_quantity, SUM(price * quantity) AS total_revenue, sale_date FROM sales GROUP BY product_name, sale_date ORDER BY sale_date";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Display the data in a table
    echo "<table border='1'>
            <tr>
                <th>Date</th>
                <th>Product Name</th>
                <th>Total Quantity</th>
                <th>Total Revenue</th>
            </tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row["sale_date"] . "</td>
                <td>" . $row["product_name"] . "</td>
                <td>" . $row["total_quantity"] . "</td>
                <td>" . $row["total_revenue"] . "</td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}

$conn->close();
?>