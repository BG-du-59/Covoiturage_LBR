<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>covoiturage</title>
    <link type="text/css" href="mestrajets.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
</head>
<script src="mestrajets.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

<?php
    include('bdd.php');
    session_start();
$adress = !empty($_POST['adress']) ? $_POST['adress'] : NULL;
$date = !empty($_POST['date']) ? $_POST['date'] : NULL;
?>

<body style="background-color: #161920;"></body>
    <div id="root" class style ="min-height: 720px; height: auto;">
        <header id="entete">
            <div id="logo">
                <img src="logoBLANC_1.png" id="image">
            </div>
            <div id="trajet_compte">
                <button type="button" id="bouton_accueil">acceuil</button>
                <button type="button" id="se_co"><img src="moncompte2.png" id="image2"></button>
            </div>
        </header>
        <div id="fenetre1" class="fenetre" style="display: none;">
            <div id="propdem">
                <button id="demande" class="visible" >RETOUR<div id="barre"></div></button>
                <button id="proposition" class="pasvisible" onclick="changement_fenetre()">ALLER</button>
            </div>
            <div id="liste">
                <!--  visuel demande en cours de validation  -->
                <div class="bulle_conducteur">
                    <div class="info_destination">
                        <div class="info_depart">3 rue du faubourg notre dame, Lille</div>
                        <div class="vers">
                            <div class="rond"></div>
                            <div class="fleche3"></div>
                            <div class="triangle3"></div>
                        </div>
                        <div class="info_arrive">Château Dalle Dumont, 21 Rue de Linselles, 59117 Wervicq-Sud</div>
                        <div class="photo_profil">
                            <div class="nom_prenom">Mon trajet conducteur</div>                              
                        </div>
                    </div>
                    <div class="info_trajet">
                        <div class="marge"></div>
                        <div class="info_compl">durée estimée :</div>
                        <div class="info_compl">date :</div>
                        <div class="info_compl">heure de départ :</div>
                        <div class="info_compl">place disponible :</div>
                    </div>
                    <div class="interraction">
                        <div class="marge1"></div>
                        <div class="prix">PRIX</div>
                        <div class="bouton_interraction">
                            <button class="bouton_visualiser" type="submit">modifier</button> 
                            <button class="bouton_rejoindre">supprimer</button>
                        </div>
                    </div>
                </div>
                <div class="bulle_passager">
                    <div class="info_passager">Prénom Nom</div>
                    <div class="souhaite">souhaite rejoindre votre trajet</div>
                    <div class="accepter_refuser">
                            <button class="bouton_accepter" type="submit">accepter</button> 
                            <button class="bouton_refuser">refuser</button>
                    </div>
                </div>
            </div>
        </div>

        <div id="fenetre2" class="fenetre">
            <div id="propdem">
                <button id="demande" class="pasvisible" onclick="changement_fenetre()">RETOUR</button>
                <button id="proposition" class="visible">ALLER<div id="barre"></div></button>
            </div>
            <div id="liste" style="overflow-y:scroll;">
                <div class="bulle">
                    <!--  visuel demande en cours de validation  -->
                    <div class="haut_bulle">
                        <div class="info_destination">
                            <div class="info_depart">3 rue du faubourg notre dame, Lille</div>
                            <div class="vers">
                                <div class="rond"></div>
                                <div class="fleche3"></div>
                                <div class="triangle3"></div>
                            </div>
                            <div class="info_arrive">Château Dalle Dumont, 21 Rue de Linselles, 59117 Wervicq-Sud</div>
                            <div class="photo_profil">
                                <div class="nom_prenom">Nom Prénom</div>                              
                            </div>
                        </div>
                        <div class="info_trajet">
                            <div class="marge"></div>
                            <div class="info_compl">durée estimée :</div>
                            <div class="info_compl">date :</div>
                            <div class="info_compl">heure de départ :</div>
                            <div class="info_compl">place disponible :</div>
                        </div>
                        <div class="interraction">
                            <div class="marge1"></div>
                            <div class="prix">PRIX</div>
                            <div class="bouton_interraction">
                                <button class="bouton_visualiser" type="submit" name="submit" data-toggle="modal" data-target="#visualiser">visualiser</button> 
                                <button class="bouton_rejoindre">supprimer</button>
                            </div>
                        </div>
                    </div> 
                    <div class="inter_bulle"></div>
                    <div class="bas_bulle">trajet en cours de validation</div>  
                </div>
            </div>
            <!-- Pop up pour afficher maps-->

            
            
        </div>
        <div class="modal" id="visualiser">
                <div class="modal-dialog modal-fullscreen-lg-down modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-body">
                            <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                            <?php $addressGPS = '3+rue+du+faubourg+notre+dame,+lille';?>
                            <iframe src="https://maps.google.com/maps?&q=<?php echo $addressGPS?>&output=embed "width="100%" height="500" z-index="100"></iframe>
                        </div>
                    </div>
                </div>
            </div>
</html>