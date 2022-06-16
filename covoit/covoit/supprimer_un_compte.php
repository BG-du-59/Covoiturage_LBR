<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Mes informations</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
</head>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    <?php 
    
        session_start(); $_SESSION['login']=2;
        include ('bdd.php');
        include ('mail_envoie.php');

        if(!empty($_POST)){
            $body="<!DOCTYPE html>
            <html>
                <head>
                    <meta charset='utf-8'>
                </head>
                <body>
                    <h2>Votre compte a bien été supprimé</h2>
                </body>
            </hmtl>";



            $mail= "SELECT email FROM compte WHERE(id_personne ='".$_SESSION['login']."') ";
            $result_mail = mysqli_query($link_login, $mail);
            $mail_exp = implode("",mysqli_fetch_assoc($result_mail));
            $mail_compte_sup=e_mail($mail_exp,$body,"VOTRE COMPTE A ETE SUPPRIME");
            if($mail_compte_sup===1){
                $supprimer ="DELETE from compte WHERE(id_personne = '".$_SESSION['login']."')";
                $result_supprimer= mysqli_query($link_login, $supprimer);
                $supprimer_trajet = "DELETE FROM demande WHERE(id_personne ='".$_SESSION['login']."')";
                header('Location: acceuil_client.php');
            }
        }
        

        ?>
 


    <body>
        <div style ="min-height: 720px; height: auto;">
            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#supprimer_compte">Supprimer mon compte</button>

            <!-- Popup pour demander la confirmation de suppression du compte -->

            <div class="modal" id="supprimer_compte" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered modal-fullscreen-mb-down">
                    <div class="modal-content">
                        <div class="modal-header entete">
                        <p style="padding-left: 40px;">Voulez-vous supprimer votre compte ?</p>
                            <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-footer">
                            <form action="<?php echo htmlspecialchars($_SERVER['REQUEST_URI'], ENT_QUOTES); ?>" method="post">
                                <input type="submit" class="btn btn-danger" name="supprimer" value="Supprimer mon compte" />
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        </div>
    </body>

</html>