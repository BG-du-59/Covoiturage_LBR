<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Proposer</title>
</head>



    <?php include('bdd.php'); session_start(); $_SESSION["login"] = 2;?>
    <?php include('mail_envoie.php');?>

      <?php // rajouter champ bdd trajet conducteur s'il veut rendre public telelepone ET PREVENIR QUE MAIL SERA VISIBLE SUR LE SITE
        $radio = !empty($_POST['radio']) ? $_POST['radio'] : NULL;
        $depart = !empty($_POST['depart']) ? $_POST['depart'] : NULL;
        $arrivee = !empty($_POST['arrivee']) ? $_POST['arrivee'] : NULL;
        $nb = !empty($_POST['nb']) ? $_POST['nb'] : NULL;
        $prix = !empty($_POST['prix']) ? $_POST['prix'] : NULL;
        $desc = !empty($_POST['desc']) ? $_POST['desc'] : "";

        $requete_derniere_edition = "SELECT num_edition FROM edition ORDER BY num_edition DESC LIMIT 1";
        $result = mysqli_query($link_login, $requete_derniere_edition);
        $edition = mysqli_fetch_assoc($result);
        

        $date = date('d-m-y');
        if(isset($_POST['radio']))
            $requete_proposer = "INSERT INTO `trajet`(`id_trajet`, `type_`, `description`, `date_heure_depart`, `date_heure_arrivee`, `num_edition`, `date_creation`) VALUES (0, '".$_POST["radio"]."','".$desc."','".$depart."','".$arrivee."','".$edition["num_edition"]."','".$date."')";

        $requete_deja_proposer = "SELECT id_trajet FROM trajet_conducteur WHERE id_personne = '".$_SESSION["login"]."'";
        $deja_proposer = mysqli_query($link_login, $requete_deja_proposer);

        if(!empty($_POST)){
                if(empty($_POST['radio'])) {}
                else if(empty($_POST['depart'])){}
                else if(empty($_POST['arrivee'])){}
                else if(empty($_POST['nb'])){}
                else if(empty($_POST['prix'])){}

                // S'il n'a pas déjà proposer de trajet 
                else if(mysqli_num_rows($deja_proposer) == 0){
                    if(empty($_POST['desc']) || !empty($_POST['desc'])){
                    $proposer = mysqli_query($link_login, $requete_proposer);
                    $requete_trouver_id_trajet = "SELECT id_trajet FROM trajet ORDER BY id_trajet DESC LIMIT 1";
                    $res = mysqli_query($link_login, $requete_trouver_id_trajet);
                    $id_trajet = mysqli_fetch_assoc($res);

                    $requete_ajt_trajet_conducteur = "INSERT INTO `trajet_conducteur`(`id_personne`, `id_trajet`, `prix`, `nb_passager`, `telephone_visible`) VALUES ('".$_SESSION["login"]."','".$id_trajet["id_trajet"]."','".$_POST["prix"]."','".$_POST["nb"]."', 'non')";
                    $table_trajet_conducteur = mysqli_query($link_login,  $requete_ajt_trajet_conducteur);
                    }




                    /* ----------------------- ENVOIE MAIL AUX DEMANDEURS      ----- */
                    
                    
                    
                    /* ------ header("Location: page.php"); REDIRIGE QUAND FINIS PROPOSER ? -----*/
                }

                // Il a déjà proposer un trajet, on lui demande s'il veut le supprimer ou le modifier
                else if(mysqli_num_rows($deja_proposer) == 1){

                // affichage 2 bouton supp ou modif qui redirige



            // SUPPRIMER PROPOSITION :
                    // Envoie mail au festivalier qui a réservé pour le voyage que le conducteur a supprimé

                    // tous les id des passagés :
                    $nb_passagers = "SELECT id_personne FROM rejoindre WHERE rejoindre.id_trajet = (SELECT id_trajet FROM trajet_conducteur WHERE trajet_conducteur.id_personne = '".$_SESSION['login']."')";
                    $_res_nb = mysqli_query($link_login, $nb_passagers);

                    // récupere mail passagé via leur ID et leur envoie un mail :
                    while($row = mysqli_fetch_assoc($_res_nb)){
                        $requete_email = "SELECT email FROM compte WHERE id_personne = '".$row['id_personne']."'";
                        $res_email = mysqli_query($link_login, $requete_email);
                        $email = mysqli_fetch_assoc($res_email);
                        echo $email['email']; // mail du passagé

                        /* ---------- ENVOYE MAIL -------------- */
                        $body= "Bonjour, votre trajet a été supprimé. Vous pouvez retrouver un trajet en retournant sur le site";
                        $subject = "Trajet surpprimé";
                        
                        $success=e_mail($email['email'],$body,$subject);
                        if ($success == 1){
                            echo "email envoyé";
                        }
                        else{
                            echo "erreur d'envoie ";
                        }


                    }

                    // table rejoindre
                    $requete_1 = "DELETE FROM `rejoindre` WHERE rejoindre.id_trajet = (SELECT id_trajet FROM trajet_conducteur WHERE trajet_conducteur.id_personne = '".$_SESSION['login']."')";
                    $_res1 = mysqli_query($link_login, $requete_1);

                    // table trajet
                    $requete_2 = "DELETE FROM `trajet` WHERE trajet.id_trajet = (SELECT id_trajet FROM trajet_conducteur WHERE trajet_conducteur.id_personne = '".$_SESSION['login']."')";
                    $_res2 = mysqli_query($link_login, $requete_2);

                    // table trajet_conducteur
                    $requete_3 = "DELETE FROM `trajet_conducteur` WHERE trajet_conducteur.id_personne = '".$_SESSION['login']."'";
                    $_res3 = mysqli_query($link_login, $requete_3);


             // MODIFIER PROPOSITION :

                    // Affichage formulaire
                }
        } 
    
    ?>


<body>

    <form action="<?php echo htmlspecialchars($_SERVER['REQUEST_URI'], ENT_QUOTES); ?>" method="post">
        <label>Type de trajet : </label>
        <div>
        <input type="radio" id="radio" name="radio" value="aller"
                checked>
        <label>Aller</label>
        </div>

        <div>
        <input type="radio" id="radio" name="radio" value="retour">
        <label>Retour</label>
        </div>

        <!-- Mettre heure min et heure max selon edition BDD-->
        <label>Heure de depart</label>
        <input type="date" name="depart" id="depart" value="<?php if(!empty($_POST['depart'])) { echo htmlspecialchars($_POST['depart'], ENT_QUOTES); } ?>" required>

        <label>Heure d'arrivee</label>
        <input type="date" name="arrivee" id="arrivee" value="<?php if(!empty($_POST['arrivee'])) { echo htmlspecialchars($_POST['arrivee'], ENT_QUOTES); } ?>" required>

        <label>Nombre de passagers</label>
        <input type="number" min="1" max="8" name="nb" id="nb" value="<?php if(!empty($_POST['nb'])) { echo htmlspecialchars($_POST['nb'], ENT_QUOTES); } ?>" required>

        <label>Prix</label>
        <input type="text" name="prix" id="prix" value="<?php if(!empty($_POST['prix'])) { echo htmlspecialchars($_POST['prix'], ENT_QUOTES); } ?>" required>

        <label>Description</label>
        <input type="textarea" name="desc" id="desc" value="<?php if(!empty($_POST['desc'])) { echo htmlspecialchars($_POST['desc'], ENT_QUOTES); } ?>">

        <input type="submit" name="submit" value="Proposer" />
        </p>
                <?php if(!empty($message)) :
                    echo '<div style="text-align: center ;margin-top: 4px; font-size: 20px;font-weight: bold; color: white; text-decoration: underline;">  '.$message.' </div>';
                endif; ?>
        </p>
    </form>

</body>
</html>