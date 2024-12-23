
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Account | IHCRS</title>

 

  <!-- 
    - google font link
  -->
  <link href="https://cdn.lineicons.com//4.0/lineicons.css" rel="stylesheet"/ >
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@500;700&family=Rubik:wght@400;500;700&display=swap"
    rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="css/services.css">
    <link rel="stylesheet" href="acc.css">
    <link rel="stylesheet" href="css/style.css"
    <link rel>

</head>

<body>


  <!-- #HEADER STARTS HERE-->
<center>
 <header class="header" >
    <div class="logo_div" >

      <a href="../Home/index.php" class="logo">
        <img src="logo.png" width="250" height="46" alt="IHCRS">
      </a></center>

  



    </div>
  </header>
<!--  #HEADER ENDS HERE -->
<center>
<div class="wrapper">
  <div class="container-acc" id="container-acc">
    <div class="form-container register-container">
      <form class="login-form" method="post" action="acc.php">
        <h1>SIGN-UP</h1>
        <p  style="color: red;" ></p>
        <input class="login-input" type="text" placeholder="username" name="sign_name">
        <input class="login-input" type="email" placeholder="email" name="sign_email">
        <input class="login-input" type="password" placeholder="password" name="sign_password">
        <button class="btn-link" name="signup_btn">Register</button>
          
        <span>or use account</span>
        <div class="social-container">
            <a href="#" class="social"><i  class="lni lni-facebook-fill"></i></a>  
            <a href="#" class=" social"><i  class="lni lni-google"></i></a>  
            <a href="#" class="link social"><i  class="lni lni-linkedin-original"></i></a>   
        </div>
    </form>
    </div>
    <div class="form-container login-container">
    <form class="login-form" method="post"  action="login.php">
          <h1>Login</h1>
         <p style="color: red;"></p>
          <label>USER NAME</label>
          <input class="login-input" type="text" name="login_email" placeholder="email">
          <label>PASSWORD</label>
      <input class="login-input" type="password" name="login_password" placeholder="password">
      <div class="content">
        <!--  <div class="checkbox">
              <input class="login-input" type="checkbox" value="saved" name="checkbox" id="checkbox">
              <label>Remember me </label> 
          </div>
          <div class="pass-link">
              <a>Forgot password </a>
          </div> -->

      </div>
      <button name="login_btn" class="btn-link">Login</button>
      <span>or use your account</span>
      <div class="social-container">
          <a href="#" class="social"><i  class="lni lni-facebook-fill"></i></a>  
          <a href="#" class=" social"><i  class="lni lni-google"></i></a>  
          <a href="#" class="link social"><i  class="lni lni-linkedin-original"></i></a>    
      </div>
   
    </div>

  <div class="overlay-container">
      <div class="overlay-login">
          <!--<div class="overlay-panel overlay-left">
              <h1 class="title">Hello <br>Friends</h1>
              <p>if you have account,login here</p>
              <button class="ghost" id="login">Login
                  <i class="lni lni-arrow-left login"></i>
              </button>
          </div> -->
          
          <div class="overlay-panel overlay-right">

              <h1 class="title">WELCOME TO <br>LOGIN PAGE</h1>
              <p>
                  WHICH USER TYPE ARE YOU
              </p>
               
              <select  name="opt" >
              <option value="web" > WEBSITE ADMINISTRATOR</option>
              <option  value="hospital" >HOSPITAL ADMINISTRATOR</option>
              <option selected value="doctor" >DOCTOR</option>
              <option selected value="user" >USER</option>
            </select>
            
                        
           <!-- <button class="ghost" id="register"> Register
                  <i class="lni lni-arrow-right register"></i>
              </button> -->
              
          </div> </form>
      </div>
</div>
<script src="script.js"></script>
        
</div>
     
</div></center>

  <script src="script.js"></script>
  

  <!-- 
    - ionicon link
  -->
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

</body>

</html>
<?php 

if(isset($_GET["err"])){
  echo "<script>alert('login credential error');</script>";
}
?>
