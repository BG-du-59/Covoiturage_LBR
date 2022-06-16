<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>D'ou pars tu</title>
    <link href="creer_un_trajet.css" rel="stylesheet">
</head>

<?php include("bdd.php");session_start();?>

<?php
$requete_derniere_edition = "SELECT num_edition FROM edition ORDER BY num_edition DESC LIMIT 1";
$result = mysqli_query($link_login, $requete_derniere_edition);
$edition = mysqli_fetch_assoc($result);
$date = date('d-m-y');

/* --------- CALCUL DATE HEURE ARRIVEE AVEC API ----------------------- */

$requete_proposer = "INSERT INTO `trajet`(`id_trajet`, `type_`, `description`, `date_heure_depart`, `date_heure_arrivee`,`adresse`, `num_edition`, `date_creation`, `etat`) VALUES (0, '".$_SESSION["radio"]."','".$_SESSION['description']."','".$_SESSION['date_heure_depart']."','calcul api heure arrive','".$_SESSION['adress']."','".$edition["num_edition"]."','".$date."', 0)";
$requete_deja_proposer = "SELECT id_trajet FROM trajet_conducteur WHERE id_personne = '".$_SESSION["login"]."'";
$deja_proposer = mysqli_query($link_login, $requete_deja_proposer);

if(isset($_POST['oui']) && !empty($_POST['oui']))
    $tel = "oui";
else if (isset($_POST['oui']) && empty($_POST['oui']))
    $tel = "non";

    if(!empty($_POST)){
        // N'a pas propose de trajet
        if(mysqli_num_rows($deja_proposer) == 0) {
            $proposer = mysqli_query($link_login, $requete_proposer); // Inscrit le nouveau trajet dans la bdd
            $requete_trouver_id_trajet = "SELECT id_trajet FROM trajet ORDER BY id_trajet DESC LIMIT 1";
            $res = mysqli_query($link_login, $requete_trouver_id_trajet);
            $id_trajet = mysqli_fetch_assoc($res);

            $requete_ajt_trajet_conducteur = "INSERT INTO `trajet_conducteur`(`id_personne`, `id_trajet`, `prix`, `nb_passager`, `telephone_visible`) VALUES ('" . $_SESSION["login"] . "','" . $id_trajet["id_trajet"] . "','" . $_SESSION['prix'] . "','" . $_SESSION['nb_passager'] . "', '" . $tel . "')";
            $table_trajet_conducteur = mysqli_query($link_login, $requete_ajt_trajet_conducteur);


            /* ----------------------- ENVOIE MAIL AUX DEMANDEURS   -------- */


            header("Location: accueil_client.php");
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


<body style="background-color: #161920" ;>
    <div style="min-height: 720px; height : auto;">
        <header id="entete">
            <div id="logo">
                <img src="image\logoBLANC_1.png" id="image">
            </div>
            <div id="trajet_compte">
                <button type="button" id="bouton_mestrajets">Mes trajets</button>
                <button type="button" id="se_co"><img src="image\moncompte2.png" id="image2"></button>
            </div>
        </header>
        <div class="corps">
            <form action="<?php echo htmlspecialchars($_SERVER['REQUEST_URI'], ENT_QUOTES); ?>" method="post">
                <h1 class="question">Récaptitulatif du trajet</h1>
                <div class="recap" style="overflow-y:scroll;">
                    <p>
                        Départ : <?php echo $_SESSION['adress'];?>
                    </p>
                    <p>
                        Date de départ : <?php echo $_SESSION['date_heure_depart'];?>
                    </p>
                    <p>
                        Heure de départ :  <?php echo $_SESSION['time'];?>
                    </p>
                    <p>
                        Nombre de passager : <?php echo $_SESSION['nb_passager'];?>
                    </p>
                    <p>
                        Prix du trajet/personne : <?php echo $_SESSION['prix'];?>
                    </p>
                    <p>
                        Description : <?php echo $_SESSION['description'];?>
                    </p>

                </div>
                <div class="align_button">
                    <form action="<?php echo htmlspecialchars($_SERVER['REQUEST_URI'], ENT_QUOTES); ?>" method="post">
                        <div id="check">
                        <input type="checkbox" name="oui" value="oui">Je souhaite que mon telephone figure sur l'annonce
                        <p>Sachez que votre e-mail sera visible sur le site.</p>
                        </div>
                        <div class="next">
                            <input type="submit" value="Proposer" class="submit">
                        </div>
                    </form>
                    
                    <a class="previous" href="creer_un_trajet_5.php">
                        <input type="button" value="Précédent" class="button">
                    </a>
                </div>
            </form>
        </div>
    </div>
</body>


</html>