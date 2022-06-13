<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Mes informations</title>
    </head>

<?php

    session_start();
    include "bdd.php";
    include "mail_envoie.php";

    $password1 = !empty($_POST['password1']) ? $_POST['password1'] : NULL ;
    $password2 = !empty($_POST['password2']) ? $_POST['password2'] : NULL ;
    
    if($_POST){
        if(empty($_POST['password1'])){}
        else if(empty($_POST['password2'])){}
        else{
            if($password1=== $password2){
                $changer_mdp="UPDATE compte SET passw = '".$password1."' WHERE (email = '".$_SESSION['mail']."')";
                $requete_chg_mdp = mysqli_query($link_login, $changer_mdp);

                unset($_SESSION['code']);
                header("location: connection.php");
            }
            else{
                echo "<script>alert(\"Les mots de passe sont différents\")</script>";
            }
        }
    }
?>

    <body>
        <div style="min-height: 720px; height : auto;">
            <form action="<?php echo htmlspecialchars($_SERVER['REQUEST_URI'], ENT_QUOTES); ?>" method="post">
                <p>adresse mail : <?php echo $_SESSION['mail']?></p>
                <input type="text" id="password1" name="password1" placeholder="Nouveau mot de passe" value="<?php if(!empty($_POST['password1'])) { echo htmlspecialchars($_POST['password1'], ENT_QUOTES); }?>" required>
                <input type="text" id="password2" name="password2" placeholder="Confirmer mot de passe" value="<?php if(!empty($_POST['password2'])) { echo htmlspecialchars($_POST['password2'], ENT_QUOTES); }?>" required>
                <input type="submit" id="submit" name="submit" value="Valider">
            </form>
        </div>
    </body>
</html>