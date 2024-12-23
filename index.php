<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>IHCRS</title>
  <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: 'rgba(15, 151, 155, 0.804)',
                        secondary: '#E0F2FE',
                    }
                }
            }
        }
    </script>
 

  <!-- 
    - google font link
  -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@500;700&family=Rubik:wght@400;500;700&display=swap"
    rel="stylesheet">
    <link rel="stylesheet" type="Home/text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="Home/style.css">
    <link rel="stylesheet" href="Home/home.css">
</head>


<body class="bg-white">

  <!-- #HEADER STARTS HERE-->

  <header class="header" data-header>
    <div class="container text-black">

      <a href="#" class="logo">
        <img src="logo.png" width="250" height="46" alt="IHCRS">
      </a>

      <nav class="navbar" data-navbar>

        <div class="navbar-top">

          <a href="#" class="logo">
            <img src="logo.png" width="250" height="46" alt="IHCRS">
          </a>

          <button class="nav-close-btn" >
            <ion-icon name="close-outline"></ion-icon>
          </button>

        </div>

        <ul class="navbar-list">

          <li class="navbar-item">
            <a href="#" class="navbar-link title-md">Home</a>
          </li>

          <li class="navbar-item">
            <a href="Account/acc.php" class="navbar-link title-md">Services</a>
          </li>

          <li class="navbar-item">
            <a href="contactUs/index.php" class="navbar-link title-md">Contact us</a>
          </li>

          <li class="navbar-item">
            <a href="aboutUs/index.php" class="navbar-link title-md">About us</a>
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

      <a href="Account/acc.php" class="btn has-before title-md">Make Appointment</a>
     
      <div class="profile">
          <div class="profile-in">

          </div>
          <div class="profile-acc"> <h2><a href="Account/acc.php">Login</a>/<a href="../Account/logout.php">Logout</a></h2> </div>
      </div>


      <div class="overlay" data-nav-toggler data-overlay></div>

    </div>
  </header>
<!--  #HEADER ENDS HERE -->

    <!-- Hero Section -->
    <section class="pt-32 pb-16 bg-gradient-to-b from-primary to-white">
        <div class="container mx-auto px-4 mt-16">
            <div class="grid md:grid-cols-2 gap-8 items-center">
                <div class="space-y-8">
                    <h1 class="text-6xl md:text-7xl font-bold text-sky-900">Healthcare Solutions</h1>
                    <p class="text-3xl text-sky-700 leading-relaxed">Expert medical care at your fingertips. Our team of dedicated professionals is here to provide you with the best healthcare services.</p>
                    <button class="bg-primary text-white text-3xl px-20 py-6 rounded-full hover:bg-sky-600 transition-colors">
                        Find Doctors
                    </button>
                </div>
                <div class="relative overflow-hidden rounded-[200px] shadow-lg">
                  <img src="https://images.unsplash.com/photo-1559839734-2b71ea197ec2?q=80&w=800" 
                     alt="Professional Medical Consultation" 
                     class="w-full shadow-lg transition-transform duration-300 hover:scale-110"
                     title="Expert medical consultation with experienced healthcare professionals"/>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Grid -->
    <section class="py-16">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                <div class="bg-sky-600 text-white p-8 rounded-2xl">
                    <h3 class="text-3xl font-semibold mb-4">Opening Hours</h3>
                    <p class="text-1xl opacity-90">Monday - Friday</p>
                    <p class="text-1xl opacity-90">9:00 AM - 5:00 PM</p>
                </div>
                <div class="bg-white shadow-lg p-8 rounded-2xl">
                    <h3 class="text-3xl font-semibold mb-4 text-sky-900">Appointment</h3>
                    <p class="text-1xl text-sky-700 mb-4">Book your appointment online</p>
                    <button class="text-1xl text-primary hover:text-sky-600">Request</button>
                </div>
                <div class="bg-white shadow-lg p-6 rounded-2xl">
                    <h3 class="font-semibold mb-2">Find Doctors</h3>
                    <p class="text-1xl text-gray-600 mb-4">Search our specialists</p>
                    <button class="text-primary hover:underline">Discover</button>
                </div>
                <div class="bg-white shadow-lg p-6 rounded-2xl">
                    <h3 class="font-semibold mb-2">Find Location</h3>
                    <p class="text-1xl text-gray-600 mb-4">Visit our facilities</p>
                    <button class="text-primary hover:underline">Locations</button>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <span class="text-primary text-3xl font-medium">SERVICE</span>
                <h2 class="text-4xl font-bold mt-2 text-sky-900">Our Medical Services</h2>
            </div>
            <div class="flex  justify-center gap-10 items-center">
                <div class="relative w-1/2 aspect-square overflow-hidden rounded-full">
                  <img src="https://images.unsplash.com/photo-1582750433449-648ed127bb54?q=80&w=800" 
                     alt="Healthcare Professional" 
                     class="w-full h-full object-cover transition-transform duration-300 hover:scale-110"
                     title="Qualified medical professionals providing personalized care"/>
                </div>
                <div class="space-y-6">
                    <h3 class="text-3xl font-bold text-sky-900">Dental Care Service</h3>
                    <p class="text-1xl text-sky-700 leading-relaxed">Comprehensive dental care services including preventive care, cosmetic dentistry, and oral surgery. Our experienced dentists use the latest technology to ensure your perfect smile.</p>
                    <button class="text-1xl text-primary hover:text-sky-600 font-medium">Learn more</button>
                </div>
            </div>
        </div>
    </section>

    <!-- Speciality Section -->
    <section class="py-16">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <span class="text-primary text-2xl font-medium">FEATURES</span>
                <h2 class="text-3xl font-bold mt-2">Our Speciality</h2>
            </div>
            <div class="bg-primary text-white rounded-2xl p-8 flex items-center justify-between">
                <div class="space-y-4">
                    <h3 class="text-3xl font-bold">Online Appointment</h3>
                    <p class="opacity-90">Book your appointment online and skip the waiting room</p>
                    <button class="bg-white text-primary px-6 py-2 rounded-full hover:bg-gray-100 transition-colors">
                        Learn More
                    </button>
                </div>
                <img src="https://images.unsplash.com/photo-1612349317150-e413f6a5b16d?q=80&w=800" 
                     alt="Modern Healthcare" 
                     class="w-24 h-24 rounded-full object-cover"
                     title="State-of-the-art medical facilities and equipment"/>
            </div>
        </div>
    </section>

    <!-- Appointment Section -->
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="grid md:grid-cols-2 gap-12 items-center">
                <div class="space-y-4">
                    <span class="text-primary text-2xl font-medium">TIME TABLE</span>
                    <h2 class="text-3xl font-bold">Appointment Schedules</h2>
                    <p class="text-gray-600">Easily schedule your appointment with our online booking system. Choose your preferred doctor and time slot.</p>
                    <button class="bg-primary text-white px-6 py-2 rounded-full hover:bg-primary/90 transition-colors">
                        Schedule
                    </button>
                </div>
                <div class="relative">
                    <img src="https://images.unsplash.com/photo-1666214280557-f1b5022eb634?q=80&w=800" 
                         alt="Digital Healthcare" 
                         class="w-full rounded-lg shadow-lg"
                         title="Modern digital healthcare management and scheduling"/>
                </div>
            </div>
        </div>
    </section>

    <!-- Doctors Section -->
    <section class="py-16">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <span class="text-primary text-2xl font-medium">TEAM</span>
                <h2 class="text-3xl font-bold mt-2">Our Doctors</h2>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <?php
                $doctors = [
                    [
                        'name' => 'Dr. Sarah Johnson',
                        'specialty' => 'Cardiologist',
                        'image' => 'https://images.unsplash.com/photo-1594824476967-48c8b964273f?q=80&w=800',
                        'description' => 'Specialist in cardiovascular health with 15+ years experience'
                    ],
                    [
                        'name' => 'Dr. Michael Chen',
                        'specialty' => 'Neurologist',
                        'image' => 'https://images.unsplash.com/photo-1651008376811-b90baee60c1f?q=80&w=800',
                        'description' => 'Expert in neurological disorders and brain health'
                    ],
                    [
                        'name' => 'Dr. Emily Parker',
                        'specialty' => 'Pediatrician',
                        'image' => 'https://images.unsplash.com/photo-1582750433449-648ed127bb54?q=80&w=800',
                        'description' => 'Dedicated to children\'s health and development'
                    ]
                ];

                foreach ($doctors as $doctor): ?>
                    <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow">
                        <img src="<?php echo $doctor['image']; ?>" 
                             alt="<?php echo $doctor['name']; ?>" 
                             class="w-full h-48 object-cover"
                             title="<?php echo $doctor['description']; ?>"/>
                        <div class="p-8 text-center">
                            <h3 class="text-3xl font-bold text-sky-900"><?php echo $doctor['name']; ?></h3>
                            <p class="text-1xl text-sky-700 mt-2"><?php echo $doctor['specialty']; ?></p>
                            <p class="text-lg text-sky-600 mt-3"><?php echo $doctor['description']; ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="text-center mt-10">
                <button class="text-1xl text-primary hover:text-sky-600 font-medium">See All</button>
            </div>
        </div>
    </section>


  <!--  #FOOTER  -->

  <footer class="footer" style="background-image: url('images/footer-bg.png')">
    <div class="container">

      <div class="section footer-top">

        <div class="footer-brand" data-reveal="bottom">

          <a href="#" class="logo">
            <img src="../logo.png" width="225" height="46" loading="lazy" alt="IHCRS">
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

            <button type="submit" class="btn has-before title-md" id="hostMgmt">Subscribe</button>
          </form>
        <script>
          var hostH = document.getElementById("hostMgmt");
        hostH.addEventListener("click", function() {
          window.location.href = "../Account/acc.php";
        });

        </script>
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
  <script src="../services/js/script.js"></script>

  <!-- 
    - ionicon link
  -->
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

</body>

</html>