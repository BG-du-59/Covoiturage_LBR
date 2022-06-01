<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Connexion</title>
</head>
    <?php include('bdd.php') ?>

    <?php 
    //$id = $_SESSION['login'];
    $conducteur = mysqli_query($link_login,"SELECT id_personne, nb_passager FROM trajet_conducteur WHERE id_personne = '".$_SESSION['login']."'");
    $passager = mysqli_query($link_login,"SELECT id_personne, id_trajet FROM rejoindre WHERE id_personne = '".$_SESSION['login']."'");


    // CAS CONDUCTEUR :
    if(mysqli_num_rows($conducteur) == 1){
        // DONNEE DU TRAJET :
        $conducteur1 = mysqli_query($link_login, "SELECT prix, nb_passager, date_heure_depart, date_heure_arrivee, description, date_creation FROM trajet INNER JOIN trajet_conducteur WHERE trajet.id_trajet = trajet_conducteur.id_trajet AND id_personne = '".$_SESSION['login']."'");
        $donnee_conducteur = mysqli_fetch_assoc($conducteur1);

        // Avoir adresse arrivée et destination : 
        $ad1 = mysqli_query($link_login, "")

        // Calcul nombre de place libre
            // recup id du trajet du conducteur :
        $id_trajet_conducteur =  mysqli_query($link_login, "SELECT id_trajet FROM trajet_conducteur WHERE id_personne='".$_SESSION['login']."'");
        $id1 = mysqli_fetch_assoc($id_trajet_conducteur);
            // Compte cbm il y a de passager(s) sur ce trajet
        $count_passagers = mysqli_query($link_login, "SELECT COUNT('id_personne') FROM rejoindre WHERE id_trajet='".$id1['id_trajet']."'");
        $count = mysqli_fetch_assoc($count_passagers);
        $nb_max = mysqli_fetch_assoc($conducteur);
        $place_dispo = $nb_max['nb_passager'] - $count['COUNT('id_personne')'];

        /* INNER TXT GET_element by id html*/

    }

    // CAS PASSAGER : 
    else if(mysqli_num_rows($passager) !== 0){
        $requete_etat = mysqli_query($link_login, "SELECT etat from rejoindre where id_personne = '".$_SESSION['login']."'");
        $etat = mysqli_fetch_assoc($requete_etat);

        if($etat['etat'] == 0){
            while($id_trajet = mysqli_fetch_assoc($passager)){
                $passager1 = mysqli_query($link_login, "SELECT prix, nb_passager, date_heure_depart, date_heure_arrivee, description, date_creation FROM trajet INNER JOIN trajet_conducteur WHERE trajet.id_trajet = trajet_conducteur.id_trajet AND id_trajet = '".$id_trajet['id_trajet']."'");
                $donnee_passager = mysqli_fetch_assoc($passager1);
            }    

        }
        else{
            $passager1 = mysqli_query($link_login, "SELECT prix, nb_passager, date_heure_depart, date_heure_arrivee, description, date_creation FROM trajet INNER JOIN trajet_conducteur WHERE trajet.id_trajet = trajet_conducteur.id_trajet AND id_trajet = '".$id_trajet['id_trajet']."'");
            $donnee_passager = mysqli_fetch_assoc($passager1);
        }
    }
    else{
// VOUS NAVEZ DE TRAJET
        
    }

    ?>
</html>