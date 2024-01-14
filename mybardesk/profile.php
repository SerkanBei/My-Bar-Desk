<?php
session_start();
$username = $_SESSION["username"];


if (isset($_SESSION["usertype"]) && $_SESSION["usertype"] == "user") {
    $frame = "change_materials.php";

    echo '<div class="mainbar">
            <nav class="navigation">
                <a href="main.php" class="links">MAIN PAGE</a>
                <a href="communication.php" class="links">COMMUNİCATİON</a>
                <a href="profile.php" class="links">PROFİLE</a>
                <a href="cikis.php" class="links">LOG OUT</a>
            </nav>
        </div>';
} else if (isset($_SESSION["usertype"]) && $_SESSION["usertype"] == "admin") {
    $frame = "give_admin.php";
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
} else {

    echo '<div class="mainbar">
            <nav class="navigation">
                <a href="main.php" class="links">MAIN PAGE</a>
                <a href="communication.php" class="links">COMMUNİCATİON</a>
                <a href="giris.php" class="links" id="sign_in">SIGN IN</a>
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
    <link rel="stylesheet" href="profile2.css">
    <title>MyBarDesk</title>
</head>

<body>
    <div class="profileitems">
        <div class="iconic">
            <i class='bx bxs-user'></i>
        </div>
        <div class="textdiv">
            <label class="lbl" name="lbl1">
                <?php echo $username; ?>
            </label>
        </div>
        <div class="passwordcls">
            <form action="" method="post">
                <div class="fram">
                    <label class="lb2">change username <a class="aclass" href="change_username.php">CHANGE</a></label>
                </div>
                <div class="fram">
                    <label class="lb2">change password <a class="aclass"
                            href="change_password.php">CHANGE</a></label>
                </div>
            </form>
        </div>
    </div>
    <iframe src="<?php echo $frame; ?>" class="frama"></iframe>
</body>

</html>