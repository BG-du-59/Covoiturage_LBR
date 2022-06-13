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

    $address=!empty($_POST['adress_mail']) ? $_POST['adress_mail'] : NULL;
    if(!empty($_POST)){
        if(empty($_POST['adress_mail'])){}
        else{

            //verification que le compte existe

            $ensemblemail="SELECT email FROM compte";
            $result_ensemble_mail=mysqli_query($link_login, $ensemblemail);

            $pers_existe = false;
            while ($row = mysqli_fetch_assoc($result_ensemble_mail)){
                echo implode("",$row);
                if (implode("",$row) === $_POST['adress_mail']){
                    $pers_existe = true;
                }
            }

            if ($pers_existe){
                // génération d'un unique code
            $length=6; /* longueur de la ligne du code */
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $charactersLength = strlen($characters);
            $code = '';
            for ($i = 0; $i < $length; $i++) {
                $code .= $characters[rand(0, $charactersLength - 1)];
            }

            // envoie du mail contenant le mot de passe
            $body="Vous avez demandé à réinitialiser votre mot de passe. Veuillez saisir le code suivant '.$code.' ";

            e_mail($address,$body,"Demande de réinitialisation de mot de passe");
            
            $_SESSION['mail']=$address;
            $_SESSION['code'] =$code;
            
            header("Location: verif_code.php");
            }
            else{
                echo "<script>alert(\"Aucun compte ne coresspond à cette adresse mail\")</script>";
            }

            
        }
    }

?>

    <body>
        <div style="min-height: 720px; height : auto;">
            <div>
                <h1>Entrer votre adresse mail</h1>
                <form action="<?php echo htmlspecialchars($_SERVER['REQUEST_URI'], ENT_QUOTES); ?>" method="post">
                    <input type="text" id="adress_mail" name="adress_mail" value="<?php if(!empty($_POST['adress_mail'])) { echo htmlspecialchars($_POST['adress_mail'], ENT_QUOTES); }?>">
                    <input type="submit" id="submit" name="submit" value="Envoyer">
                </form>
            </div>
        </div>
    </body>
</html>