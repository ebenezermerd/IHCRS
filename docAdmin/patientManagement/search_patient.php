<!DOCTYPE html>
<html lang="en">
<?php
require_once "control/search.php";

if (isset($_GET["s"]))
  $val = $_GET["s"];
?>

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>IHCRS</title>



  <!-- 
    - google font link
  -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@500;700&family=Rubik:wght@400;500;700&display=swap"
    rel="stylesheet">
  <link rel="stylesheet" type="text/css"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
  <link rel="stylesheet" href="css/services.css">

  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="search.css">
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
            <img src="logo.png" width="250" height="46" alt="IHCRS">
          </a>

          <button class="nav-close-btn">
            <ion-icon name="close-outline"></ion-icon>
          </button>

        </div>

        <ul class="navbar-list">

          <li class="navbar-item">
            <a href="../home/home.php" class="navbar-link title-md">Home</a>
          </li>

          <li class="navbar-item">
            <a href="#" class="navbar-link title-md" active>Services</a>
          </li>

          <li class="navbar-item">
            <a href="#" class="navbar-link title-md">Blog</a>
          </li>

          <li class="navbar-item">
            <a href="#" class="navbar-link title-md">Contact us</a>
          </li>

          <li class="navbar-item">
            <a href="#" class="navbar-link title-md">About us</a>
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

      <a href="../appointment/appoint.php" class="btn has-before title-md">Make Appointment</a>

      <div class="profile">
        <div class="profile-in">

        </div>
        <div class="profile-acc">
          <h2><a href="../account/acc.php" style="color:aqua;">Login</a>/<a href="../account/logout.php"
              style="color:orangered;">Logout</a></h2>
        </div>
      </div>


      <div class="overlay" data-nav-toggler data-overlay></div>

    </div>
  </header>
  <!--  #HEADER ENDS HERE -->

  <div class="wrapper">
    <div class="classList">
      <h1>Search results
        <?php if (isset($_GET["s"]))
          echo "for $val"; ?>
      </h1>
      <div class="patient-records">
        <form class="search-bar hidden" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="get">
          <input type="text" id="search" name="s" value="<?php if (isset($_GET["s"]))
            echo $val ?>">
            <input type="submit" value="Search">
          </form>
          <div class="menu">
            <ul>
              <nav class="menu patient-management">
                <p>Patient Management</p>
                <ul class="hidden">
                  <li><a href="patient_rigister.php">Add Patient</a></li>
                  <li class="search-patient"><a href="#" id="curr">Search Patient</a></li>
                  <li><a href="dispaly_patient.php">All Patients</a></li>
                </ul>
              </nav>
              <li><a href="appintment.php">Appointment Info</a></li>
             
            </ul>
          </div>
          
          <div class="records-table">
            <!-- Table for displaying patient records -->
            <table>
              <?php
          if (isset($_GET["s"])) {
            $val = $_GET["s"];
            $srch = $search->fetchonrecord("patient", $val);
            if ($srch->num_rows == 0)
              echo "<h1>No records found</h1>";
            else { ?>
                <thead>
                  <tr>
                    <th>Patient Name</th>
                    <th>age</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Date</th>
                    <th>Password</th>
                    <th>aproved/rejected</th>
                  </tr>
                </thead>
                <?php
                while ($row = $srch->fetch_assoc()) {
                  ?>
                  <tbody>
                    <tr>
                      <td>
                        <?php echo $row["full_name"] ?>
                      </td>
                     
                      <td>
                        <?php echo $row["age"] ?>
                      </td>
                      <td>
                        <?php echo $row["email"] ?>
                      </td>
                      <td>
                        <?php echo $row["phone"] ?>
                      </td>
                      <td>
                        <?php echo $row["date"] ?>
                      </td>
                      <td>
                        <?php echo $row["password"] ?>
                      </td>

                      <td>
                        <a href="update_patient.php"
                          onclick="event.preventDefault(); document.getElementById('update').submit();">
                          
                          <button style="padding: 10px 20px; background-color: #007bff; color: #fff; border: none; border-radius: 5px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.4); cursor: pointer;">Update</button>
                        </a>
                        <a href="control/delete.php"
                          onclick="event.preventDefault(); document.getElementById('delete').submit();">
                          
                          <button style="padding: 10px 20px; background-color: #0083ff; color: #fff; border: none; border-radius: 5px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.4); cursor: pointer;">Delete</button>
                        </a>

                        <form id="update" method="post" action="update_patient.php">
                          <input type="hidden" name="PID" value="<?php echo $row["patient_id"] ?>">
                          
                        </form>
                        <form id="delete" method="post" action="control/delete.php">
                          <input type="hidden" name="PID" value="<?php echo $row["patient_id"] ?>">
                          <input type="hidden" name="fname" value="<?php echo $row["full_name"] ?>">
                          
                        </form>


                      </td>
                    </tr>
                  <?php }
            }
          } ?>


              <!-- Add more patient records here -->
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <!--  #FOOTER  -->
  <script src="homespace.js"></script>
  <footer class="footer" style="background-image: url('images/footer-bg.png')">
    <div class="container">

      <div class="section footer-top">

        <div class="footer-brand" data-reveal="bottom">

          <a href="../home/home.php" class="logo">
            <img src="logo.png" width="225" height="46" loading="lazy" alt="IHCRS">
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
                  Office Telephone : <a href="tel:09760346.." class="contact-link">+251-976-***-**** </a>
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