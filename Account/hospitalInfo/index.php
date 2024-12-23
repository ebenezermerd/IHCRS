 <?php
include 'conn.php';
$sql="SELECT * FROM hospital";
$sql2="SELECT * FROM doctors";

$rs_result = $con->query($sql);
$rs_result2 = $con->query($sql2);

if(isset($_GET['submit'])){
  $search_term = $_GET['search'];
  $s= "SELECT * FROM hospital WHERE hname LIKE '%$search_term%'";
  $rs_result = $con->query($s);
  
  }
  if(isset($_GET['submit2'])){
    $search_term2 = $_GET['search2'];
    $s2= "SELECT * FROM doctors WHERE Fname LIKE '%$search_term2%'";
    $rs_result2 = $con->query($s2);

  }

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pharmacy | IHCRS</title>

 

  <!-- 
    - google font link
  -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@500;700&family=Rubik:wght@400;500;700&display=swap"
    rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/services.css">
    <link rel="stylesheet" href="pharm.css">
</head>

<body>


  <!-- #HEADER STARTS HERE-->

  <header class="header" data-header>
    <div class="container">

      <a href="#" class="logo">
        <img src="../logo.png" width="250" height="46" alt="Doclab home">
      </a>

      <nav class="navbar" data-navbar>

        <div class="navbar-top">

          <a href="#" class="logo">
            <img src="logo.png" width="250" height="46" alt="Doclab home">
          </a>

          <button class="nav-close-btn" >
            <ion-icon name="close-outline"></ion-icon>
          </button>

        </div>

        <ul class="navbar-list">

          <li class="navbar-item">
            <a href="../../Home/index.php" class="navbar-link title-md">Home</a>
          </li>

          <li class="navbar-item">
            <a href="../../aboutUs/index.php" class="navbar-link title-md">About us</a>
          </li>

          <li class="navbar-item">
            <a href="../../contactUs/index.php" class="navbar-link title-md">Contact</a>
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

      <a href="../Appointment/appoint.php" class="btn has-before title-md">Make Appointment</a>
     
      <div class="profile">
          <div class="profile-in">

          </div>
          <div class="profile-acc"> <h2><a href="../acc.php" style="color:aqua;">Login</a>/<a href="../logout.php" style="color:orangered;">Logout</a></h2> </div>
      </div>

      <div class="overlay" data-nav-toggler data-overlay></div>

    </div>
  </header>
<!--  #HEADER ENDS HERE -->



<div class="wrapper">

    <section class="pharmacy-section">
        <h2>Hospital Details</h2>
        <p>Find information about Hospitals and their respective drug prices.</p>
        
        <div class="search-container">
           <form method="get">
              <input type="text" name="search" id="search-input" placeholder="Search pharmacies...">
              <input type="submit" name ="submit" value="Search">
            </form> 
          </div>
          
        <div class="pharmacy-list">
  
        <?php
        $i=0;
        if($rs_result->num_rows > 0){
        while ($row= $rs_result->fetch_assoc())

                {
                  $i++;
                  ?>
           <div class="pharmacy">
           <h3>Pharmacy <?php echo $row["hname"]?></h3>
            <p>Location: <?php echo $row["location"]?></p>
            <p>Contact: <?php echo $row["tel"]?></p>
            <h4>Drug Details</h4>
            <ul>
              <li>Drug 1: $10</li>
              <li>Drug 2: $15</li>
              <li>Drug 3: $20</li>
            </ul>
          </div>
          <?php }} ?>
          <?php 
          if ($i==0){
            ?>
            <div class="pharmacy">
            <h3>Not Found</h3>
            </div>
            
         <?php
          }
           ?>

        </div>
      </section>

      <section class="pharmacy-section">
        <h2>Our Physicians</h2>
        <p>Find information about our physicians and their specialities</p>
        
        <div class="search-container">
           <form method="get">
              <input type="text" name="search2" id="search-input" placeholder="Search pharmacies...">
              <input type="submit" name ="submit2" value="Search">
            </form> 
          </div>
          
          
        <div class="pharmacy-list">
  
        <?php
        if ($rs_result2->num_rows > 0) {
        while ($row = mysqli_fetch_array($rs_result2))
                {
                  ?>
           <div class="pharmacy">
           <h3>Name <?php echo $row["Fname"]?></h3>
            <p>Speciality: <?php echo $row["Speciality"]?></p>
            <p>Contact: <?php echo $row["pnum"]?></p>
            <h4>Drug Details</h4>
            <!-- <ul>
              <li>Drug 1: $10</li>
              <li>Drug 2: $15</li>
              <li>Drug 3: $20</li>
            </ul> -->
          </div>
          <?php }} 
          else{
            ?>
            <div class="pharmacy">
            <h3>Not Found</h3>
            </div>
            
         <?php
          }
           ?>
        </div>
      </section>
    </div>


  <!--  #FOOTER  -->

  <footer class="footer" style="background-image: url('./assets/images/footer-bg.png')">
    <div class="container">

      <div class="section footer-top">

        <div class="footer-brand" data-reveal="bottom">

          <a href="#" class="logo">
            <img src="logo.png" width="225" height="46" loading="lazy" alt="Doclab home">
          </a>

          <ul class="contact-list has-after">

            <li class="contact-item">

              <div class="item-icon">
                <ion-icon name="mail-open-outline"></ion-icon>
              </div>

              <div>
                <p>
                  Main Email : <a href="mailto:contact@website.com" class="contact-link">Epnics@&shy;website.com</a>
                </p>

                <p>
                  Inquiries : <a href="mailto:Info@mail.com" class="contact-link">cassyHome@mail.com</a>
                </p>
              </div>

            </li>

            <li class="contact-item">

              <div class="item-icon">
                <ion-icon name="call-outline"></ion-icon>
              </div>

              <div>
                <p>
                  Office Telephone : <a href="tel:0029129102320" class="contact-link">+251-976-***-****  </a>
                </p>

                <p>
                  Mobile : <a href="tel:000232439493" class="contact-link">046-881-02**</a>
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
          &copy; IHCRS 2022 | All Rights Reserved by WebNer
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
  <script src="../services/js/script.js"></script>

  <!-- 
    - ionicon link
  -->
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

</body>

</html>