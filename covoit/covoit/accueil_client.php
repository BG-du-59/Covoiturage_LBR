<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>covoiturage</title>
    <link type="text/css" href="accueil_client.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
</head>
<script src="page_connecte.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>


<?php
    include('bdd.php');
    session_start();
$adress = !empty($_POST['adress']) ? $_POST['adress'] : NULL;
$date = !empty($_POST['date']) ? $_POST['date'] : NULL;
/*
// etat TABLE trajet : 0 => proposition || 1 => demande
// S'il recherche un trajet on lui montre les trajets proposés
$requete_demande_trajet = mysqli_query($link_login, "SELECT id_trajet FROM trajet WHERE date_heure_depart = '".$date."' AND adresse = '".$adress."' AND etat = 0");

if(!empty($_POST)){
    if(empty($_POST['adress'])){}
    else if(empty($_POST['date'])){}

    // Pas de demande de trajet
    else if(mysqli_num_rows($requete_demande_trajet) == 0){
        echo "Il n'y a pas de proposition de trajet pour le moment.";
    }
    else if(mysqli_num_rows($result) > 0){
        while(){

        }

    }
}

*/
?>



<body style="background-color: #161920;"></body>
    <div id="root" class style ="min-height: 720px; height: auto;">
        <header id="entete">
            <div id="logo">
                <img src="logoBLANC_1.png" id="image">
            </div>
            <div id="trajet_compte">
                <button type="button" id="bouton_mestrajets">Mes trajets</button>
                <button type="button" id="se_co"><img src="moncompte2.png" id="image2"></button>
            </div>
        </header>
        <div id="fenetre">
            <div id="gauche">

                <form action="<?php echo htmlspecialchars($_SERVER['REQUEST_URI'], ENT_QUOTES); ?>" method="post">

                <div id="destination">
                    <label for="adresse" id="dep">départ :</label>
                    <input type="text" id="adresse" placeholder="saisir une adresse" name="adress" value="<?php if(!empty($_POST['adress'])) { echo htmlspecialchars($_POST['adress'], ENT_QUOTES); } ?>" required>
                    <label for="trip-start" id="le">le :</label>
                    <input type="date"  min="2018-01-01" max="2018-12-31" id="date" name="date" value="<?php if(!empty($_POST['date'])) { echo htmlspecialchars($_POST['date'], ENT_QUOTES); } ?>" required>
                    <label for="horaire" id="a">à :</label>
                    <input type="time" id="horaire">
                </div>
                <div id="destinationbis" style="display: none;">
                    <label for="adresse" id="dep">arrivée :</label>
                    <input type="text" id="adresse" placeholder="saisir une adresse" name="adress" value="<?php if(!empty($_POST['adress'])) { echo htmlspecialchars($_POST['adress'], ENT_QUOTES); } ?>" required>
                    <label for="trip-start" id="le">le :</label>
                    <input type="date" name="trip-start" min="2018-01-01" max="2018-12-31" id="date" name="date" value="<?php if(!empty($_POST['date'])) { echo htmlspecialchars($_POST['date'], ENT_QUOTES); } ?>" required>
                    <label for="horaire" id="a">à :</label>
                    <input type="time" id="horaire">
                </div>
                <button id="destination2">Château Dalle Dumont, 21 Rue de Linselles, 59117 Wervicq-Sud</button>
                <button id="destination2bis" style="display: none;">Château Dalle Dumont, 21 Rue de Linselles, 59117 Wervicq-Sud</button>
                <div id="switch">
                    <div id="fleche1"></div>
                    <div id="fleche2"></div>
                    <div id="triangle1"></div>
                    <div id="triangle2"></div>
                    <button id="echange" onclick="fonction()"></button>
                </div>
                <div id="creer">
                    <input id="rechercher" type="submit" name="submit" value="Rechercher"/>
                    <div id="ou">ou</div>
                    <a id="créerb" href="creer_un_trajet.php">créer mon trajet</a>
                </div>
                </form>
                    <div id="ligne"></div>
            </div>
            <div id="droite1" class="droite" style="display: none;"style="display: none;">
                <div id="propdem">
                    <button id="demande" class="visible" >DEMANDE DE TRAJET <div id="barre"></div></button>
                    <button id="proposition" class="pasvisible" onclick="changement_fenetre()">PROPOSITION DE TRAJET</button>
                </div>
                <div id="liste" style="overflow-y:scroll;">
                    <?php
                        $requete1 = mysqli_query($link_login, "SELECT id_trajet, date_heure_depart, date_heure_arrivee, description, type_, adresse FROM trajet WHERE etat = 1 ORDER BY date_creation DESC");

                        if(mysqli_num_rows($requete1) == 0)
                            echo "<p>"."Il n'y a aucune demande de trajet"."</p>";
                        else{
                            while($row = mysqli_fetch_assoc($requete1)){
                                $id_demandeur = mysqli_query($link_login, "SELECT id_personne FROM demande WHERE id_trajet = '".$row['id_trajet']."'");
                                $id_d = mysqli_fetch_assoc($id_demandeur);
                                $nom_demandeur = mysqli_query($link_login, "SELECT nom, prenom FROM compte WHERE id_personne='".$id_d['id_personne']."'");
                                $nom = mysqli_fetch_assoc($nom_demandeur);


                                // ALLER :
                                if($row['type_'] == 'aller'){


                    ?>

                    <div class="bulle">
                        <div class="info_destination">
                            <div class="info_depart"><?php echo $row['adresse'] ?></div>
                            <div class="vers">
                                <div class="rond"></div>
                                <div class="fleche3"></div>
                                <div class="triangle3"></div>
                            </div>
                            <div class="info_arrive">Château Dalle Dumont, 21 Rue de Linselles, 59117 Wervicq-Sud</div>
                            <div class="photo_profil">
                                <div class="nom_prenom"><?php echo $nom['nom']." ".$nom['prenom'] ?></div>
                            </div>

                            <?php
                                }

                                // RETOUR :
                                else if($row['type_'] == 'retour'){

                            ?>

                            <div class="bulle">
                                <div class="info_destination">
                                    <div class="info_arrive">Château Dalle Dumont, 21 Rue de Linselles, 59117 Wervicq-Sud</div>
                                    <div class="vers">
                                        <div class="rond"></div>
                                        <div class="fleche3"></div>
                                        <div class="triangle3"></div>
                                    </div>
                                    <div class="info_depart"><?php echo $row['adresse'] ?></div>
                                    <div class="photo_profil">
                                        <div class="nom_prenom"><?php echo $nom['nom']." ".$nom['prenom'] ?></div>
                                    </div>
                            <?php
                            }
                            ?>
                        </div>
                        <div class="info_trajet">
                            <div class="marge"></div>
                            <div class="info_compl">durée estimée :</div>
                            <div class="info_compl">date : <?php echo $row['date_heure_depart'] ?></div>
                            <div class="info_compl">heure de départ : <?php echo $row['date_heure_depart'] ?></div>
                        </div>
                        <div class="interraction">
                            <div class="marge1"></div>
                            <div class="prix">PRIX
                            </div>
                            <div class="bouton_interraction">
                                <button class="bouton_visualiser" type="button" name="submit" data-toggle="modal" data-target="#visualiser">visualiser</button> 
                                <button class="bouton_rejoindre">proposer</button>
                            </div>
                        </div>
                    </div>

                    <?php
                            }
                        }

                    ?>

                </div>
            </div>

            <div id="droite2" class="droite">
                <div id="propdem">
                    <button id="demande" class="pasvisible" onclick="changement_fenetre()">DEMANDE DE TRAJET </button>
                    <button id="proposition" class="visible">PROPOSITION DE TRAJET<div id="barre"></div></button>
                </div>
                <div id="liste" style="overflow-y:scroll;">
                    <?php
                    $requete2 = mysqli_query($link_login, "SELECT id_personne, trajet.id_trajet, prix, nb_passager, telephone_visible, date_heure_depart, date_heure_arrivee, description, type_, adresse FROM trajet INNER JOIN trajet_conducteur WHERE trajet.id_trajet = trajet_conducteur.id_trajet AND trajet.etat = 0 ORDER BY date_creation DESC");

                    if(mysqli_num_rows($requete2) == 0)
                    echo "<p>"."Il n'y a aucune proposition de trajet"."</p>";
                    else{
                    while($row1 = mysqli_fetch_assoc($requete2)){
                    $id_conducteur = mysqli_query($link_login, "SELECT id_personne FROM trajet_conducteur WHERE id_trajet = '".$row1['id_trajet']."'");
                    $id_c = mysqli_fetch_assoc($id_conducteur);
                    $nom_c = mysqli_query($link_login, "SELECT nom, prenom FROM compte WHERE id_personne='".$id_c['id_personne']."'");
                    $nomc = mysqli_fetch_assoc($nom_c);

                    // Calcul nombre de place libre
                    // recup id du trajet du conducteur :
                    $id_trajet_conducteur =  mysqli_query($link_login, "SELECT id_trajet, nb_passager FROM trajet_conducteur WHERE id_personne='".$row1['id_personne']."'");
                    $id1 = mysqli_fetch_assoc($id_trajet_conducteur);
                    // Compte cbm il y a de passager(s) sur ce trajet
                    $count_passagers = mysqli_query($link_login, "SELECT COUNT('id_personne') as nb FROM rejoindre WHERE id_trajet='".$id1['id_trajet']."' AND etat = 1");
                    $count = mysqli_fetch_assoc($count_passagers);
                    $place_dispo = $id1['nb_passager'] - $count['nb'];


                    // ALLER :
                    if($row1['type_'] == 'aller'){


                    ?>

                    <div class="bulle">
                        <div class="info_destination">
                            <div class="info_depart"><?php echo $row1['adresse']?></div>
                            <div class="vers">
                                <div class="rond"></div>
                                <div class="fleche3"></div>
                                <div class="triangle3"></div>
                            </div>
                            <div class="info_arrive">Château Dalle Dumont, 21 Rue de Linselles, 59117 Wervicq-Sud</div>
                            <div class="photo_profil">
                                <div class="nom_prenom"><?php echo $nomc['nom']." ".$nomc['prenom'] ?></div>
                            </div>

                            <?php
                            }

                            // RETOUR :
                            else if($row1['type_'] == 'retour'){

                            ?>

                            <div class="bulle">
                                <div class="info_destination">
                                    <div class="info_arrive">Château Dalle Dumont, 21 Rue de Linselles, 59117 Wervicq-Sud</div>
                                    <div class="vers">
                                        <div class="rond"></div>
                                        <div class="fleche3"></div>
                                        <div class="triangle3"></div>
                                    </div>
                                    <div class="info_depart"><?php echo $row1['adresse'] ?></div>
                                    <div class="photo_profil">
                                        <div class="nom_prenom"><?php echo $nomc['nom']." ".$nomc['prenom'] ?></div>
                                    </div>
                                    <?php
                                    }
                                    ?>
                                </div>
                                <div class="info_trajet">
                                    <div class="marge"></div>
                                    <div class="info_compl">durée estimée :</div>
                                    <div class="info_compl">date : <?php echo $row1['date_heure_depart'] ?></div>
                                    <div class="info_compl">heure de départ : <?php echo $row1['date_heure_depart'] ?></div>
                                    <div class="info_compl">place disponible : <?php echo $place_dispo ?></div>
                                </div>
                                <div class="interraction">
                                    <div class="prix">
                                        <div class="prix_text">PRIX : <?php echo $row1['prix'] ?>€</div>
                                    </div>
                                    <div class="bouton_interraction">
                                        <button class="bouton_visualiser" type="button" name="submit" data-toggle="modal" data-target="#visualiser">visualiser</button>
                                        <button class="bouton_rejoindre" type="button" data-toggle="modal" data-target="#Rejoindre">rejoindre</button>
                                    </div>
                                </div>
                            </div>

                            <?php
                            }
                            }

                            ?>

                        </div>
                    </div>
            </div>
            
        </div>
        <!-- popup rejoindre un trajet -->
        <div class="modal" id="Rejoindre" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered modal-fullscreen-mb-down">
                <div class="modal-content">
                    <div class="modal-header entete_pop">
                        <div id="fond_photo">
                            <img src="moncompte2.png" id="photo">
                        </div>
                        <p style="padding-left: 40px;"> Nom Prénom </p>
                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body tableau">
                        <table>
                            <tr>
                                <td>Lieu de départ : </td>
                                <td class="texte_gauche">adresse de départ</td>
                            </tr>
                            <tr>
                                <td>Date de départ : </td>
                                <td class="texte_gauche">date</td>
                            </tr>
                            <tr>
                                <td>Horaire de départ : </td>
                                <td class="texte_gauche">heure</td>
                            </tr>
                            <tr>
                                <td>Place disponible : </td>
                                <td class="texte_gauche">chiffre</td>
                            </tr>
                        </table>
                    </div>
                    <div class="modal-footer pied_page">
                        <button type="button" class="btn btn-dark">Rejoindre</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pop up pour afficher maps-->

        <div class="modal" id="visualiser">
            <div class="modal-dialog modal-fullscreen-lg-down modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">
                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                        <?php $addressGPS='Lille';?>
                        <iframe src="https://maps.google.com/maps?&q=<?php echo $addressGPS?>&output=embed "width="100%" height="500" z-index="100"></iframe>
                    </div>
                </div>
            </div>
        </div>

       
    </div>
</html>
