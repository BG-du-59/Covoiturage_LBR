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

    $address=!empty($_POST['adress_mail']) ? $_POST['adress_mail'] : NULL;
    if(!empty($_POST)){
    if(empty($_POST['adress_mail'])){}
    else{

        //verification que le compte existe

        $ensemblemail="SELECT email FROM compte";
        $result_ensemble_mail=mysqli_query($link_login, $ensemblemail);

        $pers_existe = false;
        while ($row = mysqli_fetch_assoc($result_ensemble_mail)){
            if (implode("",$row) === $_POST['adress_mail']){
                $pers_existe = true;
            }
        }

        if ($pers_existe){
        // génération d'un unique code
        $code= code_verification();
        // envoie du mail contenant le mot de passe
        $body="<!DOCTYPE html>
            <html>
            <head>
            <meta charset='utf-8'>
            </head>
            <body>
            Vous avez demandé à réinitialiser votre mot de passe.<strong> Veuillez saisir le code suivant '.$code.'</strong> 
            </body>
            </hmtl>";

            e_mail($address, $body, "Demande de réinitialisation de mot de passe");

            $_SESSION['mail'] = $address;
            $_SESSION['code'] = $code;
            header("Location: verif_code.php");
        } else {
            echo "<script>alert(\"Aucun compte ne correspond à cette adresse mail\")</script>";
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
                                <h1> Entrez votre adresse mail, vous receverez les instructions afin de réinitialiser le mot de passe.</h1>
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control" id="adress_mail" name="adress_mail" placeholder="Adresse E-mail" value="<?php if(!empty($_POST['adress_mail'])) { echo htmlspecialchars($_POST['adress_mail'], ENT_QUOTES); }?>">
                            </div>
                            <div class="form-group">
                                <input type="submit" id="submit" name="submit" value="Réinitialiser le mot de passe" class="btn btn-danger btn-lg btn-block">
                            </div>
                            <div class="form-group other_auth_links">
                                <a class="" href="">Se connecter</a>
                                <a class="" href="">Inscription</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
   </body>
</html>
