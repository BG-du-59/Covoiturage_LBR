<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>Mes informations</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="modifier_mes_informations.css" rel="stylesheet">

</head>
<!-- SCRIPT -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://kit.fontawesome.com/a076d05399.js"></script>
<script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

<?php 
    session_start();
    include("bdd.php");
    include("mail_envoie.php");
    $_SESSION['id_personne']=4;
?>


<body class="auth_class" >

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
                <button class="btn btn-danger btn-md btn-block" type="button" >Mes trajets</button>
            </li>
            <li class="nav-item form-inline">
                <a class="nav-link " href="#" onclick="on()"><img src="profile_picture.png" > <span class="sr-only">(current)</span></a>
            </li>
        </ul>

    </div>
</nav>


<div>
    <!--
    <header id="entete">
        <div id="logo">
            <img src="image\logoBLANC_1.png" id="image">
        </div>
        <div id="trajet_compte">
            <button type="button" id="bouton_mestrajets">Mes trajets</button>
            <button type="button" id="se_co"><img src="image\moncompte2.png" id="image2"></button>
        </div>
    </header>
    -->
    <div class="container login-container">
        <div class="row">
            <div class="col-md-12 login-form">
                <div class="login_form_in">
                    <h1 class="auth_title text-left">Information de compte</h1>
                    <div class="alert alert-danger bg-soft-primary border-0" role="alert">
                        <h1> Vous pouvez modifier les information concernant votre compte.</h1>
                    </div>

                    <form action="<?php echo htmlspecialchars($_SERVER['REQUEST_URI'], ENT_QUOTES); ?>" method="post">
                        <table class="table">
                            <tbody>
                            <tr>
                                <th scope="row"></th>
                                <td>Nom :</td>
                                <td>
                                <input type="text" class="form-control" id="nom" name="nom" value="<?php if(!empty($_POST['nom'])) { echo htmlspecialchars($_POST['nom'], ENT_QUOTES); } ?>" required>
                                <p id="noms" ><?php
                                    $requete_nom ="SELECT nom from compte WHERE(id_personne = '".$_SESSION['id_personne']."')";
                                    $result_nom = mysqli_query($link_login, $requete_nom);
                                    $nom =mysqli_fetch_assoc($result_nom);
                                    echo implode("",$nom);
                                ?>

                                </p>
                                </td>
                                <td>
                                <button type="button" class="btn btn-danger btn-md btn-block" name="lastname" onclick="mod(0)">Modifier</button>
                                </td>
                            </tr>

                            <tr>
                                <th scope="row"></th>
                                <td>
                                    Prénom :
                                </td>
                                <td>
                                    <input type="text" class="form-control" id="prenom" name="prenom" value="<?php if(!empty($_POST['prenom'])) { echo htmlspecialchars($_POST['prenom'], ENT_QUOTES); } ?>"  required>
                                    <p id="firstname"><?php
                                    $requete_prenom ="SELECT prenom from compte WHERE(id_personne ='".$_SESSION['id_personne']."')";
                                    $result_prenom = mysqli_query($link_login, $requete_prenom);
                                    $prenom =mysqli_fetch_assoc($result_prenom);
                                    echo implode("",$prenom);
                                ?></p>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-danger btn-md btn-block" name="pre" onclick="mod(1)">Modifier</button>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row"></th>
                                <td>
                                    Email :
                                </td>
                                <td>
                                    <input type="text" class="form-control" id="mail"  name="mail" value="<?php if(!empty($_POST['mail'])) { echo htmlspecialchars($_POST['mail'], ENT_QUOTES); } ?>" required>
                                    <p id="email"><?php
                                    $requete_mail ="SELECT email from compte WHERE(id_personne ='".$_SESSION['id_personne']."')";
                                    $result_mail = mysqli_query($link_login, $requete_mail);
                                    $mail =mysqli_fetch_assoc($result_mail);
                                    echo implode("",$mail);
                                ?></p>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-danger btn-md btn-block" name="add_mail" onclick="mod(2)">Modifier</button>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row"></th>
                                <td>
                                    Numéro de téléphone :
                                </td>
                                <td>
                                    <input type="text" class="form-control" id="tel" name="tel" value="<?php if(!empty($_POST['tel'])) { echo htmlspecialchars($_POST['tel'], ENT_QUOTES); } ?>" required>
                                    <p id="phone"><?php
                                    $requete_phone ="SELECT phone from compte WHERE(id_personne = '".$_SESSION['id_personne']."')";
                                    $result_phone = mysqli_query($link_login, $requete_phone);
                                    $phone =mysqli_fetch_assoc($result_phone);
                                    echo implode("",$phone);
                                ?></p>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-danger btn-md btn-block" name="telephone" onclick="mod(3)">Modifier</button>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row"></th>
                                <td>
                                    Mot de passe :
                                </td>
                                <td>
                                    <input type="text" class="form-control" id="mdp" name="mdp" value="<?php if(!empty($_POST['mdp'])) { echo htmlspecialchars($_POST['mdp'], ENT_QUOTES); } ?>" required>
                                    <p id="password"><?php
                                    $requete_phone ="SELECT passw from compte WHERE(id_personne = '".$_SESSION['id_personne']."')";
                                    $result_phone = mysqli_query($link_login, $requete_phone);
                                    $phone =mysqli_fetch_assoc($result_phone);
                                    echo implode("",$phone);
                                ?></p>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-danger btn-md btn-block" name="mot_de_passe" onclick="mod(3)">Modifier</button>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <button type="button" id="modifier" name="submit" value="Confirmer les modifications" class="btn btn-danger btn-lg btn-block">Confirmer les modifications</button>
                        </div>
                        <div class="form-group other_auth_links">
                            <a class="" href="">Annuler</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <div class="corps">
        <div class="cadre">
            <form action="<?php echo htmlspecialchars($_SERVER['REQUEST_URI'], ENT_QUOTES); ?>" method="post">

            </form>
        </div>
    </div>
</div>

<script src="modifier_mes_informations.js"></script>

</body>
</html>
