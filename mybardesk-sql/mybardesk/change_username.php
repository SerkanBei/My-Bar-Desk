<?php
session_start();
if (!isset($_SESSION["username"])) {
    header('location: ');
}
if (isset($_SESSION["usertype"]) && $_SESSION["usertype"] == "user") {

    echo '<div class="mainbar">
            <nav class="navigation">
                <a href="main.php" class="links">MAIN PAGE</a>
                <a href="communication.php" class="links">COMMUNİCATİON</a>
                <a href="profile.php" class="links">PROFİLE</a>
                <a href="cikis.php" class="links">LOG OUT</a>
            </nav>
        </div>';
} else if (isset($_SESSION["usertype"]) && $_SESSION["usertype"] == "admin") {
    echo '<div class="mainbar">
    <nav class="navigation">
        <a href="main.php" class="links">MAIN PAGE</a>
        <a href="communication.php" class="links">COMMUNİCATİON</a>
        <a href="admin_material_panel.php" class="links">MATERİAL PANEL</a>
        <a href="cocktail_uploader.php" class="links">NEW COCKTAİL</a>
        <a href="profile.php" class="links">PROFİLE</a>
        <a href="cikis.php" class="links">LOG OUT</a>
    </nav>
</div>';
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
    <style>
        .wrapper {
            position: absolute;
            top: 35%;
            left: 50%;
            transform: translate(-50%, -50%);
        }
    </style>
</head>

<body>


    <div class="wrapper">
        <form action="" method="post">
            <h1>CHANGE USERNAME</h1>

            <div class="input-box">

                <input type="password" name="passw" placeholder="verify your password" required>
                <i class='bx bx-lock-alt'></i>
            </div>
            <div class="input-box">
                    <input type="text" name="username" placeholder="<?php echo $_SESSION["username"] ; ?>" required><i class='bx bx-user'></i>
                </div>
                <div class="input-box">

            <input type="submit" name="save" class="btn" value="SAVE">



        </form>
    </div>


</body>

</html>
<?php
if (isset($_POST['save'])) {
    $password = $_POST['passw'];
    $newname = $_POST['username'];
    $username=$_SESSION["username"];


    $x = new PDO("mysql:host=localhost;dbname=mybardesk", 'root', '');
    $list = $x->query("SELECT * FROM KULLANİCİ");

    foreach ($list as $value) {
        if ($_SESSION["username"] == $value['username'] && $password == $value['password']) {
            
                $add = $x->exec("UPDATE `kullanici` SET `username`='$newname' WHERE `username`='$username'");
                $_SESSION["username"]=$newname;
                header('location: profile.php');
          

        } else {
            echo '<script>confirm("wrong user password '.$username.'");</script>';
            echo '<script>window.location.href = "change_username.php";</script>';
        }
    }




}

?>