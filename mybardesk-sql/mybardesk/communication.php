<?php
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
    <link rel="stylesheet" href="profile1.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <title>MyBarDesk</title>
    <style>
        
        .email {
            font-size: 20px;
            color: white;
            width: 400px;
            height: 150px;
            margin-top: 50px;
            margin-left: 600px;
            text-align: center;
            display: flex;
            flex-direction: column;
            border-radius: 20px;
            border: 2px solid rgba(255, 255, 255, .2);
            backdrop-filter: blur(20px);
            box-shadow: 0 0 10px rgba(0, 0, 0, .2);
        }

        .txtarea {
            margin-top: 15px;

            background-color: transparent;
            height: 100px;
            width: 500px;
            border-radius: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, .2);
            overflow: scroll;
            resize: none;
            scrollbar-width: thin;
            font-size: 20px;
            color: white;
            padding-left: 10px;
            padding-top: 10px;
            margin-left: 50px;
            margin-top: 20px;


        }


        .message {
            border: 2px solid rgba(255, 255, 255, .2);
            backdrop-filter: blur(20px);
            box-shadow: 0 0 10px rgba(0, 0, 0, .2);
            height: 300px;
            border-radius: 20px;
            width: 600px;
            margin-left: 500px;
            margin-top: 30px;

        }

        .btnsend {

            width: 50%;
            height: 45px;
            background: #fff;
            border: none;
            outline: none;
            border-radius: 40px;
            box-shadow: 0 0 10px rgba(0, 0, 0, .1);
            cursor: pointer;
            font-size: 16px;
            color: #333;
            font-weight: 600;
            margin-left: 150px;
            margin-top: 20px;

        }

        .txtarea::-webkit-scrollbar {
            width: 10px;
            overflow-x: hidden;

            background-color: transparent;
        }

        .txtarea::-webkit-scrollbar-thumb {
            background-color: transparent;
            border-radius: 20px;
        }

        .boo {
            color: white;
            padding-top: 10px;
            padding-left: 60px;
        }

        .admin {
            border: 2px solid rgba(255, 255, 255, .2);
            backdrop-filter: blur(20px);
            box-shadow: 0 0 10px rgba(0, 0, 0, .2);
            margin: auto;
            height: 550px;
            width: 700px;
            margin-top: 20px;
            overflow-y: auto;
            


        }

        .messages {
            box-shadow: 0 0 10px rgba(0, 0, 0, .2);
            border: 2px solid rgba(255, 255, 255, .2);
            margin: 20px;
            color: #fff;


        }

        .userinfo {
            box-shadow: 0 0 10px rgba(0, 0, 0, .2);
            border: 2px solid rgba(255, 255, 255, .2);
            margin-inline: -1px;
            height: 40px;
            color: #fff;
            font-size: 30px;
            padding-inline: 5px;

        }

        .date {
            float: right;
            font-size: 20PX;

        }

        .messageee {
            margin: 10px;
            overflow-y: auto;
            height: 90px;
        }

        .webkit-scrollbar {
            color: transparent;
        }

       
        .title{
            color: #fff;
            text-align: center;
            margin-top: 10px;           
        }
        .admin::-webkit-scrollbar {
        width: 10px;
        overflow-x: hidden;
        
        background-color: transparent;
    }
    .admin::-webkit-scrollbar-thumb {
        background-color:#fff;
        border-radius: 20px;
    }
    .messageee::-webkit-scrollbar {
        width: 10px;
        overflow-x: hidden;
        
        background-color: transparent;
    }
    .messageee::-webkit-scrollbar-thumb {
        background-color:#fff;
        border-radius: 20px;
    }
    </style>
</head>
<?php

    echo'
<body>
    <div class="email">
        <h1>CONTACT</h1><br>
        <label class="emailbl">EMAİL: serkankecek@gmail.com</label>
        <label class="emailbl">INSTAGRAM: @serkank.02</label>
        <form action="" method="post">
    </div>';
    if (isset($_SESSION["usertype"]) && $_SESSION["usertype"] == "user") {
        echo'
    <div class="message">
        <h1 class="boo"> TEXT A MESSAGE TO ADMİNS<h1>
                <textarea placeholder="text your message" class="txtarea" name="text"></textarea><br>
                <input class="btnsend" type="submit" name="send" value="send">
    </form>
    </div>';}
echo'</body>';
if (isset($_POST['send'])) {
    $message = $_POST['text'];
    $datee = date("Y-m-d H:i:s");
    $x = new PDO("mysql:host=localhost;dbname=mybardesk", 'root', '');
    $list = $x->query("SELECT * FROM kullanici");
    foreach ($list as $row) {
        if ($_SESSION["username"] == $row["username"]) {
            $id = $row["id"];
            $username = $row['username'];


        }
    }
    $add = $x->exec("INSERT INTO messages (user_id, username,date,message) VALUES ('$id','$username', '$datee', '$message')");
}

if(isset($_SESSION["usertype"]) && $_SESSION["usertype"] == "admin"){
        $x = new PDO("mysql:host=localhost;dbname=mybardesk", 'root', '');
           
    $firstlist = $x->query("SELECT * FROM messages"); 
    $messagesArray = $firstlist->fetchAll(PDO::FETCH_ASSOC); 
    $reversedArray = array_reverse($messagesArray);    
echo'
<body>
<h1 class="title">USER MESSAGES</h1>
    <div class="admin">';
    foreach ($reversedArray as $row) {
        $username= $row['username'];
        $date= $row['date'];
        $message= $row['message'];
        echo'

        <div class="messages">

            <div class="userinfo">
                <label>'.$username.'</label>
                <label class="date">DATE:'. $date.'</label>
            </div>
            <div class="messageee">'.$message.'</div>
    


        </div>';
    }

   echo' </div>
</body>';
}
?>


</html>
<?php

?>