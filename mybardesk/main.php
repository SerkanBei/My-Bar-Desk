<?php
session_start();
$userid = $_SESSION["user_id"];


if (isset($_SESSION["usertype"]) && $_SESSION["usertype"] == "user") {

    echo '<div class="mainbar">
            <nav class="navigation">
                <a href="main.php" class="links">MAIN PAGE</a>
                <a href="communication.php" class="links">COMMUNİCATİON</a>
                <a href="profile.php" class="links">PROFİLE</a>
                <a href="cikis.php" class="links">LOG OUT</a>
            </nav>
        </div>';
}
else if (isset($_SESSION["usertype"]) && $_SESSION["usertype"] == "admin")
{
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
else {
    
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
    <link rel="stylesheet" href="style3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <title>MyBarDesk</title>
</head>

<body>

<h1 class="pagetitle">COCKTAİL GALLERY</h1>
    <div class="container">
        <div id="slide">
            <?php
            $x = new PDO("mysql:host=localhost;dbname=mybardesk", 'root', '');
            $list = $x->query("SELECT * FROM cocktails");
            foreach ($list as $cocktail) {
                $picture = $cocktail['cocktail_picture'];
                $name = $cocktail['cocktail_name'];
                $desc = $cocktail['explanation'];
                $id=$cocktail['cocktail_id'];

                echo " <div class='item' style='background-image: url(../mybardesk/cocktail_pictures/$picture);'>
                <div class='content'>
                    <div class='name'>$name</div>
                    <div class='des'>$desc</div>
                    <button onclick=\"window.location.href='cocktail.php?c=$id'\">See more</button>
                </div>
            </div>";
            }
            ?>
        </div>
        <div class="buttons">
            <button id="prev"><i class="fa-solid fa-angle-left"></i></button>
            <button id="next"><i class="fa-solid fa-angle-right"></i></button>
        </div>
    </div>
    <?php 
   if(isset($_SESSION["usertype"])) {

    echo '<h1 class="fkar">YOU CAN MAKE</h1>';
    echo '<div class="framm">';
    
    
    $x = new PDO("mysql:host=localhost;dbname=mybardesk", 'root', '');
    
    
    $list = $x->query("SELECT * FROM cocktails");
    
   
    $sorgu = $x->prepare("SELECT * FROM user_materials WHERE user_id = :kullaniciId");
    $sorgu->bindParam(':kullaniciId', $userid, PDO::PARAM_INT);
    $sorgu->execute();
    $fmaterials = $sorgu->fetchAll(PDO::FETCH_ASSOC);
    $userMaterials = array_column($fmaterials, 'material_name');
    
   
    $cocktailsWithMissingMaterials = array();
    
    foreach ($list as $drink) {
        $name = $drink['cocktail_name'];
        $picture = $drink['cocktail_picture'];
        $mats = $drink['material_name'];
        $desc = $drink['explanation'];
        $id = $drink['cocktail_id'];
        
        $arr = explode("-", $mats);
        $missingMaterials = array();
        
        foreach ($arr as $eleman) {
            if (!in_array($eleman, $userMaterials)) {
                $missingMaterials[] = $eleman;
            }
        }
        
        if (count($missingMaterials) > 0) {
            $cocktailsWithMissingMaterials[] = array(
                'name' => $name,
                'picture' => $picture,
                'desc' => $desc,
                'id' => $id,
                'missingMaterials' => $missingMaterials
            );
        } else {
            
            echo '
            <div class="usercockt" onclick="window.location.href=\'cocktail.php?c=' . $id . '\'">
                <img class="usercocktpic" src="../mybardesk/cocktail_pictures/' . $picture . '" alt="' . $name . '" onclick="window.location.href=\'cocktail.php?c=' . $id . '\'">
                <div class="usercockttitle">
                    <h2 class="h2c">' . $name . '</h2>
                </div>
                <div class="usercocktdes"><label class="lbldes">' . $desc . '</label></div><br>
            </div>';
        }
    }
    echo'<h1 class="fiza">with more materials you can make</h1>';

    
    foreach ($cocktailsWithMissingMaterials as $cocktail) {
        $name = $cocktail['name'];
        $picture = $cocktail['picture'];
        $desc = $cocktail['desc'];
        $id = $cocktail['id'];
        $missingMaterials = implode(', ', $cocktail['missingMaterials']);
        
        
        echo '
        <div class="usercockt" onclick="window.location.href=\'cocktail.php?c=' . $id . '\'">
            <img class="usercocktpic" src="../mybardesk/cocktail_pictures/' . $picture . '" alt="' . $name . '" onclick="window.location.href=\'cocktail.php?c=' . $id . '\'">
            <div class="usercockttitle">
                <h2 class="h2c">' . $name . '</h2>
            </div>
            <div class="usercocktdes"><label class="lbldes">' . $desc . '</label></div><br>
            <label class="tesx">MİSSİNG MATERİALS: '.$missingMaterials.'</label>
        </div>';                 
    }

    echo '</div>';
}

?>

    <script src="script.js"></script>
</body>

</html>