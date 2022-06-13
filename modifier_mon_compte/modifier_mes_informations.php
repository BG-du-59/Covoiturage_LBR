<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>Mes informations</title>
    <link href="modifier_mes_informations.css" rel="stylesheet">
</head>
<script src="modifier_mes_informations.js"></script>

<?php include('bdd.php'); session_start(); $_SESSION["login"] = 5;?>


<?php
    
    $id_personne = $_SESSION["login"];

    
    
    // récupère le champs dans le formulaire
    $nom = !empty($_POST['nom']) ? $_POST['nom'] : NULL;
    $prenom = !empty($_POST['prenom']) ? $_POST['prenom'] : NULL;
    $email = !empty($_POST['mail']) ? $_POST['mail'] : NULL;
    $phone = !empty($_POST['tel']) ? $_POST['tel'] : NULL;

    // modifie la ligne correspondant au compte

    if(!empty($_POST)){
        if(empty($_POST['nom'])){}
        else if(empty($_POST['prenom'])){}
        else if(empty($_POST['mail'])){}
        else if(empty($_POST['tel'])){}
        else{
            $requete_update_compte = "UPDATE compte SET nom = '".$nom."', prenom = '".$prenom."', email = '".$email."', phone = '".$phone."' WHERE (id_personne = $id_personne)";
            $result_update_compte = mysqli_query($link_login, $requete_update_compte);
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
            <div class="cadre">
                <form action="<?php echo htmlspecialchars($_SERVER['REQUEST_URI'], ENT_QUOTES); ?>" method="post">
                    <table>
                        <tr>
                            <td>
                                Nom :
                            </td>
                            <td class="modifier">
                                <input type="text" class="box" id="nom" name="nom" value="<?php if(!empty($_POST['nom'])) { echo htmlspecialchars($_POST['nom'], ENT_QUOTES); } ?>" style="display: none;" required>
                                <p id="noms" style="display: block;"><?php 
                                    $requete_nom ="SELECT nom from compte WHERE(id_personne = $id_personne)";
                                    $result_nom = mysqli_query($link_login, $requete_nom);
                                    $nom =mysqli_fetch_assoc($result_nom);
                                    echo implode("",$nom);
                                ?>
                                    
                            </p>
                            </td>
                            <td class="mod">
                                <button type="button" class="crayon" name="lastname" onclick="mod(0)">Modifier</button>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Prénom :
                            </td>
                            <td class="modifier">
                                <input type="text" class="box" id="prenom" name="prenom" value="<?php if(!empty($_POST['prenom'])) { echo htmlspecialchars($_POST['prenom'], ENT_QUOTES); } ?>" style="display: none;" required>
                                <p id="firstname" style="display: block;"><?php 
                                    $requete_prenom ="SELECT prenom from compte WHERE(id_personne = $id_personne)";
                                    $result_prenom = mysqli_query($link_login, $requete_prenom);
                                    $prenom =mysqli_fetch_assoc($result_prenom);
                                    echo implode("",$prenom);
                                ?></p>
                            </td>
                            <td class="mod">
                                <button type="button" class="crayon" name="pre" onclick="mod(1)">Modifier</button>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Email :
                            </td>
                            <td class="modifier">
                                <input type="text" class="box" id="mail"  name="mail" value="<?php if(!empty($_POST['mail'])) { echo htmlspecialchars($_POST['mail'], ENT_QUOTES); } ?>" style="display: none;" required>
                                <p id="email" style="display: block;"><?php 
                                    $requete_mail ="SELECT email from compte WHERE(id_personne = $id_personne)";
                                    $result_mail = mysqli_query($link_login, $requete_mail);
                                    $mail =mysqli_fetch_assoc($result_mail);
                                    echo implode("",$mail);
                                ?></p>
                            </td>
                            <td class="mod">
                                <button type="button" class="crayon" name="add_mail" onclick="mod(2)">Modifier</button>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Numéro de téléphone :
                            </td>
                            <td class="modifier">
                                <input type="text" class="box" id="tel" name="tel" value="<?php if(!empty($_POST['tel'])) { echo htmlspecialchars($_POST['tel'], ENT_QUOTES); } ?>" style="display: none;" required>
                                <p id="phone" style="display: block;"><?php 
                                    $requete_phone ="SELECT phone from compte WHERE(id_personne = $id_personne)";
                                    $result_phone = mysqli_query($link_login, $requete_phone);
                                    $phone =mysqli_fetch_assoc($result_phone);
                                    echo implode("",$phone);
                                ?></p>
                            </td>
                            <td class="mod">
                                <button type="button" class="crayon" name="telephone" onclick="mod(3)">Modifier</button>
                            </td>
                        </tr>
                    </table>
                    <input type="submit" id="modifier" name="submit" value="Valider">
                </form>
            </div>
        </div>
    </div>
</body>

</html>