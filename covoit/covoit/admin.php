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
        
    ?>

    <body class="auth_class">
        <div class="container login-container">
            <form action="<?php echo htmlspecialchars($_SERVER['REQUEST_URI'], ENT_QUOTES); ?>" method="post">
                <input type="text" name="nom_rech" id="nom_rech" placeholder="Nom de la personne pour modifier" value="<?php if(!empty($_POST['nom_rech'])) { echo htmlspecialchars($_POST['nom_rech'], ENT_QUOTES); }?>" required>
                <input type="text" name="prenom_rech" id="prenom_rech" placeholder="Prénom de la personne pour modifier" value="<?php if(!empty($_POST['prenom_rech'])) { echo htmlspecialchars($_POST['prenom_rech'], ENT_QUOTES); }?>" required>

                <div>
                    <input type="text" name ="rep_email" id="rep_email" placeholder="rentrer l'adresse mail" value="<?php if(!empty($_POST['rep_email'])) {echo htmlspecialchars($_POST['rep_email'], ENT_QUOTES);} ?>">
                    <input type="password" name="rep_password" id="rep_password" placeholder="Rentrer mot de passe" value="<?php if(!empty($_POST['rep_password'])) {echo htmlspecialchars($_POST['rep_password'], ENT_QUOTES);} ?>">
                    <button type="submit" name="submit" id="submit" value="changer" onclick="<?php
                    $nom_rech=!empty($_POST['nom_rech']) ? $_POST['nom_rech'] : NULL ;
                    $prenom_rech=!empty($_POST['prenom_rech']) ? $_POST['prenom_rech'] : NULL ;
                    $rep_email=!empty($_POST['rep_email']) ? $_POST['rep_email'] : NULL ;
                    $rep_password=!empty($_POST['rep_password']) ? $_POST['rep_password'] : NULL ;
                    
                    
                    if(!empty($_POST)){
                        // Changer le mot de passe et l'adresse de n'importe quelle festivaliers
                        if(empty($_POST['nom_rech'])){}
                        else if(empty($_POST['prenom_rech'])){}
                        else {
                            
                            $rech_personne="SELECT id_personne FROM compte WHERE(nom='".$nom_rech."' AND prenom='".$prenom_rech."')";
                            $resul_rech_personne = mysqli_query($link_login, $rech_personne);
            
                            $id_personne=implode("",mysqli_fetch_assoc($resul_rech_personne));
            
                            // modification de la bdd
            
                            if((empty($_POST['rep_email'])) && (!empty($_POST['rep_password']))){
                                // modifie juste password
                                $update_password="UPDATE compte SET passw='".$rep_password."' WHERE(id_personne = '".$id_personne."')";
                                $resul_udp_password = mysqli_query($link_login, $update_password);
                            }
                            else if(!empty($_POST['rep_email']) && (empty($_POST['rep_password']))){
                                //modifie juste mail
                                $update_email="UPDATE compte SET email='".$rep_email."' WHERE(id_personne = '".$id_personne."')";
                                $resul_udp_email = mysqli_query($link_login, $update_email);
                            }
                            else{
                                //modifie les deux 
                                $update_both="UPDATE compte SET passw='".$rep_password."',email='".$rep_email."' WHERE(id_personne = '".$id_personne."')";
                                $resul_udp_both = mysqli_query($link_login, $update_both);
                            }
            
                        }
                        
                    }
                    ?>">CHANGER LES INFORMATIONS</button>
                    
                </div>
                
            modifier l'adresse du festivale
            </form>
                
            <form action="<?php echo htmlspecialchars($_SERVER['REQUEST_URI'], ENT_QUOTES); ?>" method="post">
                <input type="text" id="adr_festival" name="adr_festival" placeholder="saisir adresse festival" value="<?php if(!empty($_POST['adr_festival'])) {echo htmlspecialchars($_POST['adr_festival'], ENT_QUOTES);} ?>" required>
                <button name="mod_adr_festival" name="mod_adr_festival" value="Changer" onclick="<?php 
                /* Mettre la variable de session pour l'édition lors de la création d'une sessions*/
                $_SESSION['num_edition'] = 2019;
                $adr_festival =!empty($_POST['adr_festival']) ? $_POST['adr_festival'] : NULL ;
                if(!empty($_POST)){
                    if(empty($_POST['adr_festival'])){}
                    else{
                        $mod_adr_festival="UPDATE edition SET lieu ='".$adr_festival."' wHERE (num_edition='".$_SESSION['num_edition']."')";
                        $resut_adr_festival = mysqli_query($link_login, $mod_adr_festival);
                    }
                } ?>"
                >Changer l adresse</button>
            </form>

            Supprimer un compte

            <form action="<?php echo htmlspecialchars($_SERVER['REQUEST_URI'], ENT_QUOTES); ?>" method="post">
                <input type="text" name="supp_compte_nom" id="supp_compte_nom" placeholder="nom" value="<?php if(!empty($_POST['supp_compte_nom'])) {echo htmlspecialchars($_POST['supp_compte_nom'], ENT_QUOTES);} ?>">
                <input type="text" name="supp_compte_prenom" id="supp_compte_prenom" placeholder="prenom" value="<?php if(!empty($_POST['supp_compte_prenom'])) {echo htmlspecialchars($_POST['supp_compte_prenom'], ENT_QUOTES);} ?>">
                <button type="submit" name="submit" onclick="<?php 
                
                ?>"
                >Supprimer compte</button>
            </form>


        </div>
   </body>
</html>
