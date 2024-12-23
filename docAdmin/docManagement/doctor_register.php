<?php
// Initialize variables with empty values
$firstname = $lastname = $speciality = $dateofbirth = $region = $registrationdate = $city = $phonenumber = $email = $password = "";
$registration_err = "";

if (isset($_POST['submit'])) {
    $db = "ihcrs_database";
    $dbpassword = "";
    $con = new mysqli("localhost", "root", $dbpassword, $db);
    
    // Check connection
    if ($con->connect_error) {
        die("Connection failed: " . $con->connect_error);
    }
    
    // Validate and sanitize input
    $firstname = trim($_POST['Fname']);
    $lastname = trim($_POST['lname']);
    $speciality = trim($_POST['specialty']);
    $dateofbirth = trim($_POST['dob']);
    $region = trim($_POST['Region']);
    $registrationdate = trim($_POST['regDate']);
    $city = trim($_POST['city']);
    $phonenumber = trim($_POST['pnum']);
    $email = trim($_POST['email']);
    $password = trim($_POST['pass']);
    
    // Basic validation
    if(empty($firstname) || empty($lastname) || empty($speciality) || empty($dateofbirth) || 
       empty($region) || empty($registrationdate) || empty($city) || empty($phonenumber) || 
       empty($email) || empty($password)) {
        $registration_err = "Please fill all fields";
    } else {
        // Prepare an insert statement
        $sql = "INSERT INTO doctors (Fname, Lname, Speciality, dob, Region, regDate, City, pnum, email, pass) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        
        if($stmt = $con->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("ssssssssss", $firstname, $lastname, $speciality, $dateofbirth, 
                            $region, $registrationdate, $city, $phonenumber, $email, $password);
            
            // Attempt to execute
            if($stmt->execute()) {
                // Redirect to success page
                header("location: display_doctors.php");
                exit();
            } else {
                $registration_err = "Something went wrong. Please try again later.";
            }
            $stmt->close();
        }
    }
    $con->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>IHCRS | Doctor Dashboard</title>

 

  <!-- 
    - google font link
  -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@500;700&family=Rubik:wght@400;500;700&display=swap"
    rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="css/services.css">
  <link rel="stylesheet" href="Hospital.css">
  <link rel="stylesheet" href="css/style.css">

</head>

<body>


  <!-- #HEADER STARTS HERE-->

  <header class="header" data-header>
    <div class="container">

      <a href="#" class="logo">
        <img src="logo.png" width="250" height="46" alt="IHCRS">
      </a>

      <nav class="navbar" data-navbar>

        <div class="navbar-top">

          <a href="#" class="logo">
            <img src="../images/logo.png" width="250" height="46" alt="IHCRS">
          </a>

          <button class="nav-close-btn" >
            <ion-icon name="close-outline"></ion-icon>
          </button>

        </div>

        <ul class="navbar-list">

        <li class="navbar-item">
            <a href="../index.php" class="navbar-link title-md">Home</a>
          </li>

          <li class="navbar-item">
            <a href="../../contactUs/index.php" class="navbar-link title-md">Contact us</a>
          </li>

          <li class="navbar-item">
            <a href="../../aboutUs/index.php" class="navbar-link title-md">About us</a>
          </li>
          
        </ul>

        <ul class="social-list">

          <li>
            <a href="#" class="social-link">
              <ion-icon name="logo-twitter"></ion-icon>
            </a>
          </li>

          <li>
            <a href="#" class="social-link">
              <ion-icon name="logo-facebook"></ion-icon>
            </a>
          </li>

          <li>
            <a href="#" class="social-link">
              <ion-icon name="logo-pinterest"></ion-icon>
            </a>
          </li>

          <li>
            <a href="#" class="social-link">
              <ion-icon name="logo-instagram"></ion-icon>
            </a>
          </li>

          <li>
            <a href="#" class="social-link">
              <ion-icon name="logo-youtube"></ion-icon>
            </a>
          </li>

        </ul>

      </nav>

      <button class="nav-open-btn" aria-label="open menu" data-nav-toggler>
        <ion-icon name="menu-outline"></ion-icon>
      </button>
      
      <div class="profile">
          <div class="profile-in">

          </div>
          <div class="profile-acc"> <h2><a href="../../account/acc.php" style="color:aqua;">Login</a>/<a href="../../account/logout.php" style="color:orangered;">Logout</a></h2> </div>
      </div>


      <div class="overlay" data-nav-toggler data-overlay></div>

    </div>
  </header>
<!--  #HEADER ENDS HERE -->

<div class="wrapper">
  <div class="classList">
  <h1>Register Doctors</h1>
    <div class="Hospital-records">
      <div class="menu">
        <ul>
          <nav class="menu Hospital-management">
            <p><a href="main_page.php">Doctors Management</a></p>
            <ul class="hidden">
              <li><a id = "curr" href="#">Add Doctors</a></li>
              <li><a href="search_doctor.php">Search Doctor</a></li>
              <li><a href="update_doctor.php">Update Doctor</a></li>
              <li><a href="delete_doctors.php">Delete Doctor</a></li>
            </ul>
          </nav>
          <li><a href="display_doctors.php">All Doctors</a></li>
        </ul>
      </div>

      <div class="record-form">
        <!-- Form for adding or editing Hospital records -->
        <h3>Register New Doctor</h3>
      
        <?php 
        if(!empty($registration_err)) {
            echo '<div class="alert alert-danger">' . $registration_err . '</div>';
        }
        ?>
      
          <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <label for="Fname">First Name:</label>
            <input type="text" id="Fname" name="Fname" />
            <label for="lname">Last Name:</label>
            <input type="text" id="lname" name="lname" />

            <label for="dob">Date of Birth:</label>
            <input type="date" id="dob" name="dob" />

            <label for="specialty">Select Specialty:</label>
        <select id="specialty" name="specialty" required>
          <option value="">Choose Specialty</option>
          <option value="general">General</option>
          <option value="cardiology">Cardiology</option>
          <option value="neurologist">Neurologist</option>
          <option value="dermatology">Dermatology</option>
          <!-- Add more options for different specialties -->
        </select>

            <label for="regDate">Registration Date:</label>
            <input type="date" id="regDate" name="regDate" />

            <label for="city">City:</label>
            <input type="text" id="city" name="city" />

            <label for="Region">Region:</label>
            <input type="text" id="Region" name="Region" />

            <label for="pnum">Phone Number:</label>
            <input type="text" id="pnum" name="pnum" />

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" />

            <label for="password">Password:</label>
            <input type="password" id="pass" name="pass" />

            <button type="submit"  name="submit">Register</button>
          </form>
      </div>
    </div>
  </div>
 </div>
<script src="common.js"></script>
  <!--  #FOOTER  -->
  <footer class="footer" style="background-image: url('images/footer-bg.png')">
    <div class="container">

      <div class="section footer-top">

        <div class="footer-brand" data-reveal="bottom">

          <a href="../../home/home.php" class="logo">
            <img src="../images/logo.png" width="225" height="46" loading="lazy" alt="IHCRS">
          </a>

          <ul class="contact-list has-after">

            <li class="contact-item">

              <div class="item-icon">
                <ion-icon name="mail-open-outline"></ion-icon>
              </div>

              <div>
                <p>
                  Main Email : <a href="epnics@mail.com" class="contact-link">Epnics@&shy;website.com</a>
                </p>

                <p>
                  Inquiries : <a href="cassyHome@gmail.com" class="contact-link">cassyHome@mail.com</a>
                </p>
              </div>

            </li>

            <li class="contact-item">

              <div class="item-icon">
                <ion-icon name="call-outline"></ion-icon>
              </div>

              <div>
                <p>
                  Office Telephone : <a href="tel:09760346.." class="contact-link">+251-976-***-****  </a>
                </p>

                <p>
                  Mobile : <a href="tel:04688102.." class="contact-link">046-881-02**</a>
                </p>
              </div>

            </li>

          </ul>

        </div>

        <div class="footer-list" data-reveal="bottom">

          <p class="headline-sm footer-list-title">About Us</p>

          <p class="text">
            Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed
          </p>

          <address class="address">
            <ion-icon name="map-outline"></ion-icon>

            <span class="text">
              2416 Hestons Drive <br>
              mega, FLT 33634
            </span>
          </address>

        </div>

        <ul class="footer-list" data-reveal="bottom">

          <li>
            <p class="headline-sm footer-list-title">Services</p>
          </li>

          <li>
            <a href="#" class="text footer-link">Conditions</a>
          </li>

          <li>
            <a href="#" class="text footer-link">Listing</a>
          </li>

          <li>
            <a href="#" class="text footer-link">How It Works</a>
          </li>

          <li>
            <a href="#" class="text footer-link">What We Offer</a>
          </li>

          <li>
            <a href="#" class="text footer-link">Latest News</a>
          </li>

          <li>
            <a href="#" class="text footer-link">Contact Us</a>
          </li>

        </ul>

        <ul class="footer-list" data-reveal="bottom">

          <li>
            <p class="headline-sm footer-list-title">Useful Links</p>
          </li>

          <li>
            <a href="#" class="text footer-link">Conditions</a>
          </li>

          <li>
            <a href="#" class="text footer-link">Terms of Use</a>
          </li>

          <li>
            <a href="#" class="text footer-link">Our Services</a>
          </li>

          <li>
            <a href="#" class="text footer-link">Join as a Doctor</a>
          </li>

          <li>
            <a href="#" class="text footer-link">New Guests List</a>
          </li>

          <li>
            <a href="#" class="text footer-link">The Team List</a>
          </li>

        </ul>

        <div class="footer-list" data-reveal="bottom">

          <p class="headline-sm footer-list-title">Subscribe</p>

          <form action="" class="footer-form">
            <input type="email" name="email" placeholder="Email" class="input-field title-lg">

            <button type="submit" class="btn has-before title-md">Subscribe</button>
          </form>

          <p class="text">
            Get the latest updates via email. Any time you may unsubscribe
          </p>

        </div>

      </div>

      <div class="footer-bottom">

        <p class="text copyright">
          &copy; IHCRS 2022 | All Rights Reserved by WebDev
        </p>

        <ul class="social-list">

          <li>
            <a href="#" class="social-link">
              <ion-icon name="logo-facebook"></ion-icon>
            </a>
          </li>

          <li>
            <a href="#" class="social-link">
              <ion-icon name="logo-twitter"></ion-icon>
            </a>
          </li>

          <li>
            <a href="#" class="social-link">
              <ion-icon name="logo-google"></ion-icon>
            </a>
          </li>

          <li>
            <a href="#" class="social-link">
              <ion-icon name="logo-linkedin"></ion-icon>
            </a>
          </li>

          <li>
            <a href="#" class="social-link">
              <ion-icon name="logo-pinterest"></ion-icon>
            </a>
          </li>

        </ul>

      </div>

    </div>
  </footer>

  <!--  #FOOTER ENDS HERE  -->



  <!--  #BACK TO TOP BUTTON -->

  <a href="#top" class="back-top-btn" aria-label="back to top" data-back-top-btn>
    <ion-icon name="chevron-up"></ion-icon>
  </a>

  <!-- 
    - custom js link
  -->
  <script src="js/script.js"></script>

  <!-- 
    - ionicon link
  -->
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

</body>

</html>