<?php
include 'db_connect.php';

header('Content-Type: text/csv');
header('Content-Disposition: attachment;filename=feedback_report.csv');

$output = fopen('php://output', 'w');
fputcsv($output, array('Event', 'Rating', 'Comments'));

$sql = "SELECT event, rating, comments FROM feedback";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        fputcsv($output, $row);
    }
}

fclose($output);
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report Download</title>
    <link rel="stylesheet" href="/IT-PROG/MP/css/main_menu.css">
    <meta http-equiv="refresh" content="5;url=main_feedback_report.php">
</head>
<body>
    <h1>Report Download</h1>
    <p>Your report should have downloaded. You will be redirected back to the <a href="main_feedback_report.php">Feedback Report</a> in a few seconds.</p>
</body>
</html>
