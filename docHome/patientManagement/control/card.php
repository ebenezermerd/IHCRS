<!DOCTYPE html>
<html>

<head>
    <title>User Card</title>
    <style>
        body{
            width: 300px;
            height: 200px;
        }
        .card {
            width: 300px;
            height: 200px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
            padding: 20px;
            margin: 20px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
        }

        .card h2 {
            font-size: 24px;
            margin-bottom: 10px;
        }

        .card p {
            font-size: 18px;
            margin-bottom: 10px;
        }
    </style>
</head>

<body>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        $email = $_GET["email"];
        $password = $_GET["password"];
        $name = $_GET["name"] ;
        $id=$_GET["id"];
        ?>
        <div class='card'>
            <h1>IHCRS <br> Name :
                <?php echo " " . $name ?>
            </h1>
            <h2>Username:
                <?php echo " " . $email ?>
            </h2> 
            id:
                <?php echo " " . $id ?>
           
            <p>Password:
                <?php echo " " . $password ?>
            </p>
        </div>
    <?php }
    ?>

</body>

</html>