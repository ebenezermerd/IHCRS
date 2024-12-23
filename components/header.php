<header class="header" data-header>
    <div class="container">
      <a href="#" class="logo">
        <img src="../logo.png" width="250" height="46" alt="IHCRS">
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
            <a href="../index.php" class="navbar-link title-md">Home</a>
          </li>
          <li class="navbar-item">
            <a href="../Account/services/index.php" class="navbar-link title-md">Services</a>
          </li>
          <li class="navbar-item">
            <a href="../contactUs/index.php" class="navbar-link title-md">Contact us</a>
          </li>
          <li class="navbar-item">
            <a href="../aboutUs/index.php" class="navbar-link title-md">About us</a>
          </li>
        </ul>

        <ul class="social-list">
          <li><a href="#" class="social-link"><ion-icon name="logo-twitter"></ion-icon></a></li>
          <li><a href="#" class="social-link"><ion-icon name="logo-facebook"></ion-icon></a></li>
          <li><a href="#" class="social-link"><ion-icon name="logo-pinterest"></ion-icon></a></li>
          <li><a href="#" class="social-link"><ion-icon name="logo-instagram"></ion-icon></a></li>
          <li><a href="#" class="social-link"><ion-icon name="logo-youtube"></ion-icon></a></li>
        </ul>
      </nav>

      <button class="nav-open-btn" aria-label="open menu" data-nav-toggler>
        <ion-icon name="menu-outline"></ion-icon>
      </button>

      <a href="../appointment/appoint.php" class="btn has-before title-md">Make Appointment</a>
     
    <<div class="flex items-center space-x-4 bg-white shadow-md rounded-lg p-3 hover:shadow-lg transition-shadow duration-300">
    <div class="relative">
        <div class="w-12 h-12 rounded-full bg-gradient-to-r from-cyan-500 to-blue-500 flex items-center justify-center text-white text-3xl font-semibold">
            <?php
            // Assuming you have a user's name, you can use the first letter
            $user_name = "John Doe"; // Replace with actual user name
            echo strtoupper(substr($user_name, 0, 1));
            ?>
        </div>
        <div class="absolute bottom-0 right-0 w-3 h-3 bg-green-500 rounded-full border-2 border-white"></div>
    </div>
    <div class="text-xl">
        <h2 class="font-medium text-gray-800 mb-1">
            <?php echo $user_name; // Display the user's name ?>
        </h2>
        <div class="flex space-x-2">
            <a href="../Account/acc.php" class="text-cyan-600 hover:text-cyan-800 transition-colors duration-300 flex items-center">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                </svg>
                Account
            </a>
            <span class="text-gray-300">|</span>
            <a href="../Account/logout.php" class="text-red-500 hover:text-red-700 transition-colors duration-300 flex items-center">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                </svg>
                Logout
            </a>
        </div>
    </div>
</div>

      <div class="overlay" data-nav-toggler data-overlay></div>
    </div>
</header>
