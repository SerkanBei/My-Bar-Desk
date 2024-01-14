<?php
session_start();
if (isset($_SESSION["username"])) {
    header('location: main.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Kayıt Ol</title>
</head>

<body>

    <div class="mainbar">
        <nav class="navigation">
            <a href="main.php" class="links">MAİN PAGE</a>
            <a href="#" class="links">İLETİŞİM</a>
            
            <a href="giris.php" class="links" id="sign_in">SIGN IN</a>
        </nav>

        <div class="wrapper">
            <form action="" method="post">
                <h1>Register</h1>
                <div class="input-box">
                    <input type="text" name="username" placeholder="Username" required><i class='bx bx-user'></i>
                </div>
                <div class="input-box">

                    <input type="password" name="passw" placeholder="password" required>
                    <i class='bx bx-lock-alt'></i>
                </div>
                <div class="input-box">

                    <input type="password" name="passwrep" placeholder="password" required>
                    <i class='bx bx-lock-alt'></i>
                </div>

                <input type="submit" name="register" class="btn" value="REGİSTER">



            </form>
        </div>


</body>

</html>
<?php
if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $passwordd = $_POST['passw'];
    $passwordrep = $_POST['passwrep'];
    $type = "user";
    $x = new PDO("mysql:host=localhost;dbname=mybardesk", 'root', '');
    if ($passwordd == $passwordrep) {
        $add = $x->exec("INSERT INTO kullanici (username, password,type) 
	VALUES ('$username', '$passwordd', '$type')");
        $list = $x->query("SELECT * FROM KULLANİCİ");
        foreach ($list as $value) {
            if ($username == $value['username']) {
                $_SESSION["username"] = $username;

                $_SESSION["usertype"] = $value['type'];
                $id = $value['id'];
                
            }
        }
        if ($add) {

            session_start();
            $_SESSION["user_id"] = $id;
            header('location: select_material.php');

        } else {
            echo "registration failed";
        }



    } else {
        echo "
        password is incorrect";
    }
}
?>