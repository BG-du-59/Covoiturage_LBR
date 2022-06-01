<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>Mot de passe oublié</title>
    </head>

    <?php include('bdd.php'); session_start(); $_SESSION["login"]= "marcmichel@test.com" ?>
    <?php include('mail_envoie.php') ?>

    <?php 

        
        $passw1 = !empty($_POST['password1']) ? $_POST['password1'] : NULL;
        $passw2 = !empty($_POST['password2']) ? $_POST['password2'] : NULL;


        if(!empty($_POST)){
            if ($_POST['password1'] === $_POST['password2']){
                $modif_passw = "UPDATE compte SET passw= '".$passw1."' WHERE email = '".$_SESSION["login"]."' ";
                $resul_modif_passw = mysqli_query($link_login, $modif_passw);
                echo "votre mot de passe a été changé";
            }
            else{
                echo "les mots de passe sont différents";
            }
        }

        


    
    ?>

    <body>
    
        <form action="<?php echo htmlspecialchars($_SERVER['REQUEST_URI'], ENT_QUOTES); ?>" method="post">
            <label>Mot de passe</label>
            <input type="text" name="password1" id="password1" value="<?php if(!empty($_POST['password1'])) { echo htmlspecialchars($_POST['password1'], ENT_QUOTES); } ?>" required>
            <label>Repetez le mot de passe</label>
            <input type="text" name="password2" id="password2" value="<?php if(!empty($_POST['password2'])) { echo htmlspecialchars($_POST['password2'], ENT_QUOTES); } ?>" required>
            <input type="submit" name="submit" value="valider">
        </form>
        
    </body>
</html>