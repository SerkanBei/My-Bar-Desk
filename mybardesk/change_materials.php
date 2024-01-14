

<?php
session_start();

if (!isset($_SESSION["usertype"]))

{
    header('location: main.php');

}





$username=$_SESSION["username"];
$y = new PDO("mysql:host=localhost;dbname=mybardesk", 'root', '');
$use = $y->query("SELECT * FROM kullanici");
foreach ($use as $row)
{
    
    if($username==$row['username'])
    {
        $id= $row['id'];
    }


}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Material Select</title>
    <style>
        *{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: "poppins",sans-serif;
}
body{
    width: 100%;
    display: inline-block;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    backdrop-filter: blur(20px);
    background-size: cover;
    background-position: center;
}

.materials_box{
    
    
    text-align:justify;
    width: 100%;
    height: 360px;
    overflow:auto;
    display: inline-block;
    border-radius: 20px;
    backdrop-filter: blur(20px);
    
    
}

.secenek{
margin-left: 10px;
width: 20px;
height: 20px;
border: 2px solid #fff;
border-radius: 3px;
vertical-align: middle;



}
input[type="checkbox"]:checked {
    background-color: black; /* Seçili olduğunda arkaplan rengi */
  }
.fotograf{
    width: 80px;
    height: 80px;
    margin-top: 10px;

}
.label1{
    font-size: 40px;
    font-family:Arial, Helvetica, sans-serif;
    color: #ffffff;

}
::-webkit-scrollbar{
    backdrop-filter: blur(20px);
}
::-webkit-scrollbar-thumb {
    background: #fff; 
    border-radius: 20px; 
}
.btn{
    width: 150px;
    height: 50px;
    font-size: 30px;
    border-radius: 20px;
    margin-bottom: -160px; 
    position: absolute;
    bottom: 180px; 
    left: 50%; 
    transform: translateX(-50%); 
}
.home_box{
    text-align:justify;
    width: 60%;
    height: 600 px;
    overflow:auto;
    display: inline-block;
    border-radius: 20px;
    backdrop-filter: blur(20px);
    position: relative; top:50px; left: 20%;
}
.wrapper{
    display: flex;
    justify-content: center;
    width: 800px;
    background: transparent;
    border: 2px solid rgba(255,255,255,.2);
    backdrop-filter: blur(20px);
    box-shadow: 0 0 10px rgba(0,0,0,.2);
    color: #fff;
    border-radius: 10px;
    padding: 30px 40px;
    
    margin-top: 120px; 
    margin: 120px auto 0;
    
}

.wrapper .btn{
    width: 100%;
    height: 45px;
    background: #fff;
    border: none;
    outline: none;
    border-radius: 40px;
    box-shadow: 0 0 10px rgba(0,0,0,.1);
    cursor: pointer;
    font-size: 16px;
    color:#333;
    font-weight: 600;
}
.filec {
    background:none;
   font-size: 20px;
    margin-left: 20px;
    margin-bottom: 20px;
    margin-top: 10px;
       
 }
 .idiot{
    width: 10px;
    height: 10px;
    
 }



    </style>
</head>

<body>
    

    <form action='' method='post'>

    <div class="materials_box">
    <?php
    $x = new PDO("mysql:host=localhost;dbname=mybardesk", 'root', '');
    
    
    
    $sorgu = $x->prepare("SELECT * FROM user_materials WHERE user_id = :kullaniciId");
    $sorgu->bindParam(':kullaniciId', $id, PDO::PARAM_INT);
    $sorgu->execute();  
    $fmaterials = $sorgu->fetchAll(PDO::FETCH_ASSOC);
    $userMaterials = array_column($fmaterials, 'material_name');
    
    $list = $x->query("SELECT * FROM cocktail_material");
    foreach ($list as $material) {
        $picture = $material['material_picture'];
        $name = $material['material_name'];
        $material_value = $material['material_value'];
        
        
        $checked = in_array($material_value, $userMaterials) ? 'checked' : '';
       
        
        echo "<input type='checkbox' name='$material_value' value='$material_value' class='secenek' $checked><img src='../mybardesk/material_pictures/$picture' class='fotograf'><label class='label1' for='$name'>$name</label><br>";
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
    $delete = $x->exec("DELETE FROM user_materials WHERE user_id = $id");    
    foreach ($list as $value) {
        $isim = $value['material_value'];


        if (isset($_POST[$isim])) {
            
        $sorgu = $x->exec("INSERT INTO user_materials (user_id, material_name) VALUES ('$id','$isim')");

        }
    }
    
}
?>