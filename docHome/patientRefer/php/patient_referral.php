<?php
class PatientReferral {
    private $conn;
    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $database = "ihcrs_database";
    private $table = 'patient_referral';

    public function __construct() {
        $this->conn = new mysqli($this->host,$this->username, $this->password, $this->database);

        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function insertData($data) {
        $stmt = $this->conn->prepare("INSERT INTO $this->table (patient_id, full_name, surname, surgery, phone, mobile, fax, email, address, post_code, transport, referral_to) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        if (!$stmt) {
            die("Error: " . $this->conn->error); // Print out the error message
        }
        $stmt->bind_param("ssssssssssss", $data['patient_id'], $data['full_name'], $data['surname'], $data['surgery'], $data['phone'], $data['mobile'], $data['fax'], $data['email'], $data['address'], $data['post_code'], $data['transport_requirement'], $data['referral_to']);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function closeConnection() {
        $this->conn->close();
    }


// Create an instance of the class and establish a database connectio
public function getFormData() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $data = array(
            'patient_id' => $_POST['patient_id'],
            'full_name' => $_POST['full_name'],
            'surname' => $_POST['surname'],
            'surgery' => $_POST['surgery'],
            'phone' => $_POST['phone'],
            'mobile' => $_POST['mobile'],
            'fax' => $_POST['fax'],
            'email' => $_POST['email'],
            'address_line' => $_POST['address_line'],
            'postcode' => $_POST['postcode'],
            'transport_requirement' => $_POST['transport_requirement'],
            'referral_to' => $_POST['referral_to']
        );

        return $data;
    }

    return null;
}

}
$patientReferral = new PatientReferral();

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
// Retrieve the form data
$data = $patientReferral->getFormData();

// Insert the data
if ($data !== null && $patientReferral->insertData($data)) {
    echo "Data inserted successfully.";
     header("Location: ../index.php"); 
        exit(); // Stop executing the rest of the code
} else {
    echo "Error inserting data.";
}
}

$patientReferral->closeConnection();
?>