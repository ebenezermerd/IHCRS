<?php
$server="localhost";
$user="root";
$pass="";
$dbname="ihcrs_database";

$conn =new mysqli($server,$user,$pass,$dbname);
if($conn->connect_error){
    echo "failed";
}
//$conn->query($sql);

function  cln($raw){
    $raw=trim($raw);
    $raw=stripslashes($raw);
    $raw=htmlspecialchars($raw);
    return $raw;
    }

class register{
    function register($POST)
    {
        $Hname = cln($POST["Hname"]); 
        $Aname  = cln($POST["Aname"]);
        $Apassword =  cln( $POST["Apassword"]);
      //  $Apassword = cln( $_POST["Apassword"]);
        $city = cln($POST["city"]);
         $Date = cln($POST["Date"]);
        $Num = cln($POST["Num"]);
        $email = cln($POST["email"]);
       $Hlocation = cln($POST["Hlocation"]);
       $con=$GLOBALS["conn"];
       $ck="SELECT * FROM hospital WHERE hname='$Hname'";
       if ($con->query($ck)->num_rows >0 ) {
        return false;
           }else{
      $sql ="INSERT INTO hospital(hname,username,password,city,location,date,tel,email) 
       VALUES('$Hname','$Aname','$Apassword', '$city','$Hlocation','$Date','$Num',' $email')";
      // echo $_POST["Hname"];
        //echo "<script>alert('successful');</script>";
     
       $con->query($sql);
       return true;
    }
    
       
    }
   static function update()
    {
        if(isset($_POST["update"])){
        $Hname = cln($_POST["Hname"]); 
        $Aname  = cln($_POST["Aname"]);
        $Apassword =  password_hash(cln( $_POST["Apassword"]), PASSWORD_DEFAULT);
      //  $Apassword = cln( $_POST["Apassword"]);
        $city = cln($_POST["city"]);
         $Date = cln($_POST["Date"]);
        $Num = cln($_POST["Num"]);
        $email = cln($_POST["email"]);
       $Hlocation = cln($_POST["Hlocation"]);
       $key=$_POST["edit"];
       $con=$GLOBALS["conn"];
      
      $sql ="UPDATE  hospital SET hname='$Hname',username='$Aname',password='$Apassword',city='$city',location='$Hlocation',date='$Date',tel='$Num',email='$email' WHERE hname='$key'";
      $con->query($sql);
     header("location: search_hospital.php");
       echo $key;
       
    
        }
       
    }
    
    }

class display{
    function display(){
        $con=$GLOBALS["conn"];
        $ck="SELECT * FROM hospital"; 
       $result= $con->query($ck);
       return $result;
    }
    
 static function delete(){
    if(isset($_GET["del"])){
        $id=$_GET["del"];
    
    $con=$GLOBALS["conn"];
    $del="DELETE FROM  hospital WHERE id ='$id'";
    
    $con->query($del);
    header("location: search_hospital.php");}
 }
 /*static function edit(){
    if(isset($_GET["dit"])){
        $id=$_GET["del"];
    
    $con=$GLOBALS["conn"];
    $del="SELECT FROM  hospital WHERE id ='$id'";
    $result = $con->query($del);
   }
   return $result;
   header("location: update_hospital.php");
 }*/
}
class search{
    function search($key){
        $con=$GLOBALS["conn"]; 
        $ck="SELECT * FROM hospital WHERE hname='$key'"; 
       $result= $con->query($ck);
       return $result;
    }
}


/*if(isset($_POST["register"])){
    $obj=new register();
    $obj->register();
    echo '<input type="hidden" id="Aname" value="new hospital" name="msg" />';
   // echo "<script>alert('successful');</script>";
    header("location: Hospital_rigister.php?stat=succes");
}
elseif(isset($_POST["update"])){
    echo "update";
}*/

display::delete();
register::update();
?>