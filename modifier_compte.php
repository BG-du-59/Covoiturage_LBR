<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Mon compte</title>
</head>

    <?php include('bdd.php'); session_start(); $_SESSION["login"] = 2;?>
    <?php include('mail_envoie.php');?>

<?php
    
    $id_personne = $_SESSION["login"];
    
    // récupère le champs dans le formulaire
    $nom = !empty($_POST['nom']) ? $_POST['nom'] : NULL;
    $prenom = !empty($_POST['prenom']) ? $_POST['prenom'] : NULL;
    $email = !empty($_POST['email']) ? $_POST['email'] : NULL;
    $phone = !empty($_POST['phone']) ? $_POST['phone'] : NULL;
    $adress = !empty($_POST['adress']) ? $_POST['adress'] : NULL;

    // modifie la ligne correspondant au compte
    $requete_update_compte = "UPDATE compte SET nom = '".$nom."', prenom = '".$prenom."', email = '".$email."', phone = '".$phone."' WHERE (id_personne = $id_personne)";
    $result_update_compte = mysqli_query($link_login, $requete_update_compte);
    

?>

<body>
    <form action="<?php echo htmlspecialchars($_SERVER['REQUEST_URI'], ENT_QUOTES); ?>" method="post">
        <label>Nom</label>
        <input type="text" name="nom" id="nom" value="<?php if(!empty($_POST['nom'])) { echo htmlspecialchars($_POST['nom'], ENT_QUOTES); } ?>" required>

        <label>Prenom</label>
        <input type="text" name="prenom" id="prenom" value="<?php if(!empty($_POST['prenom'])) { echo htmlspecialchars($_POST['prenom'], ENT_QUOTES); } ?>" required>

        <label>Email</label>
        <input type="text" name="email" id="email" value="<?php if(!empty($_POST['email'])) { echo htmlspecialchars($_POST['email'], ENT_QUOTES); } ?>" required>

        <label>Telephone</label>
        <input type="text" name="phone" id="phone" value="<?php if(!empty($_POST['phone'])) { echo htmlspecialchars($_POST['phone'], ENT_QUOTES); } ?>" required>

        <label>Adresse</label>
        <input type="text" name="adress" id="adress" value="<?php if(!empty($_POST['adress'])) { echo htmlspecialchars($_POST['adress'], ENT_QUOTES); } ?>" required>
        <input type="submit" name="submit" value="Modifier" />
        </p>
                <?php if(!empty($message)) :
                    echo '<div style="text-align: center ;margin-top: 4px; font-size: 20px;font-weight: bold; color: white; text-decoration: underline;">  '.$message.' </div>';
                endif; ?>
        </p>
    </form>
</body>
</html>