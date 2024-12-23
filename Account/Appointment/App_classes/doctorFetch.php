<?php
class DoctorFetcher
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function fetchDoctors($selectedSpecialty)
    {
        // Prepare and execute a query to fetch doctors based on the selected specialty
        $stmt = $this->conn->prepare("SELECT Fname FROM doctors WHERE Speciality = ?");
        $stmt->bind_param("s", $selectedSpecialty);
        $stmt->execute();
        
        $doctorName = [];
        // Bind the result and fetch the rows
        $stmt->bind_result($doctorName);
        
        $doctorsName = []; // Declare the variable here
        
        while ($stmt->fetch()) {
            $doctorsName[] = $doctorName;
        }

        // Close the statement
        $stmt->close();

        // Return the doctors as JSON response
        return json_encode($doctorsName);
    }
}
?>
