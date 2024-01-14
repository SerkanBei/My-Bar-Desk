<?php
session_start();
if (isset($_SESSION["usertype"]) && $_SESSION["usertype"] == "user") {
    header('location: main.php');
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
    header('location: main.php');
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
    <link rel="stylesheet" href="cocktailUploader.css">
    <title>cocktail uploader</title>
</head>

<body>
    

    <div class="wrapper">
        <form action="" method="post">

            <h1>NEW COCKTAİL</h1>
            <div class="input-box">
                <input type="text" name="name" placeholder="COCKTAİL NAME" required>
            </div>

            
            <textarea  placeholder="coctail explanation" class="txtarea" name="aciklama"></textarea><br>
            <textarea  placeholder="coctail recipe" class="txtarea" name="recipe"></textarea><br>
            <textarea  placeholder="coctail video link" class="txtarea" name="link"></textarea><br>
            <strong style="font-size:20px;">picture</strong>
            <input type="file" name="pic" class="filec"><br>

            <div class="idiot">
                <?php
                $x = new PDO("mysql:host=localhost;dbname=mybardesk", 'root', '');
                $list = $x->query("SELECT * FROM cocktail_material");
                foreach ($list as $material) {
                    $picture = $material['material_picture'];
                    $name = $material['material_name'];
                    $material_value = $material['material_value'];
                    echo "<input type='checkbox' name='$material_value' value='$material_value' class='secenek'><img src='../mybardesk/material_pictures/$picture'class='fotograf'>" . "<label class='label1' for='$name'>$name</label><br>";
                }
                ?>
            </div>
            

             



            <input type="submit" name="save" value="save" class="btn">




        </form>
    </div>

</body>

</html>
<?php
if (isset($_POST['save'])) {
    $name = $_POST['name'];
    $pict = $_POST['pic'];
    
    $recipe=$_POST['recipe'];
    $ylink=$_POST['link'];
    $aciklama=$_POST['aciklama'];
    $stufs = "";

    $x = new PDO("mysql:host=localhost;dbname=mybardesk", 'root', '');
    $list = $x->query("SELECT * FROM cocktail_material");
    foreach ($list as $value) {
        $isim = $value['material_value'];


        if (isset($_POST[$isim])) {
            if ($stufs == null) {
                $stufs = $stufs . $isim;
            } else {
                $stufs = $stufs . "-" . $isim;
            }

        }
    }

    $add = $x->exec("INSERT INTO cocktails (cocktail_name,cocktail_picture,material_name,explanation,cocktail_recipe,cocktail_video) 
        VALUES ('$name','$pict','$stufs','$aciklama','$recipe','$ylink')");
}
?>