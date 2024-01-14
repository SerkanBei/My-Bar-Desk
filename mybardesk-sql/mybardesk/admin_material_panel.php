<?php
session_start();
if (isset($_SESSION["usertype"]) && $_SESSION["usertype"] == "user") {
    header('location: main.php');    echo '<div class="mainbar">
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
    <link rel="stylesheet" href="materialpanel.css">
    <title>Document</title>
</head>

<body>
    

    <div class="wrapper">
        <form action="" method="post">
           <h1>NEW MATERIAL</h1>
            <div class="input-box">
                <input type="text" name="mtrName" placeholder="material name" required>
            </div>
            <strong style="font-size:20px;">picture</strong>
            <input type="file" name="pic" class="filec">

            <input type="submit" name="save" class="btn" value="SAVE">



        </form>
    </div>


</body>

</html>
<?php
if (isset($_POST['save'])) {

    $x = new PDO("mysql:host=localhost;dbname=mybardesk", 'root', '');
    $name = $_POST['mtrName'];
    $val = $tireli_metin = str_replace(" ", "_", $name);
    $picture = $_POST['pic'];
    $list = $x->query("SELECT * FROM cocktail_material");
    foreach ($list as $materials) {



        if ($name == $materials['material_name']) {
            goto skip;
        }

    }
    $add = $x->exec("INSERT INTO cocktail_material (material_name,material_value,material_picture) 
            VALUES ('$name', '$val','$picture')");
    skip:

}
?>