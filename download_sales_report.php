<?php
include 'db_connect.php';

header('Content-Type: text/csv');
header('Content-Disposition: attachment;filename=sales_report.csv');

$output = fopen('php://output', 'w');
fputcsv($output, array('ID', 'Amount', 'Date'));

$sql = "SELECT id, amount, date FROM sales";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        fputcsv($output, $row);
    }
}

fclose($output);
$conn->close();
?>
