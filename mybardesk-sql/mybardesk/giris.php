<?php
session_start();
if (isset($_SESSION["username"]))
{
    header('location: main.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>MyBarDesk</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="mainbar">
        <nav class="navigation">
            <a href="main.php" class="links">MAİN PAGE</a>
            <a href="communication.php" class="links">İLETİŞİM</a>
            
            <a href="giris.php" class="links" id="sign_in">SIGN IN</a>
        </nav>

        <div class="wrapper">
            <form action="" method="post">
                <h1>Login</h1>
                <div class="input-box">
                    <input type="text" name="username" placeholder="Username" required><i class='bx bx-user'></i>
                </div>
                <div class="input-box">

                    <input type="password" name="passw" placeholder="password" required>
                    <i class='bx bx-lock-alt'></i>
                </div>

                <input type="submit" name="sign" class="btn" value="SIGN IN">
                <div class="register-link">
                    <p>Don't have an accound <a href="kayit.php">Register</a></p>
                </div>


            </form>
        </div>


</body>

</html>
<?php
if (isset($_POST['sign'])) {
    $username = $_POST['username'];
    $password = $_POST['passw'];

    $x = new PDO("mysql:host=localhost;dbname=mybardesk", 'root', '');
    $list = $x->query("SELECT * FROM KULLANİCİ");
    foreach ($list as $value) {
        if ($username == $value['username'] && $password == $value['password']) {
            session_start();
            $_SESSION["user_id"] = $value['id'];
            $_SESSION["username"] = $username;
            $_SESSION["userpassword"] = $password;
            $_SESSION["usertype"] = $value['type'];
            header('location: main.php');


        } else {
            echo "Giriş Başarısız Lütfen Tekrar Deneyin";
        }
    }
}

?>