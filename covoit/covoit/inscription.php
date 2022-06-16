<!doctype html>
<html lang="fr" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>LRB-Covoiturage-system</title>

    <!-- SCRIPT -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>


    <!--My CSS-->
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://npmcdn.com/flatpickr/dist/themes/material_red.css">
    <!-- Favicon -->


</head>

<?php include('bdd.php'); include("mail_envoie.php");?>

<?php

$nom = !empty($_POST['nom']) ? $_POST['nom'] : NULL;
$prenom = !empty($_POST['prenom']) ? $_POST['prenom'] : NULL;
$email = !empty($_POST['email']) ? $_POST['email'] : NULL;
$phone = !empty($_POST['phone']) ? $_POST['phone'] : NULL;
$passw1 = !empty($_POST['password1']) ? $_POST['password1'] : NULL;
$passw2 = !empty($_POST['password2']) ? $_POST['password2'] : NULL;

// CHECK SI EXISTE PAS : (nom et prenom identique) email telephone
$requete_check_existe_pas = "SELECT id_personne FROM compte WHERE (nom = '".$nom."' AND prenom = '".$prenom."') OR email = '".$email."' OR phone = '".$phone."'";
$result_exist_pas = mysqli_query($link_login, $requete_check_existe_pas);

$requete_inscription = "INSERT INTO `compte`(`id_personne`, `nom`, `prenom`, `email`, `phone`, `passw`, `role_`) VALUES (0,'".$nom."','".$prenom."','".$email."','".$phone."','".$passw1."', 'festivalier')";

if(!empty($_POST)){

    if(empty($_POST['nom'])){}
    else if(empty($_POST['prenom'])){}
    else if(empty($_POST['email'])){}
    else if(empty($_POST['phone'])){}
    else if(empty($_POST['password1'])){}
    else if(empty($_POST['password2'])){}
    else if($_POST['password1'] !== $_POST['password2'])
        echo "Les 2 mots de passes rentres sont differents.";

    // Donnees CORRECTES : redirige vers la page trajet
    else if(mysqli_num_rows($result_exist_pas) == 0) {
        $result = mysqli_query($link_login, $requete_inscription); // On inscrit le nouveau dans la bdd
        session_start();
        $result_exist = mysqli_query($link_login, $requete_check_existe_pas); // On r�cup�re l'id_personne du nouveau
        $session = mysqli_fetch_assoc($result_exist);
        $_SESSION['login'] = $session["id_personne"];

        // vérification email demande dans le cdc par code
        $code = code_verification();
        $_SESSION['code'] = $code;
        $body="Vous venez de créer un compte au brique rouge covoiturage. Veuillez saisir le code suivant pour vérifier votre email '.$code.' ";
        e_mail($_POST['email'],$body,"Confirmation de votre mail");
        header("Location: verif_mail.php");
    }
}
?>


<body style="background-color: #161920">

<!--Header-->

<nav class="navbar navbar-expand-lg navbar-dark header" >
    <a class="nav-link navbar-toggler " href="#"><img src="LRB_blanc_petit.png" > <span class="sr-only">(current)</span></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item d-none d-lg-block">
                <a class="nav-link" href="#"><img src="LRB_blanc.png" > <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item link form-inline active">
                <a class="nav-link" href="#" >Covoiturage</a>
            </li>
            <li class="nav-item dropdown form-inline">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    info
                </a>
                <div class="dropdown-menu" id="dropdown" aria-labelledby="navbarDropdown">
                    <div class="dropdown-divider"></div>
                    <a class="menu dropdown-item" id="menu"  href="#">Comment ça marche</a>
                    <a class="menu dropdown-item" id="menu1"  href="#">Info Sanitaire</a>
                    <a class="menu dropdown-item" id="menu2"  href="#">Date Festivals</a>
                    <div class="dropdown-divider"></div>
                </div>
            </li>

        </ul>
        <ul class="navbar nav ">
            <li class="nav-item form-inline">
                <a class="nav-link disabled" href="#">Mes Trajets</a>
            </li>
            <li class="nav-item form-inline">
                <a class="nav-link " href="#" onclick="on()"><img src="profile_picture.png" ><span class="sr-only">(current)</span></a>
            </li>
        </ul>
 
    </div>
</nav>

<!--Main-->
<div id="overlay" onclick="off()"></div>

<section class="vh-100 gradient-custom">
    <div class="container py-5 h-100">
        <div class="row justify-content-center align-items-center h-100">
            <div class="col-12 col-lg-9 col-xl-8">
                <div class="card shadow-2-strong card-registration">
                    <div class="card-body p-4 p-md-5" >
                        <h3 class="mb-4 pb-2 pb-md-0 mb-md-5">Inscription</h3>
                        <form action="<?php echo htmlspecialchars($_SERVER['REQUEST_URI'], ENT_QUOTES); ?>" method="post">

                            <div class="row">
                                <div class="col-md-6 mb-4">

                                    <div class="form-outline">
                                        <input type="text" id="firstName" class="form-control form-control-lg" placeholder="Prenom" name="prenom" value="<?php if(!empty($_POST['prenom'])) { echo htmlspecialchars($_POST['prenom'], ENT_QUOTES); } ?>" required>
                                    </div>

                                </div>
                                <div class="col-md-6 mb-4">

                                    <div class="form-outline">
                                        <input type="text" id="lastName" class="form-control form-control-lg" placeholder="Nom" name="nom" value="<?php if(!empty($_POST['nom'])) { echo htmlspecialchars($_POST['nom'], ENT_QUOTES); } ?>" required>
                                    </div>

                                </div>
                            </div>


                            <div class="row">
                                <div class="col-md-6 mb-4 pb-2">

                                    <div class="form-outline">
                                        <input type="text" id="emailAddress" class="form-control form-control-lg" placeholder="E-mail" name="email" value="<?php if(!empty($_POST['email'])) { echo htmlspecialchars($_POST['email'], ENT_QUOTES); } ?>" required>
                                    </div>

                                </div>
                                <div class="col-md-6 mb-4 pb-2">

                                    <div class="form-outline">
                                        <input type="text" id="phoneNumber" class="form-control form-control-lg" placeholder="Numéro de Téléphone" name="phone" value="<?php if(!empty($_POST['phone'])) { echo htmlspecialchars($_POST['phone'], ENT_QUOTES); } ?>" required>
                                    </div>

                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-4">

                                    <div class="form-outline">
                                        <div class="input-group" id="show_hide_password">
                                            <input class="form-control form-control-lg" id="mot_de_passe" type="password" placeholder="Mot de passe" name="password1" value="<?php if(!empty($_POST['password1'])) { echo htmlspecialchars($_POST['password1'], ENT_QUOTES); } ?>" required>
                                            <div class="input-group-append"style="border: 2px solid #FFFEE6; padding-right: 5px; border-radius: 3px;">
                                                <a href=""><i class="fa fa-eye-slash fa-lg" aria-hidden="true" style="margin-top: 16px; margin-left: 5px; color: #FFFEE6; "></i></a>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-md-6 mb-4">

                                    <div class="form-outline" >
                                        <div class="input-group" id="show_hide_password2">
                                            <input class="form-control form-control-lg" id="comfirmer_mot_de_passe" type="password" placeholder="Confirmer mot de passe" name="password2" value="<?php if(!empty($_POST['password2'])) { echo htmlspecialchars($_POST['password2'], ENT_QUOTES); } ?>" required>
                                            <div class="input-group-append"style="border: 2px solid #FFFEE6; padding-right: 5px; border-radius: 3px;">
                                                <a href=""><i class="fa fa-eye-slash fa-lg" aria-hidden="true" style="margin-top: 16px; margin-left: 5px; color: #FFFEE6; "></i></a>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <input class="btn btn-outline-light btn-lg px-5" style="background-color: #AF001E; margin: auto" type="submit" name="submit" value="Inscription"/>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="index.js"></script>



</body>
</html>
