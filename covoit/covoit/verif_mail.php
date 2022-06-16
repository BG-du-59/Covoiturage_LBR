<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Mes informations</title>
    </head>

<?php

    session_start();
    echo $_SESSION['code'];

    $verif_code = !empty($_POST['code']) ? $_POST['code'] : NULL;

    if(!empty($_POST)){
        if (empty($_POST['code'])){}
        else{
            if($verif_code == $_SESSION['code']){
                unset ($_SESSION['code']);
                header("Location: accueil_client.php");
            }
            else{
                echo "<script>alert(\"Le code est invalide\")</script>";
            }
        }
    }
    

?>

    <body>
        <div style="min-height: 720px; height : auto;">
            <h1>Saississez le code reçu</h1>
            <form action="<?php echo htmlspecialchars($_SERVER['REQUEST_URI'], ENT_QUOTES); ?>" method="post">
                <input type="text" id="code" name="code" value="<?php if(!empty($_POST['code'])) { echo htmlspecialchars($_POST['code'], ENT_QUOTES); }?>" required>
                <input type="submit" id="submit" name="submit" value="Valider">
            </form>
        </div>
    </body>
</html>
