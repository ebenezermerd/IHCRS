<?php
require_once "class.php";
class insert extends DB_con
{

  


    // Generate a random patient ID
    function generatePatientID()
    {
        $characters = '0123456789';
        $idLength = 10;
        $patientID = '';
        for ($i = 0; $i < $idLength; $i++) {
            $randIndex = rand(0, strlen($characters) - 1);
            $patientID .= $characters[$randIndex];
        }
        return $patientID;
    }
    function generatePatientPass()
    {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $idLength = 16;
        $patientID = '';
        for ($i = 0; $i < $idLength; $i++) {
            $randIndex = rand(0, strlen($characters) - 1);
            $patientID .= $characters[$randIndex];
        }
        return $patientID;
    }


}
$insertion = new insert();
if (isset($_POST['patient_register'])) {
    // code to handle form submission
    $name = $_POST['name'];
    $age = $_POST['Age'];
    $dob = $_POST['dob'];
    $regLoc = $_POST['regLoc'];

    $city = $_POST['city'];
    $region = $_POST['Region'];
    $pnum = $_POST['pnum'];
    $email = $_POST['email'];
    $pass =  $_POST['password'];
    $p_id = $insertion->generatePatientID();
    $data = array(
        "patient_id" => $p_id,
        "full_name" => $name,
        "age" => $age,
        "birth_date" => $dob,
        "location" => $regLoc,
        "date" => date('d/m/y'),
        "city" => $city,
        "region" => $region,
        "phone" => $pnum,
        "email" => $email,
        "password" => $pass
    );

    $x = $insertion->insert('patient', $data);
    $dat = array(
        "patient_id" => $p_id,
        "full_name" => $name,
        "birth_date" => $dob,
        "location" => $regLoc,
        "date" => date('d/m/y'),
        "city" => $city,
        "region" => $region,
        "phone" => $pnum,
    );
    $x = $insertion->insert('All_record', $dat);
    
    if ($x) {
        ?>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" id="myForm">
            <input type="hidden" value="<?php echo  $email?>" name="email"><br><br>
            <input type="hidden" value="<?php echo  $pass?> "name="password"><br><br>
        </form>
        <script>
		window.onload = function() {
			document.getElementById("myForm").submit();

			var newWindow = window.open('', '_blank', 'height=500,width=500');
			newWindow.location.href = 'card.php?email=<?php echo  $email?>&password=<?php echo  $pass?>&name=<?php echo  $name?>'; 
			window.location.href = '../dispaly_patient.php';
			
		}
	</script>
        <?php
        header("Location:../patient_rigister.php");
    }
    
    else {
        echo "error";
    }
} ?>
<h1>registration info </h1>