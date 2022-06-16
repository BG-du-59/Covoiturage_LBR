<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Mes informations</title>
    </head>

    <!--My CSS-->
        <link rel="stylesheet" href="password_pages.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">


<?php

    session_start();
    include "bdd.php";
    include "mail_envoie.php";

    $password1 = !empty($_POST['password1']) ? $_POST['password1'] : NULL ;
    $password2 = !empty($_POST['password2']) ? $_POST['password2'] : NULL;

    if ($_POST) {
        if (empty($_POST['password1'])) {
        } else if (empty($_POST['password2'])) {
        } else {
        if ($password1 === $password2) {
            $changer_mdp = "UPDATE compte SET passw = '" . $password1 . "' WHERE (email = '" . $_SESSION['mail'] . "')";
            $requete_chg_mdp = mysqli_query($link_login, $changer_mdp);

            unset($_SESSION['code']);
            header("Location: connection.php");
            } else {
                echo "<script>alert(\"Les mots de passe sont différents\")</script>";
                    }
        }
    }

    
?>
    <body class="auth_class">
        <div class="container login-container">
            <div class="row">
                <div class="col-md-12 login-form">
                    <div class="login_form_in">
                        <h1 class="auth_title text-left">Réinitialisez votre mot de passe</h1>
                        <form action="<?php echo htmlspecialchars($_SERVER['REQUEST_URI'], ENT_QUOTES); ?>" method="post">
                            <div class="alert alert-danger bg-soft-primary border-0" role="alert">
                                <h1> adresse mail : <?php echo $_SESSION['mail']?></h1>
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" id="password1" name="password1" placeholder="Nouveau mot de passe" value="<?php if(!empty($_POST['password1'])) { echo htmlspecialchars($_POST['password1'], ENT_QUOTES); }?>" required>
                                </br>
                                <input type="password" class="form-control" id="password2" name="password2" placeholder="Confirmer mot de passe" value="<?php if(!empty($_POST['password2'])) { echo htmlspecialchars($_POST['password2'], ENT_QUOTES); }?>" required>
                            </div>
                            <div class="form-group">
                                <input type="submit" id="submit" name="submit" value="Modifier le mot de passe" class="btn btn-danger btn-lg btn-block">
                            </div>
                            <div class="form-group other_auth_links">
                                <a class="" href="">Annuler</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
   </body>
</html>
