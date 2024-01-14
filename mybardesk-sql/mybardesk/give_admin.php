<?php
session_start();
 $type= $_SESSION['usertype'];
if($type="admin")
{

}
else if($type== "user")
{
    header("change_materials.php");
}
else if($type==null)
{
    header("asdas.php");
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .secenek {
            margin-left: 10px;
            width: 20px;
            height: 20px;
            border: 2px solid #fff;
            border-radius: 3px;
            vertical-align: middle;
        }

        input[type="checkbox"]:checked {
            background-color: black;
        }

        .label1 {
            font-size: 40px;
            font-family: Arial, Helvetica, sans-serif;
            color: #ffffff;

        }
    </style>

</head>

<body>
    <form action="" method="post">
        <div class="oge">
            <?php
            $x = new PDO("mysql:host=localhost;dbname=mybardesk", 'root', '');
            $use = $x->query("SELECT * FROM kullanici");

            foreach ($use as $row) {

                if ($row['type'] == "admin") {
                    $isadmin = "checked";
                } else {
                    $isadmin = " ";

                }
                $name = $row['username'];
                echo "<input type='checkbox' name='$name' value='$name' class='secenek' $isadmin><label class='label1' for='$name'>$name</label><br>";

            }




            ?>

        </div>
        <input type="submit" name="save" value="save">
    </form>
</body>

</html>
<?php
if (isset($_POST['save'])) {
    $x = new PDO("mysql:host=localhost;dbname=mybardesk", 'root', '');
    $list = $x->query("SELECT * FROM kullanici");
    foreach ($list as $value) {
        $username = $value['username'];


        if (isset($_POST[$username])) {
            $add = $x->exec("UPDATE `kullanici` SET `type`='admin' WHERE `username`='$username'");

        }
        if (!isset($_POST[$username])) {
            $add = $x->exec("UPDATE `kullanici` SET `type`='user' WHERE `username`='$username'");

        }
    }
}
?>