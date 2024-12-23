<?php
// Connect to the database (replace with your database credentials)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ihcrs_database";

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch appointment data from the database
$sql = "SELECT * FROM appointment_book;";
$result = $conn->query($sql);

// Check if there are any rows returned
if ($result->num_rows > 0) {
    // Output the appointment data in table rows
    while ($row = $result->fetch_assoc()) {
        echo '<tr>';
        echo '<td>' . $row['id'] . '</td>';
        echo '<td>' . $row['appointment_date'] . '</td>';
        echo '<td>' . $row['appointment_time'] . '</td>';
        
        // Calculate the left_date based on the date_made
        $appointmentDate = strtotime($row['appointment_date']);
        $currentDate = time();
        $remainingDays = floor(($appointmentDate - $currentDate) / (60 * 60 * 24));

        echo '<td id="left-' . $row['id'] . '">' . $remainingDays . ' days left</td>';
        
        echo '<td>' . $row['doctor'] . '</td>';
        echo '<td>' . $row['specialty'] . '</td>';

        // Generate the status column dynamically based on conditions
        
       

        echo '<td>' . $row['status'] . '</td>';
        echo '</tr>';
    }
} else {
    echo '<tr><td colspan="7">No appointments found.</td></tr>';
}

// Close the database connection
$conn->close();
?>
