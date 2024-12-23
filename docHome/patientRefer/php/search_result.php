<!-- <?php
// Retrieve the patient ID from the form submission
// if (isset($_POST['patient_id'])) {
//     $patientId = $_POST['patient_id'];

//     // Connect to the database
//     $servername = "localhost";
//     $username = "root";
//     $password = "";
//     $dbname = "ihcrs_database";

//     $conn = new mysqli($servername, $username, $password, $dbname);
//     if ($conn->connect_error) {
//         die("Connection failed: " . $conn->connect_error);
//     }

//     // Prepare the SQL statement
//     $sql = "SELECT * FROM patient WHERE patient_id = $patientId";

//     // Bind the patient ID parameter to the statement
//     $result = $conn->query($sql);

//     // Get the 

//     // Check if any rows were returned
//     if ($result->num_rows > 0) {
//         // Display the table header
//         echo '<table class="patient-table">';
//         echo '<thead>';
//         echo '<tr>';
//         echo '<th>Patient Name</th>';
//         echo '<th>Age</th>';
//         echo '<th>Sex</th>';
//         echo '<th>Region</th>';
//         echo '<th>Phone</th>';
//         echo '<th>Status</th>';
//         echo '</tr>';
//         echo '</thead>';
//         echo '<tbody>';

//         // Loop through the result set
//         while ($row = $result->fetch_assoc()) {
//             $fullName = $row['full_name'];
//             $age = $row['age'];
//             $sex = $row['sex'];
//             $region = $row['region'];
//             $phone = $row['phone'];
//             $status = $row['status'];

//             // Display a table row for each patient
//             echo '<tr>';
//             echo '<td>' . $fullName . '</td>';
//             echo '<td>' . $age . '</td>';
//             echo '<td>' . $sex . '</td>';
//             echo '<td>' . $region . '</td>';
//             echo '<td>' . $phone . '</td>';
//             echo '<td>' . $status . '</td>';
//             echo '</tr>';
//         }

//         // Close the table
//         echo '</tbody>';
//         echo '</table>';
//     } else {
//         // No matching patient found
//         echo "<p>No patient found with ID: " . $patientId . "</p>";
//     }

//     // Close the database connection
//     $stmt->close();
//     $conn->close();
// }
// ?>
//////////////////////////////// from adane  -->
<?php
class DB_con
{
    public $db_host = "localhost";
    public $db_user = "root";
    public $db_pass = "";
    public $db_name = "ihcrs_database";
    public $db_conn;
    public function __construct()
    {
        $this->db_conn = new mysqli($this->db_host, $this->db_user, $this->db_pass, $this->db_name);
        if ($erro = $this->db_conn->connect_error)
            die("<scri>alert('Error when try to connect ')</script> $erro");
        else
            echo '<script>
            console.log("Successfully connected to database");
        </script>';
    }
    public function insert($fname, $lname, $depart)
    {
        $sql = "INSERT INTO `mydata` (`id`, `fName`, `lName`, `Depart0`) VALUES (NULL, '$fname', '$lname', '$depart')";
        $result = $this->db_conn->query($sql);
        if ($result)
            return 1;
        else
            return 0;
    }
    public function fetchdata()
    {
        $sql = "SELECT * FROM myData";
        $result = $this->db_conn->query($sql);
        if ($result)
            return $result;
        else
            return null;
    }
    public function fetchonrecord($tablename,$id)
    {
        $sql = "SELECT * FROM $tablename WHERE `id`= $id";
        $result = $this->db_conn->query($sql);
        $re = mysqli_fetch_assoc($result);
        if ($re)
            return $re;
        else
            return null;
    }
    public function update($id, $fname, $lname, $depatr)
    {
        $sql = "UPDATE `mydata` SET `fName` = '$fname', `lName` = '$lname', `Depart0` = '$depatr' WHERE `mydata`.`id` = $id;";
        $result = $this->db_conn->query($sql);
        if ($result) {
            print "<script> 
            console.log("."successfully updated".");
            </script>";
            return 1;
        } else
            return 0;

    }
    public function delete($id)
    {
        $sql = "DELETE FROM myData WHERE id = $id";
        $result = $this->db_conn->query($sql);
        if ($result)
            return 1;
        else
            return 0;
    }
    public function close()
    {
        $this->db_conn->close();
    }

}

$obj = new DB_con();
?>