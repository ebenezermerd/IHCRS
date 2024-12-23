<?php
class AppointmentForm
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function submitAppointment()
    {
        // Check if the form is submitted
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Get form data
            $name = $_POST["name"];
            $email = $_POST["email"];
            $phone = $_POST["phone"];
            $specialty = $_POST["Speciality"];
            $doctor = $_POST["doctor"];
            $appointmentDate = $_POST["date"];
            $appointmentTime = $_POST["time"];

            // Prepare and bind the form data
            $stmt = $this->conn->prepare("INSERT INTO appointment_book (full_name, email, phone, specialty, doctor, appointment_date, appointment_time) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("sssssss", $name, $email, $phone, $specialty, $doctor, $appointmentDate, $appointmentTime);

            // Execute the statement
            $stmt->execute();

            // Close the statement
            $stmt->close();
            header("Location: appoint.php");
            exit();
        }
    }
}
?>
