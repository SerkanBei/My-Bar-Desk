<?php
session_start();


if (isset($_SESSION["usertype"]) && $_SESSION["usertype"] == "user") {

    echo '<div class="mainbar">
            <nav class="navigation">
                <a href="main.php" class="links">MAIN PAGE</a>
                <a href="#" class="links">İLETİŞİM</a>
                <a href="#" class="links">PROFİLE</a>
                <a href="cikis.php" class="links">ÇIKIŞ YAP</a>
            </nav>
        </div>';
}
else if (isset($_SESSION["usertype"]) && $_SESSION["usertype"] == "admin")
{
    echo '<div class="mainbar">
    <nav class="navigation">
        <a href="main.php" class="links">MAIN PAGE</a>
        <a href="#" class="links">İLETİŞİM</a>
        <a href="admin_panel.php" class="links">ADMİN PANEL</a>
        <a href="cikis.php" class="links">ÇIKIŞ YAP</a>
    </nav>
</div>';
}
else {
    
    echo '<div class="mainbar">
            <nav class="navigation">
                <a href="main.php" class="links">MAIN PAGE</a>
                <a href="#" class="links">İLETİŞİM</a>
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
    <title>Document</title>
</head>
<body>
<iframe src="cocktail_uploader.php"></iframe>
<iframe src="admin_material_panel.php"></iframe>
</body>
</html>