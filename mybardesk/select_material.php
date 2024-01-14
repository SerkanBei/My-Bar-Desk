

<?php
session_start();
if (isset($_SESSION["username"])&&(!isset($_SESSION["user_id"])) )
{
    header('location: main.php');
}
else if(!isset($_SESSION["user_id"]))
{
    header('location: main.php');
}


$id = $_SESSION['user_id'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="selectmaterial.css">
    <title>Material Select</title>
</head>

<body>
    

    <form action='' method='post'>

        <div class="materials_box">
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


</body>

</html>
<?php

if (isset($_POST['save'])) {

    $x = new PDO("mysql:host=localhost;dbname=mybardesk", 'root', '');
    $list = $x->query("SELECT * FROM cocktail_material");
    foreach ($list as $value) {
        $isim = $value['material_value'];


        if (isset($_POST[$isim])) {
            $sorgu = $x->exec("INSERT INTO user_materials (user_id, material_name) VALUES ('$id','$isim')");
            

        }
    }
   
    header('location: main.php');
}
?>