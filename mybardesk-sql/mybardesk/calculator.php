<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            overflow: hidden;
            background: url('bg2.jpg')no-repeat;
            background-size: cover;
            background-position: center;
            height: 100vh;
            background-attachment: fixed;
        }

        .framm {
            margin: auto;
            width: 800px;
            height: 600px;
            backdrop-filter: blur(20px);
            border-radius: 20px;
            border: 2px solid rgba(255, 255, 255, .2);
            box-shadow: 0 0 10px rgba(0, 0, 0, .2);
            overflow: auto;

        }

        .usercockt {
            margin: 10px;
            border: 2px solid rgba(255, 255, 255, .2);
            box-shadow: 0 0 10px rgba(0, 0, 0, .2);
            border-radius: 20px;
            height: 200px;
        }

        .usercocktpic {
            float: left;
            height: 180px;
            width: 240px;
            margin: 10px;
            border-radius: 20px;
        }

        .usercockttitle .h2c {
            color: #fff;
            font-size: 40px;
            height: 40px;
            float: top;
            float: right;
            margin-top:auto;
            text-align: left;
            width: 500px;
            
        }

        .usercockt .usercocktdes {
            color: #fff;
            border: 2px solid rgba(255, 255, 255, .2);
            box-shadow: 0 0 10px rgba(0, 0, 0, .2);
            border-radius: 20px;
            float: right;
            width: 450px;
            height: 70px;
            margin-top: -10px;
            margin-right: 30px;


        }

        .usercocktdes {
            padding: 10px;
        }

        .btnuse {
            float: right;
            margin-top: auto;
            margin-right: 30px;
            font-size: 20px;
            border-radius: 20px;
            padding: 10px;
            border: 2px transparent;



        }
        .framm::-webkit-scrollbar {
        width: 10px;
        overflow-x: hidden;
        
        background-color: transparent;
    }
    .framm::-webkit-scrollbar-thumb {
        background-color:#fff;
        border-radius: 20px;
    }
    .fiza{
        text-align: center;
        color: #fff;
    }
    .tesx{
        color:#fff;
    }
    </style>
</head>

<body>
    <div class="framm">
        <?php
        session_start();
        $userid = $_SESSION["user_id"];
        $x = new PDO("mysql:host=localhost;dbname=mybardesk", 'root', '');
        $list = $x->query("SELECT * FROM cocktails");
        $sorgu = $x->prepare("SELECT * FROM user_materials WHERE user_id = :kullaniciId");
        $sorgu->bindParam(':kullaniciId', $userid, PDO::PARAM_INT);
        $sorgu->execute();
        $fmaterials = $sorgu->fetchAll(PDO::FETCH_ASSOC);
        $userMaterials = array_column($fmaterials, 'material_name');
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
            $maxMissingMaterials = 4;
            if (count($missingMaterials) <= $maxMissingMaterials) {
                if (count($missingMaterials) == 0) {
                    echo '
                    <div class="usercockt" onclick="window.location.href=\'cocktail.php?c=' . $id . '\'">
                        <img class="usercocktpic" src="../mybardesk/cocktail_pictures/' . $picture . '" alt="' . $name . '" onclick="window.location.href=\'cocktail.php?c=' . $id . '\'">
                        <div class="usercockttitle">
                            <h2 class="h2c">' . $name . '</h2>
                        </div>
                        <div class="usercocktdes"><label class="lbldes">' . $desc . '</label></div><br>
                        
                    </div>';
                } else {
                    $missingMaterialsString = implode(', ', $missingMaterials);
                    echo'<h1 class="fiza">with more material you can do the fallowing</h1>';
                    echo '
                    <div class="usercockt" onclick="window.location.href=\'cocktail.php?c=' . $id . '\'">
                        <img class="usercocktpic" src="../mybardesk/cocktail_pictures/' . $picture . '" alt="' . $name . '" onclick="window.location.href=\'cocktail.php?c=' . $id . '\'">
                        <div class="usercockttitle">
                            <h2 class="h2c">' . $name . '</h2>
                        </div>
                        <div class="usercocktdes"><label class="lbldes">' . $desc . '</label></div><br>
                        <label class="tesx">MİSSİNG MATERİALS: '.$missingMaterialsString.'</label>
                        
                    </div>';                 
                }
            }
        }

        ?>
    </div>
</body>
</html>