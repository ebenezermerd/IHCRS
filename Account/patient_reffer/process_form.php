<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'your_database_name');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch patient data
$sql = "SELECT * FROM patient_referral WHERE id = 1"; // Replace '1' with the desired patient ID
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo '<label for="patient-id">Patient ID:</label>';
    echo '<input type="text" id="patient-id" name="patient_id" value="' . $row['patient_id'] . '" readonly>';
    echo '<label for="first-name">First Name:</label>';
    echo '<input type="text" id="first-name" name="first_name" value="' . $row['first_name'] . '" readonly>';
    echo '<label for="surname">Surname:</label>';
    echo '<input type="text" id="surname" name="surname" value="' . $row['surname'] . '" readonly>';
    echo '<label for="surgery">Surgery:</label>';
    echo '<input type="text" id="surgery" name="surgery" value="' . $row['surgery'] . '" readonly>';
    echo '<label for="phone">Phone:</label>';
    echo '<input type="text" id="phone" name="phone" value="' . $row['phone'] . '" readonly>';
    echo '<label for="mobile">Mobile:</label>';
    echo '<input type="text" id="mobile" name="mobile" value="' . $row['mobile'] . '" readonly>';
} else {
    echo '<p>No patient found.</p>';
}

// Fetch referral data
$sql = "SELECT * FROM referral_table WHERE patient_id = 1"; // Replace '1' with the desired patient ID
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo '<label for="fax">Fax:</label>';
    echo '<input type="text" id="fax" name="fax" value="' . $row['fax'] . '" readonly>';
    echo '<label for="email">Email:</label>';
    echo '<input type="email" id="email" name="email" value="' . $row['email'] . '" readonly>';
    echo '<label for="address-line1">Address Line 1:</label>';
    echo '<input type="text" id="address-line1" name="address_line1" value="' . $row['address_line'] . '" readonly>';
    echo '<label for="postcode">Postcode:</label>';
    echo '<input type="text" id="postcode" name="postcode" value="' . $row['post_code'] . '" readonly>';
    echo '<label for="transport-requirement">Transport Requirement:</label>';
    echo '<select id="transport-requirement" name="transport_requirement" disabled >';
    echo '<option value="yes"' . ($row['transport_requirement'] == 'yes' ? ' selected' : '') . ' readonly>Yes</option>';
    echo '<option value="no"' . ($row['transport_requirement'] == 'no' ? ' selected' : '') . ' readonly>No</option>';
    echo '</select>';
    echo '<label for="referral">Referral To:</label>';
    echo '<input type="text" id="referral" name="referral" value="' . $row['referral'] . '" readonly>';
} else {
    echo '<p>No referral data found.</p>';
}

// Close the database connection
$conn->close();
?>
