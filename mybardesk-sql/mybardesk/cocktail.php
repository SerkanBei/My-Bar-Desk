<?php
$d = $_GET['c'];
session_start();


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
    <link rel="stylesheet" href="cocktail.css">
    <title>MyBarDesk</title>
    <style>
        .vdeo {
            margin-left: 29%;
            margin-bottom: 60px;
            margin-top: 60px;
            width: 660px;
            height: 415px;
            backdrop-filter: blur(20px);
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 20px;
            box-shadow: 0 0 10px rgba(0,0,0,.2);

        }
    </style>
</head>

<body>
    <?php
    $x = new PDO("mysql:host=localhost;dbname=mybardesk", 'root', '');
    $list = $x->query("SELECT * FROM cocktails");
    foreach ($list as $row) {
        $title = $row['cocktail_name'];
        $picture = $row['cocktail_picture'];
        $recipe = $row['cocktail_recipe'];
        $link = $row['cocktail_video'];
        $mats = $row['material_name'];
        $mats2 = str_replace("_", " ", $mats);
        $materials = str_replace("-", "<br>", $mats2);


        if ($row['cocktail_id'] == $d) {
            echo '<h1 class="title">' . $title . '</h1>
            <div class="container">
                <img src="../mybardesk/cocktail_pictures/' . $picture . '" alt="' . $title . '" class="picture">
                <div class="materials"><h1>materials</h1> <br>' . $materials . '</div><br>       
            </div>
            <div class="recipe">' . $recipe . '</div><br>';

            echo "<div class='vdeo'> $link</div> ";


        }

    }


    ?>


</body>

</html>