<?php include 'db_connect.php'; ?>

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
    <?php
    // Fetch sales report data for revenue breakdown
    $sqlBreakdown = "SELECT source, SUM(amount) as total_amount FROM sales_report GROUP BY source";
    $resultBreakdown = $conn->query($sqlBreakdown);

    echo "<table border='1'><tr><th>Source</th><th>Amount</th></tr>";
    if ($resultBreakdown->num_rows > 0) {
        while($row = $resultBreakdown->fetch_assoc()) {
            echo "<tr><td>" . htmlspecialchars($row["source"]) . "</td><td>$" . number_format($row["total_amount"], 2) . "</td></tr>";
        }
    } else {
        echo "<tr><td colspan='2'>No data available</td></tr>";
    }
    echo "</table>";
    ?>

    <h2>Revenue Trends</h2>
    <p>Insert chart or graph here to show trends over time.</p>

    <h2>Sales Reports</h2>
    <!-- Filter Form -->
    <form method="GET" action="">
        <label for="dateFilter">Filter by Date:</label>
        <input type="date" id="dateFilter" name="dateFilter" value="<?php echo htmlspecialchars($dateFilter); ?>">
        <button type="submit">Filter</button>
    </form>

    <?php
    // Get the filter value
    $dateFilter = isset($_GET['dateFilter']) ? $_GET['dateFilter'] : '';

    // Fetch sales data with optional date filtering
    $sqlSales = "SELECT * FROM sales";
    if ($dateFilter) {
        $sqlSales .= " WHERE date = '$dateFilter'";
    }
    $resultSales = $conn->query($sqlSales);

    echo "<table border='1'><tr><th>ID</th><th>Amount</th><th>Date</th></tr>";
    if ($resultSales->num_rows > 0) {
        while($row = $resultSales->fetch_assoc()) {
            echo "<tr><td>" . htmlspecialchars($row['id']) . "</td><td>$" . number_format($row['amount'], 2) . "</td><td>" . htmlspecialchars($row['date']) . "</td></tr>";
        }
    } else {
        echo "<tr><td colspan='3'>No sales data available.</td></tr>";
    }
    echo "</table>";
    ?>

    <!-- Buttons for additional functionalities -->
    <button onclick="window.location.href='download_sales_report.php'">Download Report</button>
    <button onclick="window.location.href='main_menu.php'">Back to Main Menu</button>

</body>
</html>

<?php
// Close connection
$conn->close();
?>
