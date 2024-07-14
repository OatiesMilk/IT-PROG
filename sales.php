<?php
// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sales_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch sales report data
$sql = "SELECT source, amount FROM sales_report";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sales Report</title>
    <link rel="stylesheet" href="/IT-PROG/MP/css/main_menu.css">
</head>
<body>
    <h1>Sales Report</h1>
    <p>Offers a breakdown analysis of the income generated from ticket sales, item purchases, and other sources of revenue. Enables administrators to track revenue trends over time and identify opportunities for growth.</p>

    <h2>Revenue Breakdown</h2>
    <table>
        <tr>
            <th>Source</th>
            <th>Amount</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            // Output data of each row
            while($row = $result->fetch_assoc()) {
                echo "<tr><td>" . $row["source"]. "</td><td>$" . number_format($row["amount"], 2) . "</td></tr>";
            }
        } else {
            echo "<tr><td colspan='2'>No data available</td></tr>";
        }
        ?>
    </table>

    <h2>Revenue Trends</h2>
    <p>Insert chart or graph here to show trends over time.</p>

</body>
</html>

<?php
// Close connection
$conn->close();
?>
